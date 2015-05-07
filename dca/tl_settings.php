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


/**
 * Extend default palette
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{convertx_legend},convertx;';


/**
 * Add fields to tl_user_group
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['convertx'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['convertx'],
    'exclude'                 => true,
    'inputType'               => 'text',
    'sql'                     => "text NULL"
);
