<?php
/**
 *
 * Counter. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2022, Chris1278
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, [
	'ACP_COUNTER_INSTRUCTIONS'					=> 'Um diese Erweiterung optimal zu nutzen, stellen Sie das gewünschte Zieldatum und die gewünschte Zielzeit ein. Für z.B. <b>01.Januar.2025 um 12 Uhr</b> bitte wie folgt einstellen:<br><br>Sekunde: 00<br>Minute: 00<br>	Stunde: 12<br>Tag: 01<br>Monat: 01<br>Jahr: 2025<br><br>Danach beginnt der Countdown bis zum gewünschten Ziel herunterzuzählen, wenn Sie es senden.',
	'ACP_COUNTER_ACTIVE'						=> 'Counter aktivieren',
	'ACP_COUNTER_ACTIVE_EXPLAIN'				=> 'Wählen Sie hier aus ob Sie den Counter aktiviert oder deaktiviert werden soll.',
	'ACP_COUNTER_SECOND'						=> 'Eingabe der Sekunde',
	'ACP_COUNTER_SECOND_EXPLAIN'				=> 'Geben Sie hier die Sekunde ein.',
	'ACP_COUNTER_MINUTE'						=> 'Eingabe der Minute',
	'ACP_COUNTER_MINUTE_EXPLAIN'				=> 'Geben Sie hier die Minute ein.',
	'ACP_COUNTER_HOUR'							=> 'Eingabe der Stunde',
	'ACP_COUNTER_HOUR_EXPLAIN'					=> 'Geben Sie hier die Stunde ein.',
	'ACP_COUNTER_DAY'							=> 'Eingabe des Taqes',
	'ACP_COUNTER_DAY_EXPLAIN'					=> 'Geben Sie hier den Tag ein.',
	'ACP_COUNTER_MONTH'							=> 'Eingabe des Monats',
	'ACP_COUNTER_MONTH_EXPLAIN'					=> 'Geben Sie hier den Monat ein.',
	'ACP_COUNTER_YEAR'							=> 'Eingabe des Jahres',
	'ACP_COUNTER_YEAR_EXPLAIN'					=> 'Geben Sie hier das Jahr ein.',
	'ACP_COUNTER_PERMISSION_INFO_BOTH'			=> 'In den <a href="%1$s"><strong>Benutzerrechten</strong></a><strong>/</strong><a href="%2$s"><strong>Gruppenrechten</strong></a> kann unter <strong>Diverses</strong> eingestellt werden, wer den Counter sehen darf.',
	'ACP_COUNTER_PERMISSION_INFO_USER'			=> 'In den <a href="%1$s"><strong>Benutzerrechten</strong></a> kann unter <strong>Diverses</strong> eingestellt werden, wer den Counter sehen darf.',
	'ACP_COUNTER_PERMISSION_INFO_GROUP'			=> 'In den <a href="%1$s"><strong>Gruppenrechten</strong></a> kann unter <strong>Diverses</strong> eingestellt werden, wer den Counter sehen darf.',
	'ACP_COUNTER_TEXT'							=> 'Countdown Zähler Text anzeigen',
	'ACP_COUNTER_TEXT_EXPLAIN'					=> 'Hier können Sie Einstellen ob überhaupt eine Ausgabe von über dem  und unter dem Countdown  erfolgen soll.<br>Wenn Sie keinen Text ausgeben wollen, erscheint nur die Zeit mit angaben in Form von:<br><br><b>Beispiel: 1 Jahre 1 Tage 1 Stunden 1 Minuten 1 Sekunden</b>.<br><br><b style="color: red">Information</b>: Dies trifft nicht auf den Text zu der am Ende des Countdowns ausgegeben wird. Dieser wird in jedemfall ausgegeben sofern dieser angelegt worden ist.',
	'ACP_COUNTER_TEXT_OPT'						=> 'Varianten der Textausgabe',
	'ACP_COUNTER_TEXT_OPT_EXPLAIN'				=> 'Hier können Sie festlegen in welcher der beiden Varianten Sie den Text für den Countdown anzeigen lassen möchten. Möglich sind die Varianten:<br><br><b>Variante 1: </b>Text der über dem Countdown steht und Text der unter dem Countdown steht<br><b>Variante 2: </b>Text der links neben dem Countdown steht und Text der rechts neben dem Countdown steht<br><br><b>Standard: </b>Variante 1',
	'ACP_COUNTER_TEXT_ABOVE_BELOW'				=> 'Variante 1',
	'ACP_COUNTER_TEXT_LEFT_RIGHT'				=> 'Variante 2',
	'ACP_INFO_COUNTER_TEXT_ENTER'				=> 'Kurz Info bezüglich benutzung der Option "Texte Verwalten"',
	'ACP_INFO_COUNTER_TEXT_ENTER_EXPLAIN'		=> 'Hier können Sie die Texte Verwalten. Sie können diese anlegen/bearbeiten und löschen. Löschen entweder einzeln oder alle gleichzeitig. Wenn Sie angelegte texte überschreiben wollen, können Sie dies tun in dem Sie bei der eingabe wie beim anlegen von Texten vorgehen. Eventuell vorhandene Texte werden einfach überschrieben. Es ist für das bearbeiten kein vorheriges löschen erforderlich.<br><br><b style="color: red">Zusatz-Info</b>: Je nachdem was Sie bei dem Schalter <b>„Countdown Zähler Text anzeigen“</b> ausgewählt haben werden entweder alle Textpositionen angezeigt (Schalter auf Ja) oder nur der für den Text der nach dem Countdown kommt wenn dieser abgelaufen ist (Schalter auf Nein). Diesen Text sollten Sie anlegen oder auch leer lassen. Wenn nach erreichen des Countdowns kein Text eingetragen ist, erscheint an stelle des Countdowns dann nichts mehr. Sprich da steht dann gar nichts mehr an der Stelle, das wird dann so behandelt als ob der Countdown nicht da ist sprich die Ext nicht aktiviert ist.',
	'ACP_COUNTER_OVERVIEW'						=> 'Texte Verwalten',
	'ACP_TEXT_ENTER'							=> 'Eingetragener Text',
	'ACP_LANG_TEXT_POSITION'					=> 'Textposition',
	'ACP_LANG_TEXT_POSITION_EXPLAIN'			=> 'Wählen Sie hier die Text-Position aus die Sie Speichern möchten.',
	'ACP_LANG_COUNT_ABOVE'						=> 'Text der über dem Countdown steht',
	'ACP_LANG_COUNT_BELOW'						=> 'Text der unter dem Countdown steht',
	'ACP_LANG_COUNT_BEFORE'						=> 'Text der links neben dem Countdown steht',
	'ACP_LANG_COUNT_AFTER'						=> 'Text der rechts neben dem Countdown steht',
	'ACP_LANG_COUNT_FINISH'						=> 'Text der angezeigt wird, wenn der Countdown abgelaufen ist',
	'ACP_LANG_TEXT_LANGUAGE'					=> 'Textsprache',
	'ACP_LANG_TEXT_LANGUAGE_EXPLAIN'			=> 'Wählen Sie  hier aus in welcher Sprache Sie die Text Position Speichern möchten.',
	'ACP_LANG_TEXT_ENTER'						=> 'Einagbe des Anzeige Textes',
	'ACP_LANG_TEXT_ENTER_EXPLAIN'				=> 'Geben Sie hier den Text an, den Sie in der oben eingestellten Textposition ausgeben lassen möchten.',
	'ACP_SAVE'									=> 'Speichern',
	'ACP_COUNTER_REFRESH'						=> 'Ansicht Aktualisieren',
	'ACP_COUNTER_MSG_CONFIRM_DELETE_ALL'		=> 'Sind Sie sicher das Sie alle Einträge für angelegte Texte aus der Datenbank löschen möchten. Beachten Sie bitte, das dies mehr rückgängig zu machen ist  und Sie dann die Texte komplett wieder neu anlegen müssen.',
]);
