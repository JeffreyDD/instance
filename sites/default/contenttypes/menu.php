<?php

$selector=nodeselector_getselector($node['content']['sid']); 
$selection=nodeselector_getselection($selector);

echo "<ul>\n";

foreach($menuarray as $item){
	$href   =$item['href'];
	$label  =$item['title'];
	echo "<li><a href=\"$href\">$label</a></li>\n";
}

echo "</ul>\n";

?>
