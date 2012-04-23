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
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['title']					= array('Title', 'Title of the Google Map.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['center']					= array('Geo-coordinates', 'Please enter the geo-coordinates of the map center (e.g. 48.856846,2.351024). The coordinates can be generated from the address (s.b.).');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['geocoderAddress']			= array('Address for geocoding', 'In case of the field ´geo-coordinates´ being empty, on saving the record the geo-coodinates of this address are generated automatically.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['geocoderCountry']			= array('Country', 'Specify the country in whict the address shall be found.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapSize']					= array('Dimensions width x height', 'Dimensions of the Google Map. This value can be overwritten later.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['zoom']					= array('Zoom-factor', 'The map starts with this zoom factor. This value can be overwritten later.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypeId']				= array('Starting type of the map', 'Specify the starting appearance of the map.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypesAvailable']		= array('Available map types', 'Specify the available map types.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['streetViewControl']		= array('Street View', 'Street View is enabled.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['draggable']				= array('Scrolling', 'The map can be moved by mouse.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['staticMapNoscript']		= array('Static map as fallback', 'If javascript isn\'t enabled, a (restricted) static map shall be rendered instead.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['disableDoubleClickZoom']	= array('Deactivate zoom on doubleclick', 'On doubleclicking the map no zoom is performed.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['scrollwheel']				= array('Mouse wheel zoom', 'Zoom by mouse wheel is enabled.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['sensor']					= array('Sensor', 'The application uses sensors (see Googgle API)');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useMapTypeControls']		= array('Use map type controls', 'Please specify if the elements is used.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypeControlStyle']		= array('Type of map type controls', 'Please specify the formatting of the element.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypeControlPos']		= array('Position', 'Please specify the position of the element on the map.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useNavigationControl']	= array('Use navigation controls', 'Please specify if the elements is used.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['navigationControlStyle']	= array('Type of navigation controls', 'Please specify the formatting of the element.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['navigationControlPos']	= array('Position', 'Please specify the position of the element on the map.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useScaleControl']			= array('Use scale control', 'Please specify if the elements is used.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['scaleControlStyle']		= array('Type of scale controls', 'Please specify the formatting of the element.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['scaleControlPos']			= array('Position', 'Please specify the position of the element on the map.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['parameter']				= array('Additional parameters', 'Here you can enter additional parameters for the map.');


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['new']			= array('New Google Map', 'Add a new Google Map');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['edit']		= array('Edit Google Map', 'Edit the Google Map ID %s');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['copy']		= array('Google Map duplizieren', 'Duplicate Google Map ID %s');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['delete']		= array('Google Map löschen', 'Delete Google Map ID %s');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['show']		= array('Google Map Details', 'Show Google Map ID %s details');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['editheader']	= array('Edit Google Map settings', 'Edit the settings of Google Map ID %s');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['title_legend']				= 'Title and bascis';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['maptype_legend']				= 'Map type and behaviour';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['maptypecontrols_legend']		= 'Map type controls';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['navigationcontrol_legend']	= 'Navigation controls';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['scalecontrol_legend']			= 'Scale control';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['parameter_legend']			= 'Additional parameters';


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['DEFAULT']			= 'Default';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['HYBRID']			= 'Hybrid';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['ROADMAP']			= 'Roadmap';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['SATELLITE']			= 'Satellite';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['TERRAIN']			= 'Terrain';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['DROPDOWN_MENU']		= 'Dropdown menu';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['HORIZONTAL_BAR']	= 'Horizontal bar';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['ANDROID']			= 'Android';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['SMALL']				= 'Small version';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['ZOOM_PAN']			= 'Big version';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['noCurl']			= 'No geocoding possible - CURL is missing.';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['noCoords']			= 'No geocoding possible.';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['pcnt']				= '%';

?>