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
 * Table tl_convertx_step
 */
$GLOBALS['TL_DCA']['tl_convertx_step'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_convertx_job',
        'switchToEdit'                => true,
        'enableVersioning'            => false,
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
			'flag'                    => 1,
			'fields'                  => array('sorting'),
			'headerFields'            => array('title'),
			'panelLayout'             => 'filter;search,limit',
			'child_record_callback'   => array('Delahaye\ConvertX\Dca\Step', 'listSteps')
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s'
		),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_step']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_step']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_step']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_step']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_step']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
				'button_callback'     => array('Delahaye\ConvertX\Dca\Step', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_step']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('action'),
		'default'                     => '{title_legend},title,published;{steps_legend},abortOnError,action',
		'converter'                   => '{title_legend},title,published;{steps_legend},abortOnError,action,converter',
		'sql'                         => '{title_legend},title,published;{steps_legend},abortOnError,action,sqlData,onSimulation',
		'hook'                        => '{title_legend},title,published;{steps_legend},abortOnError,action,hook,onSimulation',
        'job'                         => '{title_legend},title,published;{steps_legend},abortOnError,action,job'
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
            'foreignKey'              => 'tl_convertx_job.id',
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
            'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
        ),
        'sorting' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['MSC']['sorting'],
            'sorting'                 => true,
            'flag'                    => 2,
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_step']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_step']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
		),
		'abortOnError' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_step']['abortOnError'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
            'sql'                     => "char(1) NOT NULL default ''"
		),
		'action' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_step']['action'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => array('converter','sql','hook','job'),
			'default'                 => 'tableimport',
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_step']['references'],
			'eval'                    => array('includeBlankOption'=>true, 'submitOnChange'=>true),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'converter' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_step']['converter'],
			'exclude'                 => true,
			'inputType'               => 'select',
            'foreignKey'              => 'tl_convertx_converter.id',
            'relation'                => array('type'=>'belongsTo', 'load'=>'lazy'),
			'options_callback'        => array('Delahaye\ConvertX\Dca\Step','getConverters'),
			'wizard' => array
			(
				array('Delahaye\ConvertX\Dca\Step', 'editConverter')
			),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
        'job' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_step']['job'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'foreignKey'              => 'tl_convertx_job.id',
            'relation'                => array('type'=>'belongsTo', 'load'=>'lazy'),
            'options_callback'        => array('Delahaye\ConvertX\Dca\Step','getJobs'),
            'eval'                    => array('includeBlankOption'=>true, 'submitOnChange'=>true),
            'wizard' => array
            (
                array('Delahaye\ConvertX\Dca\Step', 'editJob')
            ),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
		'sqlData' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_step']['sqlData'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
			'eval'                    => array('decodeEntities'=>true, 'preserveTags'=>true),
            'sql'                     => "text NULL"
		),
		'hook' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_step']['hook'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options_callback'        => array('Delahaye\ConvertX\Dca\Step','getHooks'),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
        'onSimulation' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_step']['onSimulation'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'sql'                     => "char(1) NOT NULL default ''"
        )
	)
);
