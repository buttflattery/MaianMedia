<?php

/*------------------------------------------
  MAIAN MUSIC v1.3
  Geschrieben von David Ian Bennett
  E-Mail: support@maianscriptworld.co.uk
  Webseite: www.maianscriptworld.co.uk
  Diese Datei: Deutsche Sprachdatei
-------------------------------------------*/

/******************************************************************************************************
 * SPRACHDATEI - BITTE LESEN                                                                          *
 * Dies ist eine Sprachdatei f&uuml;r das Maian Music-Script. Bearbeiten Sie es, um es an Ihre Bed&uuml;rfnisse *
 * anzupassen.                                                                                        *
 * Bearbeiten Sie NICHT die $lang[]-Variablennamen in irgendeiner Form und geben Sie acht, dass Sie   * 
 * nicht aus Versehen eines der einfachen Anf&uuml;hrungszeichen ('), zwischen denen die Variablen-        *
 * informationen enthalten sind, entfernen. Dies w&uuml;rde einen Funktionsfehler des Scripts verursachen. *
 * VERWENDUNG VON EINFACHEN ANF&Uuml;HRUNGSZEICHEN (')                                                *
 * Wenn Sie ein einfaches Anf&uuml;hrungszeichen (') in den Variableninformationen verwenden wollen,       *
 * m&uuml;ssen Sie ein backslash (\) vor dem einfachen Anf&uuml;hrungszeichen einf&uuml;gen, z.B.: d\'apostrophe*
 * SYSTEM-VARIABLEN                                                                                   *
 * Variablen, welche ein Zeichen und ein Prozentzeichen enthalten und Variablen zwischen geschweiften * 
 * Klammern, sind Systemvariablen z.B.: %d, %s, {count} usw.                                          *
 * Das System w&uuml;rde zwar nicht ausfallen, falls diese gel&ouml;scht werden, aber die Darstellung der       *
 * Sprache w&auml;re fehlerhaft.                                                                           *
 ******************************************************************************************************/
 
 /*------------------------------------------
  Deutsche &Uuml;bersetzung
  Autor: Michael Stader
  E-Mail: info@samplepark.com
  Webseite: www.samplepark.com
-------------------------------------------*/

/*---------------------------------------------
  ZEICHENSATZ
  Zum encodieren der HTML Zeichen
  Unless specified in language file,
  this may not need altering.
----------------------------------------------*/

define( '_msg_charset','iso-8859-1');

$_msg_author = 'Michael Stader';
$_msg_website  = 'http://www.samplepark.com/';

/*--------------------------------------
  INC/HEADER.PHP
  -------------------------------------*/
  
define( '_msg_public_header','Unser Musik-Download-Shop @ {website}');  
define( '_msg_public_header2','Artikel im Warenkorb');
define( '_msg_public_header3','Beliebteste');
define( '_msg_public_header4','Musik');
define( '_msg_public_header5','Kontakt');
define( '_msg_public_header6','&Uuml;ber');
define( '_msg_public_header7','Suche');
define( '_msg_public_header8','Keywords');
define( '_msg_public_header9','Premium Beat Flash Player');
define( '_msg_public_header10','In diesem System wird der <br />Premium Beat Flash Player<br /><b>&copy); Premium Beat.com</b> verwendet');
define( '_msg_public_header11','Artikel im Warenkorb');
define( '_msg_public_header12','Lizenz');
define( '_msg_public_header13','MP3-Titel zum Download aus unserem Musik-Shop.');
define( '_msg_public_header14','mp3,downloads,albums,tracks,music,music store');
define( '_msg_public_header15','Beliebtester Text');



/*--------------------------------------
  TEMPLATES/ALBUM.TPL.PHP
  -------------------------------------*/
  
define( '_msg_publicalbum','Titel probeh&ouml;ren/kaufen');  
define( '_msg_publicalbum2','Zum Probeh&ouml;ren oder zum Erwerb von Titeln klicken Sie bitte entsprechende Buttons an. Sie k&ouml;nnen gerne auch mehrere Titel in den Warenkorb hinzuf&uuml;gen, bevor Sie Ihre Bestellung aufgeben. Vielen Dank!');
define( '_msg_publicalbum3','Probeh&ouml;ren');
define( '_msg_publicalbum4','In Warenkorb hinzuf&uuml;gen');
define( '_msg_publicalbum5','Name des Titels');
define( '_msg_publicalbum6','Kosten');
define( '_msg_publicalbum7','In Warenkorb hinzuf&uuml;gen');
define( '_msg_publicalbum8','Alle Titel in Warenkorb hinzuf&uuml;gen');
define( '_msg_publicalbum9','Ausgew&auml;hlte Titel in Warenkorb hinzuf&uuml;gen');
define( '_msg_publicalbum10','Titel probeh&ouml;ren');
define( '_msg_publicalbum11','Titel');
define( '_msg_publicalbum12','Diese Seite wurde bereits <b>{count}</b> mal aufgerufen.');
define( '_msg_publicalbum13','Rabatt <b>{amount}</b> %');
define( '_msg_publicalbum14','Dazugeh&ouml;rige Alben');


/*--------------------------------------
  TEMPLATES/CART.TPL.PHP
  -------------------------------------*/
  
define( '_msg_cart','Warenkorb');
define( '_msg_cart2','Die Artikel Ihres aktuellen Warenkorbs werden unten dargestellt. Bereits gew&auml;hlte Artikel k&ouml;nnen Sie mithilfe der Buttons aus Ihrem Warenkorb auch wieder herausl&ouml;schen. Wenn Sie mit Ihrer Auswahl jedoch zufrieden sind, klicken Sie bitte auf \'Kasse\' um mit dem Bestellvorgang fortzufahren:');  
define( '_msg_cart3','Es befinden sich derzeit 0 Artikel in Ihrem Warenkorb.');
define( '_msg_cart4','{count} Artikel im Warenkorb');
define( '_msg_cart5','Gesamt');
define( '_msg_cart6','Warenkorb leeren');
define( '_msg_cart7','Kasse');
define( '_msg_cart8','Von:');
define( '_msg_cart9','Sie sparen {discount}%');


/*--------------------------------------
  TEMPLATES/CONTACT.TPL.PHP
  -------------------------------------*/

define( '_msg_contact','<div id="mm_contact">Bei technischen Problemen oder Fragen zu unserem Musikangebot nutzen Sie zur Kontaktaufnahme bitte folgendes Formular:</div>');
define( '_msg_contact2','Ihre Anfrage an uns');
define('_msg_contact3','Betreff');
define('_msg_contact4','Kommentar');
define('_msg_contact5','Nachricht senden');
define('_msg_contact6','Bitte geben Sie Ihren Betreff an...');
define('_msg_contact7','Bitte geben Sie Ihren Kommentar ein...');
define('_msg_contact8','Ihre Nachricht wurde versendet.<br /><br />Sie werden von uns fr&uuml;hstm&ouml;glich eine Antwort auf Ihre Anfrage erhalten.');
define('_msg_contact9','Name');
define('_msg_contact10','E-Mail-Adresse');
define('_msg_contact11','Geben Sie den Code ein');
define('_msg_contact12','Ung&uuml;ltiger Code, bitte versuchen Sie es noch einmal...');
define('_msg_contact13','Vielen Dank!');
define('_msg_contact14','Die Nachricht wurde versendet!');
define('_msg_contact15','Bitte geben Sie Ihren Namen an...');
define('_msg_contact16','Bitte geben Sie eine g&uuml;ltige E-Mail-Adresse an...');
define('_msg_contact17','Klicken Sie zum Aktualisieren bitte auf "Captcha"');


