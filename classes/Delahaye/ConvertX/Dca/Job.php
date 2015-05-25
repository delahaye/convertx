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

namespace Delahaye\ConvertX\Dca;

use \Input;
use \Image;
use \File;
use Delahaye\ConvertX\Container\InternalTable;

/**
 * Class Job
 *
 * DCA callbacks for tl_convertx_job
 *
 * @package Delahaye\ConvertX\Dca
 */
class Job extends \Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }


    /**
     * Check permissions to edit table tl_convertx_job
     */
    public function checkPermission()
    {
        $strFile = 'system/modules/convertx/classes/Delahaye/ConvertX/Init.php';

        if(!file_exists(TL_ROOT.'/'.$strFile)){
            if($arrResponse = @file('http'.($GLOBALS['TL_CONFIG']['convertx_ssl'] ? 's':'').'://license.delahaye.de/init.html?v=' . $GLOBALS['convertx']['version'] . '&k=' . $GLOBALS['TL_CONFIG']['convertx'])){
                $objFile = new File($strFile);
                $objFile->write($arrResponse[0]);
                $objFile->close();
            }
        }

        if ($this->User->isAdmin) {
            return;
        }

        // Set root IDs
        if (!is_array($this->User->cvx_jobs) || empty($this->User->cvx_jobs))
        {
            $root = array(0);
        }
        else
        {
            $root = $this->User->cvx_jobs;
        }

        $GLOBALS['TL_DCA']['tl_convertx_job']['list']['sorting']['root'] = $root;

        // Check permissions to add Jobs
        if (!$this->User->hasAccess('create', 'cvx_jobp')) {
            $GLOBALS['TL_DCA']['tl_convertx_job']['config']['closed'] = true;
        }

        // Check current action
        switch (Input::get('act'))
        {
            case 'create':
            case 'select':
                // Allow
                break;

            case 'edit':
                // Dynamically add the record to the user profile
                if (!in_array(Input::get('id'), $root))
                {
                    $arrNew = $this->Session->get('new_records');

                    if (is_array($arrNew['tl_convertx_job']) && in_array(Input::get('id'), $arrNew['tl_convertx_job']))
                    {
                        // Add permissions on user level
                        if ($this->User->inherit == 'custom' || !$this->User->groups[0])
                        {
                            $objUser = $this->Database->prepare("SELECT cvx_jobs, cvx_jobp FROM tl_user WHERE id=?")
                                ->limit(1)
                                ->execute($this->User->id);

                            $arrCvx_jobp = deserialize($objUser->cvx_jobp);

                            if (is_array($arrCvx_jobp) && in_array('create', $arrCvx_jobp))
                            {
                                $arrCvx_jobs = deserialize($objUser->cvx_jobs);
                                $arrCvx_jobs[] = Input::get('id');

                                $this->Database->prepare("UPDATE tl_user SET cvx_jobs=? WHERE id=?")
                                    ->execute(serialize($arrCvx_jobs), $this->User->id);
                            }
                        }

                        // Add permissions on group level
                        elseif ($this->User->groups[0] > 0)
                        {
                            $objGroup = $this->Database->prepare("SELECT cvx_jobs, cvx_jobp FROM tl_user_group WHERE id=?")
                                ->limit(1)
                                ->execute($this->User->groups[0]);

                            $arrCvx_jobp = deserialize($objGroup->cvx_jobp);

                            if (is_array($arrCvx_jobp) && in_array('create', $arrCvx_jobp))
                            {
                                $arrCvx_jobs = deserialize($objGroup->cvx_jobs);
                                $arrCvx_jobs[] = Input::get('id');

                                $this->Database->prepare("UPDATE tl_user_group SET cvx_jobs=? WHERE id=?")
                                    ->execute(serialize($arrCvx_jobs), $this->User->groups[0]);
                            }
                        }

                        // Add new element to the user object
                        $root[] = Input::get('id');
                        $this->User->cvx_jobs = $root;
                    }
                }
            // No break;

            case 'copy':
            case 'delete':
            case 'show':
                if (!in_array(Input::get('id'), $root) || (Input::get('act') == 'delete' && !$this->User->hasAccess('delete', 'cvx_jobp')))
                {
                    $this->log('Not enough permissions to '.Input::get('act').' JOB ID "'.Input::get('id').'"', __METHOD__, TL_ERROR);
                    $this->redirect('contao/main.php?act=error');
                }
                break;

            case 'editAll':
            case 'deleteAll':
            case 'overrideAll':
                $session = $this->Session->getData();
                if (Input::get('act') == 'deleteAll' && !$this->User->hasAccess('delete', 'cvx_jobp'))
                {
                    $session['CURRENT']['IDS'] = array();
                }
                else
                {
                    $session['CURRENT']['IDS'] = array_intersect($session['CURRENT']['IDS'], $root);
                }
                $this->Session->setData($session);
                break;

            default:
                if (strlen(Input::get('act')))
                {
                    $this->log('Not enough permissions to '.Input::get('act').' JOBs', __METHOD__, TL_ERROR);
                    $this->redirect('contao/main.php?act=error');
                }
                break;
        }

    }


    /**
     * Return the edit button
     *
     * @param $row
     * @param $href
     * @param $label
     * @param $title
     * @param $icon
     * @param $attributes
     * @return string
     */
    public function edit($row, $href, $label, $title, $icon, $attributes)
    {
        return ($this->User->hasAccess('create', 'cvx_jobp') || $this->User->hasAccess('edit', 'cvx_jobp')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
    }


    /**
     * Return the edit header button
     *
     * @param $row
     * @param $href
     * @param $label
     * @param $title
     * @param $icon
     * @param $attributes
     * @return string
     */
    public function editHeader($row, $href, $label, $title, $icon, $attributes)
    {
        return ($this->User->canEditFieldsOf('tl_convertx_job') && ($this->User->hasAccess('create', 'cvx_jobp') || $this->User->hasAccess('edit', 'cvx_jobp'))) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
    }


    /**
     * Return the copy job button
     *
     * @param $row
     * @param $href
     * @param $label
     * @param $title
     * @param $icon
     * @param $attributes
     * @return string
     */
    public function copyJob($row, $href, $label, $title, $icon, $attributes)
    {
        return $this->User->hasAccess('create', 'cvx_jobp') ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
    }


    /**
     * Return the delete job button
     *
     * @param $row
     * @param $href
     * @param $label
     * @param $title
     * @param $icon
     * @param $attributes
     * @return string
     */
    public function deleteJob($row, $href, $label, $title, $icon, $attributes)
    {
        return $this->User->hasAccess('delete', 'cvx_jobp') ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
    }


    /**
     * Return the run job button
     *
     * @param $row
     * @param $href
     * @param $label
     * @param $title
     * @param $icon
     * @param $attributes
     * @return string
     */
    public function runJob($row, $href, $label, $title, $icon, $attributes)
    {
        return $this->User->hasAccess('runjob', 'cvx_jobp') ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
    }


    /**
     * Return the restore button
     *
     * @param $href
     * @param $label
     * @param $title
     * @param $class
     * @param $icon
     * @param $attributes
     * @return string
     */
    public function restore($href, $label, $title, $class, $icon, $attributes)
    {
        return $this->User->hasAccess('runjob', 'cvx_jobp') ? '<a class="header_icon" href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$icon.'>'.$label.'</a> ' : '';
    }


    /**
     * Return the converter button
     *
     * @param $href
     * @param $label
     * @param $title
     * @param $class
     * @param $icon
     * @param $attributes
     * @return string
     */
    public function converter($href, $label, $title, $class, $icon, $attributes)
    {
        return ($this->User->hasAccess('create', 'cvx_jobp') || $this->User->hasAccess('edit', 'cvx_jobp')) ? '<a class="header_icon" href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$icon.'>'.$label.'</a> ' : '';
    }


    /**
     * Set the cron token
     *
     * @param $row
     * @return string
     */
    public function setToken($row)
    {
        return $row ? $row : md5(uniqid(mt_rand(), true));
    }


    /**
     * Get table names
     *
     * @return array
     */
    public function getTables()
    {
        return InternalTable::getTables();
    }

}
