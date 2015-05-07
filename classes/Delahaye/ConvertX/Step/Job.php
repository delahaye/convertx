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

use Delahaye\ConvertX\Interfaces\Step;

/**
 * Class Job
 *
 * Import step: sub-job
 *
 * @package Delahaye\ConvertX\Step
 */
class Job implements Step
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
        // only tell the system there is a subjob
        $objReturn = (object)null;
        $objReturn->subjob = $objStep->job;

        return $objReturn;
    }

}
