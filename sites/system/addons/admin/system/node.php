<?php
if($current_admin_authorization && $_POST['submit'] && $_POST['submit'] =='savenode'){
		$nid=$node['nid'];
		
		$node_result=array();
		if($nid){
			$nodetable	=$tblprfx."nodes";
			$node_query	="SELECT * FROM `$nodetable` WHERE `nid` = '$nid';"; 
			$node_result	=data_query($node_query);
		}

        $fields =array('ref','title','content_type','content_ref','layout');

        $i      =1;
        $t      =count($fields);
        $error  =false;
		
		if($fields)
        foreach($fields as $field){
                $postvalue      =$_POST[$field];
				$values[$field] =mysql_real_escape_string($postvalue);
				$query          .=sprintf("`%s` = '%s'",$field,$values[$field]);
						
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

$node_override=true;

?>

