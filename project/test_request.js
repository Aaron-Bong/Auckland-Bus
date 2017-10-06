var positions = []
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