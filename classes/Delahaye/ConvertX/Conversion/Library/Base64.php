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
 * Class Base64
 *
 * Convert data method: decode from base64
 *
 * @package Delahaye\ConvertX\Conversion\Library
 */
class Base64
{

    /**
     * @var
     */
    public static $strResult;


    /**
     * Decode from base64
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

        static::$strResult = utf8_encode(base64_decode($objSource->$strFieldname));
    }

}
