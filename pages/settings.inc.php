<?php

$page = rex_request('page', 'string');
$subpage = rex_request('subpage', 'string');
$func = rex_request('func', 'string');

// save settings
if ($func == 'update') {
	$settings = (array) rex_post('settings', 'array', array());

	rex_email_obfuscator_utils::replaceSettings($settings);
	rex_email_obfuscator_utils::updateSettingsFile();
}
?>

<div class="rex-addon-output">

<h2 class="rex-hl2">Informationen</h2>
<div class="rex-area-content">
<p>
Durch dieses Addon werden alle Email-Adressen automatisch so verschleiert, dass sie von Spambots nicht mehr erkannt werden k&ouml;nnen. Dabei ist es egal ob die Email-Adressen sich in einem Template oder einem Block/Modul befinden.<br /><br />

Email-Adressen k&ouml;nnen mit oder ohne Anchor-Tag angegeben werden. Die folgenden Bespiele sind also m&ouml;glich:<br />
</p>

<ol>
<li><i>foo@gmx.de</i><br /></li>
<li><i>&lt;a href="mailto:foo@gmx.de"&gt;Foo's EMail Adresse&lt;/a&gt;</i></li>
</ol>

<p>
Um die Email-Adressen zu sch&uuml;tzen, werden die Techniken "CSS display:none" und "ROT13 Encryption" angewendet. Diese k&ouml;nnen weiter unten ein- oder ausgeschaltet werden. Weitere Informationen zu den Techniken in diesem Artikel:<br />
<a class="extern" href="http://techblog.tilllate.com/2008/07/20/ten-methods-to-obfuscate-e-mail-addresses-compared/" target="_blank">Nine ways to obfuscate e-mail addresses compared</a>
</p>


</div>
</div>
<div class="rex-addon-output">
<h2 class="rex-hl2">Spamschutz w&auml;hlen</h2>
<div class="rex-area-content">
  <div class="rex-form">	
  <form action="index.php" method="post">
		<input type="hidden" name="page" value="email_obfuscator" />
	    <input type="hidden" name="subpage" value="" />
    	<input type="hidden" name="func" value="update" />
		<fieldset class="rex-form-col-1">
      <div class="rex-form-wrapper">
        <div class="rex-form-row">
		</div>
        <div class="rex-form-row">
          <p class="rex-form-checkbox rex-form-label-right">
			<input type="hidden" name="settings[javascriptmethod]" value="0" />
            <input class="rex-form-checkbox" type="checkbox" id="javascriptmethod" name="settings[javascriptmethod]" value="1" <?php if ($REX['ADDON']['email_obfuscator']['settings']['javascriptmethod']) {echo 'checked="checked"';} ?> />
            <label for="javascriptmethod">JavaScript ROT13 Encryption Methode</label>
          </p>
        </div>

        <div class="rex-form-row">
          <p class="rex-form-checkbox rex-form-label-right">
			<input type="hidden" name="settings[nojavascriptmethod]" value="0" />
            <input class="rex-form-checkbox" type="checkbox" id="nojavascriptmethod" name="settings[nojavascriptmethod]" value="1" <?php if ($REX['ADDON']['email_obfuscator']['settings']['nojavascriptmethod']) {echo 'checked="checked"';} ?> />
            <label for="nojavascriptmethod">CSS "display:none" Methode</i></label>
          </p>
          <p class="rex-form-label-right"><span id="css-hint">Benötigter Style: <code style="font-size: 12px;">span.hide { display: none; }</code></span></p>
        </div>
        <div class="rex-form-row">
			<p>
        		<input type="submit" class="rex-form-submit" name="sendit" value="Einstellungen speichern" />
          	</p>
		</div>
        
			</div>
    </fieldset>
  </form>
  </div>
</div>

</div>

<style type="text/css">
a.extern {
	background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAA8CAYAAACq76C9AAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAFFSURBVHjaYtTpO/CfAQcACCAmBjwAIIAY//9HaNTtP4hiCkAAMeGSAAGAAGJCl7hcaM8IYwMEEBMuCRAACCAmXBIgABBAKA5CBwABhNcrAAGEVxIggPBKAgQQXkmAAMIrCRBAeCUBAgivJEAA4ZUECCC8kgABhFcSIIDwSgIEEF5JgADCKwkQQHglAQIIryRAAOGVBAggvJIAAYRXEiCA8EoCBBBeSYAAwisJEEB4JQECiAVbNoABgADCqxMggPDmMoAAwpvLAAIIby4DCCC8uQwggPDmMoAAwpvLAAIIr1cAAgivJEAA4ZUECCC8kgABhFcSIIDwSgIEEF5JgADCKwkQQHglAQIIryRAAOGVBAggvJIAAYRXEiCA8EoCBBBeSYAAwisJEEB4JQECCK8kQADhlQQIILySAAGEVxIggPBKAgQYAARTLlfrU5G2AAAAAElFTkSuQmCC) no-repeat right 2px;
	padding-right: 10px;
}

#css-hint {
	display: none;
	margin-left: 53px;
	margin-top: 5px;
}

div.rex-form-row p.rex-form-label-right input.rex-form-checkbox {
	margin-left: 20px;
}

div.rex-form div.rex-form-row p input.rex-form-submit {
	margin-left: 0;
	margin-right: 5px;
	float: right; 
}
</style>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$( "#nojavascriptmethod").change(function() {
		if ($(this).is(':checked')) {
			$('#css-hint').css('display', 'block');
		} else {
			$('#css-hint').hide();
		}
	});

	$( "#nojavascriptmethod").change();
});
</script>
