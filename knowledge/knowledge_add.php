<?php
if ($_GET['key'] != 'yXLeO6An3T') {
	die("You don't have permission to access this page. If you believe this is an error, ask Jack.");
}
?>
<h1>Add Knowledge Resource</h1>
<p>Please enter a table, locator (user id value for the selected table) and then indicate level of proficiency. Proficiency levels are:</p>
<ul>
	<li>1 - Beginner. Familiar with the subject, but have little experience.</li>
	<li>2 - Intermediate. Have experience in the subject, and skills that you are able to pass on to others.</li>
	<li>3 - Proficient. Have significant experience and competency in the subject. Could lead/teach instruction sessions to others.</li>
</ul>

<form action="http://pcsenegal.org/knowledge/knowledge_insert.php" method="post">
<fieldset style="margin: 25px;"><legend>Resource Information</legend>
	<table style="width: 500px; margin: 0 auto;">
		<tr>
			<td width="200px"><input type="text" name="table_name"></td>
			<td align="left">Table</td>
		</tr>
		<tr>
			<td><input type="text" name="locator"></td>
			<td>Locator</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</table>
</fieldset>

<fieldset style="margin: 25px;"><legend>Subject Areas (1, 2, or 3)</legend>

<?php
include('knowledgeTreeClass.inc');

$conn = mysql_connect('p50mysql131.secureserver.net', 'peacecorps', 'PeaceC0rps')
    or die("Impossible to connect : " . mysql_error());
mysql_select_db('peacecorps');

$tree = new knowledge_tree();
echo $tree->printTree('form');

mysql_close($conn);
?>

</fieldset>
<p style="text-align: center;"><input type="submit"></p>
</form>