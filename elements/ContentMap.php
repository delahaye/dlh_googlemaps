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
 * Class ContentMap
 *
 * Front end element for a Google map.
 * @copyright  2014 de la Haye
 * @author     Christian de la Haye
 * @package    dlh_googlemaps
 */
class ContentMap extends \ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_dlh_googlemaps_default';


	/**
	 * Generate content element
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			// get map data
            $objMap = \delahaye\googlemaps\MapModel::findByPk($this->dlh_googlemap);

			return '<h1>'.$objMap->title.'</h1>';
		}
		
		return parent::generate();
	}


    /**
     * Generate the content element
     */
    protected function compile()
    {
        global $objPage;

	$objRootPage = \Database::getInstance()->prepare("select dlh_googlemaps_apikey from tl_page where id=?")->limit(1)->execute($objPage->rootId);
	
        // Contao framework sets images to max-width 100%, which collides with Google's CSS
        if(!$this->dlh_googlemap_nocss)
        {
            \delahaye\googlemaps\Googlemap::CssInjection();
        }

        // get the map data
        $arrParams = array
        (
            'mapSize' => deserialize($this->dlh_googlemap_size),
            'zoom' => $this->dlh_googlemap_zoom
        );

        $arrParams['mapSize'][2] = ($arrParams['mapSize'][2]=='pcnt' ? '%' : $arrParams['mapSize'][2]);

        $arrMap = \delahaye\googlemaps\Googlemap::getMapData($this->dlh_googlemap, $objPage->outputFormat, $arrParams);

        // static map
        if($this->dlh_googlemap_static)
        {
            $this->Template = new \FrontendTemplate('ce_dlh_googlemapsstatic');

            if($this->dlh_googlemap_url)
            {
                $arrMap['staticMap'] = '<a href="'.$this->dlh_googlemap_url.'"'.($this->rel ? ($objPage->outputFormat == 'html5' ? ' data-lightbox="' : ' rel="').$this->rel.'"' : '') .' title="'.addslashes($this->linkTitle).'"'.($this->target ? ' onclick="window.open(this.href); return false;"' : '') .'>'.$arrMap['staticMap'].'</a>';
            }
        }
        // dynamic map
        else
        {
            if($this->dlh_googlemap_template && $this->dlh_googlemap_template != 'ce_dlh_googlemaps_default')
            {
                $this->Template = new \FrontendTemplate($this->dlh_googlemap_template);
            }

            $GLOBALS['TL_JAVASCRIPT'][] = 'http'.(\Environment::get('ssl') ? 's' : '').'://maps.google.com/maps/api/js?key='.$objRootPage->dlh_googlemaps_apikey.'&language='.$arrMap['language'];
            if($arrMap['useClusterer']){
                $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/dlh_googlemaps/assets/js-marker-clusterer-gh-pages/src/markerclusterer.js';
                $arrMap['clusterImg'] = $arrMap['clusterImg'] ? $arrMap['clusterImg'] : 'system/modules/dlh_googlemaps/assets/js-marker-clusterer-gh-pages/images';
            }
        }

        $this->Template->map = $arrMap;
        $this->Template->tabs = $this->dlh_googlemap_tabs;

        $this->Template->labels = $GLOBALS['TL_LANG']['dlh_googlemaps']['labels'];
    }
}