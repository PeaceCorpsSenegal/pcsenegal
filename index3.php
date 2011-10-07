<?php




try {
	require_once('TemplateProcessor.php');

	// include 'MySQL' class files
	//require_once 'MySQLClass.php';
	//require_once('mysql_config.inc');
	
	// connect to MySQL
	//$db=new MySQL($mysql_init);
	
	// run SQL query
	//$result=$db->query('SELECT * FROM people_volunteers');
	
	// get query resource
	//$queryResult=$result->getQueryResource();
	
	
	
	
	
	
	// path to templates, needs trailing slash
	$path_to_theme = 'THEMES/eighthundred/';
	
	// path to cache, needs trailing slash
	$path_to_cache = 'CACHE/';
	
	// build array of page sections and assign expiration values for each cache file (chunked caching)
	$pageSections=array('head'=>2,'body'=>2);
	
	// build template tags
	$tags=array('head'=>array('headscript'=>'headscript.inc', 'phpmodules'=>'phpmodules.inc', 'stylesheets'=>'stylesheets.inc', 'jscripts'=>'jscripts.inc'), 'body'=>array('header'=>'header.inc', 'menu'=>'menu.inc', 'maincontent'=>$_GET['page'], 'footer'=>'footer.inc'));
	
	// instantiate template processor object
	// pass $tags to replace, $pageSections to cache (should match the template pages), and locations of templates and cache
	$tpl=new TemplateProcessor($tags,$pageSections, $path_to_theme, $path_to_cache);
	
	// display parsed page
	echo $tpl->getHTML();
}
catch(Exception $e){
	echo $e->getMessage();
	exit();
}

?>