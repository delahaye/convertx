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

use \Database;

/**
 * Class Converterfield
 *
 * Reads and writes converter fields
 *
 * @package Delahaye\ConvertX\Model
 */
class Converterfield extends \Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_convertx_converterfield';


    /**
     * delete defined target fields
     *
     * @param $intConverter
     */
    public static function clearTargetFields($intConverter)
    {
        Database::getInstance()->prepare("DELETE from " . static::$strTable . " WHERE pid=?")->execute($intConverter);
    }


    /**
     * build a config for the target fields of the converter
     *
     * @param $intConverter
     */
    public static function createTargetFields($intConverter)
    {
        $objConverter = Converter::findByPk($intConverter);
        $objConverterfields = Converterfield::findBy('pid', $intConverter);

        // -----------------------------------------
        // check if we already have some field definitions, only add new

        if ($objConverterfields) {
            while ($objConverterfields->next()) {
                $arrFieldsSource = $arrFieldsSource ? $arrFieldsSource : unserialize($objConverter->fieldsSource);
                $arrFieldsTarget = $arrFieldsTarget ? $arrFieldsTarget : unserialize($objConverter->fieldsTarget);
                $BlnAllowInsert  = $BlnAllowInsert ? $BlnAllowInsert : $objConverter->allowInsert;
                $BlnAllowUpdate  = $BlnAllowUpdate ? $BlnAllowUpdate : $objConverter->allowUpdate;

                foreach ($arrFieldsTarget as $k => $v) {
                    if ($v['name'] == $objConverterfields->fieldname) {
                        unset($arrFieldsTarget[$k]);
                        $sorting[] = $objConverterfields->sorting;
                    }
                }
            }

            rsort($sorting);
            $sorting = $sorting[0];
        } else {
            $arrFieldsSource = unserialize($objConverter->fieldsSource);
            $arrFieldsTarget = unserialize($objConverter->fieldsTarget);
            $BlnAllowInsert  = $objConverter->allowInsert;
            $BlnAllowUpdate  = $objConverter->allowUpdate;
        }

        // source fields, collect fieldnames
        foreach ($arrFieldsSource as $fieldSource) {
            $arrFieldnamesSource[] = $fieldSource['name'];
        }

        // pre-define converterdefinitions for existing target fields, only 1:1
        foreach ($arrFieldsTarget as $fieldTarget) {
            $sorting = $sorting + 32;

            $arrNew = array
            (
                'pid'         => $intConverter,
                'sorting'     => $sorting,
                'tstamp'      => time(),
                'published'   => '',
                'fieldname'   => $fieldTarget['name'],
                'allowInsert' => $BlnAllowInsert ? $BlnAllowInsert : '',
                'typeInsert'  => 'Insertfromfield',
                'fieldInsert' => in_array($fieldTarget['name'], $arrFieldnamesSource) ? $fieldTarget['name'] : '',
                'modeInsert'  => 'Addnew',
                'allowUpdate' => $BlnAllowUpdate ? $BlnAllowUpdate : '',
                'typeUpdate'  => 'Updatefromfield',
                'fieldUpdate' => in_array($fieldTarget['name'], $arrFieldnamesSource) ? $fieldTarget['name'] : '',
                'modeUpdate'  => 'Replace'
            );

            $objNew = new Converterfield();
            $objNew->setRow($arrNew);
            $objNew->save();
        }
    }

}
