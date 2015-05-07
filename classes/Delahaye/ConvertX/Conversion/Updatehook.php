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

namespace Delahaye\ConvertX\Conversion;

use \System;
use Delahaye\ConvertX\Interfaces\Conversion;

/**
 * Class Updatehook
 *
 * Data conversion: insert data cominfg from a hook method
 *
 * @package Delahaye\ConvertX\Conversion
 */
class Updatehook implements Conversion
{

    /**
     * @var
     */
    public static $strResult;


    /**
     * Convert the data
     *
     * @param $objConverterfields
     * @param $objSource
     * @param bool $arrExistentData
     * @return object
     */
    public static function convertData($objConverterfields, $objSource, $strTarget, $arrExistentData = false)
    {
        $return = System::importStatic($GLOBALS['TL_HOOKS']['convertx']['field'][$objConverterfields->hookUpdate][0])->$GLOBALS['TL_HOOKS']['convertx']['field'][$objConverterfields->hookUpdate][1]($objConverterfields, $objSource, $arrExistentData);

        return $return;
    }

}
