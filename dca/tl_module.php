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
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'dlh_googlemap_static';
$GLOBALS['TL_DCA']['tl_module']['palettes']['dlh_googlemaps'] = '{title_legend},name,headline,type;{map_legend},dlh_googlemap,dlh_googlemap_size,dlh_googlemap_zoom,dlh_googlemap_static,dlh_googlemap_nocss,dlh_googlemap_tabs;{template_legend:hide},dlh_googlemap_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


/**
 * add subpalettes
 */

$GLOBALS['TL_DCA']['tl_module']['subpalettes']['dlh_googlemap_static'] = 'dlh_googlemap_url,dlh_googlemap_target,dlh_googlemap_linkTitle,dlh_googlemap_rel';


/**
 * add fields
 */

$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap'],
	'exclude'                 => true,
	'inputType'               => 'radio',
	'foreignKey'              => 'tl_dlh_googlemaps.title',
	'eval'                    => array('mandatory'=>true),
	'sql'                     => "int(10) unsigned NOT NULL default '0'",
    'options_callback'        => array('tl_module_dlh_googlemaps', 'mapOptions'),
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_template'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_template'],
    'default'                 => 'mod_dlh_googlemaps_default',
    'exclude'                 => true,
    'inputType'               => 'select',
    'options_callback'        => array('tl_module_dlh_googlemaps', 'getTemplates'),
    'eval'                    => array('tl_class'=>'w50'),
    'sql'                     => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_zoom'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_zoom'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20'),
	'default'                 => '10',
	'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'                     => "int(10) unsigned NOT NULL default '10'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_size'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_size'],
	'exclude'                 => true,
	'inputType'               => 'imageSize',
	'options'                 => array('px', 'pcnt', 'em', 'rem', 'ex', 'pt', 'pc', 'in', 'cm', 'mm'),
    'reference'               => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_ref'],
	'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'helpwizard'=>false, 'tl_class'=>'w50'),
	'sql'                     => "varchar(128) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_static'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_static'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'clr m12'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_nocss'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_nocss'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'clr m12'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_tabs'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_tabs'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'clr m12'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_url'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_url'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'text',
    'eval'                    => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50 wizard'),
    'wizard' => array
    (
        array('tl_module_dlh_googlemaps', 'pagePicker')
    ),
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_target'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['MSC']['target'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w50 m12'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_linkTitle'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['linkTitle'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'text',
    'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_rel'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['rel'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'text',
    'eval'                    => array('maxlength'=>64, 'tl_class'=>'w50'),
    'sql'                     => "varchar(64) NOT NULL default ''"
);



/**
 * Class tl_module_dlh_googlemaps
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  2014 de la Haye
 * @author     Christian de la Haye
 * @package    dlh_googlemaps
 */
class tl_module_dlh_googlemaps extends Backend
{

    /**
     * Return all templates as array
     * @return array
     */
    public function getTemplates()
    {
        return $this->getTemplateGroup('mod_dlh_googlemaps_');
    }



    /**
     * Links to the map for edit mode
     * @param obkject
     * @return array
     */
    public function mapOptions(DataContainer $dc)
    {
        $objMaps = \delahaye\googlemaps\MapModel::findAll();

        if(!$objMaps)
        {
            return array();
        }

        while($objMaps->next())
        {
            $return[$objMaps->id] = sprintf('%s <a href="contao/main.php?do=dlh_googlemaps&act=edit&popup=1&id=%s&rt=%s"><img src="system/themes/default/images/edit.gif" width="12" height="12"></a>', $objMaps->title, $objMaps->id, REQUEST_TOKEN);
        }

        return $return;
    }


    /**
     * Return the link picker wizard
     * @param \DataContainer
     * @return string
     */
    public function pagePicker(DataContainer $dc)
    {
        return ' <a href="contao/page.php?do=' . Input::get('do') . '&amp;table=' . $dc->table . '&amp;field=' . $dc->field . '&amp;value=' . str_replace(array('{{link_url::', '}}'), '', $dc->value) . '" title="' . specialchars($GLOBALS['TL_LANG']['MSC']['pagepicker']) . '" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':765,\'title\':\'' . specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MOD']['page'][0])) . '\',\'url\':this.href,\'id\':\'' . $dc->field . '\',\'tag\':\'ctrl_'. $dc->field . ((Input::get('act') == 'editAll') ? '_' . $dc->id : '') . '\',\'self\':this});return false">' . Image::getHtml('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer"') . '</a>';
    }

}