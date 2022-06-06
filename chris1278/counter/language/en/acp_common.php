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
	'ACP_COUNTER_INSTRUCTIONS'					=> 'In order to use this extension optimally, set the desired target date and the desired target time. For e.g. <b>01.January.2025 at 12 o´clock</b> please set as follows:<br><br>seconds: 00<br>minutes: 00<br>hours: 12<br>days: 01<br>moth: 01<br>Year: 2025<br><br>After that, the countdown begins to count down to the desired datetime when you send it.',
	'ACP_COUNTER_ACTIVE'						=> 'Activate counters',
	'ACP_COUNTER_ACTIVE_EXPLAIN'				=> 'Select here whether you want to activate or deactivate the counter.',
	'ACP_COUNTER_SECOND'						=> 'Enter the second',
	'ACP_COUNTER_SECOND_EXPLAIN'				=> 'Enter the second here.',
	'ACP_COUNTER_MINUTE'						=> 'Enter the minute',
	'ACP_COUNTER_MINUTE_EXPLAIN'				=> 'Enter the minute here.',
	'ACP_COUNTER_HOUR'							=> 'Enter the hour',
	'ACP_COUNTER_HOUR_EXPLAIN'					=> 'Enter the hour here.',
	'ACP_COUNTER_DAY'							=> 'Enter the day',
	'ACP_COUNTER_DAY_EXPLAIN'					=> 'Enter the day here.',
	'ACP_COUNTER_MONTH'							=> 'Enter the month',
	'ACP_COUNTER_MONTH_EXPLAIN'					=> 'Enter the month here.',
	'ACP_COUNTER_YEAR'							=> 'Enter the year',
	'ACP_COUNTER_YEAR_EXPLAIN'					=> 'Enter the year here.',
	'ACP_COUNTER_PERMISSION_INFO_BOTH'			=> 'In the <a href="%1$s"><strong>User permissions</strong></a><strong>/</strong><a href="%2$s"><strong>Group permissions</strong></a> can be setting under <strong>Misc</strong> who can see the Counter.',
	'ACP_COUNTER_PERMISSION_INFO_USER'			=> 'In the <a href="%1$s"><strong>User permissions</strong></a> can be setting under <strong>Misc</strong> who can see the Counter.',
	'ACP_COUNTER_PERMISSION_INFO_GROUP'			=> 'In the <a href="%1$s"><strong>Group permissions</strong></a> can be setting under <strong>Misc</strong> who can see the Counter.',
	'ACP_COUNTER_TEXT'							=> 'Show countdown counter text',
	'ACP_COUNTER_TEXT_EXPLAIN'					=> 'Here you can set whether an output of above and below the countdown should take place at all.<br>If you do not want to output any text, only the time appears with information in the form of:<br><br><b>Example: </b> 1 year 1 day 1 hour 1 minute 1 second<br><br><b style="color: red">Information</b>: This does not apply to the text that is output at the end of the countdown. This is output in any case if it has been created.',
	'ACP_COUNTER_TEXT_OPT'						=> 'Variants of text output',
	'ACP_COUNTER_TEXT_OPT_EXPLAIN'				=> 'Here you can specify in which of the two variants you want to display the text for the countdown. The variants are possible:<br><br><b>Variant 1: </b>Text above the countdown and  Text below the countdown<br><b>Variant 2: </b>Text to the left of the countdown and Text to the right of the countdown<br><br><b>Default: </b>Variant 1',
	'ACP_COUNTER_TEXT_ABOVE_BELOW'				=> 'Variant 1',
	'ACP_COUNTER_TEXT_LEFT_RIGHT'				=> 'Variant 2',
	'ACP_INFO_COUNTER_TEXT_ENTER'				=> 'Brief information regarding the use of the "Manage Texts" option',
	'ACP_INFO_COUNTER_TEXT_ENTER_EXPLAIN'		=> 'Here you can manage the texts. You can create/edit and delete them. Erase either individually or all at once. If you want to overwrite created texts, you can do this by entering the same as when creating texts. Any existing texts are simply overwritten. No prior deletion is required for editing.<br><br><b style="color: red">additional info</b>: Depending on what you have selected for the <b>„Show countdown counter text“</b> switch, either all text positions are displayed (switch to Yes) or only the text that comes after the countdown when it has expired (switch to No). You should create this text or leave it blank. If no text is entered after the countdown has been reached, nothing will appear instead of the countdown. In other words, there is nothing left at that point, which is then treated as if the countdown is not there, i.e. the Ext is not activated.',
	'ACP_COUNTER_OVERVIEW'						=> 'Manage Texts',
	'ACP_TEXT_ENTER'							=> 'Entered text',
	'ACP_LANG_TEXT_POSITION'					=> 'Text position',
	'ACP_LANG_TEXT_POSITION_EXPLAIN'			=> 'Select the text position that you want to save here.',
	'ACP_LANG_COUNT_ABOVE'						=> 'Text above the countdown',
	'ACP_LANG_COUNT_BELOW'						=> 'Text below the countdown',
	'ACP_LANG_COUNT_BEFORE'						=> 'Text to the left of the countdown',
	'ACP_LANG_COUNT_AFTER'						=> 'Text to the right of the countdown',
	'ACP_LANG_COUNT_FINISH'						=> 'Text to be displayed when the countdown is over',
	'ACP_LANG_TEXT_LANGUAGE'					=> 'Text-language',
	'ACP_LANG_TEXT_LANGUAGE_EXPLAIN'			=> 'Select here in which language you would like to save the text position.',
	'ACP_LANG_TEXT_ENTER'						=> 'Enter the display text',
	'ACP_LANG_TEXT_ENTER_EXPLAIN'				=> 'Enter the text here that you would like to have displayed in the text position set above.',
	'ACP_SAVE'									=> 'Save',
	'ACP_COUNTER_REFRESH'						=> 'Refresh view',
	'ACP_COUNTER_MSG_CONFIRM_DELETE_ALL'		=> 'Are you sure you want to delete all entries for created texts from the database. Please note that this can be undone and that you then have to create the texts again from scratch.',
]);
