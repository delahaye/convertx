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
$GLOBALS['TL_LANG']['tl_convertx_step']['new'][0] = 'Neuer Schritt';
$GLOBALS['TL_LANG']['tl_convertx_step']['new'][1] = 'Konfiguration für einen neuen Schritt erstellen.';


// operations
$GLOBALS['TL_LANG']['tl_convertx_step']['show'][0]           = 'Details des Schritts';
$GLOBALS['TL_LANG']['tl_convertx_step']['show'][1]           = 'Die Details des Schritts ID %s anzeigen';

$GLOBALS['TL_LANG']['tl_convertx_step']['edit'][0]           = 'Schritt bearbeiten';
$GLOBALS['TL_LANG']['tl_convertx_step']['edit'][1]           = 'Schritt ID %s bearbeiten';

$GLOBALS['TL_LANG']['tl_convertx_step']['editheader'][0]     = 'Einstellungen';
$GLOBALS['TL_LANG']['tl_convertx_step']['editheader'][1]     = 'Einstellungen des Schritts ID %s bearbeiten';

$GLOBALS['TL_LANG']['tl_convertx_step']['copy'][0]           = 'Duplizieren';
$GLOBALS['TL_LANG']['tl_convertx_step']['copy'][1]           = 'Schritt ID %s duplizieren';

$GLOBALS['TL_LANG']['tl_convertx_step']['delete'][0]         = 'Löschen';
$GLOBALS['TL_LANG']['tl_convertx_step']['delete'][1]         = 'Schritt ID %s löschen';


// Legends
$GLOBALS['TL_LANG']['tl_convertx_step']['title_legend'] = 'Allgemeines';
$GLOBALS['TL_LANG']['tl_convertx_step']['steps_legend'] = 'Ablauf des Schritts';


// fields
$GLOBALS['TL_LANG']['tl_convertx_step']['title'][0]          = 'Titel';
$GLOBALS['TL_LANG']['tl_convertx_step']['title'][1]          = 'Bezeichnung für den Schritt.';

$GLOBALS['TL_LANG']['tl_convertx_step']['published'][0]      = 'Aktiv';
$GLOBALS['TL_LANG']['tl_convertx_step']['published'][1]      = 'Der Schritt kann genutzt werden.';

$GLOBALS['TL_LANG']['tl_convertx_step']['abortOnError'][0]   = 'Abbruch bei Fehlern';
$GLOBALS['TL_LANG']['tl_convertx_step']['abortOnError'][1]   = 'Der Importjob wird verworfen, wenn dieser Schritt wegen Fehlern abgebrochen wird.';

$GLOBALS['TL_LANG']['tl_convertx_step']['action'][0]         = 'Aktion';
$GLOBALS['TL_LANG']['tl_convertx_step']['action'][1]         = 'Legen Sie die Art des Schritts fest.';

$GLOBALS['TL_LANG']['tl_convertx_step']['converter'][0]      = 'Konverter';
$GLOBALS['TL_LANG']['tl_convertx_step']['converter'][1]      = 'Für den Schritt zu nutzender Konverter.';

$GLOBALS['TL_LANG']['tl_convertx_step']['sqlData'][0]        = 'SQL';
$GLOBALS['TL_LANG']['tl_convertx_step']['sqlData'][1]        = 'SQL-Abfrage für den Schritt.';

$GLOBALS['TL_LANG']['tl_convertx_step']['hook'][0]           = 'Hook-Script';
$GLOBALS['TL_LANG']['tl_convertx_step']['hook'][1]           = 'Es können neue, für den speziellen Import angepasste Hooks registriert werden.';

$GLOBALS['TL_LANG']['tl_convertx_step']['job'][0]            = 'Job';
$GLOBALS['TL_LANG']['tl_convertx_step']['job'][1]            = 'Wählen Sie den Sub-Job aus.';

$GLOBALS['TL_LANG']['tl_convertx_step']['onSimulation'][0]   = 'Auch bei Simulationen ausführen';
$GLOBALS['TL_LANG']['tl_convertx_step']['onSimulation'][1]   = 'Der Schritt soll auch bei simulierten Jobs ausgeführt werden. Vorsicht, kann ggf. nicht wiederhergesstellt werden!';


// References
$GLOBALS['TL_LANG']['tl_convertx_step']['references']['converter']   = 'Definierten Konverter ausführen';
$GLOBALS['TL_LANG']['tl_convertx_step']['references']['sql']         = 'SQL-Abfrage ausführen';
$GLOBALS['TL_LANG']['tl_convertx_step']['references']['hook']        = 'Hook-Funktion ausführen';
$GLOBALS['TL_LANG']['tl_convertx_step']['references']['job']         = 'Weiteren Job als Sub-Job ausführen';
