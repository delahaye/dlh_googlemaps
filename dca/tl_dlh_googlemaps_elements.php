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
 * Load tl_content language file
 */
$this->loadLanguageFile('tl_content');


/**
 * Table tl_dlh_googlemaps_elements
 */
$GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_dlh_googlemaps',
		'enableVersioning'            => true,
		'onload_callback'             => array
		(
			array('tl_dlh_googlemaps_elements', 'updatePalette')
		) 
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('sorting'),
			'panelLayout'             => 'filter;sort,search,limit',
			'headerFields'            => array('title','centerCoords'),
			'child_record_callback'   => array('tl_dlh_googlemaps_elements', 'listElements')
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
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
				'button_callback'     => array('tl_dlh_googlemaps_elements', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('type','markerType','markerAction','hasShadow','useRouting'),
		'default'                     => '{title_legend},title,type,published',

		'MARKER'                      => '{title_legend},title,type,published;{element_legend},singleCoords,markerShowTitle,markerType,markerAction;{parameter_legend:hide},zIndex,parameter',
		'MARKERSIMPLE'                => '{title_legend},title,type,published;{element_legend},singleCoords,markerShowTitle,markerType,markerAction;{parameter_legend:hide},zIndex,parameter',
		'MARKERICON'                  => '{title_legend},title,type,published;{element_legend},singleCoords,markerShowTitle,markerType,iconSRC,iconSize,iconAnchor,hasShadow,markerAction;{parameter_legend:hide},zIndex,parameter',

		'MARKERSIMPLEINFO'            => '{title_legend},title,type,published;{element_legend},singleCoords,markerShowTitle,markerType,markerAction,useRouting,infoWindowAnchor,popupInfoWindow,infoWindow;{parameter_legend:hide},zIndex,parameter',
		'MARKERICONINFO'              => '{title_legend},title,type,published;{element_legend},singleCoords,markerShowTitle,markerType,iconSRC,iconSize,iconAnchor,hasShadow,markerAction,useRouting,infoWindowAnchor,popupInfoWindow,infoWindow;{parameter_legend:hide},zIndex,parameter',
		'MARKERSIMPLELINK'            => '{title_legend},title,type,published;{element_legend},singleCoords,markerShowTitle,markerType,markerAction,url,target,linkTitle;{parameter_legend:hide},zIndex,parameter',
		'MARKERICONLINK'              => '{title_legend},title,type,published;{element_legend},singleCoords,markerShowTitle,markerType,iconSRC,iconSize,iconAnchor,hasShadow,markerAction,url,target,linkTitle;{parameter_legend:hide},zIndex,parameter',

		'INFOWINDOW'                  => '{title_legend},title,type,published;{element_legend},singleCoords,infoWindow;{parameter_legend},zIndex,parameter',
		'POLYLINE'                    => '{title_legend},title,type,published;{element_legend},multiCoords,strokeColor,strokeOpacity,strokeWeight;{parameter_legend:hide},zIndex,parameter',

		'POLYGON'                     => '{title_legend},title,type,published;{element_legend},multiCoords,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction;{parameter_legend:hide},zIndex,parameter',
		'POLYGONINFO'                 => '{title_legend},title,type,published;{element_legend},multiCoords,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction,infoWindowAnchor,popupInfoWindow,infoWindow;{parameter_legend:hide},zIndex,parameter',
		'POLYGONLINK'                 => '{title_legend},title,type,published;{element_legend},multiCoords,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction,url,target,linkTitle;{parameter_legend:hide},zIndex,parameter',

		'GROUND_OVERLAY'              => '{title_legend},title,type,published;{element_legend},overlaySRC,bounds,markerAction;{parameter_legend:hide},parameter',
		'GROUND_OVERLAYINFO'          => '{title_legend},title,type,published;{element_legend},overlaySRC,bounds,markerAction,infoWindowAnchor,popupInfoWindow,infoWindow;{parameter_legend:hide},parameter',
		'GROUND_OVERLAYLINK'          => '{title_legend},title,type,published;{element_legend},overlaySRC,bounds,markerAction,url,target,linkTitle;{parameter_legend:hide},parameter',

		'RECTANGLE'                   => '{title_legend},title,type,published;{element_legend},bounds,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction;{parameter_legend:hide},zIndex,parameter',
		'RECTANGLEINFO'               => '{title_legend},title,type,published;{element_legend},bounds,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction,infoWindowAnchor,popupInfoWindow,infoWindow;{parameter_legend:hide},zIndex,parameter',
		'RECTANGLELINK'               => '{title_legend},title,type,published;{element_legend},bounds,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction,url,target,linkTitle;{parameter_legend:hide},zIndex,parameter',

		'CIRCLE'                      => '{title_legend},title,type,published;{element_legend},singleCoords,radius,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction;{parameter_legend:hide},zIndex,parameter',
		'CIRCLEINFO'                  => '{title_legend},title,type,published;{element_legend},singleCoords,radius,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction,infoWindowAnchor,popupInfoWindow,infoWindow;{parameter_legend:hide},zIndex,parameter',
		'CIRCLELINK'                  => '{title_legend},title,type,published;{element_legend},singleCoords,radius,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction,url,target,linkTitle;{parameter_legend:hide},zIndex,parameter'

	),

	// Subpalettes
	'subpalettes' => array
	(
		'hasShadow'          => 'shadowSRC,shadowSize',
		'useRouting'         => 'routingAddress'
	),

	// Fields
	'fields' => array
	(
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50')
		),
		'type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['type'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => array('MARKER','INFOWINDOW','POLYLINE','POLYGON','GROUND_OVERLAY','RECTANGLE','CIRCLE'),
			'default'                 => 'MARKER',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50')
		),
		'singleCoords' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['singleCoords'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>64, 'mandatory'=>true)
		),
		'markerType' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['markerType'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'radio',
			'options'                 => array('SIMPLE','ICON'),
			'default'                 => 'SIMPLE',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('submitOnChange'=>true)
		),
		'markerAction' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['markerAction'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'radio',
			'options'                 => array('NONE','LINK','INFO'),
			'default'                 => 'NONE',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('submitOnChange'=>true)
		),
		'multiCoords' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['multiCoords'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'dlhListWizard',
			'eval'                    => array('mandatory'=>true, 'files'=>true, 'filesOnly'=>true,'extensions'=>'csv', 'fieldType'=>'checkbox'),
			'load_callback'           => array(
				array('tl_dlh_googlemaps_elements', 'setWizLabel')
				)
		),
		'markerShowTitle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['markerShowTitle'],
			'exclude'                 => true,
			'filter'                  => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true)
		),
		'overlaySRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['overlaySRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'extensions'=>'gif,jpg,jpeg,png', 'tl_class'=>'clr', 'mandatory'=>true)
		),
		'iconSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['iconSRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'extensions'=>'gif,jpg,jpeg,png', 'tl_class'=>'clr', 'mandatory'=>true)
		),
		'iconSize' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['iconSize'],
			'default'                 => array('16','16','px'),
			'exclude'                 => true,
			'inputType'               => 'imageSize',
			'options'                 => array('px'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'digit', 'tl_class'=>'w50', 'mandatory'=>true)
		),
		'iconAnchor' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['iconAnchor'],
			'exclude'                 => true,
			'default'                 => array('0','0','px'),
			'inputType'               => 'imageSize',
			'options'                 => array('px'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'digit', 'tl_class'=>'w50')
		),
		'hasShadow' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['hasShadow'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true, 'style'=>'margin-top: 12px;')
		),
		'shadowSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['shadowSRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'extensions'=>'gif,jpg,jpeg,png', 'tl_class'=>'clr', 'mandatory'=>true)
		),
		'shadowSize' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['shadowSize'],
			'default'                 => array('32','32','px'),
			'exclude'                 => true,
			'inputType'               => 'imageSize',
			'options'                 => array('px'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true)
		),
		'strokeColor' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['strokeColor'],
			'default'                 => '000000',
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>6, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard', 'mandatory'=>true),
			'wizard' => array
			(
				array('tl_dlh_googlemaps_elements', 'colorPicker')
			)
		),
		'strokeOpacity' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['strokeOpacity'],
			'inputType'               => 'inputUnit',
			'default'                 => '100',
			'options'                 => array('%'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'prcnt', 'mandatory'=>true)
		),
		'strokeWeight' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['strokeWeight'],
			'inputType'               => 'inputUnit',
			'default'                 => '1',
			'options'                 => array('px'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true)
		),
		'fillColor' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['fillColor'],
			'inputType'               => 'text',
			'default'                 => 'ffffff',
			'eval'                    => array('maxlength'=>6, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard', 'mandatory'=>true),
			'wizard' => array
			(
				array('tl_dlh_googlemaps_elements', 'colorPicker')
			)
		),
		'fillOpacity' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['fillOpacity'],
			'inputType'               => 'inputUnit',
			'default'                 => '100',
			'options'                 => array('%'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'prcnt', 'mandatory'=>true)
		),
		'radius' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['radius'],
			'inputType'               => 'inputUnit',
			'default'                 => '1000',
			'options'                 => array('m'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'digit')
		),
		'bounds' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['bounds'],
			'exclude'                 => true,
			'inputType'               => 'imageSize',
			'options'                 => array('latlng'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('mandatory'=>true)
		),
		'zIndex' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['zIndex'],
			'exclude'                 => true,
			'search'                  => true,
			'default'                 => '1',
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>16, 'rgxp'=>'digit')
		),
		'popupInfoWindow' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['popupInfoWindow'],
			'exclude'                 => true,
			'filter'                  => true,
			'default'                 => false,
			'inputType'               => 'checkbox'
		),
		'useRouting' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['useRouting'],
			'exclude'                 => true,
			'filter'                  => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true)
		),
		'routingAddress' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['routingAddress'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'long clr')
		),
		'infoWindow' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['infoWindow'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE', 'helpwizard'=>true),
			'explanation'             => 'insertTags'
		),
		'infoWindowAnchor' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['infoWindowAnchor'],
			'exclude'                 => true,
			'default'                 => array('0','0','px'),
			'inputType'               => 'imageSize',
			'options'                 => array('px'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'digit')
		),
		'url' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['url'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50 wizard', 'mandatory'=>true),
			'wizard' => array
			(
				array('tl_dlh_googlemaps_elements', 'pagePicker')
			)
		),
		'target' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['target'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50 m12')
		),
		'linkTitle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['linkTitle'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
		),
		'parameter' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['parameter'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('allowHtml'=>true, 'class'=>'monospace', 'helpwizard'=>true),
			'explanation'             => 'insertTags'
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'default'                 => false,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true)
		),
		'sorting' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['MSC']['sorting'],
			'sorting'                 => true,
			'flag'                    => 2,
		)
	)
);


