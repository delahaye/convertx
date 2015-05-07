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

namespace Delahaye\ConvertX\Module;

use \BackendTemplate;
use \Database;
use \Input;
use \Date;

/**
 * Class Restore
 *
 * BE module restore
 *
 * @package Delahaye\ConvertX\Module
 */
class Restore extends \BackendModule
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'be_restore';


    /**
     * Generate module
     *
     * @return string
     */
    protected function compile()
    {
        $this->import('BackendUser', 'User');
        $this->loadLanguageFile('convertx');

        $this->Template = new BackendTemplate($this->strTemplate);

        $this->Template->href         = $this->getReferer(true);
        $this->Template->title        = specialchars($GLOBALS['TL_LANG']['MSC']['backBT']);
        $this->Template->action       = ampersand($this->Environment->request);
        $this->Template->button       = $GLOBALS['TL_LANG']['MSC']['backBT'];

        $this->Template->restoretitle = $GLOBALS['TL_LANG']['convertx']['restore_title'];
        $this->Template->description  = $GLOBALS['TL_LANG']['convertx']['restore_description'];
        $this->Template->submit       = $GLOBALS['TL_LANG']['convertx']['restore_submit'];
        $this->Template->nothing      = $GLOBALS['TL_LANG']['convertx']['restore_nothing'];
        $this->Template->tablename    = $GLOBALS['TL_LANG']['convertx']['restore_tablename'] . ' ';
        $this->Template->keepCurrent  = $GLOBALS['TL_LANG']['convertx']['restore_keep'];

        /**
         * Replace the tables
         */
        if (Input::post('FORM_SUBMIT') == 'tl_convertx_restore') {
            $messageOk        = '';
            $messageFail      = '';
            $messageFatal     = '';
            $messageFailTabs  = '';
            $messageFatalTabs = '';

            $arrTab = \Database::getInstance()->listTables();
            sort($arrTab);
            foreach ($arrTab as $k => $v) {
                if (strpos($v, 'cvx_') === 0) {
                    $arrTableInfo = static::tableInfo($v);
                    $strOriginal = $arrTableInfo[0];

                    // original table is to be restored from this version
                    if (Input::post($strOriginal) == $v) {
                        // rename original to backup version
                        $strBackup = 'cvx_' . $strOriginal . date('_Ymd_Hi_s', time());
                        if (Database::getInstance()->tableExists($strOriginal)) {
                            Database::getInstance()->execute("RENAME TABLE " . $strOriginal . " TO " . $strBackup);
                        }

                        // rename version to original
                        if (Database::getInstance()->execute("RENAME TABLE " . $v . " TO " . $strOriginal)) {
                            $strVersion = self::getBackupDate($arrTableInfo);

                            $messageOk .= ($messageOk ? '' : $GLOBALS['TL_LANG']['convertx']['restore_tables_ok'] . '<ul>') . '<li>´' . $strOriginal . '´: ' . $strVersion . '</li>';
                        } else {
                            // error
                            $messageFailTabs .= ($messageFail ? ', ' : '') . '´' . $strOriginal . '´';

                            //  restore original table
                            if (Database::getInstance()->tableExists($strBackup)) {
                                if (!Database::getInstance()->execute("RENAME TABLE " . $strBackup . " TO " . $strOriginal)) {
                                    // original lost - f**k
                                    $messageFatalTabs .= ($messageFatal ? ', ' : '') . '´' . $strOriginal . '´';
                                }
                            }
                        }
                    }
                }
            }
            $messageOk    .= ($messageOk ? '</ul>' : '');
            $messageFail  .= ($messageFailTabs ? sprintf($GLOBALS['TL_LANG']['convertx']['restore_tables_error'], $messageFailTabs) : '');
            $messageFatal .= ($messageFatalTabs ? sprintf($GLOBALS['TL_LANG']['convertx']['restore_tables_fatal'], $messageFatalTabs) : '');

            $_SESSION['tl_convertx']['messages'] = array
            (
                'ok'    => $messageOk,
                'fail'  => $messageFail,
                'fatal' => $messageFatal
            );

            $this->reload();
        }

        $this->Template->messageOk    = $_SESSION['tl_convertx']['messages']['ok'];
        $this->Template->messageFail  = $_SESSION['tl_convertx']['messages']['fail'];
        $this->Template->messageFatal = $_SESSION['tl_convertx']['messages']['fatal'];

        $_SESSION['tl_convertx']['messages'] = false;

        // get the backup tables
        $arrTables = array();
        $strCurrent = '';

        $arrTab = Database::getInstance()->listTables();
        sort($arrTab);
        foreach ($arrTab as $k => $v) {
            if (strpos($v, 'cvx_') === 0) {
                $arrTableInfo = static::tableInfo($v);

                $strOriginal = $arrTableInfo[0];

                if ($strOriginal != $strCurrent) {
                    if ($strCurrent && is_array($arrTables[$strCurrent])) {
                        krsort($arrTables[$strCurrent]);
                    }
                    $arrTables[$strOriginal] = array();
                    $strCurrent = $strOriginal;
                }

                $arrTables[$strCurrent][$v] = self::getBackupDate($arrTableInfo);

                unset($arrTab[$k]);
            }
        }
        if ($strCurrent && is_array($arrTables[$strCurrent])) {
            krsort($arrTables[$strCurrent]);
        }

        $this->Template->tables = $arrTables;

        // parse template
        return $this->Template->parse();
    }

    /**
     * Gets original name and date of the backup table
     *
     * @param $strTable
     *
     * @return array
     */
    protected static function tableInfo($strTable)
    {
        $arrTable = preg_split('/[_][0-9]{8}/', preg_replace('/^cvx_/', '', $strTable));
        $arrTable[1] = str_replace('cvx_' . $arrTable[0] . '_', '', $strTable);

        return $arrTable;
    }


    /**
     * Get a backup date with seconds
     *
     * @param $arrTableInfo
     * @return array
     */
    protected static function getBackupDate($arrTableInfo)
    {
        $arrTmp = explode('_', $arrTableInfo[1]);
        $tmpDate = new Date($arrTmp[0] . $arrTmp[1] . $arrTmp[2], 'YmdHis');

        $return  = date((strpos($GLOBALS['TL_CONFIG']['datimFormat'], ':s') !== false ? $GLOBALS['TL_CONFIG']['datimFormat'] : $GLOBALS['TL_CONFIG']['datimFormat'] . ':s'), $tmpDate->tstamp);

        return $return;
    }

}
