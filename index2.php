<?php
if (!isset($_GET['page'])) {
	$_GET['page'] = 'home.html';
} else if (! file_exists($_GET['page'])) {
	$_GET['page'] = 'missing.html';
}
function menu_from_directory($directory, $when, $count) {
	if ($handle = opendir($directory)) {
    	while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && !is_dir($directory.$file)) {
				$file_contents = file_get_contents($directory.$file);
			
				$date_array = explode('"></time>', $file_contents);
				$date_file = explode('datetime="', $date_array[0]);
				$timestamp = strtotime($date_file[1]);
				if ($timestamp != '') {
					$title_array = explode('</h1>',$file_contents);
					$title = explode('h1>',$title_array[0]);
					$time = time();
					if ($when == 'past' && $timestamp < time()) {
						$event_array[$timestamp] = '<li><a href="index.php?page='.$directory.$file.'">'.$title[1]."</a></li>\n";
					} else if ($when == 'future' && $timestamp >= time()) {
						$event_array[$timestamp] = '<li><a href="index.php?page='.$directory.$file.'">'.$title[1]."</a></li>\n";
					}
				}
			}
		
		}
		krsort($event_array);
		
		$final_array = array_values($event_array);
		$i = 0;
		while ($i <= $count) {
			print $final_array[$i];
			$i++;
		}
	} else {
		print 'not a valid directory.';
	}
	closedir($handle);
	//print_r($final_array);
}
$query = '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verify-v1" content="pqS3h0PIIhMOoX2y4w/P1Z8qXQLcC5XQRQrBEXDr8WM=" />
<title>Peace Corps Senegal</title>

<link rel="stylesheet" href="css/leifur2.css" type="text/css">
<link rel="stylesheet" href="css/layout2.css" type="text/css">
<link rel="stylesheet" href="css/ddsmoothmenu-v.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

<link type="image/x-icon" href="img/favicon.ico" rel="icon"/>
<link type="image/x-icon" href="img/favicon.ico" rel="shortcut icon"/>


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


</head>
<body>

