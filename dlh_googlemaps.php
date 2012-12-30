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
 * Class dlh_googlemaps
 *
 * @copyright  Christian de la Haye 2010
 * @author     Christian de la Haye 
 * @package    Controller
 */
class dlh_googlemaps extends Frontend
{

	/**
	 * Render Map
	 */
	public function render_dlh_googlemap($base,$map,$size,$zoom)
	{
		global $objPage;

		if ($objPage->outputFormat != '')
		{
			$strFormat = $objPage->outputFormat;
		}
		$tagEnding = ($strFormat == 'xhtml') ? ' />' : '>';

		$map['language'] = $GLOBALS['TL_LANGUAGE'];
		$map['mapSize'] = deserialize($map['mapSize']);
		$map['mapSize'][2]=str_replace('pcnt','%',$map['mapSize'][2]);
		$tmpSize = deserialize($size);
		$tmpSize[2]=str_replace('pcnt','%',$tmpSize[2]);
		if(is_array($tmpSize) && $tmpSize[0] > 0 && $tmpSize[1] > 0) {
			$map['mapSize'] = $tmpSize;
		}
		if($zoom > 0) {
			$map['zoom'] = $zoom;
		}
		$map['streetViewControl'] = $map['streetViewControl'] ? 'true' : 'false';
		$map['scrollwheel'] = $map['scrollwheel'] ? 'true' : 'false';
		$map['draggable'] = $map['draggable'] ? 'true' : 'false';
		$map['disableDoubleClickZoom'] = $map['disableDoubleClickZoom'] ? 'true' : 'false';
		$map['mapTypesAvailable'] = deserialize($map['mapTypesAvailable']);
		$map['geocoderAddress'] = $map['geocoderAddress'] ? addslashes($map['geocoderAddress']) : false;
		$map['center'] = str_replace(' ','',$map['center']);

		// generate static map
		$this->import('Environment');
		$map['staticMap'] = '<img src="http'.($this->Environment->ssl ? 's' : '').'://maps.google.com/maps/api/staticmap?center=' . $map['center'] . '&amp;zoom=' . $map['zoom'] . '&amp;maptype=' . strtolower($map['mapTypeId']) . '&amp;sensor=' . $map['sensor'] . '&amp;language=' . $map['language'] . '&amp;size=';
		if($map['mapSize'][2] == 'px') {
			$map['staticMap'] .= $map['mapSize'][0].'x'.$map['mapSize'][1];
		} else {
			$map['staticMap'] .= '800x600';
		}

		foreach($map['elements'] as $k=>$v) {
			$map['elements'][$k]['singleCoords'] = str_replace(' ','',$map['elements'][$k]['singleCoords']);
			$map['elements'][$k]['multiCoords'] = deserialize($v['multiCoords']);
			if(is_array($map['elements'][$k]['multiCoords'])) {
				$tmp1 = array();
				foreach($map['elements'][$k]['multiCoords'] as $coords) {
					$tmp2 = explode(',',$coords);
					$tmp1[0][] = $tmp2[0];
					$tmp1[1][] = $tmp2[1];
				}
				$map['elements'][$k]['windowPosition'] = array_sum($tmp1[0])/sizeof($tmp1[0]).','.array_sum($tmp1[1])/sizeof($tmp1[1]);
			}
			$map['elements'][$k]['iconSize'] = deserialize($v['iconSize']);
			$map['elements'][$k]['iconAnchor'] = deserialize($v['iconAnchor']);
			if(!$map['elements'][$k]['iconAnchor'][0] && !$map['elements'][$k]['iconAnchor'][1]) {
				$map['elements'][$k]['iconAnchor'][0] = floor($map['elements'][$k]['iconSize'][0]/2);
				$map['elements'][$k]['iconAnchor'][1] = '0';
			}
			if (is_numeric($map['elements'][$k]['overlaySRC'])){
				$objFile = \FilesModel::findByPk($map['elements'][$k]['overlaySRC']);
				$map['elements'][$k]['overlaySRC'] = $objFile->path;
			}
			if (is_numeric($map['elements'][$k]['shadowSRC'])){
				$objFile = \FilesModel::findByPk($map['elements'][$k]['shadowSRC']);
				$map['elements'][$k]['shadowSRC'] = $objFile->path;
			}
			$map['elements'][$k]['shadowSize'] = deserialize($v['shadowSize']);
			$map['elements'][$k]['strokeWeight'] = deserialize($v['strokeWeight']);
			$tmp1 = deserialize($v['strokeOpacity']);
			if (isset($tmp1['value'])) {
			$map['elements'][$k]['strokeOpacity'] = ($tmp1['value']/100);
			} 
			$tmp1 = deserialize($v['fillOpacity']);
			if (isset($tmp1['value'])) {
			$map['elements'][$k]['fillOpacity'] = ($tmp1['value']/100);
			} 
			$map['elements'][$k]['radius'] = deserialize($v['radius']);
			$map['elements'][$k]['bounds'] = deserialize($v['bounds']);
			$tmp1 = explode(',',$map['elements'][$k]['bounds'][0]);
			$tmp2 = explode(',',$map['elements'][$k]['bounds'][1]);
			$map['elements'][$k]['bounds'][2] = (trim($tmp1[0]).trim($tmp2[0]))/2 . ',' . (trim($tmp1[1]).trim($tmp2[1]))/2;
			$map['elements'][$k]['infoWindow'] = preg_replace('/[\n\r\t]+/i', '', addslashes(str_replace('','', $this->replaceInsertTags($map['elements'][$k]['infoWindow']))));
			$map['elements'][$k]['infoWindowAnchor'] = deserialize($v['infoWindowAnchor']);
			$map['elements'][$k]['routingAddress'] = addslashes(str_replace('
','',$map['elements'][$k]['routingAddress']));

			switch($map['elements'][$k]['type']) {
				case 'MARKER':
					$map['staticMap'] .= '&amp;markers=';
					if($map['elements'][$k]['markerType'] == 'ICON') {
						if (is_numeric($map['elements'][$k]['iconSRC'])){
							$objFile = \FilesModel::findByPk($map['elements'][$k]['iconSRC']);
							$map['elements'][$k]['iconSRC'] = $objFile->path;
						}
						$map['staticMap'] .= 'icon:'.urlencode($base.$map['elements'][$k]['iconSRC']).'|shadow:false|';
					}
					$map['staticMap'] .= $map['elements'][$k]['singleCoords'];
					break;
				case 'POLYLINE':
					if(is_array($map['elements'][$k]['multiCoords']) && count($map['elements'][$k]['multiCoords'])>0) {
						$map['staticMap'] .= '&amp;path=weight:'.$map['elements'][$k]['strokeWeight']['value'].'|color:0x'.$map['elements'][$k]['strokeColor'].dechex($map['elements'][$k]['strokeOpacity']*255);
						foreach($map['elements'][$k]['multiCoords'] as $coords) {
							$map['staticMap'] .= '|'.str_replace(' ','',$coords);
						}
					}
					break;
				case 'POLYGON':
					if(is_array($map['elements'][$k]['multiCoords']) && count($map['elements'][$k]['multiCoords'])>0) {
						$map['staticMap'] .= '&amp;path=weight:'.$map['elements'][$k]['strokeWeight']['value'].'|color:0x'.$map['elements'][$k]['strokeColor'].dechex($map['elements'][$k]['strokeOpacity']*255).'|fillcolor:0x'.$map['elements'][$k]['fillColor'].dechex($map['elements'][$k]['fillOpacity']*255);
						foreach($map['elements'][$k]['multiCoords'] as $coords) {
							$map['staticMap'] .= '|'.str_replace(' ','',$coords);
						}
						$map['staticMap'] .= '|'.str_replace(' ','',$map['elements'][$k]['multiCoords'][0]);
					}
					break;
			}

		}

		$map['staticMap'] .= '" alt="' . $GLOBALS['TL_LANG']['tl_dlh_googlemaps']['labels']['noscript'] . '"'.$tagEnding;

		return $map;
	}
}

?>