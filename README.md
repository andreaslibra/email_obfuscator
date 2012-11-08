Protect My Email! Addon für REDAXO 4
====================================

Durch dieses REDAXO-Addon werden alle Email-Adressen automatisch so verschleiert, dass sie von Spambots nicht mehr erkannt werden können.

Momentan werden 2 Verschleierungs-Methoden zur Auswahl angeboten. Weitere sind geplant...

Download/Installation
---------------------

* Download hier unter _Download Packages_: https://github.com/RexDude/protect_my_email/downloads
* ZIP-Archiv entpacken und in `/redaxo/include/addons` kopieren, im Backend Addon dann installieren und aktivieren

Hinweise
--------

* Getestet mit REDAXO 4.4.1
* Addon-Ordner lautet: `protect_my_email`
* Die CSS Methode benötigt diesen Eintrag in Ihrem Stylesheet: `span.hide { display: none; }`
* Ab Version 1.2.2 wurden die `ins` Tags entfernt, das Sie für eine saubere Validierung nicht mehr nötig sind

Todo's
------

* Weitere Verschleierungs-Methoden zur Auswahl (CSS CodeDirection, einfaches @ durch [at] ersetzen, etc.)
* Manueller Converter: Im Backend kann Email-Adresse +  Verschleierungs-Methode ausgewählt werden. Addon spuckt fertigen Code zum rauskopieren aus.
* HTML5/XHTML Version umschaltbar/autom. erkennen (damit Output auch bei XHTML valide)?
* CSS Methode standardmäßig abschalten?
