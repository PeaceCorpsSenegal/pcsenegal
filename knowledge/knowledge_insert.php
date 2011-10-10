<?php

$conn = mysql_connect('p50mysql131.secureserver.net', 'peacecorps', 'PeaceC0rps')
    or die("Impossible to connect : " . mysql_error());
mysql_select_db('peacecorps');

//print_r($_POST);


$sql = "select * from knowledge_repositories where table_name like '$_POST[table_name]'";
$result = mysql_query($sql);
if (mysql_num_rows($result) == 0) {
	$sql = "insert into knowledge_repositories set table_name='".(int)$_POST['table_name']."'";
	$result2 = mysql_query($sql);
	$repository_id = mysql_insert_id($result2);
	mysql_free_result($result2);
} else {
	$row = mysql_fetch_assoc($result);
	$repository_id = $row['id'];
}
mysql_free_result($result);

$locator = (int)$_POST['locator'];

foreach($_POST as $key => $value) {
	if ($key != 'table_name' && $key != 'locator' && $value != '') {
		$field = (int)$key;
		$level = (int)$value;
		$sql = "insert into knowledge_location set resource_location=$repository_id, resource_locator='$locator', knowledge_subject=$field, level=$level";
		$result = mysql_query($sql);
	}
}
/*
print '<pre>';
print_r($_POST);
print '</pre>';
print $repository_id;
*/
mysql_close($conn);

header('Location: http://pcsenegal.org?page=knowledge/knowledge_tree.php');
?>