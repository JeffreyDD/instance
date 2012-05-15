<?php

function hooks_get($universe,$target,$pos='pre'){

	global $hooks;

	$attached_hooks	=$hooks['attached'][$universe][$target][$pos];

	if(is_array($attached_hooks))
	foreach($attached_hooks as $atHook){
			
		$hook	=$hooks['defined'][$atHook];
		
		if($hook['string']){
			$string=$hook['string'];
			$return=eval("<?php echo \"$string\"; ?>");
			echo $return;
		}elseif($hook['file']){
            $return=$hook['file'];
            echo $return;
        }elseif($hook['node']){
            var_dump($hook['node']);
        }else{
			echo "Hooks can only be defined from string currently";
		}
	}

	return $return;
}

?>
