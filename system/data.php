<?php

function data_connect(){
	
	global $sql;

	$connection	=mysql_connect($sql['server'], $sql['username'], $sql['password']);
	mysql_select_db($sql['database']);

	return $connection;
}

function data_query($query){

	$result	=mysql_query($query);
	
	$rownum	=mysql_num_rows($result);
	
	if($result == false){
		$result = mysql_error()."($query)";

	}elseif($rownum == 1){
		$return =mysql_fetch_assoc($result);
		$result=$return;
	}elseif($rownum > 1){
		$row =mysql_fetch_assoc($result);
			do{
				$return[]=$row;
			}while($row=mysql_fetch_assoc($result));
		$result=$return;
	}
	
	return $result;
}
?>
