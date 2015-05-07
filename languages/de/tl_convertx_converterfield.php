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
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fill'][0]         = 'Feldefinitionen ergänzen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fill'][1]         = 'Feldefinitionen automatisch erstellen und ergänzen.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['new'][0]          = 'Neue Felddefinition';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['new'][1]          = 'Konfiguration für eine neue Felddefinition erstellen.';

// operations
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['edit'][0]         = 'Bearbeiten';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['edit'][1]         = 'Konverter ID %s bearbeiten';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['copy'][0]         = 'Duplizieren';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['copy'][1]         = 'Felddefinition ID %s duplizieren';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['delete'][0]       = 'Löschen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['delete'][1]       = 'Felddefinition ID %s löschen';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['toggle'][0]       = 'Aktivieren';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['toggle'][1]       = 'Felddefinition ID %s aktivieren';


// header fields
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['title_legend']    = 'Zielfeld';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['insert_legend']   = 'Neuanlage';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['update_legend']   = 'Update';


// fields
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fieldname'][0]        = 'Feldname';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fieldname'][1]        = 'Name des Feldes.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['published'][0]        = 'aktiv';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['published'][1]        = 'Das Feld wird berücksichtigt.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowInsert'][0]      = 'Neue Datensätze anlegen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowInsert'][1]      = 'Nicht vorhandene Datensätze werden angelegt.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowUpdate'][0]      = 'Datensätze updaten';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowUpdate'][1]      = 'Vorhandene Datensätze werden aktualisiert.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['type'][0]             = 'Datenermittlung';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['type'][1]             = 'Legt fest, wie die Daten für das Feld ermittelt werden.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['field'][0]            = 'Datenquellen-Feld';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['field'][1]            = 'Feld in der Datenquelle';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['mode'][0]             = 'Modus';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['mode'][1]             = 'Modus des Datenupdates';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['addDelimiter'][0]     = 'Zusätzliche Zeichen vor/nach dem Wert aus der Quelle';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['addDelimiter'][1]     = 'Die Zeichenkette wird vor bzw. nach dem Wert eingefügt.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagMode'][0]          = 'Tag-Behandlung';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagMode'][1]          = 'Legt fest, wie die Tags verwendet werden.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagTypeSource'][0]    = 'Tag-Typ in der Datenquelle';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagTypeSource'][1]    = 'Art der Tag-Speicherung in der Datenquelle.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagTypeTarget'][0]    = 'Tag-Typ in der Zieltabelle';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tagTypeTarget'][1]    = 'Art der Tag-Speicherung in der Zieltabelle.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['sourceDelimiter'][0]  = 'Trennzeichen in der Datenquelle';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['sourceDelimiter'][1]  = 'Trennzeichen, falls nicht serialisiert wird.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['targetDelimiter'][0]  = 'Trennzeichen in der Zieltabelle';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['targetDelimiter'][1]  = 'Trennzeichen, falls nicht serialisiert wird.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['initialValue'][0]     = 'Startwert-Ermittlung';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['initialValue'][1]     = 'Der Startwert kann automatisch ermittelt werden.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['start'][0]            = 'Startwert';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['start'][1]            = 'Erster Wert, nur ganze Zahl.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['step'][0]             = 'Schrittweite';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['step'][1]             = 'Wert wird jeweils addiert. Nur ganze Zahl.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fix'][0]              = 'Fixer Wert';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fix'][1]              = 'Jeder Datensatz erhält den gleichen Inhalt.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['sql'][0]              = 'Wert aus SQL-Abfrage';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['sql'][1]              = 'Der zu ermittelnde Feldwert `convertx_value` wird per SQL berechnet. Die Feldwerte des aktuellen Datensatzes der Datenquelle können mit ##feldname## genutzt werden.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['hook'][0]             = 'Registrierte Hooks';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['hook'][1]             = 'Es können neue, für den spezillen Import angepasste Hooks registriert werden.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowInsert'][0]      = 'Neue Datensätze anlegen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowInsert'][1]      = 'Nicht vorhandene Datensätze werden angelegt.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowUpdate'][0]      = 'Datensätze updaten';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['allowUpdate'][1]      = 'Vorhandene Datensätze werden aktualisiert.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fillChar'][0]         = 'Zeichen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fillChar'][1]         = 'Zeichen, mit dem aufgefüllt werden soll.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fieldLength'][0]      = 'Ziel-Feldlänge';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['fieldLength'][1]      = 'Gewünschte Zeichenanzahl.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandSide'][0]       = 'Seite';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandSide'][1]       = 'Richtung, in die der gewählte Modus angewandt wird.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandString'][0]     = 'Ergänzender Wert';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandString'][1]     = 'Text, der angehangen oder vorangestellt wird.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandKeep'][0]       = 'Vorhandenen Wert erhalten';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['expandKeep'][1]       = 'Der vorhandene Wert wird ebenfalls angehangen.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['dateVal'][0]          = 'Datum';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['dateVal'][1]          = 'Aus diesem Datum wird ein Timestamp ermittelt.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['timeVal'][0]          = 'Zeit';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['timeVal'][1]          = 'Zeitangabe für den Timestamp.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['dateFormat'][0]       = 'Format';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['dateFormat'][1]       = 'Geliefertes Datums-Format.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tstampUp'][0]         = 'Hinzuzurechende Sekunden';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['tstampUp'][1]         = 'Dem aktuellen Zeitstempel kann eine bestimmte Anzahl von Sekunden hinzugerechnet werden.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleInsert'][0]     = 'Schlüssel für weiblich';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleInsert'][1]     = 'Achtung - nur Kleinbuchstaben verwenden! Kommt einer der Werte vor, wird weiblich angenommen, sonst auf männlich geprüft.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleUpdate'][0]     = 'Schlüssel für weiblich';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleUpdate'][1]     = 'Achtung - nur Kleinbuchstaben verwenden! Kommt einer der Werte vor, wird weiblich angenommen, sonst auf männlich geprüft.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleInsert'][0]       = 'Schlüssel für männlich';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleInsert'][1]       = 'Achtung - nur Kleinbuchstaben verwenden! Kommt einer der Werte vor, wird männlich angenommen, sonst nichts.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleUpdate'][0]       = 'Schlüssel für männlich';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleUpdate'][1]       = 'Achtung - nur Kleinbuchstaben verwenden! Kommt einer der Werte vor, wird männlich angenommen, sonst nichts.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleVal'][0]        = 'Zielwert für weiblich';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['femaleVal'][1]        = 'Im Zielformat verwendeter Wert.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleVal'][0]          = 'Zielwert für männlich';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['maleVal'][1]          = 'Im Zielformat verwendeter Wert.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['noInsert'][0]         = 'Schlüssel für NEIN';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['noInsert'][1]         = 'Achtung - nur Kleinbuchstaben verwenden! Kommt einer der Werte vor, wird NEIN angenommen, sonst JA. Leerwerte, NULL und false sind NEIN-Werte.';