/**
 * Class tl_dlh_googlemaps_elements
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Christian de la Haye 2010
 * @author     Christian de la Haye 
 * @package    Controller
 */
class tl_dlh_googlemaps_elements extends Backend
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
	 * Link to list import wizard
	 * @param string
	 * @param array
	 * @return array
	 */
	public function setWizLabel($value, $dc)
	{
		$GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['fields']['multiCoords']['label'][0] .= '<a href="'.$this->Environment->request.'&amp;field=multiCoords&amp;key=list" title="'.$GLOBALS['TL_LANG']['MSC']['lw_import'][1].'" onclick="Backend.getScrollOffset();"><img src="system/themes/default/images/tablewizard.gif" width="16" height="14" alt="'.$GLOBALS['TL_LANG']['MSC']['lw_import'][0].'" style="vertical-align:text-bottom;"></a>';
		
		return $value;
	}


	/**
	 * List records
	 * @param array
	 * @return string
	 */
	public function listElements($arrRow)
	{
		$key = $arrRow['published'] ? 'published' : 'unpublished';
		$return = '<div class="cte_type ' . $key . '"><strong>' . $arrRow['title'] . '</strong></div><div>' . $GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'][$arrRow['type']] . '</div>' . "\n";

		return $return;
	}


	/**
	 * Return the color picker wizard
	 * @param object
	 * @return string
	 */
	public function colorPicker(DataContainer $dc)
	{
		return ' ' . $this->generateImage('pickcolor.gif', $GLOBALS['TL_LANG']['MSC']['colorpicker'], 'style="vertical-align:top; cursor:pointer;" id="moo_'.$dc->field.'" class="mooRainbow"');
	}


	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_dlh_googlemaps_elements::published', 'alexf'))
		{
			return '';
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}		

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}


	/**
	 * Disable/enable an element
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
		// Check permissions to publish
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_dlh_googlemaps_elements::published', 'alexf'))
		{
			$this->log('Not enough permissions to publish/unpublish GM Element ID "'.$intId.'"', 'tl_dlh_googlemaps_elements toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$this->createInitialVersion('tl_dlh_googlemaps_elements', $intId);
	
		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_dlh_googlemaps_elements SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_dlh_googlemaps_elements', $intId);
	}


	/**
	 * Update the palettes
	 * @param object
	 */
	public function updatePalette(DataContainer $dc)
	{

		$objElement = $this->Database->prepare("SELECT * FROM tl_dlh_googlemaps_elements WHERE id=?")
			->limit(1)
			->execute($dc->id);

		if ($objElement->numRows > 0){

			// set default coordinates from map
			$objMap = $this->Database->prepare("SELECT * FROM tl_dlh_googlemaps WHERE id=?")
				->limit(1)
				->execute($objElement->pid);
			if ($objMap->numRows > 0){
				$GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['fields']['singleCoords']['default'] = $objMap->center;
			}
			if($this->Input->get('act') == 'edit') {
				if($objElement->type == 'MARKER') {
					if($objElement->markerType == 'SIMPLE') {
						if($objElement->markerAction == 'LINK') {
							$GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes']['MARKERSIMPLE'] = $GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes']['MARKERSIMPLELINK'];
						} elseif($objElement->markerAction == 'INFO') {
							$GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes']['MARKERSIMPLE'] = $GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes']['MARKERSIMPLEINFO'];
						}
					} elseif($objElement->markerType == 'ICON') {
						if($objElement->markerAction == 'LINK') {
							$GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes']['MARKERICON'] = $GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes']['MARKERICONLINK'];
						} elseif($objElement->markerAction == 'INFO') {
							$GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes']['MARKERICON'] = $GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes']['MARKERICONINFO'];
						}
					}
				} elseif($objElement->type != 'INFOWINDOW' && $objElement->type != 'POLYLINE') {
					if($objElement->markerAction == 'LINK') {
						$GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes'][$objElement->type] = $GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes'][$objElement->type.'LINK'];
					} elseif($objElement->markerAction == 'INFO') {
						$GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes'][$objElement->type] = $GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes'][$objElement->type.'INFO'];
					}
				}
			}

		}

    }


	/**
	 * Return the link picker wizard
	 * @param object
	 * @return string
	 */
	public function pagePicker(DataContainer $dc)
	{
		if (version_compare(VERSION, '2.11', '>'))
		{
			return ' <a href="contao/page.php?do='.Input::get('do').'&amp;table='.$dc->table.'&amp;field='.$dc->field.'&amp;value='.str_replace(array('{{link_url::', '}}'), '', $dc->value).'" title="'.specialchars($GLOBALS['TL_LANG']['MSC']['pagepicker']).'" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':765,\'title\':\''.specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MOD']['page'][0])).'\',\'url\':this.href,\'id\':\''.$dc->field.'\',\'tag\':\'ctrl_'.$dc->field . ((Input::get('act') == 'editAll') ? '_' . $dc->id : '').'\',\'self\':this});return false">' . $this->generateImage('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer"') . '</a>';
		}
		else
		{
			$strField = 'ctrl_' . $dc->field . (($this->Input->get('act') == 'editAll') ? '_' . $dc->id : '');
			return ' ' . $this->generateImage('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top; cursor:pointer;" onclick="Backend.pickPage(\'' . $strField . '\')"');
		}
	}

}

?>