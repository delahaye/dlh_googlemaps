<?php

$dc = &$GLOBALS['TL_DCA']['tl_settings'];

/**
 * Palettes
 */
$dc['palettes']['default'] = str_replace('{chmod_legend', '{dlh_googlemaps_legend},dlh_googlemaps_apikey;{chmod_legend', $dc['palettes']['default']);

   
/**
 * Fields
 */
$arrFields = [
    'dlh_googlemaps_apikey' => [
        'label'     => &$GLOBALS['TL_LANG']['tl_settings']['dlh_googlemaps_apikey'],
        'exclude'   => true,
        'inputType' => 'text',
        'eval'      => ['maxlength'=>64, 'rgxp'=>'alnum'],
        'sql'       => "varchar(64) NOT NULL default ''",
    ]
];

$dc['fields'] = array_merge($dc['fields'], $arrFields);