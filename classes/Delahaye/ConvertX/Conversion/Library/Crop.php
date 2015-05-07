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

namespace Delahaye\ConvertX\Conversion\Library;

/**
 * Class Crop
 *
 * Convert data method: crop field
 *
 * @package Delahaye\ConvertX\Conversion\Library
 */
class Crop
{

    /**
     * @var
     */
    public static $strResult;


    /**
     * Crop a field
     *
     * @param $arrParam
     * @return mixed
     */
    public function __construct($arrParam)
    {
        $strMode            = $arrParam[0];
        $objConverterfields = $arrParam[1];
        $objSource          = $arrParam[2];

        $strField = 'field' . $strMode;
        $strFieldname = $objConverterfields->$strField;

        $strExpandSide = 'expandSide' . $strMode;
        $strFieldLength = 'fieldLength' . $strMode;

        if ($objConverterfields->$strExpandSide == 'leftSide') {
            static::$strResult = substr($objSource->$strFieldname, 0, $objConverterfields->$strFieldLength);
        } elseif($objConverterfields->$strExpandSide == 'rightSide') {
            static::$strResult = substr($objSource->$strFieldname, (-1 * $objConverterfields->$strFieldLength));
        }
    }

}
