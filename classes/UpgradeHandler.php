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

use Contao\Database\Result;


/**
 * Class UpgradeHandler
 *
 * Perfoms upgrades
 * @copyright  2014 de la Haye
 * @author     Christian de la Haye
 * @package    dlh_googlemaps
 */

class UpgradeHandler
{
    public static function run()
    {
        $objDatabase = \Database::getInstance();

        $strTable = 'tl_dlh_googlemaps_elements';
        $arrNames = array('overlaySRC', 'iconSRC', 'shadowSRC');

        if (version_compare(VERSION, '3.2', '>=') && $objDatabase->tableExists($strTable))
        {
            // convert file fields
            foreach ($objDatabase->listFields($strTable) as $arrField)
            {
                foreach($arrNames as $strName)
                {
                    if ($arrField['name'] == $strName && $arrField['type'] != 'binary')
                    {
                        \Database\Updater::convertSingleField($strTable, $strName);
                    }
                }
            }
        }

        // upgrade to responsive map sizes
        foreach(array('tl_dlh_googlemaps','tl_content','tl_module') as $tmpTable){
            switch($tmpTable){
                case 'tl_dlh_googlemaps':
                    if ($objDatabase->tableExists($tmpTable))
                    {
                        $objList = $objDatabase->prepare("select * from ".$tmpTable)->execute();
                        self::upGradeMapSize($objDatabase, $objList, $tmpTable, 'mapSize');
                    }
                    break;

                default:
                    if ($objDatabase->fieldExists('dlh_googlemap_size',$tmpTable))
                    {
                        $objList = $objDatabase->prepare("select * from ".$tmpTable." where type=? and dlh_googlemap_size!=?")->execute('dlh_googlemaps','');
                        self::upGradeMapSize($objDatabase, $objList, $tmpTable, 'dlh_googlemap_size');
                    }
                    break;
            }
        }


        return;
    }


    /**
     * @param Result $objList
     */
    private static function upGradeMapSize($objDatabase, $objList, $strTable, $strField){
        $records = $objList->fetchAllAssoc();

        foreach ($records as $record) {
            $tmpOld = deserialize($record[$strField]);
            $tmpNew = array();
            if($tmpOld[2] != 'box' && $tmpOld[2] != 'proportional'){
                $tmpOld[2] = str_replace('pcnt','%',$tmpOld[2]);
                $tmpNew[0] = $tmpOld[0] > 0 ? $tmpOld[0].$tmpOld[2] : '';
                $tmpNew[1] = $tmpOld[1] > 0 ? $tmpOld[1].$tmpOld[2] : '';
                $tmpNew[2] = 'box';

                $objDatabase->prepare("update ".$strTable." set ".$strField."=? where id=?")->execute(serialize($tmpNew), $record['id']);
            }
        }

        return;
    }


}
