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
 * Table tl_dlh_googlemaps
 */
$GLOBALS['TL_DCA']['tl_dlh_googlemaps'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_dlh_googlemaps_elements'),
		'switchToEdit'                => true,
		'enableVersioning'            => true
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('title'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;search,limit'
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s',
			'label_callback'   => array('tl_dlh_googlemaps', 'listRecords')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['edit'],
				'href'                => 'table=tl_dlh_googlemaps_elements',
				'icon'                => 'edit.gif',
				'attributes'          => 'class="contextmenu"'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'button_callback'     => array('tl_dlh_googlemaps', 'editHeader'),
				'attributes'          => 'class="edit-header"'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['tl_dlh_googlemaps']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('useMapTypeControl', 'useNavigationControl', 'useScaleControl'),
		'default'                     => '{title_legend},title,geocoderAddress,geocoderCountry,center,mapSize,zoom;{maptype_legend:hide},mapTypeId,mapTypesAvailable,streetViewControl,disableDoubleClickZoom,draggable,scrollwheel,staticMapNoscript,sensor;{maptypecontrols_legend:hide},useMapTypeControl;{navigationcontrol_legend:hide},useNavigationControl;{scalecontrol_legend:hide},useScaleControl;{parameter_legend:hide},parameter'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'useMapTypeControl'          => 'mapTypeControlStyle,mapTypeControlPos',
		'useNavigationControl'        => 'navigationControlStyle,navigationControlPos',
		'useScaleControl'             => 'scaleControlPos'
	),

	// Fields
	'fields' => array
	(
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255)
		),
		'center' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['center'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>64),
			'save_callback' => array
			(
				array('tl_dlh_googlemaps', 'generateCoords')
			)
		),
		'geocoderAddress' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['geocoderAddress'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'long clr')
		),
		'geocoderCountry' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['geocoderCountry'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
			'options'                 => $this->getCountries(),
			'eval'                    => array('includeBlankOption'=>true)
		),
		'mapSize' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapSize'],
			'exclude'                 => true,
			'inputType'               => 'imageSize',
			'options'                 => array('px', 'pcnt', 'em', 'pt', 'pc', 'in', 'cm', 'mm'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit')
		),
		'zoom' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['zoom'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20'),
			'default'                 => '10',
			'eval'                    => array('mandatory'=>true)
		),
		'mapTypeId' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypeId'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => array('HYBRID','ROADMAP','SATELLITE','TERRAIN'),
			'default'                 => 'ROADMAP',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('mandatory'=>true)
		),
		'mapTypesAvailable' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypesAvailable'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'options'                 => array('HYBRID','ROADMAP','SATELLITE','TERRAIN'),
			'default'                 => serialize(array('HYBRID','ROADMAP','SATELLITE','TERRAIN')),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('mandatory'=>true, 'multiple'=>true)
		),
		'staticMapNoscript' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['staticMapNoscript'],
			'exclude'                 => true,
			'default'                 => false,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50')
		),
		'sensor' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['sensor'],
			'exclude'                 => true,
			'filter'                  => true,
			'default'                 => false,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50')
		),
		'useMapTypeControl' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useMapTypeControls'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true)
		),
		'mapTypeControlStyle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypeControlStyle'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('DEFAULT','DROPDOWN_MENU','HORIZONTAL_BAR'),
			'default'                 => 'DEFAULT',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('mandatory'=>true)
		),
		'mapTypeControlPos' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypeControlPos'],
			'exclude'                 => true,
			'inputType'               => 'radioTable',
			'options'                 => array('TOP_LEFT','TOP_CENTER','TOP_RIGHT','LEFT_TOP','C1','RIGHT_TOP','LEFT_CENTER','C2','RIGHT_CENTER','LEFT_BOTTOM','C3','RIGHT_BOTTOM','BOTTOM_LEFT','BOTTOM_CENTER','BOTTOM_RIGHT'),
			'default'                 => 'TOP_RIGHT',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('cols'=>3,'tl_class'=>'dlh_googlemaps_position')
		),
		'useNavigationControl' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useNavigationControl'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true)
		),
		'navigationControlStyle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['navigationControl'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('ANDROID','DEFAULT','SMALL','ZOOM_PAN'),
			'default'                 => 'DEFAULT',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('mandatory'=>true)
		),
		'navigationControlPos' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['navigationControlPos'],
			'exclude'                 => true,
			'inputType'               => 'radioTable',
			'options'                 => array('TOP_LEFT','TOP_CENTER','TOP_RIGHT','LEFT_TOP','C1','RIGHT_TOP','LEFT_CENTER','C2','RIGHT_CENTER','LEFT_BOTTOM','C3','RIGHT_BOTTOM','BOTTOM_LEFT','BOTTOM_CENTER','BOTTOM_RIGHT'),
			'default'                 => 'TOP_LEFT',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('cols'=>3,'tl_class'=>'dlh_googlemaps_position')
		),
		'streetViewControl' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['streetViewControl'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50')
		),
		'disableDoubleClickZoom' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['disableDoubleClickZoom'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50')
		),
		'scrollwheel' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['scrollwheel'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50')
		),
		'draggable' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['draggable'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50')
		),
		'useScaleControl' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useScaleControl'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true)
		),
		'scaleControlPos' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['scaleControlPos'],
			'exclude'                 => true,
			'inputType'               => 'radioTable',
			'options'                 => array('TOP_LEFT','TOP_CENTER','TOP_RIGHT','LEFT_TOP','C1','RIGHT_TOP','LEFT_CENTER','C2','RIGHT_CENTER','LEFT_BOTTOM','C3','RIGHT_BOTTOM','BOTTOM_LEFT','BOTTOM_CENTER','BOTTOM_RIGHT'),
			'default'                 => 'BOTTOM_LEFT',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('cols'=>3,'tl_class'=>'dlh_googlemaps_position')
		),
		'parameter' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['parameter'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('allowHtml'=>true, 'class'=>'monospace', 'helpwizard'=>true),
			'explanation'             => 'insertTags'
		)
	)
);


