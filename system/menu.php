<?php

function menu_arraytohtml($menuarray,$di=0,$selid=false){
	$o	="<ul class=\"level$di\" id=\"sel$selid\">\n";

	foreach($menuarray as $item){
		// FIXME: Check if menu item or submenu
			$sub="";
                        $href   =$item['href'];
                        $label  =$item['title'];
			$nid	=$item['nid'];

			if($item['items']){
			
				if($item['list_type'] == 'multi'){
					$subdi	=$di+1;
					$selid	=$item['sid'];
			         	$sub	=menu_arraytohtml($item['items'],$subdi,$selid);
					$subitem=$item['topnode'];
					$href   =$subitem['href'];
			                $label  =$subitem['title'];
				}elseif($item['list_type'] == 'flat'){
					foreach($item['items'] as $item){
						$href   =$item['href'];
						$label  =$item['title'];
						$nid    =$item['nid'];
						$o	.="<li class=\"level$di\" id=\"item-nid$nid\"><a href=\"$href\">$label</a>$sub</li>\n";
					}
				}
			}
			$o	.="<li class=\"level$di\" id=\"item-nid$nid\" $onover_attr><a href=\"$href\">$label</a>$sub</li>\n";
	}
	
	$o	.="</ul>\n";
	
	return $o;
}

?>
