<?php // query.php
	require_once 'include/config.php';
	require_once 'requests.php';
	$arr = array();
	
	$route_short_name = '110';
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
	$url = "https://api.at.govt.nz/v2/public/realtime";
	# if we had query parametets say, trip_ids, we would include an array of them like below
	# $trip_ids = array(1, 3, 64);
	# $params = array("tripid" => $trip_ids);
	//$trip_ids = array('18028088537-20170918164808_v58.16');
	//$params = array('routeid' => $route_ids);
	
	//DEBUGGING STUFF
	//print "<br> TRIP IDS <br>";
	//print_r($trip_ids);
	//print "<br><br><br>";
	//var_dump($trip_ids);
	
	//DEBUGGING STUFF
	//print "<br><br><br><br><br>";
	$sam_trip = array('1080096091-20170918164808_v58.16', '1981086442-20170918164808_v58.16', '1085096056-20170918164808_v58.16', '12913096236-20170918164808_v58.16');
	//print "<br> TRIP ID = 1080096091-20170918164808_v58.16 AND 1981086442-20170918164808_v58.16 AND NO POS: 1085096056-20170918164808_v58.16<br>";
	//print_r($sam_trip);
	//print "<br>";
	//var_dump($sam_trip);
	
	$params = array('tripid' => $trip_ids);
	//$params = array('tripid' => $trip_ids);
	//print "<br><br><br><br><br>";
	
	//print_r($params);
	#$trip_ids = array('12839086952-20170918164808_v58.16');
	$trip_set = array();
	//for ($i = 0; $i < count($trip_ids); $i++) {
	//	if 
	
	
	$something = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11);
	
	for ($i = 0; $i < count($trip_ids); $i+= 40){
		array_push($trip_set, array_slice($trip_ids, $i, 40));
	}	
	
	//print_r($trip_set);
	
	
	
	$trip_set = array(array('1028082995-20170918164808_v58.16', '1028082995-20170918164808_v58.16','1028082995-20170918164808_v58.16','1028082995-20170918164808_v58.16','1028082995-20170918164808_v58.16','1028082995-20170918164808_v58.16','1028082995-20170918164808_v58.16','1028082995-20170918164808_v58.16','1028082995-20170918164808_v58.16','1028082995-20170918164808_v58.16','1028082995-20170918164808_v58.16','1028082995-20170918164808_v58.16','1028082995-20170918164808_v58.16'));
	
	$result_array = array();
	
	foreach ($trip_set as $values){
		$result = apiCall($APIKey, $url, array('tripid'=>$values));
		//array_push($result_array, $result); 
		$dict = $result[0];
		$obj = json_decode($dict);
		//if ($obj->{'response'} != '[]'){
		array_push($result_array, $result);
		//}
	}
	
	//$results = apiCall($APIKey, $url, $params);
	// Tell the browser we are sending back json
	//header('Content-Type: application/json');
	//print $results[0][0];
	//var_dump($results);
	//$dict = $results[0];
	
	
	

	//print $dict;
	//print $dict[];
	print_r ($result_array);
	
	
	//$result->close();
	$conn->close();
?>