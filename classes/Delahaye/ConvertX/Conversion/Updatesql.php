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

use \Database;
use \String;
use Delahaye\ConvertX\Interfaces\Conversion;

/**
 * Class Updatesql
 *
 * Data conversion: update data from sql query
 *
 * @package Delahaye\ConvertX\Conversion
 */
class Updatesql implements Conversion
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
        if(!$objConverterfields->sqlUpdate) {
            return '';
        }

        $objSql = Database::getInstance()->prepare(String::parseSimpleTokens($objConverterfields->sqlUpdate, $objSource->row()))->execute();

        return $objSql->convertx_value;
    }

}
