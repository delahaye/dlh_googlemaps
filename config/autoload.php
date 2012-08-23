<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package Dlh_googlemaps
 * @link    http://www.contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// 
	'dlhListWizard'          => 'system/modules/dlh_googlemaps/dlhListWizard.php',
	'Module_dlh_googlemaps'  => 'system/modules/dlh_googlemaps/Module_dlh_googlemaps.php',
	'Content_dlh_googlemaps' => 'system/modules/dlh_googlemaps/Content_dlh_googlemaps.php',
	'dlh_googlemaps'         => 'system/modules/dlh_googlemaps/dlh_googlemaps.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_dlh_googlemaps'        => 'system/modules/dlh_googlemaps/templates',
	'ce_dlh_googlemaps_static' => 'system/modules/dlh_googlemaps/templates',
	'mod_dlh_googlemaps'       => 'system/modules/dlh_googlemaps/templates',
));
