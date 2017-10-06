var locations = [
 	['uluru', -25.363, 131.044],
    ['pos1', -20.363, 120.044],
    ['pos2', -23.363, 110.044],
    ['pos3', -29.363, 156.044],
    ['fuckthisshit', -30.363, 146.044],
    ['fuck', -35.363, 157.044]
    ];
 
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