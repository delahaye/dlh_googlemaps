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
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'delahaye\googlemaps',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Models
    'delahaye\googlemaps\MapModel'      => 'system/modules/dlh_googlemaps/models/MapModel.php',
    'delahaye\googlemaps\ElementModel'  => 'system/modules/dlh_googlemaps/models/ElementModel.php',

    // Classes
    'delahaye\googlemaps\Googlemap'      => 'system/modules/dlh_googlemaps/classes/Googlemap.php',
    'delahaye\googlemaps\UpgradeHandler' => 'system/modules/dlh_googlemaps/classes/UpgradeHandler.php',
    'Contao\dlhCoordsWizard'             => 'system/modules/dlh_googlemaps/widgets/dlhCoordsWizard.php',

    // Elements
    'delahaye\googlemaps\ContentMap'    => 'system/modules/dlh_googlemaps/elements/ContentMap.php',

    // Modules
    'delahaye\googlemaps\ModuleMap'     => 'system/modules/dlh_googlemaps/modules/ModuleMap.php',

));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'mod_dlh_googlemaps_default'       => 'system/modules/dlh_googlemaps/templates/frontend',
    'mod_dlh_googlemapsstatic'         => 'system/modules/dlh_googlemaps/templates/frontend',
    'ce_dlh_googlemaps_default'        => 'system/modules/dlh_googlemaps/templates/frontend',
    'ce_dlh_googlemapsstatic'          => 'system/modules/dlh_googlemaps/templates/frontend',
    'dlh_circle'                       => 'system/modules/dlh_googlemaps/templates/elements',
    'dlh_ground_overlay'               => 'system/modules/dlh_googlemaps/templates/elements',
    'dlh_infowindow'                   => 'system/modules/dlh_googlemaps/templates/elements',
    'dlh_marker'                       => 'system/modules/dlh_googlemaps/templates/elements',
    'dlh_polygon'                      => 'system/modules/dlh_googlemaps/templates/elements',
    'dlh_polyline'                     => 'system/modules/dlh_googlemaps/templates/elements',
    'dlh_rectangle'                    => 'system/modules/dlh_googlemaps/templates/elements',
    'dlh_kml'                          => 'system/modules/dlh_googlemaps/templates/elements',
));