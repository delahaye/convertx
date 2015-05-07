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

use \System;
use \Input;
use \Database;
use \File;
use Delahaye\ConvertX\ExternalData;
use Delahaye\ConvertX\Container\InternalTable;
use Delahaye\ConvertX\Model\Job as JobModel;
use Delahaye\ConvertX\Model\Run as RunModel;
use Delahaye\ConvertX\Model\Step as StepModel;
use Delahaye\ConvertX\Tracking;

/**
 * Class Run
 *
 * Execute an import job
 *
 * @package Delahaye\ConvertX
 */
class Run
{
    /**
     * Load language file for jobs
     */
    public function __construct()
    {
        System::loadLanguageFile('tl_convertx_job');
    }


    /**
     * Perform a run
     *
     * @param $intRun
     * @param $intUser
     * @return array
     */
    public function doRun($intRun, $intUser)
    {
        // -----------------------------------------
        // find or start new run

        $objRun = self::findRun($intRun, $intUser);

        // error initializing the job run
        if ($objRun->error) {
            return self::abort($objRun, array($objRun->title, $objRun->error));
        }

        // init is done, fill it
        if (Input::get('run') == 'init') {
            return self::nextStep($objRun);
        }


        // -----------------------------------------
        // run finalisation

        if (Input::get('final') && \Input::get('run') != 'init') {
            self::finalize($objRun);

            self::deleteLogs($objRun);

            return self::nextStep($objRun, true);
        }


        // -----------------------------------------
        // non-final steps

        if (!array_diff($objRun->sources, $objRun->filled) && !array_diff($objRun->targets, $objRun->cleared)) {
            $objStep = self::doStep($objRun);
        }


        // -----------------------------------------
        // error in the the step

        if ($objStep->error) {
            return self::abort($objRun, array($objStep->title, $objStep->error));
        } else {
            $objRun->line = $objStep->line;
            $objRun->jumpToJob = $objStep->subjob;
            $objRun->save();
        }

        // perform next step
        return self::nextStep($objRun);
    }


    /**
     * abort run on error
     *
     * @param $objRun
     * @param bool $error
     * @return array
     */
    protected function abort($objRun, $error = false)
    {
        $arrTemplatevars = array();

        if ($objRun && $objRun->steps) {
            $arrTemplatevars['content'] = Tracking::showLog($objRun->id);

            $objRun->closed = '1';
            $objRun->end = time();
            $objRun->log = $arrTemplatevars['content'];

            $objRun->save();
        }

        $arrTemplatevars['abort']    = true;
        $arrTemplatevars['running']  = false;
        $arrTemplatevars['complete'] = false;
        $arrTemplatevars['title']    = $error[0];
        $arrTemplatevars['error']    = $error[1] ? $error[1] : $GLOBALS['TL_LANG']['tl_convertx_job']['aborted'];
        $arrTemplatevars['submit']   = $GLOBALS['TL_LANG']['tl_convertx_job']['end'];

        if (!$arrTemplatevars['title']) {
            $objJob = JobModel::findByPk($objRun->pid);
            $arrTemplatevars['title'] = sprintf('Job ID %s: %s', $objJob->id, $objJob->title);
        }

        return $arrTemplatevars;
    }


    /**
     * Call next step of job
     *
     * @param $objRun
     * @param bool $complete
     * @return array
     */
    protected function nextStep($objRun, $complete = false)
    {
        $arrTemplatevars = array();

        $objJob = JobModel::findByPk($objRun->pid);

        // get the next step
        $arrTemplatevars['final'] = self::setNextStep($objRun);

        // prepare template
        $arrTemplatevars['title']      = sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['jobTitle'], $objJob->id, $objJob->title);
        $arrTemplatevars['content']    = Tracking::showLog($objRun->id);
        $arrTemplatevars['simulation'] = $objRun->simulation ? $GLOBALS['TL_LANG']['tl_convertx_job']['simulation'] : false;

