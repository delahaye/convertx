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
$GLOBALS['TL_LANG']['tl_convertx_job']['converter'][0]   = 'Converter';
$GLOBALS['TL_LANG']['tl_convertx_job']['converter'][1]   = 'Manage converter for several im- and export formats.';

$GLOBALS['TL_LANG']['tl_convertx_job']['new'][0]         = 'New Job';
$GLOBALS['TL_LANG']['tl_convertx_job']['new'][1]         = 'Add a configuration for a job.';

$GLOBALS['TL_LANG']['tl_convertx_job']['restore'][0]     = 'Restore';
$GLOBALS['TL_LANG']['tl_convertx_job']['restore'][1]     = 'Restore a saved state of a set of tables.';

$GLOBALS['TL_LANG']['tl_convertx_job']['howto'][0]       = 'Help';
$GLOBALS['TL_LANG']['tl_convertx_job']['howto'][1]       = 'Short online help for ConvertX.';


// operations
$GLOBALS['TL_LANG']['tl_convertx_job']['show'][0]        = 'Job details';
$GLOBALS['TL_LANG']['tl_convertx_job']['show'][1]        = 'Show the details des Jobs ID %s anzeigen';

$GLOBALS['TL_LANG']['tl_convertx_job']['edit'][0]        = 'Job steps';
$GLOBALS['TL_LANG']['tl_convertx_job']['edit'][1]        = 'Edit job ID %s';

$GLOBALS['TL_LANG']['tl_convertx_job']['editheader'][0]  = 'Settings';
$GLOBALS['TL_LANG']['tl_convertx_job']['editheader'][1]  = 'Settings of job ID %s';

$GLOBALS['TL_LANG']['tl_convertx_job']['copy'][0]        = 'Copy job';
$GLOBALS['TL_LANG']['tl_convertx_job']['copy'][1]        = 'Copy job ID %s';

$GLOBALS['TL_LANG']['tl_convertx_job']['delete'][0]      = 'Delete job';
$GLOBALS['TL_LANG']['tl_convertx_job']['delete'][1]      = 'Delete job ID %s';

$GLOBALS['TL_LANG']['tl_convertx_job']['runjob'][0]      = 'Run job';
$GLOBALS['TL_LANG']['tl_convertx_job']['runjob'][1]      = 'Run job ID %s';

$GLOBALS['TL_LANG']['tl_convertx_job']['runs'][0]        = 'History';
$GLOBALS['TL_LANG']['tl_convertx_job']['runs'][1]        = 'Show history for jobs ID %s';


// fields
$GLOBALS['TL_LANG']['tl_convertx_job']['title'][0]           = 'Title';
$GLOBALS['TL_LANG']['tl_convertx_job']['title'][1]           = 'Title of the job.';

$GLOBALS['TL_LANG']['tl_convertx_job']['keepVersions'][0]    = 'Backup-versions';
$GLOBALS['TL_LANG']['tl_convertx_job']['keepVersions'][1]    = 'Amount of backed up table-sets for this job.';

$GLOBALS['TL_LANG']['tl_convertx_job']['keepLogs'][0]        = 'Documented runs';
$GLOBALS['TL_LANG']['tl_convertx_job']['keepLogs'][1]        = 'Amount of documented runs for this job.';

$GLOBALS['TL_LANG']['tl_convertx_job']['lastrun'][0]         = 'Last run';
$GLOBALS['TL_LANG']['tl_convertx_job']['lastrun'][1]         = 'Last run of the job.';

$GLOBALS['TL_LANG']['tl_convertx_job']['token'][0]           = 'Token for cronjob';
$GLOBALS['TL_LANG']['tl_convertx_job']['token'][1]           = 'To start the run via cron use the format http://{YOUR_DOMAIN}/system/modules/convertx/assets/cron.php?token={TOKEN}. The token is generated automatically on saving the job.';

$GLOBALS['TL_LANG']['tl_convertx_job']['targetTables'][0]    = 'Tables affected beside of converters';
$GLOBALS['TL_LANG']['tl_convertx_job']['targetTables'][1]    = 'Select the table that shall be backup additionally to the ones used by converters. They reside as temporary versions while the job is running.';


// references
$GLOBALS['TL_LANG']['tl_convertx_job']['job']                        = 'Job';
$GLOBALS['TL_LANG']['tl_convertx_job']['jobId']                      = 'Job ID %s';
$GLOBALS['TL_LANG']['tl_convertx_job']['jobTitle']                   = 'Job ID %s: "%s"';

$GLOBALS['TL_LANG']['tl_convertx_job']['start']                      = 'Start job';
$GLOBALS['TL_LANG']['tl_convertx_job']['end']                        = 'exit';
$GLOBALS['TL_LANG']['tl_convertx_job']['next']                       = 'next step';

$GLOBALS['TL_LANG']['tl_convertx_job']['simulation']                 = 'Simulation';

$GLOBALS['TL_LANG']['tl_convertx_job']['initialisation']             = 'Initialisation';
$GLOBALS['TL_LANG']['tl_convertx_job']['processing']                 = 'Processing';
$GLOBALS['TL_LANG']['tl_convertx_job']['finalisation']               = 'Finalisation';
$GLOBALS['TL_LANG']['tl_convertx_job']['finished']                   = 'Processing ready';

