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

namespace Delahaye\ConvertX\Interfaces;

/**
 * Interface Conversion
 *
 * Methods mandatory in converters
 *
 * @package Delahaye\ConvertX\Interfaces
 */
Interface Conversion
{

    /**
     * Convert the data
     *
     * @param $objConverterfields
     * @param $objSource
     * @param bool $arrExistentData
     *
     * @return mixed
     */
    public static function convertData($objConverterfields, $objSource, $strTarget, $arrExistentData = false);

}
