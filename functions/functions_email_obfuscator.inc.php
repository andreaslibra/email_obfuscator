<?php
function rex_email_obfuscator($params) {
	global $REX;
	$content = $params['subject'];
	
	$javascriptmethod = $REX['ADDON']['email_obfuscator']['javascriptmethod'];
	$nojavascriptmethod = $REX['ADDON']['email_obfuscator']['nojavascriptmethod'];
	
	if ($javascriptmethod == '0' && $nojavascriptmethod == '0') {
		// nothing to do
		return $content;
	}
	
	// wrap anchor tag around email-adresses that don't have already an anchor tag around them
	$content = preg_replace("#([\s\n])([a-z0-9\-_.]+)@([a-z0-9\-_.]+)\.([^,< \n\r]+)#i", "$1<a href=\"mailto:$2@$3.$4\">$2@$3.$4</a>", $content); 
	
	// replace all email addresses (now all wrapped in anchor tag) with spam aware version
	$content = preg_replace_callback('`\<a([^>]+)href\=\"mailto\:([^">]+)\"([^>]*)\>(.*?)\<\/a\>`ism', function ($m) {
		return encode_email($m[2], $m[4]);
    }, $content);
	
	// done!
	return $content;
}

function encode_email($email, $text = "") {
	global $REX;
	if (empty($text)) {
		$text = $email;
	}
	
	$javascriptmethod = $REX['ADDON']['email_obfuscator']['javascriptmethod'];
	$nojavascriptmethod = $REX['ADDON']['email_obfuscator']['nojavascriptmethod'];
	
	if ($javascriptmethod == '1') {
		// javascript version
		$encoded_mail_tag = str_rot13('<a href=\\"mailto:' . $email . '\\">' . $text . '</a>');
		$encoded = "<script type=\"text/javascript\">";
		$encoded .= "/* <![CDATA[ */";
		$encoded .= "document.write(\"" . $encoded_mail_tag . "\".replace(/[a-zA-Z]/g, function(c){return String.fromCharCode((c<=\"Z\"?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);}));";
		$encoded .= "/* ]]> */";
		$encoded .= "</script>";
	}
	
	// for users who have javascript disabled
	//$email = substr($email, 0, strpos($email, "\\"));
	$exploded_email = explode("@", $email);
	
	if ($javascriptmethod == '1' && $nojavascriptmethod == '00') {
		// XHTML
		//$encoded .= '<ins style="text-decoration:inherit"><noscript><ins style="text-decoration:inherit">Bitte JavaScript aktivieren um die Email-Adresse sichtbar zu machen!</ins></noscript></ins>';

		// HTML5
		$encoded .= '<noscript><em>&gt;&gt;&gt; Bitte JavaScript aktivieren um die Email-Adresse sichtbar zu machen! &lt;&lt;&lt;</em></noscript>';
	} else {
		if ($javascriptmethod == '1' && $nojavascriptmethod == '1') {
			// XHTML
			// $encoded .= '<ins style="text-decoration:inherit"><noscript><ins style="text-decoration:inherit">';
	
			// HTML5
			$encoded .= '<noscript>';
		}

		// make cryptic strings
		$string_snippet = strtolower(str_rot13(preg_replace("/[^a-zA-Z]/", "", $email)));
		$cryptValues = str_split($string_snippet, 5);
		
		if ($nojavascriptmethod == '1') {
			//$encoded .= "<style type=\"text/css\"> span.hide { display: none; } </style>";
			$encoded .= "<span class=\"hide\">" . $cryptValues[0] . "</span>" . $exploded_email[0] . "<span class=\"hide\">" . strrev($cryptValues[0]) . "</span>[at]<span class=\"hide\">" . $cryptValues[0] . "</span>" . $exploded_email[1];
		}
		
		
		if ($javascriptmethod == '1' && $nojavascriptmethod == '1') {
			// XHTML
			// $encoded .= "</ins></noscript></ins>";
	
			// HTML5
			$encoded .= '</noscript>';
		}
	}
	
	return $encoded;
}

function get_random_val() {
	// returns radom value, used for non-javascript version
	return preg_replace('/([ ])/e', 'chr(rand(97,122))', '    ');
}

