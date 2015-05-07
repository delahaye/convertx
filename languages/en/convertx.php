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

// Howto
$GLOBALS['TL_LANG']['convertx']['howto_title']           = 'Import-jobs';
$GLOBALS['TL_LANG']['convertx']['howto_description']     = '
<h3>General</h3><hr>
<p>You can import into all sql tables within the Contao installationn. As source ther can be other tables from that installation or external files as e.g. csv-files.  <strong>Attention!</strong> This extension is addressed to admins, developers and agencies. Every import can damage the Contao installation seriously!</p>
<p>At the beginnig of a job run all target tables are copied into temporary versions. All modifications take place in duplicated tables that - as long as no error causes an abortion of the run - replace the original tables at the end of the run. These tables are named "cvx_" plus the original name and can be used within the import steps.</p>
<h3>Jobs, Converter & hooks</h3><hr>
<p>A <strong>job</strong> contains steps that are performed within a run of that job.</p>
<p>In a <strong>Converter</strong> is set which data is imported, which of the contained fieleds are used and how their date has to be mofified before storing them.  It is not necessary to use all fields of a source or a target. For inserts and updates there are several ways to modify the data before storing it again.</p>
<p>Things that can\'t be handled by the predefined functions, custom <strong>hooks</strong> can be integrated. The hooks could e.g. read external databases,  perform file operations etc.. There are hooks for complete steps and such used in table converters. The hook scripts can be integrated as normal Contao modules. To show that an example module is shipped with the extension.</p>
<h3>Runs</h3><hr>
<p>Jobs are run separated. You can do so in the backend and via cron job. The cron job call is <br><br><strong>http://{YOUR-DOMAIN}/system/modules/convertx/assets/cron.php?token={TOKEN}</strong><br><br>The token can be found in the settings of the job.</p>
<p>Sub-jobs are finalised at the end of the main job. This means: You have to remember in the converters and steps that the used tables maybe already present in the temporary naming  <strong>cvx_TABLLENNAME</strong>.</p>
<h3>Logging and error correction</h3><hr>
<p>The module saves a history for every run. It can be read directly at the job icons..</p>
<p>For testing purposes a job can be simulated. This doesn\'t prevent errors in live runs, but maybe helpful while configuring the jobs.</p>
<p>There is a (restricted) restore option. The affected target tables can be restored, but everything that was affected by hook functions can\'t.</p>
<h3>Conclusion</h3><hr>
<p>You\'ll have to think clearly, which steps are needed to get the desired result. Because of that the sources may be read twice or more in one import - e.g. in different temporary tables - the import routines can become quite complex. Importing in in MetaModels tables, Isotope shops or similar things are possible.</p>
<h3>Licenses</h3><hr>
<p>ConvertX is a commercial extension for Contao, but yet nearly completely open source. Most files are licensed LGPL, only a few are not. The reason is, that ther is often a need to modify the functionality for own projects. And developers need the code for that to understands how the whole system works. Detailed info about that see <a href="http://convertx.de" target="_blank">http://convertx.de</a>.</p>
';

// Restore
$GLOBALS['TL_LANG']['convertx']['restore_title'] 			= 'Restore';
$GLOBALS['TL_LANG']['convertx']['restore_description'] 		= 'Please not: Not every import can be rolled back 1:1. This causes e.g. from files which have been moved or other actions which affect the Contao tables. But you can normally restore the Contao tables affeted by jobs here. Please specify the timestamp to which all affted tables should be set back. If this service doesn\'t work, please restore from a backup (e.g. from your hoster)';
$GLOBALS['TL_LANG']['convertx']['restore_submit'] 			= 'Restore';
$GLOBALS['TL_LANG']['convertx']['restore_tablename'] 		= 'Table';
$GLOBALS['TL_LANG']['convertx']['restore_nothing'] 			= 'No restore information found.';
$GLOBALS['TL_LANG']['convertx']['restore_keep'] 			= 'Keep actual version';
$GLOBALS['TL_LANG']['convertx']['restore_tables_ok'] 		= 'Table(s) restored to:';
$GLOBALS['TL_LANG']['convertx']['restore_tables_error'] 	= 'Table(s) %s not restored.';
$GLOBALS['TL_LANG']['convertx']['restore_tables_fatal'] 	= 'Table(s) %s have been crashed. External restore needed!';
