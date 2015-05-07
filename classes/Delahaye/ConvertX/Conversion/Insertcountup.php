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
use Delahaye\ConvertX\Interfaces\Conversion;

/**
 * Class Insertcountup
 *
 * Data conversion: insert next value in a row
 *
 * @package Delahaye\ConvertX\Conversion
 */
class Insertcountup implements Conversion
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
        if((!$_SESSION['convertx']['countUp'][$objConverterfields->fieldname] || $_SESSION['convertx']['countUp'][$objConverterfields->fieldname] == 0) && $objConverterfields->initialValue == 'ownValue')  {
            $return = $objConverterfields->start;
        } elseif(!$_SESSION['convertx']['countUp'][$objConverterfields->fieldname] || $_SESSION['convertx']['countUp'][$objConverterfields->fieldname] == 0) {

            $objCount = Database::getInstance()->prepare("SELECT " . $objConverterfields->fieldname . " as convertx_value FROM " . $strTarget . " ORDER BY " . $objConverterfields->fieldname . " DESC")->limit(1)->execute();

            $return = ($objCount->converrtx_value + $objConverterfields->step);
        } else {
            $return = ($_SESSION['convertx']['countUp'][$objConverterfields->fieldname] + $objConverterfields->step);
        }

        $_SESSION['convertx']['countUp'][$objConverterfields->fieldname] = $return;

        return $return;
    }

}
