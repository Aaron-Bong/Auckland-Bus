<?php //database.php
require_once 'include/config.php';
require_once 'requests.php';

$url = "https://api.at.govt.nz/v2/public/realtime";
# if we had query parametets say, trip_ids, we would include an array of them like below
# $trip_ids = array(1, 3, 64);
# $params = array("tripid" => $trip_ids);
//$trip_ids = array('18028088537-20170918164808_v58.16');
//$params = array('routeid' => $route_ids);
$trip_ids = array();
$params = array('tripid' => $trip_ids);
//$params = array();
//$params = array();
$results = apiCall($APIKey, $url, $params);
// Tell the browser we are sending back json
header('Content-Type: application/json');
//print $results[0][0];
//var_dump($results);
$dict = $results[0];
print $dict;
//print $dict[];
?>