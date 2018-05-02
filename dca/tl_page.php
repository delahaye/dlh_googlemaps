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
$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace('{global_legend', '{dlh_googlemaps_legend},dlh_googlemaps_apikey,dlh_googlemaps_protected;{global_legend', $GLOBALS['TL_DCA']['tl_page']['palettes']['root']);


/**
 * Add fields to tl_page
 */
$arrFields = [
    'dlh_googlemaps_apikey' => [
        'label'     => &$GLOBALS['TL_LANG']['tl_page']['dlh_googlemaps_apikey'],
        'exclude'   => true,
        'inputType' => 'text',
        'eval'      => ['maxlength'=>64, 'rgxp'=>'alnum'],
        'sql'       => "varchar(64) NOT NULL default ''",
    ]
];

$GLOBALS['TL_DCA']['tl_page']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_page']['fields'], $arrFields);