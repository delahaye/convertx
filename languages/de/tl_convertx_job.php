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
$GLOBALS['TL_LANG']['tl_convertx_job']['converter'][0]   = 'Konverter';
$GLOBALS['TL_LANG']['tl_convertx_job']['converter'][1]   = 'Konverter für diverse im_ und Exportformate verwalten.';

$GLOBALS['TL_LANG']['tl_convertx_job']['new'][0]         = 'Neuer Job';
$GLOBALS['TL_LANG']['tl_convertx_job']['new'][1]         = 'Konfiguration für einen neuen Job erstellen.';

$GLOBALS['TL_LANG']['tl_convertx_job']['restore'][0]     = 'Wiederherstellen';
$GLOBALS['TL_LANG']['tl_convertx_job']['restore'][1]     = 'Einen gesichterten Stand diverser Tabellen wiederherstellen.';

$GLOBALS['TL_LANG']['tl_convertx_job']['howto'][0]       = 'Hilfe';
$GLOBALS['TL_LANG']['tl_convertx_job']['howto'][1]       = 'Kurze Anleitung zu Jobs.';


// operations
$GLOBALS['TL_LANG']['tl_convertx_job']['show'][0]        = 'Details des Jobs';
$GLOBALS['TL_LANG']['tl_convertx_job']['show'][1]        = 'Die Details des Jobs ID %s anzeigen';

$GLOBALS['TL_LANG']['tl_convertx_job']['edit'][0]        = 'Job bearbeiten';
$GLOBALS['TL_LANG']['tl_convertx_job']['edit'][1]        = 'Job ID %s bearbeiten';

$GLOBALS['TL_LANG']['tl_convertx_job']['editheader'][0]  = 'Einstellungen des Jobs';
$GLOBALS['TL_LANG']['tl_convertx_job']['editheader'][1]  = 'Einstellungen des Jobs ID %s bearbeiten';

$GLOBALS['TL_LANG']['tl_convertx_job']['copy'][0]        = 'Job duplizieren';
$GLOBALS['TL_LANG']['tl_convertx_job']['copy'][1]        = 'Job ID %s duplizieren';

$GLOBALS['TL_LANG']['tl_convertx_job']['delete'][0]      = 'Job löschen';
$GLOBALS['TL_LANG']['tl_convertx_job']['delete'][1]      = 'Job ID %s löschen';

$GLOBALS['TL_LANG']['tl_convertx_job']['runjob'][0]      = 'Job ausführen';
$GLOBALS['TL_LANG']['tl_convertx_job']['runjob'][1]      = 'Job ID %s ausführen';

$GLOBALS['TL_LANG']['tl_convertx_job']['runs'][0]        = 'History';
$GLOBALS['TL_LANG']['tl_convertx_job']['runs'][1]        = 'History des Jobs ID %s ansehen';


// fields
$GLOBALS['TL_LANG']['tl_convertx_job']['title'][0]           = 'Titel';
$GLOBALS['TL_LANG']['tl_convertx_job']['title'][1]           = 'Bezeichnung für den Job.';

$GLOBALS['TL_LANG']['tl_convertx_job']['keepVersions'][0]    = 'Backup-Versionen';
$GLOBALS['TL_LANG']['tl_convertx_job']['keepVersions'][1]    = 'Anzahl der gesicherten Tabellenstände vor Ausführung des Jobs.';

$GLOBALS['TL_LANG']['tl_convertx_job']['keepLogs'][0]        = 'Protokollierte Läufe';
$GLOBALS['TL_LANG']['tl_convertx_job']['keepLogs'][1]        = 'Anzahl der gesicherten Ablauf-Protokolle.';

$GLOBALS['TL_LANG']['tl_convertx_job']['lastrun'][0]         = 'Letzter Lauf';
$GLOBALS['TL_LANG']['tl_convertx_job']['lastrun'][1]         = 'Letzter Lauf des Jobs.';

$GLOBALS['TL_LANG']['tl_convertx_job']['token'][0]           = 'Token für Cronjob';
$GLOBALS['TL_LANG']['tl_convertx_job']['token'][1]           = 'Um den Job via Cron aufzurufen, verwenden Sie das Format http://{IHRE-DOMAIN}/system/modules/convertx/assets/cron.php?token={TOKEN}. Der Token wird automatisch errechnet, wenn der Job gespeichert wird.';

