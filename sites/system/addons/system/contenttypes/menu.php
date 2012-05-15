<?php

$selector=nodeselector_getselector($node['content']['sid']); 
$selection=nodeselector_getselection($selector);

echo menu_arraytohtml($selection);
?>
