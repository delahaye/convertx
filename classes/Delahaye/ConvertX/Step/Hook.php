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

use \System;
use Delahaye\ConvertX\Interfaces\Step;

/**
 * Class Hook
 *
 * Import step: hook
 *
 * @package Delahaye\ConvertX\Step
 */
class Hook implements Step
{

    /**
     * Perform the step code
     *
     * @param $objRun
     * @param $objStep
     * @return mixed|object
     */
    public static function doStep($objRun, $objStep)
    {
        // dont perform the step on simulation
        if ($objRun->simulation && !$objStep->onSimulation) {
            return true;
        }

        $objReturn = System::importStatic($GLOBALS['TL_HOOKS']['convertx']['step'][$objStep->hook][0])->$GLOBALS['TL_HOOKS']['convertx']['step'][$objStep->hook][1]($objRun, $objStep);

        if (!$objReturn) {
            // fatal errors
            $objReturn = (object)null;
            $objReturn->error = $GLOBALS['TL_LANG']['tl_convertx_job']['hookFailed'];

            return $objReturn;
        }

        return $objReturn;
    }

}
