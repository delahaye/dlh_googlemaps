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
 * Run in a custom namespace, so the class can be replaced
 */
namespace delahaye\googlemaps;


/**
 * Reads and writes tl_dlh_googlemaps
 */
class ElementModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_dlh_googlemaps_elements';

}