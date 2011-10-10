<h1>Results</h1>
<p>The following people have experience with the subject you're interested in. For information on how best to contact them, refer to the Peace Corps Senegal contact list.</p>

<p style="margin-top: 30px; margin-bottom: 30px;"><a href="?page=knowledge/knowledge_tree.php">Back to the tree view</a></p>
<h3><?php print $_GET['subject']; ?></h3>
<table style="width: 500px; margin: 0 auto;">
<thead>
	<tr style="border-bottom: 1px solid black;">
		<th style="border-bottom: 1px solid black;">Name</th>
		<th style="border-bottom: 1px solid black;">Position</th>
		<th style="border-bottom: 1px solid black;">Expertise</th>
	</tr>
</thead>
<tbody>

<?php

$conn = mysql_connect('p50mysql131.secureserver.net', 'peacecorps', 'PeaceC0rps')
    or die("Impossible to connect : " . mysql_error());
mysql_select_db('peacecorps');

$sql = "select knowledge_location.resource_locator, knowledge_location.knowledge_subject, knowledge_location.level, knowledge_repositories.table_name
from knowledge_location
left join knowledge_repositories
on knowledge_location.resource_location = knowledge_repositories.id
where knowledge_location.knowledge_subject = $_GET[id]";

$result = mysql_query($sql);
if (mysql_num_rows($result) >= 1) {
	while ($row = mysql_fetch_assoc($result)) {
		$result2 = mysql_query("select fname, lname, project from $row[table_name] where id = $row[resource_locator]");
		$person = mysql_fetch_assoc($result2);
		print '<tr><td>'.$person['fname'].' '.$person['lname'].'</td><td>'.$person['project'].'</td><td>'.$row['level'].'</td></tr>';
	}
} else {
	print "<p>Sorry, but we don't currently have anyone registered for the subject you're interested in.</p>";
}

mysql_close($conn);
?>

</tbody>
</table>

<p style="margin-top: 50px;"><a href="?page=knowledge/knowledge_tree.php">Back to the tree view</a></p>