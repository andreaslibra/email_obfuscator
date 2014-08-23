<?php
// check redaxo version
if (version_compare($REX['VERSION'] . '.' . $REX['SUBVERSION'] . '.' . $REX['MINORVERSION'], '4.4.1', '<=')) {
	// version incorrect
	$REX['ADDON']['installmsg']['email_obfuscator'] = 'Dieses AddOn benötigt REDAXO Version 4.5.0 oder höher.'; 
} else {
	$REX['ADDON']['install']['email_obfuscator'] = 1;
}

