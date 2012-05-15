<?php
function layout_format($node){
	global $site, $layouts, $tblprfx, $addons;

	if($node['layout'] == NULL || $node['layout'] == FALSE || $node['layout'] == '')
		$layout		=$layouts['site_default'];
	else
		$layout		=$node['layout'];
		
	$layout_handler	=$layouts[$layout]['handler'];
	$layout_addon	=$layouts[$layout]['addon'];
	if($layout_addon){
		$layout_addon_ref	=$addons[$layout_addon]['file_root'];
		$layout_tpl			="$layout_addon_ref/layouts/$layout_handler";
	}else{
		$layout_tpl		="sites/$site/layouts/$layout_handler";
	}
	
	$export['node']['name']		='node';
	$export['node']['var']		=$node;
	$export['site']['name']		='site';
	$export['site']['var']		=$site;
	$export['addons']['name']	='addons';
	$export['addons']['var']	=$addons;

	$layout_formatted=util_evaltpl($layout_tpl,$export);
	
	return $layout_formatted;
}
?>
