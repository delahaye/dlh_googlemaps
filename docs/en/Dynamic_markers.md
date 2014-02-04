Dynamic maps with the Contao module "dlh_googlemaps"
=====

To integrate dynamic markings into maps, a javascript block is needed at any other position within the rendered XHTML of the page. The function is called after the initialisation of the javascript map, so it should not matter if this block appears before the map or after withing the code. The following example shows variable parts marked as ** which have to be replaced by the actual values in a real matter:

*ID* = Id of the Google Map

*LATLNG* = Pair of coordinates

*IMG* = Name of the image file

Element names must build a unique alias in the variable names. I recommend counting numers as they are used for the automatically generated elements.

```javascript

function gmap*ID*_dynmap(gmap*ID*) {

	// Move map center

	gmap*ID*.center = new google.maps.LatLng(*LATLNG*);
	// Zoom
	gmap*ID*.zoom = 14;


	// Simple marking

	var gmap*ID*_1_marker = new google.maps.Marker({
		position: new google.maps.LatLng(*LATLNG*), 
		map: gmap*ID*
		});


	// Complex marking with auto-popup infowindow

	var gmap*ID*_2_marker = new google.maps.Marker({
		position: new google.maps.LatLng(*LATLNG*), 
		map: gmap*ID*, 
		title:"Hello World!",
		icon: new google.maps.MarkerImage(
			'tl_files/*IMG*',
			new google.maps.Size(20, 20),
			new google.maps.Point(0,0),
			new google.maps.Point(20,0)
			),
		shadow: new google.maps.MarkerImage(
			'tl_files/*IMG*',
			new google.maps.Size(30,30),
			new google.maps.Point(0,0),
			new google.maps.Point(10,5)
			)
		});
	var gmap*ID*_2_infowindow = new google.maps.InfoWindow({
		content: 'Hallo Welt!<br />Wie geht\'s?'
		});
	google.maps.event.addListener(gmap*ID*_2_marker, 'click', function() {
		gmap*ID*_2_infowindow.open(gmap*ID*,gmap*ID*_2_marker);
		});
	gmap*ID*_2_infowindow.open(gmap*ID*,gmap*ID*_2_marker);



	// Poly line

	var gmap*ID*_3_path = new google.maps.Polyline({
		path: [
			new google.maps.LatLng(*LATLNG*),
			new google.maps.LatLng(*LATLNG*),
			new google.maps.LatLng(*LATLNG*),
			new google.maps.LatLng(*LATLNG*)
			],
		strokeColor: "#FF0000",
		strokeOpacity: 0.5,
		strokeWeight: 3
		});
	gmap*ID*_3_path.setMap(gmap*ID*);


	// Closed polygon

	var gmap*ID*_4_polygon = new google.maps.Polygon({
		path: [
			new google.maps.LatLng(*LATLNG*),
			new google.maps.LatLng(*LATLNG*),
			new google.maps.LatLng(*LATLNG*)
			],
		strokeColor: "#FF00ff",
		strokeOpacity: 0.5,
		strokeWeight: 3,
		fillColor: "#FF0000",
		fillOpacity: 0.35
		});
	gmap*ID*_4_polygon.setMap(gmap*ID*);
	// A click on the polygon moves the map center
	google.maps.event.addListener(gmap*ID*_4_polygon, 'click', function(event) {
		gmap*ID*.setCenter(event.latLng);
		});


	// Infowindow (auto-popup)

	var gmap*ID*_5_infowindow = new google.maps.InfoWindow({
		position: new google.maps.LatLng(*LATLNG*),
		content: 'Hallo Welt!'
		});
	gmap*ID*_5_infowindow.open(gmap*ID*);


	// Ground overlay

	var gmap*ID*_6_overlay = new google.maps.GroundOverlay(
		"tl_files/test.jpg",
		new google.maps.LatLngBounds(
			new google.maps.LatLng(*LATLNG*),	// Koordinate Südwest
			new google.maps.LatLng(*LATLNG*)	// Koordinate Nordost
			)
		);
	gmap*ID*_6_overlay.setMap(gmap*ID*);

}

```

Of course many more parameters can be changed dynamically. You'll find more info and many examples at http://code.google.com/intl/de-DE/apis/maps/documentation/javascript/examples/index.html.

Working Example:
-----

The following script can be used 1:1 in an element of the type Html (with >script> tag allowed), It moved the center of the map with the ID 1 to Paris, switches to roadmap view, zooms to step 10 and marks the Eiffel-tower and the Louvre with a standard marker plus infowindow:

```javascript

function gmap1_dynmap(gmap1) {

	// Move map center
	gmap1.center = new google.maps.LatLng(48.856846,2.351024);
	// Zoom
	gmap1.zoom = 12;
	gmap1.mapTypeId=google.maps.MapTypeId.ROADMAP;


	// Marker Eiffel-tower
	var gmap1_eiffel_marker = new google.maps.Marker({
		position: new google.maps.LatLng(48.858314,2.294462), 
		map: gmap1
		});
	var gmap1_eiffel_infowindow = new google.maps.InfoWindow({
		content: 'Le Tour Eiffel',
		});
	google.maps.event.addListener(gmap1_eiffel_marker, 'click', function() {
		gmap1_eiffel_infowindow.open(gmap1,gmap1_eiffel_marker);
		});

	// Marker Louvre
	var gmap1_lvre_marker = new google.maps.Marker({
		position: new google.maps.LatLng(48.861053,2.335317), 
		map: gmap1
		});
	var gmap1_lvre_infowindow = new google.maps.InfoWindow({
		content: 'Musee du Louvre'
		});
	google.maps.event.addListener(gmap1_lvre_marker, 'click', function() {
		gmap1_lvre_infowindow.open(gmap1,gmap1_lvre_marker);
		});

}

```

Feel free to experiment with other elements, modified MetaModels-templates, listings and so on. Have fun!