/*--------------------------------------
  TEMPLATES/CONTACT.TPL.PHP
  -------------------------------------*/
  
define('_msg_publichome','Vielen Dank f&uuml;r Ihr Interesse an unserer Musik. Unter Musik-Shop im linken Men&uuml; der Seite finden Sie die komplette Auswahl unseres Musikangebots. Sie k&ouml;nnen sowohl einzelne Titel als auch ganze Alben bestellen. Auch das Probeh&ouml;ren der St&uuml;cke ist vor dem Kauf m&ouml;glich.<br /><br />Der Bezahlvorgang wird sicher per Paypal abgewickelt. Sie ben&ouml;tigen dabei nicht zwingend einen eigenen Paypal-Account, sondern die Bezahlung kann auch per Kreditkarte &uuml;ber Paypal erfolgen.<br /><br />Bitte kontaktieren Sie uns, falls weitere Fragen bestehen. Vielen Dank!');  
define('_msg_publichome2','Alle Kreditkarten die von Paypal akzeptiert werden');
define('_msg_publichome3','Beliebteste Titel');
define('_msg_publichome4','Beliebteste Alben');


/*--------------------------------------
  TEMPLATES/DOWNLOAD_ITEM.TPL.PHP
  -------------------------------------*/


define('_msg_downloaditem','<br /><br /><span class="sorry">Leider ist die Verf&uuml;gbarkeit dieses Downloads abgelaufen!</span><br /><br /><br />Bitte nehmen Sie mit uns Kontakt auf<br />um erneut Zugriff auf den Download zu erhalten.');  
define('_msg_downloaditem2','<br /><br /><span class="sorry">Fehler!</span><br /><br /><span class="sorry_msg">Sie haben keine Berechtigung<br />diese Seite aufzurufen!</span><br /><br /><br />Bitte nehmen Sie mit uns Kontakt auf<br />wenn Sie denken, dass es sich hierbei um einen Fehler handelt.');  


/*--------------------------------------
  TEMPLATES/MUSIC.TPL.PHP
  -------------------------------------*/

define('_msg_music','Bitte klicken Sie auf die Links, um weiterf&uuml;hrende Informationen &uuml;ber ein Album zu erhalten und um Titel probezuh&ouml;ren oder zu bestellen. Vielen Dank!');
define('_msg_music2','Mehr Informationen');
define('_msg_music3','Titel: {count}');


/*--------------------------------------
  TEMPLATES/PAYPAL/CANCEL.TPL.PHP
  TEMPLATES/PAYPAL/CHECKOUT.TPL.PHP
  TEMPLATES/PAYPAL/DOWNLOAD.TPL.PHP
  TEMPLATES/PAYPAL/ERROR.TPL.PHP
  TEMPLATES/PAYPAL/THANKS.TPL.PHP
  -------------------------------------*/
  
define('_msg_paypal','Verbindung zum Paypal-Server.....Bitte warten....');  
define('_msg_paypal2','Musik-Shop Angebote');
define('_msg_paypal3','Transaktion abgebrochen!');
define('_msg_paypal4','Ihre Transaktion wurde erfolgreich abgebrochen. Eine Bezahlung ist nicht erfolgt.<br /><br />Vielen Dank f&uuml;r Ihr Interesse an unserem Musikangebot.');
define('_msg_paypal5','Ung&uuml;ltige Transaktion!');
define('_msg_paypal6','Dies scheint eine fehlerhafte Transaktion zu sein, da der Zahlungsbetrag nicht mit dem Wert des Warenkorbs &uuml;bereinstimmt.<br /><br />Dem Webmaster wurde &uuml;ber diesen Vorgang informiert und wird darauf entsprechned reagieren.<br /><br />Wenn Sie denken, dass es sich hierbei um einen Fehler handelt, informieren Sie uns bitte &uuml;ber den Kontakt-Link im linken Men&uuml;bereich.<br /><br />Vielen Dank!');
define('_msg_paypal7','Vielen Dank!');
define('_msg_paypal8','Ihre Transaktion wurde erfolgreich abgeschlossen.<br /><br />Bitte &uuml;berpr&uuml;fen Sie den Posteingang in Ihrer E-Mail-Box unter "<b>{email}</b>". Dort finden Sie unsere Best&auml;tigungs-E-Mail mit dem Download-Link f&uuml;r Ihre bestellten Musiktitel. Bitte klicken Sie auf diesen Link, um zur Download-Seite zu gelangen. Falls Sie von uns keine E-Mail erhalten haben sollten informieren Sie uns bitte &uuml;ber den Kontakt-Link im linken Men&uuml;bereich.<br /><br />Wir w&uuml;nschen Ihnen viel Spa&szlig; beim H&ouml;ren der von Ihnen erworbenen Musiktitel, <br /><br /><b>{store}</b>');
define('_msg_paypal9','Es ist ein Fehler aufgetreten!');
define('_msg_paypal10','Leider haben Sie keine Berechtigung um auf diese Seite zuzugreifen.');  
define('_msg_paypal11','Es wurden keine Bestellinformationen gefunden. Bitte &ouml;ffnen Sie den Download-Link in Ihrer E-Mail-Best&auml;tigung per Doppelklick.<br/><br />Wenn Sie denken, dass es sich hierbei um einen Fehler handelt, informieren Sie uns bitte &uuml;ber den Kontakt-Link im linken Men&uuml;bereich.<br /><br />Vielen Dank!');                 
define('_msg_paypal12','Download-Seite nicht mehr verf&uuml;gbar!');
define('_msg_paypal13','Die Verf&uuml;gbarkeit dieses Links ist abgelaufen und kann nicht mehr aufgerufen werden. Um Missbrauch zu vermeiden, begrenzt das System automatisch die Anzahl der Zugriffe auf die Downloadseite.<br /><br />Falls Sie erneut Zugriff auf den Download-Link ben&ouml;tigen informieren Sie uns bitte &uuml;ber den Kontakt-Link im linken Men&uuml;bereich. Wir werden den Link dann wieder zum Download freischalten.<br /><br />Wir entschuldigen uns f&uuml;r Ihre Unannehmlichkeiten,<br /><br /><b>{store}</b>');
define('_msg_paypal14','Download-Seite');
define('_msg_paypal15','Danke f&uuml;r Ihre Bestellung, unten werden Ihre Download-Links angezeigt.<br /><br />Bitte laden Sie diese Seite <b>NICHT</b> erneut und setzen Sie <b>KEIN</b> Bookmark auf diese Seite, da es sich um eine nur tempor&auml;r verf&uuml;gbare Download-Seite handelt.<br /><br />Es ist gestattet jede Musik-Datei {duration} herunterzuladen. Falls Probleme beim Download auftreten sollten, informieren Sie uns bitte &uuml;ber den Kontakt-Link im linken Men&uuml;.');                              
define('_msg_paypal16','einmal');
define('_msg_paypal17','zweimal');
define('_msg_paypal18','mal');
define('_msg_paypal19','Bestellte Alben');
define('_msg_paypal20','Bestellte Titel');
define('_msg_paypal21','Es liegt keine Bestellung eines Albums vor.');
define('_msg_paypal22','Es liegt keine Bestellung eines Titels vor.');
define('_msg_paypal23','Wir w&uuml;nschen ihnen viel Spa&szlig; beim H&ouml;ren Ihrer neuen Musik!');
define('_msg_paypal24','Download Titel');
define('_msg_paypal25','Download Artwork');
define('_msg_paypal26','Download Titel');
define('_msg_paypal27','Diese Datei existiert nicht!');
define('_msg_paypal28','Alle Titel =');
define('_msg_paypal29','Klicken Sie den Button (bzw. die Buttons) zum Download an!');
define('_msg_paypal30','Zur&uuml;ck zur vorherigen Seite');
define('_msg_paypal31','Download nicht mehr verf&uuml;gber');


