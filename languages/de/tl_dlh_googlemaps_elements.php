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
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['title']				= array('Titel', 'Titel des Karten-Elements.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['type']				= array('Typ', 'Typ des Karten-Elements.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['published']			= array('veröffentlicht', 'Das Karten-Element ist veröffentlicht.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['singleCoords']		= array('Geo-Koordinaten', 'Geben Sie die Geo-Koordinaten des Elements ein.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['multiCoords']		= array('Mehrfache Geo-Koordinaten', 'Geben Sie die einzelnen Geo-Koordinaten des Elements ein. Polygone werden automatisch geschlossen.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['radius']				= array('Radius in Metern', 'Geben Sie den Kreis-Radius in Metern ein.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['strokeColor']		= array('Linienfarbe', 'Geben Sie die Farbe für Linien ein.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['strokeWeight']		= array('Linienstärke', 'Geben Sie die Linienstärke ein.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['strokeOpacity']		= array('Linien-Deckkraft', 'Geben Sie die Deckkraft für Linien ein.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['fillColor']			= array('Flächenfarbe', 'Geben Sie die Farbe für Flächen ein.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['fillOpacity']		= array('Flächen-Deckkraft', 'Geben Sie die Deckkraft für Flächen ein.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['markerAction']		= array('Aktion bei Klick', 'Hier legen Sie fest, wie sich das Element beim Klicken verhalten soll.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['popupInfoWindow']	= array('Infoblase automatisch öffnen', 'Soll sich die Infoblase des Elements automatisch öffnen?');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['infoWindow']			= array('Infoblase', 'Geben Sie hier den Inhalt der Infoblase ein. Es können auch Insert-Tags genutzt werden.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['infoWindowAnchor']	= array('Positions-Versatz der Infoblase', 'Die Position der Infoblase kann über ein Koordinatenpaar LINKS,RAUF verändert werden. 5,10 verschiebt die Infoblase z.B. um 5 Pixel nach links und 10 Pixel nach oben.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['url']				= array('Linkziel', 'Geben Sie eine Url (mit http://) ein oder wählen Sie eine Contao-Seite aus.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['linkTitle']			= array('Linktitel', 'Dieser Text wird als Tooltipp am klickbaren Element angezeigt.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['target']				= array('In neuem Fenster öffnen', 'Den Link in einem neuen Browserfenster öffnen.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['bounds']				= array('Geo-Koordinaten Südwest/Nordost', 'Geben Sie hier die Geo-Koordinaten des Elements als 2 Koordinatenpaare ein.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['overlaySRC']			= array('Dateiauswahl', 'Wählen Sie hier die Grafikdatei (gif, jpg oder png) aus, die die Kartenansicht im gewählten Bereich überlagern soll.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['markerShowTitle']	= array('Titel anzeigen', 'Den Titel der Markierung als Tooltipp anzeigen.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['markerType']			= array('Art der Markierung', 'Es können Standard-Markierungen oder eigene Icons verwendet werden.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['useRouting']			= array('Routenplaner verwenden', 'Aus der Infoblase der Markierung kann direkt auf den Google Maps Routenplaner per Formulareingabe verlinkt werden.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['routingAddress']		= array('Adresse für Routenplaner', 'Geben Sie die Ziel-Adresse einer Routenplanung ein. Bleibt das Feld leer, werden als Ziel die Geo-Koordinaten verwendet.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['iconSRC']			= array('Dateiauswahl für das Icon', 'Wählen Sie hier die Grafikdatei (gif, jpg oder png) aus, die für das Icon verwendet werden soll.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['iconSize']			= array('Anzeigemaße Breite x Höhe', 'Anzeigemaße des Icons.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['iconAnchor']			= array('Positions-Versatz des Icons', 'Die Position des Icons kann über ein Koordinatenpaar LINKS,RAUF verändert werden. 5,10 verschiebt das Icon z.B. von der linken oberen Ecke des Icons um 5 Pixel nach links und 10 Pixel nach oben.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['hasShadow']			= array('Schatten verwenden', 'Das Icon verfügt über einen Schatten.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['shadowSRC']			= array('Dateiauswahl für den Schatten', 'Wählen Sie hier die Grafikdatei (am besten png) aus, die als Schatten unter das Icon gelegt werden soll.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['shadowSize']			= array('Anzeigemaße Breite x Höhe', 'Anzeigemaße des Schattens. Ein beim Icon einstellter Positions-Versatz wird übernommen.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['zIndex']				= array('z-Index', 'Ebenen-Position des Elements relativ zur Karte');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['parameter']			= array('Ergänzende Parameter', 'Hier können weitere Parameter eingegeben werden.');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['import']				= array('Importieren','Mehrere Koordinaten importieren');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['importfile']			= array('Quelldatei','Wählen Sie die zu importierende CSV-Datei aus.');

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['new']	= array('Neues Karten-Element', 'Ein neues Karten-Element anlegen');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['edit']	= array('Karten-Element bearbeiten', 'Karten-Element ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['copy']	= array('Karten-Element duplizieren', 'Karten-Element ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['delete']	= array('Karten-Element löschen', 'Karten-Element ID %s löschen');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['show']	= array('Karten-Element Details', 'Details des Karten-Elements ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['toggle']	= array('Karten-Element veröffentlichen', 'Karten-Element ID %s veröffentlichen');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['title_legend']		= 'Titel und Typ';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['element_legend']		= 'Element-Konfiguration';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['parameter_legend']	= 'Ergänzende Parameter';


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['MARKER']			= 'Markierung (ggf. mit Routing)';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['INFOWINDOW']		= 'Info-Sprechblase';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['RECTANGLE']		= 'Rechteck';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['CIRCLE']			= 'Kreis';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['POLYLINE']			= 'Linie';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['POLYGON']			= 'Polygon';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['GROUND_OVERLAY']	= 'Grafik-Überlagerung';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['NONE']				= 'Keine Aktion';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['LINK']				= 'Direkte Verlinkung der Markierung';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['INFO']				= 'Infoblase öffnen';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['SIMPLE']			= 'Standard-Markierung von Google';
$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references']['ICON']				= 'Individuelles Icon';

?>