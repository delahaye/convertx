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
 * Interface Step
 *
 * Methods mandatory in import steps
 *
 * @package Delahaye\ConvertX\Interfaces
 */
Interface Step
{

    /**
     * Perform the step
     *
     * @param $objRun
     * @param $objStep
     *
     * @return mixed
     */
    public static function doStep($objRun, $objStep);

}
