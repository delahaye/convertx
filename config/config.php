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
 * Version
 */
$GLOBALS['convertx']['version'] = '1.0';


/**
 * Available submenus
 */
$GLOBALS['convertx']['submenues'] = array(
    'insert' => array('Tags', 'Fill', 'Expand', 'Crop', 'Datestring', 'Gender', 'Country', 'Bool', 'SplitPart'),
    'update' => array('Tags', 'Fill', 'Expand', 'Crop', 'Datestring', 'Gender', 'Country', 'Bool', 'SplitPart')
);



/**
 * Add configs
 */
$GLOBALS['convertx']['maxExecutionTime']   = 20;
$GLOBALS['convertx']['allowIPs']           = array();


/**
 * Add back end modules
 */

array_insert($GLOBALS['BE_MOD']['system'], 1, array('convertx' => array
(
    'tables'  => array('tl_convertx_job', 'tl_convertx_step', 'tl_convertx_converter', 'tl_convertx_converterfield', 'tl_convertx_run', 'tl_convertx_log'),
    'icon'    => 'system/modules/convertx/assets/icon_convertx.gif',
    'runjob'  => array('Delahaye\ConvertX\Module\Run', 'compile'),
    'howto'   => array('Delahaye\ConvertX\Module\HowTo', 'compile'),
    'restore' => array('Delahaye\ConvertX\Module\Restore', 'compile')
)
));


/**
 * Register models
 */

$GLOBALS['TL_MODELS']['tl_convertx_job']            = 'Delahaye\\ConvertX\\Model\\Job';
$GLOBALS['TL_MODELS']['tl_convertx_step']           = 'Delahaye\\ConvertX\\Model\\Step';
$GLOBALS['TL_MODELS']['tl_convertx_run']            = 'Delahaye\\ConvertX\\Model\\Run';
$GLOBALS['TL_MODELS']['tl_convertx_log']            = 'Delahaye\\ConvertX\\Model\\Log';
$GLOBALS['TL_MODELS']['tl_convertx_converter']      = 'Delahaye\\ConvertX\\Model\\Converter';
$GLOBALS['TL_MODELS']['tl_convertx_converterfield'] = 'Delahaye\\ConvertX\\Model\\Converterfield';


/**
 * BE CSS
 */
$GLOBALS['TL_CSS'][] = 'system/modules/convertx/assets/be.css';


/**
 * Add permissions
 */
$GLOBALS['TL_PERMISSIONS'][] = 'cvx_jobs';
$GLOBALS['TL_PERMISSIONS'][] = 'cvx_jobp';

$GLOBALS['TL_PERMISSIONS'][] = 'cvx_converters';
$GLOBALS['TL_PERMISSIONS'][] = 'cvx_converterp';


/**
 * Possible charsets
 */
$GLOBALS['convertx']['char_sets'] = array(
    'big5'     => 'big5',
    'cp866'    => 'cp-866',
    'ujis'     => 'euc-jp',
    'euckr'    => 'euc-kr',
    'gb2312'   => 'gb2312',
    'latin1'   => 'iso-8859-1',
    'latin2'   => 'iso-8859-2',
    'greek'    => 'iso-8859-7',
    'hebrew'   => 'iso-8859-8',
    'hebrew~'  => 'iso-8859-8-i',
    'latin5'   => 'iso-8859-9',
    'latin7'   => 'iso-8859-13',
    'latin1~'  => 'iso-8859-15',
    'koi8r'    => 'koi8-r',
    'sjis'     => 'shift_jis',
    'utf8'     => 'utf-8',
    'utf16'    => 'utf-16',
    'cp1250'   => 'windows-1250',
    'cp1251'   => 'windows-1251',
    'latin1~~' => 'windows-1252',
    'cp1256'   => 'windows-1256',
    'cp1257'   => 'windows-1257',
);
