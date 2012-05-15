<?php
function html_header($title=false){

	global $htmlincludes;

	$o ="<html>\n";
	$o.="\t<head>\n";
	$o.="\t\t<title>$title</title>\n";
	
	/* Append JS includes */
	if($htmlincludes['js'])
	foreach($htmlincludes['js'] as $js_include)
		$o.="\t\t<script type=\"text/javascript\" src=\"$js_include\"></script>\n";

	/* Append CSS includes */
	if($htmlincludes['css'])
	foreach($htmlincludes['css'] as $css_include)
		$o.="\t\t<LINK REL=StyleSheet HREF=\"$css_include\" TYPE=\"text/css\" MEDIA=screen>\n";
		
	$o.="\t</head>\n";
	$o.="\t<body>\n";

	return $o;
}

function html_footer(){

	$o ="\t</body>\n";
	$o.="</html>\n";

	return $o;
}
?>
