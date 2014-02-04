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
 * Extend default palette
 */
$GLOBALS['TL_DCA']['tl_user_group']['palettes']['default'] = str_replace('formp;', 'formp;{dlh_googlemaps_legend},dlh_googlemapss,dlh_googlemapsp;', $GLOBALS['TL_DCA']['tl_user_group']['palettes']['default']);


/**
 * Add fields to tl_user_group
 */
$GLOBALS['TL_DCA']['tl_user_group']['fields']['dlh_googlemapss'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['dlh_googlemapss'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'foreignKey'              => 'tl_dlh_googlemaps.title',
	'eval'                    => array('multiple'=>true),
	'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_user_group']['fields']['dlh_googlemapsp'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['dlh_googlemapsp'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'options'                 => array('create', 'delete'),
	'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	'eval'                    => array('multiple'=>true),
	'sql'                     => "blob NULL"
);