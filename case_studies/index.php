<script type="text/javascript">

	$(function() {
			   
		$("table#dynamic").dataTable({
			"iDisplayLength": 50,
			"bJQueryUI": true,
			"aoColumns": [
				/* file */  { "bVisible": false },
				/* extension */   null,
				/* title */   null,
				/* tags */  { "bVisible":    false },
				/* author */    null,
				/* date */    null
			],
			"aoSearchCols": [
				null,
				null,
				null,
				{ "sSearch": "<?php print "$query"; ?>" },
				null,
				null
			]
		});
		
		var file;
		var file_path;
		$("table#dynamic a").each(addPath);
		function addPath () {
			file = $(this).attr("href");
			file_path = 'index.php?page=' + file;
			$(this).attr('href',file_path);
		}
		
	});

</script>


<H1>Case Studies</H1>

<p>The case studies below describe projects undertaken by volunteers, and attempt to give an analysis of the problem being adressed, how it was tackled, and the outcome. Case studies in particular sectors or regions are accessible via the <a href="index.php?page=sectors/index.html">sector</a> and <a href="index.php?page=regions/index.html">region</a> pages.</p>

<p>Use the search box to filter the case studies, or sort them by clicking on the column headers. All case studies will open in a new tab or window.</p>

<?php

/* Open a known directory, and proceed to read its contents
here you need to set the path to the file repository ($dir).
Make sure to end the path witha slash.
Also pass the location of the catalog.json file ($cat) */

$dir = 'case_studies/';
$cat = 'case_studies/catalog.json';

// then include the .php file to generate the html, which the javascript above will turn into the nifty table you see.
include('generate_table.inc');

?>