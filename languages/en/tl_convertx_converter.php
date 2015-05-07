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
$GLOBALS['TL_LANG']['tl_convertx_converter']['new'][0] = 'New converter';
$GLOBALS['TL_LANG']['tl_convertx_converter']['new'][1] = 'Add configuration for a new converter.';


// operations
$GLOBALS['TL_LANG']['tl_convertx_converter']['edit'][0]          = 'Field configuration of the converter';
$GLOBALS['TL_LANG']['tl_convertx_converter']['edit'][1]          = 'Edit converter ID %s';

$GLOBALS['TL_LANG']['tl_convertx_converter']['delete'][0]        = 'Delete converter';
$GLOBALS['TL_LANG']['tl_convertx_converter']['delete'][1]        = 'Delete converter ID %s';

$GLOBALS['TL_LANG']['tl_convertx_converter']['editheader'][0]    = 'Settings of the converter';
$GLOBALS['TL_LANG']['tl_convertx_converter']['editheader'][1]    = 'Edit settings of the converters ID %s';


// legends
$GLOBALS['TL_LANG']['tl_convertx_converter']['title_legend']     = 'General';
$GLOBALS['TL_LANG']['tl_convertx_converter']['target_legend']    = 'Data target';
$GLOBALS['TL_LANG']['tl_convertx_converter']['source_legend']    = 'Data source';


// converter type
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['InternalTable'] = 'Internal Contao table';

// fields
$GLOBALS['TL_LANG']['tl_convertx_converter']['title'][0]             = 'Title';
$GLOBALS['TL_LANG']['tl_convertx_converter']['title'][1]             = 'Title of the converter.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['abortOnError'][0]      = 'Abort on error (partly)';
$GLOBALS['TL_LANG']['tl_convertx_converter']['abortOnError'][1]      = 'This conversion is aborted if a recordset cannot be added or modified. By standard only the actual line will be ignored.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceType'][0]        = 'Data source';
$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceType'][1]        = 'Type of the data source.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceFile'][0]        = 'Import-file';
$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceFile'][1]        = 'File that contains the data to import.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['targetFile'][0]        = 'Example export file';
$GLOBALS['TL_LANG']['tl_convertx_converter']['targetFile'][1]        = 'File that shows the data format for the export. Will not be overwritten.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['targetDir'][0]         = 'Target directory';
$GLOBALS['TL_LANG']['tl_convertx_converter']['targetDir'][1]         = 'Directory in which the export file is written';

$GLOBALS['TL_LANG']['tl_convertx_converter']['fileName'][0]          = 'File name';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fileName'][1]          = 'Name of the export file. Insert tags are not supported.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceTable'][0]       = 'Source table';
$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceTable'][1]       = 'Table that contains the data to import.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['useTempSource'][0]     = 'Use temporary table version';
$GLOBALS['TL_LANG']['tl_convertx_converter']['useTempSource'][1]     = 'Instead of the original source you can use the temporary source table, which may be already modified.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldsSource'][0]      = 'Fields in the source';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldsSource'][1]      = 'Data field names available in the source.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['targetType'][0]        = 'Target';
$GLOBALS['TL_LANG']['tl_convertx_converter']['targerType'][1]        = 'Type of the used data target.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['targetTable'][0]       = 'Target table';
$GLOBALS['TL_LANG']['tl_convertx_converter']['targetTable'][1]       = 'Contao table to be imported into.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['keySource'][0]         = 'Key field in the source';
$GLOBALS['TL_LANG']['tl_convertx_converter']['keySource'][1]         = 'Attention! Only for the converter. This is not necessaryly the table key row.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['keyTarget'][0]         = 'Key field in the temporary target table';
$GLOBALS['TL_LANG']['tl_convertx_converter']['keyTarget'][1]         = 'Attention! Only for the converter. This is not necessaryly the table key row.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteOnStart'][0]     = 'Delete data before import';
$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteOnStart'][1]     = 'Records to be deleted before the import.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteOnRules'][0]     = 'Delete by given key-data';
$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteOnRules'][1]     = 'Delete matching records before import.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['allowInsert'][0]       = 'Add new records';
$GLOBALS['TL_LANG']['tl_convertx_converter']['allowInsert'][1]       = 'The records of the source will be added.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['allowUpdate'][0]       = 'Updates possible';
$GLOBALS['TL_LANG']['tl_convertx_converter']['allowUpdate'][1]       = 'The update rules of the field configuration are executed.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldsTarget'][0]      = 'Fields in the target';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldsTarget'][1]      = 'Those field names are contained in the target table.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteRules'][0]       = 'Deletion rules';
$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteRules'][1]       = 'Records matching the rules are deleted before import.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_type'][0]        = 'Type';
$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_type'][1]        = '';

$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_field'][0]       = 'Field';
$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_field'][1]       = '';

$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_operator'][0]    = 'Statement';
$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_operator'][1]    = '';

$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_value'][0]       = 'Value';
$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_value'][1]       = '';


// subfields
$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_name']      = 'Field name';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_default']   = 'Standard value';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_type']      = 'Type';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_length']    = 'Length';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_null']      = 'Null';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_unique']    = 'Key';


// references
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['isKey']      = 'unique';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['all']        = 'all records';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['missing']    = 'all records that are no longer present in the data source';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['existent']   = 'all records of the data source that are already present';

$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['and']        = 'AND';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['or']         = 'OR';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['eq']         = 'is =';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['gteq']       = 'is >=';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['gt']         = 'is >';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['lt']         = 'is <';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['lteq']       = 'is <=';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['begins']     = 'begins with';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['ends']       = 'ends with';
