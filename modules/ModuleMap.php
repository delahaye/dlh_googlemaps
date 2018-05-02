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
 * Class ModuleMap
 *
 * Front end module for a Google map.
 * @copyright  2014 de la Haye
 * @author     Christian de la Haye
 * @package    dlh_googlemaps
 */
class ModuleMap extends \Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_dlh_googlemaps_default';


    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objMap = \delahaye\googlemaps\MapModel::findByPk($this->dlh_googlemap);

			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['dlh_googlemaps'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->dlh_googlemap;
			$objTemplate->link = $objMap->title;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
        }

        return parent::generate();
    }


    /**
     * Generate the module
     */
    protected function compile()
    {
        global $objPage;

        $key = null;
        
        if (($objRootPage = \PageModel::findByPk($objPage->rootId)) !== null)
        {
            $key = $objRootPage->dlh_googlemaps_apikey;
        }
        
        if (!$key)
        {
            $key = \Config::get('dlh_googlemaps_apikey');
        }

        // Contao framework sets images to max-width 100%, which collides with Google's CSS
        if(!$this->dlh_googlemap_nocss)
        {
            \delahaye\googlemaps\Googlemap::CssInjection();
        }

        // get the map data
        $arrParams = array
        (
            'mapSize' => deserialize($this->dlh_googlemap_size),
            'zoom' => $this->dlh_googlemap_zoom,
            'protected' => $this->dlh_googlemap_protected,
            'privacy' => $this->dlh_googlemap_privacy
        );

        $arrMap = \delahaye\googlemaps\Googlemap::getMapData($this->dlh_googlemap, $objPage->outputFormat, $arrParams);

        // static map
        if($this->dlh_googlemap_static)
        {
            $this->Template = new \FrontendTemplate('mod_dlh_googlemapsstatic');

            if($this->dlh_googlemap_url)
            {
                $arrMap['staticMap'] = '<a href="'.$this->dlh_googlemap_url.'"'.($this->dlh_googlemap_rel ? ($objPage->outputFormat == 'html5' ? ' data-lightbox="' : ' rel="').$this->dlh_googlemap_rel.'"' : '') .' title="'.addslashes($this->dlh_googlemap_linkTitle).'"'.($this->dlh_googlemap_target ? ' onclick="window.open(this.href); return false;"' : '') .'>'.$arrMap['staticMap'].'</a>';
            }
        }
        // dynamic map
        else
        {
            if($this->dlh_googlemap_template && $this->dlh_googlemap_template != 'mod_dlh_googlemaps_default')
            {
                $this->Template = new \FrontendTemplate($this->dlh_googlemap_template);
            }

            if($arrMap['useClusterer']){
                $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/dlh_googlemaps/assets/js-marker-clusterer-gh-pages/src/markerclusterer.js';
                $arrMap['clusterImg'] = $arrMap['clustererImg'] ? $arrMap['clustererImg'] : 'system/modules/dlh_googlemaps/assets/js-marker-clusterer-gh-pages/images';
            }
        }

        $this->Template->map = $arrMap;
        $this->Template->tabs = $this->dlh_googlemap_tabs;

        $this->Template->labels = $GLOBALS['TL_LANG']['dlh_googlemaps']['labels'];

    }
}