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

namespace Delahaye\ConvertX\Conversion;

use Delahaye\ConvertX\Interfaces\Conversion;

/**
 * Class Updatefix
 *
 * Data conversion: update fix data
 *
 * @package Delahaye\ConvertX\Conversion
 */
class Updatefix implements Conversion
{

    /**
     * Convert the data
     *
     * @param $objConverterfields
     * @param $objSource
     * @param bool $arrExistentData
     * @return mixed
     */
    public static function convertData($objConverterfields, $objSource, $strTarget, $arrExistentData = false)
    {
        return $objConverterfields->fixUpdate;
    }

}
