<?php

/*------------------------------------------
  MAIAN MUSIC v1.2
  Written by David Ian Bennett
  E-Mail: support@maianscriptworld.co.uk
  Website: www.maianscriptworld.co.uk
  This File: Dutch language file translated by Jerry Janson www.jeejeestudio.nl
-------------------------------------------*/

/******************************************************************************************************
 * LANGUAGE FILE - PLEASE READ                                                                        *
 * This is a language file for the Maian Music script. Edit it to suit your own preferences.          *
 * DO NOT edit the $lang[] variable names in any way and be careful NOT to remove any of the          *
 * apostrophe`s (') that contain the variable info. This will cause the script to malfunction.        *
 * USING APOSTROPHES IN MESSAGES                                                                      *
 * If you need to use an apostrophe, escape it with a backslash. ie: d\'apostrophe                    *
 * SYSTEM VARIABLES                                                                                   *
 * Single letter variables with a percentage sign and variables between braces are system variables.  *
 *  ie: %d, %s, {count} etc                                                                           *
 * The system will not fail if you accidentally delete these, but some language may not display       *
 * correctly.                                                                                         *
 ******************************************************************************************************/

/*---------------------------------------------
  CHARACTER SET
  For encoding HTML characters
  Unless specified in language file,
   this may not need altering.
----------------------------------------------*/

define( '_msg_charset','iso-8859-1');
$_msg_author = 'Jerry Janson';
$_msg_website = 'http://www.jeejeestudio.nl';

/*--------------------------------------
  INC/HEADER.PHP
  -------------------------------------*/
  
define( '_msg_public_header','Onze Muziek Download Winkel @ {website}');  
define( '_msg_public_header2','Producten in Winkelwagen');
define( '_msg_public_header3','Meest Populair');
define( '_msg_public_header4','Muziek');
define( '_msg_public_header5','Contact');
define( '_msg_public_header6','Over ons');
define( '_msg_public_header7','Zoeken');
define( '_msg_public_header8','SleutelWoorden');
define( '_msg_public_header9','Premium Beat Flash Player');
define( '_msg_public_header10','Dit systeem gebruikt<br />Premium Beat Flash Player<br /><b>&copy); Premium Beat.com</b>');
define( '_msg_public_header11','Product in Winkelwagen');
define( '_msg_public_header12','Licensie');
define( '_msg_public_header13','MP3 Nummers om te downloaden van onze muziek winkel.');
define( '_msg_public_header14','mp3,downloads,albums,nummers,muziek,muziek winkel');
define( '_msg_public_header15','Meest Populaire Tekst');



/*--------------------------------------
  TEMPLATES/ALBUM.TPL.PHP
  -------------------------------------*/
  
define( '_msg_publicalbum','Beluisteren/Aanschaffen Nummers');  
define( '_msg_publicalbum2 ','Gebruik aub de knoppen om een nummer te beluisteren of aan te schaffen. U mag zoveel nummers aan de winkelwagen toevoegen als u wil voordat u koopt. Dank u wel.');
define( '_msg_publicalbum3 ','Beluisteren');
define( '_msg_publicalbum4 ','Toevoegen aan winkelwagen');
define( '_msg_publicalbum5 ','Naam Nummer');
define( '_msg_publicalbum6 ','Prijs');
define( '_msg_publicalbum7 ','Toevoegen aan winkelwagen');
define( '_msg_publicalbum8 ','Alle nummers aan winkelwagen toevoegen');
define( '_msg_publicalbum9 ','Geselecteerde nummers aan winkelwagen toevoegen');
define( '_msg_publicalbum10','NUmmers Beluisteren');
define( '_msg_publicalbum11','Nummer');
define( '_msg_publicalbum12','Deze pagina is <b>{count}</b> gezien.');
define( '_msg_publicalbum13','Opslaan <b>{amount}</b> %');
define( '_msg_publicalbum14','Gerelateerde Albums');


/*--------------------------------------
  TEMPLATES/CART.TPL.PHP
  -------------------------------------*/
  
define( '_msg_cart ','Winkelwagen');
define( '_msg_cart2','De producten in uw winkelwagen worden hieronder getoond. Gebruik de daarvoor bestemde knoppen als u producten wilt verwijderen. Als u tevereden bent met uw selectie, klik dan \'Checkout\' om verder te gaan:');  
define( '_msg_cart3','Er zijn momenteel 0 producten in uw winkelwagen.');
define( '_msg_cart4','{count} Winkelwagen Producten');
define( '_msg_cart5','Totaal');
define( '_msg_cart6','Wis Winkelwagen');
define( '_msg_cart7','Betalen');
define( '_msg_cart8','Van:');
define( '_msg_cart9','U Bespaart {discount}%');


/*--------------------------------------
  TEMPLATES/CONTACT.TPL.PHP
  -------------------------------------*/

define( '_msg_contact','<div id="mm_contact">Als u enig probleem ervaart, of u wilt ons een vraag stellen over onze muziek, gebruikt u dan alstublieft het formulier hieronder:</div>');
define( '_msg_contact2','Neem contact op');
define('_msg_contact3','Onderwerp');
define('_msg_contact4','Commentaar');
define('_msg_contact5','Stuur Bericht');
define('_msg_contact6','Vul aub een onderwerp in...');
define('_msg_contact7','Vul aub uw commentaar in...');
define('_msg_contact8','Uw bericht is verzonden.<br /><br />Een response zal zo snel mogelijk naar u toe komen.');
define('_msg_contact9','Naam');
define('_msg_contact10','E-Mail Adres');
define('_msg_contact11','Type Code');
define('_msg_contact12','Verkeerde code, probeert u nog eens..');
define('_msg_contact13','Dank u wel!');
define('_msg_contact14','Bericht verzonden!');
define('_msg_contact15','Vul aub uw naam in...');
define('_msg_contact16','Vul aub een geldig e-mail adres in...');
define('_msg_contact17','Klik Captcha om te vernieuwen');


