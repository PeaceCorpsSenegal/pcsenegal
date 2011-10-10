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
<script type="text/javascript" src="http://pcsenegal.org/js/jquery-1.5.1.min.js"></script>
<script type="text/javascript">
	$(function(){
			   $("table tr.control td#new_entry").click(newBlankRow);
			   $("table tr.entry td").dblclick(openEdit);
			   });
	function newBlankRow() {
		var last_row = $(this).closest("tr");
		$(this).closest("tr").prev().clone('deepWithDataAndEvents').insertBefore(last_row).children('td').text('');
	}
	function openEdit() {
		var content = $(this).text();
		$(this).html('<input type="text">');
		$(this).children("input").val(content).focus().select().keyup(quickSearch);
		
	}
	function quickSearch() {
		var search_string = $(this).val();
		$.get('quick_search.php', search_string, listResults);
	}
	function listResults (data) {
		$("tr.control td").text(data);
	}
</script>
</head>

<body>

<?php

$link = mysql_connect('p50mysql131.secureserver.net', 'peacecorps', 'PeaceC0rps')
    or die("Impossible to connect : " . mysql_error());
	
mysql_select_db('peacecorps');

$sql = "select
foodsec_gardens_data.id as DataID, 
foodsec_gardens_gardens.name as 'Name', 
foodsec_gardens_gardens.type as 'Garden Type', 
foodsec_gardens_gardens.status as 'Garden Status', 
foodsec_gardens_data.size as 'Garden Size', 
foodsec_gardens_data.men as Men, 
foodsec_gardens_data.women as Women, 
foodsec_gardens_data.boys as Boys, 
foodsec_gardens_data.girls as Girls, 
foodsec_gardens_gardeners.volunteer_id as VolunteerID, 
people_volunteers.lname as 'Vol Last Name', 
people_volunteers.fname as 'Vol First Name', 
people_volunteers.site as Site, 
foodsec_gardens_data.modified as 'Last Modified' 
from foodsec_gardens_data
left join foodsec_gardens_gardeners
on foodsec_gardens_data.garden_id = foodsec_gardens_gardeners.id
left join people_volunteers
on foodsec_gardens_gardeners.volunteer_id = people_volunteers.id
left join foodsec_gardens_gardens
on foodsec_gardens_gardens.id = foodsec_gardens_data.garden_id;";



$result = mysql_query($sql);
$field_count = mysql_num_fields($result);
$i = 0;
print '<table>';
while ($i < $field_count) {
	print '<th>'.mysql_field_name($result, $i).'</th>';
	$i++;
}
while ($row = mysql_fetch_assoc($result)) {
	print '<tr class="entry">';
	foreach ($row as $key => $value) {
		print '<td class="'.$key.'">'.$value.'</td>';
	}
	print '</tr>';
}

print '<tr class="control"><td id="new_entry">New Entry</td><td colspan="'.--$field_count.'"></td></tr>';
print '</table>';



mysql_close($link);

?>

</body>
</html>