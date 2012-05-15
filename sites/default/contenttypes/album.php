<?php
/* Helper to show thumbnails */
function album_thumbnail($item_cid,$title,$src){
	$o	="<div><img src=\"$src\" width=\"200\"><br>$title</div>";
	return $o;
}
?>

<h1><?php echo $node['title']; ?></h1>
<p>
	<strong>
	<?php echo $node['content']['description']; ?>
	</strong>
</p>

<?php
/* Get album items */
$parent_cid		=$node['content']['cid'];
$tablename=$tblprfx."content_albums_items";
$items['query']	="SELECT * FROM `$tablename` WHERE `parent_cid` = '$parent_cid';";
$items['result']=data_query($items['query']);

/* Print the thumbs */
foreach($items['result'] as $item){
	echo album_thumbnail($item['cid'],$item['title'],$item['src']);
}
?>