/*--------------------------------------
  TEMPLATES/CONTACT.TPL.PHP
  -------------------------------------*/
  
define('_msg_publichome','Dank u voor uw interresse in onze muziek. Gebruik de muziek link in het linker menu om te navigeren
                              door onze collectie van albums. U kunt losse nummers kopen of complete albums door de juiste knoppen te gebruiken.
                              U kunt ook mp3 muziek beluisteren voordat u koopt.<br /><br />Alle betalingen worden veilig uitgevoerd
                              door Paypal en u heeft geen Paypal rekening nodig om te betalen bij gebruik van uw credit of betaal pas.<br /><br />
                              Neem aub contact op als u vragen heeft, dank u wel!
                         ');  
define('_msg_publichome2','Alle bekende Credit Cards worden geaccepteerd door Paypal');
define('_msg_publichome3','Meest Populaire Nummers');
define('_msg_publichome4','Meest Populaire Albums');


/*--------------------------------------
  TEMPLATES/DOWNLOAD_ITEM.TPL.PHP
  -------------------------------------*/


define('_msg_downloaditem','<br /><br /><span class="sorry">Sorry!</span><br /><br /><span class="sorry_msg">Deze Download is verlopen!</span><br /><br /><br />Neem aub contact op<br />om deze download te herstellen.');  
define('_msg_downloaditem2','<br /><br /><span class="sorry">Fout!</span><br /><br /><span class="sorry_msg">U heeft geen recht<br />om deze pagina te bekijken!</span><br /><br /><br />Neem aub contact op<br />als u van mening bent dat dit niet correct is.');  


/*--------------------------------------
  TEMPLATES/MUSIC.TPL.PHP
  -------------------------------------*/

define('_msg_music','Klik aub op de link om meer informatie te krijgen over een album of nummers te beluisteren/kopen. Dank u wel.');
define('_msg_music2','Meer Informatie');
define('_msg_music3','Nummers: {count}');


/*--------------------------------------
  TEMPLATES/PAYPAL/CANCEL.TPL.PHP
  TEMPLATES/PAYPAL/CHECKOUT.TPL.PHP
  TEMPLATES/PAYPAL/DOWNLOAD.TPL.PHP
  TEMPLATES/PAYPAL/ERROR.TPL.PHP
  TEMPLATES/PAYPAL/THANKS.TPL.PHP
  -------------------------------------*/
  
define('_msg_paypal','Verbinden met Paypal server.....Even geduld aub....');  
define('_msg_paypal2','Muziek Winkel Aankopen');
define('_msg_paypal3','Transactie Geannuleerd!');
define('_msg_paypal4','Uw transactie is succesvol geannuleerd en er is geen betaling verstuurd.<br /><br />Dank u voor uw interesse in onze muziek.');
define('_msg_paypal5','Ongeldige Transactie!');
define('_msg_paypal6','Dit blijkt een ongeldige transactie te zijn omdat de betaling niet klopt met het bedrag in de winkelwagen.<br /><br />De webmaster is geinformeerd en kan verder actie ondernemen.<br /><br />Als u van mening bent dat dit niet klopt, gebruik dan de contact link in het linker menu.<br /><br />Dank u wel.');
define('_msg_paypal7','Dank u wel!');
define('_msg_paypal8','Uw transactie is succesvol verlopen.<br /><br />
                              Controleer aub uw e-mail van "<b>{email}</b>". Dit bevat een download link naar de muziek die u heeft aangeschaft. Klik aub op deze link om naar de download pagina te gaan. Als u deze e-mail niet ontvangt, neem dan aub contact op via de link in het linker menu.<br /><br />
                              Ik hoop dat u van uw muziek geniet,<br /><br />
                              <b>{store}</b>');
define('_msg_paypal9','Er is een fout opgetreden!');
define('_msg_paypal10','U heeft geen toegang tot deze pagina, sorry.');  
define('_msg_paypal11','Er is geen aankoop data gevonden. Controleer aub nogmaals de link die u heeft geklikt in uw e-mail.<br/><br />Als u van mening bent dat er iets is fout gegaan, neem dan contact op via het linker menu.<br /><br />Dank u wel.');                            
define('_msg_paypal12','Download Pagina is Verlopen!');
define('_msg_paypal13','Deze link is verlopen en geeft geen toegang meer. Ons systeem blokkeert uit veiligheids overwegingen automatisch de download pagina als deze een aantal keren is bezocht.<br /><br />
                              Als u nogmaals toegang nodig heeft tot deze pagina, neem dan contact op via het linker menu om de toegang te herstellen.<br /><br />
                              Excuses voor het ongemak,<br /><br />
                              <b>{store}</b>');
define('_msg_paypal14','Download Pagina');
define('_msg_paypal15','Dank u voor uw aankoop, uw downloads worden hieronder getoond.<br /><br />Ververs aub deze pagina <b>NIET</b> en voeg hem ook niet aan uw favorieten toe omdat deze verlopen kan zijn als u terugkeert.<br /><br />U bent toegestaan om elk bestand {duration}. Als u een probleem ervaart, gebruik dan de contact link in het linker menu.');                              
define('_msg_paypal16','eenmaal');
define('_msg_paypal17','tweemaal');
define('_msg_paypal18','keer');
define('_msg_paypal19','Albums Gekocht');
define('_msg_paypal20','NUmmers Gekocht');
define('_msg_paypal21','Geen album aankoop data gevonden');
define('_msg_paypal22','Geen nummers aankoop data gevonden');
define('_msg_paypal23','Wij hopen dat u geniet van uw muziek!');
define('_msg_paypal24','Download Nummer');
define('_msg_paypal25','Download Hoesjes');
define('_msg_paypal26','Download Nummers');
define('_msg_paypal27','Bestand bestaat niet!');
define('_msg_paypal28','Alle Nummers =');
define('_msg_paypal29','Klik de knop(pen) om te downloaden!');
define('_msg_paypal30','Terug naar vorige pagina');
define('_msg_paypal31','Download Verlopen');


/*--------------------------------------
  TEMPLATES/SEARCH.TPL.PHP
  -------------------------------------*/

define('_msg_publicsearch','Zoek resultaten');
define('_msg_publicsearch2','Uw zoek resultaten voor "<b>{keywords}</b>" worden hieronder getoond. Als uw zoekactie niets opleverd, probeer dan meerdere woorden door een spatie gescheiden om meer gedetailleerd te zoeken.');
define('_msg_publicsearch3','<br /><b>Niets gevonden...Probeer aub nogmaals...</b>');
define('_msg_publicsearch4','{count} Zoek Resultaten');


/*--------------------------------------
  ADMIN/INC/HEADER.PHP
  -------------------------------------*/

define('_msg_header','Administratie');
define('_msg_header2','Start');  
define('_msg_header3','Instellinen');  
define('_msg_header4','Beheer Albums');  
define('_msg_header5','Voeg nieuwe Nummers toe');  
define('_msg_header6','Beheer Nummers');  
define('_msg_header7','Verkopen');  
define('_msg_header8','Zoek Verkopen'); 
define('_msg_header9','Navigatie Menu');
define('_msg_header10','Beheer Categories'); 
define('_msg_header11','Statistieken');
  
  
/*--------------------------------------
  ADMIN/INC/FOOTER.PHP
  TEMPLATES/FOOTER.TPL.PHP
  -------------------------------------*/

define('_msg_footer','Kopierecht');
define('_msg_footer2','Alle Rechten Gereserveerd');  
define('_msg_footer3','Activeer aub javascript in uw browser. Dank u wel!');


/*--------------------------------------
  ADMIN/DATA_FILES/ADD.PHP
  -------------------------------------*/
  
define('_msg_add','Hier voegt u uw mp3/mp4 nummers toe. Zorg dat u voor toevoegen, volle lengte &amp); beluister nummers ge-upload hebt in de mappen die u heeft gespecificeerd in de instellingen. GEbruik het uitklap menu hieronder om
                              aan te geven hoeveel nummers u wilt toevoegen en vul daarna alle details in van elk nummer. Gebruik de help links als je het niet helemaal begrijpt.<br><br>
                              <i>Het bestand wordt niet toegevoegd als u vergeet om de naam, mp3 bestandspad of de prijs in te voeren.</i>');  
define('_msg_add2','Nummers toe te voegen');
define('_msg_add3','Hoeveel nummers wilt u toevoegen? U kunt dit elke keer verversen en er gaat geen data verloren.');
define('_msg_add4','Nummer');
define('_msg_add5','Voeg Nummers toe');
define('_msg_add6','Naam Nummer');
define('_msg_add7','Voeg toe aan Album');
define('_msg_add8','MP3 Bestands pad');
define('_msg_add9','Beluister Bestands pad');
define('_msg_add10','Lengte va Nummer');
define('_msg_add11','Prijs');
define('_msg_add12','Losse Aankoop');
define('_msg_add13','<b>{count}</b> nummers zijn succesvol toegevoegd.<br><br>Gebruik het menu hierboven om de nummers te beheren.');
define('_msg_add14','Bekijken');
define('_msg_add15','voor alle nummers.');


/*--------------------------------------
  ADMIN/DATA_FILES/ALBUMS.PHP
  -------------------------------------*/
  
define('_msg_albums','MP3s zijn ondergebracht in albums. Als u nummers toevoegd, dient u
                              te specificeren in welk album het moet. Bezoekers kunnen losse nummers of hele albums aankopen. Als u een nieuw album toevoegd wordt het hieronder getoond.');  
define('_msg_albums2','Album');
define('_msg_albums3','Album Naam');
define('_msg_albums4','Huidige Albums -- Klik op de naam om te wijzigen');
define('_msg_albums5','Album Afbeelding URL');
define('_msg_albums20','Albums');
define('_msg_albums21','Hoogte:');
define('_msg_albums22','Breedte:');
define('_msg_albums6','Album Hoes (Zip File)');
define('_msg_albums7','Commentaar/Info');
define('_msg_albums8','Activeer Album');
define('_msg_albums9','Er zijn momenteel geen albums in de database.');
define('_msg_albums10','Vernieuw Album');
define('_msg_albums11','Artiest');
define('_msg_albums12','Sleutelwoorden');
define('_msg_albums13','Downloads');
define('_msg_albums14','Herstel Nummer Downloads');
define('_msg_albums15','Hits');
define('_msg_albums16','Categorie');
define('_msg_albums17','Top Album');
define('_msg_albums18','Volgend Album van');
define('_msg_albums19','Album Aankoop Korting');


/*--------------------------------------
  ADMIN/DATA_FILES/HOME.PHP
  -------------------------------------*/
  
define('_msg_home','Welkom bij Maian Music voor Joomla, een makkelijke muziek winkel dat u in staat stelt uw muziek te verkopen en te laten beluisteren
                              in mp3/mp4 formaat.  Dit script is orgineel geschreven door<a href="http://www.maianscriptworld.co.uk" title="Maian Script World" target="_blank">Maian Script World</a> en is nu geconverteerd voor Joomla door <a href="http://www.aretimes.com" title="Are Times" target="_blank">Are Times</a>.
                              Om dit systeem te gebruiken heeft u een paypal bussiness rekening nodig.  Het is aangeraden om Automatisch Terugkeer te activeren voor een beter gestroomlijnde klanten ervaring.  Wanneer u dit componnet configureert kijk dan naar de
                               [<b><span style="color:#FF7700">?</span></b>] tooltips voor meer informatie.<br><br> 
                              Als u problemen heeft, post ze dan op <a href="http://www.aretimes.com" title="Support Forums" target="_blank">support forums</a>.<br><br>
                              Neem aub contact op via onze website als u suggesties of fouten gevonden hebt. <br><br>
                              Ik hoop dat u geniet van uw muziek systeem,<br><br>Alao.<br><br><b>Are Times</b><br><a href="http://www.aretimes.com" title="Are Times" target="_blank">http://www.aretimes.com</a>
                         ');
define('_msg_dedicate','<br><br>Opgedragen aan Lamar Anthony Pierce A.K.A <a href="http://www.myspace.com/thereallooch title="Are Times" target="_blank">Looch</a>');
define('_msg_home2','Donatie');                                
define('_msg_home3','Als dit script u bevalt en u wilt ons steunen geef dan aub een donatie of koop muziek van Are Times');
define('_msg_home4','Donaties zijn niet noodzakelijk, maar worden wel erg gewaardeerd. Dank u wel!');
define('_msg_home5','Muziek Winkel Overzicht');
define('_msg_home6','U heeft momenteel <b>{tracks}</b> nummers, ondergebracht in <b>{albums}</b> albums.<br><br>
                              Paypal Vergoeding: <b>{fees}</b><br>
                              Winst: <b>{profit}</b><br><br>
                              <b>{a_purchases}</b> albums en <b>{t_purchases}</b> losse nummers zijn momenteel verkocht.
                         ');
                         
                              
/*--------------------------------------
  ADMIN/DATA_FILES/LOGIN.PHP
  -------------------------------------*/   
  
define('_msg_login','Administratie Login');                             
define('_msg_login2','Login aub in uw administratie gedeelte hieronder:');
define('_msg_login3','Gebruikersnaam');
define('_msg_login4','Wachtwoord');
define('_msg_login5','Login');
define('_msg_login6','Fout');
define('_msg_login7','Herinner mij');


/*--------------------------------------
  ADMIN/DATA_FILES/SALES.PHP
  -------------------------------------*/
  
define('_msg_sales','Uw uitgevoerde verkopen worden hieronder getoond. Gebruik de bestelling via opties indien nodig. Gebruik de links om uw verkopen te behren of om uw klanten te contacteren. Als u een toevoeging moet vinden, gebruik dan de zoek optie via het menu.');  
define('_msg_sales2','Bekijk');
define('_msg_sales3','Per Pagina');
define('_msg_sales4','Nieuwste Verkopen');
define('_msg_sales5','Oudste Verkopen');
define('_msg_sales6','Nummers Verkocht');
define('_msg_sales7','Albums Verkocht');
define('_msg_sales8','Hoogste Bruto');
define('_msg_sales9','Laagste Bruto');
define('_msg_sales10','Klant Namen A-Z');
define('_msg_sales11','Klant Namen Z-A');
define('_msg_sales12','Bekijk {count} Verkopen');
define('_msg_sales13','Er zijn momenteel <b>0</b> verkopen in de database.');
define('_msg_sales14','Verwijder Geselecteerde Verkopen');
define('_msg_sales15','Albums Verkocht');
define('_msg_sales16','Nummers Verkocht');
define('_msg_sales17','<b>0</b> albums verkocht.');
define('_msg_sales18','<b>0</b> nummers verkocht.');
define('_msg_sales19','door');
define('_msg_sales20','Albums');
define('_msg_sales21','Nummers');
define('_msg_sales22','Bekijk Verkoop Informatie');
define('_msg_sales23','Contacteer Koper');
define('_msg_sales24','Onderwerp');
define('_msg_sales25','Commentaar');
define('_msg_sales26','Of als u een e-mail client hebt, klik <a href="mailto:{email}" title="Klik om launch e-mail client te starten"><b><u>hier</u></b></a>.');
define('_msg_sales27','Bericht Verzonden!');
define('_msg_sales28','Verzonden Bericht');
define('_msg_sales29','Herstel Downloads &amp); Stuur nogmaals Download E-Mail');
define('_msg_sales30','Klant/Paypal Informatie');
define('_msg_sales31','E-Mail verstuurd aan klant!');
define('_msg_sales32','Klik om te bekijken');
define('_msg_sales33','Klant');
define('_msg_sales34','E-Mail');
define('_msg_sales35','Datum');
define('_msg_sales36','Adres');
define('_msg_sales37','Klant Memo');
define('_msg_sales38','Betaal Status');
define('_msg_sales39','Bruto/Vergoeding/Totaal');
define('_msg_sales40','Paypal Transactie ID');
define('_msg_sales41','Registratie Nr');


/*--------------------------------------
  ADMIN/DATA_FILES/SEARCH.PHP
  -------------------------------------*/
  
define('_msg_search','Deze optie laat u zoeken naar uw verkopen. Handig als u veel verkopen heeft en een specifieke moet vinden. Spcificeer uw criteria hieronder. U kunt één of alle zoek termen typen, maar u moet minimaal één optie geven:');
define('_msg_search2','Typ Zoek Criteria');
define('_msg_search3','Waar \'name\' is als');
define('_msg_search4','Waar \'e-mail\' is als');
define('_msg_search5','Waar \'invoice no\' =');
define('_msg_search6','Waar \'trans id\' =');
define('_msg_search7','Waar \'date\' tussen');
define('_msg_search8','Zoeken');
define('_msg_search9','Niets gevonden...Probeer aub nogmaals te zoeken...');
define('_msg_search10','Zoek Resultaten');
define('_msg_search11','Uw zoek resultaten worden hieronder getoond');
define('_msg_search12','Nieuwe zoekactie');


/*--------------------------------------
  ADMIN/DATA_FILES/SETTINGS.PHP
  -------------------------------------*/
  
define('_msg_settings','Update uw instellingen hieronder. Alle velden invullen tenzij vermeld als optioneel.');  
define('_msg_settings2','Website/Hoofd Instellingen');
define('_msg_settings3','Muziek Winkel Naam');
define('_msg_settings4','E-Mail Adres');
define('_msg_settings5','HomePage URL');
define('_msg_settings6','Pad naar Installatie Folder');
define('_msg_settings7','Taal');
define('_msg_settings8','Activeer Captcha');
define('_msg_settings9','MP3/Download Instellingen');
define('_msg_settings10','MP3 Folder Pad');
define('_msg_settings11','MP3 Beluister Folder Pad');
define('_msg_settings12','Wijzig Instellingen');
define('_msg_settings13','Zoek Machine Vriendelijke URLs');
define('_msg_settings14','Paypal Instellingen');
define('_msg_settings15','Activeer Paypal IPN');
define('_msg_settings16','Activeer Sandbox');
define('_msg_settings17','Live');
define('_msg_settings18','Log Fouten');
define('_msg_settings19','Pagina Stijl');
define('_msg_settings20','Paypal E-Mail Adres');
define('_msg_settings21','Munt eenheid');
define('_msg_settings22','');
define('_msg_settings23','Pagina(s) Tekst');
define('_msg_settings24','<a href="http://en.wikipedia.org/wiki/HTML" title="Hypertext Markup Language" target="_blank">HTML</a> is toegestaan');
define('_msg_settings25','Download Pagina Verloopt');
define('_msg_settings26','Totaal Albums voor RSS Feed');
define('_msg_settings27','Totaal Populaire Links');
define('_msg_settings28','SSL Geactiveerd');
define('_msg_settings29','SMTP Poort');
define('_msg_settings30','Herstel Alle Album Hits');
define('_msg_settings31','Download Item Verloopt');
define('_msg_settings32','Licencie Pagina Tekst');
define('_msg_settings33','SMTP Instellingen');
define('_msg_settings34','Activeer SMTP');
define('_msg_settings35','SMTP Host');
define('_msg_settings36','SMTP Gebruikersnaam');
define('_msg_settings37','SMTP Wachtwoord');
define('_msg_settings38','Mp3 Speler Configuratie');
define('_msg_settings39','Speler');
define('_msg_settings40','Betaling Data Transfer');
define('_msg_settings41','Standaard Pagina Page');
define('_msg_settings42','Meest Populair');
define('_msg_settings43','Muziek');
define('_msg_settings44','Muziek Pagina Tekst');

/*--------------------------------------
  ADMIN/DATA_FILES/STATISTICS.PHP
  -------------------------------------*/

define('_msg_statistics','Deze pagina laat u in één oogopslag zien hoevaak een album of nummer is verkocht. Klik de knoppen om eenalbum te ontvouwen voor nummer statistieken.
                         ');
define('_msg_statistics2','Sorteer op');
define('_msg_statistics3','Meeste Hits');
define('_msg_statistics4','Minste Hits');
define('_msg_statistics5','Album');
define('_msg_statistics6','Los nummer');
define('_msg_statistics7','Hits: <b>{hits}</b> | Albums Verkocht: <b>{albums}</b> | Nummers Verkocht: <b>{tracks}</b>');
define('_msg_statistics8','Bekijk Nummer Statistieken');
define('_msg_statistics9','Dit geeft een lijst weer van elk nummer van dit album en het totaal aantal verkopen voor elk nummer.');
define('_msg_statistics10','Alles Uitvouwen');
define('_msg_statistics11','Alles Invouwen');


/*--------------------------------------
  ADMIN/DATA_FILES/TRACKS.PHP
  -------------------------------------*/
  
define('_msg_tracks','Deze pagina kunt u uw huidige nummers beheren. Selecteer een album hieronder om de nummers in dat album te zien en gebruik de knoppen om de nummers te wijzigen.');  
define('_msg_tracks2','<b>{count}</b> nummers');
define('_msg_tracks3','Nummers Bekijken');
define('_msg_tracks4','Geen Nummers');


/*--------------------------------------
  ADMIN/DATA_FILES/VIEW_TRACKS.PHP
  -------------------------------------*/
  
define('_msg_viewtracks','Wijzig Nummers');  
define('_msg_viewtracks2','Klik op de links om een nummers te wijzigen. U kunt elk nummer wijzigen of verwijderen en ook de volgorde veranderen als optie
                              zoals de nummers zullen worden weergegeven voor bezoekers.');
define('_msg_viewtracks3','Wijzig dit Nummer');
define('_msg_viewtracks4','Naar Boven');
define('_msg_viewtracks5','Naar Onder');
define('_msg_viewtracks6','Dit album heeft momenteel geen nummers');
define('_msg_viewtracks7','Annuleer');
define('_msg_viewtracks8','Nummer succesvol gewijzigd!');
define('_msg_viewtracks9','Verversen');


/*---------------------
  RESPONSE DATA FOR IPN
  PAYPAL E-MAILS
----------------------*/

define('_msg_ipn','Bestelling Ongeldig');
define('_msg_ipn2','Paypal IPN Fout!!');
define('_msg_ipn3','Indien geactiveerd, wordt deze fout gelogd in het log bestand.');
define('_msg_ipn4','De volgende opgave is ontvangen van (en retour gestuurd naar) PayPal:');
define('_msg_ipn5','Betaling ging Fout');
define('_msg_ipn6','Betaling Geweigerd');
define('_msg_ipn7','Onbekende Betaling Status');
define('_msg_ipn8','Muziek Winkel Aankoop in afwachting!');
define('_msg_ipn9','Ongeldige Aankoop Transactie!');
define('_msg_ipn10','Muziek Download Informatie!');
define('_msg_ipn11','Muziek Winkel Transactie!');


/*-------------------------------------
  GENERAL VARIABLES
  ------------------------------------*/

define('_msg_script','Maian Music v1.2');
define('_msg_script2','Ja');
define('_msg_script3','Nee');
define('_msg_script4','Optioneel');
define('_msg_script5','Eerste');
define('_msg_script6','Laatste');
define('_msg_script7','Wijzig');
define('_msg_script8','Verwijder');
define('_msg_script9','Annuleer');
define('_msg_script10','Ververs');
define('_msg_script11','Print');
define('_msg_script12','ongelimiteerd');


/*-----------------------------
  RSS Feeds
-------------------------------*/

define('_msg_rss','Laatste albums @ {website_name}');
define('_msg_rss2','Dit zijn de laatste albums toegevoegd aan {website_name}');
define('_msg_rss3','Album:');


/*----------------------
  ADMIN/INC/CALENDAR.PHP
-----------------------*/

define('_msg_calendar','Januari');
define('_msg_calendar2','Februari');
define('_msg_calendar3','Maart');
define('_msg_calendar4','April');
define('_msg_calendar5','Mei');
define('_msg_calendar6','Juni');
define('_msg_calendar7','Juli');
define('_msg_calendar8','Augustus');
define('_msg_calendar9','September');
define('_msg_calendar10','Oktober');
define('_msg_calendar11','November');
define('_msg_calendar12','December');


/*--------------------------------------------------------------------------------------------------
  ZIP FILE FOLDER NAMES
  These are the names of the folders that are created inside the zip file when someone downloads 
  an album or track. These should NOT contain any illegal characters that may prevent the creation 
  of the folder. If you are unsure, leave them as they are
  --------------------------------------------------------------------------------------------------*/
  
define('_msg_folder','nummer');
define('_msg_folder2','album');
  

/*-----------------------------------------------------------------------------------------------------
  JAVASCRIPT VARIABLES
  IMPORTANT: If you want to use apostrophes in these variables, you MUST escape them with 3 backslashes
             Failure to do this will result in the script malfunctioning on javascript code. Unless you
             specifically need them, using double quotes is recommended.
  EXAMPLE: d\\\'apostrophe
------------------------------------------------------------------------------------------------------*/

define('_msg_javascript','Help/Informatie');
define('_msg_javascript2','Volledige url naar folder met bestanden. GEEN eind slash.<br><br><b>http://www.jouwsite.nl/muziek</b>');
define('_msg_javascript3','Een captcha kan spam helpen tegenhouden via de contact optie. De <b>GD Library met Freetype support</b> is is nodig op uw server om dit te laten werken. Zie de documentatie voor meer info.');
define('_msg_javascript4','MP3 bestanden worden het best opgeslagen buiten de web root. Dit is het relatieve pad van de muziek root folder naar de MP3 folder. Benoem hem handmatig en wees zeker dat hij bestaat. GEEN eind slash.<br><br><b>../mp3</b>');
define('_msg_javascript5','Zelfde als hierboven, maar dit is het pad naar de beluister MP3 folder. Dit kan naast of in de bovengenoemde MP3 folder. GEEN eind slash.<br><br><b>../mp3/mp3_beluister</b>');
define('_msg_javascript6','Activeerd mod_rewrite voor zoek machine vriendelijke urls. Om dit te laten functioneren moet uw server <b>.htaccess</b> ondersteunen. Eenmaal geactiveerd, hernoem <b>htaccess_COPY.txt</b> bestand naar <b>.htaccess</b><br><br>Kan een server fout genereren indien geactiveerd en <b>.htaccess</b> niet wordt ondersteund.');
define('_msg_javascript7','Met Paypal kunt u een test uitvoeren zonder daadwerkelijk te betalen. Dit is de <b>sandbox</b> mode en meer details kunnen hier <a href="https://developer.paypal.com" title="Sandbox" target="_blank">gevonden worden</a>.<br><br>Vink aan om sanbox te activeren. Vink uit voor echte betaling.');
define('_msg_javascript8','Dit is uw business of premier rekening paypal e-mail adres.');
define('_msg_javascript9','Paypal maakt het mogelijk om een pgina stijl te creeeren in uw MijnPaypal. Als u er één heeft, specificeer de naam dan hier. Laat leeg voor geen pagina stijl.');
define('_msg_javascript10','Als er een ongeldige response terug komt van Paypal, kunt u de fout loggen. Dit is handig voor debuggen en ik raad aan dit geactiveerd te laten tijdens testen.');
define('_msg_javascript11','Spcificeer de munt eenheid. Deze lijst laat zien welke door Paypal ondersteund worden ten tijde van het schrijven van dit script.');
define('_msg_javascript12','Als u een voorbeschouwings afbeelding heeft van dit album, specificeer dan de volle url startend met http://<br><br>Merk op dat de standaard maat <b>65</b>x<b>65</b> pixels is.<br><br><i>(Optioneel)</i>');
define('_msg_javascript13','Als een klant een volledig album koopt en u wilt hem of haar ook de hoesjes laten downloaden, zet deze bestanden dan in een .zip bestand, upload en specificeer het pad hier startend met http://<br><br>Als iemand een volledig album koopt, wordt deze link bijgevoegd samen met de download link voor de mp3s.<br><br><i>(Optioneel)</i>');
define('_msg_javascript14','Zet de status voor dit album. Indien gedeactiveerd, wordt het niet getoond aan het publiek.');
define('_msg_javascript15','Weet u het zeker?\n\nDit zal ook de mp3 bestanden wissen verbonden aan dit album.\n\nMerk op dat de physieke bestanden handmatig verwijdert dienen te worden.');
define('_msg_javascript16','Specificeer <b>ALLEEN</b> hier het mp3 bestands pad, tenzij u het mp3 bestand in een andere map hebt in de hoofd mp3 map. Dit bestand moet ge-upload worden in de relevante map. Voorbeelden:<br><br><b>muziek_bestand.mp3</b><br><b>album1/muziek_bestand.mp3</b>');
define('_msg_javascript17','Als u een korter beluister nummer wil gebruiken, specificeer dan de bestandsnaam hier. Dit bestand moet bestaan in uw beluister map vermeld in de instellingen. Indien er geen beluister bestand is toegevoegd, dan wordt de volle lengte afgespeeld.<br><br>Optioneel');
define('_msg_javascript18','Specificeer de lengte van het nummer. Voorbeelden:<br><br>4:32<br>4min 32 seconden<br>4-32');
define('_msg_javascript19','Specificeer de prijs van het nummer. GEEN munteenheid voor de prijs zetten. Dus stel u verkoopt voor &pound);0.75 type dan <b>0.75</b>.');
define('_msg_javascript20','Is dit nummer bestemd voor losse verkoop? Zo niet, dan kan het nummer alleen gekocht worden door het gehele album te kopen.');
define('_msg_javascript21','Weet u zeker dat u het nummer wilt wissen?');
define('_msg_javascript22','Type sleutelwoorden die het best bij uw album passen. Dit verschijnt meta sleutelwoorden head tag op de pagina.');
define('_msg_javascript23','Als u korting wilt geven op een geheel album, specificeer dan het percentage hier. 0 voor geen korting.');
define('_msg_javascript24','Als iemand nummers koopt, wordt de link voor de download pagina toegestuurd. Om te voorkomen dat de link wordt doorgestuurd naar derden kunt u specificeren hoevaak de pagina bezocht mag worden voordat de link verloopt. <b> 0 voor ongelimiteerd</b>.');
define('_msg_javascript25','Weet u zeker dat u uw winkelwagen wilt legen?');
define('_msg_javascript26','Dit item wissen?');
define('_msg_javascript27','Deze reset alle download tellers. Voor individuele albums, de optie bij het bewerken van albums gebruiken. Voor individuele nummers, de optie bij het bewerken van nummers gebruiken.');
define('_msg_javascript28','Als u dit activeerd zal de download-teller voor alle nummers op 0 gezet worden.');
define('_msg_javascript29','Als u dit activeerd worden alle hits voor deze albums op 0 gezet worden. Om individuele albums te beheren, dient u de albums beheer pagina te gebruiken.');
define('_msg_javascript30','Dit is de limiet dat een verkoop gedownload kan worden. <b>Zet op 0 voor ongelimiteerd</b>.');
define('_msg_javascript31','Houdt u ingelogd voor 30 dagen. <b>NOT</b> aanbevolen voor gedeelde computers.<br /><br />Cookies moeten toegelaten worden om dit te laten werken.');
define('_msg_javascript32','Sommige hosts deactiveren de PHP mail functie en moet de SMTP mail functie gebruiken. Als mailen niet werkt gebruik dan deze optie. Als u uw SMTP details niet weet, contacteer dan uw hosting bedrijf.');
define('_msg_javascript33','Bent u zeker dat u de verkopen wilt wissen?');
define('_msg_javascript34','Weet u het zeker?');
define('_msg_javascript35','Als uw site op een Secure Socket Laag zit (SSL), activeer dan SSL om de betaling veilig geretouneerd te krijgen. Zet dit <b>NIET</b> aan als u geen SSL certificaat geinstalleerd hebt op uw server.');
define('_msg_javascript36','Hoeveel laatste albums wilt u getoond hebben op de RSS feed? Max 999');
define('_msg_javascript37','Hoeveel populaire links wilt u getoond hebben op uw thuispagina? Max 999');
define('_msg_javascript38','Om uw Idenity Token van uw Paypal profiel te verkrijgen, ga naar:<br><br><b>Profiel ->Website Betalings Instellingen</b><br><br> Activeer Betalings Data Transfer en kopieer en plak uw Identity Token');
define('_msg_javascript39','Bepaalt naar welke pagina het component standaard verwijst');
/*-----------------------------------------------------------------------------------------------------

  Pre-installiation check. 

------------------------------------------------------------------------------------------------------*/

define('_setup15','CURL Ondersteuning <i>(Paypal Proces)</i>');
define('_setup16','PHP Versie');
define('_setup17','Compatibiliteits Check, indien niet goed neem contact op met uw host');
define('_setup18','GD Graphisch Ondersteuning <i>(Captcha)</i>');
define('_setup19','<font style="color:orange">OK</font>');
define('_setup20','<font style="color:red">Niet Geinstalleerd</font>');
define('_setup22','<font style="color:red">Versie Te Oud</font>');


/*-----------------------------------------------------------------------------------------------------

  New 1.3 text. 

------------------------------------------------------------------------------------------------------*/
define('_msg_op_cancel','Operatie Geannuleerd');
define('_setup23','Importeer 1.0 Tabellen');
define('_setup24','Open Source Credits');
define('_setup25','Aanpassen');
define('_setup26','Systeem Controle');
define('_setup27','Taal Bestanden');
define('_setup28','Flash Players');
define('_setup29','Start Importeren');
define('_setup33','Start Systeem Controle');
define('_setup30','Systeem Controle Resultaten');
define('_setup31','Uw Versie');
define('_setup32','Huidige Versie');

define('_msg_tableh1','Titel');
define('_msg_tableh2','Gepubliceerd');
define('_msg_tableh3','Alias');
define('_msg_tableh4','Volgorde');

define('_msg_categories','Categorieën');
define('_msg_categories1','Categorie');
define('_msg_categories_desc','U kunt catergorieën creëren om uw albums te groeperen.  Een album kan gecreëerd worden zonder dat het tot een categorie behoort maar dan wordt het niet getoond bij het categorieën bekijken');
define('_msg_categories2','Er zijn momenteel geen categorieën in de database.');


define('_msg_discount','Korting');

define('_msg_settings46','Bewaar Winkelwagen Data');
define('_msg_settings47','Activeer Ajax');
define('_msg_settings48','Zoek Veld Insluiten');
define('_msg_settings49','Extra PayPal E-Mail Adres');
define('_msg_settings50','Minimum Betaling');
define('_msg_settings51','Geef Download Link weer na Aanschaf');
define('_msg_settings52','Toon Navigatie');
define('_msg_settings53','Gebruik EnlargeIt');

define('_msg_albums_error','Error: Eén of Meer Albums konden niet gewist worden');
define('_msg_albums21','Album(s) Gewist');
define('_msg_albums22', 'Album Gepubliceerd');
define('_msg_albums23', 'Album Toegevoegd!');

define('_msg_tracks5','Aantal Nummers');
define('_msg_tracks6','Selecteer Bestand: ');
define('_msg_tracks7','Grootte: ');
define('_msg_tracks8','Type: ');
define('_msg_tracks9','Sub Folder Toevoegen: ');
define('_msg_tracks10','Link Naar: ');
define('_msg_tracks11','Kon {PATH} niet vinden. Corrigeer dit aub bij de instellingen');
define('_msg_tracks12','Er is een fout opgetreden, kon bestand niet uploaden.');
define('_msg_tracks13','Uploaden Succesvol: ');

define('_msg_upload_error1','Kon niet uploaden naar: ');
define('_msg_upload_error2','en ik weet niet waarom.');

define('_msg_tools','Maian Music Tabellen');
define('_msg_tools2','<font style="color:orange">Gevonden</font>');
define('_msg_tools3','<font style="color:red">Niet Gevonden</font>');
define('_msg_tools4','<font style="color:red">Waarschuwing!!!! Het uitvoeren van deze import kan ieder bestaande data overschrijven in uw huidige 1.5 tabelen.</font>');

define('_msg_collapse_all','Alles Uitklappen');
define('_msg_expand_all','Alles Inklappen');

define('_msg_javascript41','Dit bepaalt hoeveel dagen ongebruikte data in de winkelwagen blijft.  Indien niet ingevuld is de standaard 14 dagen.  Wees voorzichtig dit niet te hoog te zetten omdat de database tabel dan erg groot wordt, in het bijzonder als veel bezoekers op uw site heeft.');
define('_msg_javascript42','Als u Micro Payments geimplementeerd hebt op uw primare Paypal Bussiness Account, kunt u hier een additionele paypal e-mail adres invullen om uw winst te maximaliseren.');
define('_msg_javascript43','Alle betalingen groter dan de gegeven waarde worden afgehandeld via dit account.  Als bijvoorbeeld 10 is ingegeven dan wordt elke betaling boven 10 afgehandeld via dit 2e paypal account.');
define('_msg_javascript44','Laat de zoek tekst box en button zien in de header');
define('_msg_javascript9','Paypal geeft u de mogelijkheid om uw eigen style te creëen in uw Paypal pagina. Specificeer de naam hier indien u er een heeft. Laat leeg voor geen pagina stijl.');
define('_msg_javascript40','Dit activeerd een ajax winkelwagen op de front end. Indien leeg dan wordt de standaard winkelwagen gebruikt.');
define('_msg_javascript_show_link','Dit geeft een download link weer na een succesvolle transactie op de Bedankt pagina.');
define('_msg_javascript45','Dit toont een navigatiesysteem koptekst op alle pagina\'s');
define('_msg_javascript46','Dit zal het album beeld vergroten wanneer de gebruiker klikt op het album art.');

define('_msg_free_download','Gratis Download\'s');
define('_msg_go_to_download','Ga Naar Download');
define('_msg_download_message','Voor uw gemak is hieronder een download link geplaatst');
define('_msg_download_message2','Uw e-mailadres is toegevoegd. U kunt nu download gratis tracks.');

define('_msg_require_field', 'is een verplicht veld.');
define('_msg_invalid_email', 'is een ongeldig e-mail adres.');

define('_msg_no_download', 'Niet beschikbaar voor download.');

define('_msg_name', 'Naam');
define('_msg_email', 'E-mail');
define('_msg_submit', 'Indienen');
define('_msg_no_free', 'Op dit moment worden er geen gratis downloads aangeboden.');
define('_msg_must_provide', 'Moet geldig e-mailadres voordat u kunt downloaden van een track.');

define('_msg_albumsnameAZ','Album Naam A-Z');
define('_msg_albumsnameZA','Album Naam Z-A');
define('_msg_artistAZ','Artiest Naam A-Z');
define('_msg_artistZA','Artiest Naam Z-A');

define('_msg_enlarge','Klik voor een grotere afbeelding');

define('_msg_publichome5','Laatste Albums');
define('_msg_publichome6','Laatste Nummers');

define('_msg_backup','Backup Tabbelen');
define('_msg_backup2','Start Backup');
define('_msg_backup3','<font style="color:red">Waarscuwing!!!! Het uitvoeren van deze backup overschrijft alle data die u momenteel heeft van een vorige backup.</font>');
define('_msg_backup4','<font style="color:green">Creëer</font>');
define('_msg_backup5','Er is een fout opgetreden tijdens de backup van de tabellen. Gebruik aub PHPMyAdmin en maak handmatig een backup');
define('_msg_backup6','De backup van uw tabellen is geslaagd');

define('_msg_import','Er is een fout opgetreden tijdens het importeren van uw tabellen');
define('_msg_import2','Uw 1.0 Tabellen zijn succesvol geimporteerd');
define('_msg_error_bind','Probleem Binden');
define('_msg_error_check','Probleem Controle');
define('_msg_error_store','Probleem Opslaan');

define('_msg_csv','Export naar CSV');
define('_msg_csv_album','Bij Album');
define('_msg_csv_sale','Bij verkoop');

define('_msg_RM','RM Number');
define('_msg_UPC','UPC');

define('_msg_newsletter','Nieuwsbrief Systeem Niet geïnstalleerd');
define('_msg_return_to','Terug naar de vorige pagina');

define('_msg_append','Append URL');
define('_msg_label','Etiket');
define('_msg_javascript47','Als uw previews zijn binnen uw websites root map kunt u append de url voor de flash-spelers.');
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
