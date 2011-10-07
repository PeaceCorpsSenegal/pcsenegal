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