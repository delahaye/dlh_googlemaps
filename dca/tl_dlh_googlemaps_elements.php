<?php

/**
 * dlh_googlemaps
 * Extension for Contao Open Source CMS (contao.org)
 *
 * Copyright (c) 2014 de la Haye
 *
 * @package dlh_googlemaps
 * @author  Christian de la Haye
 * @link    http://delahaye.de
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
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
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
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

		'MARKER'                      => '{title_legend},title,type,published;{element_legend},geocoderAddress,geocoderCountry,singleCoords,markerShowTitle,markerType,markerAction;{parameter_legend:hide},zIndex,parameter',
		'MARKERSIMPLE'                => '{title_legend},title,type,published;{element_legend},geocoderAddress,geocoderCountry,singleCoords,markerShowTitle,markerType,fillColor,markerAction;{parameter_legend:hide},zIndex,parameter',
		'MARKERICON'                  => '{title_legend},title,type,published;{element_legend},geocoderAddress,geocoderCountry,singleCoords,markerShowTitle,markerType,iconSRC,iconSize,iconAnchor,hasShadow,markerAction;{parameter_legend:hide},zIndex,parameter',

		'MARKERSIMPLEINFO'            => '{title_legend},title,type,published;{element_legend},geocoderAddress,geocoderCountry,singleCoords,markerShowTitle,markerType,fillColor,markerAction,useRouting,infoWindowSize,infoWindowAnchor,popupInfoWindow,infoWindow;{parameter_legend:hide},zIndex,parameter',
		'MARKERICONINFO'              => '{title_legend},title,type,published;{element_legend},geocoderAddress,geocoderCountry,singleCoords,markerShowTitle,markerType,iconSRC,iconSize,iconAnchor,hasShadow,markerAction,useRouting,infoWindowSize,infoWindowAnchor,popupInfoWindow,infoWindow;{parameter_legend:hide},zIndex,parameter',
		'MARKERSIMPLELINK'            => '{title_legend},title,type,published;{element_legend},geocoderAddress,geocoderCountry,singleCoords,markerShowTitle,markerType,fillColor,markerAction,url,target,linkTitle;{parameter_legend:hide},zIndex,parameter',
		'MARKERICONLINK'              => '{title_legend},title,type,published;{element_legend},geocoderAddress,geocoderCountry,singleCoords,markerShowTitle,markerType,iconSRC,iconSize,iconAnchor,hasShadow,markerAction,url,target,linkTitle;{parameter_legend:hide},zIndex,parameter',

		'INFOWINDOW'                  => '{title_legend},title,type,published;{element_legend},geocoderAddress,geocoderCountry,singleCoords,infoWindowSize,infoWindow;{parameter_legend},zIndex,parameter',
		'POLYLINE'                    => '{title_legend},title,type,published;{element_legend},multiCoords,strokeColor,strokeOpacity,strokeWeight;{parameter_legend:hide},zIndex,parameter',

		'POLYGON'                     => '{title_legend},title,type,published;{element_legend},multiCoords,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction;{parameter_legend:hide},zIndex,parameter',
		'POLYGONINFO'                 => '{title_legend},title,type,published;{element_legend},multiCoords,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction,infoWindowSize,infoWindowAnchor,popupInfoWindow,infoWindow;{parameter_legend:hide},zIndex,parameter',
		'POLYGONLINK'                 => '{title_legend},title,type,published;{element_legend},multiCoords,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction,url,target,linkTitle;{parameter_legend:hide},zIndex,parameter',

		'GROUND_OVERLAY'              => '{title_legend},title,type,published;{element_legend},overlaySRC,bounds,markerAction;{parameter_legend:hide},parameter',
		'GROUND_OVERLAYINFO'          => '{title_legend},title,type,published;{element_legend},overlaySRC,bounds,markerAction,infoWindowSize,infoWindowAnchor,popupInfoWindow,infoWindow;{parameter_legend:hide},parameter',
		'GROUND_OVERLAYLINK'          => '{title_legend},title,type,published;{element_legend},overlaySRC,bounds,markerAction,url,target,linkTitle;{parameter_legend:hide},parameter',

		'RECTANGLE'                   => '{title_legend},title,type,published;{element_legend},bounds,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction;{parameter_legend:hide},zIndex,parameter',
		'RECTANGLEINFO'               => '{title_legend},title,type,published;{element_legend},bounds,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction,infoWindowSize,infoWindowAnchor,popupInfoWindow,infoWindow;{parameter_legend:hide},zIndex,parameter',
		'RECTANGLELINK'               => '{title_legend},title,type,published;{element_legend},bounds,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction,url,target,linkTitle;{parameter_legend:hide},zIndex,parameter',

		'CIRCLE'                      => '{title_legend},title,type,published;{element_legend},geocoderAddress,geocoderCountry,singleCoords,radius,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction;{parameter_legend:hide},zIndex,parameter',
		'CIRCLEINFO'                  => '{title_legend},title,type,published;{element_legend},geocoderAddress,geocoderCountry,singleCoords,radius,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction,infoWindowSize,infoWindowAnchor,popupInfoWindow,infoWindow;{parameter_legend:hide},zIndex,parameter',
		'CIRCLELINK'                  => '{title_legend},title,type,published;{element_legend},geocoderAddress,geocoderCountry,singleCoords,radius,strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity,markerAction,url,target,linkTitle;{parameter_legend:hide},zIndex,parameter',

        'KML'                         => '{title_legenda},title,type,published;{element_legend},kmlUrl,kmlClickable,kmlPreserveViewport,kmlScreenOverlays,kmlSuppressInfowindows'
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
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey'              => 'tl_dlh_googlemaps.title',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
		),
		'sorting' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['type'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => array('MARKER','INFOWINDOW','POLYLINE','POLYGON','GROUND_OVERLAY','RECTANGLE','CIRCLE', 'KML'),
			'default'                 => 'MARKER',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
        'geocoderAddress' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['geocoderAddress'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'geocoderCountry' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['geocoderCountry'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'select',
            'options'                 => $this->getCountries(),
            'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(2) NOT NULL default 'de'"
        ),
		'singleCoords' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['singleCoords'],
			'exclude'                 => true,
			'search'                  => true,
            'inputType'               => 'text',
			'eval'                    => array('maxlength'=>64),
			'sql'                     => "varchar(64) NOT NULL default ''",
            'load_callback' => array
            (
                array('tl_dlh_googlemaps_elements', 'getDefaultCoords')
            ),
            'save_callback' => array
            (
                array('tl_dlh_googlemaps_elements', 'generateCoords')
            )
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
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "varchar(32) NOT NULL default ''"
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
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'clr'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'multiCoords' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['multiCoords'],
			'exclude'                 => true,
			'inputType'               => 'listWizard',
			'eval'                    => array('mandatory'=>true, 'files'=>true, 'filesOnly'=>true,'extensions'=>'csv', 'fieldType'=>'checkbox'),
			'sql'                     => "blob NULL",
            'xlabel' => array
            (
                array('tl_dlh_googlemaps_elements', 'coordsImportWizard')
            ),
		),
		'markerShowTitle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['markerShowTitle'],
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'overlaySRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['overlaySRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'filesOnly'=>true, 'extensions'=>'gif,jpg,jpeg,png', 'mandatory'=>true, 'tl_class'=>'clr'),
			'sql'                     => "binary(16) NULL"
		),
		'iconSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['iconSRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'filesOnly'=>true, 'extensions'=>'gif,jpg,jpeg,png', 'mandatory'=>true, 'tl_class'=>'clr'),
			'sql'                     => "binary(16) NULL"
		),
		'iconSize' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['iconSize'],
			'default'                 => array('16','16','px'),
			'exclude'                 => true,
			'inputType'               => 'imageSize',
			'options'                 => array('px'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50', 'mandatory'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'iconAnchor' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['iconAnchor'],
			'exclude'                 => true,
			'default'                 => array('0','0','px'),
			'inputType'               => 'imageSize',
			'options'                 => array('px'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'digit', 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'hasShadow' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['hasShadow'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true, 'style'=>'margin-top: 12px;'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'shadowSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['shadowSRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'extensions'=>'gif,jpg,jpeg,png', 'tl_class'=>'clr', 'mandatory'=>true),
			'sql'                     => "binary(16) NULL"
		),
		'shadowSize' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['shadowSize'],
			'default'                 => array('32','32','px'),
			'exclude'                 => true,
			'inputType'               => 'imageSize',
			'options'                 => array('px'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'strokeColor' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['strokeColor'],
			'default'                 => '000000',
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>6, 'isHexColor'=>true, 'colorpicker'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard', 'mandatory'=>true),
			'sql'                     => "varchar(6) NOT NULL default ''",
		),
		'strokeOpacity' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['strokeOpacity'],
			'inputType'               => 'inputUnit',
			'default'                 => '100',
			'options'                 => array('%'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'prcnt', 'mandatory'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'strokeWeight' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['strokeWeight'],
			'inputType'               => 'inputUnit',
			'default'                 => '1',
			'options'                 => array('px'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'fillColor' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['fillColor'],
			'inputType'               => 'text',
			'default'                 => '',
			'eval'                    => array('maxlength'=>6, 'isHexColor'=>true, 'colorpicker'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(6) NOT NULL default ''",
		),
		'fillOpacity' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['fillOpacity'],
			'inputType'               => 'inputUnit',
			'default'                 => '100',
			'options'                 => array('%'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'prcnt', 'mandatory'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'radius' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['radius'],
			'inputType'               => 'inputUnit',
			'default'                 => '1000',
			'options'                 => array('m'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'digit'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'bounds' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['bounds'],
			'exclude'                 => true,
			'inputType'               => 'imageSize',
			'options'                 => array('latlng'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('mandatory'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'zIndex' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['zIndex'],
			'exclude'                 => true,
			'default'                 => '1',
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>16, 'rgxp'=>'digit'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'popupInfoWindow' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['popupInfoWindow'],
			'exclude'                 => true,
			'filter'                  => true,
			'default'                 => false,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'useRouting' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['useRouting'],
			'exclude'                 => true,
			'filter'                  => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'routingAddress' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['routingAddress'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'long clr'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'infoWindow' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['infoWindow'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE', 'helpwizard'=>true),
			'explanation'             => 'insertTags',
			'sql'                     => "text NULL"
		),
        'infoWindowSize' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['infoWindowSize'],
            'exclude'                 => true,
            'default'                 => array('0','0','px'),
            'inputType'               => 'imageSize',
            'options'                 => array('px'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
            'eval'                    => array('rgxp'=>'digit'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
		'infoWindowAnchor' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['infoWindowAnchor'],
			'exclude'                 => true,
			'default'                 => array('0','0','px'),
			'inputType'               => 'imageSize',
			'options'                 => array('px'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['references'],
			'eval'                    => array('rgxp'=>'digit'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'url' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['url'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50 wizard', 'mandatory'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''",
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
			'eval'                    => array('tl_class'=>'w50 m12'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'linkTitle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['linkTitle'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'parameter' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['parameter'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('allowHtml'=>true, 'class'=>'monospace', 'helpwizard'=>true),
			'explanation'             => 'insertTags',
			'sql'                     => "text NULL"
		),
        'kmlUrl' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['kmlUrl'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50', 'mandatory'=>true),
            'sql'                     => "varchar(255) NOT NULL default ''",
        ),
        'kmlClickable' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['kmlClickable'],
            'exclude'                 => true,
            'filter'                  => true,
            'default'                 => true,
            'eval'                    => array('tl_class'=>'clr m12'),
            'inputType'               => 'checkbox',
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'kmlPreserveViewport' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['kmlPreserveViewport'],
            'exclude'                 => true,
            'filter'                  => true,
            'default'                 => false,
            'eval'                    => array('tl_class'=>'m12'),
            'inputType'               => 'checkbox',
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'kmlScreenOverlays' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['kmlScreenOverlays'],
            'exclude'                 => true,
            'filter'                  => true,
            'default'                 => false,
            'default'                 => true,
            'eval'                    => array('tl_class'=>'m12'),
            'inputType'               => 'checkbox',
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'kmlSuppressInfowindows' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['kmlSuppressInfowindows'],
            'exclude'                 => true,
            'filter'                  => true,
            'default'                 => false,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'m12'),
            'eval'                    => array('doNotCopy'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['published'],
			'exclude'                 => true,
			'filter'                  => true,
            'default'                 => false,
            'eval'                    => array('tl_class'=>'w50 m12'),
            'inputType'               => 'checkbox',
            'sql'                     => "char(1) NOT NULL default ''"
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
     * Add a link to the coordinates items import wizard
     * @return string
     */
    public function coordsImportWizard()
    {
        return ' <a href="' . $this->addToUrl('key=list') . '" title="' . specialchars($GLOBALS['TL_LANG']['MSC']['lw_import'][1]) . '" onclick="Backend.getScrollOffset()">' . Image::getHtml('tablewizard.gif', $GLOBALS['TL_LANG']['MSC']['tw_import'][0], 'style="vertical-align:text-bottom"') . '</a>';
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
     * Get the center coordinates of the map
     * @param string
     * @return string
     */
    public function getDefaultCoords($varValue)
    {
        if($varValue)
        {
            return $varValue;
        }

        $objElement = \delahaye\googlemaps\ElementModel::findByPk(\Input::get('id'));
        $objMap = \delahaye\googlemaps\MapModel::findByPk($objElement->pid);

        $objElement->singleCoords = $objMap->center;
        $objElement->save();

        return $objMap->center;
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

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
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
			$this->log('Not enough permissions to publish/unpublish GM Element ID "'.$intId.'"', __METHOD__, TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

        $objVersions = new Versions('tl_dlh_googlemaps_elements', $intId);
        $objVersions->initialize();
	
		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['fields']['published']['save_callback'] as $callback)
			{
                if (is_array($callback))
                {
                    $this->import($callback[0]);
                    $blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
                }
                elseif (is_callable($callback))
                {
                    $blnVisible = $callback($blnVisible, $this);
                }
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_dlh_googlemaps_elements SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

        $objVersions->create();
        $this->log('A new version of record "tl_dlh_googlemaps_elements.id='.$intId.'" has been created'.$this->getParentEntries('tl_dlh_googlemaps', $intId), __METHOD__, TL_GENERAL);
	}


	/**
	 * Update the palettes
	 * @param object
	 */
	public function updatePalette(DataContainer $dc)
	{

        $objElement = \delahaye\googlemaps\ElementModel::findByPk($dc->id);

		if ($objElement && \Input::get('act') == 'edit'){

            if($objElement->type == 'MARKER') {
                if($objElement->markerType == 'SIMPLE') {
                    $GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['fields']['fillColor']['eval']['mandatory'] = false;
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
                if($objElement->type == 'KML') {
                    $GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes'][$objElement->type] = $GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes']['KML'];
                } elseif($objElement->markerAction == 'LINK') {
                    $GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes'][$objElement->type] = $GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes'][$objElement->type.'LINK'];
                } elseif($objElement->markerAction == 'INFO') {
                    $GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes'][$objElement->type] = $GLOBALS['TL_DCA']['tl_dlh_googlemaps_elements']['palettes'][$objElement->type.'INFO'];
                }
            }

		}

    }


    /**
     * Get geo coodinates from address
     * @param string
     * @param object
     * @return string
     */
    function generateCoords($varValue, DataContainer $dc)
    {
        return $varValue ? $varValue : \delahaye\GeoCode::getCoordinates($dc->activeRecord->geocoderAddress, $dc->activeRecord->geocoderCountry, 'de');
    }


    /**
     * Return the link picker wizard
     * @param \DataContainer
     * @return string
     */
    public function pagePicker(DataContainer $dc)
    {
        return ' <a href="contao/page.php?do='.Input::get('do').'&amp;table='.$dc->table.'&amp;field='.$dc->field.'&amp;value='.str_replace(array('{{link_url::', '}}'), '', $dc->value).'" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':765,\'title\':\''.specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MOD']['page'][0])).'\',\'url\':this.href,\'id\':\''.$dc->field.'\',\'tag\':\'ctrl_'.$dc->field . ((Input::get('act') == 'editAll') ? '_' . $dc->id : '').'\',\'self\':this});return false">' . Image::getHtml('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer"') . '</a>';
    }

}

?>