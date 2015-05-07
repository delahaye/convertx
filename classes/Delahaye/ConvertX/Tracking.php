<?php

/**
 * ConvertX
 * Extension for Contao Open Source CMS (contao.org)
 *
 * Copyright (c) 2015 de la Haye
 *
 * @author  Christian de la Haye
 * @link    http://delahaye.de
 * @license Commercial - all rights reserved
 */

namespace Delahaye\ConvertX;

use Delahaye\ConvertX\Model\Log as LogModel;

/**
 * Class Tracking
 *
 * Logging of an import job run
 *
 * @package Delahaye\ConvertX
 */
class Tracking
{

    /**
     * Write a log entry
     *
     * @param $intPid
     * @param $intRootRun
     * @param string $strTitle
     * @param string $strType
     * @param string $strStatus
     * @param string $strDetails
     */
    public static function log($intPid, $intRootRun, $strTitle = 'CRON', $strType = 'step', $strStatus = 'ok', $strDetails = '')
    {
        $objLog = new LogModel();

        $objLog->setRow(array
            (
                'pid'     => $intPid,
                'tstamp'  => time(),
                'status'  => $strStatus,
                'type'    => $strType,
                'title'   => $strTitle . '-',
                'details' => $strDetails
            )
        );

        $objLog->save();

        // duplicate to the root run if joj is a sub-job
        if ($intPid != $intRootRun) {
            $objLogNew = clone $objLog;

            $objLogNew->setRow(array
                (
                    'pid'     => $intRootRun,
                    'tstamp'  => time(),
                    'status'  => $strStatus,
                    'type'    => $strType,
                    'title'   => $strTitle . '-',
                    'details' => $strDetails
                )
            );

            $objLogNew->save();
        }
    }


    /**
     * Show the log of a run
     *
     * @param $intId
     * @return string
     */
    public static function showLog($intId)
    {
        $objData = LogModel::findBy('pid', $intId, array('order' => 'id'));

        while ($objData->next()) {
            switch ($objData->type) {
                case 'entry':
                    $arrEntries[] = sprintf('<div class="%s">%s</div>', $objData->status, $objData->title);
                    break;
                default:
                    $arrEntries[] = sprintf('<h3 class="%s">%s</h3>', $objData->status, $objData->title);
                    break;
            }
        }

        return '<div class="convertx_log">' . implode('
', $arrEntries) . '</div>';
    }

}
