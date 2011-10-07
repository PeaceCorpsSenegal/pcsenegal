<?php
$title = $_GET['title'];
print <<<EOF
<h1>$title</h1>
<div style="text-align:center; position:relative; z-index:0;">
<iframe title="YouTube video player" width="400" height="330" src="http://www.youtube.com/embed/$_GET[embed]?wmode=Opaque" frameborder="0" allowfullscreen></iframe>
</div>
EOF;

/*



<object width="400" height="330">
	<param name="movie" value="http://www.youtube.com/v/$_GET[embed]?fs=1&amp;hl=en_US"></param>
	<param name="allowFullScreen" value="true"></param>
	<param name="allowscriptaccess" value="always"></param>
	<param name="wmode" value="transparent">
	<embed src="http://www.youtube.com/v/v11nO32xJRM?fs=1&amp;hl=en_US" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="400" height="330" wmode="transparent"></embed>
</object>

*/

?>