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
use \DataContainer;
use Delahaye\ConvertX\Helper;
use Delahaye\ConvertX\Container\InternalTable;
use Delahaye\ConvertX\Model\Converter as ConverterModel;
use Delahaye\ConvertX\Model\Converterfield as ConverterfieldModel;

/**
 * Class Converter
 *
 * DCA callbacks for tl_convertx_converter
 *
 * @package Delahaye\ConvertX\Dca
 */
class Converter extends \Backend
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
     * Check permissions to edit table tl_convertx_converter
     */
    public function checkPermission()
    {
        if ($this->User->isAdmin) {
            return;
        }

        // Set root IDs
        if (!is_array($this->User->cvx_converters) || empty($this->User->cvx_converters))
        {
            $root = array(0);
        }
        else
        {
            $root = $this->User->cvx_converters;
        }

        $GLOBALS['TL_DCA']['tl_convertx_converter']['list']['sorting']['root'] = $root;

        // Check permissions to add Jobs
        if (!$this->User->hasAccess('create', 'cvx_converterp')) {
            $GLOBALS['TL_DCA']['tl_convertx_converter']['config']['closed'] = true;
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

                    if (is_array($arrNew['tl_convertx_converter']) && in_array(Input::get('id'), $arrNew['tl_convertx_converter']))
                    {
                        // Add permissions on user level
                        if ($this->User->inherit == 'custom' || !$this->User->groups[0])
                        {
                            $objUser = $this->Database->prepare("SELECT cvx_converters, cvx_converterp FROM tl_user WHERE id=?")
                                ->limit(1)
                                ->execute($this->User->id);

                            $arrCvx_converterp = deserialize($objUser->cvx_converterp);

                            if (is_array($arrCvx_converterp) && in_array('create', $arrCvx_converterp))
                            {
                                $arrCvx_converters = deserialize($objUser->cvx_converters);
                                $arrCvx_converters[] = Input::get('id');

                                $this->Database->prepare("UPDATE tl_user SET cvx_converters=? WHERE id=?")
                                    ->execute(serialize($arrCvx_converters), $this->User->id);
                            }
                        }

                        // Add permissions on group level
                        elseif ($this->User->groups[0] > 0)
                        {
                            $objGroup = $this->Database->prepare("SELECT cvx_converters, cvx_converterp FROM tl_user_group WHERE id=?")
                                ->limit(1)
                                ->execute($this->User->groups[0]);

                            $arrCvx_converterp = deserialize($objGroup->cvx_converterp);

                            if (is_array($arrCvx_converterp) && in_array('create', $arrCvx_converterp))
                            {
                                $arrCvx_converters = deserialize($objGroup->cvx_converters);
                                $arrCvx_converters[] = Input::get('id');

                                $this->Database->prepare("UPDATE tl_user_group SET cvx_converters=? WHERE id=?")
                                    ->execute(serialize($arrCvx_converters), $this->User->groups[0]);
                            }
                        }

                        // Add new element to the user object
                        $root[] = Input::get('id');
                        $this->User->cvx_converters = $root;
                    }
                }
            // No break;

            case 'copy':
            case 'delete':
            case 'show':
                if (!in_array(Input::get('id'), $root) || (Input::get('act') == 'delete' && !$this->User->hasAccess('delete', 'cvx_converterp')))
                {
                    $this->log('Not enough permissions to '.Input::get('act').' CONVERTER ID "'.Input::get('id').'"', __METHOD__, TL_ERROR);
                    $this->redirect('contao/main.php?act=error');
                }
                break;

            case 'editAll':
            case 'deleteAll':
            case 'overrideAll':
                $session = $this->Session->getData();
                if (Input::get('act') == 'deleteAll' && !$this->User->hasAccess('delete', 'cvx_converterp'))
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
                    $this->log('Not enough permissions to '.Input::get('act').' CONVERTERs', __METHOD__, TL_ERROR);
                    $this->redirect('contao/main.php?act=error');
                }
                break;
        }

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
        return ($this->User->canEditFieldsOf('tl_convertx_converter')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
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
    public function delete($row, $href, $label, $title, $icon, $attributes)
    {
        return $this->User->hasAccess('delete', 'cvx_converterp') ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
    }


    /**
     * Show palette fields
     *
     * @param $dc
     */
    public function expandPalette($dc)
    {
        if (!$dc) {
            return;
        }

        $objData = ConverterModel::findByPk($dc->id);

        // target subpalette
        if ($objData->targetType) {
            $GLOBALS['TL_DCA']['tl_convertx_converter']['palettes']['default'] = str_replace('targetType', 'targetType,' . $GLOBALS['TL_DCA']['tl_convertx_converter']['targetpalettes'][$objData->targetType] . ',fieldsTarget', $GLOBALS['TL_DCA']['tl_convertx_converter']['palettes']['default']);

            if ($objData->allowUpdate || ($objData->deleteOnStart != '' && $objData->deleteOnStart != 'all')) {
                $GLOBALS['TL_DCA']['tl_convertx_converter']['palettes']['default'] = str_replace('fieldsTarget', 'keySource,keyTarget,fieldsTarget', $GLOBALS['TL_DCA']['tl_convertx_converter']['palettes']['default']);
            }
        }

        // source subpalette
        if ($objData->sourceType) {
            $GLOBALS['TL_DCA']['tl_convertx_converter']['palettes']['default'] = str_replace('sourceType', 'sourceType,' . $GLOBALS['TL_DCA']['tl_convertx_converter']['sourcepalettes'][$objData->sourceType] . ',fieldsSource', $GLOBALS['TL_DCA']['tl_convertx_converter']['palettes']['default']);
        }

        return;
    }


    /**
     * Save field lists for target and source
     *
     * @param DataContainer $dc
     */
    public function setFieldLists(DataContainer $dc)
    {
        $objData = ConverterModel::findByPk(Input::get('id'));

        $classTarget = $dc->activeRecord->targetType ? ($GLOBALS['convertx']['classpath'][$dc->activeRecord->targetType] ? $GLOBALS['convertx']['classpath'][$dc->activeRecord->targetType] : 'Delahaye\\ConvertX\\Container') . '\\' . $dc->activeRecord->targetType : false;
        $classSource = $dc->activeRecord->sourceType ? ($GLOBALS['convertx']['classpath'][$dc->activeRecord->sourceType] ? $GLOBALS['convertx']['classpath'][$dc->activeRecord->sourceType] : 'Delahaye\\ConvertX\\Container') . '\\' . $dc->activeRecord->sourceType : false;

        // check if target fields have to be cleared
        if ($classTarget) {
            if ($classTarget::checkTargetClear($dc, $objData)) {
                ConverterfieldModel::clearTargetFields(Input::get('id'));
            }
        }

        // use actual data
        foreach ($GLOBALS['TL_DCA']['tl_convertx_converter']['fields'] as $k => $v) {
            $objData->$k = $dc->activeRecord->$k;
        }

        // get field lists for source and/or target
        if ($classTarget) {
            $objData->fieldsTarget = $dc->activeRecord->targetType ? serialize($classTarget::getFieldList($dc->activeRecord, 'target')) : false;
        }
        if ($classSource) {
            $objData->fieldsSource = $dc->activeRecord->sourceType ? serialize($classSource::getFieldList($dc->activeRecord, 'source')) : false;
        }

        // save the model
        $objData->save();

        return;
    }


    /**
     * Get table names
     */
    public function getTables()
    {
        return InternalTable::getTables();
    }


    /**
     * Get field names for deletion rules and the target key definition
     *
     * @param $obj
     * @return array
     */
    public function getTargetFields($obj)
    {
        if (!$obj->activeRecord) {
            return array();
        }

        $arrFields = InternalTable::getFieldList($obj->activeRecord, 'target');

        foreach ($arrFields as $arrField) {
            $arrReturn[] = $arrField['name'];
        }

        return $arrReturn;
    }


    /**
     * Get field names for the source key definition
     *
     * @param $obj
     * @return array
     */
    public function getSourceFields($obj)
    {
        if (!$obj->activeRecord->fieldsSource) {
            return array();
        }

        $arrFields = Helper::arrayOnly($obj->activeRecord->fieldsSource);

        foreach ($arrFields as $arrField) {
            $arrReturn[] = $arrField['name'];
        }

        return $arrReturn;
    }

}
