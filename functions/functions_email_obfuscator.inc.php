<?php
function rex_email_obfuscator($params) {
	global $REX;
	$content = $params['subject'];
	
	$javascriptmethod = $REX['ADDON']['email_obfuscator']['javascriptmethod'];
	$nojavascriptmethod = $REX['ADDON']['email_obfuscator']['nojavascriptmethod'];
	$atPos = strpos($content, '@');
	
	if ($atPos === false || ($javascriptmethod == '0' && $nojavascriptmethod == '0')) {
		// nothing to do
		return $content;
	}
	
	// wrap anchor tag around email-adresses that don't have already an anchor tag around them
	$content = make_clickable($content);
	
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
	$exploded_email = explode("@", $email);
	
	if ($javascriptmethod == '1' && $nojavascriptmethod == '0') {
		if (isset($REX['ADDON']['email_obfuscator']['noscript_msg_string_table_key']) && $REX['ADDON']['email_obfuscator']['noscript_msg_string_table_key'] != '' && class_exists('rex_string_table')) {
			$noscriptMsg = rex_string_table::getString($REX['ADDON']['email_obfuscator']['noscript_msg_string_table_key']);
		} else {
			if (isset($REX['ADDON']['email_obfuscator']['noscript_msg'])) {
				$noscriptMsg = $REX['ADDON']['email_obfuscator']['noscript_msg'];
			} else {
				// fallback for older versions
				$noscriptMsg = 'Bitte JavaScript aktivieren um die Email-Adresse sichtbar zu machen! / Please activate JavaScript to see email address!';
			}
		}
		// HTML5
		$encoded .= '<noscript><em>&gt;&gt;&gt; ' . $noscriptMsg . ' &lt;&lt;&lt;</em></noscript>';
	} else {
		if ($javascriptmethod == '1' && $nojavascriptmethod == '1') {
			// HTML5
			$encoded .= '<noscript>';
		}

		// make cryptic strings
		$string_snippet = strtolower(str_rot13(preg_replace("/[^a-zA-Z]/", "", $email)));
		$cryptValues = str_split($string_snippet, 5);
		
		if ($nojavascriptmethod == '1') {
			$encoded .= "<span class=\"hide\">" . $cryptValues[0] . "</span>" . $exploded_email[0] . "<span class=\"hide\">" . strrev($cryptValues[0]) . "</span>[at]<span class=\"hide\">" . $cryptValues[0] . "</span>" . $exploded_email[1];
		}
		
		
		if ($javascriptmethod == '1' && $nojavascriptmethod == '1') {
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

// found here: http://zenverse.net/php-function-to-auto-convert-url-into-hyperlink/
function make_clickable($ret) {
	$ret = ' ' . $ret;
	// in testing, using arrays here was found to be faster
	$ret = preg_replace_callback('#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', '_make_email_clickable_cb', $ret);
 
	// this one is not in an array because we need it to run last, for cleanup of accidental links within links
	$ret = preg_replace("#(<a( [^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i", "$1$3</a>", $ret);
	$ret = trim($ret);

	return $ret;
}

function _make_email_clickable_cb($matches) {
	$email = $matches[2] . '@' . $matches[3];

	return $matches[1] . "<a href=\"mailto:$email\">$email</a>";
}
