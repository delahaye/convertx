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
 * Class Replace
 *
 * Convert data method: replace 1:1, analog to AddNew
 *
 * @package Delahaye\ConvertX\Conversion\Library
 */
class Replace
{

    /**
     * @var
     */
    public static $strResult;


    /**
     * Replace 1:1
     *
     * @param $arrParam
     * @return mixed
     */
    public function __construct($arrParam)
    {
        $objData = new Addnew($arrParam);

        static::$strResult = $objData::$strResult;
    }

}
