<?php
$active = "home";
require_once 'include/header.php';
require_once 'get_trips.php';
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
<!--===END of Drop down list===-->


<!--===DROP DOWN SELECTION EVENT===-->
<script src="test_request.js"></script>

<script type="text/javascript">
	var last_route_selected;
	$(document).ready(function(){
		$("#dropDown").change(function(){
			var choosen_route = $(this).val();
			if (choosen_route === "NULL") {
				console.log("NO ROUTE SELECTED"); //change laterrrrrrrrrrrrrrrrrrrrrrrr
			}
			else {
				last_route_selected = choosen_route
				$.get( "test_request.php", { choosen_route: choosen_route }, function( vehicle_positions_raw ) {
	  				//console.log(vehicle_positions_raw);
	  				var vehicle_positions = json_extractor(vehicle_positions_raw);
	  				//console.log( vehicle_positions );
	  				//console.log(vehicle_positions.length);
					setMarkers(vehicle_positions)
					if (vehicle_positions.length == 0) {
	  					document.getElementById("vehicle").innerHTML = "NO VEHICLES FOUND :(";
	  					initMap();
	  				} else {
	  					document.getElementById("vehicle").innerHTML = "";
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
<p id="vehicle"></p>
<!--END OF VEHICLE PARAGRAPH-->


<!--===MAP REFRESH AND UPDATE===-->
<script>
$(document).ready(function() {
	setInterval(function() {
	update_map()
}, 30000)
});


function update_map() {
	choosen_route = last_route_selected;
	//console.log(choosen_route);
	if (choosen_route != null && choosen_route != "NULL") {
		$.get( "test_request.php", { choosen_route: choosen_route }, function( vehicle_positions_raw ) {
			//console.log(vehicle_positions_raw);
			var vehicle_positions = json_extractor(vehicle_positions_raw);
			//console.log( vehicle_positions );
			//console.log(vehicle_positions.length);
			setMarkers(vehicle_positions)
			if (vehicle_positions.length == 0) {
	  			document.getElementById("vehicle").innerHTML = "NO VEHICLES FOUND :(";
	  			initMap();
	  		} else {
	  			document.getElementById("vehicle").innerHTML = "";
			}
		});
	}
}
</script>
<!--===END OF MAP REFRESH AND UPDATE===-->

<?php
require_once 'include/footer.php';
?>
