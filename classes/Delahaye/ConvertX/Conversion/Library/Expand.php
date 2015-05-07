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
 * Class Expand
 *
 * Convert data method: expand field with value
 *
 * @package Delahaye\ConvertX\Conversion\Library
 */
class Expand
{

    /**
     * @var
     */
    public static $strResult;


    /**
     * Expand field with value
     *
     * @param $arrParam
     * @return mixed
     */
    public function __construct($arrParam)
    {
        $strMode            = $arrParam[0];
        $objConverterfields = $arrParam[1];
        $objSource          = $arrParam[2];
        $arrExistent        = $arrParam[3];

        $strField = 'field' . $strMode;
        $strFieldname = $objConverterfields->$strField;

        $strExpandSide = 'expandSide' . $strMode;
        $strExpandString = 'expandString' . $strMode;

        if($objConverterfields->expandKeep && $strMode == 'Update') {
            if ($objConverterfields->$strExpandSide == 'leftSide') {
                static::$strResult =  $arrExistent[0][$objConverterfields->fieldname] . $objConverterfields->$strExpandString . $objSource->$strFieldname;
            } elseif($objConverterfields->$strExpandSide == 'rightSide') {
                static::$strResult = $objSource->$strFieldname . $objConverterfields->$strExpandString . $arrExistent[0][$objConverterfields->fieldname];
            }
        } else {
            if ($objConverterfields->$strExpandSide == 'leftSide') {
                static::$strResult = $objConverterfields->$strExpandString . $objSource->$strFieldname;
            } elseif($objConverterfields->$strExpandSide == 'rightSide') {
                static::$strResult = $objSource->$strFieldname . $objConverterfields->$strExpandString;
            }
        }
    }

}