/**
 * Class tl_dlh_googlemaps
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Christian de la Haye 2010
 * @author     Christian de la Haye 
 * @package    Controller
 */
class tl_dlh_googlemaps extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	/**
	 * Return the edit header button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function editHeader($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || count(preg_grep('/^tl_dlh_googlemaps::/', $this->User->alexf)) > 0) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ' : '';
	}

	/**
	 * Get geo coodinates drom address
	 * @param string
	 * @return string
	 */
	function generateCoords($varValue, DataContainer $dc) 
	{
		if (!$varValue)
		{
			$objGeo = $this->Database->prepare("SELECT geocoderAddress,geocoderCountry FROM tl_dlh_googlemaps WHERE id=?")
									   ->limit(1)
									   ->execute($dc->id);
			if ($objGeo->geocoderAddress)
			{
				$coords = $this->geocode($objGeo->geocoderAddress, null, $strLang = 'de', $objGeo->geocoderCountry);
				if($coords)
				{
					$varValue = $coords['lat'] . ',' . $coords['lng'];
				}
		  		elseif(function_exists("curl_init"))
		  		{
					$strGeoURL = 'http://maps.google.com/maps/api/geocode/xml?address='.str_replace(' ', '+', $objGeo->geocoderAddress).'&sensor=false'.($objGeo->geocoderCountry ? '&region='.$objGeo->geocoderCountry : '');

			  		$curl = curl_init();
			  		if($curl)
  					{
    					if(curl_setopt($curl, CURLOPT_URL, $strGeoURL) && curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1) && curl_setopt($curl, CURLOPT_HEADER, 0))
    					{
	    					$curlVal = curl_exec($curl);
    						curl_close($curl);
							$xml = new SimpleXMLElement($curlVal);
							if($xml)
							{
								$varValue = $xml->result->geometry->location->lat . ',' . $xml->result->geometry->location->lng;
							}
    					}
  					} else {
  						$varValue = $GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['noCurl'];
  					}
	  			}
			}
			if (!$varValue)
			{
				$varValue = $GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references']['noCoords'];
			}
		}
		return $varValue;
	}

	/**
	 * Get geo coordinates from address, thanks to Oliver Hoff <oliver@hofff.com>
	 * @param array
	 * @return string
	 */
	private $arrGeocodeCache = array();
	public function geocode($varAddress, $blnReturnAll = false, $strLang = 'en', $strRegion = null, array $arrBounds = null) {
		
		if(is_array($varAddress))
			$varAddress = implode(' ', $varAddress);
		
		$varAddress = trim($varAddress);
		
		if(!strlen($varAddress) || !strlen($strLang))
			return;
		
		if($strRegion !== null && !strlen($strRegion))
			return;
			
		if($arrBounds !== null) {
			if(!is_array($arrBounds) || !is_array($arrBounds['tl']) || !is_array($arrBounds['br'])
			|| !is_numeric($arrBounds['tl']['lat']) || !is_numeric($arrBounds['tl']['lng'])
			|| !is_numeric($arrBounds['br']['lat']) || !is_numeric($arrBounds['br']['lng']))
				return;
		}
		
		$strURL = sprintf(
			'http://maps.google.com/maps/api/geocode/json?address=%s&sensor=false&language=%s&region=%s&bounds=%s',
			urlencode($varAddress),
			urlencode($strLang),
			strlen($strRegion) ? urlencode($strRegion) : '',
			$arrBounds ? implode(',', $arrBounds['tl']) . '|' . implode(',', $arrBounds['br']) : ''
		);
		
		if(!isset($this->arrGeocodeCache[$strURL])) {
			$arrGeo = json_decode(file_get_contents($strURL), true);
			$this->arrGeocodeCache[$strURL] = $arrGeo['status'] == 'OK' ? $arrGeo['results'] : false;
		}
		
		if(!$this->arrGeocodeCache[$strURL])
			return;
		
		return $blnReturnAll ? $this->arrGeocodeCache[$strURL] : array(
			'lat' => $this->arrGeocodeCache[$strURL][0]['geometry']['location']['lat'],
			'lng' => $this->arrGeocodeCache[$strURL][0]['geometry']['location']['lng']
		);
	}


	/**
	 * List records
	 * @param array
	 * @return string
	 */
	public function listRecords($arrRow)
	{
		$return = '<strong>'.$arrRow['title'].'</strong>';
		if($arrRow['center'] && $arrRow['zoom'] && $arrRow['mapTypeId']) {
			$src = 'http://maps.google.com/maps/api/staticmap?center=' . $arrRow['center'] . '&zoom=' . ($arrRow['zoom']-2) . '&maptype=' . strtolower($arrRow['mapTypeId']) . '&sensor=false&language=' . $GLOBALS['TL_LANGUAGE'] . '&size=300x150';
			$return .= '<div style="margin-top:5px;margin-bottom:20px;"><img src="'.$src.'" alt="" /></div>';
		}

		return $return;
	}


}

?>