$GLOBALS['TL_LANG']['tl_convertx_job']['aborted']                    = 'The job was canceled.';
$GLOBALS['TL_LANG']['tl_convertx_job']['noJobData']                  = 'The job was canceled. No job-data present for this run.';
$GLOBALS['TL_LANG']['tl_convertx_job']['noParentData']               = 'The job was canceled. No job-data present for thie parent run.';
$GLOBALS['TL_LANG']['tl_convertx_job']['importError']                = 'Import error on external data.';
$GLOBALS['TL_LANG']['tl_convertx_job']['deletingError']              = 'Deletion error on temporary data.';
$GLOBALS['TL_LANG']['tl_convertx_job']['abortion']                   = 'Abortion';
$GLOBALS['TL_LANG']['tl_convertx_job']['abortionStep']               = 'Abortion in step %s';
$GLOBALS['TL_LANG']['tl_convertx_job']['abortionInStep']             = 'Abortion in step %s (%s, %s)';
$GLOBALS['TL_LANG']['tl_convertx_job']['noJob']                      = 'The job can\'t be started. Does it exist?';

$GLOBALS['TL_LANG']['tl_convertx_job']['runNotice']                  = 'The job is getting started. Please do not interrupt the run as there could be an unpredictable behaviour. If the job fails, the data tables can be restored afterwards.<br><br>Please back up your installation. A misconfigured job can seriously damage your Contao installation to a point where only a complete restore helps out. In the Terms of Use for this module you have agreed to lose warranties for the case that you dis not create a previous backup.';
$GLOBALS['TL_LANG']['tl_convertx_job']['simNotice']                  = 'Simulate run (not recommended by usage of hook functions or nested jobs)';
$GLOBALS['TL_LANG']['tl_convertx_job']['licenseError']               = 'License problem';
$GLOBALS['TL_LANG']['tl_convertx_job']['licenseFail']                = 'The license seems to be not valid. For that reason the configured jobs can\'t be run.<br>Key: %s<br>Expires: %s<br>License holder: %s<br>Domains: %s, %s';
$GLOBALS['TL_LANG']['tl_convertx_job']['licenseValidate']            = 'The license could not be validated. For that reason the configured jobs can\'t be run.<br>Key: %s';

$GLOBALS['TL_LANG']['tl_convertx_job']['fillTemporaryTables']        = 'Fill temporary tables with external data';
$GLOBALS['TL_LANG']['tl_convertx_job']['clearTemporaryTables']       = 'Clean up temporary tables';

$GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetCreated']     = 'Temporary target table cvx_%s created';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetNotCreated']  = 'Temporary target table cvx_%s not created';
$GLOBALS['TL_LANG']['tl_convertx_job']['targetDuplicated']           = 'Target table %s duplicated';
$GLOBALS['TL_LANG']['tl_convertx_job']['targetNotDuplicated']        = 'Target table %s not duplicated';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporarySourceCreated']     = 'Temporary source table cvx_%s_source created';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporarySourceNotCreated']  = 'Temporary source table cvx_%s_source not created';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetRemoved']     = 'Temporary target table cvx_%s deleted';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetNotRemoved']  = 'Temporary target table cvx_%s not deleted';
$GLOBALS['TL_LANG']['tl_convertx_job']['targetFileCreated']          = 'Target table created from cvx_%s';
$GLOBALS['TL_LANG']['tl_convertx_job']['targetFileNotCreated']       = 'Target table not created from cvx_%s';
$GLOBALS['TL_LANG']['tl_convertx_job']['targetUpdated']              = 'Target table %s updated';
$GLOBALS['TL_LANG']['tl_convertx_job']['targetNotUpdated']           = 'Target table %s not updated';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetCleared']     = 'Temporary target table %s cleaned up';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetNotCleared']  = 'Temporary target table %s not cleaned up';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporarySourceFilled']      = 'Temporary source table cvx_%s_source filled';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporarySourceNotFilled']   = 'Temporary source table cvx_%s_source not filled';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporarySourceRemoved']     = 'Temporary source table cvx_%s_source deleted';

$GLOBALS['TL_LANG']['tl_convertx_job']['no_cron_access']             = 'Access to cron job denied.';
$GLOBALS['TL_LANG']['tl_convertx_job']['cron_failed']                = 'Cron job failed.';
$GLOBALS['TL_LANG']['tl_convertx_job']['cron_success']               = 'Cron job finished.';

$GLOBALS['TL_LANG']['tl_convertx_job']['hookFailed']                 = 'Hook function failed';
$GLOBALS['TL_LANG']['tl_convertx_job']['sqlFailed']                  = 'SQL failed';

$GLOBALS['TL_LANG']['tl_convertx_job']['setsInserted']               = '%s records added';
$GLOBALS['TL_LANG']['tl_convertx_job']['setsUpdated']                = '%s records updated';

$GLOBALS['TL_LANG']['tl_convertx_job']['splitting']                  = 'Splitting';

$GLOBALS['TL_LANG']['tl_convertx_job']['insertError']                = 'Insert error';
$GLOBALS['TL_LANG']['tl_convertx_job']['updateError']                = 'Update error: %s';

$GLOBALS['TL_LANG']['tl_convertx_job']['step_converter']             = 'Converter';
$GLOBALS['TL_LANG']['tl_convertx_job']['step_hook']                  = 'Hook';
$GLOBALS['TL_LANG']['tl_convertx_job']['step_sql']                   = 'SQL';

$GLOBALS['TL_LANG']['tl_convertx_job']['titleNoInit'] = 'Incomplete installation';
$GLOBALS['TL_LANG']['tl_convertx_job']['noInitfile']  = 'This ConvertX installation is incomplete or the license key could not be verified. <strong>For initialisierung a one-time internet connection is needed.</strong> Please contact service@delahaye.de if this error can\'t be fixed.';
$GLOBALS['TL_LANG']['tl_convertx_job']['noMcrypt']    = 'The PHP extension mcrypt is not installed. It is part of the Contao system requirements and needed by ConvertX.';