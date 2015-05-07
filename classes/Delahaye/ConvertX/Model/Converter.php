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

/**
 * Class Converter
 *
 * Reads and writes converters
 *
 * @package Delahaye\ConvertX\Model
 */
class Converter extends \Model
{

    /**
     * Table name
     *
     * @var string
     */
    protected static $strTable = 'tl_convertx_converter';


    /**
     * Get the target field names of a converter
     *
     * @param $id
     * @return array
     */
    public static function getTargetFieldnames($id)
    {
        $arrReturn = array();

        foreach ((array) unserialize(self::findByPk($id)->fieldsTarget) as $arrField) {
            $arrReturn[] = $arrField['name'];
        }

        return $arrReturn;
    }


    /**
     * Get the source field names of a converter
     *
     * @param $id
     * @return array
     */
    public static function getSourceFieldnames($id)
    {
        $arrReturn = array();

        foreach ((array) unserialize(self::findByPk($id)->fieldsSource) as $arrField) {
            $arrReturn[] = $arrField['name'];
        }

        return $arrReturn;
    }

}
