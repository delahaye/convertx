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
 * Table tl_convertx_run
 */
$GLOBALS['TL_DCA']['tl_convertx_run'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_convertx_job',
		'ctable'                      => array('tl_convertx_log'),
		'switchToEdit'                => false,
		'closed'                      => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
                'pid' => 'index'
            )
        )
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'flag'                    => 6,
			'fields'                  => array('begin'),
			'headerFields'            => array('title'),
			'panelLayout'             => 'filter;search,limit',
			'child_record_callback'   => array('Delahaye\ConvertX\Dca\Run', 'listRuns')
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
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_run']['edit'],
				'href'                => 'table=tl_convertx_runstep',
				'icon'                => 'system/modules/convertx/assets/icon_runsteps.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_run']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_run']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},job,begin,end,status,user'
	),

	// Fields
	'fields' => array
	(
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'foreignKey'              => 'tl_convertx_job.title',
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
            'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
		'begin' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['begin'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'end' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['end'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
        'closed' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['closed'],
            'exclude'                 => true,
            'sql'                     => "char(1) NOT NULL default ''"
        ),
		'user' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['user'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_user.name',
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
        'simulation' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['simulation'],
            'exclude'                 => true,
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'step' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['step'],
            'exclude'                 => true,
            'sql'                     => "int(10) NOT NULL default '0'"
        ),
        'line' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['line'],
            'exclude'                 => true,
            'sql'                     => "int(10) NOT NULL default '0'"
        ),
        'steps' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['steps'],
            'exclude'                 => true,
            'sql'                     => "blob NULL"
        ),
        'targets' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['targets'],
            'exclude'                 => true,
            'sql'                     => "blob NULL"
        ),
        'cleared' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['cleared'],
            'exclude'                 => true,
            'sql'                     => "blob NULL"
        ),
        'sources' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['sources'],
            'exclude'                 => true,
            'sql'                     => "blob NULL"
        ),
        'filled' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['filled'],
            'exclude'                 => true,
            'sql'                     => "blob NULL"
        ),
		'status' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['status'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => array('ok','error','abort'),
			'default'                 => 'ok',
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_run']['references'],
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
        'rootRun' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['rootRun'],
            'exclude'                 => true,
            'sql'                     => "int(10) NOT NULL default '0'"
        ),
        'jumpToRun' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['jumpToRun'],
            'exclude'                 => true,
            'sql'                     => "int(10) NOT NULL default '0'"
        ),
        'jumpToJob' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['jumpToJob'],
            'exclude'                 => true,
            'sql'                     => "int(10) NOT NULL default '0'"
        ),
        'log' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_run']['log'],
            'exclude'                 => true,
            'search'                  => true,
            'sql'                     => "blob NULL"
        )
	)
);
