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
$GLOBALS['TL_LANG']['convertx']['howto_title']           = 'Import-Jobs';
$GLOBALS['TL_LANG']['convertx']['howto_description']     = '
<h3>Allgemeines</h3><hr>
<p>Es kann in beliebige Tabellen der Contao-Installation importiert werden. Als Quelle dienen andere Tabellen der Installation oder externe Daten, z.B. CSV-Dateien. <strong>Achtung!</strong> Die Erweiterung ist für Admins, Programmierer und Agenturen gedacht. Jeder hierüber ausgeführte Import kann die Contao-Installtion irreparabel beschädigen!</p>
<p>Am Beginn eines Jobs werden alle Zieltabellen in temporäre Versionen kopiert. Alle Änderungen finden in den kopierten Tabellen statt, die - sofern kein zum Abbruch qualifizierender Fehler aufgetreten ist - am Ende des Jobs die Originaltabellen ersetzen. Diese Tabellen erhalten einen um "cvx_" erweiterten Namen und können so auch in den Importschritten genutzt werden.</p>
<h3>Jobs, Konverter & Hooks</h3><hr>
<p>Ein <strong>Job</strong> enthält einzelne Schritte, die nacheinander in einem Lauf des Jobs abgearbeitet werden.</p>
<p>In einem <strong>Konverter</strong> wird festgelegt, welche Daten eingelesen werden, welche Felder hiervon wie umgewandelt werden und wohin die konvertierten Daten gespeichert werden. Es ist nicht nötig, jeweils alle Felder der Quelle oder des Ziels zu nutzen, was nicht benötigt wird, kann wegfallen. Für die Neuanlage und Updates stehen diverse Umformungsmöglichkeiten für die Daten zur Verfügung.</p>
<p>Für alles, was sich über die standardisierten Tabellenimporte nicht machen lässt, sind <strong>Hooks</strong> vorgesehen. Mit diesen (externen) Scripten können Aufgaben erledigt werden wie das Auslesen fremder Datenbanken, Dateioperationen etc.. Es wird unterschieden in Hook-Funktionen, die selbst einen Schritt darstellen und solchen, die innerhalb einer Tabellendefinition aufgerufen werden können. Passende Scripte können als eigene Contao-Erweiterungsmodule angelegt werden, da sich die Anforderungen an Importe je nach Anwendungsfall extrem unterscheiden. Zur Verdeutlichung ist ein Beispielmodul enthalten.</p>
<h3>Ausführung</h3><hr>
<p>Die Jobs werden separat ausgeführt. Das kann manuell im Backend erfolgen, oder via Cronjob. Der Aufruf ist <br><br><strong>http://{IHRE-DOMAIN}/system/modules/convertx/assets/cron.php?token={TOKEN}</strong><br><br>Der benötigte Token ist in den Einstellungen des Jonbs zu finden.</p>
<p>Sub-Jobs werden erst zum Ende des Haupt-Jobs finalisiert. Das bedeutet: Bei der Definition, in welchen Tabellen im Laufe des Jobs gelesen und/oder geschrieben werden soll, muss berücksichtigt werden, dass diese Tabellen ggf. bereits in der temporären Form <strong>cvx_TABLLENNAME</strong> vorliegen.</p>
<h3>Logging und Fehlerbehebung</h3><hr>
<p>Das Modul erstellt für jeden Lauf eines Importjobs ein Protokoll, was direkt in der Job-Übersicht aufgerufen werden kann.</p>
<p>Zu Testzwecken kann ein Job auch simuliert gestartet werden. Dies schließt spätere Fehler im Echtbetrieb  nicht aus, kann aber bei der Erstellung von Jobs nützlich sein.</p>
<p>Eingeschränkt steht eine Wiederherstellungs-Option zur Verfügung. Eingeschränkt, weil nur die bearbeiteten Ziel-Tabellen wiederhergestellt werden können. Dinge, die über einen Hook verändert wurden, lassen sich hiermit nicht zurücksetzen.</p>
<h3>Fazit</h3><hr>
<p>Im Endeffekt muss man sich halt gut überlegen, welche Schritte jeweils nötig sind, um das gewünschte Importergebnis zu erhalten. Da Datenquellen ja auch ggf. mehrfach eingelesen werden können - auch in unterschiedliche Zwischentabellen -, sind durchaus komplexe Importe in MetaModels-Tabellen, Isotope-Shops o.ä. möglich.</p>
<h3>Lizenzen</h3><hr>
<p>ConvertX ist zwar eine kommerzielle Erweiterung für Contao, aber ist dennoch fast vollständig quelloffen. Die meisten Dateien unterliegen der LGPL, nur wenige nicht. Grund ist, dass es nicht selten vorkommt, dass für Projekte eigene Funktionserweiterungen nötig werden. Und die kann man als Entwickler nur schlecht implementieren, wenn man nicht sieht, wie der Rest des Scripts aufgebaut ist. Nähere Infos hierzu gibt es unter <a href="http://convertx.de" target="_blank">http://convertx.de</a>.</p>
';

// Restore
$GLOBALS['TL_LANG']['convertx']['restore_title'] 			= 'Wiederherstellung';
$GLOBALS['TL_LANG']['convertx']['restore_description'] 		= 'Bitte beachten: Nicht jeder Import lässt sich 1:1 rückabwickeln. Dies hängt damit zusammen, dass z.B. Dateien verschoben oder andere - nicht auf direkte Contao-Tabellen bezogene - Aktionen ausgeführt werden können. Sie können hier allerdings die im Laufe der Importjobs veränderten Contao-Tabellen auf alte Stände zurücksetzen. Wählen Sie dazu für jede Tabelle aus, welche Kombination von Ständen die höchste Wahrscheinlichkeit für eine erfolgreiche Wiederherstellung bietet. Wenn das nicht funktioniert, sollte ein Backup - z.B. über den Provider - vorhanden sein.';
$GLOBALS['TL_LANG']['convertx']['restore_submit'] 			= 'Wiederherstellen';
$GLOBALS['TL_LANG']['convertx']['restore_tablename'] 		= 'Tabelle';
$GLOBALS['TL_LANG']['convertx']['restore_nothing'] 			= 'Keine Wiederherstellungs-Informationen vorhanden.';
$GLOBALS['TL_LANG']['convertx']['restore_keep'] 			= 'Aktuelle Version beibehalten';
$GLOBALS['TL_LANG']['convertx']['restore_tables_ok'] 		= 'Tabelle(n) auf folgende Stände wiederhergestellt:';
$GLOBALS['TL_LANG']['convertx']['restore_tables_error'] 	= 'Tabelle(n) %s nicht wiederhergestellt.';
$GLOBALS['TL_LANG']['convertx']['restore_tables_fatal'] 	= 'Tabelle(n) %s sind endgültig verloren. Backup-Einspielung erforderlich!';
