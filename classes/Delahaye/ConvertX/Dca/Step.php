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
use \Versions;
use Delahaye\ConvertX\Helper;
use Delahaye\ConvertX\Model\Converter as ConverterModel;
use Delahaye\ConvertX\Model\Job as JobModel;

/**
 * Class Step
 *
 * DCA callbacks for tl_convertx_step
 *
 * @package Delahaye\ConvertX\Dca
 */
class Step extends \Backend
{

    /**
     * Import the back end user
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }


    /**
     * List steps
     *
     * @param $arrRow
     * @return string
     */
    public function listSteps($arrRow)
    {
        if ($arrRow['converter']) {
            $objConverter = ConverterModel::findByPk($arrRow['converter']);
        }

        $key = $arrRow['published'] ? 'published' : 'unpublished';

        $return = '<div class="cte_type ' . $key . '"><strong>' . $arrRow['title'] . '</strong></div>';
        $return .= ($arrRow['action'] == 'converter' ? '<div>' . $GLOBALS['TL_LANG']['tl_convertx_step']['references'][$arrRow['action']] . ': ' . $objConverter->title . ' (' . $arrRow['converter'] . ')' . '</div>' : '');
        $return .= ($arrRow['action'] == 'sql' ? '<div>' . $GLOBALS['TL_LANG']['tl_convertx_step']['references'][$arrRow['action']] . '</div>' : '');
        $return .= ($arrRow['action'] == 'hook' ? '<div>' . $GLOBALS['TL_LANG']['tl_convertx_step']['references'][$arrRow['action']] . ': ' . $arrRow['hook'] . '</div>' : '');
        $return .= ($arrRow['abortOnError'] ? '<div>' . $GLOBALS['TL_LANG']['tl_convertx_step']['abortOnError'][0] . '</div>' : '');
        $return .= "\n";

        return $return;
    }


    /**
     * Get registered hooks
     *
     * @param $arrRow
     * @return array
     */
    public function getHooks($arrRow)
    {
        return Helper::getHooks('step');
    }


    /**
     * Get possible converters
     *
     * @param $objRow
     * @return array
     */
    public function getConverters($objRow)
    {
        $return = array();

        $objConverters = ConverterModel::findAll();

        while ($objConverters->next()) {
            $return[$objConverters->id] = $objConverters->title;
        }

        return $return;
    }


    /**
     * Get possible subjobs
     *
     * @param $objRow
     * @return array
     */
    public function getJobs($objRow)
    {
        $return = array();

        $objJobs = JobModel::findAll();

        while ($objJobs->next()) {
            if ($objJobs->id != $objRow->activeRecord->pid) {
                $return[$objJobs->id] = $objJobs->title;
            }
        }

        return $return;
    }


    /**
     * Return the edit converter wizard
     *
     * @param DataContainer $dc
     * @return string
     */
    public function editConverter(DataContainer $dc)
    {
        return ($dc->value < 1) ? '' : ' <a href="contao/main.php?do=convertx&amp;table=tl_convertx_converterfield&amp;id=' . $dc->value . '" title="' . sprintf(specialchars($GLOBALS['TL_LANG']['tl_content']['editalias'][1]), $dc->value) . '" style="padding-left:3px;">' . Image::getHtml('alias.gif', $GLOBALS['TL_LANG']['tl_content']['editalias'][0], 'style="vertical-align:top;"') . '</a>';
    }


    /**
     * Return the edit job wizard
     *
     * @param DataContainer $dc
     * @return string
     */
    public function editJob(DataContainer $dc)
    {
        return ($dc->value < 1) ? '' : ' <a href="contao/main.php?do=convertx&amp;table=tl_convertx_job&amp;id=' . $dc->value . '" title="' . sprintf(specialchars($GLOBALS['TL_LANG']['tl_content']['editalias'][1]), $dc->value) . '" style="padding-left:3px;">' . Image::getHtml('alias.gif', $GLOBALS['TL_LANG']['tl_content']['editalias'][0], 'style="vertical-align:top;"') . '</a>';
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
            $this->toggleVisibility(\Input::get('tid'), (\Input::get('state') == 1));
            $this->redirect($this->getReferer());
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
        $objVersions = new Versions('tl_convertx_step', $intId);
        $objVersions->initialize();

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_convertx_step']['fields']['published']['save_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_convertx_step']['fields']['published']['save_callback'] as $callback) {
                $this->import($callback[0]);
                $blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_convertx_step SET tstamp=" . time() . ", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
            ->execute($intId);
    }

}
