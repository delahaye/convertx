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

use \System;

/**
 * Class Country
 *
 * Convert data method: countrykey from name or key
 *
 * @package Delahaye\ConvertX\Conversion\Library
 */
class Country
{

    /**
     * @var
     */
    public static $strResult;


    /**
     * Countrykey from name or key
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

        $arrCountries = System::getCountries();

        foreach ($arrCountries as $k => $v) {
            if (strtolower($objSource->$strFieldname) == $k || strtolower($objSource->$strFieldname) == strtolower($v)) {
                static::$strResult = $k;
            }
        }
    }

}
