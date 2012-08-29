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
 * Add back end modules
 */
$GLOBALS['BE_MOD']['content']['dlh_googlemaps'] = array
(
	'tables' => array('tl_dlh_googlemaps', 'tl_dlh_googlemaps_elements'),
	'stylesheet'   => 'system/modules/dlh_googlemaps/html/be_styles.css',
	'icon'   => 'system/modules/dlh_googlemaps/html/icon.gif',
	'list' => array('dlhListWizard', 'importList')
);

$GLOBALS['BE_FFL']['dlhListWizard'] = 'dlhListWizard';

/**
 * Front end modules
 */
array_insert($GLOBALS['FE_MOD']['miscellaneous'], 9, array
(
	'dlh_googlemaps' => 'Module_dlh_googlemaps'
)
);

/**
 * Content elements
 */
 
if (version_compare(VERSION, '2.11', '>'))
{
	array_insert($GLOBALS['TL_CTE']['media'], count($GLOBALS['TL_CTE']['media']), array
	(
		'dlh_googlemaps' => 'Content_dlh_googlemaps'
	));
}
else
{
	array_insert($GLOBALS['TL_CTE']['images'], 3, array
	(
		'dlh_googlemaps' => 'Content_dlh_googlemaps'
	));
}

$GLOBALS['TL_CSS'][] = 'system/modules/dlh_googlemaps/html/dlh_googlemaps.css'; 
?>