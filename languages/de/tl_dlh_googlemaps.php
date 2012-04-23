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
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['title']					= array('Titel', 'Titel der Google Map.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['center']					= array('Geo-Koordinaten', 'Geben Sie hier die Geo-Koordinaten des Kartenzentrums ein (z.B. 48.856846,2.351024). Die Koordinaten können aus einer Adresse ermittelt werden (s.u.).');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['geocoderAddress']			= array('Adresse für Geocoding', 'Falls das Feld ´Geo-Koordinaten´ leer ist, werden beim speichern des Datensatzes aus dieser Adresse automatisch die passenden Geo-Koordinaten ermittelt.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['geocoderCountry']			= array('Land', 'Geben Sie hier an, in welchem Land die Adresse ermittelt werden soll.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapSize']					= array('Anzeigemaße Breite x Höhe', 'Anzeigemaße der Google Map. Der Wert kann später überschrieben werden.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['zoom']					= array('Zoom-Faktor', 'Mit diesem Zoom-Faktor startet die Google Map. Der Wert kann später überschrieben werden.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypeId']				= array('Ansicht der Karte', 'Legen Sie die Ansicht der Karte fest.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypesAvailable']		= array('Verfügbare Kartenansichten', 'Legen Sie fest, welche Ansichten verfügbar sein sollen.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['streetViewControl']		= array('Street View', 'Street View ist verfügbar.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['draggable']				= array('Karte ist scrollbar', 'Der Kartenausschnitt kann mit der Maus bewegt werden.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['staticMapNoscript']		= array('Statische Karte als Fallback', 'Falls kein Javascript verfügbar ist, soll eine (eingeschränkte) statische Ansicht der Karte gezeigt werden.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['disableDoubleClickZoom']	= array('Zoom bei Doppelklick deaktivieren', 'Bei einem Doopelklick wird nicht gezoomt.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['scrollwheel']				= array('Mausrad-Zoom', 'Zoomen via Mausrad steht zur Verfügung.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['sensor']					= array('Sensor', 'Die Anwendung verwendet Sensoren (siehe Google Api Beschreibung)');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useMapTypeControls']		= array('Zeige das Kartentyp-Element', 'Legen Sie hier fest, ob das Element erscheinen soll.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypeControlStyle']		= array('Art des Kartentyp-Elements', 'Legen Sie das Format des Elements fest.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypeControlPos']		= array('Anzeigeposition', 'Legen Sie hier die Position des Elements auf der Karte fest.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useNavigationControl']	= array('Zeige das Navigations-Element', 'Legen Sie hier fest, ob das Element erscheinen soll.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['navigationControlStyle']	= array('Art des Navigations-Elements', 'Legen Sie das Format des Elements fest.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['navigationControlPos']	= array('Anzeigeposition', 'Legen Sie hier die Position des Elements auf der Karte fest.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useScaleControl']			= array('Zeige das Maßstabs-Element', 'Legen Sie hier fest, ob das Element erscheinen soll.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['scaleControlStyle']		= array('Art des Maßstabs-Elements', 'Legen Sie das Format des Elements fest.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['scaleControlPos']			= array('Anzeigeposition', 'Legen Sie hier die Position des Elements auf der Karte fest.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['parameter']				= array('Ergänzende Parameter', 'Hier können weitere Parameter eingegeben werden.');


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['new']			= array('Neue Google Map', 'Eine neue Google Map anlegen');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['edit']		= array('Google Map bearbeiten', 'Google Map ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['copy']		= array('Google Map duplizieren', 'Google Map ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['delete']		= array('Google Map löschen', 'Google Map ID %s löschen');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['show']		= array('Google Map Details', 'Details der Google Map ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['editheader']	= array('Einstellungen der Google Map bearbeiten', 'Die Einstellungen der Google Map ID %s bearbeiten');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['title_legend']				= 'Titel und Grundeinstellungen';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['maptype_legend']				= 'Kartentyp und -verhalten';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['maptypecontrols_legend']		= 'Kartentyp-Elemente';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['navigationcontrol_legend']	= 'Navigations-Elemente';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['scalecontrol_legend']			= 'Maßstabsanzeige';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['parameter_legend']			= 'Ergänzende Parameter';


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['DEFAULT']			= 'Standardeinstellung';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['HYBRID']			= 'Hybrid';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['ROADMAP']			= 'Karte';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['SATELLITE']			= 'Satellit';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['TERRAIN']			= 'Gelände';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['DROPDOWN_MENU']		= 'Dropdown-Menü';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['HORIZONTAL_BAR']	= 'Horizontaler Balken';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['ANDROID']			= 'Android';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['SMALL']				= 'Kleine Version';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['ZOOM_PAN']			= 'Große Version';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['noCurl']			= 'Kodierung nicht möglich - kein CURL vorhanden.';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['noCoords']			= 'Kodierung nicht möglich.';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['pcnt']				= '%';

?>