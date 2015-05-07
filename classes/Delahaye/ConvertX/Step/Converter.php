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

use \Database;
use \Database_Statement;
use Delahaye\ConvertX\Helper;
use Delahaye\ConvertX\Interfaces\Step;
use Delahaye\ConvertX\Tracking;
use Delahaye\ConvertX\Model\Converter as ConverterModel;
use Delahaye\ConvertX\Model\Converterfield as ConverterfieldModel;
use Delahaye\ConvertX\Conversion;

/**
 * Class Converter
 *
 * Import step: converter
 *
 * @package Delahaye\ConvertX\Step
 */
class Converter extends Database_Statement implements Step
{

    /**
     * Perform the step
     *
     * @param $objRun
     * @param $objStep
     * @return bool|mixed|object
     */
    public static function doStep($objRun, $objStep)
    {
        $objConverter = ConverterModel::findByPk($objStep->converter);

        $objConverter->fieldsTarget  = Helper::arrayOnly($objConverter->fieldsTarget);
        $objConverter->fieldsSource  = Helper::arrayOnly($objConverter->fieldsSource);
        $objConverter->targetKeys    = Helper::arrayOnly($objConverter->targetKeys);

        // -----------------------------------------
        // walk thru source data

        // source
        if ($objConverter->sourceType == 'InternalTable') {
            $strSource = $objConverter->useTempSource ? 'cvx_' . $objConverter->sourceTable : $objConverter->sourceTable;
        } else {
            $strSource = 'cvx_' . $objConverter->id . '_source';
        }

        $objSource = Database::getInstance()->prepare("SELECT * FROM " . $strSource)->execute();

        $strKeySource = $objConverter->keySource;

        $intBegin = time();
        $intLine = 0;

        while ($objSource->next()) {
            $intLine++;

            // skip already processed lines
            if ($objRun->line > 0 && $intLine <= $objRun->line) {
                continue;
            }

            // perform an update if possible (allowed, key exists, target table not truncated)
            if ($objConverter->allowUpdate && in_array($objSource->$strKeySource, $objConverter->targetKeys) && $objConverter->deleteOnStart != 'all') {
                if ($strUpdated = self::insertOrUpdate('update', $objRun, $objConverter, $objSource)) {
                    $arrUpdated[] = $strUpdated;
                } else {
                    $hasErrors = true;

                    // abort step if 1 line fails
                    if ($objConverter->abortOnError) {
                        break;
                    }
                }
            } // insert new data
            elseif ($objConverter->allowInsert) {
//            elseif ($objConverter->allowInsert && (!$objConverter->allowUpdate || ($objConverter->allowUpdate && !in_array($objSource->$strKeySource, $objConverter->targetKeys)))) {

                if ($strInserted = self::insertOrUpdate('insert', $objRun, $objConverter, $objSource)) {
                    if ($strInserted != 'skip') {
                        $arrInserted[] = $strInserted;
                    }
                } else {
                    $hasErrors = true;

                    // abort step if 1 line fails
                    if ($objConverter->abortOnError) {
                        break;
                    }
                }
            }

            // check for performance of this step within the max execution time
            $intNow = time();

            if ($intNow > $intBegin + $GLOBALS['convertx']['maxExecutionTime']) {
                $reload = true;
                break;
            }

        }

        // -----------------------------------------
        // an error may not lead to a step abortion

        if ($hasErrors && $objConverter->abortOnError) {
            if ($objStep->abortOnError) {
                $objReturn = (object)null;
                $objReturn->title = $GLOBALS['TL_LANG']['tl_convertx_job']['abortion'];
                $objReturn->error = sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['abortionStep'], $objStep->title);

                return $objReturn;
            }
        }


        // -----------------------------------------
        // note the amount of manipulated data sets