$GLOBALS['TL_LANG']['tl_convertx_job']['targetTables'][0]    = 'Tabellen, die ausserhalb von Konvertern betroffen sind';
$GLOBALS['TL_LANG']['tl_convertx_job']['targetTables'][1]    = 'Wählen Sie die Tabellen aus, die - neben denen, die durch Konverter ohnehin in Arbeitsversionen kopiert werden - als teporäre Versionen zur Verfügung stehen sollen.';


// references
$GLOBALS['TL_LANG']['tl_convertx_job']['job']                        = 'Job';
$GLOBALS['TL_LANG']['tl_convertx_job']['jobId']                      = 'Job ID %s';
$GLOBALS['TL_LANG']['tl_convertx_job']['jobTitle']                   = 'Job ID %s: "%s"';

$GLOBALS['TL_LANG']['tl_convertx_job']['start']                      = 'Job starten';
$GLOBALS['TL_LANG']['tl_convertx_job']['end']                        = 'beenden';
$GLOBALS['TL_LANG']['tl_convertx_job']['next']                       = 'weiter';

$GLOBALS['TL_LANG']['tl_convertx_job']['simulation']                 = 'Simulation';

$GLOBALS['TL_LANG']['tl_convertx_job']['initialisation']             = 'Initialisierung';
$GLOBALS['TL_LANG']['tl_convertx_job']['processing']                 = 'Verarbeitung läuft';
$GLOBALS['TL_LANG']['tl_convertx_job']['finalisation']               = 'Finalisierung';
$GLOBALS['TL_LANG']['tl_convertx_job']['finished']                   = 'Verarbeitung abgeschlossen';

$GLOBALS['TL_LANG']['tl_convertx_job']['aborted']                    = 'Der Job wurde abgebrochen.';
$GLOBALS['TL_LANG']['tl_convertx_job']['noJobData']                  = 'Der Job wurde abgebrochen. Keine Daten für Lauf vorhanden.';
$GLOBALS['TL_LANG']['tl_convertx_job']['noParentData']               = 'Der Job wurde abgebrochen. Keine Daten für Eltern-Job vorhanden.';
$GLOBALS['TL_LANG']['tl_convertx_job']['importError']                = 'Importfehler bei externen Daten.';
$GLOBALS['TL_LANG']['tl_convertx_job']['deletingError']              = 'Löschfehler bei temporären Daten.';
$GLOBALS['TL_LANG']['tl_convertx_job']['abortion']                   = 'Abbruch';
$GLOBALS['TL_LANG']['tl_convertx_job']['abortionStep']               = 'Abbruch in Step %s';
$GLOBALS['TL_LANG']['tl_convertx_job']['abortionInStep']             = 'Abbruch in Step %s (%s, %s)';
$GLOBALS['TL_LANG']['tl_convertx_job']['noJob']                      = 'Der Job kann nicht gestartet werden. Existiert er ggf. nicht?';

$GLOBALS['TL_LANG']['tl_convertx_job']['runNotice']                  = 'Der Job wird gestartet. Bitte unterbrechen Sie den Lauf nicht, um ein unvorhersehbares Verhalten zu vermeiden. Sollte der Job fehlschlagen, können im Anschluss die veränderten Datentabellen wiederhergestellt werden.<br><br>Bitte erstellen Sie ein Backup Ihrer Installation. Ein falsch konfigurierter Job kann Ihre Contao-Installation soweit beschädigen, dass sie ohne Komplett-Backup inkl. Datenbank nicht mehr reparabel ist. In den Nutzungsbedingungen zu diesem Modul haben Sie Ihrem Verzicht auf Schadenersatz und Gewährleistungen für den Fall zugestimmt, dass Sie kein vorheriges Backup erstellen.';
$GLOBALS['TL_LANG']['tl_convertx_job']['simNotice']                  = 'Job nur simulieren (nicht empfohlen bei Hookfunktionen)';
$GLOBALS['TL_LANG']['tl_convertx_job']['licenseError']               = 'Lizenzproblem';
$GLOBALS['TL_LANG']['tl_convertx_job']['licenseFail']                = 'Die Lizenz scheint leider ungültig zu sein. Daher können die angelegten Jobs leider nicht ausgeführt werden.<br>Key: %s<br>Ablauf: %s<br>Lizenznehmer: %s<br>Domains: %s, %s';
$GLOBALS['TL_LANG']['tl_convertx_job']['licenseValidate']            = 'Die Lizenz konnte leider nicht validiert werden und die angelegten Jobs können daher nicht ausgeführt werden.<br>Key: %s';

$GLOBALS['TL_LANG']['tl_convertx_job']['fillTemporaryTables']        = 'Temporäre Tabellen mit externen Daten befüllen';
$GLOBALS['TL_LANG']['tl_convertx_job']['clearTemporaryTables']       = 'Temporäre Tabellen bereinigen';

$GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetCreated']     = 'Temporäre Ziel-Tabelle cvx_%s angelegt';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetNotCreated']  = 'Temporäre Ziel-Tabelle cvx_%s nicht angelegt';
$GLOBALS['TL_LANG']['tl_convertx_job']['targetDuplicated']           = 'Ziel-Tabelle %s dupliziert';
$GLOBALS['TL_LANG']['tl_convertx_job']['targetNotDuplicated']        = 'Ziel-Tabelle %s nicht dupliziert';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporarySourceCreated']     = 'Temporäre Quell-Tabelle cvx_%s_source angelegt';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporarySourceNotCreated']  = 'Temporäre Quell-Tabelle cvx_%s_source nicht angelegt';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetRemoved']     = 'Temporäre Ziel-Tabelle cvx_%s entfernt';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetNotRemoved']  = 'Temporäre Ziel-Tabelle cvx_%s nicht entfernt';
$GLOBALS['TL_LANG']['tl_convertx_job']['targetFileCreated']          = 'Ziel-Datei aus cvx_%s erzeugt';
$GLOBALS['TL_LANG']['tl_convertx_job']['targetFileNotCreated']       = 'Ziel-Datei aus cvx_%s nicht erzeugt';
$GLOBALS['TL_LANG']['tl_convertx_job']['targetUpdated']              = 'Ziel-Tabelle %s aktualisiert';
$GLOBALS['TL_LANG']['tl_convertx_job']['targetNotUpdated']           = 'Ziel-Tabelle %s nicht aktualisiert';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetCleared']     = 'Temporäre Ziel-Tabelle %s bereinigt';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporaryTargetNotCleared']  = 'Temporäre Ziel-Tabelle %s nicht bereinigt';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporarySourceFilled']      = 'Temporäre Quell-Tabelle cvx_%s_source befüllt';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporarySourceNotFilled']   = 'Temporäre Quell-Tabelle cvx_%s_source nicht befüllt';
$GLOBALS['TL_LANG']['tl_convertx_job']['temporarySourceRemoved']     = 'Temporäre Quell-Tabelle cvx_%s_source entfernt';

$GLOBALS['TL_LANG']['tl_convertx_job']['no_cron_access']             = 'Zugriff auf Cronjob verweigert.';
$GLOBALS['TL_LANG']['tl_convertx_job']['cron_failed']                = 'Cronjob fehlgeschlagen.';
$GLOBALS['TL_LANG']['tl_convertx_job']['cron_success']               = 'Cronjob beendet.';

$GLOBALS['TL_LANG']['tl_convertx_job']['hookFailed']                 = 'Hook-Funktion fehlgeschlagen';
$GLOBALS['TL_LANG']['tl_convertx_job']['sqlFailed']                  = 'SQL fehlgeschlagen';

$GLOBALS['TL_LANG']['tl_convertx_job']['setsInserted']               = '%s Datensätze eingefügt';
$GLOBALS['TL_LANG']['tl_convertx_job']['setsUpdated']                = '%s Datensätze aktualisiert';

$GLOBALS['TL_LANG']['tl_convertx_job']['splitting']                  = 'Aufteilung';

$GLOBALS['TL_LANG']['tl_convertx_job']['insertError']                = 'Einfügefehler';
$GLOBALS['TL_LANG']['tl_convertx_job']['updateError']                = 'Updatefehler: %s';

$GLOBALS['TL_LANG']['tl_convertx_job']['step_converter']             = 'Konverter';
$GLOBALS['TL_LANG']['tl_convertx_job']['step_hook']                  = 'Hook';
$GLOBALS['TL_LANG']['tl_convertx_job']['step_sql']                   = 'SQL';

$GLOBALS['TL_LANG']['tl_convertx_job']['titleNoInit'] = 'Unvollständige Installation';
$GLOBALS['TL_LANG']['tl_convertx_job']['noInitfile']  = 'Die ConvertX-Installation ist unvollständig oder der Lizenzschlüssel konnte nicht verifiziert werden. <strong>Zur Initialisierung muss einmalig eine Internetverbindung bestehen.</strong> Falls sich dieser Fehler nicht beheben lässt, kontaktieren Sie bitte service@delahaye.de.';
$GLOBALS['TL_LANG']['tl_convertx_job']['noMcrypt']    = 'Die PHP-Extension mcrypt ist nicht installiert. Diese ist Teil der Contao-Systemvoraussetzungen und für ConvertX erforderlich.';