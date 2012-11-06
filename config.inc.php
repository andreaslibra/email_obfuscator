<?php
$mypage = "protect_my_email";

$REX['ADDON']['rxid'][$mypage] = '844';
$REX['ADDON']['name'][$mypage] = 'Protect My Email!';
$REX['ADDON']['page'][$mypage] = $mypage;
$REX['ADDON']['version'][$mypage] = "1.2.2";
$REX['ADDON']['author'][$mypage] = "WebDevOne";
$REX['ADDON']['supportpage'][$mypage] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$mypage] = $mypage . "[]";
$REX['PERM'][] = $mypage . "[]";

// --- DYN
$REX['ADDON']['protect_my_email']['javascriptmethod'] = '1';
	$REX['ADDON']['protect_my_email']['nojavascriptmethod'] = '1';
// --- /DYN

if (!$REX['REDAXO']) {
	require_once($REX['INCLUDE_PATH'] . '/addons/protect_my_email/functions/functions_protect_my_email.inc.php');
	rex_register_extension('OUTPUT_FILTER', 'rex_protect_my_email');
}
?>
