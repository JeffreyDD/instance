<?php

$tablename	=$tblprfx."nodes";
$nodes_query	="SELECT * FROM `$tablename`;"; 
echo $tablename; $nodes_result	=data_query($nodes_query);

?>
<h1>Nodes</h1>
<table>
	<tr style="font-weight: strong;">
		<td>nid</td>
		<td>ref</td>
		<td>Title</td>
		<td>&nbsp;</td>
	</tr>
<?php
foreach($nodes_result as $node){
?>
	<tr>
		<td><?php echo $node['nid'];?></td>
		<td><?php echo $node['ref'];?></td>
		<td><a href="?nid=<?php echo $node['nid'];?>"><?php echo $node['title']; ?></a></td>
		<td><a href="?adm=node&nid=<?php echo $node['nid'];?>">Edit</a></td>
	</tr>
<?php
}
?>
</table>
