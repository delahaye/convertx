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

namespace Delahaye\ConvertX\Step;

use \Database;
use \Exception;
use Delahaye\ConvertX\Interfaces\Step;

/**
 * Class Sql
 *
 * Import step: sql query
 *
 * @package Delahaye\ConvertX\Step
 */
class Sql implements Step
{

    /**
     * Perform the step code
     *
     * @param $objRun
     * @param $objStep
     * @param array $arrSet
     * @param bool $strArgs
     * @return bool|mixed|object
     */
    public static function doStep($objRun, $objStep, $arrSet = array(), $strArgs = false)
    {
        // dont perform the step on simulation
        if ($objRun->simulation && !$objStep->onSimulation) {
            return true;
        }


        try {
            $objSql = Database::getInstance()->prepare($objStep->sqlData)
                ->execute($strArgs);
        } catch (Exception $e) {
            // fatal errors
            $objReturn = (object)null;
            $objReturn->error = $GLOBALS['TL_LANG']['tl_convertx_job']['sqlFailed'];
            $objReturn->details = $objStep->sqlData;

            return $objReturn;
        }

        return true;
    }

}