/*--------------------------------------
  TEMPLATES/SEARCH.TPL.PHP
  -------------------------------------*/

define('_msg_publicsearch','Suchergebnisse');
define('_msg_publicsearch2','Das Ergebnis Ihrer Suche nach "<b>{keywords}</b>" wird unten dargestellt. Falls kein Ergebnis gefunden werden konnte starten Sie Ihre Suche gegebenenfalls erneut mit mehreren Schl&uuml;sselbegriffen (welche durch Leerzeichen getrennten sein m&uuml;ssen).');
define('_msg_publicsearch3','<br /><b>Kein Ergebnis gefunden... Bitte versuchen Sie es erneut...</b>');
define('_msg_publicsearch4','{count} Suchergebnisse');


/*--------------------------------------
  ADMIN/INC/HEADER.PHP
  -------------------------------------*/

define('_msg_header','Administration');
define('_msg_header2','&Uuml;ber');  
define('_msg_header3','Einstellungen');  
define('_msg_header4','Verwaltung der Alben');  
define('_msg_header5','Neuen Titel hinzuf&uuml;gen');  
define('_msg_header6','Verwaltung der Titel');  
define('_msg_header7','Verk&auml;ufe');  
define('_msg_header8','Suche nach Verk&auml;ufen'); 
define('_msg_header9','Navigationsmen&uuml;');
define('_msg_header10','Kategorien'); 
define('_msg_header11','Statistik');
  
  
/*--------------------------------------
  ADMIN/INC/FOOTER.PHP
  TEMPLATES/FOOTER.TPL.PHP
  -------------------------------------*/

define('_msg_footer','Copyright');
define('_msg_footer2','Alle Rechte vorbehalten');  
define('_msg_footer3','Bitte aktivieren Sie Javascript in Ihrem Browser. Vielen Dank!');


/*--------------------------------------
  ADMIN/DATA_FILES/ADD.PHP
  -------------------------------------*/
  
define('_msg_add','Hier k&ouml;nnen Sie Ihre MP3/MP4-Titel hinzuf&uuml;gen. Stellen Sie vor dem Hinzuf&uuml;gen sicher, dass der Titel und die dazugeh&ouml;rige H&ouml;rprobe in den von ihnen festgelegten Verzeichnissen vorhanden sind. Erfassen Sie &uuml;ber die folgende Drop-down-Auswahlbox die Anzahl der Titel die hinzugef&uuml;gt werden sollen und geben Sie anschlie&szlig;end Details zu den einzelnen Titeln ein. Falls Sie nicht sicher sind, was Sie eintragen sollen, helfen Ihnen die [<b><span style="color:#FF7700">?</span></b>] Kurzinfo-Links entsprechend weiter.<br><br><i>Es ist anzumerken, dass ein Titel NICHT hinzugef&uuml;gt wird, wenn KEIN Name des Titels oder KEIN Verzeichnispfad (MP3-Dateien) oder KEINE Kosten angegeben werden.</i>');  
define('_msg_add2','Titel welche hinzugef&uuml;gt werden sollen');
define('_msg_add3','Wieviele Titel m&ouml;chten Sie hinzuf&uuml;gen. <i>Sie k&ouml;nnen diese Seite beliebig oft neu laden, ohne dass Ihre Formular-Eingaben verloren gehen</i>.');
define('_msg_add4','Titel');
define('_msg_add5','Titel hinzuf&uuml;gen');
define('_msg_add6','Name des Titels');
define('_msg_add7','zu Album hinzuf&uuml;gen');
define('_msg_add8','Titel Verzeichnispfad');
define('_msg_add9','H&ouml;rprobe Verzeichnispfad');
define('_msg_add10','Spieldauer des Titels');
define('_msg_add11','Kosten');
define('_msg_add12','einzeln erwerbbar');
define('_msg_add13','<b>{count}</b> Titel wurden erfolgreich hinzugef&uuml;gt. Im Folgenden k&ouml;nnen die Titel verwaltet werden');
define('_msg_add14','Anzeige ');
define('_msg_add15',' f&uuml;r alle Titel.');


/*--------------------------------------
  ADMIN/DATA_FILES/ALBUMS.PHP
  -------------------------------------*/
  
define('_msg_albums','Musik-Titel sind in Alben eingruppiert. Beim Hinzuf&uuml;gen m&uuml;ssen die Titel einem Album zugeordnet werden. Besucher des Musik-Shops k&ouml;nnen einzelne Titel oder auch komplette Alben bestellen. Sobald Sie ein neues Album anlegen erscheint dies im Folgenden.');  
define('_msg_albums2','Album');
define('_msg_albums3','Name des Album');
define('_msg_albums4','Aktuelle Alben -- Klicken Sie zum Bearbeiten auf den Namen');
define('_msg_albums5','Album-Bild URL');
define('_msg_albums20','Alben');
//define('_msg_albums21','H&ouml;he:');
//define('_msg_albums22','Breite:');
define('_msg_albums6','Album Artwork (Zip File)');
define('_msg_albums7','Kommentar/Info');
define('_msg_albums8','Freigabe des Albums');
define('_msg_albums9','Derzeit sind 0 Alben in der Datenbank hinterlegt.');
define('_msg_albums10','Album bearbeiten');
define('_msg_albums11','K&uuml;nstler');
define('_msg_albums12','Keywords');
define('_msg_albums13','Downloads');
define('_msg_albums14','Reset Titel Downloads');
define('_msg_albums15','Treffer');
define('_msg_albums16','Kategorie');
define('_msg_albums17','Top Level Album');
define('_msg_albums18','Nicht kategorisiert');
define('_msg_albums19','Album-Bestellrabatt');

/*--------------------------------------
  ADMIN/DATA_FILES/HOME.PHP
  -------------------------------------*/
  
define('_msg_home','Willkommen bei Maian Music f&uuml;r Joomla, einem einfachen Musik-Shop-System, mit dem Sie Ihre eigene Musik im MP3/MP4-Format als H&ouml;rprobe pr&auml;sentieren und zum Kauf anbieten k&ouml;nnen. Dieses Script wurde urspr&uuml;nglich geschrieben von <a href="http://www.maianscriptworld.co.uk" title="Maian Script World" target="_blank">Maian Script World</a> und wurde f&uuml;r Joomla angepasst von <a href="http://www.aretimes.com" title="Are Times" target="_blank">Are Times</a>. Um dieses System einsetzen zu k&ouml;nnen m&uuml;ssen Sie &uuml;ber einen Paypal-Bussiness-Account verf&uuml;gen. Es wird empfohlen die Auto-Return-Funktionalit&auml;t einzusetzen, um eine h&ouml;here Kundenzufriedenheit zu erreichen. Bei der Konfiguration dieser Komponente beachten Sie bitte die [<b><span style="color:#FF7700">?</span></b>] Kurzinfos f&uuml;r weitere Informationen.<br><br> Falls irgendwelche Probleme auftreten sollten, beschreiben Sie diese bitte unter <a href="http://www.aretimes.com" title="Support Forums" target="_blank">support forums</a>.<br><br>Bitte benachrichtigen Sie mich &uuml;ber meine Webseite um mich auf Fehler aufmerksam zu machen und um Kommentare abzugeben.<br><br>Ich w&uuml;nsche Ihnen viel Spa&szlig; mit Ihrem Musik-Shop-System,<br><br>Alao.<br><br><b>Are Times</b><br><a href="http://www.aretimes.com" title="Are Times" target="_blank">http://www.aretimes.com</a>');
define('_msg_dedicate','<br><br>Gewidmet an <a href="http://www.lpierce927.com" title="Looch" target="_blank">Lamar Anthony Pierce</a> A.K.A <a href="http://www.myspace.com/thereallooch" title="Looch" target="_blank">Looch</a>');
define('_msg_home2','Spenden');                                
define('_msg_home3','Falls Sie dieses Script m&ouml;gen oder einsetzen und unterst&uuml;tzen wollen, denken Sie &uuml;ber eine kleine Spende nach oder kaufen Sie Musik von <a href="http://www.aretimes.com" title="Are Times" target="_blank">Are Times</a>.');
define('_msg_home4','Spenden sind kein muss, aber mehr als willkommen. Vielen Dank!');
define('_msg_home5','Musik-Shop &Uuml;berblick');
define('_msg_home6','Sie haben aktuell <b>{tracks}</b> Titel eingeordnet in <b>{albums}</b> Alben.<br><br>Paypal Geb&uuml;hren: <b>{fees}</b><br>Gewinn: <b>{profit}</b><br><br><b>Dezeit sind {a_purchases}</b> Alben and <b>{t_purchases}</b> einzelne Titel bestellt worden.');
                         
                              
/*--------------------------------------
  ADMIN/DATA_FILES/LOGIN.PHP
  -------------------------------------*/   
  
