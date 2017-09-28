<?php // query.php
	require_once 'include/config.php';
	$arr = array();
	
	$route_short_name = '18';
	$conn = new mysqli($hostname, $username, $password, $database);
	if ($conn->connect_error) die($conn->connect_error);
	//$query = "SELECT route_id FROM routes WHERE route_short_name = '{$route_short_name}'"
	 
	//foreach $arr as $route_id {
	
	//$query = "SELECT trip_id FROM trips WHERE route_id in (SELECT route_id FROM routes WHERE route_short_name = '020X')";
	$query = "SELECT trip_id FROM trips WHERE route_id in (SELECT route_id FROM routes WHERE route_short_name = '{$route_short_name}')";
	$result = $conn->query($query);
	if (!$result) die($conn->error);
	//var_dump($result);
	$rows = $result->num_rows;
	//echo $rows;
	$trip_ids = array();
	for ($j = 0 ; $j < $rows ; ++$j){
		$result->data_seek($j);
		$res = $result->fetch_assoc()['trip_id'];
		array_push($trip_ids, $res);
	}
	
	require_once 'requests.php';
	//var_dump($trip_ids);
	$url = "https://api.at.govt.nz/v2/public/realtime";
	# if we had query parametets say, trip_ids, we would include an array of them like below
	# $trip_ids = array(1, 3, 64);
	# $params = array("tripid" => $trip_ids);
	//$trip_ids = array('18028088537-20170918164808_v58.16');
	//$params = array('routeid' => $route_ids);
	
	//print "<br> TRIP IDS <br>";
	print_r($trip_ids);
	print "<br><br><br>";
	var_dump($trip_ids);

	print "<br><br><br><br><br>";
	$sam_trip = array('1080096091-20170918164808_v58.16', '1981086442-20170918164808_v58.16', '1085096056-20170918164808_v58.16');
	print "<br> TRIP ID = 1080096091-20170918164808_v58.16 AND 1981086442-20170918164808_v58.16 AND NO POS: 1085096056-20170918164808_v58.16<br>";
	print_r($sam_trip);
	print "<br>";
	var_dump($sam_trip);
	$params = array('tripid' => $sam_trip);
	//$params = array('tripid' => $trip_ids);
	print "<br><br><br><br><br>";
	//print_r($params);
	//$params = array();
	//$params = array();
	$results = apiCall($APIKey, $url, $params);
	// Tell the browser we are sending back json
	//header('Content-Type: application/json');
	//print $results[0][0];
	//var_dump($results);
	$dict = $results[0];
	print $dict;
	//print $dict[];

	
	
	 $result->close();
	 $conn->close();
?>