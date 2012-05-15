<?php
$nid=$node['nid'];

$node_result=array();
if($nid){
	$nodetable	=$tblprfx."nodes";
	$node_query	="SELECT * FROM `$nodetable` WHERE `nid` = '$nid';"; 
	$node_result	=data_query($node_query);
}

if($_POST['submit'] && $_POST['submit'] !=''){

        /* order detail status is not yet OK, show a form to let the client enter the order details */
        $fields =array('ref','title','content_type','content_ref','layout');

                $i      =1;
                $t      =count($fields);
                $error  =false;
                foreach($fields as $field){
                        $postvalue      =$_POST[$field];
                                $values[$field] =$postvalue;
                                $tablevalue     =htmlentities($postvalue);
                                $query          .="`$field` = '$tablevalue'";
                                if($i<$t)
                                        $query  .=",";
                        $i++;
                }
		if($nid){
	                $query  ="UPDATE `$nodetable` SET $query WHERE `nid` = '$nid';";
        	}else{
			$query	="INSERT INTO `$nodetable` SET $query ;";
	        }
		$result=data_query($query);
}

?>
<h1>Edit Node</h1>
<form method="post">
<table>
	<tr>
		<td class="header">nid:</td>
		<td><input type="text" name="nid" value="<?php echo $node_result['nid']; ?>" disabled></td>
	</tr>
	<tr>
		<td class="header">ref:</td>
		<td><input type="text" name="ref" value="<?php echo $node_result['ref']; ?>"></td>
	</tr>
	<tr>
		<td class="header">title:</td>
		<td><input type="text" name="title" value="<?php echo $node_result['title']; ?>"></td>
	</tr>
	<tr>
		<td class="header">content_type:</td>
		<td><input type="text" name="content_type" value="<?php echo $node_result['content_type']; ?>"></td>
	</tr>
	<tr>
		<td class="header">content_ref:</td>
		<td><input type="text" name="content_ref" value="<?php echo $node_result['content_ref']; ?>"></td>
	</tr>
        <tr>
                <td class="header">layout:</td>
                <td><input type="text" name="layout" value="<?php echo $node_result['layout']; ?>"></td>
        </tr>
</table>
<button type="submit" name="submit" value="save">Save</button>
</form>

