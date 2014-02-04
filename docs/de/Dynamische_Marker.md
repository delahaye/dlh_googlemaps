Dynamische Maps mit dem Contao-Modul "dlh_googlemaps"
=====

Um dynamische Markierungen und andere Elemente in eine Map einzufügen, wird ein Javascript-Funktionsblock an einer anderen Stelle der XHTML-Ausgabe benötigt. Da die entsprechende Funktion erst bei der Initialisierung der Map aufgerufen wird, ist es i.d.R. unerheblich, ob dieser Block im Quelltext vor oder nach dem Inhaltselement mit der Googlemap erscheint. Im folgenden Beispielcode ist sind variable Bestandteile durch ** gekennzeichnet und müssten in einer Einbindung durch die entsprechenden echten Werte ersetzt werden:

*ID* = Id der gewünschten Googlemap

*LATLNG* = Koordinatenpaar

*IMG* = Name der gewünschten Grafik

Elementnamen müssen zumindest in der Variablenbezeichnung eine eindeutige Kennung ergeben, ich empfehle eine fortlaufende Nummer, wie es das Modul auch bei automatisch erzeugten Elementen macht.

```javascript

function gmap*ID*_dynmap(gmap*ID*) {

	// Kartenmitte verschieben

	gmap*ID*.center = new google.maps.LatLng(*LATLNG*);
	// Zoomstufe
	gmap*ID*.zoom = 14;


	// Einfache Markierung

	var gmap*ID*_1_marker = new google.maps.Marker({
		position: new google.maps.LatLng(*LATLNG*), 
		map: gmap*ID*
		});


	// Komplexe Markierung mit selbstöffnender Infoblase

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



	// Poly-Linie

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


	// Geschlossenes Polygon

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
	// Ein Klick auf das Polygon verschiebt das Kartenzentrum
	google.maps.event.addListener(gmap*ID*_4_polygon, 'click', function(event) {
		gmap*ID*.setCenter(event.latLng);
		});


	// Infoblase (selbstöffnend)

	var gmap*ID*_5_infowindow = new google.maps.InfoWindow({
		position: new google.maps.LatLng(*LATLNG*),
		content: 'Hallo Welt!'
		});
	gmap*ID*_5_infowindow.open(gmap*ID*);


	// Overlay-Grafik

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

Es können natürlich noch mehr Eigenschaften dynamisch verändert werden, eine nähere Erläuterung und Beispiele finden sich auf http://code.google.com/intl/de-DE/apis/maps/documentation/javascript/examples/index.html.

Konkretes Beispiel:
-------------------

Das folgende Script kann 1:1 in ein Element vom Typ Html (mit erlaubtem Tag <script>) eingebaut werden und verschiebt den Kartenmittelpunkt der Map mit der ID 1 nach Paris, schaltet auf Kartenansicht, Zoom 10 und markiert Eiffelturm und Louvre mit einer Standardmarkierung plus Infoblase:

```javascript

function gmap1_dynmap(gmap1) {

	// Kartenmitte verschieben
	gmap1.center = new google.maps.LatLng(48.856846,2.351024);
	// Zoomstufe
	gmap1.zoom = 12;
	gmap1.mapTypeId=google.maps.MapTypeId.ROADMAP;


	// Markierung Eiffelturm
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

	// Markierung Louvre
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

Experimentiert mal mit anderen Variablen, Metamodel-Templates, Auflistungen etc. Viel Spaß!