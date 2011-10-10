<?php
require('../phpsqlajax_dbinfo.inc');

// Opens a connection to a MySQL server.

$connection = mysql_connect ($server, $username, $password);

if (!$connection) 
{
  die('Not connected : ' . mysql_error());
}
// Sets the active MySQL database.
$db_selected = mysql_select_db($database, $connection);

if (!$db_selected) 
{
  die('Can\'t use db : ' . mysql_error());
}

// Selects all the rows in the markers table.
$query = 'select * from location_pairing
inner join location_sites
on location_pairing.site_id = location_sites.id
inner join people
on location_pairing.person_id = people.id';
$result = mysql_query($query);

if (!$result) 
{
  die('Invalid query: ' . mysql_error());
}

// Creates the Document.
$dom = new DOMDocument('1.0', 'UTF-8');

// Creates the root KML element and appends it to the root document.
$node = $dom->createElementNS('http://earth.google.com/kml/2.1', 'kml');
$parNode = $dom->appendChild($node);

// Creates a KML Document element and append it to the KML element.
$dnode = $dom->createElement('Document');
$docNode = $parNode->appendChild($dnode);

// Creates the two Style elements, one for restaurant and one for bar, and append the elements to the Document element.
$restStyleNode = $dom->createElement('Style');
$restStyleNode->setAttribute('id', 'WaterStyle');
$restIconstyleNode = $dom->createElement('IconStyle');
$restIconstyleNode->setAttribute('id', 'waterIcon');
$restIconNode = $dom->createElement('Icon');
$restHref = $dom->createElement('href', 'http://pcsenegal.org/water_sanitation/ico_water.png');
$restIconNode->appendChild($restHref);
$restIconstyleNode->appendChild($restIconNode);
$restStyleNode->appendChild($restIconstyleNode);
$docNode->appendChild($restStyleNode);

$barStyleNode = $dom->createElement('Style');
$barStyleNode->setAttribute('id', 'SanitationStyle');
$barIconstyleNode = $dom->createElement('IconStyle');
$barIconstyleNode->setAttribute('id', 'sanitationIcon');
$barIconNode = $dom->createElement('Icon');
$barHref = $dom->createElement('href', 'http://pcsenegal.org/water_sanitation/ico_sanitation.png');
$barIconNode->appendChild($barHref);
$barIconstyleNode->appendChild($barIconNode);
$barStyleNode->appendChild($barIconstyleNode);
$docNode->appendChild($barStyleNode);

// Iterates through the MySQL results, creating one Placemark for each row.
while ($row = @mysql_fetch_assoc($result)) {
	
  // Creates a Placemark and append it to the Document.

  $node = $dom->createElement('Placemark');
  $placeNode = $docNode->appendChild($node);

  // Creates an id attribute and assign it the value of id column.
  $placeNode->setAttribute('id', 'placemark' . $row['id']);

  // Create name, and description elements and assigns them the values of the name and address columns from the results.
  $nameNode = $dom->createElement('name', htmlentities($row['fname'].$row['lname'].$row['site_name']));
  $placeNode->appendChild($nameNode);
  $descNode = $dom->createElement('description', '');
  $placeNode->appendChild($descNode);
  $styleUrl = $dom->createElement('styleUrl', '#' . 'WaterStyle');
  $placeNode->appendChild($styleUrl);

  // Creates a Point element.
  $pointNode = $dom->createElement('Point');
  $placeNode->appendChild($pointNode);

  // Creates a coordinates element and gives it the value of the lng and lat columns from the results.
  $coorStr = round($row['lng'], 1).','.round($row['lat'], 1);
  $coorNode = $dom->createElement('coordinates', $coorStr);
  $pointNode->appendChild($coorNode);
}

$kmlOutput = $dom->saveXML();
header('Content-type: application/vnd.google-earth.kml+xml');
echo $kmlOutput;

/*
$handle = fopen('water_sanitation/water_sanitation_projects.kml','w+');
fwrite($handle, $kmlOutput);
fclose($handle);
*/

?>