define('_msg_login','Administrations-Login');                             
define('_msg_login2','Bitte loggen Sie sich im folgenden Administrationsbereich ein:');
define('_msg_login3','Benutzername');
define('_msg_login4','Pa&szlig;wort');
define('_msg_login5','Login');
define('_msg_login6','Ung&uuml;ltig');
define('_msg_login7','Zur Erinnerung');


/*--------------------------------------
  ADMIN/DATA_FILES/SALES.PHP
  -------------------------------------*/
  
define('_msg_sales','Ihre abgewickelten Verk&auml;ufe werden unten dargestellt. Benutzen Sie die "erteilte Auftr&auml;ge"-Option, falls erforderlich. Mithilfe der weiterf&uuml;hrenden Links k&ouml;nnen Sie Ihre Verk&auml;ufe verwalten oder Kontakt zu Kunden aufnehmen. Falls die Suche nach bestimmten Posten erforderlich ist, nutzen Sie bitte die Suchfunktion des Men&uuml;bereichs.');  
define('_msg_sales2','Anzeigen');
define('_msg_sales3','Pro Seite');
define('_msg_sales4','Neuste Verk&auml;ufe');
define('_msg_sales5','&Auml;lteste Verk&auml;ufe');
define('_msg_sales6','Bestellte Titel');
define('_msg_sales7','Bestellte Alben');
define('_msg_sales8','H&ouml;chste Verkaufszahlen');
define('_msg_sales9','Niedrigste Verkaufszahlen');
define('_msg_sales10','K&auml;ufer A-Z');
define('_msg_sales11','K&auml;ufer Z-A');
define('_msg_sales12','{count} Verk&auml;ufe anzeigen');
define('_msg_sales13','Derzeit sind <b>0</b> Verk&auml;ufe in der Datenbank gespeichert.');
define('_msg_sales14','Ausgew&auml;hlte Verk&auml;ufe entfernen');
define('_msg_sales15','Bestellte Alben');
define('_msg_sales16','Bestellte Titel');
define('_msg_sales17','<b>0</b> bestellte Alben.');
define('_msg_sales18','<b>0</b> bestellte Titel.');
define('_msg_sales19','von');
define('_msg_sales20','Alben');
define('_msg_sales21','Titel');
define('_msg_sales22','Verkaufsinformationen anzeigen');
define('_msg_sales23','K&auml;ufer benachrichtigen');
define('_msg_sales24','Betreff');
define('_msg_sales25','Kommentare');
define('_msg_sales26','Zur Versenden einer Nachricht per E-Mail-Client, klicken Sie <a href="mailto:{email}" title="Versenden einer Nachricht per E-Mail-Client"><b><u>hier</u></b></a>.');
define('_msg_sales27','Nachricht gesendet!');
define('_msg_sales28','Nachricht senden');
define('_msg_sales29','Reset Downloads &amp; erneutes Senden der Download-E-Mail');
define('_msg_sales30','K&auml;ufer/Paypal Informationen');
define('_msg_sales31','E-Mail an K&auml;ufer gesendet!');
define('_msg_sales32','Anklicken f&uuml;r weiterf&uuml;hrende Informationen');
define('_msg_sales33','K&auml;ufer');
define('_msg_sales34','E-Mail');
define('_msg_sales35','Datum');
define('_msg_sales36','Adresse');
define('_msg_sales37','K&auml;ufer Vermerk');
define('_msg_sales38','Zahlungsstatus');
define('_msg_sales39','Brutto/Geb&uuml;hren/Gesamt');
define('_msg_sales40','Paypal Transaction ID');
define('_msg_sales41','Kunden');
define('_msg_sales42','Info');
define('_msg_sales43','Entfernen');
define('_msg_sales44','Paypal Transaction ID');
define('_msg_sales45','Invoice No');

/*--------------------------------------
  ADMIN/DATA_FILES/SEARCH.PHP
  -------------------------------------*/
  
define('_msg_search','Mit dieser Funktion k&ouml;nnen Sie nach Verk&auml;ufen suchen. Dies ist insbesondere bei vielen Eintr&auml;gen hilfreich, wenn ein bestimmter Posten gefunden werden soll. Bitte geben Sie nachfolgend Ihre Suchkriterien ein. Sie k&ouml;nnen entweder einen oder auch mehrere Suchbegriffe eingeben, aber die Angabe einer Suchoption ist erforderlich:');
define('_msg_search2','Geben Sie Ihre Suchkriterien an');
define('_msg_search3','Wo \'Name\' &auml;hnlich wie');
define('_msg_search4','Wo \'E-Mail\' &auml;hnlich wie');
define('_msg_search5','Wo \'invoice no\' =');
define('_msg_search6','Wo \'trans id\' =');
define('_msg_search7','Wo \'Datum\' zwischen');
define('_msg_search8','Suche');
define('_msg_search9','Kein Ergebnis gefunden... Bitte starten Sie eine neue Suche...');
define('_msg_search10','Suchergebnis');
define('_msg_search11','Ihre Suchergebnisse werden unten angezeigt');
define('_msg_search12','Neue Suche');


/*--------------------------------------
  ADMIN/DATA_FILES/SETTINGS.PHP
  -------------------------------------*/
  
