<?php
// this is a download generator. Point the link to download.php?file='___insert filename here___'



// filetype options are: pdf, video, image, other. Good luck. Questions? Ask Jack.
$file = $_GET['file'];
if (! isset($_GET['extension'])) {
	$farray = explode('.',$file);
	$extension = $farray[1];
} else {
	$extension = $_GET['extension'];
}

if ($extension == 'html' OR $extension == 'php') {
	header("Location: http://pcsenegal.org/index.php?page=$file");
	die;
} else {
switch ($extension) {
	case 'pdf':
		$type = 'application/pdf';
		break;
	case 'video':
		$type = 'video';
		break;
	case 'jpg':
		$type = 'image';
		break;
	case 'youtube':
		$title = urlencode($_GET['title']);
		header("Location: http://pcsenegal.org/index.php?page=youtube.php&embed=$_GET[embed]&title=$title");
		die;
	default:
		$type = 'application';
		break;
	break;
}
header("Content-disposition: attachment; filename=$file");
header("Content-type: $type");
readfile($file);
}
?>