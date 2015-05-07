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

namespace Delahaye\ConvertX\Container;

use \Database;
use Delahaye\ConvertX\Interfaces\Container;
use Delahaye\ConvertX\Model\Job as JobModel;
use Delahaye\ConvertX\Model\Converter as ConverterModel;
use Delahaye\ConvertX\Model\Step as StepModel;
use Delahaye\ConvertX\Helper;
use Delahaye\ConvertX\Tracking;

/**
 * Class InternalTable
 *
 * Data container internal table analogue to file containers plus some methods
 *
 * @package Delahaye\ConvertX\Container
 */
class InternalTable extends \Controller implements Container
{

    /**
     * Get tables
     *
     * @return array
     */
    public static function getTables()
    {
        return Database::getInstance()->listTables();
    }


    /**
     * Get field info
     *
     * @param $objDef
     * @param $strType
     * @return array
     */
    public static function getFieldList($objDef, $strType)
    {
        // source or target
        $strTable = $strType . 'Table';

        // exit if no table defined
        if (!$objDef->$strTable) {
            return array();
        }

        // get fields
        $arrFields = Database::getInstance()->listFields($objDef->$strTable, true);

        // exit if no fields defined
        if (!is_array($arrFields)) {
            return array();
        }

        // pre-build return array
        $arrReturn = $arrFields;

        foreach ($arrReturn as $k => $v) {
            // indexes are no regular fields
            if ($v['type'] == 'index') {
                unset($arrReturn[$k]);
            } else {
                // show unique fields
                $arrReturn[$k]['unique'] = ($v['index'] == 'PRIMARY' ? 'isKey' : false);
                $arrReturn[$k]['null'] = str_replace(' ', '_', $v['null']);
            }
        }

        return $arrReturn;
    }


    /**
     * Check if target field list has to be truncated
     *
     * @param $dc
     * @param $objData
     * @return bool
     */
    public static function checkTargetClear($dc, $objData)
    {
        return $dc->activeRecord->targetTable != $objData->targetTable ? true : false;
    }


    /**
     * Replace the original table by the tmp one
     *
     * @param $strTable
     * @param $intDate
     * @param int $intKeepVersions
     * @param bool $blnSim
     * @return bool
     */
    public static function replaceByWorkingTable($strTable, $intDate, $intKeepVersions = 1, $blnSim = false)
    {
        $Database = Database::getInstance();

        if (!$Database->tableExists($strTable)) {
            return false;
        }

        // -----------------------------------------
        // do not finalize a simulation
        if ($blnSim) {
            $Database->prepare("DROP TABLE IF EXISTS " . $strTable)->execute();

            return true;
        }


        // -----------------------------------------
        // backup the existing data

        $strDate = date('Ymd_Hi_s', $intDate);

        // create a backup table and fill it from orginal
        $Database->prepare("DROP TABLE IF EXISTS " . $strTable . "_" . $strDate)->execute();
        $Database->prepare("CREATE TABLE IF NOT EXISTS " . $strTable . "_" . $strDate . " LIKE " . str_replace('cvx_', '', $strTable))->execute();
        $Database->prepare("INSERT INTO " . $strTable . "_" . $strDate . " SELECT * FROM " . str_replace('cvx_', '', $strTable))->execute();

        // get the backup tables and keep only the given number
        $arrTables = $Database->listTables();

        foreach ($arrTables as $k => $v) {
            if(!preg_match('/^'.$strTable.'_(\d{8})_(\d{4})_(\d{2})$/', $v, $tmp)){
                unset($arrTables[$k]);
            }
        }

        rsort($arrTables);

        foreach ($arrTables as $k => $v) {
            if ($k > ($intKeepVersions - 2)) {
                $Database->prepare("DROP TABLE IF EXISTS " . $v)->execute();
            }
        }


        // -----------------------------------------
        // drop original table

        $Database->prepare("DROP TABLE IF EXISTS " . str_replace('cvx_', '', $strTable))->execute();

        // replace by temporary table
        if ($Database->prepare("RENAME TABLE " . $strTable . " TO " . str_replace('cvx_', '', $strTable))->execute()) {
            return true;
        }

        return false;
    }


    /**
     * Finalize the table
     *
     * @param $strTarget
     * @param $objRun
     * @return bool
     */
    public static function finalize($strTarget, $objRun)
    {
        $objConverter = ConverterModel::findOneBy('targetTable', $strTarget);

        $objJob = JobModel::findByPk($objRun->pid);

        // maybe there are tables not bound on a converter
        if (!$objConverter) {
            // do not finalize on simulation
            if ($objRun->simulation) {
                // drop tmp table
                $Database = Database::getInstance();
                $Database->prepare("DROP TABLE IF EXISTS cvx_" . $strTarget)->execute();

                return true;
            }

            // -----------------------------------------
            // replace the original table

            return self::replaceByWorkingTable('cvx_' . $strTarget, $objRun->begin, $objJob->keepVersions, $objRun->simulation);
        }

        // do not finalize on simulation
        if ($objRun->simulation) {

            // drop tmp table
            $Database = Database::getInstance();
            $Database->prepare("DROP TABLE IF EXISTS cvx_" . $objConverter->targetTable)->execute();

            return true;
        }

        // -----------------------------------------
        // replace the original table

        return self::replaceByWorkingTable('cvx_' . $objConverter->targetTable, $objRun->begin, $objJob->keepVersions, $objRun->sim);
    }


