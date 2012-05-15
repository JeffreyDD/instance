<?php
/*
 * Define AddOn name & 
 * register in AddOn Framework
 */
$addons['admin']['name']="admin";
$addons['admin']['file_root']="sites/system/addons/admin";


#$hooks['defined']['admin_node']['string']       ="<div class=\"admin-bar\"><a href=\"?adm=node\">Edit Node</a> | <a href=\"?adm=content\">Edit Content</a></div>";

#$hooks['attached']['contenttypes']['page']['post'][]     ='admin_node';
#$hooks['attached']['objects']['node']['post'][]          ='admin_node';

/*
 * Define system components provided by this addon,
 * relative to $addon/system/.
 */
$system['addons']['admin'][]					="auth.php";
$system['addons']['admin'][]					="node.php";
$system['addons']['admin'][]					="content.php";

// Check if we're in admin mode
$admin=util_getarg('admin');

/*
 * Define content types provided by this AddOn

$contenttypes['product']['addon']					='simplecart';
$contenttypes['product']['table']					=$addons['simplecart']['tables']['products'];
$contenttypes['product']['handler']					="product.php";
$contenttypes['product']['override']['list']		='product-tile';

$contenttypes['product-tile']['addon']				='simplecart';
$contenttypes['product-tile']['table']				=$addons['simplecart']['tables']['products'];
$contenttypes['product-tile']['handler']			="product-tile.php";
 */

?>
