<?php

function nodeselector_getselection($selector){
	global $tblprfx, $contenttypes;

	/* Some vars being set */
	$contenttype		=$selector['content_type'];
	$nid				=$selector['nid'];
	$ref				=$selector['ref'];
	$node_query			=$selector['node_query'];
	$content_query		=$selector['content_query'];
	$tablename			=$tblprfx."nodes";
	
	/* Check if a content query is specified, if so, get matching nodes */
	if($content_query != ''){
		$content_type_table	=$contenttypes[$contenttype]['table'];
		$content_query		="SELECT * FROM `$content_type_table` WHERE $content_query;";
		$content_result		=data_query($content_query);
		
		// Debugging
		if(util_getarg('dumpnodequeries'))
			var_dump($content_query);		
		if(util_getarg('dumpnodes'))
			var_dump($content_result);
			
		foreach($content_result as $result){
			$newresult['content_type']	=$contenttype;
			$newresult['content_ref']	=$result['cid'];
			$results[]					=$newresult;
		}
		$result_count	=count($results);
		$i				=1;
		$node_query		="";
		foreach($results as $result){
			$result_type	 =$result['content_type'];
			$result_ref	 	 =$result['content_ref'];
			$node_query		.="`content_type` = '$result_type' AND `content_ref` = '$result_ref'";
			if($i < $result_count){
				$node_query		.=" OR ";
			}else{
				$node_query		.=";";
			}
			$i++;
		}
	}
	
	/* 
	 * Check if a node query is specified, if so, use this to select nodes directly,
	 * If not, use the values set in content_type, nid and ref.
	 */
	if($node_query !=''){
		$selection_query	="SELECT * FROM `$tablename` WHERE $node_query;";
	}else{
		$selection_query	="SELECT * FROM `$tablename` WHERE `content_type` LIKE '$contenttype' AND `nid` LIKE '$nid' AND `ref` LIKE '$ref';";
	}
	$selection_result	=data_query($selection_query);
	if($selection_result){
		if($selection_result['nid'] == false){
			$selection_num=count($selection_result);
		}else{
			$new_selection_result[]=$selection_result;
			$selection_result=$new_selection_result;
		}
	}
	
	// Debugging
	if(util_getarg('dumpnodequeries'))
			var_dump($selection_query);
	if(util_getarg('dumpnodes'))
			var_dump($selection_result);

	foreach($selection_result as $item){
		$node_item['nid']=$item['nid'];
		$node_item['ref']=$item['ref'];
		$node_item['title']=$item['title'];
		$node_item['href']="?ref=".$item['ref'];
		$selection[]=$node_item;
	}
	
	/* Get child nodeselectors, and append as subselectors */
        $selector_tablename     =$tblprfx."nodeselectors";
	$selector_sid		=$selector['sid'];
	$subselectors_query	="SELECT * FROM `$selector_tablename` WHERE `parent_sid` = '$selector_sid';";
	$subselectors		=data_query($subselectors_query);

	$subselectors_num	=count($subselectors);
	if($subselectors['sid']){
		/* One subselector found */
		$subselection		=$subselectors;
		$subselection['items']	=nodeselector_getselection($subselectors);
		if($subselectors['list_type'] == 'multi'){
			$topnode['nid']=$item['nid'];
			$topnode['ref']=$item['ref'];
			$topnode['title']=$item['title'];
			$topnode['href']="?ref=".$item['ref'];

			$subselection['topnode']=$topnode;
		}
		$selection[]            =$subselection;	
	}elseif($subselectors_num > 1){
		/* Multiple subselectors found */
        	foreach($subselectors as $subselector){
	                $subselection           =$subselector;
	                $subselection['items']  =nodeselector_getselection($subselector);
					
					$item=node_get(false,$subselector['nid']);

					if($subselector['list_type'] == 'multi'){					
						$topnode['nid']=$item['nid'];
						$topnode['ref']=$item['ref'];
						$topnode['title']=$item['title'];
						$topnode['href']="?ref=".$item['ref'];
			
						$subselection['topnode']=$topnode;
					}
	                $selection[]            =$subselection;
			}
    }else{
		/* No subselectors found */
    }

	if(util_getarg('dumpselections'))
        	var_dump($selection);

	// FIXME: Sort the items in this selector

	return $selection;
}

function nodeselector_getselector($sid){
	global $tblprfx;

	$tablename			=$tblprfx."nodeselectors";
	$selector_query		="SELECT * FROM `$tablename` WHERE `sid` = '$sid';";
	$selector_result	=data_query($selector_query);
	
	return $selector_result;
}

?>
