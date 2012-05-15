<?php
// Instance INDEX file
// Handles all page request processing

// Include the CMS System files
require_once('system/util.php');
require_once('system/data.php');
require_once('system/html.php');
require_once('system/node.php');
require_once('system/layout.php');
require_once('system/block.php');
require_once('system/nodeselector.php');
require_once('system/menu.php');
require_once('system/addons.php');
require_once('system/hooks.php');
require_once('system/admin.php');

// Settings & initialization for the site router & indexer
// No need to change anything here
$sitesindexfile = "sites/index.cache";
$sitesindex = util_sitesindex_get();

// Debugdump for site router & indexer
if(util_getarg('sitesindexdump'))
	var_dump($sitesindex);

// Set site by default to 'default'
$site="default";

// Find out which site has been requested through the site index
$reqsite=util_sitesindex_determine($_SERVER['SERVER_NAME']);

// Re-assign $site if a site has been determined
if($reqsite)
	$site=$reqsite;
/*
OLD SITE HANDLER
$sitename=$_SERVER['SERVER_NAME'];
if($sitename == 'jeffenmau.nl')
        $site="jeffenmauorg";
if($sitename == 'jeffenmau.com')
        $site="jeffenmauorg";
if($sitename == 'jeffenmau.org')
	$site="jeffenmauorg";
if($sitename == 'eventivity.nl')
	$site="jkmedianl";
if($sitename == 'feestmaal.eu' || $sitename == 'www.feestmaal.eu')
        $site="feasts";
if($sitename == 'test2.altcloud.net' || $sitename == 'weekendje.jeffenmau.nl' || $sitename == 'weekendje.jeffenmau.com' || $sitename == 'weekendje.jeffenmau.org')
        $site="jmw12";
*/

if(util_getarg('s')){
	$site=util_getarg('s');
}

// Include the proper siteconfig
require_once("sites/$site/siteconfig.php");

// Supplement the siteconfig with system site
require_once("sites/system/siteconfig.php");

// Connect to database using credentials from siteconfig
if(!data_connect())
	die("<h1>Could not connect to database for site $site.</h1>");

// Include addons as specified by siteconfig
if(!addons_include())
	die("<h1>Including addons failed for site $site</h1>");

// Debug Helpers
if(util_getarg('dumpctypes'))
	var_dump($contenttypes);
if(util_getarg('dumpbtypes'))
	var_dump($blocktypes);
if(util_getarg('dumplayouts'))
	var_dump($layouts);

// Define requested content, if it hasn't been overriden
if(!$hooks['attached']['objects']['node']['replace'])
	$node = node_get();
else
	$node = $hooks['attached']['objects']['node']['replace'];
	
// Render content using it's layout
layout_format($node);

?>
