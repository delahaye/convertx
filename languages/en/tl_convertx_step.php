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


// global operations
$GLOBALS['TL_LANG']['tl_convertx_step']['new'][0] = 'New step';
$GLOBALS['TL_LANG']['tl_convertx_step']['new'][1] = 'Add a configuration for a new step.';


// operations
$GLOBALS['TL_LANG']['tl_convertx_step']['show'][0]           = 'Step details';
$GLOBALS['TL_LANG']['tl_convertx_step']['show'][1]           = 'Show details of step ID %s';

$GLOBALS['TL_LANG']['tl_convertx_step']['edit'][0]           = 'Edit';
$GLOBALS['TL_LANG']['tl_convertx_step']['edit'][1]           = 'Edit step ID %s';

$GLOBALS['TL_LANG']['tl_convertx_step']['editheader'][0]     = 'Settings';
$GLOBALS['TL_LANG']['tl_convertx_step']['editheader'][1]     = 'Edit settings of step ID %s';

$GLOBALS['TL_LANG']['tl_convertx_step']['copy'][0]           = 'Copy';
$GLOBALS['TL_LANG']['tl_convertx_step']['copy'][1]           = 'Copy step %s';

$GLOBALS['TL_LANG']['tl_convertx_step']['delete'][0]         = 'Delete';
$GLOBALS['TL_LANG']['tl_convertx_step']['delete'][1]         = 'Delete step ID %s';


// Legends
$GLOBALS['TL_LANG']['tl_convertx_step']['title_legend'] = 'General';
$GLOBALS['TL_LANG']['tl_convertx_step']['steps_legend'] = 'Steps';


// fields
$GLOBALS['TL_LANG']['tl_convertx_step']['title'][0]          = 'Title';
$GLOBALS['TL_LANG']['tl_convertx_step']['title'][1]          = 'Title of the step.';

$GLOBALS['TL_LANG']['tl_convertx_step']['published'][0]      = 'Active';
$GLOBALS['TL_LANG']['tl_convertx_step']['published'][1]      = 'The step is used.';

$GLOBALS['TL_LANG']['tl_convertx_step']['abortOnError'][0]   = 'Abort on error';
$GLOBALS['TL_LANG']['tl_convertx_step']['abortOnError'][1]   = 'The job is aborted if this step is canceled because of errors.';

$GLOBALS['TL_LANG']['tl_convertx_step']['action'][0]         = 'Action';
$GLOBALS['TL_LANG']['tl_convertx_step']['action'][1]         = 'Specify the type of the step.';

$GLOBALS['TL_LANG']['tl_convertx_step']['converter'][0]      = 'Converter';
$GLOBALS['TL_LANG']['tl_convertx_step']['converter'][1]      = 'Used converter.';

$GLOBALS['TL_LANG']['tl_convertx_step']['sqlData'][0]        = 'SQL';
$GLOBALS['TL_LANG']['tl_convertx_step']['sqlData'][1]        = 'SQL query for the step.';

$GLOBALS['TL_LANG']['tl_convertx_step']['hook'][0]           = 'Hook script';
$GLOBALS['TL_LANG']['tl_convertx_step']['hook'][1]           = 'You can define customs hooks for your jobs.';

$GLOBALS['TL_LANG']['tl_convertx_step']['job'][0]            = 'Job';
$GLOBALS['TL_LANG']['tl_convertx_step']['job'][1]            = 'Specify the sub-job.';

$GLOBALS['TL_LANG']['tl_convertx_step']['onSimulation'][0]   = 'Execute on simulation';
$GLOBALS['TL_LANG']['tl_convertx_step']['onSimulation'][1]   = 'The step shall be executed even if the job run is simulated. Attention - maybe it can\'t be restored!';


// References
$GLOBALS['TL_LANG']['tl_convertx_step']['references']['converter']   = 'Run defined Converter';
$GLOBALS['TL_LANG']['tl_convertx_step']['references']['sql']         = 'Perform SQL query';
$GLOBALS['TL_LANG']['tl_convertx_step']['references']['hook']        = 'Use hook function';
$GLOBALS['TL_LANG']['tl_convertx_step']['references']['job']         = 'Execute sub-job';
