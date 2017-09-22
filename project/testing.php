<!DOCTYPE html>
<html>
<body>

<select>
<?php // query.php
	 require_once 'include/config.php';
	 $conn = new mysqli($hostname, $username, $password, $database);
	 if ($conn->connect_error) die($conn->connect_error);
	 $query = "SELECT DISTINCT route_long_name FROM routes ORDER BY route_long_name";
	 $result = $conn->query($query);
	 if (!$result) die($conn->error);
	 $rows = $result->num_rows;
	 for ($j = 0 ; $j < $rows ; ++$j){
		 $result->data_seek($j);
		 $res = $result->fetch_assoc()['route_long_name'];
		 //echo 'Author: ' . $result->fetch_assoc()['author'] . '<br>';
		 echo "<option value= '$res' > $res </option>";
		 		 }
	 $result->close();
	 $conn->close();
 ?>
</select>
  





</body>
</html>