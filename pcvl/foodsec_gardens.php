<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>foodsec_gardens</title>
<style type="text/css">
body {
	font-family:Verdana, Geneva, sans-serif;
}
table td {
	border: 1px solid navy;
	padding: 5px;
}
</style>
</head>

<body>

<?

$link = mysql_connect('p50mysql131.secureserver.net', 'peacecorps', 'PeaceC0rps')
    or die("Impossible to connect : " . mysql_error());
	
mysql_select_db('peacecorps');

$sql = "select * from foodsec_gardens_data";
$result = mysql_query($sql);

while ($row = mysql_fetch_assoc($result)) {
	
	foreach ($row as $key => $value) {
		$table[$row['id']]['foodsec_gardens_data.'.$key] = $value;
	}
	
	$sql = "select id, name, type, status from foodsec_gardens_gardens where foodsec_gardens_gardens.id = $row[id]";
	$result2 = mysql_query($sql);
	while ($row2 = mysql_fetch_assoc($result2)) {
		foreach ($row2 as $key => $value) {
			$garden_id = $row2['id'];
			$table[$row['id']]['foodsec_gardens_gardens.'.$key] = $value;
		
		}
	}
	mysql_free_result($result2);
	$sql = "select volunteer_id from foodsec_gardens_gardeners where garden_id = $garden_id";
	$result2 = mysql_query($sql);
	while ($row2 = mysql_fetch_assoc($result2)) {
		$sql = "select lname, fname, region, project from people_volunteers where id = $row2[volunteer_id]";
		$result3 = mysql_query($sql);
		
		while($row3 =  mysql_fetch_assoc($result3)) {
			foreach ($row3 as $key => $value) {
				$table[$row['id']][$row2['volunteer_id']]['people_volunteers.'.$key] = $value;
			
			}
		}
		
		mysql_free_result($result3);
	}
	mysql_free_result($result2);
	
}
mysql_free_result($result);

$sql = "select
foodsec_gardens_data.id as DataID, 
foodsec_gardens_data.size as 'foodsec_gardens_data.size', 
foodsec_gardens_data.men, 
foodsec_gardens_data.women, 
foodsec_gardens_data.boys, 
foodsec_gardens_data.girls, 
foodsec_gardens_gardeners.volunteer_id as VolunteerID, 
people_volunteers.lname, 
people_volunteers.fname, 
people_volunteers.site, 
foodsec_gardens_data.modified 
from foodsec_gardens_data
left join foodsec_gardens_gardeners
on foodsec_gardens_data.garden_id = foodsec_gardens_gardeners.id
left join people_volunteers
on foodsec_gardens_gardeners.volunteer_id = people_volunteers.id";

$result = mysql_query($sql);
$field_count = mysql_num_fields($result);
$i = 0;
print '<table>';
while ($i < $field_count) {
	print '<th>'.mysql_field_name($result, $i++).'</th>';
}
while ($row = mysql_fetch_assoc($result)) {
	print '<tr>';
	foreach ($row as $key => $value) {
		print '<td class="'.$key.'">'.$value.'</td>';
	}
	print '</tr>';
}
print '</table>';



mysql_close($link);


function generateTable($array, $level = 0) {
	
print '<table>';
foreach ($array as $row) {
	print '<tr>';
	foreach ($row as $column => $value) {
		if (!is_array($value)) {
			print '<td>'.$value.'</td>';
		} else {
			generateTable($array[$column], $level+1);
		}
	}
	print '</tr>';
}
print '</table>';

}

generateTable($table);

print '<pre>';
print_r($new_array);
print '</pre>';

?>

</body>
</html>