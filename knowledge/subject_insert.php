<?php

$conn = mysql_connect('p50mysql131.secureserver.net', 'peacecorps', 'PeaceC0rps')
    or die("Impossible to connect : " . mysql_error());
mysql_select_db('peacecorps');

$sql = "insert into knowledge_subjects set subject='$_POST[subject]'";
$result = mysql_query($sql);
$child = mysql_insert_id($conn);

if ($child == 0) {
	die('no subject was inserted');
}

if ($_POST['parent'] != 'none') {
	$parent = (int)$_POST['parent'];
	$sql = "insert into knowledge_collections set parent=$parent, child=$child";
	if (!$result = mysql_query($sql)) {
		die('error');
	}
}

mysql_close($conn);

header('Location: http://pcsenegal.org/knowledge/subject_add.php');


?>