<?php

/**
 * dlh_googlemaps
 * Extension for Contao Open Source CMS (contao.org)
 *
 * Copyright (c) 2014-2016 de la Haye
 *
 * @package dlh_googlemaps
 * @author  Christian de la Haye
 * @link    http://delahaye.de
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Extend default palette
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace('{global_legend', '{dlh_googlemaps_legend},dlh_googlemaps_apikey;{global_legend', $GLOBALS['TL_DCA']['tl_page']['palettes']['root']);



/**
 * Add fields to tl_user_group
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['dlh_googlemaps_apikey'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['dlh_googlemaps_apikey'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false),
	'sql'                     => "varchar(64) NOT NULL default ''"
);