        // job steps are finished, maybe there is a sub job
        switch ($complete) {
            case true:
                if ($objRun->jumpToRun) {
                    // divert to sub job
                    $arrTemplatevars['running']  = $GLOBALS['TL_LANG']['tl_convertx_job']['processing'];
                    $arrTemplatevars['complete'] = false;
                    $arrTemplatevars['submit']   = $GLOBALS['TL_LANG']['tl_convertx_job']['next'];
                    $arrTemplatevars['id']       = $objRun->jumpToRun;
                } else {
                    // finish
                    $arrTemplatevars['running']  = false;
                    $arrTemplatevars['complete'] = $GLOBALS['TL_LANG']['tl_convertx_job']['finished'];
                    $arrTemplatevars['submit']   = $GLOBALS['TL_LANG']['tl_convertx_job']['end'];
                }
                break;
            default:
                // call next step
                $arrTemplatevars['running']  = $GLOBALS['TL_LANG']['tl_convertx_job']['processing'];
                $arrTemplatevars['complete'] = false;
                $arrTemplatevars['submit']   = $GLOBALS['TL_LANG']['tl_convertx_job']['next'];

                if ($objRun->jumpToJob) {
                    // divert to a subjob
                    $arrTemplatevars['subjob']    = true;
                    $arrTemplatevars['id']        = $objRun->jumpToJob;
                    $arrTemplatevars['jumpToRun'] = $objRun->id;
                    $arrTemplatevars['rootRun'] = $objRun->rootRun;

                    $objRun->jumpToJob = '';
                    $objRun->save();
                } else {
                    $arrTemplatevars['id'] = $objRun->id;
                }
                break;
        }

