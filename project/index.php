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

<script type="text/javascript">
	$(document).ready(function(){
		$("#dropDown").change(function(){
			var choosen_route = $(this).val();
			if (choosen_route === "NULL") {
				console.log("do nothing"); //change laterrrrrrrrrrrrrrrrrrrrrrrr
			}
			else {
				$.ajax({ //////help! not working!!!!!!!
                    type: "POST",
                    url: 'index.php',
                    data: { route : choosen_route }
                });
			}
		});
	});
</script>
<!--===END of Drop down list===-->

<?php
//$uid = $_POST['route'];
//echo "<p> haaaaaaaaaaaaaaaaaaa '{$uid}' </p>";
if(isset($_POST['route']))
{
    $uid = $_POST['route'];
    echo "<p> haaaaaaaaaaaaaaaaaaa '{$uid}' </p>";
    // Do whatever you want with the $uid
}
?>

<!--================================insert code here=========================-->



<!--===============================================-->

<div id="map"></div>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWVvlBxK3Hm7BqW97c4cXFKY5wTcpG2vc&callback=initMap">
</script>
<script src="scripts/map.js"></script>
<script>
    $(document).ready(function() {

    });
</script>
<?php
require_once 'include/footer.php';
?>