define('_msg_settings','&Uuml;berarbeiten Sie im Folgenden Ihre Programmeinstellungen. Alle Felder m&uuml;ssen ausgef&uuml;llt werden, au&szlig;er wenn diese als "optional" gekennzeichnet sind.');  
define('_msg_settings2','Webseite/Allgemeine Einstellungen');
define('_msg_settings3','Name des Musik-Shops');
define('_msg_settings4','E-Mail-Adresse');
define('_msg_settings5','Homepage URL');
define('_msg_settings6','Pfad zum Installationsverzeichnis');
define('_msg_settings7','Sprache');
define('_msg_settings8','Captcha aktivieren');
define('_msg_settings9','MP3/Download Einstellungen');
define('_msg_settings10','MP3-Titel Verzeichnispfad');
define('_msg_settings11','MP3-H&ouml;rproben Verzeichnispfad');
define('_msg_settings12','Einstellungen bearbeiten');
define('_msg_settings13','Suchmaschinenfreundliche URLs');
define('_msg_settings14','Paypal Einstellungen');
define('_msg_settings15','Paypal IPN aktivieren');
define('_msg_settings16','Sandbox aktivieren');
define('_msg_settings17','Live');
define('_msg_settings18','Log Errors');
define('_msg_settings19','Page Style');
define('_msg_settings20','Paypal E-Mail-Adresse');
define('_msg_settings21','W&auml;hrung verarbeiten');
define('_msg_settings22','');
define('_msg_settings23','Seiten Text');
define('_msg_settings24','<a href="http://en.wikipedia.org/wiki/HTML" title="Hypertext Markup Language" target="_blank">HTML</a> ist erlaubt');
define('_msg_settings25','Ablaufzeit der Download-Seite');
define('_msg_settings26','Anzahl Alben f&uuml;r RSS-Feed');
define('_msg_settings27','Anzahl "Beliebteste" Links');
define('_msg_settings28','SSL aktiviert');
define('_msg_settings29','SMTP Port');
define('_msg_settings30','Reset Alle Alben Treffer');
define('_msg_settings31','Ablaufzeit des Artikel-Downloads');
define('_msg_settings32','Lizenz Seiten Text');
define('_msg_settings33','SMTP Settings');
define('_msg_settings34','Enable SMTP');
define('_msg_settings35','SMTP Host');
define('_msg_settings36','SMTP Benutzername');
define('_msg_settings37','SMTP Passwort');
define('_msg_settings38','Mp3 Player Konfiguration');
define('_msg_settings39','Player');
define('_msg_settings40','Payment Datentransfer');
define('_msg_settings41','Default Seite');
define('_msg_settings42','Beliebteste');
define('_msg_settings43','Musik');
define('_msg_settings44','Musik Seiten Text');

/*--------------------------------------
  ADMIN/DATA_FILES/STATISTICS.PHP
  -------------------------------------*/

define('_msg_statistics','Diese Seite zeigt Ihnen auf einen Blick, wie oft jedes Album oder jeder Titel bestellt wurde. Klicken Sie die Buttons an, um zu den jeweiligen Titel-Statistiken der Alben zu gelangen.');
define('_msg_statistics2','Sortiert nach');
define('_msg_statistics3','Am meisten Treffer');
define('_msg_statistics4','Am wenigsten Treffer');
define('_msg_statistics5','Album');
define('_msg_statistics6','Single');
define('_msg_statistics7','<li>Treffer: <b>{hits}</b> </li> <li>Album-Bestellungen: <b>{albums}</b> </li> <li> Titel-Bestellungen: <b>{tracks}</b> </li>');
define('_msg_statistics8','Titel-Statistiken anzeigen');
define('_msg_statistics9','Hier werden alle Titel eines Albums und die Anzahl der Bestellungen pro Titel aufgelistet.');
define('_msg_statistics10','Alle anzeigen');
define('_msg_statistics11','Alle verbergen');


/*--------------------------------------
  ADMIN/DATA_FILES/TRACKS.PHP
  -------------------------------------*/
  
define('_msg_tracks','Auf dieser Seite k&ouml;nnen Sie Ihre aktuellen Titel verwalten. W&auml;hlen Sie unten ein Album aus um die Titel des Albums anzuzeigen und verwenden Sie die Buttons um die Titel zu bearbeiten.');  
define('_msg_tracks2','<b>{count}</b> Titel');
define('_msg_tracks3','Titel anzeigen');
define('_msg_tracks4','Keine Titel');


/*--------------------------------------
  ADMIN/DATA_FILES/VIEW_TRACKS.PHP
  -------------------------------------*/
  
define('_msg_viewtracks','Titel bearbeiten');  
define('_msg_viewtracks2','Klicken Sie auf die Links um die Titel zu bearbeiten. Sie k&ouml;nnen jeden Titel bearbeiten oder l&ouml;schen, sowie die Reihenfolge der Sortierung &auml;ndern, welche bei der Darstellung im &ouml;ffentlich zug&auml;nglichen Bereich dargestellt wird.');
define('_msg_viewtracks3','Diesen Titel bearbeiten');
define('_msg_viewtracks4','Nach oben');
define('_msg_viewtracks5','Nach unten');
define('_msg_viewtracks6','Dieses Album hat derzeit 0 Titel');
define('_msg_viewtracks7','Abbrechen');
define('_msg_viewtracks8','Titel erfolgreich aktualisiert!');
define('_msg_viewtracks9','Aktualisieren');


/*---------------------
  RESPONSE DATA FOR IPN
  PAYPAL E-MAILS
----------------------*/

define('_msg_ipn','Bestellung ung&uuml;ltig');
define('_msg_ipn2','Paypal IPN Fehler!!');
define('_msg_ipn3','Falls aktiviert, wurde dieser Fehler im Logfile protokolliert.');
define('_msg_ipn4','Der folgende Geldeingang wurde empfangen von (und zur&uuml;ckgesendet an) PayPal:');
define('_msg_ipn5','Bezahlung fehlgeschlagen');
define('_msg_ipn6','Bezahlung verweigert');
define('_msg_ipn7','Unbekannter Bezahlungsstatus');
define('_msg_ipn8','Musik-Shop-Bestellung in der Schwebe!');
define('_msg_ipn9','Ung&uuml;ltiger Bestellvorgang!');
define('_msg_ipn10','Musik-Download-Information!');
define('_msg_ipn11','Musik-Shop-Transaktion!');


/*-------------------------------------
  GENERAL VARIABLES
  ------------------------------------*/

define('_msg_script','Maian Music');
define('_msg_script2','Ja');
define('_msg_script3','Nein');
define('_msg_script4','optional');
define('_msg_script5','Erster');
define('_msg_script6','Letzter');
define('_msg_script7','Bearbeiten');
define('_msg_script8','L&ouml;schen');
define('_msg_script9','Abbrechen');
define('_msg_script10','Neu laden');
define('_msg_script11','Drucken');
define('_msg_script12','unbegrenzt');


/*-----------------------------
  RSS Feeds
-------------------------------*/

define('_msg_rss','Neue Alben @ {website_name}');
define('_msg_rss2','Dies sind die neuesten Alben, welche auf {website_name} hinzugef&uuml;gt wurden.');
define('_msg_rss3','Album:');


/*----------------------
  ADMIN/INC/CALENDAR.PHP
-----------------------*/

define('_msg_calendar','Januar');
define('_msg_calendar2','Februar');
define('_msg_calendar3','M&auml;rz');
define('_msg_calendar4','April');
define('_msg_calendar5','Mai');
define('_msg_calendar6','Juni');
define('_msg_calendar7','Juli');
define('_msg_calendar8','August');
define('_msg_calendar9','September');
define('_msg_calendar10','Oktober');
define('_msg_calendar11','November');
define('_msg_calendar12','Dezember');


/*--------------------------------------------------------------------------------------------------
  ZIP-DATEI VERZEICHNISNAMEN
  Dies sind die Namen der Verzeichnisse die in den Zip-Dateien erzeugt werden, wenn jemand ein Album 
  oder mehrere Titel herunterl&auml;dt. Die Namen sollten KEINE ung&uuml;ltigen Zeichen enthalten, welche die 
  Erstellung der Verzeichnisse verhindern k&ouml;nnten. Falls Sie sich hier nicht sicher sind behalten Sie 
  bitte die vorgegebenen Namen bei.
  --------------------------------------------------------------------------------------------------*/
  
define('_msg_folder','titel');
define('_msg_folder2','album');
  

