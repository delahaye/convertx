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
 * Table tl_convertx_converterfield
 */
$GLOBALS['TL_DCA']['tl_convertx_converterfield'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_convertx_converter',
		'onload_callback'             => array
		(
            array('Delahaye\ConvertX\Dca\Converterfield','autoFill'),
			array('Delahaye\ConvertX\Dca\Converterfield','adjustPalette')
		),
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
			'fields'                  => array('sorting','fieldname'),
            'flag'                    => 11,
			'panelLayout'             => 'filter;sort,search,limit',
			'headerFields'            => array('title','sourceType','targetType'),
			'child_record_callback'   => array('Delahaye\ConvertX\Dca\Converterfield', 'listElements')
		),
		'global_operations' => array
		(
            'fill' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fill'],
                'icon'                => 'system/modules/convertx/assets/icon_converter.gif',
                'href'                => 'key=fill',
                'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="f"'
            ),
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
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
				'button_callback'     => array('Delahaye\ConvertX\Dca\Converterfield', 'toggleIcon')
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('allowInsert','allowUpdate'),
		'default'                     => '{title_legend},fieldname,published;{insert_legend},allowInsert;{update_legend},allowUpdate'
	),

	'subpalettes' => array
	(
		'allowInsert'                 => 'typeInsert,fieldInsert,modeInsert',
		'allowUpdate'                 => 'typeUpdate,fieldUpdate,modeUpdate',

		'InsertfromfieldAddnew'       => 'typeInsert,fieldInsert,modeInsert',
		'InsertfromfieldFill'         => 'typeInsert,fieldInsert,modeInsert,fillCharInsert,fieldLengthInsert,expandSideInsert',
		'InsertfromfieldExpand'       => 'typeInsert,fieldInsert,modeInsert,expandStringInsert,expandSideInsert',
		'InsertfromfieldCrop'         => 'typeInsert,fieldInsert,modeInsert,fieldLengthInsert,expandSideInsert',
		'InsertfromfieldBool'         => 'typeInsert,fieldInsert,modeInsert,noInsert',
        'InsertfromfieldGender'       => 'typeInsert,fieldInsert,modeInsert,femaleInsert,femaleValInsert,maleInsert,maleValInsert',
        'InsertfromfieldCountry'      => 'typeInsert,fieldInsert,modeInsert',
		'InsertfromfieldDatestring'   => 'typeInsert,fieldInsert,modeInsert,dateFormatInsert',
		'InsertfromfieldTags'         => 'typeInsert,fieldInsert,modeInsert,tagTypeSourceInsert,sourceDelimiterInsert,tagTypeTargetInsert,targetDelimiterInsert',
        'InsertfromfieldBase64'       => 'typeInsert,fieldInsert,modeInsert',
        'InsertfromfieldPass'         => 'typeInsert,fieldInsert,modeInsert',
		'Insertcountup'               => 'typeInsert,initialValue,start,step',
		'Insertfix'                   => 'typeInsert,fixInsert',
		'Insertsql'                   => 'typeInsert,sqlInsert',
		'Inserthook'                  => 'typeInsert,hookInsert',
		'Insertdate'                  => 'typeInsert,dateValInsert,timeValInsert',
		'Inserttstamp'                => 'typeInsert,tstampUpInsert',

		'UpdatefromfieldReplace'      => 'typeUpdate,fieldUpdate,modeUpdate',
		'UpdatefromfieldFill'         => 'typeUpdate,fieldUpdate,modeUpdate,fillCharUpdate,fieldLengthUpdate,expandSideUpdate',
		'UpdatefromfieldExpand'       => 'typeUpdate,fieldUpdate,modeUpdate,expandStringUpdate,expandKeep,expandSideUpdate',
		'UpdatefromfieldCrop'         => 'typeUpdate,fieldUpdate,modeUpdate,fieldLengthUpdate,expandSideUpdate',
		'UpdatefromfieldBool'         => 'typeUpdate,fieldUpdate,modeUpdate,noUpdate',
        'UpdatefromfieldGender'       => 'typeUpdate,fieldUpdate,modeUpdate,femaleUpdate,femaleValUpdate,maleUpdate,maleValUpdate',
        'UpdatefromfieldCountry'      => 'typeUpdate,fieldUpdate,modeUpdate',
		'UpdatefromfieldDatestring'   => 'typeUpdate,fieldUpdate,modeUpdate,dateFormatUpdate',
		'UpdatefromfieldTags'         => 'typeUpdate,fieldUpdate,modeUpdate,tagMode,tagTypeSourceUpdate,sourceDelimiterUpdate,tagTypeTargetUpdate,targetDelimiterUpdate',
        'UpdatefromfieldPass'         => 'typeUpdate,fieldUpdate,modeUpdate',
		'Updatefix'                   => 'typeUpdate,fixUpdate',
		'Updatesql'                   => 'typeUpdate,sqlUpdate',
		'Updatehook'                  => 'typeUpdate,hookUpdate',
		'Updatedate'                  => 'typeUpdate,dateValUpdate,timeValUpdate',
		'Updatetstamp'                => 'typeUpdate,tstampUpUpdate',

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
            'foreignKey'              => 'tl_convertx_converter.title',
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
            'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
        ),
        'sorting' => array
       (
           'label'                    => &$GLOBALS['TL_LANG']['MSC']['sorting'],
            'sorting'                 => true,
            'flag'                    => 1,
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
		'fieldname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fieldname'],
			'exclude'                 => true,
			'sorting'                 => true,
			'search'                  => true,
			'inputType'               => 'select',
			'options_callback'        => array('Delahaye\ConvertX\Dca\Converterfield','getTargetFields'),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
		),
		'allowInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowInsert'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'default'                 => true,
			'eval'                    => array('submitOnChange'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
		),
		'allowUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowUpdate'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'default'                 => '1',
			'eval'                    => array('submitOnChange'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
		),
		'typeInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['type'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('Insertfromfield','Insertfix','Insertdate','Inserttstamp','Insertcountup','Insertsql','Inserthook'),
			'default'                 => 'Insertfromfield',
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'],
			'eval'                    => array('submitOnChange'=>true),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'fieldInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['field'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options_callback'        => array('Delahaye\ConvertX\Dca\Converterfield','getSourceFields'),
			'eval'                    => array('tl_class'=>'w50','includeBlankOption'=>true),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'modeInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['mode'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('Addnew','Expand','Crop','Fill','Bool','Gender','Country','Datestring','Tags','Base64','Pass'),
			'default'                 => 'Addnew',
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'],
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50','includeBlankOption'=>true),
            'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'fixInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fix'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'sqlInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['sql'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
			'eval'                    => array('decodeEntities'=>true),
            'sql'                     => "text NULL"
		),
		'hookInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['hook'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options_callback'        => array('Delahaye\ConvertX\Dca\Converterfield','getHooks'),
			'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'tagTypeSourceInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagTypeSource'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('delimited','serialized'),
			'default'                 => 'delimited',
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'],
			'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'sourceDelimiterInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['sourceDelimiter'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'tagTypeTargetInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagTypeTarget'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('delimited','serialized'),
			'default'                 => 'delimited',
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'],
			'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'targetDelimiterInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['targetDelimiter'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'typeUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['type'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('Updatefromfield','Updatefix','Updatedate','Updatetstamp','Updatesql','Updatehook'),
			'default'                 => 'Updatefromfield',
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'],
			'eval'                    => array('submitOnChange'=>true),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'fieldUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['field'],
			'exclude'                 => true,
			'inputType'               => 'select',
            'options_callback'        => array('Delahaye\ConvertX\Dca\Converterfield','getSourceFields'),
			'eval'                    => array('tl_class'=>'w50','includeBlankOption'=>true),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'modeUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['mode'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('Replace','Expand','Crop','Fill','Bool','Gender','Country','Datestring','Tags','Base64','Pass'),
			'default'                 => 'Replace',
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'],
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'addDelimiter' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['addDelimiter'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'tagMode' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagMode'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('Replace','Add','Delete','DeleteExistent','DeleteAdd'),
			'default'                 => 'Replace',
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'],
            'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'tagTypeSourceUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagTypeSource'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('delimited','serialized'),
			'default'                 => 'delimited',
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'],
			'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'sourceDelimiterUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['sourceDelimiter'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'tagTypeTargetUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagTypeTarget'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('delimited','serialized'),
			'default'                 => 'delimited',
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'],
			'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'targetDelimiterUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['targetDelimiter'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'fixUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fix'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'sqlUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['sql'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
			'eval'                    => array('decodeEntities'=>true),
            'sql'                     => "text NULL"
		),
		'hookUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['hook'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options_callback'        => array('Delahaye\ConvertX\Dca\Converterfield','getHooks'),
			'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'initialValue' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['initialValue'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('tabValue','ownValue'),
			'default'                 => 'tabValue',
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'],
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'start' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['start'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>digit, 'tl_class'=>'w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'step' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['step'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>digit, 'tl_class'=>'w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'fillCharInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fillChar'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>1),
            'sql'                     => "char(1) NOT NULL default ''"
		),
		'expandStringInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandString'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'expandSideInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandSide'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('leftSide','rightSide'),
			'default'                 => 'leftSide',
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'],
			'eval'                    => array('submitOnChange'=>true),
            'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'fieldLengthInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fieldLength'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>digit),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'dateValInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['dateVal'],
			'default'                 => time(),
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'mandatory'=>false, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "varchar(8) NOT NULL default ''"
		),
		'timeValInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['timeVal'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'time', 'mandatory'=>false, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "varchar(8) NOT NULL default ''"
		),
		'dateFormatInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['dateFormat'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'default'                 => 'd.m.Y',
			'eval'                    => array('maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'fillCharUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fillChar'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>1),
            'sql'                     => "char(1) NOT NULL default ''"
		),
		'expandStringUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandString'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
        'expandKeep' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandKeep'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
		'expandSideUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandSide'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('leftSide','rightSide'),
			'default'                 => 'leftSide',
			'reference'               => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'],
			'eval'                    => array('submitOnChange'=>true),
            'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'fieldLengthUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fieldLength'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>digit),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'dateValUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['dateVal'],
			'default'                 => time(),
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'mandatory'=>false, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'timeValUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['timeVal'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'time', 'mandatory'=>false, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "varchar(8) NOT NULL default ''"
		),
		'dateFormatUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['dateFormat'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'default'                 => 'd.m.Y',
			'eval'                    => array('maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'tstampUpInsert' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tstampUp'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'default'                 => 0,
			'eval'                    => array('rgxp'=>digit),
            'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'tstampUpUpdate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tstampUp'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'default'                 => 0,
			'eval'                    => array('rgxp'=>digit),
            'sql'                     => "varchar(64) NOT NULL default ''"
		),
        'femaleInsert' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleInsert'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'default'                 => 'female,f,w,mrs,frau',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(255) NOT NULL default 'female,f,w,mrs,frau'"
        ),
        'maleInsert' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleInsert'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'default'                 => 'male,m,mr,herr',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(255) NOT NULL default 'male,m,mr,herr'"
        ),
        'femaleUpdate' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleUpdate'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'default'                 => 'female,f,w,mrs,frau',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(255) NOT NULL default 'female,f,w,mrs,frau'"
        ),
        'maleUpdate' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleUpdate'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'default'                 => 'male,m,mr,herr',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(255) NOT NULL default 'male,m,mr,herr'"
        ),
        'femaleValInsert' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleVal'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'default'                 => 'female',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default 'female'"
        ),
        'femaleValUpdate' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleVal'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'default'                 => 'female',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default 'female'"
        ),
        'maleValInsert' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleVal'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'default'                 => 'male',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default 'male'"
        ),
        'maleValUpdate' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleVal'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'default'                 => 'male',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default 'male'"
        ),
        'noInsert' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['noInsert'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'default'                 => 'nein,no,n,-,0,-1',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'long clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'noUpdate' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_convertx_converterfield']['noUpdate'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'default'                 => 'nein,no,n,-,0,-1',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'long clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
	)
);