$GLOBALS['TL_LANG']['tl_convertx_converterfield']['noUpdate'][0]         = 'Schlüssel für NEIN';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['noUpdate'][1]         = 'Achtung - nur Kleinbuchstaben verwenden! Kommt einer der Werte vor, wird NEIN angenommen, sonst JA. Leerwerte, NULL und false sind NEIN-Werte.';


// references
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['field']             = 'Feld';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['new']               = 'Anlage';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['update']            = 'Update';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Insertfromfield']   = 'aus Feld in der Datenquelle';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Insertfix']         = 'fester Wert';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Insertsql']         = 'via SQL ermittelter Wert';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Inserthook']        = 'via Hook-Funktion ermittelter Wert';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Insertcountup']     = 'automatische Hochzählung';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Insertdate']        = 'fixes Datum';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Updatefromfield']   = 'aus Feld in der Datenquelle';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Updatefix']         = 'fester Wert';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Updatesql']         = 'via SQL ermittelter Wert';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Updatehook']        = 'via Hook-Funktion ermittelter Wert';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Updatedate']        = 'fixes Datum';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['initialValue']      = 'Startwert-Ermittlung';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['ownValue']          = 'eigener Startwert';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['tabValue']          = 'höchster Wert aus der Zieltabelle plus Schrittweite';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Addnew']            = 'Wert 1:1 einfügen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Replace']           = 'Wert 1:1 ersetzen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Bool']              = 'ja/nein-Angabe';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Gender']            = 'Geschlechtsermittlung';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Country']           = 'Länderermittlung';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Fill']              = 'auf feste Länge auffüllen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Crop']              = 'auf maximale Länge beschneiden';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Expand']            = 'Wert anhängen oder voranstellen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Tags']              = 'Tags, Serialisierungen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Add']               = 'In der Quelle vorhandene Tags hinzufügen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Delete']            = 'In der Quelle vorhandene Tags entfernen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['DeleteExistent']    = 'In der Quelle nicht mehr vorh. Tags entfernen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['DeleteAdd']         = 'In der Quelle nicht mehr vorh. Tags entfernen und neue ergänzen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['delimited']         = 'mit Trennzeichen';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['serialized']        = 'serialisiertes Feld';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['leftSide']          = 'linke Seite';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['rightSide']         = 'rechte Seite';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Datestring']        = 'Zeitstempel aus Datum ermitteln';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Updatetstamp']      = 'aktueller Zeitstempel';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Inserttstamp']      = 'aktueller Zeitstempel';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['new']               = 'Anlage';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['update']            = 'Update';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Base64']            = 'Wert Base64-dekodieren';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['Pass']              = 'Passwortgenerierung';
$GLOBALS['TL_LANG']['tl_convertx_converterfield']['references']['tmpField']          = 'Temporärer Wert';