/*-----------------------------------------------------------------------------------------------------
  JAVASCRIPT VARIABLES
  WICHTIG: Wenn Sie einfache Anf&uuml;hrungszeichen in den Variablen verwenden wollen M&Uuml;SSEN Sie diese mit 3
           vorangestellten backslashes versehen ( Beispiel: d\\\'apostrophe ).
           Die Nichtber&uuml;cksichtigung dieses Hinweises f&uuml;hrt zu Fehlern bei der Ausf&uuml;hrung des Javascript-Codes. 
		   Als alternative L&ouml;sung wird die Verwendung von doppelten Anf&uuml;hrungszeichen empfohlen.
  
------------------------------------------------------------------------------------------------------*/

define('_msg_javascript','Hilfe/Informationen');
define('_msg_javascript2','Vollst&auml;ndige URL des Verzeichnisses, in dem die Musik-Dateien abgelegt sind. OHNE angeh&auml;ngten Slash (/).<br><br><b>http://www.yoursite.com/music</b>');
define('_msg_javascript3','Die "captcha"-Implementierung soll verhindern helfen, dass Spam &uuml;ber Ihre Kontakt-Funktionalit&auml;t eingeht. Damit diese Funktionalit&auml;t korrekt funktioniert, muss die <b>GD Library mit Freetype support</b>auf Ihrem Server installiert sein. In der Dokumentation finden Sie mehr Informationen dazu.');
define('_msg_javascript4','Die MP3-Dateien sollten immer au&szlig;erhalb Ihres web root-Verzeichnisses abgelegt werden. Geben Sie hier den user-abh&auml;ngigen, relativen Pfad zu Ihrem MP3-Verzeichnis an und erstellen Sie das entsprechende Verzeichnis manuell auf Ihrem Server. OHNE angeh&auml;ngten Slash (/).<br><br><b>/home/user/mp3</b>');
define('_msg_javascript5','Das selbe wie oben, jedoch ist dies der Pfad zum MP3-H&ouml;rproben-Verzeichnis. Dieses kann au&szlig;er- oder innerhalb des obigen MP3-Verzeichnisses liegen. OHNE angeh&auml;ngten Slash (/).<br><br><b>../mp3/mp3_preview or /mp3_preview</b>');
define('_msg_javascript6','Aktivieren Sie mod_rewrite f&uuml;r suchmaschinenfreundliche URLs. Damit dies funktioniert muss der Server <b>.htaccess</b> unterst&uuml;tzen. Beim Aktivieren dieser Option muss die Datei <b>htaccess_COPY.txt</b> vorab in <b>.htaccess</b> umbenannt werden.<br><br>Falls bei der Aktivierung Fehler (server error) auftreten, unterst&uuml;tzt Ihr Server kein <b>.htaccess</b>.');
define('_msg_javascript7','Paypal erm&ouml;glicht Ihnen das Testen des Systems auch ohne einen tats&auml;chlich realen Zahlungseingang. Detailliertere Informationen zu diesem Testmodus (<b>sandbox</b> mode) finden Sie <a href="https://developer.paypal.com" title="Sandbox" target="_blank">hier</a>.<br><br>Haken Sie das Feld an, um sandbox zu aktivieren. L&ouml;schen Sie das H&auml;kchen, um den Echtbetrieb f&uuml;r Paypal zu aktivieren.');
define('_msg_javascript8','Dies ist Ihre prim&auml;re Paypal Business Account E-Mail-Adresse.');
define('_msg_javascript9','Paypal bietet die M&ouml;glichkeit einen eigenen Seitenstil (css) auf Ihrer Seite im Paypal-Bereich einzusetzen. Falls Sie ein eigenes Stylesheet haben und einsetzen m&ouml;chten, k&ouml;nnen Sie hier den Namen eintragen. Lassen Sie das Feld frei, wenn Sie keinen eigene Seitenstil w&uuml;nschen.');
define('_msg_javascript10','Wenn eine ung&uuml;ltige R&uuml;ckmeldung von Paypal zur&uuml;ckgeschickt wird k&ouml;nnen Sie den Fehler mitloggen. Dies ist f&uuml;r die Fehlersuche sehr hilreich und es wird empfohlen dies beim Testen grunds&auml;tzlich zu aktivieren.');
define('_msg_javascript11','Geben Sie die zu verarbeitende W&auml;hrung an. Diese Liste zeigt die von Paypal unterst&uuml;tzten W&auml;hrungen an, zum Zeitpunkt als dieses Script erstellt wurde.');
define('_msg_javascript12','Falls Sie ein Bild (z.B. Cover) zur Darstellung dieses Albums darstellen wollen, geben Sie bitte die vollst&auml;ndige URL beginnend mit http://... an.<br><br>Ber&uuml;cksichtigen Sie bitte, dass dieses Bild defaultm&auml;&szlig;ig mit voller Pixelgr&ouml;&szlig;e dargestellt wird und <b>65</b>x<b>65</b> Pixel gro&szlig; sein sollte.<br><br><i>(optional)</i>');
define('_msg_javascript13','Falls ein Besucher ein komplettes Album bestellt und Sie diesem auch das Coverbild, Texte usw. (cover art) zum Download anbieten m&ouml;chten erstellen Sie eine entsprechende .zip Datei und laden Sie diese auf den Server und geben Sie den entsprechenden Pfad beginnend mit http://... hier an.<br><br>Wenn jemand ein komplettes Album bestellt, wird dieser Download Link f&uuml;r cover art gemeinsam mit dem Download Link f&uuml;r die MP3-Dateien versendet.<br><br><i>(optional)</i>');
define('_msg_javascript14','Setzen Sie den Status f&uuml;r dieses Album. Bei Deaktivierung wird es nicht im &ouml;ffentlich zug&auml;nglichen Bereich nicht angezeigt.');
define('_msg_javascript15','Sind Sie sicher?\n\nDadurch werden auch alle untergegliederten Titel Zuordnungen dieses Albums gel&ouml;scht.\n\n B Bitte beachten Sie, dass die tats&auml;chlichen MP3-Dateien manuell gel&ouml;scht werden m&uuml;ssen.');

define('_msg_javascript16','Der Pfad zu einer MP3-Datei muss hier <b>NUR</b> angegeben werden, wenn die MP3-Datei nicht direkt innerhalb des definierten MP3-Verzeichnisses abgelegt wurde. Die MP3-Datei sollte vorab in das entsprechende Verzeichnis hochgeladen worden sein. <br>Beispiele:<br><b>music_file.mp3</b> (MP3 liegt im MP3-Verzeichnis)<br><b>album1/music_file.mp3</b> (MP3 liegt im Unterverzeichnis album1)');
define('_msg_javascript17','Wenn Sie zum Probeh&ouml;ren k&uuml;rzere Titel verwenden m&ouml;chten, geben Sie hier den entsprechenden MP3-Dateinamen an. Die angegebene MP3-Datei sollte vorab in das MP3-H&ouml;rproben-Verzeichnis hochgeladen worden sein. Wenn hier keine Angabe erfolgt, wird die komplette Titell&auml;nge als H&ouml;rprobe zur Verf&uuml;gung gestellt.<br><br>optional');
define('_msg_javascript18','Geben Sie die L&auml;nge des Titels an. Beispiele:<br><br>4:32<br>4 min 32 s');
define('_msg_javascript19','Geben Sie die Kosten des Titels an. KEIN vor- oder nachgestelltes W&auml;hrungssymbol bei der Angabe des Preises. Beispiel: Bei einem Preis von &euro; 0,75 geben Sie bitte <b>0.75</b> ein.');

