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

/**
 * Class HowTo
 *
 * BE module help
 *
 * @package Delahaye\ConvertX\Module
 */
class HowTo extends \BackendModule
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'be_howto';


    /**
     * Generate module
     *
     * @return string
     */
    protected function compile()
    {
        $this->loadLanguageFile('convertx');

        $this->Template = new BackendTemplate($this->strTemplate);

        $this->Template->href        = $this->getReferer(true);
        $this->Template->title       = specialchars($GLOBALS['TL_LANG']['MSC']['backBT']);
        $this->Template->action      = ampersand($this->Environment->request);
        $this->Template->button      = $GLOBALS['TL_LANG']['MSC']['backBT'];

        $this->Template->title       = $GLOBALS['TL_LANG']['convertx']['howto_title'];
        $this->Template->description = $GLOBALS['TL_LANG']['convertx']['howto_description'];

        // parse template
        return $this->Template->parse();
    }

}
