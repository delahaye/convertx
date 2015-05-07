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
 * Register the classes
 */
NamespaceClassLoader::add('Delahaye\ConvertX', 'system/modules/convertx/classes');

/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'be_run'            => 'system/modules/convertx/templates/backend',
    'be_howto'          => 'system/modules/convertx/templates/backend',
    'be_restore'        => 'system/modules/convertx/templates/backend',
));
