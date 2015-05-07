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
use \Input;
use Delahaye\ConvertX\Job;
use Delahaye\ConvertX\Run as ConvertXRun;

/**
 * Class Run
 *
 * BE module for runing an import job
 *
 * @package Delahaye\ConvertX\Module
 */
class Run extends \BackendModule
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'be_run';


    /**
     * Generate module
     *
     * @return string
     */
    protected function compile()
    {
        $this->import('BackendUser', 'User');

        // prepare template
        $this->Template = new BackendTemplate($this->strTemplate);

        $this->Template->back_href   = $this->getReferer(true);
        $this->Template->back_title  = specialchars($GLOBALS['TL_LANG']['MSC']['backBT']);
        $this->Template->back_button = $GLOBALS['TL_LANG']['MSC']['backBT'];

        $this->Template->action      = ampersand($this->Environment->request);

        // -----------------------------------------
        // confirm job run first

        if (!Input::get('run')) {
            $objJob = Job::findJob(Input::get('id'));

            // job not found
            if ($objJob->error) {
                $this->Template->abort    = true;
                $this->Template->running  = false;
                $this->Template->complete = false;
                $this->Template->title    = $objJob->title;
                $this->Template->error    = $objJob->error;
                $this->Template->submit   = $GLOBALS['TL_LANG']['tl_convertx_job']['end'];

                return $this->Template->parse();
            }

            // show confirmation form
            $this->Template->id = $objJob->id;
            $this->Template->title = sprintf($GLOBALS['TL_LANG']['tl_convertx_job']['jobTitle'], $objJob->id, $objJob->title);
            $this->Template->content = $GLOBALS['TL_LANG']['tl_convertx_job']['runNotice'];
            $this->Template->submit = $GLOBALS['TL_LANG']['tl_convertx_job']['start'];
            $this->Template->isSimulation = $GLOBALS['TL_LANG']['tl_convertx_job']['simNotice'];

            return $this->Template->parse();
        }

        $objRun = new ConvertXRun();

        $arrRun = $objRun->doRun(Input::get('run'), $this->User->id);

        foreach ($arrRun as $k => $v) {
            $this->Template->$k = $v;
        }

        return $this->Template->parse();
    }

}