define('_msg_javascript20','Soll dieser Titel einzeln bestellbar sein? Wenn nicht, kann der Titel nur mit dem Kauf des entsprechenden kompletten Albums erworben werden.');
define('_msg_javascript21','Sind Sie sicher, dass Sie diesen Titel l&ouml;schen m&ouml;chten?');
define('_msg_javascript22','Geben Sie zur Beschreibung der Musik dieses Albums passende Schl&uuml;sselbegriffe (keywords) an. Diese werden auch in den meta keywords im head tag Ihrer Seite verwendet.');
define('_msg_javascript23','Wenn Sie wollen, dass Ihre Kunden einen Rabatt bei der Bestellung eines ganzen Albums erhalten, geben Sie hier den entsprechenden Prozentwert ein. Tragen Sie 0 ein, falls KEIN Rabatt f&uuml;r eine Album-Bestellung gew&auml;hrt werden soll.');
define('_msg_javascript24','Beim Erwerb von Musikst&uuml;cken wird eine entsprechende E-Mail mit einem Link zu der Download-Seite an den K&auml;ufer versendet. Um zu verhindern, dass dieser Link an andere Leute weiterverbreitet werden kann, k&ouml;nnen Sie einschr&auml;nken, wie oft auf diese Download-Seite zugegriffen werden kann, bevor der Link ung&uuml;ltig wird. <b>Mit dem Wert 0 wird der unbegrenzte Zugriff gew&auml;hrt</b>.');
define('_msg_javascript25','Sind Sie sicher, dass Sie Ihren Warenkorb leeren wollen?');
define('_msg_javascript26','Diesen Artikel l&ouml;schen?');
define('_msg_javascript27','Mit dieser Option k&ouml;nnen Sie per Stapelbearbeitung die Anzahl von Downloads zur&uuml;cksetzen. F&uuml;r einzelne Alben nutzen Sie bitte die Option beim Bearbeiten des Albums. F&uuml;r einzelne Titel nutzen Sie bitte die Option beim Bearbeiten des Titels.');
define('_msg_javascript28','Wenn Sie dieses Feld anhaken, wird die Anzahl der Downloads aller Titel dieses Albums auf 0 zur&uuml;ckgestetzt.');
define('_msg_javascript29','Wenn Sie dieses Feld anhaken, werden alle Treffer aller Alben auf 0 zur&uuml;ckgesetzt. Um einzelne Alben zu bearbeiten nutzen Sie bitte die "Alben verwalten" Seite.');
define('_msg_javascript30','Dies ist die Begrenzung, wie oft eine erworbener Titel heruntergeladen werden darf. <b>Der Wert 0 erlaubt dabei die unbegrenzte Anzahl von Downloads</b>.');
define('_msg_javascript31','Damit bleiben Sie f&uuml;r 30 Tage eingeloggt. <b>NICHT</b> empfohlen f&uuml;r Computer die von mehreren Personen genutzten werden.<br /><br />Cookies m&uuml;ssen aktiviert sein, damit dieses Feature funktioniert.');
define('_msg_javascript32','Bei manchen Hosts ist die PHP mail-Funktion gesperrt, so dass Sie gezwungen sind Ihre E-Mails per SMTP zu versenden. Falls die PHP mail-Funktion aufgrund dessen also nicht funktionieren sollte, probieren Sie die SMTP-Variante aus, indem Sie diese aktivieren. Falls Sie die erforderlichen SMTP-Angaben nicht kennen sollten, kontaktieren Sie Ihren Host-Provider.');
define('_msg_javascript33','Sind Sie sicher, dass Sie diese Verk&auml;ufe l&ouml;schen wollen?');
define('_msg_javascript34','Sind Sie sicher?');
define('_msg_javascript35','Wenn Ihre Seite Secure Socket Layer verwendet, aktivieren Sie SSL, um nach der Abwicklung in den sicheren Bereich zur&uuml;ckzukehren. Aktivieren Sie dies <b>NICHT</b>, wenn Sie kein SSL-Zertifikat auf Ihrem Server installiert haben.');
define('_msg_javascript36','Wieviele "Neuste Alben" wollen Sie in Ihrem RSS-Feed anzeigen lassen? Max 999');
define('_msg_javascript37','Wieviele "Beliebteste Links" wollen Sie auf Ihrer Homepage anzeigen lassen? Max 999');
define('_msg_javascript38','Um Ihr Idenity Token in Ihrem Paypal-Profil in Erfahrung zu bringen gehen Sie zu:<br><br><b>Profile ->Website Payment Preferences</b><br><br> Schalten Sie Payment Data Transfer ein und kopieren Sie Ihr Identity Token mit kopieren/einf&uuml;gen.');
define('_msg_javascript39','Bestimmt, welche Seite der Komponente defaultm&auml;&szlig;ig geladen wird.');
/*-----------------------------------------------------------------------------------------------------

  Pre-installiation check. 

------------------------------------------------------------------------------------------------------*/

define('_setup15','CURL Support <i>(Paypal Processing)</i>');
define('_setup16','PHP-Version');
define('_setup17','Kompatibilit&auml;tspr&uuml;fung, falls nicht OK kontaktieren Sie Ihren Web-Hoster');
define('_setup18','GD Graphic Support <i>(Captcha)</i>');
define('_setup19','<font style="color:orange">OK</font>');
define('_setup20','<font style="color:red">Nicht Installiert</font>');
define('_setup22','<font style="color:red">Version zu alt</font>');

/*-----------------------------------------------------------------------------------------------------

  New 1.3 text. 

------------------------------------------------------------------------------------------------------*/
define('_msg_op_cancel','Der Vorgang wurde abgebrochen');
define('_setup23','Importiere 1.0 Tabellen');
define('_setup24','Open Source Credits');
define('_setup25','Anpassen');
define('_setup26','System Check');
define('_setup27','Sprachdateien');
define('_setup28','Flash Players');
define('_setup29','Import starten');
define('_setup29','System Check starten');
define('_setup30','System Check Ergebnisse');
define('_setup31','Ihre Version');
define('_setup32','Aktuelle Version');

define('_msg_tableh1','Title');
define('_msg_tableh2','Published');
define('_msg_tableh3','Alias');
define('_msg_tableh4','Order');

define('_msg_categories','Kategorien');
define('_msg_categories1','Kategorie');
define('_msg_categories_desc','Sie k&ouml;nnen Kategorien anlegen um Ihre Alben einzugruppieren. Ein Album kann auch ohne Zuordnung einer Kategorie angelegt werden, aber das Album wird dann nicht in der Kategorie-Ansicht dargestellt.');
define('_msg_categories2','Derzeit ist keine Kategorie in der Datenbank gespeichert.');


define('_msg_discount','Rabatt');

define('_msg_settings46','Warenkorb speichern');
define('_msg_settings47','Ajax aktivieren');
define('_msg_settings48','Suchfeld einbeziehen');
define('_msg_settings49','Zus&auml;tzliche Paypal E-Mail-Adresse');
define('_msg_settings50','Minimum Payment');
define('_msg_settings51','zeige Download-Link nach der Bestellung');
define('_msg_settings52','Zeige Navigation');
define('_msg_settings53','Verwenden Sie Enlargeit');

define('_msg_albums20','Fehler: Ein Album oder mehrere Alben konnten nicht gel&ouml;scht werden');
define('_msg_albums21','Album wurde gel&ouml;scht');
define('_msg_albums22','Album wurde ver&ouml;ffentlicht');
define('_msg_albums23','Album wurde hinzugef&uuml;gt!');

define('_msg_tracks5','Anzahl der Titel');
define('_msg_tracks6','Ausgew&auml;hlte Datei: ');
define('_msg_tracks7','Gr&ouml;&szlig;e: ');
define('_msg_tracks8','Typ: ');
define('_msg_tracks9','Unterverzeichnis hinzuf&uuml;gen: ');
define('_msg_tracks10','Link zu: ');
define('_msg_tracks11','Der Pfad {PATH} konnte nicht gefunden werden. Bitte korrigieren Sie Angaben unter Einstellungen');
define('_msg_tracks12','Ein Fehler ist aufgetreten. Die Datei konnte nicht auf den Server geladen werden');
define('_msg_tracks13','Upload war erfolgreich: ');

