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

use \Database;
use Delahaye\ConvertX\Tracking;
use Delahaye\ConvertX\Model\Converter as ConverterModel;

/**
 * Class ExternalData
 *
 * Methods to handle external data
 *
 * @package Delahaye\ConvertX
 */
class ExternalData
{

    /**
     * Build a tmp table
     *
     * @param $intTable
     * @param $strType
     * @return bool
     */
    public static function buildTmpTable($intTable, $strType)
    {
        $objConverter = ConverterModel::findByPk($intTable);
        $arrFields = unserialize($objConverter->$strType);

        // currently all import fields are blobs because of the transformations
        foreach ($arrFields as $k => $v) {
            $arrCols[] = $v['name'] . ' ' . $v['type'] . ' NOT NULL default \'\'';
        }

        if (Database::getInstance()->prepare("CREATE TABLE IF NOT EXISTS cvx_" . $intTable . ($strType == 'fieldsSource' ? '_source' : '') . " (" . implode(', ', $arrCols) . ") ENGINE=MyISAM DEFAULT CHARSET=utf8;")->execute()) {
            // tmp source tables shall always be empty
            if ($strType == 'fieldsSource') {
                Database::getInstance()->prepare("TRUNCATE TABLE cvx_" . $intTable . "_source")->execute();
            }

            return true;
        }

        return false;
    }


    /**
     * Get the class of the data converter
     *
     * @param $intTable
     * @param $strType
     * @return string
     */
    public static function getClass($intTable, $strType)
    {
        $objConverter = ConverterModel::findByPk($intTable);

        return ($GLOBALS['convertx']['classpath'][$objConverter->$strType] ? $GLOBALS['convertx']['classpath'][$objConverter->$strType] : 'Delahaye\\ConvertX\\Container') . $objConverter->$strType;
    }


    /**
     * Remove the tmp table
     *
     * @param $intTable
     * @param string $strType
     * @return Database\Result
     */
    public static function deleteTmpTable($intTable, $strType = '')
    {
        return Database::getInstance()->prepare("DROP TABLE IF EXISTS cvx_" . $intTable . $strType)->execute();
    }


    /**
     * Fill the tmp table in the way specified in the dada converter
     *
     * @param $objRun
     * @return bool|mixed
     */
    public static function fillTable($objRun)
    {
        foreach ($objRun->sources as $strSource) {
            if (!in_array($strSource, $objRun->filled)) {
                $intConverter = str_replace('_source', '', str_replace('cvx_', '', $strSource));

                $objConverter = ConverterModel::findByPk($intConverter);

                // get the glass of the converter
                $strClass = ($GLOBALS['convertx']['classpath'][$objConverter->sourceType] ? $GLOBALS['convertx']['classpath'][$objConverter->sourceType] : 'Delahaye\\ConvertX\\Container') . '\\' . $objConverter->sourceType;

                // fill temp table
                if ($strClass::rawImport($intConverter, $objRun)) {
                    Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['temporarySourceFilled'], $intConverter), 'entry');

                    return $intConverter;
                } else {
                    Tracking::log($objRun->id, $objRun->rootRun, sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['temporarySourceNotFilled'], $intConverter), 'entry', 'error');

                    return false;
                }

                // fill exactly 1 of the temp source tables at a time
                continue;
            }
        }
    }

}
