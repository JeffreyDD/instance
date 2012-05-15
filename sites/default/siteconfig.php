<?php
/*
 * Default front page
 * Shown when no node is specified
 */
$indexnode="frontpage";
 
/*
 * Define layouts
 */
$layouts['default']['handler']="default.php";
$layouts['table_left']['handler']="table_left.php";
 
 /*
 * Default layout
 * Used when no layout is set on the node
 */
$layouts['site_default']="table_left";
 
/*
 * MySQL Server Details
 */
$sql['server']	='localhost';
$sql['username']='instance';
$sql['password']='instance';
$sql['database']='instance';
//$sql['tbl_prfx']="$site_tbl_";
$sql['tbl_prfx']="";
$tblprfx=$sql['tbl_prfx'];	

/*
 * Define content types
 */
$contenttypes['page']['table']="content_pages";
$contenttypes['page']['handler']="page.php";

$contenttypes['album']['table']="content_albums";
$contenttypes['album']['handler']="album.php";

$contenttypes['menu']['table']="content_menus";
$contenttypes['menu']['handler']="menu.php";

$contenttypes['list']['table']="content_lists";
$contenttypes['list']['handler']="list.php";

$contenttypes['static']['table']="content_statics";
$contenttypes['static']['handler']="static.php";

/*
 * Define block types
 */
$blocktypes['default']['handler']="default.php";

/*
 * Define default header includes
 */
$htmlincludes['js'][]="/een/js/path";
$htmlincludes['css'][]="/een/css/path";

/*
 * Define AddOns to be included
 */
$site_addons['simplecart']['addon_ref']='simplecart';

?>
