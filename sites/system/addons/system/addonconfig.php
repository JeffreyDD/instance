<?php
/*
 * Define AddOn name & 
 * register in AddOn Framework
 */
$addons['system']['name']="system";
$addons['system']['file_root']="sites/system/addons/system";

/*
 * Define layouts
 */
if(!$layouts['default']){
$layouts['default']['handler']="default.php";
$layouts['default']['addon']='system';
}
if(!$layouts['table_left']){
$layouts['table_left']['handler']="table_left.php";
$layouts['table_left']['addon']='system';
}

/*
 * Define content types
 */

// PAGE content type
if(!$contenttypes['page']['table'])
$contenttypes['page']['table']=$tblprfx."content_pages";

if(!$contenttypes['page']['handler']){
$contenttypes['page']['handler']="page.php";
$contenttypes['page']['addon']='system';
}

// ALBUM content type
if(!$contenttypes['album']['table'])
$contenttypes['album']['table']=$tblprfx."content_albums";

if(!$contenttypes['album']['handler']){
$contenttypes['album']['handler']="album.php";
$contenttypes['album']['addon']='system';
}

// MENU content type
if(!$contenttypes['menu']['table'])
$contenttypes['menu']['table']=$tblprfx."content_menus";

if(!$contenttypes['menu']['handler']){
$contenttypes['menu']['handler']="menu.php";
$contenttypes['menu']['addon']='system';
}

// STATIC content type
if(!$contenttypes['static']['table'])
$contenttypes['static']['table']=$tblprfx."content_statics";

if(!$contenttypes['static']['handler']){
$contenttypes['static']['handler']="static.php";
$contenttypes['static']['addon']='system';
}

// LIST content type
if(!$contenttypes['list']['table'])
$contenttypes['list']['table']=$tblprfx."content_lists";

if(!$contenttypes['list']['handler']){
$contenttypes['list']['handler']="list.php";
$contenttypes['list']['addon']='system';
}

/*
 * Define block types
 */
if(!$blocktypes['default']){
$blocktypes['default']['handler']="default.php";
$blocktypes['default']['addon']='system';
}
?>
