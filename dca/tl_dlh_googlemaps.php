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
 * Table tl_dlh_googlemaps
 */
$GLOBALS['TL_DCA']['tl_dlh_googlemaps'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_dlh_googlemaps_elements'),
		'switchToEdit'                => true,
		'enableVersioning'            => true,
        'onload_callback' => array
        (
            array('tl_dlh_googlemaps', 'checkPermission')
        ),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('title'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;search,limit'
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s',
			'label_callback'   => array('tl_dlh_googlemaps', 'listRecords')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['edit'],
				'href'                => 'table=tl_dlh_googlemaps_elements',
				'icon'                => 'edit.gif',
				'attributes'          => 'class="contextmenu"'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'button_callback'     => array('tl_dlh_googlemaps', 'editHeader'),
				'attributes'          => 'class="edit-header"'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('useMapTypeControl', 'useZoomControl', 'usePanControl', 'useRotateControl', 'useScaleControl', 'useStreetViewControl','useOverviewMapControl','useClusterer'),
		'default'                     => '{title_legend},title,geocoderAddress,geocoderCountry,center,mapSize,zoom;{maptype_legend:hide},mapTypeId,mapTypesAvailable,disableDoubleClickZoom,draggable,scrollwheel,staticMapNoscript,useClusterer;{maptypecontrols_legend:hide},useMapTypeControl;{zoomcontrol_legend:hide},useZoomControl;{rotatecontrol_legend:hide},useRotateControl;{pancontrol_legend:hide},usePanControl;{scalecontrol_legend:hide},useScaleControl;{streetviewcontrol_legend:hide},useStreetViewControl;{overviewmapcontrol_legend:hide},useOverviewMapControl;{parameter_legend:hide},parameter,moreParameter'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'useMapTypeControl'          => 'mapTypeControlStyle,mapTypeControlPos',
		'useZoomControl'             => 'zoomControlStyle,zoomControlPos',
        'useRotateControl'           => 'rotateControlStyle,rotateControlPos',
        'usePanControl'              => 'panControlStyle,panControlPos',
		'useScaleControl'            => 'scaleControlPos',
        'useStreetViewControl'       => 'streetViewControlPos',
		'useOverviewMapControl'      => 'overviewMapControlOpened',
		'useClusterer'      => 'clustererImg'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'center' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['center'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>64),
			'sql'                     => "varchar(64) NOT NULL default ''",
			'save_callback' => array
			(
				array('tl_dlh_googlemaps', 'generateCoords')
			)
		),
		'geocoderAddress' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['geocoderAddress'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'geocoderCountry' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['geocoderCountry'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
			'options'                 => $this->getCountries(),
			'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(2) NOT NULL default 'de'"
		),
		'mapSize' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapSize'],
			'exclude'                 => true,
			'inputType'               => 'imageSize',
			'options'                 => array('px', 'pcnt', 'em', 'rem', 'ex', 'pt', 'pc', 'in', 'cm', 'mm'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'helpwizard'=>false, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'zoom' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['zoom'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20'),
			'default'                 => '10',
			'eval'                    => array('mandatory'=>true),
			'sql'                     => "int(10) unsigned NOT NULL default '10'"
		),
		'mapTypeId' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypeId'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => array('HYBRID','ROADMAP','SATELLITE','TERRAIN'),
			'default'                 => 'ROADMAP',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('mandatory'=>true),
			'sql'                     => "varchar(16) NOT NULL default 'ROADMAP'"
		),
		'mapTypesAvailable' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypesAvailable'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'options'                 => array('HYBRID','ROADMAP','SATELLITE','TERRAIN'),
			'default'                 => serialize(array('HYBRID','ROADMAP','SATELLITE','TERRAIN')),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('mandatory'=>true, 'multiple'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'staticMapNoscript' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['staticMapNoscript'],
			'exclude'                 => true,
			'default'                 => false,
			'inputType'               => 'checkbox',
            'default'                 => '1',
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'useClusterer' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useClusterer'],
			'exclude'                 => true,
			'filter'                  => true,
			'default'                 => false,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true,'tl_class'=>'clr m12'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'clustererImg' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['clustererImg'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'useMapTypeControl' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useMapTypeControls'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
            'default'                 => '1',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'mapTypeControlStyle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['mapTypeControlStyle'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('DEFAULT','DROPDOWN_MENU','HORIZONTAL_BAR'),
			'default'                 => 'DEFAULT',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('mandatory'=>true),
			'sql'                     => "varchar(16) NOT NULL default 'DEFAULT'"
		),
		'mapTypeControlPos' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['controlPos'],
			'exclude'                 => true,
			'inputType'               => 'radioTable',
			'options'                 => array('TOP_LEFT','TOP_CENTER','TOP_RIGHT','LEFT_TOP','C1','RIGHT_TOP','LEFT_CENTER','C2','RIGHT_CENTER','LEFT_BOTTOM','C3','RIGHT_BOTTOM','BOTTOM_LEFT','BOTTOM_CENTER','BOTTOM_RIGHT'),
			'default'                 => 'TOP_RIGHT',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('cols'=>3,'tl_class'=>'dlh_googlemaps_position'),
			'sql'                     => "varchar(16) NOT NULL default 'TOP_RIGHT'"
		),
		'useZoomControl' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useZoomControl'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
            'default'                 => '1',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'zoomControlStyle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['zoomControlStyle'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('ANDROID','DEFAULT','SMALL','ZOOM_PAN'),
			'default'                 => 'DEFAULT',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('mandatory'=>true),
			'sql'                     => "varchar(16) NOT NULL default 'DEFAULT'"
		),
		'zoomControlPos' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['controlPos'],
			'exclude'                 => true,
			'inputType'               => 'radioTable',
			'options'                 => array('TOP_LEFT','TOP_CENTER','TOP_RIGHT','LEFT_TOP','C1','RIGHT_TOP','LEFT_CENTER','C2','RIGHT_CENTER','LEFT_BOTTOM','C3','RIGHT_BOTTOM','BOTTOM_LEFT','BOTTOM_CENTER','BOTTOM_RIGHT'),
			'default'                 => 'TOP_LEFT',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('cols'=>3,'tl_class'=>'dlh_googlemaps_position'),
			'sql'                     => "varchar(16) NOT NULL default 'TOP_LEFT'"
		),
        'useRotateControl' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useRotateControl'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'default'                 => '1',
            'eval'                    => array('submitOnChange'=>true),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'rotateControlPos' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['controlPos'],
            'exclude'                 => true,
            'inputType'               => 'radioTable',
            'options'                 => array('TOP_LEFT','TOP_CENTER','TOP_RIGHT','LEFT_TOP','C1','RIGHT_TOP','LEFT_CENTER','C2','RIGHT_CENTER','LEFT_BOTTOM','C3','RIGHT_BOTTOM','BOTTOM_LEFT','BOTTOM_CENTER','BOTTOM_RIGHT'),
            'default'                 => 'TOP_LEFT',
            'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
            'eval'                    => array('cols'=>3,'tl_class'=>'dlh_googlemaps_position'),
            'sql'                     => "varchar(16) NOT NULL default 'TOP_LEFT'"
        ),
        'usePanControl' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['usePanControl'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'default'                 => '1',
            'eval'                    => array('submitOnChange'=>true),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'panControlPos' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['controlPos'],
            'exclude'                 => true,
            'inputType'               => 'radioTable',
            'options'                 => array('TOP_LEFT','TOP_CENTER','TOP_RIGHT','LEFT_TOP','C1','RIGHT_TOP','LEFT_CENTER','C2','RIGHT_CENTER','LEFT_BOTTOM','C3','RIGHT_BOTTOM','BOTTOM_LEFT','BOTTOM_CENTER','BOTTOM_RIGHT'),
            'default'                 => 'TOP_LEFT',
            'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
            'eval'                    => array('cols'=>3,'tl_class'=>'dlh_googlemaps_position'),
            'sql'                     => "varchar(16) NOT NULL default 'TOP_LEFT'"
        ),
		'useStreetViewControl' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useStreetViewControl'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
            'default'                 => '1',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default '1'"
		),
        'streetViewControlPos' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['controlPos'],
            'exclude'                 => true,
            'inputType'               => 'radioTable',
            'options'                 => array('TOP_LEFT','TOP_CENTER','TOP_RIGHT','LEFT_TOP','C1','RIGHT_TOP','LEFT_CENTER','C2','RIGHT_CENTER','LEFT_BOTTOM','C3','RIGHT_BOTTOM','BOTTOM_LEFT','BOTTOM_CENTER','BOTTOM_RIGHT'),
            'default'                 => 'TOP_LEFT',
            'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
            'eval'                    => array('cols'=>3,'tl_class'=>'dlh_googlemaps_position'),
            'sql'                     => "varchar(16) NOT NULL default 'TOP_LEFT'"
        ),
        'useOverviewMapControl' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useOverviewMapControl'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'default'                 => '1',
            'eval'                    => array('submitOnChange'=>true),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
        'overviewMapControlOpened' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['overviewMapControlOpened'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default '1'"
        ),
		'disableDoubleClickZoom' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['disableDoubleClickZoom'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
            'default'                 => '1',
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'scrollwheel' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['scrollwheel'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
            'default'                 => '1',
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'draggable' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['draggable'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
            'default'                 => '1',
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'useScaleControl' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['useScaleControl'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
            'default'                 => '1',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'scaleControlPos' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['controlPos'],
			'exclude'                 => true,
			'inputType'               => 'radioTable',
			'options'                 => array('TOP_LEFT','TOP_CENTER','TOP_RIGHT','LEFT_TOP','C1','RIGHT_TOP','LEFT_CENTER','C2','RIGHT_CENTER','LEFT_BOTTOM','C3','RIGHT_BOTTOM','BOTTOM_LEFT','BOTTOM_CENTER','BOTTOM_RIGHT'),
			'default'                 => 'BOTTOM_LEFT',
			'reference'               => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['references'],
			'eval'                    => array('cols'=>3,'tl_class'=>'dlh_googlemaps_position'),
			'sql'                     => "varchar(16) NOT NULL default 'BOTTOM_LEFT'"
		),
		'parameter' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['parameter'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
			'eval'                    => array('preserveTags'=>true, 'decodeEntities'=>true, 'class'=>'monospace', 'rte'=>'ace', 'helpwizard'=>true),
			'explanation'             => 'insertTags',
			'sql'                     => "text NULL"
		),
        'moreParameter' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps']['moreParameter'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
            'eval'                    => array('preserveTags'=>true, 'decodeEntities'=>true, 'class'=>'monospace', 'rte'=>'ace', 'helpwizard'=>true),
            'explanation'             => 'insertTags',
            'sql'                     => "text NULL"
        )
	)
);


