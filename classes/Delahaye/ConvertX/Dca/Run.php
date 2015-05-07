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

use \Image;

/**
 * Class Run
 *
 * DCA callbacks for tl_convertx_run
 *
 * @package Delahaye\ConvertX\Dca
 */
class Run extends \Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }


    /**
     * List recorded runs
     *
     * @param $arrRow
     * @return string
     */
    public function listRuns($arrRow)
    {
        switch ($arrRow['status']) {
            case 'ok':
                $strColor = '#008000';
                break;
            case 'error':
                $strColor = '#ff8000';
                break;
            case 'abort':
                $strColor = '#f80000';
                break;
        }

        return '<div><span style="font-weight:bold;color:' . $strColor . ';">' . ($GLOBALS['TL_LANG']['tl_convertx_run'][$arrRow['status']] ? $GLOBALS['TL_LANG']['tl_convertx_run'][$arrRow['status']] : $arrRow['status']) . ($arrRow['simulation'] ? ' (' . $GLOBALS['TL_LANG']['tl_convertx_run']['simulation'] . ')' : '') . '</span>: ' . date($GLOBALS['TL_CONFIG']['datimFormat'], $arrRow['begin']) . '</div>' . "\n";
    }

}
