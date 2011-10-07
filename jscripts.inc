<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<?php
if (isset($_GET['add']) && $_GET['add'] == 'tables') {
	print '
		<link rel="stylesheet" href="css/demo_table.css" type="text/css">
		<link rel="stylesheet" href="css/pcsenegal-jqueryui/jquery-ui-1.8.11.custom.css" type="text/css">
		<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>';
	if (isset($_GET['query'])) {
		$query = $_GET['query'];
	}
}
?>


<script type="text/javascript" src="js/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "main_container", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>


<script type="text/javascript" src="js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="js/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript">

	$(function() {
		
		$("a.gallery").attr('rel','this_page');
	
		/* Apply fancybox to multiple items */
		$("a.gallery, a.single, a.popup").fancybox({
			'hideOnContentClick': false,
			'showCloseButton': false,
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600, 
			'speedOut'		:	200, 
			'overlayShow'	:	true
		});
		
	})
</script>