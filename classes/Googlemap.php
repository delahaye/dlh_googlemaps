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
 * Class Googlemap
 *
 * Creates the map
 * @copyright  2014 de la Haye
 * @author     Christian de la Haye
 * @package    dlh_googlemaps
 */
class Googlemap extends \Frontend
{
    static protected $arrMarkers = array();


    /**
     * Get instance
     * @return object
     */
    static protected $instance;
    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new Googlemap();
        }
        return self::$instance;
    }


    /**
     * Get the map configuration
     * @param int
     * @param string
     * @param array
     * @return array
     */
    public static function getMapData($intMap, $strFormat= '', $arrParams=false)
    {
        // set tag ending
        $strTagEnding = ($strFormat == 'xhtml') ? ' />' : '>';

        // get map data
        $objMap = \delahaye\googlemaps\MapModel::findByPk($intMap);

        if(!$objMap)
        {
            return false;
        }

        $arrMap = $objMap->row();
        $arrMap['language'] = $GLOBALS['TL_LANGUAGE'];
        $arrMap['mapSize'] = deserialize($arrMap['mapSize']);
        $arrMap['mapSize'][2] = ($arrMap['mapSize'][2]=='pcnt' ? '%' : $arrMap['mapSize'][2]);
        $arrMap['mapTypesAvailable'] = deserialize($arrMap['mapTypesAvailable']);
        $arrMap['center'] = str_replace(' ','',$arrMap['center']);
        $arrMap['draggable'] = $arrMap['draggable'] ? 'true' : 'false';
        $arrMap['scrollwheel'] = $arrMap['scrollwheel'] ? 'true' : 'false';
        $arrMap['disableDoubleClickZoom'] = $arrMap['disableDoubleClickZoom'] ? 'true' : 'false';

        // parameters overwritten?
        if(is_array($arrParams) && count($arrParams)>0)
        {
            foreach($arrParams as $k=>$v)
            {
                switch($k)
                {
                    case 'mapSize':
                        if(is_array($v) && $v[0] > 0 && $v[1] > 0) {
                            $arrMap[$k] = $v;
                        }
                        break;

                    case 'zoom':
                        if($v > 0) {
                            $arrMap[$k] = $v;
                        }
                        break;

                    default:
                        $arrMap[$k] = $v;
                        break;

                }
            }
        }

        // generate static map begin
        $arrMap['staticMap'] = '<img src="http'.(\Environment::get('ssl') ? 's' : '').'://maps.google.com/maps/api/staticmap?center=' . $arrMap['center'] . '&amp;zoom=' . $arrMap['zoom'] . '&amp;maptype=' . strtolower($arrMap['mapTypeId']) . '&amp;language=' . $arrMap['language'] . '&amp;size=';

        if($arrMap['mapSize'][2] == 'px') {
            $arrMap['staticMap'] .= $arrMap['mapSize'][0].'x'.$arrMap['mapSize'][1];
        } else {
            $arrMap['staticMap'] .= '800x600';
        }


        // get elements data
        $arrMap['elements'] = array();

        $objElements = \delahaye\googlemaps\ElementModel::findBy('pid', $intMap);

        if(is_object($objElements))
        {
            $intCount = -1;

            while($objElements->next())
            {
                if($objElements->published)
                {
                    $intCount++;

                    $tmpElement = self::getInstance()->getElementData($intMap, $intCount, $objElements->row());

                    $arrMap['staticMap'] .= $tmpElement['staticMapPart'];
                    unset($tmpElement['staticMapPart']);

                    $arrMap['elements'][] = $tmpElement;
                }
            }
        }

        // bundle the markers to positions in static maps, max 5 icons
        $intIcon = 1;
        foreach(self::$arrMarkers as $k=>$v)
        {
            if($intIcon <= 5)
            {
                $arrMap['staticMap'] .= '&amp;' . $k . implode('|', $v);
                $intIcon++;
            }
        }

        // generate static map end
        $arrMap['staticMap'] .= '" alt="' . $GLOBALS['TL_LANG']['tl_dlh_googlemaps']['labels']['noscript'] . '"'.$strTagEnding;

        $arrMap['tabsCode'] = self::getTabsCode($intMap);

        return $arrMap;
    }


    /**
     * Get the configuration and the parsed js-code of the map elements
     * @param int
     * @param int
     * @param array
     * @return array
     */
    protected function getElementData($intMap, $intCount, $arrElement)
    {
        $arrElement['id'] = $intMap.'_'.$intCount;
        $arrElement['title'] = addslashes($arrElement['title']);
        $arrElement['linkTitle'] = addslashes($arrElement['linkTitle']);

        $arrElement['singleCoords'] = str_replace(' ','',$arrElement['singleCoords']);

        $arrElement['multiCoords'] = deserialize($arrElement['multiCoords']);
        if(is_array($arrElement['multiCoords'])) {
            $tmp1 = array();
            foreach($arrElement['multiCoords'] as $coords) {
                $tmp2 = explode(',',$coords);
                $tmp1[0][] = $tmp2[0];
                $tmp1[1][] = $tmp2[1];
            }
            $arrElement['windowPosition'] = array_sum($tmp1[0])/sizeof($tmp1[0]).','.array_sum($tmp1[1])/sizeof($tmp1[1]);
        }

        $arrElement['iconSize'] = deserialize($arrElement['iconSize']);

        $arrElement['iconAnchor'] = deserialize($arrElement['iconAnchor']);

        if(!$arrElement['iconAnchor'][0] || $arrElement['iconAnchor'][0]==0) {
            $arrElement['iconAnchor'][0] = floor($arrElement['iconSize'][0]/2);
        }
        else
        {
            $arrElement['iconAnchor'][0] = floor($arrElement['iconSize'][0]/2) + $arrElement['iconAnchor'][0];
        }

        if(!$arrElement['iconAnchor'][1] || $arrElement['iconAnchor'][1]==0) {
            $arrElement['iconAnchor'][1] = floor($arrElement['iconSize'][1]/2);
        }
        else
        {
            $arrElement['iconAnchor'][1] = floor($arrElement['iconSize'][1]/2) + $arrElement['iconAnchor'][1];
        }

        $objFile = \FilesModel::findByPk($arrElement['overlaySRC']);
        $arrElement['overlaySRC'] = $objFile->path;

        $objFile = \FilesModel::findByPk($arrElement['shadowSRC']);
        $arrElement['shadowSRC'] = $objFile->path;

        $arrElement['shadowSize'] = deserialize($arrElement['shadowSize']);

        $arrElement['strokeWeight'] = deserialize($arrElement['strokeWeight']);

            $tmp1 = deserialize($arrElement['strokeOpacity']);
            if (isset($tmp1['value'])) {
                $arrElement['strokeOpacity'] = ($tmp1['value']/100);
            }

            $tmp1 = deserialize($arrElement['fillOpacity']);
            if (isset($tmp1['value'])) {
                $arrElement['fillOpacity'] = ($tmp1['value']/100);
            }

        $arrElement['radius'] = deserialize($arrElement['radius']);
        $arrElement['bounds'] = deserialize($arrElement['bounds']);
        $tmp1 = explode(',',$arrElement['bounds'][0]);
        $tmp2 = explode(',',$arrElement['bounds'][1]);
        $arrElement['bounds'][2] = (trim($tmp1[0]).trim($tmp2[0]))/2 . ',' . (trim($tmp1[1]).trim($tmp2[1]))/2;
        $arrElement['infoWindow'] = preg_replace('/[\n\r\t]+/i', '', str_replace('\"','"', addslashes($this->replaceInsertTags($arrElement['infoWindow']))));

        $arrElement['infoWindowAnchor'] = deserialize($arrElement['infoWindowAnchor']);
        $arrElement['infoWindowAnchor'][0] = $arrElement['infoWindowAnchor'][0] ? -1 * $arrElement['infoWindowAnchor'][0] : 0;
        $arrElement['infoWindowAnchor'][1] = $arrElement['infoWindowAnchor'][1] ? -1 * $arrElement['infoWindowAnchor'][1] : 0;

        $tmpSize = deserialize($arrElement['infoWindowSize']);

        $arrElement['infoWindowSize'] = '';
        if(is_array($tmpSize) && $tmpSize[0] > 0 && $tmpSize[1] > 0) {
            $arrElement['infoWindowSize'] = sprintf(' style="width:%spx;height:%spx;"', $tmpSize[0], $tmpSize[1]);
        }

        $arrElement['routingAddress'] = str_replace('\"','"', addslashes(str_replace('
','',$arrElement['routingAddress'])));
        $arrElement['labels'] = $GLOBALS['TL_LANG']['dlh_googlemaps']['labels'];

        $arrElement['staticMapPart'] = '';

		//supporting insertags
		$arrElement['kmlUrl'] =  $this->replaceInsertTags($arrElement['kmlUrl'],false);
		
        switch($arrElement['type']) {
            case 'MARKER':
                if($arrElement['markerType'] == 'ICON') {
                    $arrElement['iconSRC'] = \FilesModel::findByUuid($arrElement['iconSRC'])->path;
                    self::$arrMarkers['icon:'.rawurlencode(\Environment::get('base').$arrElement['iconSRC']).'|shadow:false|'][] = $arrElement['singleCoords'];
                }
                else
                {
                    $arrElement['staticMapPart'] = '&amp;markers='.$arrElement['singleCoords'];
                }
                break;
            case 'POLYLINE':
                if(is_array($arrElement['multiCoords']) && count($arrElement['multiCoords'])>0) {
                    $arrElement['staticMapPart'] .= '&amp;path=weight:'.$arrElement['strokeWeight']['value'].'|color:0x'.$arrElement['strokeColor'].dechex($arrElement['strokeOpacity']*255);
                    foreach($arrElement['multiCoords'] as $coords) {
                        $arrElement['staticMapPart'] .= '|'.str_replace(' ','',$coords);
                    }
                }
                break;
            case 'POLYGON':
                if(is_array($arrElement['multiCoords']) && count($arrElement['multiCoords'])>0) {
                    $arrElement['staticMapPart'] .= '&amp;path=weight:'.$arrElement['strokeWeight']['value'].'|color:0x'.$arrElement['strokeColor'].dechex($arrElement['strokeOpacity']*255).'|fillcolor:0x'.$arrElement['fillColor'].dechex($arrElement['fillOpacity']*255);
                    foreach($arrElement['multiCoords'] as $coords) {
                        $arrElement['staticMapPart'] .= '|'.str_replace(' ','',$coords);
                    }
                    $arrElement['staticMapPart'] .= '|'.str_replace(' ','',$arrElement['multiCoords'][0]);
                }
                break;
        }

        // parse the element
        $subTemplate = new \FrontendTemplate('dlh_'.strtolower($arrElement['type']));
        $subTemplate->map = $intMap;
        $subTemplate->element = $arrElement;

        $arrElement['parsed'] = $subTemplate->parse();

        return $arrElement;
    }


    /**
     * Get the js-code for maps displayed in accordions or tabs
     * @param int
     * @return string
     */
    protected static function getTabsCode($id)
    {

        $strCode = '
            function dlh_resetMap(){
                zoom = gmap'.$id.'.getZoom();
                center = gmap'.$id.'.getCenter();
                google.maps.event.trigger(gmap'.$id.', "resize");
                gmap'.$id.'.setZoom(zoom);
                gmap'.$id.'.setCenter(center);
            }
            ';

        foreach($GLOBALS['TL_CONFIG']['dlh_googlemaps']['refresh'] as $strClass)
        {
            $strVar = str_replace(" ", "_", $strClass);
            $strVar = str_replace("-", "_", $strVar);
            
            $strCode .= '
                if(window.addEvent) {
                    var dlh_'.$strVar.' = $$(".'.$strClass.'");
                    dlh_'.$strVar.'.each(function(dlh_'.$strVar.'_ele){
                        dlh_'.$strVar.'_ele.addEvent("click", function(){
                            dlh_resetMap();
                        });
                    });
                } else if(typeof jQuery == "function") {
                    jQuery(document).ready(function(){
                        jQuery(".'.$strClass.'").click(function() {
                            dlh_resetMap();
                        });
                    });
                }
            ';
        }

        return $strCode;
    }


    /**
     * Inject CSS
     */
    public static function cssInjection()
    {
        global $objPage;

        $objLayout = \LayoutModel::findByPk($objPage->layout);

        $objLayout->framework = deserialize($objLayout->framework);

        if(is_array($objLayout->framework) && count($objLayout->framework)>0)
        {
            $GLOBALS['TL_FRAMEWORK_CSS'][] = 'system/modules/dlh_googlemaps/assets/frontend.css';
        }
        else
        {
            $GLOBALS['TL_CSS'][] = 'system/modules/dlh_googlemaps/assets/frontend.css';
        }
    }

}
