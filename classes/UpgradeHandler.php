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

        return;
    }


}
