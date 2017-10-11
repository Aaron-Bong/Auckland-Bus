
/*
var locations = [
 ['uluru', -25.363, 131.044],
 ['pos1', -20.363, 120.044],
 ['pos2', -23.363, 110.044],
 ['pos3', -29.363, 156.044],
 ['fuckthisshit', -30.363, 146.044],
 ['fuck', -35.363, 157.044]
];*/
var map;
var markers = [];
function initMap() 
{
	map = new google.maps.Map(document.getElementById('map'), {
    	zoom: 12,
    	center: {lat: -36.8802, lng: 174.7616}, //coordinates for  Auckland
    	scaleControl: true
    });
}

//generate markers with each marher having a tooltip to display extra info
function setMarkers(locations) {   
	if (markers.length != 0){
		for (i = 0; i < markers.length; i++){
			markers[i].setMap(null);
		}
		markers = []
	}
	
	var marker, i;  
    var infowindow = new google.maps.InfoWindow();  
    //generate pointers for all busses based on bus's position
   	for (i = 0; i < locations.length; i++) {
   		marker = new google.maps.Marker({
        	position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        	map: map
        })
    	// Opens up an infowindow (Tooltip) when a marker is clicked
      	google.maps.event.addListener(marker, 'click', (function(marker, i) {
        	return function() {
          		infowindow.setContent("Vehicle ID: "+locations[i][0] + "<br/>Start time: "+ locations[i][3]);
          		infowindow.open(map, marker);
        	}
		})(marker, i));
		autoResize(map, locations);
		markers.push(marker);
	}
}
	      
       	    	
    	// GMap auto resizeto include all markers
    	//var markers = [marker0, marker1, marker2, marker3];//some array
function autoResize(map, locations){
	var bounds = new google.maps.LatLngBounds();
	for (var i = 0; i < locations.length; i++) {
		bounds.extend(new google.maps.LatLng(locations[i][1], locations[i][2]));
	}
	map.fitBounds(bounds);
}