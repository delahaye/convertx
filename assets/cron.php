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

use Delahaye\ConvertX\Run;
use Delahaye\ConvertX\Model\Job as JobModel;

/**
 * Initialize the system
 */
define('TL_MODE', 'FE');
require str_replace('modules/convertx/assets/cron.php', 'initialize.php', $_SERVER['SCRIPT_FILENAME']);

/**
 * Class ConvertXCron
 */
class ConvertXCron extends Frontend
{
    /**
     * Initialize the object (do not remove)
     */
    public function __construct()
    {
        parent::__construct();

        // See #4099
        define('BE_USER_LOGGED_IN', false);
        define('FE_USER_LOGGED_IN', false);
    }

    /**
     * Run the controller
     */
    public function run()
    {
        $tmp = explode('?', Environment::get('request'));
        $strAction = ampersand($tmp[0]);
        $objStatus = (object)null;

        System::loadLanguageFile('tl_convertx_job');

        // only run with token and maybe restricted to certain IPs
        $ipOk = (count($GLOBALS['convertx']['allowIPs']) ==  0 || (count($GLOBALS['convertx']['allowIPs']) >  0 && in_array(Environment::get('ip'), $GLOBALS['convertx']['allowIPs']))) ? true : false;

        if (!$ipOk || (!Input::get('token') && !Input::get('REQUEST_TOKEN'))) {
            die($GLOBALS['TL_LANG']['tl_convertx_job']['no_cron_access']);
        }


        // get the job
        if (Input::get('token')) {
            $objJob = JobModel::findOneBy('token', Input::get('token'));

            if (!$objJob) {
                die($GLOBALS['TL_LANG']['tl_convertx_job']['cron_failed']);
            }

            // start a run
            $this->redirect($strAction . '?run=init&id=' . $objJob->id . '&REQUEST_TOKEN=' . REQUEST_TOKEN);
        }


        // we need a run
        if (!Input::get('run')) {
            die($GLOBALS['TL_LANG']['tl_convertx_job']['cron_failed']);
        }


        // do the convertx run
        $objRun = new Run();
        $arrRun = $objRun->doRun(Input::get('run'), 0);

        foreach ($arrRun as $k => $v) {
            $objStatus->$k = $v;
        }


        // success
        if ($objStatus->complete) {
            echo '<!DOCTYPE html>
                <head>
                <meta charset="utf-8">
                <title>CONVERTX CRON</title>
                </head>
                <body>
                <h1>' . $GLOBALS['TL_LANG']['tl_convertx_job']['cron_success'] . '</h1>
                ' . $objStatus->content . '
                </body>
                </html>';

            die();
        }

        // next step
        $strAction .= '?key=runjob&run=' . ($objStatus->subjob ? 'init&jumpToRun=' . $objStatus->jumpToRun . '&rootRun=' . $objStatus->rootRun . '&id=' : '') . $objStatus->id . ($objStatus->final ? '&final=1' : '') . '&REQUEST_TOKEN=';

        $this->redirect($strAction . REQUEST_TOKEN);
    }

}

/**
 * Instantiate controller
 */
$objCronJob = new ConvertXCron();
$objCronJob->run();