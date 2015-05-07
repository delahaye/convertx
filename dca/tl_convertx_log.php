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
 * Table tl_convertx_log
 */
$GLOBALS['TL_DCA']['tl_convertx_log'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_convertx_run',
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
			'mode'                    => 0,
			'flag'                    => 1,
			'fields'                  => array('id'),
			'panelLayout'             => 'filter;search,limit',
			'headerFields'            => array('id'),
			'child_record_callback'   => array('Delahaye\ConvertX\Dca\Log', 'listElements')
		),
		'operations' => array
		(
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_log']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},step,title,status,details'
	),

	// Fields
	'fields' => array
	(
        'id' => array
        (
            'sorting'                 => true,
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'foreignKey'              => 'tl_convertx_run.id',
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
            'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'status' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_log']['status'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'select',
            'options'                 => array('ok','error','abort'),
            'default'                 => 'ok',
            'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_log']['references'],
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'type' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_log']['type'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array('step','entry'),
            'default'                 => 'step',
            'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_log']['references'],
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_log']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'details' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_log']['details'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
            'sql'                     => "text NULL"
		)
	)
);
