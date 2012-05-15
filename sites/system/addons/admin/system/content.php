<?php
if($current_admin_authorization && $_POST['submit'] && $_POST['submit'] =='savecontent'){
	$nid		=$node['nid'];
	$content	=$node['content'];
	$cid            =$content['cid'];
	
	$contenttype	=$node['content_type'];
	$content_table	=$contenttypes[$contenttype]['table'];
	
	$fieldsQuery    ="SHOW COLUMNS FROM $content_table;";
	$fields			=data_query($fieldsQuery);
	
	$i      =1;
	$t      =count($fields);
	$error  =false;
	
	if($fields)
	foreach($fields as $field){
		$field=$field['Field'];
		if($field != "cid"){
			
			$postvalue      =$_POST[$field];
			$values[$field] =mysql_real_escape_string($postvalue);
			$query          .=sprintf("`%s` = '%s'",$field,$values[$field]);
			
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
}
?>