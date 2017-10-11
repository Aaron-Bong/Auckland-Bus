function json_extractor(vehicle_positions_raw) {
	var positions = []
	for (var i = 0; i < vehicle_positions_raw.length; i++){
		var data = JSON.parse(vehicle_positions_raw[i]);
	
		if (JSON.stringify(data["response"]).length > 2 ){
			for (var j = 0; j < data["response"]["entity"].length; j++) {
				var position = [data["response"]["entity"][j]["vehicle"]["vehicle"]["id"],
								parseFloat(JSON.stringify(data["response"]["entity"][j]["vehicle"]["position"]["latitude"])),
								parseFloat(JSON.stringify(data["response"]["entity"][j]["vehicle"]["position"]["longitude"]))];
				positions.push(position);
				//document.write(position);
				//document.write('<br>');
			}
		}	
	}
	return positions;
}
