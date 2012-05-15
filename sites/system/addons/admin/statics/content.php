<?php
$nid		=$node['nid'];
$content	=$node['content'];
$cid            =$content['cid'];

$contenttype	=$node['content_type'];
$content_table	=$contenttypes[$contenttype]['table'];
$fieldsQuery    ="SHOW COLUMNS FROM $content_table;";
$fields		=data_query($fieldsQuery);


if($_POST['submit'] && $_POST['submit'] !=''){
                $i      =1;
                $t      =count($fields);
                $error  =false;
                foreach($fields as $field){
			$field=$field['Field'];
			if($field != "cid"){
								$postvalue      =$_POST[$field];
                                $values[$field] =htmlentities(addslashes($postvalue));
                                $query          .="`$field` = '$postvalue'";
                                if($i<$t)
                                        $query  .=",";
			}
                        $i++;
                }
		if($nid){
	                $query  ="UPDATE `$content_table` SET $query WHERE `cid` = '$cid';";
        	}else{
			$query	="INSERT INTO `$content_table` SET $query ;";
	        }
		$result=data_query($query);
		var_dump($query);
}

?>
<h1>Edit Node Content</h1>
<form method="post">
<table>
<?php foreach($fields as $field){ 
$fieldname=$field['Field'];
?>
	<tr>
		<td class="header"><?php echo $fieldname; ?>:</td>
		<td><textarea name="<?php echo $fieldname; ?>" <?php if($fieldname == "cid") echo "disabled"; ?>><?php echo $content[$fieldname]; ?></textarea></td>
	</tr>
<?php } ?>
</table>
<button type="submit" name="submit" value="save">Save</button>
</form>

