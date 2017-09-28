<?php
require_once 'include/config.php';

$conn = new mysqli($hostname, $username, $password, $database);

$route_short_name = 009;
$query = "SELECT trip_id FROM trips WHERE route_id in (SELECT route_id FROM routes WHERE route_short_name = '{$route_short_name}')";


$result = $conn->query($query);
$rows = $result->num_rows;
for ($j = 0; $j < $rows; ++$j)	{
	$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	echo "<br>";
	var_dump($row);
	//print $row["route_long_name"];
	echo "<br>";
	//print $row["route_id"];
	echo "<br>";
	//print $row["route_long_name"];
	
	}
/*
$query = "SELECT * FROM routes";
$result = $conn->query($query);
$rows = $result->num_rows;
for ($j = 0; $j < $rows; ++$j) {
	$result->data_seek($j);
	$row = $result->fetch_array(MSQLI_ASSOC);
	var_dump($row);
	}
*/
//$data = 'json';
//$data["entity"];

/*
foreach jsl 
	if jsl["vehicle"]["trip"]["route_id"] == routeid
		lkfjslkdfj
*/


?>