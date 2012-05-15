<h1><?php echo $node['title']; ?></h1>
<?php 
$ref		=$node['content']['ref'];
$addon		=$node['content']['addon'];
if($addon){
	$addon_ref	=$addons[$addon]['file_root'];
	$ref_abs	="$addon_ref/statics/$ref";
}else{
	$ref_abs	="sites/$site/statics/$ref";
}

	$export['node']['name']		='node';
	$export['node']['var']		=$node;
	$export['site']['name']		='site';
	$export['site']['var']		=$site;
	$export['addons']['name']	='addons';
	$export['addons']['var']	=$addons;

echo util_staticpage($ref_abs,$export);
?>
