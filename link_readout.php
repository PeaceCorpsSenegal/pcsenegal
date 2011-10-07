<html>
<head>
	<title>List Directory</title>
    <style type="text/css">
		.folder {
			color: red;
		}
		.file {
			color: black;
		}
	</style>
</head>
<body>
<?php 

	print '<table><thead><tr><th>Page</th><th>Link Address</th></tr></thead><tbody>';
getDirectory(urlencode($_GET['url']));
	print '</tbody></table>';
//getDirectory('case_studies');


function getDirectory( $path = '.', $level = 0 ){ 



	global $filecount, $foldercount;
    $ignore = array( 'cgi-bin', '.', '..' ); 
    // Directories to ignore when listing output. Many hosts 
    // will deny PHP access to the cgi-bin. 

    $dh = @opendir( $path ); // Open the directory to the handle $dh 
    
	//print '<ul style="list-style:none">';
	
    while( false !== ( $file = readdir( $dh ) ) ){  // Loop through the directory 
     
        if( !in_array( $file, $ignore ) ){ // Check that this file is not to be ignored 
             
            //$spaces = str_repeat( '&nbsp;', ( $level * 4 ) );   // Just to add spacing to the list, to better show the directory tree. 
             
            if( is_dir( "$path/$file" ) ){  // Its a directory, so we need to keep reading down... 
				
				//echo '<li class="folder"><h3>'.$path/$file.'</h1>';
                //echo "<strong>$spaces $file</strong><br />"; 
                getDirectory( "$path/$file", ($level+1) );  // Re-call this same function but on a new directory. this is what makes function recursive. 
             	//print '</li>';
            } else { 
             	
                // echo '<li class="file">'.$file.'</li>';  // Just print out the filename
				
				
				//  /<a\s[^>]*href=\"([^\"]*)\"[^>]*>(.*)<\/a>/siU
				$file_array = explode('.', $file);
				if ($file_array[1] == 'html' OR $file_array[1] == 'php') {
					$file_string = file_get_contents($path.'/'.$file) or die("Could not access file: $path/$file");
					$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
					if(preg_match_all("/$regexp/siU", $file_string, $matches, PREG_SET_ORDER)) {
						foreach($matches as $match) {
							print "<tr><td>$path/$file</td><td>$match[2]</td></tr>";
						}
					//echo '<pre>';
					//print_r($matches);
					//echo '</pre>';
					}
				}
            } 
         
        } 
     
    } 
	
	//print '</ul>';
     
    closedir( $dh );  // Close the directory handle 

} 


?>
</body>