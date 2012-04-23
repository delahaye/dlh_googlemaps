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
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['dlh_googlemaps'] = '{title_legend},name,headline,type;{map_legend},dlh_googlemap,dlh_googlemap_zoom,dlh_googlemap_size;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap'],
	'exclude'                 => true,
	'inputType'               => 'radio',
	'foreignKey'              => 'tl_dlh_googlemaps.title',
	'eval'                    => array('mandatory'=>true)
);
$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_zoom'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_zoom'],
	'exclude'                 => true,
	'filter'                  => true,
	'inputType'               => 'select',
	'options'                 => array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20'),
	'default'                 => '',
	'eval'                    => array('includeBlankOption'=>true)
);
$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_size'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_size'],
	'exclude'                 => true,
	'inputType'               => 'imageSize',
	'options'                 => array('px', 'pcnt', 'em', 'pt', 'pc', 'in', 'cm', 'mm'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_ref'],
	'eval'                    => array('rgxp'=>'digit')
);

?>