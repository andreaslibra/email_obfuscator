<?php
$page = rex_request('page', 'string');
$subpage = rex_request('subpage', 'string');
$func = rex_request('func', 'string');
$javascriptmethod = rex_request('javascriptmethod', 'string');
$nojavascriptmethod = rex_request('nojavascriptmethod', 'string');

if (empty($javascriptmethod)) {
	$javascriptmethod = '0';
}

if (empty($nojavascriptmethod)) {
	$nojavascriptmethod = '0';
}

if ($func == "update") {
	$REX['ADDON']['protect_my_email']['javascriptmethod'] = $javascriptmethod;
	$REX['ADDON']['protect_my_email']['nojavascriptmethod'] = $nojavascriptmethod;
	
	$content = '
	$REX[\'ADDON\'][\'protect_my_email\'][\'javascriptmethod\'] = \''.$javascriptmethod.'\';
	$REX[\'ADDON\'][\'protect_my_email\'][\'nojavascriptmethod\'] = \''.$nojavascriptmethod.'\';
	';
	
	$file = $REX['INCLUDE_PATH']."/addons/protect_my_email/config.inc.php";
	rex_replace_dynamic_contents($file, $content);
	
	echo rex_info('Einstellungen wurde aktualisiert.');
}
?>

<div class="rex-addon-output">

<h2 class="rex-hl2">Informationen</h2>
<div class="rex-area-content">
<p>
Durch dieses Addon werden alle Email-Adressen automatisch so verschleiert, dass sie von Spambots nicht mehr erkannt werden k&ouml;nnen. Dabei ist es egal ob die Email-Adressen sich in einem Template oder einem Block/Modul befinden.<br /><br />

Email-Adressen k&ouml;nnen mit oder ohne Anchor-Tag angegeben werden. Die folgenden Bespiele sind also m&ouml;glich:<br />

<ol>
<li><i>foo@gmx.de</i><br /></li>
<li><i>&lt;a href="mailto:foo@gmx.de"&gt;Foo's EMail Adresse&lt;/a&gt;</i></li>
</ol>

Um die Email-Adressen zu sch&uuml;tzen, werden die Techniken "CSS display:none" und "ROT13 Encryption" angewendet. Diese k&ouml;nnen weiter unten ein- oder ausgeschaltet werden. Weitere Informationen zu den Techniken in diesem Artikel:<br />
<a class="extern" href="http://techblog.tilllate.com/2008/07/20/ten-methods-to-obfuscate-e-mail-addresses-compared/" target="_blank">Nine ways to obfuscate e-mail addresses compared</a>
</p>

<br />

<p><strong>Wichtig:</strong> Die CSS Methode benötigt diesen Eintrag in Ihrem Stylesheet: <code style="font-size: 12px;">.hide { display: none; }</code></p>


</div>
</div>
<div class="rex-addon-output">
<h2 class="rex-hl2">Spamschutz w&auml;hlen</h2>
<div class="rex-area-content">
  <div class="rex-form">	
  <form action="index.php" method="get">
		<input type="hidden" name="page" value="protect_my_email" />
	    <input type="hidden" name="subpage" value="" />
    	<input type="hidden" name="func" value="update" />
		<fieldset class="rex-form-col-1">
      <div class="rex-form-wrapper">
        <div class="rex-form-row">
		</div>
        <div class="rex-form-row">
          <p class="rex-form-checkbox rex-form-label-right">
            <input class="rex-form-checkbox" type="checkbox" id="javascriptmethod" name="javascriptmethod" value="1" <?php if ($REX['ADDON']['protect_my_email']['javascriptmethod'] == '1') {echo 'checked="checked"';} ?> />
            <label for="javascriptmethod">ROT13 Encryption Methode (JavaScript)</label>
          </p>
        </div>

        <div class="rex-form-row">
          <p class="rex-form-checkbox rex-form-label-right">
            <input class="rex-form-checkbox" type="checkbox" id="nojavascriptmethod" name="nojavascriptmethod" value="1" <?php if ($REX['ADDON']['protect_my_email']['nojavascriptmethod'] == '1') {echo 'checked="checked"';} ?> />
            <label for="nojavascriptmethod">CSS "display:none" Methode (wenn JavaScript deaktiviert)</label>
			<br /><br />
			
	</p>
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
</style>
