<html>
<head>
	<title>Directory Test</title>
	<style type="text/css">
		
	</style>
</head>
<body>

<?php

$call = $_GET['call'];

print '<table><thead><th>Status</th><th>Link Path</th><th>File</th><th>Link Contents</th></thead><tbody>';
$call($_GET['url']);
print "</tbody></table>";

$directorycount = 0;
$filecount = 0;

function getDirectory( $path = '.', $level = 0 ){ 
    $ignore = array( 'cgi-bin', '.', '..' );
    $dh = @opendir( $path ); // Open the directory to the handle $dh
    while( false !== ( $file = readdir( $dh ) ) )
    {  // Loop through the directory 
        if( !in_array( $file, $ignore ) )
	{ // Check that this file is not to be ignored 
            if( is_dir( "$path/$file" ) )
	    {  // Its a directory, so we need to keep reading down... 
                getDirectory( "$path/$file", ($level+1) );  // Re-call this same function but on a new directory. this is what makes function recursive. 
            }
	    else
	    {
		$file_array = explode('.', $file);
		print "$path/$file<br>";
            } 
         
        } 
     
    }
    closedir( $dh );  // Close the directory handle 
}

function getLinks( $path = '.', $level = 0 ){
	$ignore = array( 'cgi-bin', '.', '..' );
	$dh = @opendir( $path ); // Open the directory to the handle $dh
	while( false !== ( $file = readdir( $dh ) ) )
	{  // Loop through the directory
		if( !in_array( $file, $ignore ) )
		{ // Check that this file is not to be ignored
			if( is_dir( "$path/$file" ) )
			{  // Its a directory, so we need to keep reading down...
				getLinks( "$path/$file", ($level+1) );  // Re-call this same function but on a new directory. this is what makes function recursive.
			}
			else
			{
				$file_array = explode('.', $file);
				if ($file_array[1] == 'html' || $file_array[1] == 'php')
				{
					$file_string = file_get_contents($path.'/'.$file) or die("Could not access file: $path/$file");
					$regexp = '(<a[^>]+href="([^"]*)">)(.*?)<\/a>';
					if(preg_match_all("/$regexp/", $file_string, $matches, PREG_SET_ORDER))
					{
						foreach($matches as $match)
						{
							if (pingLink($match[2]))
							{
								$status = '<span style="color: green">OK</span>';
							}
							else
							{
								$status = '<span style="color: red">INVALID</span>';
							}
							print "<tr><td>$status</td><td>$match[1]$match[2]</a></td></td><td>$path/$file</td><td>$match[3]</td>";
							//echo '<pre>';
							//print_r($match);
							//echo '</pre>';
						}
					}
				}
			}
		} 
	}
	closedir($dh);  // Close the directory handle
}


function pingLink($domain){
	if (preg_match('/^\?page=/', $domain) == 1)
	{
		$domain = 'http://pcsenegal.org/index.php'.$domain;
	}
	elseif (preg_match('/^index.php\?page=/', $domain) == 1)
	{
		$domain = 'http://pcsenegal.org/'.$domain;
	}
    $file      = @fopen($domain,"r"); 
    $status    = false; 

    if (!$file) { 
       $status = false;  // Site is down 
    } 
    else { 
        $status = true; 
        fclose($file); 
    } 
    return $status; 
}

?>
</body>