    /**
     *  Build a tmp table
     *
     * @param $strTarget
     * @return bool
     */
    public static function buildTmpTargetTable($strTarget)
    {
        $Database = Database::getInstance();
        $blnOk = true;

        // drop temporary table if exists
        $Database->prepare("DROP TABLE IF EXISTS cvx_" . $strTarget)->execute();

        // create temporary table and fill it from the original
        if (!$Database->prepare("CREATE TABLE IF NOT EXISTS cvx_" . $strTarget . " LIKE " . $strTarget)->execute()) {
            $blnOk = false;
        }
        if (!$Database->prepare("INSERT INTO cvx_" . $strTarget . " SELECT * FROM " . $strTarget)->execute()) {
            $blnOk = false;
        }

        return $blnOk;
    }


    /**
     * Prepare the tmp table for updates, use the deletion rules for it
     *
     * @param $objRun
     * @return bool
     */
    public static function clearTable($objRun)
    {
        $Database = Database::getInstance();

        // perform the deletion rules defined in the converter for every internal target table
        foreach ($objRun->targets as $strTarget) {
            if (!in_array($strTarget, $objRun->cleared)) {
                $objConverter = false;
                foreach ($objRun->steps as $intStep) {
                    $objStep = StepModel::findByPk($intStep);

                    if ($objStep->action == 'converter' && !$objConverter) {
                        $objConverter = ConverterModel::findOneBy(array('id=?', 'targetTable=?'), array($objStep->converter, str_replace('cvx_', '', $strTarget)));
                    }
                }

                // there are tables not bound on a converter
                if (!$objConverter) {
                    return $strTarget;
                } else {
                    $objConverter->deleteRules = Helper::arrayOnly($objConverter->deleteRules);
                    $objConverter->fieldsTarget = Helper::arrayOnly($objConverter->fieldsTarget);
                    $objConverter->fieldsSource = Helper::arrayOnly($objConverter->fieldsSource);

                    // for updates we need all existent keys of the source and the target table
                    if ($objConverter->allowUpdate || ($objConverter->deleteOnStart != '' && $objConverter->deleteOnStart != 'all')) {
                        // source
                        $strSource = $objConverter->sourceType == 'InternalTable' ? $objConverter->sourceTable : 'cvx_' . $objConverter->id . '_source';

                        $objKeys = $Database->prepare("SELECT " . $objConverter->keySource . " FROM " . $strSource)->execute();

                        $arrSourceKeys = $objKeys->fetchEach($objConverter->keySource);

                        if ($objConverter->sourceHasFieldnames) {
// seems to be an artefact
//                            array_shift($arrSourceKeys);
                        }

                        // target
                        $objKeys = $Database->prepare("SELECT " . $objConverter->keyTarget . " FROM " . $strTarget)->execute();
                        $arrTargetKeys = $objKeys->fetchEach($objConverter->keyTarget);

                        $objConverter->targetKeys = serialize($arrTargetKeys);
                    }

                    $objConverter->save();

                    $blnOk = true;

                    // delete all data in target table
                    if ($objConverter->deleteOnStart == 'all') {
                        if (!$objDeletion = $Database->prepare("TRUNCATE TABLE " . $strTarget)->execute()) {
                            $blnOk = false;
                        }
                    } elseif ($objConverter->deleteOnStart == 'missing') {
                        // delete data missing in target, but existing in the source table
                        if (!$objDeletion = $Database->prepare("DELETE FROM " . $strTarget . " WHERE " . $objConverter->keyTarget . " IN ('" . implode("','", array_diff($arrTargetKeys, $arrSourceKeys)) . "')")->execute()) {
                            $blnOk = false;
                        }
                    } elseif ($objConverter->deleteOnStart == 'existent') {
                        // delete data already existing in target table
                        if (!$objDeletion = $Database->prepare("DELETE FROM " . $strTarget . " WHERE " . $objConverter->keyTarget . " IN ('" . implode("','", array_diff($arrTargetKeys, array_diff($arrTargetKeys, $arrSourceKeys))) . "')")->execute()) {
                            $blnOk = false;
                        }
                    }

                    // delete depending on rules
                    if ($objConverter->deleteOnRules) {
                        $strWhere = '';

                        foreach ($objConverter->deleteRules as $k => $v) {
                            $strWhere .= ($k > 0 ? ' ' . $v['type'] . ' ' : '') . $v['field'] . ' ';

                            switch ($v['operator']) {
                                case 'gteq':
                                    $strWhere .= '>= \'' . addslashes($v['value']) . '\'';
                                    break;
                                case 'gt':
                                    $strWhere .= '> \'' . addslashes($v['value']) . '\'';
                                    break;
                                case 'lt':
                                    $strWhere .= '< \'' . addslashes($v['value']) . '\'';
                                    break;
                                case 'lteq':
                                    $strWhere .= '<= \'' . addslashes($v['value']) . '\'';
                                    break;
                                case 'begins':
                                    $strWhere .= 'LIKE \'' . addslashes($v['value']) . '%\'';
                                    break;
                                case 'ends':
                                    $strWhere .= 'LIKE \'%' . addslashes($v['value']) . '\'';
                                    break;
                                default:
                                    $strWhere .= '= \'' . addslashes($v['value']) . '\'';
                                    break;
                            }
                        }

                        if (!$objDeletion = $Database->prepare("DELETE FROM " . $strTarget . " WHERE " . $strWhere)->execute()) {
                            $blnOk = false;
                        }
                    }

                    if ($blnOk) {
                        Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetCleared'], $strTarget), 'entry');

                        return $strTarget;
                    } else {
                        Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetNotCleared'], $strTarget), 'entry', 'error');

                        return false;
                    }
                }

                // fill exactly 1 of the temp source tables at a time
                continue;
            }
        }
    }


    /**
     * Does the raw import
     *
     * @param $intConverter
     * @param $objRun
     * @return mixed|void
     */
    public static function rawImport($intConverter, $objRun)
    {
        // not needed with internal tables
    }

}