<div id="container">
	<div id="header">

    			<a href="index.php"><img id="logo_banner" src="img/pc_header_800_thin.jpg" border="0"/></a><br>
        		<img src="img/photo_strip_13Apr2011.jpg" />
    </div><!--END header-->
    <div id="col_left">


            
        	<div id="main_container" class="ddsmoothmenu-v">
  <ul id="nav" class="MenuBarVertical">
    <li><a href="index.php?page=home.html">Welcome</a></li>
    <li><a href="index.php?page=blog/index.html">Director's Blog</a></li>
    <li><a href="index.php?page=who_we_are/index.html">Who We Are</a>
    	<ul>
    		<li><a href="index.php?page=who_we_are/volunteers.html">Volunteers</a></li>
    		<li><a href="index.php?page=pcresponse/index.html">Peace Corps Response</a></li>
    		<li><a href="index.php?page=who_we_are/staff/index.html">Staff</a>
    			<ul>
    				<li><a href="index.php?page=who_we_are/staff/index.html">APCDs</a></li>
    				<li><a href="index.php?page=who_we_are/staff/support.html">Programming & Support</a></li>
    				<!--<li><a href="index.php?page=who_we_are/staff/medical.html">Medical</a></li>
    				<li><a href="index.php?page=who_we_are/staff/finance.html">Finance</a></li>
    				<li><a href="index.php?page=who_we_are/staff/it.html">IT</a></li>
    				<li><a href="index.php?page=who_we_are/staff/motor_pool.html">Motor Pool</a></li>-->
    			</ul></li>
    		<li><a href="index.php?page=contact_us.html">Contact Us</a></li>
    	</ul></li>
    <li><a href="index.php?page=what_we_do.html">What We Do</a>
      <ul>
      	<li><a href="index.php?page=regions/index.html">Where We Work</a>
        	<ul>
        		<li><a href="index.php?page=regions/dakar/index.html">Dakar</a></li>
        		<li><a href="index.php?page=regions/fatick/index.html">Fatick</a></li>
        		<li><a href="index.php?page=regions/kaffrine/index.html">Kaffrine</a></li>
        		<li><a href="index.php?page=regions/kaolack/index.html">Kaolack</a></li>
        		<li><a href="index.php?page=regions/kedougou/index.html">Kedougou</a></li>
        		<li><a href="index.php?page=regions/kolda/index.html">Kolda</a></li>
        		<li><a href="index.php?page=regions/louga/index.html">Louga</a></li>
        		<li><a href="index.php?page=regions/north/index.html">Northern Senegal</a></li>
        		<li><a href="index.php?page=regions/tamba/index.html">Tambacounda</a></li>
        		<li><a href="index.php?page=regions/thies/index.html">Thies</a></li>
            </ul></li>
      	<li><a href="index.php?page=sectors/index.html">Sectors</a>
        	<ul>
        		<li><a href="index.php?page=sectors/agfo/index.html">Agroforestry</a></li>
        		<li><a href="index.php?page=sectors/ecot/index.html">Ecotourism</a></li>
        		<li><a href="index.php?page=sectors/ee/index.html">Environmental Education</a></li>
        		<li><a href="index.php?page=sectors/he/index.html">Health</a>
        			<ul>
        				<li><a href="http://pcsenegal.org/index.php?page=malaria/index.html">PC Senegal & Malaria</a></li>
        				<li><a href="http://pcsenegal.org/index.php?page=malaria/malarious.html">Malarious</a></li>
            		</ul></li>
        		<li><a href="index.php?page=sectors/sed/index.html">Small Ent. Development</a>
        	<ul>
        		<li><a href="index.php?page=sectors/sed/artisan/index.html">Artisan Network</a></li>
            </ul></li>
        		<li><a href="index.php?page=sectors/susag/index.html">Sustainable Rural Agriculture</a></li>
        		<li><a href="index.php?page=sectors/uag/index.html">Urban Agriculture</a></li>
        	</ul></li>
        <li><a href="index.php?page=food_security/index.html">USAID Food Security</a>
        	<ul>
        		<li><a href="index.php?page=food_security/index.html">Overview</a></li>
        		<li><a href="index.php?page=food_security/docs.html">Documents</a></li>
        		<li><a href="index.php?page=food_security/farmers.html">Farmers</a></li>
        		<li><a href="index.php?page=food_security/gardens.html">Gardens</a></li>
        		<li><a href="index.php?page=food_security/markets.html">Markets</a></li>
        		<li><a href="index.php?page=food_security/moringa.html">Moringa</a></li>
        		<li><a href="index.php?page=food_security/nutrition.html">Nutrition</a></li>
        		<li><a href="index.php?page=food_security/papa.html">PAPA</a></li>
        		<li><a href="index.php?page=food_security/permaculture.html">Permaculture</a></li>
        		<li><a href="index.php?page=food_security/projects.html">Projects</a></li>
        		<li><a href="index.php?page=food_security/weekly_update.html">Weekly Update</a></li>
            </ul></li>
        <li><a href="index.php?page=secondary_proj/index.html">Secondary Projects</a>
        	<ul>
        		<li><a href="index.php?page=apptech/index.html">Appropriate Technologies</a>
        			<ul>
        				<li><a href="index.php?page=apptech/briquette_press.html">Briquette Press</a></li>
        				<li><a href="index.php?page=apptech/fruitdrier.html">Fruit Drier</a></li>
        				<li><a href="index.php?page=apptech/stovetec.html">Improved Stoves</a></li>
        				<!--<li><a href="index.php?page=apptech/rope_pump.html">Rope Pump</a></li>
        				<li><a href="index.php?page=apptech/treadle_pump.html">Treadle Pump</a></li>-->
        				<li><a href="index.php?page=apptech/uns.html">Universal Nut Sheller</a></li>
        			</ul></li>
        		<li><a href="index.php?page=gad/index.html">Gender and Development</a>
        			<ul>
        				<li><a href="http://senegad.pcsenegal.org" target="_blank">SeneGAD</a></li>
        				<li><a href="http://ccc.pcsenegal.org" target="_blank"><em>Camp de Connaissance et Croissance</em></a></li>
        			</ul></li>
        		<li><a href="index.php?page=radio/index.html">Radio Production</a>
        			<ul>
        				<li><a href="index.php?page=radio/shows/index.html">Shows</a></li>
        				<li><a href="index.php?page=radio/stations/index.html">Stations</a>
        					<ul>
        						<li><a href="index.php?page=radio/stations/linguere.html">Aida FM (Linguere)</a></li>
        						<li><a href="index.php?page=radio/stations/saraya.html">Giggi Sembe (Kedougou)</a></li>
        						<li><a href="index.php?page=radio/stations/soukouta.html">Radio Niombato (Fatick)</a></li>
        					</ul></li>
        			</ul></li>
      	</ul></li>
        <li><a href="index.php?page=pcresponse/index.html">Peace Corps Response</a></li>
        	<li><a href="http://pcsenegal.org/index.php?page=resources.php&add=tables&tags=case_study">Case Studies</a></li>
      </ul></li>
    <li><a href="index.php?page=about_senegal/index.html">About Senegal</a>
   	<!--<ul>
        <li><a href="index.php?page=about_senegal/history.html">History</a></li>
        <li><a href="index.php?page=about_senegal/culture.html">Culture</a></li>
        <li><a href="index.php?page=about_senegal/cuisine.html">Cuisine</a></li>
        <li><a href="index.php?page=resources/language/language.html">Language</a></li>
      </ul>--></li>
    <li><a href="index.php?page=collaboration/index.html">Collaboration</a>
		<ul>
			<li><a href="index.php?page=collaboration/orgs/against_malaria.html">Against Malaria</a></li>
			<li><a href="index.php?page=collaboration/orgs/app_proj.html">Appropriate Projects</a></li>
			<li><a href="index.php?page=collaboration/orgs/cpi.html">Counterpart International</a></li>
			<li><a href="index.php?page=collaboration/orgs/malaria_no_more.html">Malaria No More</a></li>
			<li><a href="index.php?page=collaboration/orgs/oxfam.html">Oxfam America</a></li>
			<li><a href="index.php?page=collaboration/orgs/right_to_sight.html">Right to Sight and Health</a></li>
			<li><a href="index.php?page=collaboration/orgs/seeds.html">SEEDS</a></li>
			<li><a href="index.php?page=collaboration/orgs/tostan.html">Tostan</a></li>
			<li><a href="index.php?page=collaboration/orgs/tftf.html">Trees for the Future</a></li>
			<li><a href="index.php?page=collaboration/orgs/usaid.html">USAID</a>
            	<ul>
                	<li><a href="index.php?page=food_security/index.html">Food Security Project</a></li>
                </ul></li>
		</ul></li>
    <li><a href="index.php?page=resources/language/index.html">Language</a>
      <ul>
        <li><a href="index.php?page=resources/language/french/index.html">French</a></li>
        <li><a href="index.php?page=resources/language/bassari/index.html">Bassari</a></li>
        <li><a href="index.php?page=resources/language/mandinka/index.html">Mandinka</a></li>
        <li><a href="index.php?page=resources/language/pulaar/index.html">Pulaar</a></li>
        <li><a href="index.php?page=resources/language/sereer/index.html">Sereer</a></li>
        <li><a href="index.php?page=resources/language/wolof/index.html">Wolof</a></li>
      </ul></li>
    <li><a href="http://pcsenegal.org/index.php?page=resources/index.html">Resources</a>
      <ul>
        <li><a href="index.php?page=resources/events/upcoming.php">Upcoming Events</a>
			<ul>
        		<?php
        			print "\n";
        			menu_from_directory('resources/events/','future',4);
        		?>
        		</ul></li>
        <li><a href="index.php?page=resources/events/recent.php">Recent Events</a>
        	<ul>
        		<?php
        			print "\n";
        			menu_from_directory('resources/events/','past',4);
        		?>
        	</ul></li>
        <li><a href="http://pcsenegal.org/index.php?page=resources/howto/index.html">How-To Videos & Transcripts</a>
        		<ul>
        			<li><a href="http://pcsenegal.org/index.php?page=resources/howto/beekeeping.html">Beekeeping</a></li>
        			<li><a href="http://pcsenegal.org/index.php?page=resources/howto/gardening.html">Gardening</a></li>
        			<li><a href="http://pcsenegal.org/index.php?page=resources/howto/live_fencing.html">Live Fencing</a></li>
        			<li><a href="http://pcsenegal.org/index.php?page=resources/howto/mango_grafting.html">Mango Grafting</a></li>
        			<li><a href="http://pcsenegal.org/index.php?page=resources/howto/moringa.html">Moringa</a></li>
        			<li><a href="http://pcsenegal.org/index.php?page=resources/howto/seed_storage.html">Seed Storage</a></li>
        		</ul></li>
        <li><a href="index.php?page=radio/index.html">Radio</a>
        		<ul>
        			<li><a href="index.php?page=radio/shows/index.html">Archived Shows</a></li>
        			<li><a href="index.php?page=resources.php&add=tables&tags=radio">Scripts / Transcripts</a></li>
        		</ul></li>
        <li><a href="http://youtube.com/user/pcsenegaladmin/" target="_blank">PC/Senegal Youtube Channel</a></li>
        <li><a href="http://pcsenegal.org/index.php?page=resources.php&add=tables&tags=case_study">Case Studies</a></li>
        <li><a href="http://pcsenegal.org/index.php?page=resources.php&add=tables">Library</a></li>
      </ul></li>
    <li><a href="index.php?page=donate.html">Donate</a></li>
    <li><a href="http://pcv.pcsenegal.org">For Volunteers</a>
        		<ul>
        			<li><a href="index.php?page=pcv/index.html">PCVs</a>
						<ul>
							<li><a href="index.php?page=pcv/funding/index.html">Funding</a></li>
							<li><a href="index.php?page=pcv/calendars/index.html">Calendars</a>
                            	<ul>
									<!--<li><a href="index.php?page=pcv/calendars/ndioum.html">Ndioum</a>
									<li><a href="index.php?page=pcv/calendars/kolda.html">Kolda</a>-->
									<li><a href="index.php?page=pcv/calendars/pape.html">Pape (Tamba / Kedougou)</a>
									<li><a href="index.php?page=pcv/calendars/index.html">PC Senegal</a>
									<!--<li><a href="index.php?page=pcv/calendars/regional.html">Regional</a>
									<li><a href="index.php?page=pcv/calendars/staff_calendar.html">Staff</a>
									<li><a href="index.php?page=pcv/calendars/tamba.html">Tamba</a>-->
									<li><a href="index.php?page=pcv/calendars/training.html">Training</a>
                                </ul></li>
						</ul></li>
        			<li><a href="http://pcvl.pcsenegal.org" target="_blank">PCVLs</a>
                            	<ul>
									<li><a href="http://pcvl.pcsenegal.org/adminer/?server=p50mysql131.secureserver.net" target="_blank">Adminer</a>
                                </ul></li>
        			<!--<li><a href="">RPCVs</a></li>-->
        			<li><a href="http://invitee.pcsenegal.org">Invitees</a></li>
        		</ul></li>
  </ul>  
 
