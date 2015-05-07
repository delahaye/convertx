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

use Delahaye\ConvertX\Helper;
use Delahaye\ConvertX\Model\Converter as ConverterModel;
use Delahaye\ConvertX\Model\Job as JobModel;
use Delahaye\ConvertX\Model\Step as StepModel;

/**
 * Class Job
 *
 * Import job
 *
 * @package Delahaye\ConvertX
 */
class Job
{

    /**
     * Find a job
     *
     * @param $intJob
     * @return \Model|null|object
     */
    public static function findJob($intJob)
    {
        // get job data
        $objJob = JobModel::findByPk($intJob);
        if ($objJob) {
            return $objJob;
        }

        // abort if no job data
        $objJob = (object)null;
        $objJob->title = sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['jobId'], $intJob);
        $objJob->error = $GLOBALS['TL_LANG']['tl_convertx_job']['noJob'];

        return $objJob;
    }


    /**
     * Get the steps of a job
     *
     * @param $intPid
     * @return array
     */
    public static function findSteps($intPid)
    {
        $objSteps = StepModel::findBy(array('tl_convertx_step.pid=?', 'tl_convertx_step.published=?'), array($intPid, 1), array('order' => 'sorting'));

        if (!$objSteps) {
            return array();
        }

        while ($objSteps->next()) {
            $arrSteps[] = $objSteps->id;
        }

        return $arrSteps;
    }


    /**
     * Find the internal and external target tables (tmp versions)
     *
     * @param $intPid
     * @return array
     */
    public static function findTargetTables($intPid)
    {
        $objJob = JobModel::findByPk($intPid);

        $arrTargets = Helper::arrayOnly($objJob->targetTables);

        $objSteps = StepModel::findBy(array('tl_convertx_step.pid=?', 'tl_convertx_step.published=?', 'tl_convertx_step.action=?'), array($intPid, 1, 'converter'));

        if (!$objSteps) {
            return $arrTargets;
        }

        while ($objSteps->next()) {
            $objConverter = ConverterModel::findByPk($objSteps->converter);

            switch ($objConverter->targetType) {
                case 'InternalTable':
                    // table names for internal data
                    $arrTargets[] = 'cvx_' . $objConverter->targetTable;
                    break;
                default:
                    // tmp tables for external data get a name based on the converter id
                    $arrTargets[] = 'cvx_' . $objConverter->id;
                    break;
            }
        }

        return array_unique($arrTargets);
    }


    /**
     * Find the internal and external source tables (tmp versions)
     *
     * @param $intPid
     * @return array
     */
    public static function findTmpSourceTables($intPid)
    {
        $objSteps = StepModel::findBy(array('tl_convertx_step.pid=?', 'tl_convertx_step.published=?', 'tl_convertx_step.action=?'), array($intPid, 1, 'converter'));

        if (!$objSteps) {
            return array();
        }

        while ($objSteps->next()) {
            $objConverter = ConverterModel::findByPk($objSteps->converter);

            switch ($objConverter->sourceType) {
                case 'InternalTable':
                    // for internal sources we don't need tmp tables
                    break;
                default:
                    // tmp tables for external data get a name based on the converter id
                    $arrSources[] = 'cvx_' . $objConverter->id . '_source';
                    break;
            }
        }

        return (array) $arrSources;
    }

}