<?php

if ($handle = opendir('../slides/')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            $files[] = $file;
        }
    }
    closedir($handle);
}

$key = array_rand($files, 1);

include('../slides/'.$files[$key]);
?>