</div>



<!-- Search Google -->

<FORM method=GET action="http://www.google.com/search">
<input type=hidden name=ie value=UTF-8>
<input type=hidden name=oe value=UTF-8>
<p align="center">
<INPUT TYPE=text name=q size=15 maxlength=200 value="">
<INPUT type=submit name=btnG VALUE="Google Search">
</p>

<input type=hidden name=domains value="http://pcsenegal.org"><br>
<input type=hidden name=sitesearch value="http://pcsenegal.org" checked><br>

</FORM>

<!--END Search Google -->

	</div><!--END left_col-->
	<div id="col_right">
    	<span id="dynamically_loaded">

			<?php include($_GET['page']); ?>

		</span>
		
    	<div align="center" style="margin-top: 30px;">
		<iframe align="middle" src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fpcsenegal.org%2F<?php print urlencode($_GET['page']); ?>&amp;send=true&amp;layout=standard&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font=verdana&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true">
		</iframe>
		</div>

		<hr />

		<p align="center">
			<a href="index.php">Home</a> | <a href="http://peacecorps.gov" target="_blank">PeaceCorps.gov</a> | <a href="?page=contact_us.html">Contact Us</a> | <a class="popup" href="disclaimer.html">Disclaimer</a>
		</p>
		
		<p align="center">
    		<a href="http://twitter.com/hedrickchris" target="_blank"><img src="img/twitter.gif" border="0" /></a>
    	</p>


	</div><!--END col_right-->
    <div id="footer">
    	<img id="logo_footer" src="img/photo_strip.jpg" />
    </div><!--END footer-->
</div><!--END container-->

<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
	try {
		var pageTracker = _gat._getTracker("UA-12649260-1");
		pageTracker._trackPageview();
	} catch(err) {}
</script>

</body>
</html>
