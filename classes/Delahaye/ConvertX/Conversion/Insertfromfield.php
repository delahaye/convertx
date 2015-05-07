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

use \Date;
use \System;
use Delahaye\ConvertX\Interfaces\Conversion;

/**
 * Class Insertfromfield
 *
 * Data conversion: insert data from imported field
 *
 * @package Delahaye\ConvertX\Conversion
 */
class Insertfromfield implements Conversion
{

    /**
     * Convert the data
     *
     * @param $objConverterfields
     * @param $objSource
     * @param bool $arrExistentData
     * @return mixed
     */
    public static function convertData($objConverterfields, $objSource, $strTarget, $arrExistentData = false)
    {
        $strMethod = ($GLOBALS['convertx']['classpath'][$objConverterfields->modeInsert] ? $GLOBALS['convertx']['classpath'][$objConverterfields->modeInsert] : 'Delahaye\\ConvertX\\Conversion\\Library') . '\\' . $objConverterfields->modeInsert;

        if(!class_exists($strMethod)) {
            return 'ConvertX-missingConverterclass ' . $objConverterfields->modeInsert;
        }

        $objData = new $strMethod(array('Insert', $objConverterfields, $objSource, $arrExistentData));

        return $objData::$strResult;
    }

}
