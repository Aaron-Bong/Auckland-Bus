<?php // query.php
	require_once 'include/config.php';
	require_once 'requests.php';
	$arr = array();
	
	$route_short_name = 'CTY';
	$conn = new mysqli($hostname, $username, $password, $database);
	if ($conn->connect_error) die($conn->connect_error);
	
	$query = "SELECT trip_id FROM trips WHERE route_id in (SELECT route_id FROM routes WHERE route_short_name = '{$route_short_name}')";
	$result = $conn->query($query);
	
	if (!$result) die($conn->error);
	$rows = $result->num_rows;
	//Create an array
	$trip_ids = array();
	//Append trip_id to the array
	for ($j = 0 ; $j < $rows ; ++$j){
		$result->data_seek($j);
		$res = $result->fetch_assoc()['trip_id'];
		array_push($trip_ids, $res);
	}
	$url = "https://api.at.govt.nz/v2/public/realtime/vehiclelocations";
	# if we had query parametets say, trip_ids, we would include an array of them like below
	# $trip_ids = array(1, 3, 64);
	# $params = array("tripid" => $trip_ids);
	//$trip_ids = array('18028088537-20170918164808_v58.16');
	//$params = array('routeid' => $route_ids);
		
	$params = array('tripid' => $trip_ids);	
	
	$results = apiCall($APIKey, $url, $params);
	// Tell the browser we are sending back json
	header('Content-Type: application/json');
	print_r($trip_ids);
	
	echo var_dump($results);

	$result->close();
	$conn->close();
?>