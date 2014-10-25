<?php
$mypage = "email_obfuscator";

$REX['ADDON']['rxid'][$mypage] = '844';
$REX['ADDON']['name'][$mypage] = 'Email Obfuscator';
$REX['ADDON']['page'][$mypage] = $mypage;
$REX['ADDON']['version'][$mypage] = "1.6.0";
$REX['ADDON']['author'][$mypage] = "RexDude";
$REX['ADDON']['supportpage'][$mypage] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$mypage] = $mypage . "[]";
$REX['PERM'][] = $mypage . "[]";

// add lang file
if ($REX['REDAXO']) {
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/email_obfuscator/lang/');
}

// includes
require($REX['INCLUDE_PATH'] . '/addons/email_obfuscator/classes/class.rex_email_obfuscator_utils.inc.php');

// default settings (user settings are saved in data dir!)
$REX['ADDON']['email_obfuscator']['settings'] = array(
	'javascriptmethod' => true,
	'nojavascriptmethod' => false,
	'noscript_msg' => 'Bitte JavaScript aktivieren um die Email-Adresse sichtbar zu machen! / Please activate JavaScript to see email address!',
	'noscript_msg_string_table_key' => ''
);

// overwrite default settings with user settings
rex_email_obfuscator_utils::includeSettingsFile();

if (!$REX['REDAXO']) {
	require_once($REX['INCLUDE_PATH'] . '/addons/email_obfuscator/functions/functions_email_obfuscator.inc.php');

	rex_register_extension('OUTPUT_FILTER', 'rex_email_obfuscator', '', REX_EXTENSION_LATE);
}

