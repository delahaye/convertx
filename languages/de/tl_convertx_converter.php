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
$GLOBALS['TL_LANG']['tl_convertx_converter']['new'][0] = 'Neuer Konverter';
$GLOBALS['TL_LANG']['tl_convertx_converter']['new'][1] = 'Konfiguration für einen neuen Konverter erstellen.';


// operations
$GLOBALS['TL_LANG']['tl_convertx_converter']['edit'][0]          = 'Konverter bearbeiten';
$GLOBALS['TL_LANG']['tl_convertx_converter']['edit'][1]          = 'Konverter ID %s bearbeiten';

$GLOBALS['TL_LANG']['tl_convertx_converter']['delete'][0]        = 'Konverter löschen';
$GLOBALS['TL_LANG']['tl_convertx_converter']['delete'][1]        = 'Konverter ID %s löschen';

$GLOBALS['TL_LANG']['tl_convertx_converter']['editheader'][0]    = 'Einstellungen des Konverters';
$GLOBALS['TL_LANG']['tl_convertx_converter']['editheader'][1]    = 'Einstellungen des Konverters ID %s bearbeiten';


// legends
$GLOBALS['TL_LANG']['tl_convertx_converter']['title_legend']     = 'Allgemeines';
$GLOBALS['TL_LANG']['tl_convertx_converter']['target_legend']    = 'Datenziel';
$GLOBALS['TL_LANG']['tl_convertx_converter']['source_legend']    = 'Datenquelle';


// converter type
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['InternalTable'] = 'Contao-interne Tabelle';

// fields
$GLOBALS['TL_LANG']['tl_convertx_converter']['title'][0]             = 'Titel';
$GLOBALS['TL_LANG']['tl_convertx_converter']['title'][1]             = 'Bezeichnung für den Konverter.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['abortOnError'][0]      = '(Teil-)Abbruch bei Fehlerzeilen';
$GLOBALS['TL_LANG']['tl_convertx_converter']['abortOnError'][1]      = 'Dieser Konverter wird verworfen, wenn sich ein Datensatz nicht anlegen oder aktualisieren lässt. Standardmäßig wird nur die betroffene Zeile ignoriert.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceType'][0]        = 'Datenquelle';
$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceType'][1]        = 'Typ der verwendeten Datenquelle.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceFile'][0]        = 'Import-Datei';
$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceFile'][1]        = 'Datei, aus der importiert werden soll.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['targetFile'][0]        = 'Beispiel-Export-Datei';
$GLOBALS['TL_LANG']['tl_convertx_converter']['targetFile'][1]        = 'Datei, die das Format für den Export vorgibt. Wird nicht überschrieben.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['targetDir'][0]         = 'Zielverzeichnis';
$GLOBALS['TL_LANG']['tl_convertx_converter']['targetDir'][1]         = 'Ordner, in dem die Exportdatei werden soll.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['fileName'][0]          = 'Dateiname';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fileName'][1]          = 'Dateiname der Exportdatei. Es können Insert-Tags verwendet werden.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceTable'][0]       = 'Quell-Tabelle';
$GLOBALS['TL_LANG']['tl_convertx_converter']['sourceTable'][1]       = 'Tabelle mit den zu importierenden Daten.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['useTempSource'][0]     = 'Nutze temporäre Tabellenversion';
$GLOBALS['TL_LANG']['tl_convertx_converter']['useTempSource'][1]     = 'Statt der originalen Quell-Tabelle kann die - in einem vorhergehenden Schritt ggf. bereits veränderte - temporäre Tabellenversion als Quelle genutzt werden.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldsSource'][0]      = 'Felder in der Quelle';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldsSource'][1]      = 'In der Datenquelle gefundene Feldnamen.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['targetType'][0]        = 'Datenziel';
$GLOBALS['TL_LANG']['tl_convertx_converter']['targerType'][1]        = 'Typ der verwendeten Datenziels.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['targetTable'][0]       = 'Ziel-Tabelle';
$GLOBALS['TL_LANG']['tl_convertx_converter']['targetTable'][1]       = 'Contao-Tabelle, in die importiert werden soll.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['keySource'][0]         = 'Schlüsselfeld in der Quelle';
$GLOBALS['TL_LANG']['tl_convertx_converter']['keySource'][1]         = 'Achtung! Nur für die Konvertierung. Muss nicht zwangsläufig mit dem eigentlichen tabellenschlüssel übereinstimmen.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['keyTarget'][0]         = 'Schlüsselfeld in der temporären Zieltabelle';
$GLOBALS['TL_LANG']['tl_convertx_converter']['keyTarget'][1]         = 'Achtung! Nur für die Konvertierung. Muss nicht zwangsläufig mit dem eigentlichen tabellenschlüssel übereinstimmen.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteOnStart'][0]     = 'Daten vor dem Import löschen';
$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteOnStart'][1]     = 'Datensätze, die vor dem eigentlichen Import gelöscht werden sollen. Beide Auswahlen = Tabelle wird geleert.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteOnRules'][0]     = 'nach Lösch-Kennzeichen löschen';
$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteOnRules'][1]     = 'Vor dem Import bestimmte Datensätze löschen.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['allowInsert'][0]       = 'Neue Datensätze anlegen';
$GLOBALS['TL_LANG']['tl_convertx_converter']['allowInsert'][1]       = 'In der Quelldatei neu vorhandene Datensätze werden angelegt.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['allowUpdate'][0]       = 'Updates möglich';
$GLOBALS['TL_LANG']['tl_convertx_converter']['allowUpdate'][1]       = 'Die Update-Regeln der Feld-Konfigurationen werden abgearbeitet.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldsTarget'][0]      = 'Felder in der Ziel-Tabelle';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fieldsTarget'][1]      = 'Diese Felder sind in der Ziel-Tabelle vorhanden.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteRules'][0]       = 'Löschregeln';
$GLOBALS['TL_LANG']['tl_convertx_converter']['deleteRules'][1]       = 'Vor dem Import werden alle Datensätze gelöscht, die diesen Bedingungen entsprechen.';

$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_type'][0]        = 'Typ';
$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_type'][1]        = '';

$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_field'][0]       = 'Feld';
$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_field'][1]       = '';

$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_operator'][0]    = 'Bedingung';
$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_operator'][1]    = '';

$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_value'][0]       = 'Wert';
$GLOBALS['TL_LANG']['tl_convertx_converter']['rules_value'][1]       = '';


// subfields
$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_name']      = 'Feldname';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_default']   = 'Standardwert';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_type']      = 'Typ';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_length']    = 'Länge';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_null']      = 'Nullwert';
$GLOBALS['TL_LANG']['tl_convertx_converter']['fields_unique']    = 'Schlüssel';


// references
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['isKey']      = 'eindeutig';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['all']        = 'alle Datensäte';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['missing']    = 'alle Datensätze, die in der Quelldatei nicht mehr vorhanden sind';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['existent']   = 'alle Datensätze der Quelldatei';

$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['and']        = 'UND';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['or']         = 'ODER';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['eq']         = 'ist =';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['gteq']       = 'ist >=';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['gt']         = 'ist >';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['lt']         = 'ist <';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['lteq']       = 'ist <=';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['begins']     = 'beginnt mit';
$GLOBALS['TL_LANG']['tl_convertx_converter']['references']['ends']       = 'endet mit';