/**
 * Class tl_dlh_googlemaps
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  2014 de la Haye
 * @author     Christian de la Haye <http://delahaye.de>
 * @package    dlh_googlemaps
 */
class tl_dlh_googlemaps extends \Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}


    /**
     * Check permissions to edit table tl_googlemaps
     */
    public function checkPermission()
    {
        if ($this->User->isAdmin)
        {
            return;
        }

        // Set root IDs
        if (!is_array($this->User->dlh_googlemapss) || empty($this->User->dlh_googlemapss))
        {
            $root = array(0);
        }
        else
        {
            $root = $this->User->dlh_googlemapss;
        }

        $GLOBALS['TL_DCA']['tl_dlh_googlemaps']['list']['sorting']['root'] = $root;

        // Check permissions to add Maps
        if (!$this->User->hasAccess('create', 'dlh_googlemapsp'))
        {
            $GLOBALS['TL_DCA']['tl_dlh_googlemaps']['config']['closed'] = true;
        }

        // Check current action
        switch (Input::get('act'))
        {
            case 'create':
            case 'select':
                // Allow
                break;

            case 'edit':
                // Dynamically add the record to the user profile
                if (!in_array(Input::get('id'), $root))
                {
                    $arrNew = $this->Session->get('new_records');

                    if (is_array($arrNew['tl_dlh_googlemaps']) && in_array(Input::get('id'), $arrNew['tl_dlh_googlemaps']))
                    {
                        // Add permissions on user level
                        if ($this->User->inherit == 'custom' || !$this->User->groups[0])
                        {
                            $objUser = $this->Database->prepare("SELECT dlh_googlemapss, dlh_googlemapsp FROM tl_user WHERE id=?")
                                ->limit(1)
                                ->execute($this->User->id);

                            $arrDlh_googlemapsp = deserialize($objUser->dlh_googlemapsp);

                            if (is_array($arrDlh_googlemapsp) && in_array('create', $arrDlh_googlemapsp))
                            {
                                $arrDlh_googlemapss = deserialize($objUser->dlh_googlemapss);
                                $arrDlh_googlemapss[] = Input::get('id');

                                $this->Database->prepare("UPDATE tl_user SET dlh_googlemapss=? WHERE id=?")
                                    ->execute(serialize($arrDlh_googlemapss), $this->User->id);
                            }
                        }

                        // Add permissions on group level
                        elseif ($this->User->groups[0] > 0)
                        {
                            $objGroup = $this->Database->prepare("SELECT dlh_googlemapss, dlh_googlemapsp FROM tl_user_group WHERE id=?")
                                ->limit(1)
                                ->execute($this->User->groups[0]);

                            $arrDlh_googlemapsp = deserialize($objGroup->dlh_googlemapsp);

                            if (is_array($arrDlh_googlemapsp) && in_array('create', $arrDlh_googlemapsp))
                            {
                                $arrDlh_googlemapss = deserialize($objGroup->dlh_googlemapss);
                                $arrDlh_googlemapss[] = Input::get('id');

                                $this->Database->prepare("UPDATE tl_user_group SET dlh_googlemapss=? WHERE id=?")
                                    ->execute(serialize($arrDlh_googlemapss), $this->User->groups[0]);
                            }
                        }

                        // Add new element to the user object
                        $root[] = Input::get('id');
                        $this->User->dlh_googlemapss = $root;
                    }
                }
            // No break;

            case 'copy':
            case 'delete':
            case 'show':
                if (!in_array(Input::get('id'), $root) || (Input::get('act') == 'delete' && !$this->User->hasAccess('delete', 'dlh_googlemapsp')))
                {
                    $this->log('Not enough permissions to '.Input::get('act').' Map ID "'.Input::get('id').'"', __METHOD__, TL_ERROR);
                    $this->redirect('contao/main.php?act=error');
                }
                break;

            case 'editAll':
            case 'deleteAll':
            case 'overrideAll':
                $session = $this->Session->getData();
                if (Input::get('act') == 'deleteAll' && !$this->User->hasAccess('delete', 'dlh_googlemapsp'))
                {
                    $session['CURRENT']['IDS'] = array();
                }
                else
                {
                    $session['CURRENT']['IDS'] = array_intersect($session['CURRENT']['IDS'], $root);
                }
                $this->Session->setData($session);
                break;

            default:
                if (strlen(Input::get('act')))
                {
                    $this->log('Not enough permissions to '.Input::get('act').' Maps', __METHOD__, TL_ERROR);
                    $this->redirect('contao/main.php?act=error');
                }
                break;
        }
    }


    /**
	 * Return the edit header button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function editHeader($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin || count(preg_grep('/^tl_dlh_googlemaps::/', $this->User->alexf)) > 0) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}


	/**
	 * Get geo coodinates drom address
     * @param string
     * @param object
     * @return string
     */
    function generateCoords($varValue, DataContainer $dc)
    {
        return $varValue ? $varValue : \delahaye\GeoCode::getCoordinates($dc->activeRecord->geocoderAddress, $dc->activeRecord->geocoderCountry, 'de');
    }


	/**
	 * List records
	 * @param array
	 * @return string
	 */
	public function listRecords($arrRow)
	{
		$return = '<strong>'.$arrRow['title'].'</strong>';
		if($arrRow['center'] && $arrRow['zoom'] && $arrRow['mapTypeId']) {
			$apikey = '';
			$pageList = \Database::getInstance()->prepare("select dlh_googlemaps_apikey from tl_page")->execute();
			while($pageList->next()){
				if($pageList->dlh_googlemaps_apikey){
					$apikey = '&key='.$pageList->dlh_googlemaps_apikey;
					continue;
				}
			}
			
			$src = 'https://maps.google.com/maps/api/staticmap?center=' . $arrRow['center'] . $apikey.'&zoom=' . ($arrRow['zoom']-2) . '&maptype=' . strtolower($arrRow['mapTypeId']) . '&language=' . $GLOBALS['TL_LANGUAGE'] . '&size=300x150';
			$return .= '<div style="margin-top:5px;margin-bottom:20px;"><img src="'.$src.'" alt="" /></div>';
		}

		return $return;
	}


}

?>