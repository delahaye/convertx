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

namespace Delahaye\ConvertX\Model;

/**
 * Class Job
 *
 * Reads and writes import jobs
 *
 * @package Delahaye\ConvertX\Model
 */
class Job extends \Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_convertx_job';

}
