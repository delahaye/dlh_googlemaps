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
 * Add back end modules
 */

array_insert($GLOBALS['BE_MOD']['content'], sizeof($GLOBALS['BE_MOD']['content']), array('dlh_googlemaps' => array
(
    'tables' 	 => array('tl_dlh_googlemaps', 'tl_dlh_googlemaps_elements'),
    'icon'   	 => 'system/modules/dlh_googlemaps/assets/icon.gif',
    'stylesheet' => 'system/modules/dlh_googlemaps/assets/backend.css',
    'list' 	     => array('dlhCoordsWizard', 'importList')
)
));


/**
 * Add modules
 */

array_insert($GLOBALS['FE_MOD']['miscellaneous'], sizeof($GLOBALS['FE_MOD']['miscellaneous']), array
(
	'dlh_googlemaps' => 'delahaye\googlemaps\ModuleMap'
));


/**
 * Add content elements
 */

array_insert($GLOBALS['TL_CTE']['media'], sizeof($GLOBALS['TL_CTE']['media']), array
(
    'dlh_googlemaps' => 'delahaye\googlemaps\ContentMap',
));

/**
 * Backend form fields
 */
$GLOBALS['BE_FFL']['mapSize'] = 'delahaye\googlemaps\MapSizeWidget';

/**
 * Register models
 */

$GLOBALS['TL_MODELS']['tl_dlh_googlemaps']     			= '\\delahaye\\googlemaps\\MapModel';
$GLOBALS['TL_MODELS']['tl_dlh_googlemaps_elements']     = '\\delahaye\\googlemaps\\ElementModel';


/**
 * Add permissions
 */
$GLOBALS['TL_PERMISSIONS'][] = 'dlh_googlemapss';
$GLOBALS['TL_PERMISSIONS'][] = 'dlh_googlemapsp';


/**
 * Refreshing
 */
$GLOBALS['TL_CONFIG']['dlh_googlemaps']['refresh'] = array('toggler', 'tabs');


/**
 * cookie days
 */
$GLOBALS['TL_CONFIG']['dlh_googlemaps']['cookiedays'] = 365 * 86400; // days * sec/day