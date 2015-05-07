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

use \Date;

/**
 * Class Datestring
 *
 * Convert data method: date string to timestamp
 *
 * @package Delahaye\ConvertX\Conversion\Library
 */
class Datestring
{

    /**
     * @var
     */
    public static $strResult = '';


    /**
     * Date string to timestamp
     *
     * @param $arrParam
     * @return mixed
     */
    public function __construct($arrParam)
    {
        $strMode            = $arrParam[0];
        $objConverterfields = $arrParam[1];
        $objSource          = $arrParam[2];

        if ($objConverterfields->$strFormatField) {
            $strField = 'field' . $strMode;
            $strFieldname = $objConverterfields->$strField;

            $strFormatField = 'dateFormat' . $strMode;

            if ($objSource->$strFieldname != '' || $objSource->$strFieldname > 0) {
                $return = '';

                preg_match('/' . Date::getRegexp($objConverterfields->$strFormatField) . '/', $objSource->$strFieldname, $tmpDate);

                if (count($tmpDate) > 0) {
                    $objDate = new Date($objSource->$strFieldname, $objConverterfields->$strFormatField);

                    $return = $objDate->tstamp;
                }

                static::$strResult = $return;
            }
        }
    }

}
