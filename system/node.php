<?php

function node_get($ref=false,$nid=false){
	global $indexnode, $contenttypes, $tblprfx;
	
	$tablename=$tblprfx."nodes";

	if($nid){
		$node_query	="SELECT * FROM `$tablename` WHERE `nid` = '$nid';";
	}elseif($ref){
		$node_query	="SELECT * FROM `$tablename` WHERE `ref` = '$ref';";
	}elseif(util_getarg('nid')){
		$nid		=util_getarg('nid');
		$node_query	="SELECT * FROM `$tablename` WHERE `nid` = '$nid';";
	}elseif(util_getarg('ref')){
		$ref		=util_getarg('ref');
		$node_query	="SELECT * FROM `$tablename` WHERE `ref` = '$ref';";
	}else{
		$ref		=$indexnode;
		$node_query	="SELECT * FROM `$tablename` WHERE `ref` = '$ref';";
	}

	/* DEBUG HELPER: dumpnodequeries */
	if(util_getarg('dumpnodequeries'))
		var_dump($node_query);

	$result	=data_query($node_query);
	
	$node	=$result;
	// Get refered content
	$content_ref=$node["content_ref"];
	
	// Find out content table
	$content_type=$node['content_type'];
	$content_table=$contenttypes[$content_type]['table'];
	
	// Get content
	$content_query="SELECT * FROM `$content_table` WHERE `cid` = '$content_ref';";
	$content=data_query($content_query);

        /* DEBUG HELPER: dumpnodequeries */
        if(util_getarg('dumpnodequeries'))
                var_dump($content_query);
	
	$node['content']=$content;
	
	/* DEBUG HELPER: dumpnodes */
    if(util_getarg('dumpnodes'))
         var_dump($node);
	
	return $node;
}

function node_format($node,$alttype=false){
	global $site, $contenttypes, $tblprfx, $addons;

	$content_type		=$node['content_type'];
	if($alttype)
		$content_type	=$alttype;

	$content_handler	=$contenttypes[$content_type]['handler'];
	$content_type_addon	=$contenttypes[$content_type]['addon'];
	if($content_type_addon){
		$content_type_addon_ref	=$addons[$content_type_addon]['file_root'];
		$content_tpl			="$content_type_addon_ref/contenttypes/$content_handler";
	}else{
		$content_tpl		="sites/$site/contenttypes/$content_handler";
	}
	
	$export['node']['name']		='node';
	$export['node']['var']		=$node;
	$export['site']['name']		='site';
	$export['site']['var']		=$site;
	$export['addons']['name']	='addons';
	$export['addons']['var']	=$addons;
	$export['tblprfx']['name']	='tblprfx';
	$export['tblprfx']['var']	=$tblprfx;
	$export['contenttypes']['name']	='contenttypes';
	$export['contenttypes']['var']	=$contenttypes;
	
	hooks_get('objects','node','pre');
    hooks_get('contenttypes',$content_type,'pre');

	$node_formatted	=util_evaltpl($content_tpl,$export);	
	
    hooks_get('objects','node','post');
    hooks_get('contenttypes',$content_type,'post');

	return $node_formatted;
}

?>
