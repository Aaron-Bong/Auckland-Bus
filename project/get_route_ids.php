<!DOCTYPE html>
<html>
<body>

<p>

<select name="D1" style="width: 291px; height: 34px">
<?php // query.php
	 require_once 'include/config.php';
	 $arr = array();
	
	 $route_short_name = '009';
	 $conn = new mysqli($hostname, $username, $password, $database);
	 if ($conn->connect_error) die($conn->connect_error);
	 //$query = "SELECT route_id FROM routes WHERE route_short_name = '{$route_short_name}'"
	 
	 //foreach $arr as $route_id {
	 $query = "SELECT trip_id FROM trips WHERE route_id in (SELECT route_id FROM routes WHERE route_short_name = '{$route_short_name}')";
	 $result = $conn->query($query);
	 $arr = $result;
	 if (!$result) die($conn->error);
	 var_dump($result);
	 $rows = $result->num_rows;
	 //echo $rows;
	 for ($j = 0 ; $j < $rows ; ++$j){
		 $result->data_seek($j);
		 $res = $result->fetch_assoc()['trip_id'];
		 echo "<option value= '$res' > $res </option>";
		 		 }
	 $result->close();
	 $conn->close();
 ?>
</select></p>
 


</body>
</html>