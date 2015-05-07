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

namespace Delahaye\ConvertX\Dca;

/**
 * Class Log
 *
 * DCA callbacks for tl_convertx_log
 *
 * @package Delahaye\ConvertX\Dca
 */
class Log extends \Backend
{

    /**
     * List the elements
     *
     * @param $arrRow
     * @return string
     */
    public function listElements($arrRow)
    {
        return '<div class="tl_convertx_' . $arrRow['status'] . '">' . $arrRow['title'] . ' ' . date($GLOBALS['TL_CONFIG']['dateFormat'], $arrRow['tstamp']) . ' ' . date('H:i:s', $arrRow['tstamp']) . '</div>' . "\n";
    }

}
