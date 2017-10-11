    
var locations = []
for (var i = 0; i < jArray.length; i++){
	var data = JSON.parse(jArray[i]);

	if (JSON.stringify(data["response"]).length > 2 ){
		for (var j = 0; j < data["response"]["entity"].length; j++) {
			var position = [JSON.stringify(data["response"]["entity"][j]["vehicle"]["vehicle"]["id"]),
							JSON.stringify(data["response"]["entity"][j]["vehicle"]["position"]["latitude"]),
							JSON.stringify(data["response"]["entity"][j]["vehicle"]["position"]["longitude"])];
			positions.push(position);
			document.write(position);
			document.write('<br>');
		}
	}	
}
 
function initMap() {
    var marker, i;
    	
	var map = new google.maps.Map(document.getElementById('map'), {
    	zoom: 3,
    	center: new google.maps.LatLng(locations[0][1], locations[0][2]),
    });
      
    var infowindow = new google.maps.InfoWindow();  
    
   	for (i = 0; i < locations.length; i++) {
   		marker = new google.maps.Marker({
        	position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        	map: map
        })
    		
      	google.maps.event.addListener(marker, 'click', (function(marker, i) {
        	return function() {
          		infowindow.setContent(locations[i][0]);
          		infowindow.open(map, marker);
        	}
      	})(marker, i));
    }	
}


