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
use \Controller;
use \Environment;
use \Image;
use \Versions;
use Delahaye\ConvertX\Helper;
use Delahaye\ConvertX\Model\Converter as ConverterModel;
use Delahaye\ConvertX\Model\Converterfield as ConverterfieldModel;

/**
 * Class Converterfield
 *
 * DCA callbacks for tl_convertx_converterfield
 *
 * @package Delahaye\ConvertX\Dca
 */
class Converterfield extends \Backend
{

    /**
     * Import the back end user and the convertx object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }


    /**
     * Adjust the palette on changes
     *
     * @param $dc
     */
    public function adjustPalette($dc)
    {
        if (Input::get('act') == 'edit') {
            $objConverterfields = ConverterfieldModel::findByPk($dc->id);
            $objConverter = $objConverterfields->getRelated('pid');

            if ($objConverter->allowInsert) {
                if ($objConverterfields->allowInsert) {
                    if ($objConverterfields->typeInsert == 'Insertfromfield') {
                        if (in_array($objConverterfields->modeInsert, array('Tags', 'Fill', 'Expand', 'Crop', 'Datestring', 'Gender', 'Country', 'Bool'))) {
                            $GLOBALS['TL_DCA']['tl_convertx_converterfield']['subpalettes']['allowInsert'] = $GLOBALS['TL_DCA']['tl_convertx_converterfield']['subpalettes']['Insertfromfield' . $objConverterfields->modeInsert];
                            if ($objConverterfields->initialValue != 'ownValue') {
                                $GLOBALS['TL_DCA']['tl_convertx_converterfield']['subpalettes']['allowInsert'] = str_replace(',start,step', ',step', $GLOBALS['TL_DCA']['tl_convertx_converterfield']['subpalettes']['allowInsert']);
                            }
                        }
                    } else {
                        $GLOBALS['TL_DCA']['tl_convertx_converterfield']['subpalettes']['allowInsert'] = $GLOBALS['TL_DCA']['tl_convertx_converterfield']['subpalettes'][$objConverterfields->typeInsert];
                    }
                }
            } else {
                $GLOBALS['TL_DCA']['tl_convertx_converterfield']['palettes']['default'] = str_replace(';{insert_legend},allowInsert', '', $GLOBALS['TL_DCA']['tl_convertx_converterfield']['palettes']['default']);
            }

            if ($objConverter->allowUpdate) {
                if ($objConverterfields->typeUpdate == 'Updatefromfield') {
                    if (in_array($objConverterfields->modeUpdate, array('Tags', 'Fill', 'Expand', 'Crop', 'Datestring', 'Gender', 'Country', 'Bool'))) {
                        $GLOBALS['TL_DCA']['tl_convertx_converterfield']['subpalettes']['allowUpdate'] = $GLOBALS['TL_DCA']['tl_convertx_converterfield']['subpalettes']['Updatefromfield' . $objConverterfields->modeUpdate];
                    }
                } else {
                    $GLOBALS['TL_DCA']['tl_convertx_converterfield']['subpalettes']['allowUpdate'] = $GLOBALS['TL_DCA']['tl_convertx_converterfield']['subpalettes'][$objConverterfields->typeUpdate];
                }
            } else {
                $GLOBALS['TL_DCA']['tl_convertx_converterfield']['palettes']['default'] = str_replace('{update_legend},allowUpdate', '', $GLOBALS['TL_DCA']['tl_convertx_converterfield']['palettes']['default']);
            }
        }
    }


    /**
     * List the elements
     *
     * @param $arrRow
     * @return string
     */
    public function listElements($arrRow)
    {
        $objConverter = ConverterModel::findByPk($arrRow['pid']);

        $key = $arrRow['published'] ? 'published' : 'unpublished';

        $return = '<div class="cte_type ' . $key . '"><strong>' . $arrRow['fieldname'] . '</strong> ('.$arrRow['sorting'].')</div>';
        $return .= ($objConverter->allowInsert ? '<div>' . $GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['new'] . ': ' . ($arrRow['allowInsert'] ? ($arrRow['typeInsert'] == 'Insertfromfield' ? ($arrRow['fieldInsert'] ? $GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['field'] . ' "' . $arrRow['fieldInsert'] . '", ' . $GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'][$arrRow['modeInsert']] : (!$arrRow['fieldInsert'] && !$arrRow['modeInsert'] ? $GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['tmpField'] : '-')) : $GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'][$arrRow['typeInsert']]) : '-') . '</div>' : '');
        $return .= ($objConverter->allowUpdate ? '<div>' . $GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['update'] . ': ' . ($arrRow['allowUpdate'] ? ($arrRow['typeUpdate'] == 'Updatefromfield' ? ($arrRow['fieldUpdate'] ? $GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['field'] . ' "' . $arrRow['fieldUpdate'] . '", ' . $GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'][$arrRow['modeUpdate']] : (!$arrRow['fieldInsert'] && !$arrRow['fieldUpdate'] ? $GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['tmpField'].', '.$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'][$arrRow['modeUpdate']] : '-')) : $GLOBALS['TL_LANG']['tl_convertx_converterfield']['references'][$arrRow['typeUpdate']]) : '-') . '</div>' : '');
        $return .= "\n";

        return $return;
    }


    /**
     * Get possible target fields
     *
     * @param $arrRow
     * @return array
     */
    public function getTargetFields($arrRow)
    {
        return ConverterModel::getTargetFieldnames($arrRow->activeRecord->pid);
    }


    /**
     * Get possible source fields
     *
     * @param $arrRow
     * @return array
     */
    public function getSourceFields($arrRow)
    {
        return ConverterModel::getSourceFieldnames($arrRow->activeRecord->pid);
    }


    /**
     * Create target field definitions
     */
    public function autoFill()
    {
        if (Input::get('key') == 'fill') {
            ConverterfieldModel::createTargetFields(Input::get('id'));
            Controller::redirect(str_replace('&key=fill', '', Environment::get('request')));
        }

        return;
    }


    /**
     * Get registered hooks that affect fields
     *
     * @param $arrRow
     * @return array
     */
    public function getHooks($arrRow)
    {
        return Helper::getHooks('field');
    }


    /**
     * Return the "toggle visibility" button
     *
     * @param $row
     * @param $href
     * @param $label
     * @param $title
     * @param $icon
     * @param $attributes
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (strlen(Input::get('tid'))) {
            $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_convertx_converterfield::published', 'alexf')) {
            return '';
        }

        $href .= '&amp;tid=' . $row['id'] . '&amp;state=' . ($row['published'] ? '' : 1);

        if (!$row['published']) {
            $icon = 'invisible.gif';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon, $label) . '</a> ';
    }


    /**
     * Disable/enable an element
     *
     * @param $intId
     * @param $blnVisible
     */
    public function toggleVisibility($intId, $blnVisible)
    {
        // Check permissions to publish
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_convertx_converterfield::published', 'alexf')) {
            $this->log('Not enough permissions to publish/unpublish Table field ID "' . $intId . '"', 'tl_convertx_converterfield toggleVisibility', TL_ERROR);
            $this->redirect('contao/main.php?act=error');
        }

        $objVersions = new Versions('tl_convertx_converterfield', $intId);
        $objVersions->initialize();

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_convertx_converterfield']['fields']['published']['save_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_convertx_converterfield']['fields']['published']['save_callback'] as $callback) {
                $this->import($callback[0]);
                $blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_convertx_converterfield SET tstamp=" . time() . ", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
            ->execute($intId);
    }

}
