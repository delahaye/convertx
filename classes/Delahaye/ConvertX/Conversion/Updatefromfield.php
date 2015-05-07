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
use Delahaye\ConvertX\Interfaces\Conversion;

/**
 * Class Updatefromfield
 *
 * Data conversion: update data with imported field
 *
 * @package Delahaye\ConvertX\Conversion
 */
class Updatefromfield implements Conversion
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
        $strMethod = ($GLOBALS['convertx']['classpath'][$objConverterfields->modeUpdate] ? $GLOBALS['convertx']['classpath'][$objConverterfields->modeUpdate] : 'Delahaye\\ConvertX\\Conversion\\Library') . '\\' . $objConverterfields->modeUpdate;

        if(!class_exists($strMethod)) {
            return 'ConvertX-missingConverterclass ' . $objConverterfields->modeUpdate;
        }

        $objData = new $strMethod(array('Update', $objConverterfields, $objSource, $arrExistentData));

        return $objData::$strResult;
    }
}