        if (count($arrInserted) > 0) {
            Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['setsInserted'], count($arrInserted)), 'entry', 'ok', print_r($arrInserted, true));
        }

        if (count($arrUpdated) > 0) {
            Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['setsUpdated'], count($arrUpdated)), 'entry', 'ok', print_r($arrUpdated, true));
        }

        if ($reload) {
            $objReturn = (object)null;
            $objReturn->title = $GLOBALS['TL_LANG']['tl_convertx_job']['splitting'];
            $objReturn->line = $intLine;

            return $objReturn;
        }

        return true;
    }


    /**
     * insert or update the data set
     *
     * @param $strType
     * @param $objRun
     * @param $objConverter
     * @param $objSource
     * @return bool|mixed|null
     */
    protected static function insertOrUpdate($strType, $objRun, $objConverter, $objSource)
    {
        // target
        $strTarget = $objConverter->targetType == 'InternalTable' ? 'cvx_' . $objConverter->targetTable : 'cvx_' . $objConverter->id;

        $arrData = self::getData($strType, $objRun, $objConverter, $objSource, $strTarget);

        if(!is_array($arrData) && strpos($arrData, 'ConvertX-') !== false) {
            Tracking::log($objRun->id, $objRun->rootRun, $GLOBALS['TL_LANG']['tl_convertx_job']['insertError'] . str_replace('ConvertX-', ' ', $arrData), 'entry', 'error', print_r($arrData, true));
            return false;
        }

        $strKeySource = $objConverter->keySource;

        if (is_array($arrData)) {
            if (count($arrData) > 0 || $objRun->simulation) {
                // in simulation the database statement always works fine
                if ($objRun->simulation) {
                    return 'sim';
                }

                // skip withor error if empty set shall be inserted (maybe comes from csv-file)
                $allEmpty = true;

                foreach ($arrData as $k => $v) {
                    if ((is_numeric($v) && $v > 0) || (!is_numeric($v) && $v != '')) {
                        $allEmpty = false;
                    }

                    // prevent null
                    if(is_null($v)) {
                        $arrData[$k] = '';
                    }
                }

                if ($allEmpty) {
                    Tracking::log($objRun->id, $objRun->rootRun, $GLOBALS['TL_LANG']['tl_convertx_job']['insertError'], 'entry', 'error', print_r($arrData, true));
                    return false;
                }

                switch ($strType) {
                    case 'update':
                        // perform the update and return the key of the row
                        if (Database::getInstance()->prepare("UPDATE " . $strTarget . " %s WHERE " . $objConverter->keyTarget . "=?")->set($arrData)->execute($objSource->$strKeySource)) {
                            return $objSource->$strKeySource;
                        }

                        // update failed
                        Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['updateError'], sprintf('%s=%s', $objConverter->keyTarget, $objSource->$strKeySource)), 'entry', 'error', print_r($arrData, true));
                        return false;

                        break;
                    default:
                        $objIns = Database::getInstance()->prepare("INSERT INTO " . $strTarget . " %s")->set($arrData)->execute();

                        // insert is ok
                        if ($objIns->insert_id()) {
                            return $objIns->insertId;
                        }

                        // insert failed
                        Tracking::log($objRun->id, $objRun->rootRun, $GLOBALS['TL_LANG']['tl_convertx_job']['insertError'], 'entry', 'error', print_r($arrData, true));
                        return false;

                        break;
                }
            }
        }

        return false;
    }


    /**
     * get the converted data
     *
     * @param $strType
     * @param $objRun
     * @param $objConverter
     * @param $objSource
     * @param $strTarget
     * @return array
     */
    protected static function getData($strType, $objRun, $objConverter, $objSource, $strTarget)
    {
        // in case of update the new data may be added to the old, so we need the existent data
        if ($strType == 'update') {
            $strKeySource = $objConverter->keySource;

            $objExistentData = Database::getInstance()->prepare("SELECT * FROM " . $strTarget . " WHERE " . $objConverter->keyTarget . "=?")->limit(1)->execute($objSource->$strKeySource);
            if ($objExistentData->numRows) {
                $arrExistentData = $objExistentData->fetchAllAssoc();
            }
        }

        $arrTargetData = array();

        // see which fields have to be converted. on update the others aren't touched, on inserts they're cleared (set to db default)
        $objConverterfields = ConverterfieldModel::findBy('pid', $objConverter->id, array('order' => 'sorting'));

        // no fields defined
        if (!$objConverterfields) {
            return $arrTargetData;
        }

        // set the id-field of an internal tmp table
        if ($objConverter->targetType == 'InternalTable') {
            $strIdField = 'id';
        } else {
            $strIdField = $objConverter->idField;
        }

        while ($objConverterfields->next()) {

            switch ($strType) {
                case 'update':
                    if (!$objConverterfields->published || !$objConverterfields->allowUpdate || $objConverterfields->fieldname == $strIdField) {
                        // field is not allowed to be updated - keep the data
                        // on update hands off the id field
                    } else {
                        // determine the class of the conversion
                        $strClass = ($GLOBALS['convertx']['classpath'][$objConverterfields->typeUpdate] ? $GLOBALS['convertx']['classpath'][$objConverterfields->typeUpdate] : 'Delahaye\\ConvertX\\Conversion') . '\\' . $objConverterfields->typeUpdate;

                        // build target data out of source and existent data for this line
                        $arrTargetData[$objConverterfields->fieldname] = $strClass::convertData($objConverterfields, $objSource, $strTarget, $arrExistentData);
                    }
                    break;
                default:
                    // is disabled or not allowed to be inserted
                    if (!$objConverterfields->published || !$objConverterfields->allowInsert) {
                        // just do nothing with this field
                    } else {

                        // fields maybe processed more than once in a step, so perform an update with temporary data instead
                        if($objConverterfields->allowUpdate && $objConverterfields->typeUpdate=='Updatefromfield' && $objConverterfields->modeUpdate == 'Tags' && $arrTargetData[$objConverterfields->fieldname]) {
                            // tags maybe added or removed

                            // determine the class of the conversion
                            $strClass = ($GLOBALS['convertx']['classpath'][$objConverterfields->typeUpdate] ? $GLOBALS['convertx']['classpath'][$objConverterfields->typeUpdate] : 'Delahaye\\ConvertX\\Conversion') . '\\' . $objConverterfields->typeUpdate;

                            // build target data out of source data for this line
                            $strData = $strClass::convertData($objConverterfields, $objSource, $strTarget, array($arrTargetData));
                        }elseif(!$objConverterfields->fieldInsert && !$objConverterfields->modeInsert) {
                            // field data is built of modified existing target data, field is processed twice or more (but not as tags)

                            $objConverterfields->fieldUpdate = 'ConvertXTmpField';
                            $objSource->ConvertXTmpField = $arrTargetData[$objConverterfields->fieldname];

                            // determine the class of the conversion
                            $strClass = ($GLOBALS['convertx']['classpath'][$objConverterfields->typeUpdate] ? $GLOBALS['convertx']['classpath'][$objConverterfields->typeUpdate] : 'Delahaye\\ConvertX\\Conversion') . '\\' . $objConverterfields->typeUpdate;

                            // build target data out of source data for this line
                            $strData = $strClass::convertData($objConverterfields, $objSource, $strTarget, array($arrTargetData));
                        } else {
                            // normal insert operation

                            // determine the class of the conversion
                            $strClass = ($GLOBALS['convertx']['classpath'][$objConverterfields->typeInsert] ? $GLOBALS['convertx']['classpath'][$objConverterfields->typeInsert] : 'Delahaye\\ConvertX\\Conversion') . '\\' . $objConverterfields->typeInsert;

                            // build target data out of source data for this line
                            $strData = $strClass::convertData($objConverterfields, $objSource, $strTarget);
                        }

                        // converter class is missing
                        if(strpos($strData, 'ConvertX-missingConverterclass') !== false) {
                            return $strData;
                        }

                        // if is id-field check if given id is already present -> set new one
                        if ($objConverterfields->fieldname == $strIdField) {
                            $tmp = Database::getInstance()->prepare("select id from ".$strTarget." where id=?")->execute($strData);

                            if($tmp->numRows > 0) {
                                $strData = '';
                            }
                        }

                        $arrTargetData[$objConverterfields->fieldname] = $strData;
                    }
                    break;
            }

        }

        return $arrTargetData;
    }

}
