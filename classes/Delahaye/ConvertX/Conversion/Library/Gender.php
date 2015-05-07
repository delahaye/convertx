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
 * Class Gender
 *
 * Convert data method: determine gender fom value
 *
 * @package Delahaye\ConvertX\Conversion\Library
 */
class Gender
{

    /**
     * @var
     */
    public static $strResult = '';


    /**
     * Determine gender fom value
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

        $strFemale = 'female' . $strMode;
        $strMale = 'male' . $strMode;

        $arrFemale = array_map('strtolower', array_map('trim', explode(',', $objConverterfields->$strFemale)));
        $arrMale = array_map('strtolower', array_map('trim', explode(',', $objConverterfields->$strMale)));

        if (in_array(strtolower($objSource->$strFieldname), $arrFemale)) {
            static::$strResult = 'female';
        } elseif (in_array(strtolower($objSource->$strFieldname), $arrMale)) {
            static::$strResult = 'male';
        } else {
            static::$strResult = '';
        }
    }

}
