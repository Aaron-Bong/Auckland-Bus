      function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var pos1 = {lat: -20.363, lng: 120.044};
        var pos2 = {lat: -23.363, lng: 110.044};
        var pos3 = {lat: -29.363, lng: 156.044};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        
        //create markers
        var marker0 = new google.maps.Marker({
          position: uluru,
          map: map
        });
        
        var marker1 = new google.maps.Marker({
          position: pos1,
          map: map
        });
   
        var marker2 = new google.maps.Marker({
          position: pos2,
          map: map
        });
		var marker3 = new google.maps.Marker({
          position: pos3,
          map: map
        });
        
       var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
      '<div id="bodyContent">'+
      '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
      'sandstone rock formation in the southern part of the '+
      'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
      'south west of the nearest large town, Alice Springs; 450&#160;km '+
      '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major '+
      'features of the Uluru - Kata Tjuta National Park. Uluru is '+
      'sacred to the Pitjantjatjara and Yankunytjatjara, the '+
      'Aboriginal people of the area. It has many springs, waterholes, '+
      'rock caves and ancient paintings. Uluru is listed as a World '+
      'Heritage Site.</p>'+
      '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
      'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
      '(last visited June 22, 2009).</p>'+
      '</div>'+
      '</div>';
      
       	// Opens up an infowindow (Tooltip) when a marker is clicked
    	var popup=new google.maps.InfoWindow({
       		content: contentString
    	});
    	google.maps.event.addListener(marker0, 'click', function(e) {
        	popup.open(map, this);
    	});
    	
    	// GMap auto resizeto include all markers
    	var markers = [marker, marker1, marker2, marker3];//some array
		var bounds = new google.maps.LatLngBounds();
		for (var i = 0; i < markers.length; i++) {
 			bounds.extend(markers[i].getPosition());
		}
		map.fitBounds(bounds);
		
		
      }