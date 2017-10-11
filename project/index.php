<?php
$active = "home";
require_once 'include/header.php';
//require_once 'get_trips.php';
?>

<!--Drop down list-->
<select id ="dropDown">
	<option value= 'NULL' > Select Route </option>
	
	<?php // query.php
		require_once 'include/config.php'; //details to connect to akl database
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
<!--===END of Drop down list===-->


<!--===DROP DOWN SELECTION EVENT===-->
<script src="test_request.js"></script> <!--file that contains the function json_extractor()-->

<script type="text/javascript">
	var last_route_selected;
	$(document).ready(function(){
		$("#dropDown").change(function(){
			var choosen_route = $(this).val();
			
			if (choosen_route !== null && choosen_route !== "NULL") {
				last_route_selected = choosen_route
				$.get( "test_request.php", { choosen_route: choosen_route }, function( vehicle_positions_raw ) {
	  				var vehicle_positions = json_extractor(vehicle_positions_raw);
					setMarkers(vehicle_positions)
					
					if (vehicle_positions.length == 0) { //if there are no vehicle positions returned
	  					document.getElementById("vehicle-msg").innerHTML = "NO VEHICLES FOUND <i class=\"icon-frown icon-2x\" aria-hidden=\"true\"></i>";
	  					initMap();
	  				} else {
	  					document.getElementById("vehicle-msg").innerHTML = "";
					}
				});
			}
		});
	});
</script>
<!--===END OF DROP DOWN SELECTION EVENT===-->


<!--===GOOGLE MAP===-->
<div id="map"></div>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWVvlBxK3Hm7BqW97c4cXFKY5wTcpG2vc&callback=initMap">
</script>

<script src="scripts/map.js"></script>
<!--===END OF GOOGLE MAP===-->



<!--VEHICLE PARAGRAPH-->
<p id="vehicle-msg"></p>
<!--END OF VEHICLE PARAGRAPH-->


<!--===MAP REFRESH AND UPDATE===-->
<script>
$(document).ready(function() {
	setInterval(function() {
	update_map()
}, 30000) //updates evey 30 seconds
});


function update_map() {
	choosen_route = last_route_selected;
	if (choosen_route !== null && choosen_route !== "NULL") {
		$.get( "test_request.php", { choosen_route: choosen_route }, function( vehicle_positions_raw ) {
			var vehicle_positions = json_extractor(vehicle_positions_raw);
			setMarkers(vehicle_positions)
			
			if (vehicle_positions.length == 0) { //if there are no vehicle positions returned
	  			document.getElementById("vehicle-msg").innerHTML = "NO VEHICLES FOUND <i class=\"icon-frown icon-2x\" aria-hidden=\"true\"></i>";
	  			initMap();
	  		} else {
	  			document.getElementById("vehicle-msg").innerHTML = "";
			}
		});
	}
}
</script>
<!--===END OF MAP REFRESH AND UPDATE===-->

<?php
require_once 'include/footer.php';
?>
