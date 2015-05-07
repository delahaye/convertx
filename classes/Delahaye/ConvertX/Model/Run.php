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

use Delahaye\ConvertX\Helper;
use Delahaye\ConvertX\Job as ActualJob;

/**
 * Class Run
 *
 * Reads and writes run data
 *
 * @package Delahaye\ConvertX\Model
 */
class Run extends \Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_convertx_run';


    /**
     * Get an existing run
     *
     * @param $intRun
     * @return \Model|null
     */
    public static function getRun($intRun)
    {
        // only runs that are not closed
        $objRun = self::findOneBy(array('tl_convertx_run.id=?', 'tl_convertx_run.closed!=1'), $intRun);

        $objRun->steps   = Helper::arrayOnly($objRun->steps);
        $objRun->targets = Helper::arrayOnly($objRun->targets);
        $objRun->sources = Helper::arrayOnly($objRun->sources);
        $objRun->filled  = Helper::arrayOnly($objRun->filled);
        $objRun->cleared = Helper::arrayOnly($objRun->cleared);

        return $objRun;
    }


    /**
     * Create a new run
     *
     * @param $objRun
     * @param $arrParams
     * @return mixed
     */
    public static function createNewRun($objRun, $arrParams)
    {
        $objRun->setRow(array
            (
                'pid'        => $arrParams['job'],
                'tstamp'     => time(),
                'begin'      => time(),
                'user'       => $arrParams['user'] ? $arrParams['user'] : 0,
                'status'     => 'abort',
                'simulation' => $arrParams['sim'] ? '1' : ''
            )
        );

        $objRun->save();

        // find steps
        $objRun->steps = (array) ActualJob::findSteps($objRun->pid);

        // find target tables
        $objRun->targets = (array) ActualJob::findTargetTables($objRun->pid);

        $objRun->cleared = (array) $objRun->cleared;

        // find tmp source tables
        $objRun->sources = (array) ActualJob::findTmpSourceTables($objRun->pid);

        $objRun->filled = (array) $objRun->filled;

        // is child job
        if ($arrParams['jumpToRun'] && $arrParams['rootRun']) {
            // set jump back if child job
            $objRun->jumpToRun = $arrParams['jumpToRun'];

            // set root run id
            $objRun->rootRun = $arrParams['rootRun'];

            // add target and source table names to root run
            $objRootRun = self::findByPk($objRun->rootRun);

            if (!$objRootRun->id) {
                $objRun->error = true;
            }

            $objRootRun->targets = (array) $objRootRun->targets;
            $objRootRun->sources = (array) $objRootRun->sources;

            $objRootRun->targets = serialize(array_unique(array_merge($objRun->targets, $objRootRun->targets)));
            $objRootRun->sources = serialize(array_unique(array_merge($objRun->sources, $objRootRun->sources)));

            $objRootRun->save();

            if ($objRootRun->simulation) {
                $objRun->simulation = 1;
                $objRun->save();
            }
        } else {
            // is root run where target table names are stored
            $objRun->rootRun = $objRun->id;
        }

        $objRun->save();

        return $objRun;
    }

}
