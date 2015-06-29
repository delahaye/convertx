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


// global operations
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fill'][0]         = 'Add field definitions';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fill'][1]         = 'Add field definitions automatically.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['new'][0]          = 'New field definition';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['new'][1]          = 'Add a configuration for a new field definition.';

// operations
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['edit'][0]         = 'Edit field definition';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['edit'][1]         = 'Edit converter ID %s';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['copy'][0]         = 'Duplicate field definition';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['copy'][1]         = 'Duplicate field definition ID %s';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['delete'][0]       = 'Delete field definition';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['delete'][1]       = 'Delete field definition ID %s';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['toggle'][0]       = 'Activate field definition';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['toggle'][1]       = 'Activate field definition ID %s';


// header fields
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['title_legend']    = 'Target field';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['insert_legend']   = 'Add new';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['update_legend']   = 'Update';


// fields
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fieldname'][0]        = 'Field name';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fieldname'][1]        = 'Name of the field.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['published'][0]        = 'active';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['published'][1]        = 'The field is processed.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowInsert'][0]      = 'Add new records';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowInsert'][1]      = 'New records are added.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowUpdate'][0]      = 'Update records';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowUpdate'][1]      = 'Existing records are updated.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['type'][0]             = 'Data research';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['type'][1]             = 'Defines how the the data for the field is determined.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['field'][0]            = 'Source-field';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['field'][1]            = 'Field in the source.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['mode'][0]             = 'Mode';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['mode'][1]             = 'Mode of the data update.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['addDelimiter'][0]     = 'Additional chars befor/after the source value';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['addDelimiter'][1]     = 'The chars are inserted before/after the value.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagMode'][0]          = 'Tag-handling';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagMode'][1]          = 'Defines how the tags are used.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagTypeSource'][0]    = 'Type of tags in the source';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagTypeSource'][1]    = 'The way of storing tags in the source.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagTypeTarget'][0]    = 'Type of tags in the target table';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagTypeTarget'][1]    = 'The way of storing tags in the target table.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['sourceDelimiter'][0]  = 'Separator in the source';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['sourceDelimiter'][1]  = 'Separator, if not serialized.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['targetDelimiter'][0]  = 'Separator in the target';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['targetDelimiter'][1]  = 'Separator, if not serialized.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['initialValue'][0]     = 'Determination of the start value';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['initialValue'][1]     = 'The start value can be determinated automatically.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['start'][0]            = 'Start value';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['start'][1]            = 'First value, only ciphers.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['step'][0]             = 'Step';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['step'][1]             = 'The value is aded. Only ciphers.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fix'][0]              = 'Fix value';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fix'][1]              = 'Same value for every record.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['sql'][0]              = 'Value from SQL query';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['sql'][1]              = 'The value `convertx_value` is calculated via SQL. The field values of the actual record are available with ##fieldname##.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['hook'][0]             = 'Registered hooks';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['hook'][1]             = 'It is possible to register custom hooks.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowInsert'][0]      = 'Add new records';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowInsert'][1]      = 'New records will be created.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowUpdate'][0]      = 'Update records';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowUpdate'][1]      = 'Existing records will be updated.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fillChar'][0]         = 'Char(s)';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fillChar'][1]         = 'Char(s) to fill up.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fieldLength'][0]      = 'Target field-length';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fieldLength'][1]      = 'Desired amount of chars.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandSide'][0]       = 'Side';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandSide'][1]       = 'Side of the char-addition.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandString'][0]     = 'Text added';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandString'][1]     = 'Text to add before/after.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandKeep'][0]       = 'Keep existing value';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandKeep'][1]       = 'The existing value is added too.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['dateVal'][0]          = 'Date';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['dateVal'][1]          = 'Determine the timestamp for this date.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['timeVal'][0]          = 'Time';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['timeVal'][1]          = 'Determine the timestamp for this time.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['dateFormat'][0]       = 'Format';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['dateFormat'][1]       = 'Date format in the source.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tstampUp'][0]         = 'Seconds added';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tstampUp'][1]         = 'Seconds can be added to the actual timestamp.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleInsert'][0]     = 'Keys for female';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleInsert'][1]     = 'Attention - use only small characters!  If one of the keys occurs, female is set, otherwise male is checked.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleUpdate'][0]     = 'Keys for female';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleUpdate'][1]     = 'Attention - use only small characters!  If one of the keys occurs, female is set, otherwise male is checked.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleInsert'][0]       = 'Keys for male';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleInsert'][1]       = 'Attention - use only small characters! If one of the keys occurs, male is set, otherwise nothing.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleUpdate'][0]       = 'Keys for male';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleUpdate'][1]       = 'Attention - use only small characters! If one of the keys occurs, male is set, otherwise nothing.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleVal'][0]        = 'Target value for female';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleVal'][1]        = 'Used value in the target.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleVal'][0]          = 'Target value for female';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleVal'][1]          = 'Used value in the target.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['splitString'][0]      = 'Split string';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['splitString'][1]      = 'Char(s) that split up the content. Blank = ´[nbsp]´';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['splitPart'][0]        = 'Relevant part of the text';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['splitPart'][1]        = 'Nummer of the text part, beginning with ´1´´, ´2´ etc.. ´0´=last, ´-1´=one back etc..';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['noInsert'][0]         = 'Keys for NO';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['noInsert'][1]         = 'Attention - use only small characters! If one of the keys occurs, NO is set, otherwise YES. Empty strings, NULL and false are NO-values.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['noUpdate'][0]         = 'Keys for NO';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['noUpdate'][1]         = 'Attention - use only small characters! If one of the keys occurs, NO is set, otherwise YES. Empty strings, NULL and false are NO-values.';


// references
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['field']             = 'Field';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['new']               = 'Addition';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['update']            = 'Update';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Insertfromfield']   = 'from source field';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Insertfix']         = 'fixed value';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Insertsql']         = 'value via SQL';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Inserthook']        = 'value via hook-function';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Insertcountup']     = 'automatic count-up';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Insertdate']        = 'fixed date';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Updatefromfield']   = 'from source field';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Updatefix']         = 'fixed value';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Updatesql']         = 'value via SQL';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Updatehook']        = 'value via hook-function';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Updatedate']        = 'fixed date';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['initialValue']      = 'determine first value';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['ownValue']          = 'own first value';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['tabValue']          = 'highest value in the target plus step';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Addnew']            = 'Add value 1:1';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Replace']           = 'Replace value 1:1';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Bool']              = 'yes/no determination';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Gender']            = 'Sex determination';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Country']           = 'Country determination';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Fill']              = 'fill up to fixed length';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Crop']              = 'crop to maximum length';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Expand']            = 'add value before/after';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Tags']              = 'Tags, serializsations';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Add']               = 'Add tags from the source';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Delete']            = 'Delete tags of the source';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['DeleteExistent']    = 'Delete tags missing in the source';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['DeleteAdd']         = 'Delete tags missing in the source and add new ones';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['delimited']         = 'with separator';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['serialized']        = 'serialized field';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['leftSide']          = 'left side';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['rightSide']         = 'right side';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Datestring']        = 'Get timestamp from date';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Updatetstamp']      = 'actual timestamp';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Inserttstamp']      = 'actual timestamp';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['new']               = 'Add';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['update']            = 'Update';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Base64']            = 'Base64-decode value';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Pass']              = 'Password generation';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['tmpField']          = 'Temporary value';