define('_msg_upload_error1','Konnte nicht hochgeladen werden auf: ');
define('_msg_upload_error2','und ich habe keine Ahnung warum.');

define('_msg_tools','Maian Music Tabellen');
define('_msg_tools2','<font style="color:orange">Gefunden</font>');
define('_msg_tools3','<font style="color:red">Nicht Gefunden</font>');
define('_msg_tools4','<font style="color:red">Warnung!!!! Die Ausf&uuml;hrung dieses Imports &uuml;berschreibt s&auml;mtliche Daten, die derzeit in Ihren Tabellen gespeichert sind.</font>');

define('_msg_collapse_all','Alle verbergen');
define('_msg_expand_all','Alle anzeigen');

define('_msg_javascript41','Hier wird festgelegt, wieviele Tage ungenutzte Warenkorbinformationen gespeichert bleiben sollen. Bei leerem Eintrag werden standardm&auml;&szlig;ig 14 Tage vorgegeben. Seien Sie vorsichtig hier zu hohe Fristen zu definieren, da dies die Datenbank stark aufbl&auml;hen kann, insbesondere wenn Ihre Seite h&auml;ufig besucht wird.');
define('_msg_javascript42','Falls Sie die Micro Payment-Option in Ihrem prim&auml;ren Paypal Business Account nutzen k&ouml;nnen Sie hier daf&uuml;r eine zus&auml;tzliche Paypal E-Mail-Adresse angeben, um Ihren Gewinn zu maximieren.');
define('_msg_javascript43','Alle Zahlungen die gr&ouml;&szlig;er sind als der hier vorgebene Wert werden &uuml;ber diesen Account abgewickelt.  Beispiel: Falls 10 eingetragen wurde werden alle Bezahlungen &uuml;ber 10 &uuml;ber diesen sekund&auml;ren Paypal Account abgewickelt.');
define('_msg_javascript44','Zeigt das Suchen-Textfeld und den Suchen-Button im Kopfbereich an.');
define('_msg_javascript9','Paypal bietet die M&ouml;glichkeit einen eigenen Seitenstil (css) auf Ihrer Seite im Paypal-Bereich einzusetzen. Falls Sie ein eigenes Stylesheet haben und einsetzen m&ouml;chten, k&ouml;nnen Sie hier den Namen eintragen. Lassen Sie das Feld frei, wenn Sie keinen eigene Seitenstil w&uuml;nschen.');
define('_msg_javascript40','Dies aktiviert im Frontend Ihres Shops die Ajax Warenkorb-Funktionalit&auml;t. Bei leerem Eintrag werden, im Gegensatz dazu, standardm&auml;&szlig;ig die &Auml;nderungen im Warenkorb nicht unmittelbar aktualisiert dargestellt (legacy cart).');
define('_msg_javascript41','Dies zeigt den Download-Link nach einer erfolgreichen Transaktion auf Ihrer "Vielen Dank!" Seite.');
define('_msg_javascript45','Dies zeigt den Navigationskopfbereich auf allen Seiten an.');
define('_msg_javascript46','Dadurch wird das Album Bild zu vergrößern, wenn der Benutzer auf dem Album art.');

define('_msg_free_download','Kostenfreie Downloads');
define('_msg_go_to_download','Zum Download');
define('_msg_download_message','Ein Download-Link ist unten verf&uuml;gbar.');
define('_msg_download_message2','Ihre E-Mail wurde hinzugef&uuml;gt. Sie d&uuml;rfen jetzt kostenfreie Titel herunterladen.');

define('_msg_require_field', 'ist eine erforderliche Angabe.');
define('_msg_invalid_email', 'ist eine ung&uuml;ltige E-Mail-Adresse.');

define('_msg_no_download', 'Nicht zum Download verf&uuml;gbar.');

define('_msg_name', 'Name');
define('_msg_email', 'E-Mail');
define('_msg_submit', 'Senden');
define('_msg_no_free', 'Derzeit werden keine kostenfreien Downloads angeboten.');
define('_msg_must_provide', 'Sie m&uuml;ssen eine g&uuml;ltige E-Mail-Addresse bereitstellen, bevor Sie Titel herunterladen k&ouml;nnen.');
define('_msg_theif', 'U hebt geprobeerd te downloaden van een track die niet vrij !!!!!');

define('_msg_albumsnameAZ','Album (A-Z)');
define('_msg_albumsnameZA','Album (Z-A)');
define('_msg_artistAZ','K&uuml;nstler (A-Z)');
define('_msg_artistZA','K&uuml;nstler (Z-A)');

define('_msg_enlarge','Bild vergr&ouml;&szlig;ern');

define('_msg_publichome5','Neue Alben');
define('_msg_publichome6','Neue Titel');

define('_msg_backup','Datensicherung der Tabellen');
define('_msg_backup2','Datensicherung starten');
define('_msg_backup3','<font style="color:red">Warnung!!!! Das Ausf&uuml;hren der Datensicherung &uuml;berschreibt s&auml;mtliche Daten vorheriger Datensicherungen.</font>');
define('_msg_backup4','<font style="color:green">Erzeugen</font>');
define('_msg_backup5','Bei der Datensicherung der Tabellen ist ein Fehler aufgetreten. Bitte benutzen Sie PHPMyAdmin um Ihre Tabellen manuell zu sichern.');
define('_msg_backup6','Die Datensicherung der Tabellen war erfolgreich');

define('_msg_import','Beim Import der Tabellen ist ein Fehler aufgetreten');
define('_msg_import2','Ihre 1.0 Tabellen wurden erfolgreich importiert');
define('_msg_error_bind','Problem Binding');
define('_msg_error_check','Problem Checking');
define('_msg_error_store','Problem Storing');

define('_msg_csv','Export als CSV-Datei');
define('_msg_csv_album','Nach Album');
define('_msg_csv_sale','Nach Verkaufszahl');

define('_msg_RM','RM Nummer');
define('_msg_UPC','UPC');

define('_msg_newsletter','Newsletter-System nicht installiert');
define('_msg_return_to','Zur&uuml;ck zur vorherigen Seite');

define('_msg_append','Hinzugef&uuml;gte URL');
define('_msg_label','Label');
define('_msg_javascript47','Falls Sie die H&ouml;rproben innerhalb des Root-Verzeichnisses Ihrer Webseite abgelegt haben k&ouml;nnen Sie die URL des Flashplayers hinzuf&uuml;gen.');
/*-----------------------------------------------------------------------------------------------------

  New 1.4 text. 

------------------------------------------------------------------------------------------------------*/
define('_msg_update','Update');
define('_msg_upload','Upload');

define('_msg_frontpage_lang','Front End Language Selection');
define('_msg_javascript_lang','Will allow users to choose a language.  Flags has the same name as language files. Located in com_maianmedia/media/flags');


define('_msg_lightbox','Deactivate Lightbox');
define('_msg_lightbox_javascript','This will display tracks and albums for direct download instead of in the lightbox window.');
define('_msg_download_javascript','A download link will be displayed on the thank you page.');

define('_msg_active','Active');
define('_msg_inactive','Inactive');

define('_msg_gen','Generate Download');

define('_msg_continue','Continue Shopping');
define('_msg_javascript_continue','Will display a continue shopping button on the shopping cart page');
define('_msg_physical','Physical CD');
define('_msg_javascript_zip','Will zip your albums if your server supports it.');
define('_msg_cart_zip','Dowload Cart');
?>
