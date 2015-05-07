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

namespace Delahaye\ConvertX\Interfaces;

/**
 * Interface Iontainer
 *
 * Methods mandatory in file containers
 *
 * @package Delahaye\ConvertX\Interfaces
 */
Interface Container
{

    /**
     * Get field info
     *
     * @param $objDef
     * @param $strType
     * @return mixed
     */
    public static function getFieldList($objDef, $strType);


    /**
     * Check if target field list has to be truncated
     *
     * @param $dc
     * @param $objData
     * @return mixed
     */
    public static function checkTargetClear($dc, $objData);


    /**
     * Finalize the table or export a file
     *
     * @param $strTarget
     * @param $objRun
     * @return mixed
     */
    public static function finalize($strTarget, $objRun);


    /**
     * Does th raw import
     *
     * @param $intConverter
     * @param $objRun
     * @return mixed
     */
    public static function rawImport($intConverter, $objRun);

}
