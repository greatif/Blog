# Blog für REDAXO
Das AddOn stellt ein einfaches Blog-System zur Verfügung.
Es handelt sich dabei um die Überführung von ursprünglich zwei Modulen in ein Addon.
Entsprechend werden überwiegend bereits bestehende REDAXO-AddOns und -ressourcen genutzt bzw. vorausgesetzt.
Als Editor wird [CKEditor 5](https://github.com/FriendsOfREDAXO/cke5) verwendet, die Ausgabe der Galerie erfolgt über PhotoSwipe.
Zur Generierung des RSS-Feeds dient eine modifizierte Version aus den [R-Tricks](https://friendsofredaxo.github.io/tricks/module/minibeispiel_rss-feed).
Die Bereitstellung von PDF-Dateien erfolgt über das AddOn [PDFout](https://github.com/FriendsOfREDAXO/pdfout).
Die notwendigen PhotoSwipe-Dateien, die sich im Verzeichnis "assets" befinden, müssen z. Zt. noch manuell eingebunden werden.

![blog](https://user-images.githubusercontent.com/8527203/44779535-0900a180-ab80-11e8-9732-2ae2d719da01.png)

[Blog-Beispiel](https://greatif.de/blog/)

## Funktionen

- Anlegen von Blog-Eintägen mit Informationen zum Autor
- Eigene Meta-Informationen "Title", "Description" und "Cannonical Link" für jeden Eintrag
- Eigendes Titelbild für jeden Beitrag
- Galerie-Funktion
- Youtube-Einbindung
- RSS-Funktion
- SocialSharing-Funktion
- PDF-Ausgabe
- Kommentar-Funktion
- Artikel-Status: online, offline, Arbeitsversion
- Teaser-Funktion

## Voraussetzungen

- YForm 2.3
- YCom 2.1
- YRewrite 2.3
- URL 1.0.1
- PHPMailer 2.0.1
- CKEditor 5 2.1
- PDFOut 1.4.2
- Auth-PlugIn
- Group-PlugIn
- PhotoSwipe

## Unterstützt
- [LazyLoad-AddOn](https://github.com/eaCe/lazyload)
- [Hyphenator-AddOn](https://github.com/FriendsOfREDAXO/hyphenator)

## Änderungen

siehe [CHANGELOG.md](https://github.com/greatif/blog/blob/master/CHANGELOG.md)

## Autor

**greatif**

* http://www.greatif.de
* https://github.com/greatif
