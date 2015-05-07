<?php

/**
 * ConvertX
 * Extension for Contao Open Source CMS (contao.org)
 *
 * Copyright (c) 2015 de la Haye
 *
 * @author  Christian de la Haye
 * @link    http://delahaye.de
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Table tl_convertx_job
 */
$GLOBALS['TL_DCA']['tl_convertx_job'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_convertx_step','tl_convertx_run'),
		'switchToEdit'                => true,
        'enableVersioning'            => false,
        'onload_callback' => array
        (
            array('Delahaye\ConvertX\Dca\Job', 'checkPermission'),
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
			'panelLayout'             => 'filter,search,limit',
		),
		'global_operations' => array
		(
            'converter' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_convertx_job']['converter'],
                'href'                => 'table=tl_convertx_converter',
                'icon'                => 'system/modules/convertx/assets/icon_converter.gif',
                'attributes'          => 'class="contextmenu"',
                'button_callback'     => array('Delahaye\ConvertX\Dca\Job', 'converter')
            ),
			'restore' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_job']['restore'],
                'icon'                => 'system/modules/convertx/assets/icon_restore.gif',
				'href'                => 'key=restore',
				'class'               => 'header_restore',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="r"',
                'button_callback'     => array('Delahaye\ConvertX\Dca\Job', 'restore')
			),
			'howto' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_job']['howto'],
                'icon'                => 'system/modules/convertx/assets/icon_howto.gif',
				'href'                => 'key=howto',
				'class'               => 'header_howto',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="h"'
			)
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s'
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_job']['edit'],
				'href'                => 'table=tl_convertx_step',
				'icon'                => 'edit.gif',
				'attributes'          => 'class="contextmenu"',
                'button_callback'     => array('Delahaye\ConvertX\Dca\Job', 'edit'),
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_job']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'button_callback'     => array('Delahaye\ConvertX\Dca\Job', 'editHeader'),
				'attributes'          => 'class="edit-header"'
			),
			'runs' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_job']['runs'],
				'href'                => 'table=tl_convertx_run',
				'icon'                => 'system/modules/convertx/assets/icon_runs.gif',
                'button_callback'     => array('Delahaye\ConvertX\Dca\Job', 'runJob')
			),
			'runjob' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_job']['runjob'],
				'href'                => 'key=runjob',
				'icon'                => 'system/modules/convertx/assets/icon_runjob.gif',
				'button_callback'     => array('Delahaye\ConvertX\Dca\Job', 'runJob')
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_job']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif',
                'button_callback'     => array('Delahaye\ConvertX\Dca\Job', 'copyJob')
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_job']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"',
                'button_callback'     => array('Delahaye\ConvertX\Dca\Job', 'deleteJob')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_job']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => 'title,keepVersions,keepLogs,token,targetTables'
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
        'error' => array
        (
            'inputType'               => 'text',
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_job']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'keepVersions' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_job']['keepVersions'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'default'                 => '3',
			'options'                 => array('1','2','3','4','5','10','20','50','100'),
            'sql'                     => "int(10) unsigned NOT NULL default '3'"
		),
        'keepLogs' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_job']['keepLogs'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'default'                 => '20',
            'options'                 => array('1','2','3','4','5','10','20','50','100'),
            'sql'                     => "int(10) unsigned NOT NULL default '20'"
        ),
		'token' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_job']['token'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'alwaysSave'=>true),
            'save_callback'          => array(array('Delahaye\ConvertX\Dca\Job','setToken')),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
        'targetTables' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_job']['targetTables'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'options_callback'        => array('Delahaye\ConvertX\Dca\Job','getTables'),
            'eval'                    => array('multiple'=>true),
            'sql'                     => "blob NULL"
        ),
		'lastrun' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_job']['lastrun'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
		)
	)
);
