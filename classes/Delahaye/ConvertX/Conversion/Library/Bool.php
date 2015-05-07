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
 * Class Bool
 *
 * Convert data method: yes/no
 *
 * @package Delahaye\ConvertX\Conversion\Library
 */
class Bool
{

    /**
     * @var
     */
    public static $strResult = 0;


    /**
     * Decode yes/no
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

        $strOptions = 'no' . $strMode;
        $arrNo = array_map('strtolower', array_merge(array('','false',false), array_map('trim', explode(',', $objConverterfields->$strOptions))));

        if (in_array(strtolower($objSource->$strFieldname), $arrNo)) {
            static::$strResult = 0;
        } else {
            static::$strResult = 1;
        }

    }

}
