<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Christian de la Haye 2010
 * @author     Christian de la Haye 
 * @package    dlh_googlemaps 
 * @license    LGPL
 * @filesource
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['title']				= array('Title', 'Title of the map element.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['type']				= array('Type', 'Type of the map element.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['published']			= array('Published', 'The element is published.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['singleCoords']		= array('Geo-coordinates', 'Please enter the geo-coordinates of the element.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['multiCoords']		= array('Multiple Geo-coordinates', 'Please enter multiple geo-coordinates for the element. Polygones are closed automatically.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['radius']				= array('Radius in meters', 'Please enter the radius of the circle in meters.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['strokeColor']		= array('Line color', 'Please enter the color used for lines.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['strokeWeight']		= array('Line weight', 'Please enter the line weight in pixels.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['strokeOpacity']		= array('Line opacity', 'Please enter the opacity used for lines.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['fillColor']			= array('Fill color', 'Please enter the color used for fillings.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['fillOpacity']		= array('Fill opacity', 'Please enter the opacity used for fillings.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['markerAction']		= array('Action on click', 'Here you decide how the element reacts on clicking.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['popupInfoWindow']	= array('Open infowindow automatically', 'Shall the infowindow pop up automatically?');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['infoWindow']			= array('Infowindow', 'Please enter the content for the infowindow. Insert tags are supported.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['infoWindowAnchor']	= array('Position of the infowindow anchor', 'The position of the infowindow can be modified by coordinates LEFT,UP. 5,10 e.g. moves the infowindow 5 Pixel to the left and 10 Pixel up.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['url']				= array('Link', 'Please enter a url (mit http://) or select a Contao page.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['linkTitle']			= array('Link title', 'This text is displayed as a tooltip by the clickable element.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['target']				= array('Open in new window', 'Open the link in a new browser window.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['bounds']				= array('Geo-coordinates southwest/northeast', 'Please enter the coordinates of the element as 2 pairs of coordinates.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['overlaySRC']			= array('File', 'Please choose an image file (gif, jpg or png), which overlays the map within the chosen area.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['markerShowTitle']	= array('Show title', 'Show the title of the marker as a tooltip.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['markerType']			= array('Type of marker', 'You can use standard Google markers or individual icons.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['useRouting']			= array('Use routing', 'The Google Maps route planner can be linked from the infowindow directly by form.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['routingAddress']		= array('Address used for routing', 'Please enter the target address for routing. By an empty field the geo-coordinates are used as the routing target.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['iconSRC']			= array('File for the icon', 'Please choose an image file (gif, jpg oder png) for use as an icon.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['iconSize']			= array('Dimensions width x height', 'Dimensions of the icon.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['iconAnchor']			= array('Position of the icon anchor', 'The position of the icon can be modified by coordinates LEFT,UP. 5,10 e.g. moves the icon 5 Pixel to the left and 10 Pixel up.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['hasShadow']			= array('Use shadow', 'The icon has a shadow');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['shadowSRC']			= array('File for the shadow', 'Please choose an image file (png is best) that shall be used as a shadow.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['shadowSize']			= array('Dimensions width x height', 'Dimensions of the shadow. A special position used by the icon is used equally by the shadow.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['zIndex']				= array('z-Index', 'Horizontal position of the element relative to the map.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['parameter']			= array('Additional parameters', 'Here you can enter additional parameters for the map elements.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['import']				= array('Import','Import a set of coordinates.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['importfile']			= array('Source file','Select the csv file to import.');


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['new']	= array('New element', 'Add a new map element');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['edit']	= array('Edit element', 'Edit element ID %s');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['copy']	= array('Copy element', 'Copy element ID %s');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['delete']	= array('Delete element', 'Delete element ID %s');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['show']	= array('Element details', 'Show the details of element ID %s');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['toggle']	= array('Publish element', 'Publish Element ID %s');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['title_legend']		= 'Title and type';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['element_legend']		= 'Element configuration';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['parameter_legend']	= 'Additional parameters';


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['MARKER']			= 'Marker (w, w/o routing)';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['INFOWINDOW']		= 'Infowindow';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['RECTANGLE']		= 'Rectangle';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['CIRCLE']			= 'Circle';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['POLYLINE']			= 'Poly line';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['POLYGON']			= 'Polygon';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['GROUND_OVERLAY']	= 'Ground overlay';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['NONE']				= 'No action';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['LINK']				= 'Direct link on marker';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['INFO']				= 'Open Infowindow';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['SIMPLE']			= 'Google default marker';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['ICON']				= 'Individual icon';

?>