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
 * Class SplitPart
 *
 * Convert data method: Take part of a string
 *
 * @package Delahaye\ConvertX\Conversion\Library
 */
class SplitPart
{

    /**
     * @var
     */
    public static $strResult;


    /**
     * Add new as part string
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

        $strSplitString = 'splitString' . $strMode;
        $intSplitPart = 'splitPart' . $strMode;
        $arrParts = explode(($objConverterfields->$strSplitString=='[nbsp]' ? ' ':$objConverterfields->$strSplitString), $objSource->$strFieldname);

        $intPart = $objConverterfields->$intSplitPart;

        if($intPart == 0){
            $intPart = count($arrParts)-1;
        } elseif($intPart < 0){
            $intPart = count($arrParts)-1+$intPart;
        } else {
            $intPart--;
        }

        $intPart = $intPart<0 ? 0:$intPart;

        static::$strResult = $arrParts[$intPart];
    }

}
