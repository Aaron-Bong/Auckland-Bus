<?php
$active = "home";
require_once 'include/header.php';
?>

<!--Drop down list-->
<select id ="dropDown" style="margin-bottom: 20px;">
	<option value= 'NULL' > Select Route </option>
	<?php // query.php
		 require_once 'include/config.php';
		 $conn = new mysqli($hostname, $username, $password, $database);
		 if ($conn->connect_error) die($conn->connect_error);
		 $query = "SELECT DISTINCT route_short_name FROM routes ORDER BY route_short_name";
		 $result = $conn->query($query);
		 if (!$result) die($conn->error);
		 $rows = $result->num_rows;
		 for ($j = 0 ; $j < $rows ; ++$j){
			 $result->data_seek($j);
			 $res = $result->fetch_assoc()['route_short_name'];
			 echo "<option value= '$res' > $res </option>";
			 		 }
		 $result->close();
		 $conn->close();
	 ?>
</select>

//Replace this script with a code that gets the value of choosen_route and stores it in a php variable
//After that we call the php function that gets the trip_ipds out of the database
//and then makes an apiCall with the trip_id array
<script type="text/javascript">
	$(document).ready(function(){
		$("#dropDown").change(function(){
			var choosen_route = $(this).val();
			if (choosen_route === "NULL") {
				console.log("do nothing"); //change laterrrrrrrrrrrrrrrrrrrrrrrr
			}
			else {
				$.ajax({
                    type: "GET",
                    url: 'route_request.php',
                    data: { choosen_route : choosen_route }
                });
			}
		});
	});
</script>
//END OF SCRIPT TO BE REPLACED
<!--===END of Drop down list===-->


//Modify the map.js file to make it accept an array of vehicle locations and puts a marker on it.
<div id="map"></div>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWVvlBxK3Hm7BqW97c4cXFKY5wTcpG2vc&callback=initMap">
</script>

<script src="scripts/map.js"></script>


<script>
    $(document).ready(function() {
    	setInterval(function() {
    	cache_clear()
  	}, 50000)
	});
	function cache_clear() {
  		window.location.reload(true);
 	 	// window.location.reload(); use this if you do not remove cache
	}
</script>
<?php
require_once 'include/footer.php';
?>
