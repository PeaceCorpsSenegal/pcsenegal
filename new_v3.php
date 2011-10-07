<?php

if (!isset($_GET['page']) && $_COOKIE['splash'] == 0) {
	setcookie('splash',1);
	header('Location: http://pcsenegal.org/splash.php');
} elseif (!isset($_GET['page'])) {
	$page = 'v3_home.html';
} else {
	$page = $_GET['page'];
}



$page_temp = explode('.', $page);
$page_title = $page_temp[0];

$path_array = explode('/', $page);

$controller_array = array('case_studies' => 'menus/case_studies.inc');
if (array_key_exists($path_array[0], $controller_array)) {
	$aux = $controller_array[$path_array[0]];
}

$topmenu = 'menus/v3_topmenu.inc';
$sidemenu = 'menus/v3_sidemenu_default.inc';		 
//$aux = 'v3_news.inc';
$aux2 = 'v3_links.inc';

try {
	require_once('TemplateProcessor.php');
	
	// path to templates, needs trailing slash
	$path_to_theme = 'THEMES/v3/';
	
	// path to cache, needs trailing slash
	$path_to_cache = 'CACHE/';
	
	// build array of page sections and assign expiration values for each cache file (chunked caching)
	$pageSections=array('head'=>2,'body'=>2);
	
	// build template tags
	$tags=array('head'=>array('page_title' => $page_title, 'theme'=>'theme'), 'body'=>array('site_header'=>'v3_header.inc', 'slidebox' => "$topmenu", 'titlebox' => 'min_titlebox_generator.inc', 'menu' => "$sidemenu", 'content' => "$page", 'aux' => "$aux", 'aux2' => "$aux2", 'footer' => 'min_footer.inc', 'footbox' => 'min_footbox.inc', 'searchbox' => 'google_search.inc', 'social' => 'social.inc'));
	
	// instantiate template processor object
	// pass $tags to replace, $pageSections to cache (should match the template pages), and locations of templates and cache
	$tpl=new TemplateProcessor($tags, $pageSections, $path_to_theme, $path_to_cache);
	
	// display parsed page
	echo $tpl->getHTML();
}
catch(Exception $e){
	echo $e->getMessage();
	exit();
}

?>
