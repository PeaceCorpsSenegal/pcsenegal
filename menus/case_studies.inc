<h3>Case Studies</h3>
<ul class="vmenu">
<?php

if ($handle = opendir('case_studies')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            $files[] = $file;
			//print $file;
        }
    }
    closedir($handle);
}

foreach ($files as $study) {
	$data = file_get_contents("case_studies/$study");
	
	print '<li><a href="">'.$study.'</a></li>';
}

?>

</ul>