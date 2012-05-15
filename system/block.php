<?php

function block_get($bid){
	global $tblprfx;
	
	$tablename=$tblprfx."blocks";
	
	$block_query	="SELECT * FROM `$tablename` WHERE `bid` = '$bid';";

	$block			=data_query($block_query);
	$nid			=$block['nid'];
	
	$node			=node_get(false,$nid);
	
	$block['node']	=$node;
	
	return $block;
}

function block_format($block){
	global $site, $contenttypes, $blocktypes, $tblprfx, $addons;
	
	$node			=$block['node'];
	
	$block_type		="default";
	if($block['type'] && $block['type']!='')
		$block_type		=$block['type'];
	
	$block_handler	=$blocktypes[$block_type]['handler'];
	$block_addon	=$blocktypes[$block_type]['addon'];
	if($block_addon){
		$block_addon_ref=$addons[$block_addon]['file_root'];
		$block_tpl		="$block_addon_ref/blocks/$block_handler";
	}else{
		$block_tpl		="sites/$site/blocks/$block_handler";
	}
	
	$export['node']['name']		='node';
	$export['node']['var']		=$node;
	$export['site']['name']		='site';
	$export['site']['var']		=$site;
	$export['addons']['name']	='addons';
	$export['addons']['var']	=$addons;
	
	$block_formatted=util_evaltpl($block_tpl,$export);
	return $block_formatted;
}

?>
