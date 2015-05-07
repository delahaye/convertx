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
 * Class Fill
 *
 * Convert data method: fill field up
 *
 * @package Delahaye\ConvertX\Conversion\Library
 */
class Fill
{

    /**
     * @var
     */
    public static $strResult;


    /**
     * Fill field up
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
        $strFillChar = 'fillChar' . $strMode;

        if ($objConverterfields->$strExpandSide == 'leftSide') {
            static::$strResult = str_pad($objSource->$strFieldname, ($objConverterfields->$strFieldLength), $objConverterfields->$strFillChar, STR_PAD_LEFT);
        } elseif($objConverterfields->$strExpandSide == 'rightSide') {
            static::$strResult = str_pad($objSource->$strFieldname, ($objConverterfields->$strFieldLength), $objConverterfields->$strFillChar, STR_PAD_RIGHT);
        }
    }

}
