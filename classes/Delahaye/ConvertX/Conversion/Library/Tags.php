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

namespace Delahaye\ConvertX\Conversion\Library;

/**
 * Class Tags
 *
 * Convert data method: handle tags and serialized data
 *
 * @package Delahaye\ConvertX\Conversion\Library
 */
class Tags
{

    /**
     * @var
     */
    public static $strResult;


    /**
     * Handle tags and serialized data
     *
     * @param $arrParam
     * @return mixed
     */
    public function __construct($arrParam)
    {
        $strMode            = $arrParam[0];
        $objConverterfields = $arrParam[1];
        $objSource          = $arrParam[2];
        $arrExistent        = $arrParam[3];

        $strField = 'field' . $strMode;
        $strFieldname = $objConverterfields->$strField;

        if($strMode == 'Update') {
            if($objConverterfields->tagTypeSourceUpdate == 'delimited' && $objConverterfields->sourceDelimiterUpdate) {
                $arrSourceTags = explode($objConverterfields->sourceDelimiterUpdate, $objSource->$strFieldname);
            } else {
                $arrSourceTags = unserialize($objSource->$strFieldname);
            }

            if($objConverterfields->tagMode != 'Replace') {
                if($objConverterfields->tagTypeTargetUpdate == 'delimited' && $objConverterfields->targetDelimiterUpdate) {
                    $arrTargetTags = array_map('trim', explode($objConverterfields->targetDelimiterUpdate, $arrExistent[0][$objConverterfields->fieldname]));
                } else {
                    $arrTargetTags = unserialize($arrExistent[0][$objConverterfields->fieldname]);
                }
            }

            $arrSourceTags = is_array($arrSourceTags) ? $arrSourceTags : array();
            $arrTargetTags = is_array($arrTargetTags) ? $arrTargetTags : array();

            switch($objConverterfields->tagMode) {
                case 'Replace':
                    $arrNewTags = $arrSourceTags;
                    break;

                case 'Add':
                    $arrNewTags = array_unique(array_merge($arrTargetTags, $arrSourceTags));
                    break;

                case 'Delete':
                    $arrNewTags = array_diff($arrTargetTags, $arrSourceTags);
                    break;

                case 'DeleteExistent':
                    $arrNewTags = array_unique(array_intersect($arrTargetTags, $arrSourceTags));
                    break;

                case 'DeleteAdd':
                    $arrNewTags = array_unique(array_merge(array_intersect($arrTargetTags, $arrSourceTags), $arrSourceTags));
                    break;
            }

            if($objConverterfields->tagTypeTargetUpdate == 'delimited' && $objConverterfields->targetDelimiterUpdate) {
                static::$strResult = is_array($arrNewTags) ? implode($objConverterfields->targetDelimiterUpdate, $arrNewTags) : '';
            } else {
                static::$strResult = is_array($arrNewTags) ? serialize($arrNewTags) : '';
            }
        } else {
            if($objConverterfields->tagTypeSourceInsert == 'delimited' && $objConverterfields->sourceDelimiterInsert) {
                $arrNewTags = explode($objConverterfields->sourceDelimiterInsert, $objSource->$strFieldname);
            } else {
                $arrNewTags = unserialize($objSource->$strFieldname);
            }

            if($objConverterfields->tagTypeTargetInsert == 'delimited' && $objConverterfields->targetDelimiterInsert) {
                static::$strResult = is_array($arrNewTags) ? implode($objConverterfields->targetDelimiterInsert, $arrNewTags) : '';
            } else {
                static::$strResult = is_array($arrNewTags) ? serialize($arrNewTags) : '';
            }
        }
    }

}
