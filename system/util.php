<?php

function util_getarg($arg){
	
	$val	= $_GET[$arg];
	
	return $val;
} 

function util_staticpage($static,$import=false){
	if($import){
		if($import['name']){
			$varname	=$import['name'];
			$var		=$import['var'];
			${$varname}	=$var;
		}else{
			$importlist	=$import;
			foreach($importlist as $import){
				$varname	=$import['name'];
				$var		=$import['var'];
				${$varname}	=$var;
			}
		}
	}

	$page			=file_get_contents("$static");
	$pagehtml 		=eval('?>'.$page.'<?php ');
	
	return $pagehtml;
}

function util_evaltpl($tplref,$import=false){

	if($import){
		if($import['name']){
			$varname	=$import['name'];
			$var		=$import['var'];
			${$varname}	=$var;
		}else{
			$importlist	=$import;
			foreach($importlist as $import){
				$varname	=$import['name'];
				$var		=$import['var'];
				${$varname}	=$var;
			}
		}
	}

	$tpl				=file_get_contents($tplref);
	$formatted 		=eval('?>'.$tpl.'<?php ');
	return $formatted;
}

function util_sitesindex_get(){
	//Try to find a sites index file
	global $sitesindexfile;
	if(is_file($sitesindexfile) && is_readable($sitesindexfile) && util_getarg('sitesindexclear') != false){
	
		// Read the sites index in var to be returned
		$sitesindexfilecontents=file_get_contents($sitesindexfile);
		$sitesindex=json_decode($sitesindexfilecontents, true);
		
		if(!$sitesindexfilecontents || !$sitesindex){
			// Sitesindex in cache seems to be corrupted, rebuilding
			$sitesindex=util_sitesindex_build();
		}
	}else{
		$sitesindex=util_sitesindex_build();
	}
	return $sitesindex;
}

function util_sitesindex_build(){
	// Build a sitesindex from the sites' domains files
	// And write it to cache (if possible)
	
	global $sitesindexfile;
	$sitesdir = "sites/";
	$sitesindex = array();

	// Walk over sites dir
	if ($dh = opendir($sitesdir)) {
		while (($file = readdir($dh)) !== false) {

			// Check if this is a site, and a routing file is present
			if(is_dir($sitesdir.$file) && is_file($sitesdir.$file.'/routing.php')){
				// Reset $siteindex, so previous domains don't get added to this site
				$siteindex = array();
				// Include routing file so $siteindex gets populate
				include($sitesdir.$file.'/routing.php');
				// Then reassign it to the main sitesindex in the approp site
				$sitesindex[$file]=$siteindex;
			}
		}
		closedir($dh);
	}

	// Encode the main index to be cached
	$sitesindexfilecontents=json_encode($sitesindex);

	// Write to cache
	$fp = fopen($sitesindexfile, 'w');
	fwrite($fp, $sitesindexfilecontents);
	fclose($fp);

	// Add nocache to result so a webdev knowns whether the sitesindex is cached or not
	$sitesindex[]='nocache';

	// Directly return the just build siteindex so the site can continue to load
	return $sitesindex;
}

function util_sitesindex_determine($query){
	global $sitesindex;

	$sites	=$sitesindex;
	// Walk over sites
	foreach ($sites as $key => $value){
		// Walk over domains for site
		foreach ($value['domains'] as $domain){
			// Try to match the query to a domainname, even if partial, case-insensitive
			$check = stripos($query,$domain);
			// Check if we've got a match
			if($check){
				// If so, set it in $foundsite
				$foundsite = $key;
				if(util_getarg('sitesindexdump'))
					echo "Sitesindex MATCH: $query $domain $key\n";
			}
		}
	
	}
	
	// Return the determined site, or false is nothing could be found
	return $foundsite;
}

?>
