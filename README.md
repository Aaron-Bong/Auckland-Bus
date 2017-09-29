# INFO263-Dev-Team-B
This is for INFO 263 2017 Assignment.

GMap API Documentation: https://developers.google.com/maps/documentation/javascript/adding-a-google-map

README Cheat sheet: https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet

GMaps API Console (via Aaron's G Account): https://console.developers.google.com/apis/api/maps_backend/overview?project=info263-groupb-assignment&duration=PT1H

## At the Akl Transport Website:
Access Realtime Transit Feed --> Vehicle Positions API. <br>
Optional: General Transit Feed

## General Notes:
1. Do not touch the Certs Folder!
2. requests.php contains the API Call function which we need to use to get road info from akl transport.
3. if unable to connect to akl transport database, can dload akl_transport.sql from Learn http://learn.canterbury.ac.nz/mod/assign/view.php?id=629224 and import it to mysql workbench.

## Notes on the sql database:
1. routes: group by  route_id
2. stops: for interest
3. trips: dont worry about trip id and shape id. route id is foreign key (we need to use this!)


## Ariel's API Key for Akl Transport:
8c20ae415fb2473f80e96a47c013b94a

## Aaron's API Key for GMaps API:
AIzaSyDWVvlBxK3Hm7BqW97c4cXFKY5wTcpG2vc


## GMAP Tool tip:
https://jsfiddle.net/svigna/VzYF6/ <br>
http://jsfiddle.net/fn55p/5/ <br>
https://developers.google.com/maps/documentation/javascript/infowindows <br>
