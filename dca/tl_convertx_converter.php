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
 * Table tl_convertx_converter
 */
$GLOBALS['TL_DCA']['tl_convertx_converter'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'     => 'Table',
		'ctable'            => array('tl_convertx_converterfield'),
		'switchToEdit'      => true,
        'onload_callback'   => array
        (
            array('Delahaye\ConvertX\Dca\Converter', 'checkPermission'),
            array('Delahaye\ConvertX\Dca\Converter', 'expandPalette')
        ),
		'onsubmit_callback' => array
        (
			array('Delahaye\ConvertX\Dca\Converter','setFieldLists')
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
			'flag'                    => 1,
			'panelLayout'             => 'limit',
		),
        'label' => array
        (
            'fields'                  => array('title','sourceType','targetType'),
            'format'                  => '%s <span style="color:#c0c0c0;">(%s-->%s)</span>'
        ),
		'global_operations' => array
		(
            'back' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['previous'],
                'href'                => 'table=',
                'class'               => 'header_back',
                'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="b"'
            ),
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_converter']['edit'],
				'href'                => 'table=tl_convertx_converterfield',
				'icon'                => 'edit.gif',
				'attributes'          => 'class="contextmenu"',
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_converter']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'button_callback'     => array('Delahaye\ConvertX\Dca\Converter', 'editHeader'),
				'attributes'          => 'class="edit-header"'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_converter']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"',
                'button_callback'     => array('Delahaye\ConvertX\Dca\Converter', 'delete')
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('deleteOnRules'),
		'default'                     => '{title_legend},title,abortOnError;{source_legend:show},sourceType;{target_legend:show},targetType',
	),

	// Palettes
	'subpalettes' => array
	(
		'deleteOnRules'               => 'deleteRules'
	),

    // Source palettes
    'sourcepalettes' => array
    (
        'InternalTable'               => 'sourceTable,useTempSource'
    ),

    // Target palettes
    'targetpalettes' => array
    (
        'InternalTable'               => 'targetTable,deleteOnStart,deleteOnRules,allowInsert,allowUpdate'
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
        'targetKeys' => array
        (
            'sql'                     => "longblob NULL"
        ),
        'keyTarget' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['keyTarget'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => array('Delahaye\ConvertX\Dca\Converter','getTargetFields'),
            'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'keySource' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['keySource'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => array('Delahaye\ConvertX\Dca\Converter','getSourceFields'),
            'eval'                    => array('mandatory'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'abortOnError' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['abortOnError'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
            'sql'                     => "char(1) NOT NULL default ''"
		),
		'sourceType' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceType'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
            'options'                 => array('InternalTable'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converter']['references'],
			'eval'                    => array('includeBlankOption'=>true, 'submitOnChange'=>true),
            'sql'                     => "varchar(32) NOT NULL default ''"
		),
        'fieldsSource' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldsSource'],
            'exclude'                 => true,
            'inputType'               => 'multiColumnWizard',
            'eval'                    => array
            (
                'tl_class' => 'clr',
                'columnFields' => array
                (
                    'name' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_name'],
                        'exclude'     => true,
                        'inputType'   => 'text',
                        'eval'        => array('disabled'=>false, 'style'=>'width:200px')
                    ),
                    'default' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_default'],
                        'exclude'     => true,
                        'inputType'   => 'text',
                        'eval'        => array('disabled'=>false, 'style'=>'width:100px')
                    ),
                    'type' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_type'],
                        'exclude'     => true,
                        'inputType'   => 'select',
                        'options'     => array('int','decimal','char','varchar','text','longtext','blob'),
                        'eval'        => array('disabled'=>false, 'style'=>'width:80px')
                    ),
                    'length' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_length'],
                        'exclude'     => true,
                        'inputType'   => 'text',
                        'eval'        => array('disabled'=>false, 'style'=>'width:30px')
                    ),
                    'null' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_null'],
                        'exclude'     => true,
                        'inputType'   => 'select',
                        'default'     => 'NULL',
                        'options'     => array('NULL', 'NOT_NULL'),
                        'eval'        => array('disabled'=>false, 'style'=>'width:90px')
                    ),
                    'unique' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_unique'],
                        'exclude'     => true,
                        'inputType'   => 'select',
                        'default'     => '',
                        'options'     => array('', 'isKey',''),
                        'reference'   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['references'],
                        'eval'        => array('disabled'=>false, 'style'=>'width:100px')
                    )
                )
            ),
            'sql'                     => "blob NULL"
        ),
        'targetType' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['targetType'],
            'exclude'                 => true,
            'filter'                  => true,
            'sorting'                 => true,
            'inputType'               => 'select',
            'options'                 => array('InternalTable'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converter']['references'],
            'eval'                    => array('includeBlankOption'=>true, 'submitOnChange'=>true),
            'sql'                     => "varchar(32) NOT NULL default ''"
        ),
        'fieldsTarget' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldsTarget'],
            'inputType'               => 'multiColumnWizard',
            'eval'                    => array
            (
                'tl_class' => 'clr',
                'columnFields' => array
                (
                    'name' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_name'],
                        'exclude'     => true,
                        'inputType'   => 'text',
                        'eval'        => array('disabled'=>false, 'style'=>'width:200px')
                    ),
                    'default' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_default'],
                        'exclude'     => true,
                        'inputType'   => 'text',
                        'eval'        => array('disabled'=>false, 'style'=>'width:100px')
                    ),
                    'type' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_type'],
                        'exclude'     => true,
                        'inputType'   => 'select',
                        'options'     => array('int','decimal','char','varchar','text','longtext','blob'),
                        'eval'        => array('disabled'=>false, 'style'=>'width:80px')
                    ),
                    'length' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_length'],
                        'exclude'     => true,
                        'inputType'   => 'text',
                        'eval'        => array('disabled'=>false, 'style'=>'width:30px')
                    ),
                    'null' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_null'],
                        'exclude'     => true,
                        'inputType'   => 'select',
                        'default'     => 'NULL',
                        'options'     => array('NULL', 'NOT_NULL'),
                        'eval'        => array('disabled'=>false, 'style'=>'width:90px')
                    ),
                    'unique' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_unique'],
                        'exclude'     => true,
                        'inputType'   => 'select',
                        'default'     => '',
                        'options'     => array('', 'isKey',''),
                        'reference'   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['references'],
                        'eval'        => array('disabled'=>false, 'style'=>'width:100px')
                    ),
                )
            ),
            'sql'                     => "blob NULL"
        ),
        'targetTable' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['targetTable'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => array('Delahaye\ConvertX\Dca\Converter','getTables'),
            'eval'                    => array('includeBlankOption'=>true, 'submitOnChange'=>true),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'sourceTable' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceTable'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options_callback'        => array('Delahaye\ConvertX\Dca\Converter','getTables'),
            'eval'                    => array('includeBlankOption'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'useTempSource' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['useTempSource'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'deleteOnStart' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteOnStart'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array('all','missing','existent'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converter']['references'],
            'eval'                    => array('submitOnChange'=>true, 'includeBlankOption'=>true, 'tl_class'=>'clr'),
            'sql'                     => "varchar(8) NOT NULL default ''"
        ),
        'deleteOnRules' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteOnRules'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('submitOnChange'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'deleteRules' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteRules'],
            'exclude'                 => true,
            'inputType'               => 'multiColumnWizard',
            'eval'                    => array
            (
                'columnFields' => array
                (
                    'type' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_type'],
                        'exclude'     => true,
                        'inputType'   => 'select',
                        'default'     => 'and',
                        'options'     => array('and','or'),
                        'reference'   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['references'],
                        'eval'        => array('style'=>'width:60px')
                    ),
                    'field' => array
                    (
                        'label'            => &$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_field'],
                        'exclude'          => true,
                        'inputType'        => 'select',
                        'options_callback' => array('Delahaye\ConvertX\Dca\Converter','getTargetFields'),
                        'eval'             => array('style'=>'width:200px')
                    ),
                    'operator' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_operator'],
                        'exclude'     => true,
                        'inputType'   => 'select',
                        'default'     => 'eq',
                        'options'     => array('eq','gteq','gt','lt','lteq','begins','ends'),
                        'reference'   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['references'],
                        'eval'        => array('style'=>'width:120px')
                    ),
                    'value' => array
                    (
                        'label'       => &$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_value'],
                        'exclude'     => true,
                        'inputType'   => 'text',
                        'eval'        => array('style'=>'width:200px')
                    )
                )
            ),
            'sql'                     => "blob NULL"
        ),
        'allowUpdate' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['allowUpdate'],
            'exclude'                 => true,
            'filter'                  => true,
            'default'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('submitOnChange'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'allowInsert' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converter']['allowInsert'],
            'exclude'                 => true,
            'filter'                  => true,
            'default'                 => true,
            'inputType'               => 'checkbox',
            'sql'                     => "char(1) NOT NULL default ''"
       )
	)
);
