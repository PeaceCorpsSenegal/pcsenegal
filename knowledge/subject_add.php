<html>
<head>
<title>Add Knowledge Subject</title>

</head>

<body>

<form action="subject_insert.php" method="post">
<fieldset><legend>Add Subject</legend>
<select name="parent">
	<option value="none">None</option>
	
	
	
	<?php

$conn = mysql_connect('p50mysql131.secureserver.net', 'peacecorps', 'PeaceC0rps')
    or die("Impossible to connect : " . mysql_error());
mysql_select_db('peacecorps');

$sql = "select subject, id from knowledge_subjects order by id desc";

$result = mysql_query($sql);
if (mysql_num_rows($result) >= 1) {
	while ($row = mysql_fetch_assoc($result)) {
		print '<option value="'.$row['id'].'">'.$row['subject'].'</option>';
	}
}
mysql_free_result($result);


mysql_close($conn);
?>
	
	
</select>
<input type="text" name="subject" maxlength="50">
<input type="submit">
</fieldset>
</form>




</body>
</html>