<?php

function addons_include(){

	global $site, $site_addons, $addons, $contenttypes, $layouts, $blocktypes, $htmlincludes, $tblprfx ;

	foreach($site_addons as $addon){
		$addon_ref=$addon['addon_ref'];
	
		/* Check if site specific addon conf can be found, else, load the global */
		if(is_file("sites/$site/addons/$addon_ref/addonconfig.php")){
			include("sites/$site/addons/$addon_ref/addonconfig.php");
		}else{
			include("sites/system/addons/$addon_ref/addonconfig.php");
		}

		$sys_addons     =$system['addons'][$addon_ref];

		$addon_in_base	=$addons[$addon_ref]['file_root'];

		if($sys_addons){
			    foreach($sys_addons as $addon){
			           include("$addon_in_base/system/$addon");
		    	}
		}
	}

	return true;

}

?>
