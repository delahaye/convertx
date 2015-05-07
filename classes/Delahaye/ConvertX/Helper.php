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

/**
 * Class Helper
 *
 * Helper methods for backend use
 *
 * @package Delahaye\ConvertX
 */
class Helper
{

    /**
     * Get registered hooks
     *
     * @param $strType
     * @return array
     */
    public static function getHooks($strType)
    {
        $arrHooks = array();

        if (is_array($GLOBALS['TL_HOOKS']['convertx'][$strType])) {
            foreach ($GLOBALS['TL_HOOKS']['convertx'][$strType] as $k => $v) {
                $arrHooks[$k] = $GLOBALS['TL_LANG']['convertx']['hook'][$strType][$k] ? $GLOBALS['TL_LANG']['convertx']['hook'][$strType][$k] : $k;
            }
        }

        return $arrHooks;
    }


    /**
     * Sometimes a need an array, even empty
     *
     * @param $voidData
     * @return array|mixed
     */
    public static function arrayOnly($voidData)
    {
        if (!$voidData) {
            return array();
        }

        $arrData = is_array($voidData) ? $voidData : unserialize($voidData);
        $arrData = is_array($arrData) ? $arrData : array();

        return $arrData;
    }


    /**
     * Get charset
     *
     * @param $strTxt
     * @return int|string
     */
    public static function getEncoding($strTxt)
    {
        $enc = mb_detect_encoding($strTxt, mb_list_encodings(), true);

        if($enc == 'UTF-8') {
            return 'utf8';
        }

        $tmp = array();
        foreach ($GLOBALS['convertx']['char_sets'] as $key => $val) {
            $tmp[] = strtoupper($val);
        }

        foreach ($GLOBALS['convertx']['char_sets'] as $key => $val) {

            if(md5(iconv($val, $val, $strTxt)) == md5($strTxt)) {
                return $key;
            }

        }

        return 'utf8';
    }


    /**
     * Determine line feed
     *
     * @param $strTxt
     * @return string
     */
    public static function getLineFeed($strTxt)
    {
        if (strpos($strTxt, "\r\n") !== false) {
            return '\r\n';
        } elseif (strpos($strTxt, "\r") !== false) {
            return '\r';
        }

        return '\n';
    }

}
