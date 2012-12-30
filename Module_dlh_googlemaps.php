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
 * @copyright  Christian de la Haye 2011
 * @author     Christian de la Haye 
 * @package    dlh_googlemaps 
 * @license    LGPL
 * @filesource
 */


/**
 * Class Module_dlh_googlemaps
 *
 * @copyright  Christian de la Haye 2011
 * @author     Christian de la Haye 
 * @package    Controller
 */
class Module_dlh_googlemaps extends Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_dlh_googlemaps';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### GOOGLE MAP ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->title;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}

	/**
	 * Generate module
	 */
	protected function compile()
	{
		// get map data
		$objMap = $this->Database->prepare("SELECT * FROM tl_dlh_googlemaps WHERE id=?")
			->limit(1)
			->execute($this->dlh_googlemap);
		$map = $objMap->fetchAssoc();

		// get elements data
		$objElements = $this->Database->prepare("SELECT * FROM tl_dlh_googlemaps_elements WHERE (pid=? and published=?) ORDER BY sorting")
			->execute($map['id'],true);
		$map['elements'] = $objElements->fetchAllAssoc();
		$map['sensor'] = $map['sensor'] ? 'true' : 'false';
		$map['language'] = $GLOBALS['TL_LANGUAGE'];

		$this->import('dlh_googlemaps');
		$this->Template->map = $this->dlh_googlemaps->render_dlh_googlemap($this->Environment->base,$map,$this->dlh_googlemap_size,$this->dlh_googlemap_zoom);
		$this->Template->labels = $GLOBALS['TL_LANG']['dlh_googlemaps']['labels'];

		$GLOBALS['TL_JAVASCRIPT'][] = 'http'.($this->Environment->ssl ? 's' : '').'://maps.google.com/maps/api/js?language='.$map['language'].'&amp;sensor='.$map['sensor'];

	}
}

?>