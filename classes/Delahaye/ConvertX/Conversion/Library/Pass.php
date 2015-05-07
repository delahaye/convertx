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

use \Encryption;

/**
 * Class Pass
 *
 * Convert data method: Add new as password
 *
 * @package Delahaye\ConvertX\Conversion\Library
 */
class Pass
{

    /**
     * @var
     */
    public static $strResult;


    /**
     * Add new as password
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

        static::$strResult = Encryption::hash($objSource->$strFieldname);
    }

}
