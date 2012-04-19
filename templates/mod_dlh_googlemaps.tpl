<!-- indexer::stop -->

<div class="<?php echo $this->class; ?> block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<div class="dlh_googlemap block" id="dlh_googlemap_<?php echo $this->map['id']; ?>" style="width:<?php echo $this->map['mapSize'][0].$this->map['mapSize'][2]; ?>;height:<?php echo $this->map['mapSize'][1].$this->map['mapSize'][2]; ?>;"><noscript><p><?php echo ($this->map['staticMapNoscript'] ? $this->map['staticMap'] : $this->labels['noscript']); ?></p></noscript></div>

<script type="text/javascript">
/* <![CDATA[ */

function gmap<?php echo $this->map['id']; ?>_initialize() {
	var gmap<?php echo $this->map['id']; ?>_Options = {
		zoom: <?php echo $this->map['zoom']; ?>
		, center: new google.maps.LatLng(<?php echo $this->map['center']; ?>)

		, mapTypeId: google.maps.MapTypeId.<?php echo $this->map['mapTypeId']; ?>

		, draggable: <?php echo $this->map['draggable']; ?>
		, disableDoubleClickZoom: <?php echo $this->map['disableDoubleClickZoom']; ?>
		, scrollwheel: <?php echo $this->map['scrollwheel']; ?>
		, streetViewControl: <?php echo $this->map['streetViewControl']; ?>

		<?php if ($this->map['useMapTypeControl']) : ?>
		, mapTypeControl: true
		, mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.<?php echo $this->map['mapTypeControlStyle']; ?>
			, position: google.maps.ControlPosition.<?php echo $this->map['mapTypeControlPos']; ?>
			<?php if (is_array($this->map['mapTypesAvailable'])) : ?>
			, mapTypeIds: [
				<?php foreach($this->map['mapTypesAvailable'] as $k=>$v) : ?>
					<?php if($k>0) echo ','; ?>google.maps.MapTypeId.<?php echo $v; ?>
				<?php endforeach; ?>
				]
			<?php endif; ?>
		}
		<?php else : ?>
		, mapTypeControl: false
		<?php endif; ?>

		<?php if ($this->map['useNavigationControl']) : ?>
		, navigationControl: true
		, navigationControlOptions: {
			style: google.maps.NavigationControlStyle.<?php echo $this->map['navigationControlStyle']; ?>,
			position: google.maps.ControlPosition.<?php echo $this->map['navigationControlPos']; ?>
		}
		<?php else : ?>
		, navigationControl: false
		<?php endif; ?>

		<?php if ($this->map['useScaleControl']) : ?>
		, scaleControl: true
		, scaleControlOptions: {
			position: google.maps.ControlPosition.<?php echo $this->map['scaleControlPos']; ?>
		}
		<?php else : ?>
		, scaleControl: false
		<?php endif; ?>

		<?php if ($this->map['parameter']) : ?>
		, <?php echo $this->map['parameter']; ?>
		<?php endif; ?>

    };
    var gmap<?php echo $this->map['id']; ?> = new google.maps.Map(document.getElementById("dlh_googlemap_<?php echo $this->map['id']; ?>"), gmap<?php echo $this->map['id']; ?>_Options);

	<?php $count=-1; foreach($this->map['elements'] AS $element) : $count++; $element['id']=$this->map['id'].'_'.$count; switch($element['type']) :

	case 'MARKER': ?>
		<?php if ($element['singleCoords'] && $element['markerType']) : ?>
		var gmap<?php echo $element['id']; ?>_marker = new google.maps.Marker({
			position: new google.maps.LatLng(<?php echo $element['singleCoords']; ?>)
			, map: gmap<?php echo $this->map['id']; ?>
			<?php if($element['markerType']=='ICON') : ?>
				<?php if($element['iconSRC'] && $element['iconSize'][0] && $element['iconSize'][1]) : ?>
				, icon: new google.maps.MarkerImage(
					'<?php echo $element['iconSRC']; ?>'
					, new google.maps.Size(<?php echo $element['iconSize'][0].','.$element['iconSize'][1]; ?>)
					, new google.maps.Point(0,0)
					, new google.maps.Point(<?php echo $element['iconAnchor'][0].','.$element['iconAnchor'][1]; ?>)
					, new google.maps.Size(<?php echo $element['iconSize'][0].','.$element['iconSize'][1]; ?>)
					)
				<?php endif; ?>
				<?php if($element['shadowSRC'] && $element['shadowSize'][0] && $element['shadowSize'][1]) : ?>
				, shadow: new google.maps.MarkerImage(
					'<?php echo $element['shadowSRC']; ?>'
					, new google.maps.Size(<?php echo $element['shadowSize'][0].','.$element['shadowSize'][1]; ?>)
					, new google.maps.Point(0,0)
					, new google.maps.Point(<?php echo $element['iconAnchor'][0].','.$element['iconAnchor'][1]; ?>)
					, new google.maps.Size(<?php echo $element['shadowSize'][0].','.$element['shadowSize'][1]; ?>)
					)
				<?php endif; ?> 
			<?php endif; ?>
			<?php if($element['markerAction'] == 'LINK' && $element['linkTitle']) : ?>
				, title:"<?php echo $element['linkTitle']; ?>"
			<?php elseif ($element['markerShowTitle']) : ?>
				, title:"<?php echo $element['title']; ?>"
			<?php endif; ?>
			<?php if ($element['zIndex']) : ?>
				, zIndex: <?php echo $element['zIndex']; ?>
			<?php endif; ?>
			<?php if ($element['parameter']) : ?>
				, <?php echo $element['parameter']; ?>
			<?php endif; ?>
		});
		<?php if($element['markerAction'] == 'INFO') : ?>
			<?php if($element['useRouting']) {
				$routingPoint = ($element['routingAddress'] ? $element['routingAddress'] : $element['singleCoords']);
				$routingLink = '<div class="routinglink">' . str_replace('?','<a href="http://maps.google.com/maps?saddr=&daddr=' . urlencode($routingPoint) . '&ie=UTF8&hl=' . $this->map['language'] . '" onclick="window.open(this.href); return false;">' . $this->labels['routingLink'] . '</a>', $this->labels['routingLabel']) . '<br /><form action="http://maps.google.com/maps" method="get" target="_new"><input type="hidden" name="daddr" value="' . $routingPoint . '" /><input type="hidden" name="ie" value="UTF8" /><input type="hidden" name="hl" value="' . $this->map['language'] . '" /><input type="text" class="text" name="saddr" /><input type="submit" class="submit" value="' . $this->labels['routingSubmit'] . '" /></form></div>';
			} else {
				$routingLink = '';
			} ?>
			var gmap<?php echo $element['id']; ?>_infowindow = new google.maps.InfoWindow({
				position: new google.maps.LatLng(<?php echo $element['singleCoords']; ?>),
				<?php if ($element['infoWindowAnchor'][0] && $element['infoWindowAnchor'][1]) : ?>
				pixelOffset: new google.maps.Size(<?php echo $element['infoWindowAnchor'][0].','.$element['infoWindowAnchor'][1]; ?>),
				<?php endif; ?>
				content: '<?php echo $element['infoWindow'].$routingLink; ?>'
				});
			google.maps.event.addListener(gmap<?php echo $element['id']; ?>_marker, 'click', function() {
				gmap<?php echo $element['id']; ?>_infowindow.open(gmap<?php echo $this->map['id']; ?>);
				});
			<?php if($element['popupInfoWindow']) : ?>
				gmap<?php echo $element['id']; ?>_infowindow.open(gmap<?php echo $this->map['id']; ?>);
			<?php endif; ?>
		<?php elseif($element['markerAction'] == 'LINK') : ?>
			google.maps.event.addListener(gmap<?php echo $element['id']; ?>_marker, 'click', function() {
				<?php if($element['target']) : ?>
				window.open('<?php echo $element['url']; ?>','_blank','resizable=yes,scrollbars=yes,toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes');
				<?php else :?>
				window.location.href='<?php echo $element['url']; ?>';
				<?php endif; ?>
				});
		<?php endif; ?>
		<?php if ($element['parameter']) : ?>
			<?php echo $element['parameter']; ?>
		<?php endif; ?>
		<?php endif; ?>
		<?php break;

	case 'POLYLINE' : ?>
		<?php if ($element['multiCoords'][0] && $element['strokeColor'] && $element['strokeOpacity'] && $element['strokeWeight']['value']) : ?>
		var gmap<?php echo $element['id']; ?>_path = new google.maps.Polyline({
			path: [
			<?php foreach($element['multiCoords'] as $k=>$v) : ?>
				<?php if($k>0) echo ','; ?>new google.maps.LatLng(<?php echo $v; ?>)
			<?php endforeach; ?>
				]
			, strokeColor: "#<?php echo $element['strokeColor']; ?>"
			, strokeOpacity: <?php echo $element['strokeOpacity']; ?>
			, strokeWeight: <?php echo $element['strokeWeight']['value']; ?>
			<?php if ($element['zIndex']) : ?>
				, zIndex: <?php echo $element['zIndex']; ?>
			<?php endif; ?>
			<?php if ($element['parameter']) : ?>
				, <?php echo $element['parameter']; ?>
			<?php endif; ?>
			});
		gmap<?php echo $element['id']; ?>_path.setMap(gmap<?php echo $this->map['id']; ?>);
		<?php endif; ?>
		<?php break;

	case 'POLYGON' : ?>
		<?php if ($element['multiCoords'][0] && $element['strokeColor'] && $element['strokeOpacity'] && $element['strokeWeight']['value']) : ?>
		var gmap<?php echo $element['id']; ?>_polygon = new google.maps.Polygon({
			path: [
			<?php foreach($element['multiCoords'] as $k=>$v) : ?>
				<?php if($k>0) echo ','; ?>new google.maps.LatLng(<?php echo $v; ?>)
			<?php endforeach; ?>
				]
			, strokeColor: "#<?php echo $element['strokeColor']; ?>"
			, strokeOpacity: <?php echo $element['strokeOpacity']; ?>
			, strokeWeight: <?php echo $element['strokeWeight']['value']; ?>
			<?php if ($element['fillColor'] && $element['fillOpacity']) : ?>
				, fillColor: "#<?php echo $element['fillColor']; ?>"
				, fillOpacity: <?php echo $element['fillOpacity']; ?>
			<?php endif; ?>
			<?php if ($element['zIndex']) : ?>
				, zIndex: <?php echo $element['zIndex']; ?>
			<?php endif; ?>
			<?php if ($element['parameter']) : ?>
				, <?php echo $element['parameter']; ?>
			<?php endif; ?>
			});
		gmap<?php echo $element['id']; ?>_polygon.setMap(gmap<?php echo $this->map['id']; ?>);
		<?php if($element['markerAction'] == 'INFO') : ?>
			var gmap<?php echo $element['id']; ?>_infowindow = new google.maps.InfoWindow({
				position: new google.maps.LatLng(<?php echo $element['windowPosition']; ?>),
				<?php if ($element['infoWindowAnchor'][0] && $element['infoWindowAnchor'][1]) : ?>
				pixelOffset: new google.maps.Size(<?php echo $element['infoWindowAnchor'][0].','.$element['infoWindowAnchor'][1]; ?>),
				<?php endif; ?>
				content: '<?php echo $element['infoWindow']; ?>'
				});
			google.maps.event.addListener(gmap<?php echo $element['id']; ?>_polygon, 'click', function(event) {
				gmap<?php echo $element['id']; ?>_infowindow.setPosition(event.latLng);
				gmap<?php echo $element['id']; ?>_infowindow.open(gmap<?php echo $this->map['id']; ?>);
				});
			<?php if($element['popupInfoWindow']) : ?>
				gmap<?php echo $element['id']; ?>_infowindow.open(gmap<?php echo $this->map['id']; ?>);
			<?php endif; ?>
		<?php elseif($element['markerAction'] == 'LINK') : ?>
			google.maps.event.addListener(gmap<?php echo $element['id']; ?>_polygon, 'click', function() {
				<?php if($element['target']) : ?>
				window.open('<?php echo $element['url']; ?>','_blank','resizable=yes,scrollbars=yes,toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes');
				<?php else :?>
				window.location.href='<?php echo $element['url']; ?>';
				<?php endif; ?>
				});
		<?php endif; ?>
		<?php endif; ?>
		<?php break;

	case 'RECTANGLE' : ?>
		<?php if ($element['bounds'][0] && $element['bounds'][1] && $element['strokeColor'] && $element['strokeOpacity'] && $element['strokeWeight']['value']) : ?>
		var gmap<?php echo $element['id']; ?>_rectangle = new google.maps.Rectangle({
			bounds: new google.maps.LatLngBounds(
				new google.maps.LatLng(<?php echo $element['bounds'][0]; ?>),
				new google.maps.LatLng(<?php echo $element['bounds'][1]; ?>)
				)
			, strokeColor: "#<?php echo $element['strokeColor']; ?>"
			, strokeOpacity: <?php echo $element['strokeOpacity']; ?>
			, strokeWeight: <?php echo $element['strokeWeight']['value']; ?>
			<?php if($element['fillColor'] && $element['fillOpacity']) : ?>
				, fillColor: "#<?php echo $element['fillColor']; ?>"
				, fillOpacity: <?php echo $element['fillOpacity']; ?>
			<?php endif; ?>
			<?php if ($element['zIndex']) : ?>
				, zIndex: <?php echo $element['zIndex']; ?>
			<?php endif; ?>
			<?php if ($element['parameter']) : ?>
				, <?php echo $element['parameter']; ?>
			<?php endif; ?>
			});
		gmap<?php echo $element['id']; ?>_rectangle.setMap(gmap<?php echo $this->map['id']; ?>);
		<?php if($element['markerAction'] == 'INFO') : ?>
			var gmap<?php echo $element['id']; ?>_infowindow = new google.maps.InfoWindow({
				position: new google.maps.LatLng(<?php echo $element['windowPosition']; ?>),
				<?php if ($element['infoWindowAnchor'][0] && $element['infoWindowAnchor'][1]) : ?>
				pixelOffset: new google.maps.Size(<?php echo $element['infoWindowAnchor'][0].','.$element['infoWindowAnchor'][1]; ?>),
				<?php endif; ?>
				content: '<?php echo $element['infoWindow']; ?>'
				});
			google.maps.event.addListener(gmap<?php echo $element['id']; ?>_rectangle, 'click', function(event) {
				gmap<?php echo $element['id']; ?>_infowindow.setPosition(event.latLng);
				gmap<?php echo $element['id']; ?>_infowindow.open(gmap<?php echo $this->map['id']; ?>);
				});
			<?php if($element['popupInfoWindow']) : ?>
				gmap<?php echo $element['id']; ?>_infowindow.open(gmap<?php echo $this->map['id']; ?>);
			<?php endif; ?>
		<?php elseif($element['markerAction'] == 'LINK') : ?>
			google.maps.event.addListener(gmap<?php echo $element['id']; ?>_rectangle, 'click', function() {
				<?php if($element['target']) : ?>
				window.open('<?php echo $element['url']; ?>','_blank','resizable=yes,scrollbars=yes,toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes');
				<?php else :?>
				window.location.href='<?php echo $element['url']; ?>';
				<?php endif; ?>
				});
		<?php endif; ?>
		<?php endif; ?>
		<?php break;

	case 'CIRCLE' : ?>
		<?php if ($element['singleCoords'] && $element['strokeColor'] && $element['strokeOpacity'] && $element['strokeWeight']['value']) : ?>
		var gmap<?php echo $element['id']; ?>_circle = new google.maps.Circle({
			center: new google.maps.LatLng(<?php echo $element['singleCoords']; ?>)
			, radius: <?php echo $element['radius']['value']; ?>
			, strokeColor: "#<?php echo $element['strokeColor']; ?>"
			, strokeWeight: <?php echo $element['strokeWeight']['value']; ?>
			, strokeOpacity: <?php echo $element['strokeOpacity']; ?>
			<?php if($element['fillColor'] && $element['fillOpacity']) : ?>
				, fillColor: "#<?php echo $element['fillColor']; ?>"
				, fillOpacity: <?php echo $element['fillOpacity']; ?>
			<?php endif; ?>
			<?php if ($element['zIndex']) : ?>
				, zIndex: <?php echo $element['zIndex']; ?>
			<?php endif; ?>
			<?php if ($element['parameter']) : ?>
				, <?php echo $element['parameter']; ?>
			<?php endif; ?>
			});
		gmap<?php echo $element['id']; ?>_circle.setMap(gmap<?php echo $this->map['id']; ?>);
		<?php if($element['markerAction'] == 'INFO') : ?>
			var gmap<?php echo $element['id']; ?>_infowindow = new google.maps.InfoWindow({
				position: new google.maps.LatLng(<?php echo $element['singleCoords']; ?>),
				<?php if ($element['infoWindowAnchor'][0] && $element['infoWindowAnchor'][1]) : ?>
				pixelOffset: new google.maps.Size(<?php echo $element['infoWindowAnchor'][0].','.$element['infoWindowAnchor'][1]; ?>),
				<?php endif; ?>
				content: '<?php echo $element['infoWindow']; ?>'
				});
			google.maps.event.addListener(gmap<?php echo $element['id']; ?>_circle, 'click', function(event) {
				gmap<?php echo $element['id']; ?>_infowindow.setPosition(event.latLng);
				gmap<?php echo $element['id']; ?>_infowindow.open(gmap<?php echo $this->map['id']; ?>);
				});
			<?php if($element['popupInfoWindow']) : ?>
				gmap<?php echo $element['id']; ?>_infowindow.open(gmap<?php echo $this->map['id']; ?>);
			<?php endif; ?>
		<?php elseif($element['markerAction'] == 'LINK') : ?>
			google.maps.event.addListener(gmap<?php echo $element['id']; ?>_circle, 'click', function() {
				<?php if($element['target']) : ?>
				window.open('<?php echo $element['url']; ?>','_blank','resizable=yes,scrollbars=yes,toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes');
				<?php else :?>
				window.location.href='<?php echo $element['url']; ?>';
				<?php endif; ?>
				});
		<?php endif; ?>
		<?php endif; ?>
		<?php break;

	case 'INFOWINDOW' : ?>
		<?php if ($element['singleCoords'] && $element['infoWindow']) : ?>
		var gmap<?php echo $element['id']; ?>_infowindow = new google.maps.InfoWindow({
			position: new google.maps.LatLng(<?php echo $element['singleCoords']; ?>)
			, content: '<?php echo $element['infoWindow']; ?>'
			<?php if ($element['zIndex']) : ?>
				, zIndex: <?php echo $element['zIndex']; ?>
			<?php endif; ?>
			<?php if ($element['parameter']) : ?>
				, <?php echo $element['parameter']; ?>
			<?php endif; ?>
			});
		gmap<?php echo $element['id']; ?>_infowindow.open(gmap<?php echo $this->map['id']; ?>);
		<?php endif; ?>
		<?php break;

	case 'GROUND_OVERLAY' : ?>
		<?php if ($element['bounds'][0] && $element['bounds'][1] && $element['overlaySRC']) : ?>
		var gmap<?php echo $element['id']; ?>_overlay = new google.maps.GroundOverlay(
			"<?php echo $element['overlaySRC']; ?>"
			, new google.maps.LatLngBounds(
				new google.maps.LatLng(<?php echo $element['bounds'][0]; ?>),
				new google.maps.LatLng(<?php echo $element['bounds'][1]; ?>)
				)
			<?php if ($element['parameter']) : ?>
				, <?php echo $element['parameter']; ?>
			<?php endif; ?>
			);
		gmap<?php echo $element['id']; ?>_overlay.setMap(gmap<?php echo $this->map['id']; ?>);
		<?php if($element['markerAction'] == 'INFO') : ?>
			var gmap<?php echo $element['id']; ?>_infowindow = new google.maps.InfoWindow({
				position: new google.maps.LatLng(<?php echo $element['bounds'][2]; ?>),
				<?php if ($element['infoWindowAnchor'][0] && $element['infoWindowAnchor'][1]) : ?>
				pixelOffset: new google.maps.Size(<?php echo $element['infoWindowAnchor'][0].','.$element['infoWindowAnchor'][1]; ?>),
				<?php endif; ?>
				content: '<?php echo $element['infoWindow']; ?>'
				});
			google.maps.event.addListener(gmap<?php echo $element['id']; ?>_overlay, 'click', function(event) {
				gmap<?php echo $element['id']; ?>_infowindow.setPosition(event.latLng);
				gmap<?php echo $element['id']; ?>_infowindow.open(gmap<?php echo $this->map['id']; ?>);
				});
			<?php if($element['popupInfoWindow']) : ?>
				gmap<?php echo $element['id']; ?>_infowindow.open(gmap<?php echo $this->map['id']; ?>);
			<?php endif; ?>
		<?php endif; ?>
		<?php endif; ?>
		<?php break;
	endswitch; endforeach; ?>

	if(window.gmap<?php echo $this->map['id']; ?>_dynmap){
		gmap<?php echo $this->map['id']; ?>_dynmap(gmap<?php echo $this->map['id']; ?>);
	}

}

window.setTimeout("gmap<?php echo $this->map['id']; ?>_initialize()", 500);

/* ]]> */
</script>

</div>

<!-- indexer::continue -->