<?php
$selector=nodeselector_getselector($node['content']['sid']); 
$selection=nodeselector_getselection($selector);

$contenttype=$selector['content_type'];

foreach($selection as $item){
	if($contenttypes[$contenttype]['override']['list'])
		$althandler	=$contenttypes[$contenttype]['override']['list'];
	
	$item_node=node_get(false,$item['nid']); echo node_format($item_node,$althandler);
}
?>