        return $arrTemplatevars;
    }


    /**
     * Look for the id of the next step
     *
     * @param $objRun
     * @return bool
     */
    protected function setNextStep($objRun)
    {
        // if no subjob, look for next step
        if ($objRun->jumpToJob < 1) {
            // go to steps after doing the raw imports
            $blnNextStep = $this->handleTmpTables($objRun);

            // look for a next step or finalize on next call
            if ($blnNextStep) {
                $voidNextStep = self::findNextStep($objRun);

                if ($voidNextStep == 'final') {
                    $blnFinal = true;
                } elseif (is_numeric($voidNextStep)) {
                    $objRun->step = $voidNextStep;
                    $objRun->save();
                }
            }
        }

        return $blnFinal;
    }


    /**
     * Between initialisation and job steps the temp tables are prepared (deletions, raw data import)
     *
     * @param $objRun
     * @return bool
     */
    protected function handleTmpTables($objRun)
    {
        // -----------------------------------------
        // only internal tmp tables can be updated

        if (!is_array($objRun->cleared)) {
            $objRun->cleared = array();
        }

        foreach ($objRun->targets as $strTarget) {
            if (is_numeric(str_replace('cvx_', '', $strTarget)) && !in_array($strTarget, $objRun->cleared)) {
                $arrNew = $objRun->cleared;
                $arrNew[] = $strTarget;

                $objRun->cleared = $arrNew;
                $objRun->save();
            }
        }

        // -----------------------------------------
        // handle raw import and pre-import deletion

        if (array_diff($objRun->sources, $objRun->filled) || array_diff($objRun->targets, $objRun->cleared)) {
            $objJob = JobModel::findByPk($objRun->pid);

            // fill tmp tables with external data
            if (array_diff($objRun->sources, $objRun->filled)) {
                if (count($objRun->filled) == 0) {
                    Tracking::log($objRun->id, $objRun->rootRun, $GLOBALS['TL_LANG']['tl_convertx_job']['fillTemporaryTables']);
                }

                // fill exactly 1 of the temp source tables at a time and reload
                $objFill = ExternalData::fillTable($objRun);

                if (!$objFill) {
                    return self::abort($objRun, array(sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['jobTitle'], $objJob->id, $objJob->title), $GLOBALS['TL_LANG']['tl_convertx_job']['importError']));
                }

                $arrFilled = $objRun->filled;
                $arrFilled[] = 'cvx_' . $objFill . '_source';

                $objRun->filled = $arrFilled;
                $objRun->save();
            }

            // perform deletion routines on tmp target tables
            if (array_diff($objRun->targets, $objRun->cleared)) {
                if (count($objRun->cleared) == 0) {
                    Tracking::log($objRun->id, $objRun->rootRun, $GLOBALS['TL_LANG']['tl_convertx_job']['clearTemporaryTables']);
                }

                // clear exactly 1 of the temp target tables at a time and reload
                $objClear = InternalTable::clearTable($objRun);

                if (!$objClear) {
                    return self::abort($objRun, array(sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['jobTitle'], $objJob->id, $objJob->title), $GLOBALS['TL_LANG']['tl_convertx_job']['deletingError']));
                }

                $arrCleared = $objRun->cleared;
                $arrCleared[] = $objClear;

                $objRun->cleared = $arrCleared;
                $objRun->save();
            }

            if (!array_diff($objRun->sources, $objRun->filled) && !array_diff($objRun->targets, $objRun->cleared)) {
                // determine next step when all temp source tables are filled
                $blnNextStep = true;
            }
        } else {
            // determine next step when all temp source tables are filled
            $blnNextStep = true;
        }

        return $blnNextStep;
    }


    /**
     * Find the current run
     *
     * @param $strRun
     * @param int $intUser
     * @return RunModel|mixed|\Model|null|object
     */
    public static function findRun($strRun, $intUser = 0)
    {
        $arrParams = array
        (
            'job'        => Input::get('id'),
            'user'       => $intUser,
            'sim'        => Input::get('sim'),
            'jumpToRun'  => Input::get('jumpToRun'),
            'jumpToStep' => Input::get('jumpToStep'),
            'rootRun'    => Input::get('rootRun')
        );

        switch ($strRun) {
            case 'init':
                $objRun = self::createNewRun($arrParams);
                $objRun = self::initRun($objRun);
                break;
            default:
                $objRun = self::useRun($strRun);
                break;
        }

        return $objRun;
    }


    /**
     * Use an existent run
     *
     * @param $intRun
     * @return \Model|null|object
     */
    public static function useRun($intRun)
    {
        $objRun = RunModel::getRun($intRun);

        if (!$objRun->id) {
            $objRun = (object)null;
            $objRun->title = $GLOBALS['TL_LANG']['tl_convertx_job']['job'];
            $objRun->error = $GLOBALS['TL_LANG']['tl_convertx_job']['noJobData'];
        }

        return $objRun;
    }


    /**
     * Start a new run
     *
     * @param $arrParams
     * @return RunModel|mixed|object
     */
    public static function createNewRun($arrParams)
    {
        $objRun = new RunModel();
        $objRun = RunModel::createNewRun($objRun, $arrParams);

        if ($objRun->error) {
            $objRun = (object)null;
            $objRun->title = sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['jobTitle'], $arrParams['job'], '');
            $objRun->error = $GLOBALS['TL_LANG']['tl_convertx_job']['noParentData'];
        }

        return $objRun;
    }


    /**
     * Initialize the run
     *
     * @param $objRun
     * @return mixed
     */
    public static function initRun($objRun)
    {
        $strFile = 'system/modules/convertx/classes/Delahaye/ConvertX/Init.php';

        if(file_exists(TL_ROOT.'/'.$strFile)) {
            include('Init.php');
        } else {
            $objRun = (object)null;
            $objRun->title = $GLOBALS['TL_LANG']['tl_convertx_job']['titleNoInit'];
            $objRun->error = $GLOBALS['TL_LANG']['tl_convertx_job']['noInitfile'];
        }

        return $objRun;
    }


    /**
     * Find the next step
     *
     * @param $objRun
     * @return string
     */
    public static function findNextStep($objRun)
    {
        // check if step is interrupted and stay in the actual step
        if ($objRun->line > 0) {
            return false;
        }

        switch ($objRun->step) {
            // first step after init
            case 0:
                if (is_array($objRun->steps) && count($objRun->steps) > 0) {
                    // set next step performed in next call
                    return $objRun->steps[0];
                }
                break;
            default:
                // search for next step of job
                for ($i = 0; $i < count($objRun->steps); $i++) {
                    // actual step
                    if ($objRun->steps[$i] == $objRun->step) {
                        // there is a next step
                        if ($objRun->steps[$i + 1]) {
                            return $objRun->steps[$i + 1];
                            break;
                        } // finalize on next call
                        else {
                            return 'final';
                        }
                    }
                }
                break;
        }

        // finalize on next call
        return 'final';
    }


    /**
     * Finalize the run
     *
     * @param $objRun
     */
    public static function finalize($objRun)
    {
        // do not finalize the a child job run
        if ($objRun->id != $objRun->rootRun) {
            return;
        }

        Tracking::log($objRun->id, $objRun->rootRun, $GLOBALS['TL_LANG']['tl_convertx_job']['finalisation']);

        // -----------------------------------------
        // kill tmp sources

        foreach ($objRun->sources as $source) {
            $strSource = str_replace('_source', '', str_replace('cvx_', '', $source));

            // source is not an internal table
            if (is_numeric($strSource)) {
                // kill tmp source table
                if (ExternalData::deleteTmpTable($strSource, '_source')) {
                    Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['temporarySourceRemoved'], $strSource), 'entry');
                }
            }
        }

        // -----------------------------------------
        // replace target tables by working tables

        foreach ($objRun->targets as $target) {
            $strTarget = str_replace('cvx_', '', $target);

            // target is not an internal table
            if (is_numeric($strTarget)) {
                $strClass = ExternalData::getClass($strTarget, 'targetType');

                if ($strClass::finalize($strTarget, $objRun)) {
                    Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['targetFileCreated'], $strTarget), 'entry');

                    // kill tmp target table
                    if (ExternalData::deleteTmpTable($strTarget)) {
                        Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetRemoved'], $strTarget), 'entry');
                    }
                } else {
                    Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['targetFileNotCreated'], $strTarget), 'entry', 'error');

                    // kill tmp target table
                    if (ExternalData::deleteTmpTable($strTarget)) {
                        Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetRemoved'], $strTarget), 'entry');
                    }
                }
            } else {
                // finalize internal target table
                if (InternalTable::finalize($strTarget, $objRun)) {
                    Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['targetUpdated'], $strTarget), 'entry');
                } else {
                    Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['targetNotUpdated'], $strTarget), 'entry', 'error');
                }
            }
        }

        // close the run of the job
        $objRun->closed = '1';
        $objRun->end = time();

        // save the log summary
        $objRun->log = Tracking::showLog($objRun->id);

        // the run should be ok
        $objRun->status = 'ok';

        // well, it didnt fail, but there maybe errors that didn't lead to an abortion
        $objLog = Database::getInstance()->prepare("SELECT id FROM tl_convertx_log WHERE pid=? AND status=?")->execute($objRun->id, 'error');

        if ($objLog->numRows > 0) {
            $objRun->status = 'error';
        }

        // look if we have to do something external before finishing the run
        if (isset($GLOBALS['TL_HOOKS']['convertx']['final']) && is_array($GLOBALS['TL_HOOKS']['convertx']['final'])) {
            foreach ($GLOBALS['TL_HOOKS']['convertx']['final'] as $callback) {
                $objRun = System::importStatic($callback[0])->$callback[1]($objRun);
            }
        }

        $objRun->save();

        // fine, we're done :)
        return;
    }


    /**
     * Do a step
     *
     * @param $objRun
     * @return mixed
     */
    public static function doStep($objRun)
    {
        $objStep = StepModel::findByPk($objRun->step);

        // -----------------------------------------
        // use the class of the step

        $strClass = 'Delahaye\\ConvertX\\Step\\' . ucfirst($objStep->action);

        Tracking::log($objRun->id, $objRun->rootRun, sprintf('%s: %s', $GLOBALS['TL_LANG']['tl_convertx_job']['step_' . $objStep->action], $objStep->title));

        $objReturn = $strClass::doStep($objRun, $objStep);

        if ($objReturn->error) {
            Tracking::log($objRun->id, $objRun->rootRun, $objReturn->error, 'entry', 'error', $objReturn->details);

            if ($objStep->abortOnError) {
                $objReturn->title = $GLOBALS['TL_LANG']['tl_convertx_job']['abortion'];

                Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['abortionInStep'], $objStep->id, $objStep->action, $objStep->title), 'step', 'error');

                return $objReturn;
            }
        }

        return $objReturn;
    }


    /**
     * Delete older logs, keep defined versions
     *
     * @param $objRun
     */
    public static function deleteLogs($objRun)
    {
        // get job data
        $objJob = JobModel::findByPk($objRun->pid);

        $objRuns = RunModel::findBy('pid',$objRun->pid,array('order' => 'end DESC', 'offset' => $objJob->keepLogs));

        // delete older logs
        if($objRuns) {
            Database::getInstance()->prepare("DELETE FROM tl_convertx_run WHERE id IN (" . implode(',', $objRuns->fetchEach('id')) . ")")->execute();
            Database::getInstance()->prepare("DELETE FROM tl_convertx_log WHERE pid IN (" . implode(',', $objRuns->fetchEach('id')) . ")")->execute();
        }
    }

}
