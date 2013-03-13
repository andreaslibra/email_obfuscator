<?php
$mypage = "email_obfuscator";

$REX['ADDON']['rxid'][$mypage] = '844';
$REX['ADDON']['name'][$mypage] = 'Email Obfuscator';
$REX['ADDON']['page'][$mypage] = $mypage;
$REX['ADDON']['version'][$mypage] = "1.2.2";
$REX['ADDON']['author'][$mypage] = "WebDevOne";
$REX['ADDON']['supportpage'][$mypage] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$mypage] = $mypage . "[]";
$REX['PERM'][] = $mypage . "[]";

// --- DYN
$REX['ADDON']['email_obfuscator']['javascriptmethod'] = '1';
$REX['ADDON']['email_obfuscator']['nojavascriptmethod'] = '0';
// --- /DYN

if (!$REX['REDAXO']) {
	require_once($REX['INCLUDE_PATH'] . '/addons/email_obfuscator/functions/functions_email_obfuscator.inc.php');
	rex_register_extension('OUTPUT_FILTER', 'rex_email_obfuscator');
}
?>
