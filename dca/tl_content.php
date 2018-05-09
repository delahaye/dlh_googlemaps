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
 * add palettes
 */

$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'dlh_googlemap_static';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'dlh_googlemap_protected';
$GLOBALS['TL_DCA']['tl_content']['palettes']['dlh_googlemaps'] =
    '{type_legend},type,headline;{map_legend},dlh_googlemap,dlh_googlemap_size,dlh_googlemap_zoom,dlh_googlemap_protected,dlh_googlemap_static,dlh_googlemap_nocss,dlh_googlemap_tabs;{template_legend:hide},dlh_googlemap_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';


/**
 * add subpalettes
 */

$GLOBALS['TL_DCA']['tl_content']['subpalettes']['dlh_googlemap_static'] = 'dlh_googlemap_url,target,linkTitle,rel';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['dlh_googlemap_protected'] = 'dlh_googlemap_privacy';

/**
 * add fields
 */

$GLOBALS['TL_DCA']['tl_content']['fields']['dlh_googlemap'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_content']['dlh_googlemap'],
    'exclude'          => true,
    'inputType'        => 'radio',
    'foreignKey'       => 'tl_dlh_googlemaps.title',
    'eval'             => ['mandatory' => true],
    'sql'              => "int(10) unsigned NOT NULL default '0'",
    'options_callback' => ['tl_content_dlh_googlemaps', 'mapOptions'],
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dlh_googlemap_template'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_content']['dlh_googlemap_template'],
    'default'          => 'ce_dlh_googlemaps_default',
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => ['tl_content_dlh_googlemaps', 'getTemplates'],
    'eval'             => ['tl_class' => 'w50'],
    'sql'              => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dlh_googlemap_zoom'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['dlh_googlemap_zoom'],
    'exclude'   => true,
    'inputType' => 'select',
    'options'   => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'],
    'default'   => '10',
    'eval'      => ['includeBlankOption' => true, 'tl_class' => 'w50'],
    'sql'       => "int(10) unsigned NOT NULL default '10'",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dlh_googlemap_size'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['dlh_googlemap_size'],
    'exclude'   => true,
    'inputType' => 'imageSize',
    'options'   => ['proportional','box'],
    'reference' => &$GLOBALS['TL_LANG']['MSC'],
    'eval'      => ['includeBlankOption' => true, 'rgxp' => 'digit', 'nospace' => true, 'helpwizard' => false, 'tl_class' => 'w50 clr'],
    'default'      => serialize(array(16,9,'proportional')),
    'sql'       => "varchar(128) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dlh_googlemap_static'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['dlh_googlemap_static'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['submitOnChange' => true, 'tl_class' => 'clr m12'],
    'sql'       => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dlh_googlemap_nocss'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['dlh_googlemap_nocss'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'clr m12'],
    'sql'       => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dlh_googlemap_tabs'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['dlh_googlemap_tabs'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'clr m12'],
    'sql'       => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dlh_googlemap_url'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['dlh_googlemap_url'],
    'exclude'   => true,
    'search'    => true,
    'inputType' => 'text',
    'eval'      => ['rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 255, 'tl_class' => 'w50 wizard'],
    'wizard'    => [
        ['tl_content', 'pagePicker'],
    ],
    'sql'       => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dlh_googlemap_protected'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['dlh_googlemap_protected'],
    'exclude'   => true,
    'default'   => false,
    'inputType' => 'checkbox',
    'default'   => '',
    'eval'      => ['submitOnChange' => true, 'tl_class' => 'clr m12'],
    'sql'       => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dlh_googlemap_privacy'] = [
    'label'       => &$GLOBALS['TL_LANG']['tl_content']['dlh_googlemap_privacy'],
    'exclude'     => true,
    'search'      => true,
    'inputType'   => 'textarea',
    'eval'        => ['rte' => 'tinyMCE', 'helpwizard' => true],
    'explanation' => 'insertTags',
    'sql'         => "text NULL",
];

/**
 * Class tl_content_dlh_googlemaps
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @copyright  2014 de la Haye
 * @author     Christian de la Haye
 * @package    dlh_googlemaps
 */
class tl_content_dlh_googlemaps extends Backend
{

    /**
     * Return all templates as array
     *
     * @return array
     */
    public function getTemplates()
    {
        return $this->getTemplateGroup('ce_dlh_googlemaps_');
    }


    /**
     * Links to the map for edit mode
     *
     * @param obkject
     *
     * @return array
     */
    public function mapOptions(DataContainer $dc)
    {
        $objMaps = \delahaye\googlemaps\MapModel::findAll();

        if (!$objMaps)
        {
            return [];
        }

        while ($objMaps->next())
        {
            if (version_compare(VERSION, '4', '>='))
            {
                $return[$objMaps->id] = sprintf(
                    '%s <a href="contao/main.php?do=dlh_googlemaps&act=edit&id=%s&popup=1&nb=1&rt=%s" title="%s" onclick="%s">%s</a>',
                    $objMaps->title,
                    $objMaps->id,
                    REQUEST_TOKEN,
                    sprintf(\StringUtil::specialchars($GLOBALS['TL_LANG']['tl_content']['editalias'][1]), $objMaps->id),
                        'Backend.openModalIframe({\'title\':\'' . \StringUtil::specialchars(
                        str_replace("'", "\\'", sprintf($GLOBALS['TL_LANG']['tl_content']['editalias'][1], $objMaps->id))
                    ) . '\',\'url\':this.href});return false',
                    \Image::getHtml('alias.svg', $GLOBALS['TL_LANG']['tl_content']['editalias'][0])
                );

            } else {
                $return[$objMaps->id] = sprintf('%s <a href="contao/main.php?do=dlh_googlemaps&act=edit&id=%s&rt=%s"><img src="system/themes/default/images/edit.gif" width="12" height="12"></a>', $objMaps->title, $objMaps->id, REQUEST_TOKEN);
            }
        }

        return $return;
    }

}
