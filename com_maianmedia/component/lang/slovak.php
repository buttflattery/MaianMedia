<?php

/*------------------------------------------
  MAIAN MUSIC v1.3
  Written by David Ian Bennett
  E-Mail: support@maianscriptworld.co.uk
  Website: www.maianscriptworld.co.uk
  This File: Slovak language file
-------------------------------------------*/

/******************************************************************************************************
 * JAZYKOVÝ BALÍČEK - PROSÍM ČÍTAJTE                                                                  *
 * Toto je jazykový súbor pre Maian Music skript. Môžete ho upraviť tak, aby spĺňal Vaše potreby      *
 * NEUPRAVUJTE $lang[] názvy premenných a buďte tiež opatrný, aby ste neodstránili žiaden z           *
 * apostrofov (') ktoré obsahujú informácie k premenným. Inak sa môže stať, že skript nebude fungovať *
 * POUŽÍVANIE APOSTROFOV V ODKAZOCH                                                                   *
 * Ak potrebujete použiť apostrof, dajte pred neho opačné lomítko, t.j.: d\'apostrof                  *
 * SYSTÉMOVÉ PREMENNÉ                                                                                 *
 * Samostatné písmená so znakom percent a premenné v zátvorkách sú systémové premenné.                *
 *  napríklad: %d, %s, {count} atď.                                                                   *
 * Systém nepadne, ak ich náhodou zmažete, ale niektoré jazyky sa nemusia zobrazovať správne          *
  ******************************************************************************************************/

 /*------------------------------------------
  Slovenský preklad
  E-Mail: admin@etrading.sk
  Website: www.etrading.sk
-------------------------------------------*/

/*---------------------------------------------
  CHARACTER SET
  For encoding HTML characters
  Unless specified in language file,
   this may not need altering.
----------------------------------------------*/

define( '_msg_charset','iso-8859-1');

$_msg_author = 'Peter';
$_msg_website  = 'http://www.etrading.sk';

/*--------------------------------------
  INC/HEADER.PHP
  -------------------------------------*/
  
define( '_msg_public_header','Náš obchod s hudbou @ {website}');  
define( '_msg_public_header2','Položiek v košíku');
define( '_msg_public_header3','Najpopulárnejšie');
define( '_msg_public_header4','Hudba');
define( '_msg_public_header5','Kontakt');
define( '_msg_public_header6','Bližšie informácie');
define( '_msg_public_header7','Hľadať');
define( '_msg_public_header8','Kľúčové slová');
define( '_msg_public_header9','Premium Beat Flash Player');
define( '_msg_public_header10','Tento systém používa<br />Premium Beat Flash Player<br /><b>&copy); Premium Beat.com</b>');
define( '_msg_public_header11','Položka v košíku');
define( '_msg_public_header12','Licencia');
define( '_msg_public_header13','MP3 súbory na stiahnutie z nášho obchodu.');
define( '_msg_public_header14','mp3,sťahuj,albumy,hudba,obchod s hudbou');
define( '_msg_public_header15','Najpopulárnejšie Text');



/*--------------------------------------
  TEMPLATES/ALBUM.TPL.PHP
  -------------------------------------*/
  
define( '_msg_publicalbum','Prezri/Kúp súbory');  
define( '_msg_publicalbum2','Použite prosím tlačidlá, ak si chcete vypočuť alebo kúpiť jednotlivé súbory. Do svojho nákupného košíka môžete vložiť
                              ľubovolný počet súborov. Ďakujeme.');
define( '_msg_publicalbum3','Vypočuť');
define( '_msg_publicalbum4','Pridať do košíka');
define( '_msg_publicalbum5','Názov súboru');
define( '_msg_publicalbum6','Cena');
define( '_msg_publicalbum7','Pridať do košíka');
define( '_msg_publicalbum8','Pridať všetky súbory do košíka');
define( '_msg_publicalbum9','Pridať vybrané súbory do košíka');
define( '_msg_publicalbum10','Vypočuť si súbory');
define( '_msg_publicalbum11','Súbor');
define( '_msg_publicalbum12','Táto webstránka bola prezretá <b>{count}</b> krát.');
define( '_msg_publicalbum13','Ušetrených <b>{amount}</b> %');
define( '_msg_publicalbum14','Súvisiace albumy');


/*--------------------------------------
  TEMPLATES/CART.TPL.PHP
  -------------------------------------*/
  
define( '_msg_cart','Nákupný košík');
define( '_msg_cart2','Položky vo Vašom košíku sú zobrazené nižšie. Použite tlačidlá, ak chcete niektorú z týchto položiek odstrániť. Ak ste so svojim výberom spokojný, kliknite na \'Checkout\'');  
define( '_msg_cart3','Momentálne máte 0 položiek v košíku.');
define( '_msg_cart4','{count} položiek v košíku');
define( '_msg_cart5','Celkom');
define( '_msg_cart6','Vyprázdniť košík');
define( '_msg_cart7','Ku pokladni');
define( '_msg_cart8','Od:');
define( '_msg_cart9','Ušetríte {discount}%');


/*--------------------------------------
  TEMPLATES/CONTACT.TPL.PHP
  -------------------------------------*/

define( '_msg_contact','<div id="mm_contact">Ak zaznamenáte akýkoľvek problém, alebo ak sa nás chcete k súborom niečo spýtať, použite prosím formulár nižšie:</div>');
define( '_msg_contact2','Kontaktujte nás');
define('_msg_contact3','Predmet');
define('_msg_contact4','Komentár');
define('_msg_contact5','Poslať správu');
define('_msg_contact6','Prosím vpíšte predmet správy...');
define('_msg_contact7','Napíšte nejaký komentár...');
define('_msg_contact8','Vaša správa bola odoslaná.<br /><br />Odpoveď dostanete tak rýchlo, ako to len bude možné.');
define('_msg_contact9','Meno');
define('_msg_contact10','E-mailová Adresa');
define('_msg_contact11','Zadajte kód');
define('_msg_contact12','Nesprávny kód, prosím skúste znova..');
define('_msg_contact13','Ďakujeme!');
define('_msg_contact14','Správa bola odoslaná!');
define('_msg_contact15','Prosím vložte svoje meno...');
define('_msg_contact16','Prosím vložte platnú e-mailovú adresu...');
define('_msg_contact17','Kliknite na Captcha na obnovenie kódu');


/*--------------------------------------
  TEMPLATES/CONTACT.TPL.PHP
  -------------------------------------*/
  
define('_msg_publichome','Ďakujeme za Váš záujem o naše súbory. Použite prosím link v ľavom menu na prezretie dostupných albumov.
                              Použite tlačidlá, ak si chcete kúpiť jednotlivé súbory alebo celé albumy. 
                              MP3 súbory si môžete tiež vypočuť, predtým, ako si ich kúpite.<br /><br />Všetky platby sú bezpečne
                              spracované prostredníctvom Paypal systému, no nepotrebujete pritom Paypal účet, aby ste zaplatili prostredníctvom svojej kreditnej alebo debetnej karty.<br /><br />
                              Kontaktujte nás prosím, ak máte nejaké otázky, ďakujeme!
                         ');  
define('_msg_publichome2','Všetky hlavné kreditné karty, ktoré sú akceptované cez Paypal');
define('_msg_publichome3','Najpopulárnejšie súbory');
define('_msg_publichome4','Najpopulárnejšie albumy');


/*--------------------------------------
  TEMPLATES/DOWNLOAD_ITEM.TPL.PHP
  -------------------------------------*/


define('_msg_downloaditem','<br /><br /><span class="sorry">Ospravedlňujeme sa!</span><br /><br /><span class="sorry_msg">Čas na toto sťahovanie vypršal!</span><br /><br /><br />Prosím kontaktujte nás,<br />aby ste toto sťahovanie zresetovali.');  
define('_msg_downloaditem2','<br /><br /><span class="sorry">Chyba!</span><br /><br /><span class="sorry_msg">Nemáte oprávnenie<br />na prezeranie tejto stránky!</span><br /><br /><br />Prosím kontaktujte nás,<br />ak si myslíte, že došlo k chybe.');  


/*--------------------------------------
  TEMPLATES/MUSIC.TPL.PHP
  -------------------------------------*/

define('_msg_music','Prosím kliknite na linky, ak chcete vidieť viac informácií o albume a aby ste si mohli pozrieť/kúpiť súbory. Ďakujeme.');
define('_msg_music2','Viac informácií');
define('_msg_music3','Súbory: {count}');


/*--------------------------------------
  TEMPLATES/PAYPAL/CANCEL.TPL.PHP
  TEMPLATES/PAYPAL/CHECKOUT.TPL.PHP
  TEMPLATES/PAYPAL/DOWNLOAD.TPL.PHP
  TEMPLATES/PAYPAL/ERROR.TPL.PHP
  TEMPLATES/PAYPAL/THANKS.TPL.PHP
  -------------------------------------*/
  
define('_msg_paypal','Pripájam sa na Paypal server..... Vyčkajte prosím....');  
define('_msg_paypal2','Položky v obchode s hudbou');
define('_msg_paypal3','Transakcia bola zrušená!');
define('_msg_paypal4','Vaša transakcia bola úspešne zrušená a nebola poslaná žiadna platba.<br /><br />Ďakujeme za Váš záujem o náš obchod s hudbou.');
define('_msg_paypal5','Neplatná transakcia!');
define('_msg_paypal6','Zdá sa, že ide o neplatnú transakciu, keďže suma práve realizovanej platby nezodpovedá sume za Váš nákupný košík.<br /><br />Webmaster bol informovaný o tomto pokuse a môže podniknúť ďalšie kroky.<br /><br />Ak máte pocit, že došlo k chybe, prosím použite kontaktný formulár v ľavom menu.<br /><br />Ďakujeme.');
define('_msg_paypal7','Ďakujeme!');
define('_msg_paypal8','Vaša transakcia bola úspešne ukončená.<br /><br />
                              Prosím skontrolujte si Vašu e-mailovú schránku "<b>{email}</b>". Obsahuje link na stiahnutie súborov, ktoré ste si práve kúpili. Kliknite na uvedený link, aby ste sa dostali na stránku, z ktorej si ich môžete stiahnúť. Ak ste žiaden e-mail nedostali, použite prosím kontaktný link v ľavom menu.<br /><br />
                              Dúfame, že sa Vám naše súbory budú páčiť,<br /><br />
                              <b>{store}</b>');
define('_msg_paypal9','Vyskytla sa chyba!');
define('_msg_paypal10','Prepáčte, ale nemáte povolenie na prezeranie tejto stránky.');  
define('_msg_paypal11','Neboli nájdené žiadne kúpené súbory. Prosím skontrolujte znova link, na ktorý ste klikli vo svojom e-maile a ubezpečte sa, že v adresnom riadku nie sú žiadne znaky navyše.<br/><br />Ak máte pocit, že došlo k chybe, použite prosím kontaktný link v ľavom menu.<br /><br />Ďakujeme.');                            
define('_msg_paypal12','Platnosť stránky na sťahovanie vypršala!');
define('_msg_paypal13','Platnosť tohto linku práve vypršala a nemôže byť viackrát prístupný. Náš systém z bezpečnostných dôvodov automaticky kontroluje počet navštívení stránky na sťahovanie.<br /><br />
                              Ak potrebujete opätovne vstúpiť na stránku, použite prosím kontaktný link v ľavom menu, aby sme Vám link zresetovali.<br /><br />
                              Ospravedlňujeme za sa prípadné problémy,<br /><br />
                              <b>{store}</b>');
define('_msg_paypal14','Stránka na stiahnutie súborov');
define('_msg_paypal15','Ďakujeme Vám za nákup. Súbory na stiahnutie sú zobrazené nižšie.<br /><br />Prosím <b>NEOBNOVUJTE</b> ani nezáložkujte túto stránku, keďže stránke môže medzitým vypršať platnosť, kým sa vrátite.<br /><br />Ste oprávnení stiahnuť si každý súbor {duration}. Ak zaznamenáte akýkoľvek problém, použite prosím kontaktný link v ľavom menu.');                              
define('_msg_paypal16','jedenkrát');
define('_msg_paypal17','dvakrát');
define('_msg_paypal18','krát');
define('_msg_paypal19','Kúpené albumy');
define('_msg_paypal20','Kúpené súbory');
define('_msg_paypal21','Neboli nájdené žiadne záznamy o kúpe albumov');
define('_msg_paypal22','Neboli nájdené žiadne záznamy o kúpe súborov');
define('_msg_paypal23','Dúfame, že Vám naša hudba spraví radosť!');
define('_msg_paypal24','Stiahnuť súbor');
define('_msg_paypal25','Stiahnuť Artwork');
define('_msg_paypal26','Stiahnuť súbory');
define('_msg_paypal27','Súbor neexistuje!');
define('_msg_paypal28','Všetky súbory =');
define('_msg_paypal29','Kliknite na tlačidlo/á na stiahnutie!');
define('_msg_paypal30','Späť na predchádzajúcu stránku');
define('_msg_paypal31','Sťahovanie vypršalo');


/*--------------------------------------
  TEMPLATES/SEARCH.TPL.PHP
  -------------------------------------*/

define('_msg_publicsearch','Výsledky vyhľadávania');
define('_msg_publicsearch2','Vami vyhľadávané výsledky pre "<b>{keywords}</b>" sú zobrazené nižšie. Ak Vaše vyhľadávanie neprinieslo žiadne výsledky, skúste viac kľúčových slov oddelených medzerami, na podrobnejšie vyhľadávanie.');
define('_msg_publicsearch3','<br /><b>Žiadne výsledky neboli nájdené... Skúste prosím znova...</b>');
define('_msg_publicsearch4','{count} Výsledky vyhľadávania');


/*--------------------------------------
  ADMIN/INC/HEADER.PHP
  -------------------------------------*/

define('_msg_header','Administrácia');
define('_msg_header2','O programe');  
define('_msg_header3','Nastavenia');  
define('_msg_header4','Spravovať albumy');  
define('_msg_header5','Pridať nové súbory');  
define('_msg_header6','Spravovať súbory');  
define('_msg_header7','Predaje');  
define('_msg_header8','Prehľadávať predaje'); 
define('_msg_header9','Navigačné menu');
define('_msg_header10','Kategórie'); 
define('_msg_header11','Štatistiky');
  
  
/*--------------------------------------
  ADMIN/INC/FOOTER.PHP
  TEMPLATES/FOOTER.TPL.PHP
  -------------------------------------*/

define('_msg_footer','Copyright');
define('_msg_footer2','Všetky práva vyhradené');  
define('_msg_footer3','Prosím povoľte javascript vo Vašom prehliadači. Ďakujeme!');


/*--------------------------------------
  ADMIN/DATA_FILES/ADD.PHP
  -------------------------------------*/
  
define('_msg_add','Tu pridávate svoje mp3/mp4 súbory. Pred pridaním sa ubezpečte, že existuje správna celá cesta k súborom. Tá je uvedená vo Vašich nastaveniach. Použite klikacie menu nižšie, aby ste si vybrali
                              koľko súborov by ste chceli pridať a potom vyplňte detaily pre každý súbor. Použite link na pomoc, ak si nie ste istý.<br><br>
                              <i>Pozor, ak zabudnete uviesť názov súboru, cestu k súboru, alebo cenu za súbor, súbor NEBUDE pridaný.</i>');  
define('_msg_add2','Súbory, ktoré chcete pridať');
define('_msg_add3','Koľko súborov by ste chceli pridať? Toto môžete obnoviť kedykoľvek bez toho, aby ste prišli o údaje vo formulároch.');
define('_msg_add4','Súbory');
define('_msg_add5','Pridať súbory');
define('_msg_add6','Názov súboru');
define('_msg_add7','Pridať do albumu');
define('_msg_add8','Cesta k MP3 súborom');
define('_msg_add9','Cesta k ukážkam súborov');
define('_msg_add10','Dĺžka trvania súboru');
define('_msg_add11','Cena');
define('_msg_add12','Samostatná kúpa');
define('_msg_add13','<b>{count}</b> súbor/y boli pridané. Súbory môžete spravovať nižšie.');
define('_msg_add14','Zobraziť');
define('_msg_add15','pre všetky súbory.');


/*--------------------------------------
  ADMIN/DATA_FILES/ALBUMS.PHP
  -------------------------------------*/
  
define('_msg_albums','MP3ky sú zoskupené do albumov. Keď pridáte súbory, musíte tiež
                              uviesť, do ktorého albumu ich chcete pridať. Návštevníci môžu kúpiť samostatné súbory alebo celé albumy. Keď pridáte nový album, zobrazí sa nižšie.');  
define('_msg_albums2','Album');
define('_msg_albums3','Názov albumu');
define('_msg_albums4','Aktuálne albumy -- Kliknite na názov pre úpravu');
define('_msg_albums5','URL obrázku k Albumu');
define('_msg_albums20','Albumy');
//define('_msg_albums21','Výška:');
//define('_msg_albums22','Šírka:');
define('_msg_albums6','Album Artwork (Zip Súbor)');
define('_msg_albums7','Komentáre/Informácie');
define('_msg_albums8','Sprístupniť Album');
define('_msg_albums9','Momentálne je v databáze 0 albumov.');
define('_msg_albums10','Aktualizovaný Album');
define('_msg_albums11','Meno autora');
define('_msg_albums12','Kľúčové slová');
define('_msg_albums13','Stiahnutia');
define('_msg_albums14','Zresetovať počet stiahnutí súborov');
define('_msg_albums15','Pozretí');
define('_msg_albums16','Kategória');
define('_msg_albums17','Albumy vrcholovej úrovne');
define('_msg_albums18','Nekategorizované');
define('_msg_albums19','Zľava za kúpu albumov');

/*--------------------------------------
  ADMIN/DATA_FILES/HOME.PHP
  -------------------------------------*/
  
define('_msg_home','Vitajte v Maian Music pre Joomla, jednoduchom hudobnom obchode, ktorý vám umožňuje prezeranie a predaj Vašej vlastnej hudby
                              vo formáte mp3/mp4.  Tento skript bol pôvodne napísaný kým: <a href="http://www.maianscriptworld.co.uk" title="Maian Script World" target="_blank">Maian Script World</a> a bol prekonvertovaný do Joomly kým: <a href="http://www.aretimes.com" title="Are Times" target="_blank">Are Times</a>.
                              Aby ste mohli používať tento systém, musíte mať Paypal business účet. Odporúča sa umožniť Auto Return pre pohodlnejšie správanie sa užívateľov. Pri konfigurácii tejto možnosti, hľadajte
                               [<b><span style="color:#FF7700">?</span></b>] nápovedy pre viac informácií.<br><br> 
                              Ak máte akýkoľvek problém, prosím uveďte ho na <a href="http://www.aretimes.com" title="Support Forums" target="_blank">support forums</a>.<br><br>
                              Kontaktujte nás prostredníctvom našej webstránky, ak máte nejaké komentáre alebo nájdete nejakú chybu v programe. <br><br>
                              Dúfame, že si náš systém na predaj hudby užijete,<br><br>Alao.<br><br><b>Are Times</b><br><a href="http://www.aretimes.com" title="Are Times" target="_blank">http://www.aretimes.com</a>');
define('_msg_dedicate','<br><br>Venované <a href="http://www.lpierce927.com" title="Looch" target="_blank">Lamar Anthony Pierce</a> A.K.A <a href="http://www.myspace.com/thereallooch" title="Looch" target="_blank">Looch</a>');
define('_msg_home2','Dotácia');                                
define('_msg_home3','Ak sa Vám tento skript páči a chceli by ste nám prejaviť svoju podporu, zvážte prosím dotáciu alebo kúpu niektorých hudobných súborov od Are Times');
define('_msg_home4','Dotácie nie sú nevyhnutné, ale sú veľmi vítané. Ďakujeme!');
define('_msg_home5','Prehľad obchodu s hudbou');
define('_msg_home6','Momentálne máte <b>{tracks}</b> súborov, zoskupených do <b>{albums}</b> albumov.<br><br>
                              Poplatky Paypalu: <b>{fees}</b><br>
                              Zisk: <b>{profit}</b><br><br>
                              <b>{a_purchases}</b> albumov a <b>{t_purchases}</b> samostatných súborov bolo nakúpených.
                         ');
                         
                              
/*--------------------------------------
  ADMIN/DATA_FILES/LOGIN.PHP
  -------------------------------------*/   
  
define('_msg_login','Prihlásenie do administrácie');                             
define('_msg_login2','Prosím prihláste sa do administrácie nižšie:');
define('_msg_login3','Užívateľské meno');
define('_msg_login4','Heslo');
define('_msg_login5','Prihlásenie');
define('_msg_login6','Neplatné');
define('_msg_login7','Pamätať si ma');


/*--------------------------------------
  ADMIN/DATA_FILES/SALES.PHP
  -------------------------------------*/
  
define('_msg_sales','Nižšie sú uvedené súbory, ktoré boli predané. Použite možnosť zoradenia, ak je to potrebné. Použite uvedené linky, na správu vašich predajov alebo na kontaktovanie kupcov. Ak potrebujete upresniť nejaký vstup, použite možnosť vyhľadávania z ponuky.');  
define('_msg_sales2','Ukáž');
define('_msg_sales3','Na stránku');
define('_msg_sales4','Najnovšie predaje');
define('_msg_sales5','Najstaršie predaje');
define('_msg_sales6','Kúpené súbory');
define('_msg_sales7','Kúpené albumy');
define('_msg_sales8','Najvyššie Grossing');
define('_msg_sales9','Najnižšie Grossing');
define('_msg_sales10','Mená kupcov A-Z');
define('_msg_sales11','Mená kupcov Z-A');
define('_msg_sales12','Prezretie {count} predajov');
define('_msg_sales13','Momentálne je <b>0</b> predajov v databáze.');
define('_msg_sales14','Odstrániť vybrané predaje');
define('_msg_sales15','Kúpené albumy');
define('_msg_sales16','Kúpené súbory');
define('_msg_sales17','<b>0</b> kúpených albumov.');
define('_msg_sales18','<b>0</b> kúpených súborov.');
define('_msg_sales19','kým');
define('_msg_sales20','Albumy');
define('_msg_sales21','Súbory');
define('_msg_sales22','Pozri informácie o predajoch');
define('_msg_sales23','Kontaktovať kupcu');
define('_msg_sales24','Predmet');
define('_msg_sales25','Komentáre');
define('_msg_sales26','alebo ak máte e-mailového klienta, kliknite <a href="mailto:{email}" title="Kliknite na spustenie e-mailového klienta"><b><u>tu</u></b></a>.');
define('_msg_sales27','Správa bola poslaná!');
define('_msg_sales28','Poslať správu');
define('_msg_sales29','Zresetovať stiahnutia &amp; Znova poslať e-mail s informáciami o stiahnutí');
define('_msg_sales30','Informácie o Kupcovi/Paypale');
define('_msg_sales31','E-Mail bol poslaný kupcovi!');
define('_msg_sales32','Kliknite na prezretie');
define('_msg_sales33','Kupca');
define('_msg_sales34','E-Mail');
define('_msg_sales35','Dátum');
define('_msg_sales36','Adresa');
define('_msg_sales37','Poznámka o kupcovi');
define('_msg_sales38','Stav platby');
define('_msg_sales39','Celkom/Poplatok/Čistý zisk');
define('_msg_sales40','ID Paypal transakcie');
define('_msg_sales41','Zákazníci');
define('_msg_sales42','Informácie');
define('_msg_sales43','Odstrániť');
define('_msg_sales44','ID Paypal transakcie');
define('_msg_sales45','Číslo faktúry');

/*--------------------------------------
  ADMIN/DATA_FILES/SEARCH.PHP
  -------------------------------------*/
  
define('_msg_search','Táto možnosť umožňuje prehľadávať Vaše predaje. Je to užitočné najmä v prípade, ak máte veľa položiek a potrebujete špecifikovať jednu konkrétnu. Prosím špecifikujte kritéria nižšie. Môžete zadať jeden alebo viacero fráz na vyhľadávanie, ale musí obsahovať prinajmenšom jednu možnosť:');
define('_msg_search2','Zadajte kritéria pre vyhľadávanie');
define('_msg_search3','Kde \'name\' je');
define('_msg_search4','Kde \'e-mail\' je');
define('_msg_search5','Kde \'invoice no\' =');
define('_msg_search6','Kde \'trans id\' =');
define('_msg_search7','Kde \'date\' je medzi');
define('_msg_search8','Vyhľadať');
define('_msg_search9','Neboli nájdené žiadne záznamy...Skúste prosím znova...');
define('_msg_search10','Výsledky vyhľadávania');
define('_msg_search11','Výsledky Vášho vyhľadávania sú zobrazené nižšie');
define('_msg_search12','Nové vyhľadávanie');


/*--------------------------------------
  ADMIN/DATA_FILES/SETTINGS.PHP
  -------------------------------------*/
  
define('_msg_settings','Aktualizujte nastavenia programu nižšie. Mali by byť vyplnené všetky polia, pokiaľ nie sú uvedené ako dobrovoľné.');  
define('_msg_settings2','Webstránka/Všeobecné nastavenia');
define('_msg_settings3','Názov obchodu');
define('_msg_settings4','E-mailová adresa');
define('_msg_settings5','URL domovskej stránky');
define('_msg_settings6','Cesta k inštalačnému adresáru komponenty');
define('_msg_settings7','Jazyk');
define('_msg_settings8','Umožniť Captcha');
define('_msg_settings9','Nastavenia MP3/Sťahovania');
define('_msg_settings10','Cesta k MP3 Albumom na predaj');
define('_msg_settings11','Cesta k MP3 Albumom s ukážkami');
define('_msg_settings12','Aktualizovať nastavenia');
define('_msg_settings13','URL priateľské k vyhľadávačom');
define('_msg_settings14','Nastavenia Paypalu');
define('_msg_settings15','Umožniť Paypal IPN');
define('_msg_settings16','Umožniť Paypal Sandbox');
define('_msg_settings17','Naživo');
define('_msg_settings18','Zaznamenávanie chýb');
define('_msg_settings19','Štýl stránky');
define('_msg_settings20','E-mailová adresa Paypal účtu');
define('_msg_settings21','Hlavná mena');
define('_msg_settings22','');
define('_msg_settings23','Text stránky');
define('_msg_settings24','<a href="http://en.wikipedia.org/wiki/HTML" title="Hypertext Markup Language" target="_blank">HTML</a> je povolené');
define('_msg_settings25','Koľkokrát je možné zobraziť stránku na stiahnutie súborov');
define('_msg_settings26','Počet albumov pre RSS zdroj');
define('_msg_settings27','Počet linkov na populárne súbory');
define('_msg_settings28','SSL zapnuté');
define('_msg_settings29','SMTP Port');
define('_msg_settings30','Zresetovať prezretia všetkých albumov');
define('_msg_settings31','Koľkokrát je možné stiahnuť súbory zo stránky');
define('_msg_settings32','Text licenčnej stránky');
define('_msg_settings33','SMTP nastavenia');
define('_msg_settings34','Zapnúť SMTP');
define('_msg_settings35','SMTP webhosting');
define('_msg_settings36','SMTP používateľské meno');
define('_msg_settings37','SMTP heslo');
define('_msg_settings38','MP3 nastavenia prehrávača');
define('_msg_settings39','Prehrávač');
define('_msg_settings40','"Payment data transfer"');
define('_msg_settings41','Predvolená stránka');
define('_msg_settings42','Najpopulárnejšie');
define('_msg_settings43','Hudba');
define('_msg_settings44','Text stránky s hudbou');

/*--------------------------------------
  ADMIN/DATA_FILES/STATISTICS.PHP
  -------------------------------------*/

define('_msg_statistics','Táto stránka Vám umožňuje rýchly prehľad o tom, koľkokrát bol ten-ktorý album alebo súbor kúpený. Kliknite na tlačidlá pre zobrazenie podrobnejších štatistík.
                         ');
define('_msg_statistics2','Zoradiť podľa');
define('_msg_statistics3','Najviac prezretí');
define('_msg_statistics4','Najmenej prezretí');
define('_msg_statistics5','Album');
define('_msg_statistics6','Súbor');
define('_msg_statistics7','<li>Pozretí: <b>{hits}</b> </li> <li>Počet kúpených albumov: <b>{albums}</b> </li> <li> Počet kúpených súborov: <b>{tracks}</b></li>');
define('_msg_statistics8','Pozrieť štatistiky súborov');
define('_msg_statistics9','Toto zobrazuje list súborov v každom albume a celkový počet nákupov pre každý súbor.');
define('_msg_statistics10','Rozbaliť všetko');
define('_msg_statistics11','Zbaliť všetko');


/*--------------------------------------
  ADMIN/DATA_FILES/TRACKS.PHP
  -------------------------------------*/
  
define('_msg_tracks','Táto stránka Vám umožňuje spravovať aktuálne súbory. Vyberte si album, prezrite si súbory a použite tlačidlá na ich aktualizáciu.');  
define('_msg_tracks2','<b>{count}</b> súbory');
define('_msg_tracks3','Prezrieť si súbory');
define('_msg_tracks4','Žiadne súbory');


/*--------------------------------------
  ADMIN/DATA_FILES/VIEW_TRACKS.PHP
  -------------------------------------*/
  
define('_msg_viewtracks','Aktualizovať súbory');  
define('_msg_viewtracks2','Kliknite na linky, aby ste mohli upraviť súbor. Môžete aktualizovať alebo vymazať akýkoľvek súbor a zmeniť tiež radenie, podľa ktorého sú
                              súbory zobrazované verejnosti.');
define('_msg_viewtracks3','Aktualizovať tento súbor');
define('_msg_viewtracks4','Posunúť vyššie');
define('_msg_viewtracks5','Posunúť nižšie');
define('_msg_viewtracks6','Tento album má momentálne 0 súborov');
define('_msg_viewtracks7','Zrušiť');
define('_msg_viewtracks8','Súbor bol úspešne aktualizovaný!');
define('_msg_viewtracks9','Obnoviť');


/*---------------------
  RESPONSE DATA FOR IPN
  PAYPAL E-MAILS
----------------------*/

define('_msg_ipn','Nesprávne radenie');
define('_msg_ipn2','Paypal IPN CHYBA!!');
define('_msg_ipn3','Ak je to umožnené, táto chyba bola zaznamenaná.');
define('_msg_ipn4','Nasledovný vstup bol zaznamenaný (a poslaný späť) od PayPal:');
define('_msg_ipn5','Platba zlyhala');
define('_msg_ipn6','Platba bola odmietnutá');
define('_msg_ipn7','Neznámy stav platby');
define('_msg_ipn8','Kúpa prebieha!');
define('_msg_ipn9','Neplatná nákupná transakcia!');
define('_msg_ipn10','Informácie o sťahovaní!');
define('_msg_ipn11','Obchodná transakcia!');


/*-------------------------------------
  GENERAL VARIABLES
  ------------------------------------*/

define('_msg_script','Maian Music');
define('_msg_script2','Áno');
define('_msg_script3','Nie');
define('_msg_script4','Voliteľné');
define('_msg_script5','Prvý');
define('_msg_script6','Posledný');
define('_msg_script7','Upraviť');
define('_msg_script8','Vymazať');
define('_msg_script9','Zrušiť');
define('_msg_script10','Obnoviť');
define('_msg_script11','Vytlačiť');
define('_msg_script12','neobmedzené');


/*-----------------------------
  RSS Feeds
-------------------------------*/

define('_msg_rss','Najnovšie albumy @ {website_name}');
define('_msg_rss2','Toto sú najnovšie albumy pridané na {website_name}');
define('_msg_rss3','Album:');


/*----------------------
  ADMIN/INC/CALENDAR.PHP
-----------------------*/

define('_msg_calendar','Január');
define('_msg_calendar2','Február');
define('_msg_calendar3','Marec');
define('_msg_calendar4','Apríl');
define('_msg_calendar5','Máj');
define('_msg_calendar6','Jún');
define('_msg_calendar7','Júl');
define('_msg_calendar8','August');
define('_msg_calendar9','September');
define('_msg_calendar10','Október');
define('_msg_calendar11','November');
define('_msg_calendar12','December');


/*--------------------------------------------------------------------------------------------------
  ZIP FILE FOLDER NAMES
  These are the names of the folders that are created inside the zip file when someone downloads 
  an album or track. These should NOT contain any illegal characters that may prevent the creation 
  of the folder. If you are unsure, leave them as they are
  --------------------------------------------------------------------------------------------------*/
  
define('_msg_folder','súbor');
define('_msg_folder2','album');
  

/*-----------------------------------------------------------------------------------------------------
  JAVASCRIPT VARIABLES
  IMPORTANT: If you want to use apostrophes in these variables, you MUST escape them with 3 backslashes
             Failure to do this will result in the script malfunctioning on javascript code. Unless you
             specifically need them, using double quotes is recommended.
  EXAMPLE: d\\\'apostrophe
------------------------------------------------------------------------------------------------------*/

define('_msg_javascript','Pomoc/Informácie');
define('_msg_javascript2','Celé URL k adresáru obsahujúcemu súbory. BEZ koncového lomítka.<br><br><b>http://www.yoursite.com/music</b>');
define('_msg_javascript3','Captcha je využívaná v boji proti spamu, ktorý môže prichádzať cez kontaktný formulár. Pre plnú funkčnosť je nutné aby bola nainštalovaná <b>GD knižnica s Freetype podporou</b> na Váš server. Pozrite si dokumentáciu pre viac informácií.');
define('_msg_javascript4','MP3 súbory by mali byť vždy skladované mimo hlavného Joomla adresára. Toto je relatívna cesta od koreňového adresára serveru do MP3 adresára. Zložku vytvorte manuálne, najlepšie mimo Joomla zložky, a to BEZ koncového lomítka.<br><br><b>/home/user/mp3</b>');
define('_msg_javascript5','To isté ako predtým, ale toto je cesta k MP3 ukážkam. Môže byť ako mimo, tak i v predchádzajúcej MP3 zložke. BEZ koncového lomítka.<br><br><b>../mp3/mp3_preview or /mp3_preview</b>');
define('_msg_javascript6','Zapína mod_rewrite pre URL priateľské k vyhľadávačom. Aby to fungovalo, Váš server musí podporovať <b>.htaccess</b> Keď už je zapnutý, premenujte <b>htaccess_COPY.txt</b> súbor na <b>.htaccess</b><br><br>Môže tiež spôsobiť chyby serveru, ak je zapnuté, pričom však <b>.htaccess</b> nie je podporovaný.');
define('_msg_javascript7','Paypal Vám umožňuje testovať systém bez toho, aby ste odoslali skutočnú platbu. Ide o mód <b>sandbox</b> a podrobnejšie informácie môžete nájsť <a href="https://developer.paypal.com" title="Sandbox" target="_blank">na tomto mieste</a>.<br><br>Zakliknite políčko na zapnutie Sandboxu. Odkliknite ho, ak chcete realizovať skutočné platby.');
define('_msg_javascript8','Toto je e-mailová adresa k Vášmu premier alebo business Paypal účtu.');
define('_msg_javascript9','Paypal Vám umožňuje vytvoriť stýl stránky vo Vašej Paypal zóne. Ak nejakú máte, uveďte tu jej meno. Nechajte to prázdne ak nechcete použiť žiaden štýl.');
define('_msg_javascript10','Ak je späť z Paypalu poslaná nesprávna odozva, môžete túto chybu zaznamenať. Je to užitočné pre odstraňovanie chýb v programe a je odporúčané nechať túto možnosť zapnutú počas testovania systému.');
define('_msg_javascript11','Uveďte menu, v ktorej chcete spracovávať platby. Tento zoznam obsahuje zoznam mien, ktoré podporoval Paypal v čase vytvorenia tohto skriptu.');
define('_msg_javascript12','Ak máte obrázok, ktorý chcete zobraziť pre tento album, uveďte plnú URL, ktorá začína s http://<br><br>Pozor, obrázok je predvolene zobrazovaný v skutočnej veľkosti, a preto by mal byť s rozmermi <b>65</b>x<b>65</b> pixelov.<br><br><i>(Voliteľné)</i>');
define('_msg_javascript13','Ak návštevník kúpi celý album a Vy by ste chceli, aby si tiež mohol stiahnuť obrázky na obale, dajte všetky tieto súbory do .zip súboru, nahrajte ho na server a uveďte celú cestu k súborom. Cesta musí začínať http://<br><br>Ak niekto kúpi celý album, tento link bude taktiež priložený k linku na stiahnutie súborov samotných. <br><br><i>(Voliteľné)</i>');
define('_msg_javascript14','Nastavenie stavu pre tento album. Ak je to vypnuté, nie je viditeľný pre verejnosť.');
define('_msg_javascript15','Ste si istý?\n\nTáto voľba zmaže tiež všetky súbory priradené k tomuto albumu.\n\nAktuálne súbory by mali byť vymazané manuálne.');
define('_msg_javascript16','Uveďte cestu k MP3 súborom <b>VÝLUČNE</b> tu, pokiaľ nemáte mp3 súbory vo vnútri inej zložky v hlavnej koreňovej zložke. Tento súbor by mal byť nahraný do príslušnej zložky. Príklad:<br><br><b>music_file.mp3</b><br><b>album1/music_file.mp3</b>');
define('_msg_javascript17','Ak chcete na ukážku použiť kratší súbor, uveďte tu jeho názov. Takýto súbor by mal existovať v Adresári ukážok vo Vašich nastaveniach. Ak nie je pridaný žiaden ukážkový súbor, na ukážku bude použitý súbor v plnej veľkosti.<br><br>Voliteľné');
define('_msg_javascript18','Uveďte dĺžku tohto súboru. Príklad:<br><br>4:32<br>4 minúty 32 sekúnd<br>4-32');
define('_msg_javascript19','Uveďte cenu, za ktorú predávate tento súbor, BEZ uvedenia symbolu meny. Ak chcete predávať za &pound);0.75 zadajte len číselnú hodnotu <b>0.75</b>.');
define('_msg_javascript20','Je možné tento súbor predať tiež samostatne? Ak to nie je možné, súbor bude možné kúpiť len ako celý album.');
define('_msg_javascript21','Ste si istý, že si želáte vymazať tento súbor?');
define('_msg_javascript22','Zadajte kľúčové slová, ktoré najlepšie vystihujú podstatu tohto albumu. Tie sa následne objavia v meta kľúčových slovách na stránke.');
define('_msg_javascript23','Ak chcete, aby Vaši návštevníci dostali zľavu za kúpu celého albumu, uveďte tieto percentá na tomto mieste. Nastavte 0, ak nechcete poskytnúť žiadnu zľavu.');
define('_msg_javascript24','Ak si niekto kúpi súbory, je mu poslaný link na stránku so sťahovaním. Aby sa kupcom zabránilo v tom, aby tento link poslali aj iným ľuďom, môžete tu nastaviť, koľkokrát môže byť táto stránka navštívená, predtým ako vyprší platnosť linku. <b>Nastavte 0 pre neobmedzený počet návštev</b>.');
define('_msg_javascript25','Ste si istý, že chcete vyprázdniť celý košík?');
define('_msg_javascript26','Vymazať túto položku?');
define('_msg_javascript27','Táto možnosť Vám umožňuje hromadne zresetovať počítadlo stiahnutí. Pre individuálne albumy, použite túto možnosť pri aktualizácii albumov. Pre individuálne súbory použite túto možnosť počas aktualizácie súborov.');
define('_msg_javascript28','Ak zakliknete toto políčko, všetky súbory v tomto albume budú mať počítadlo stiahnutí nastavené na 0.');
define('_msg_javascript29','Ak zakliknete toto políčko, zobrazenia všetkých albumov budú zresetované na 0. Ak chcete zresetovať individuálne albumy, použite stránku na spravovanie albumov.');
define('_msg_javascript30','Toto je limit, koľkokrát môže byť kúpený súbor stiahnutý. <b>Nastavte na 0 pre neobmedzený počet</b>.');
define('_msg_javascript31','Drží Vás prihláseného na 30 dní. <b>NEODPORÚČA SA</b> pre zdieľané počítače.<br /><br />Aby táto funkcia pracovala správne, musia byť zapnuté Cookies.');
define('_msg_javascript32','Niektoré servery znemožňujú PHP e-mail funkcie a vyžadujú namiesto neho používať SMTP na posielanie e-mailov. Preto, ak Vám nefunguje posielanie e-mailov, skúste zapnúť túto možnosť. Ak si nie ste istý Vašimi SMTP detailami, kontaktujte svoj hosting.');
define('_msg_javascript33','Ste si istý, že chcete vymazať tieto predaje?');
define('_msg_javascript34','Ste si istý?');
define('_msg_javascript35','Ak Vaša webstránka používa Secure Socket Layer, zapnite SSL, aby  spracovanie prebehlo vo Vašej bezpečnej zóne. <b>NEZAPÍNAJTE</b> túto možnosť, ak na Vašom serveri nemáte nainštalovaný SSL certifikát!');
define('_msg_javascript36','Koľko posledných albumov chcete zobrazovať v RSS čítačke? Maximálne 999');
define('_msg_javascript37','Koľko populárnych linkov chcete zobrazovať na Domovskej stránke? Maximálne 999');
define('_msg_javascript38','Aby ste získali "Identity Token" k Vášmu Paypal profilu, choďte na:<br><br><b>Profile ->Website Payment Preferences</b><br><br> Zapnite Payment Data Transfer a skopírujte a prilepte tu Váš "Identity Token"');
define('_msg_javascript39','Predvolená stránka komponenty');
/*-----------------------------------------------------------------------------------------------------

  Pre-installiation check. 

------------------------------------------------------------------------------------------------------*/

define('_setup15','CURL Support <i>(Paypal spracovanie)</i>');
define('_setup16','PHP Verzia');
define('_setup17','Kontrola Kompatibility. V prípade chyby kontaktujte webhosting');
define('_setup18','GD Graphic Support <i>(Captcha)</i>');
define('_setup19','<font style="color:orange">OK</font>');
define('_setup20','<font style="color:red">Nenainštalované</font>');
define('_setup22','<font style="color:red">Verzia je príliš stará</font>');

/*-----------------------------------------------------------------------------------------------------

  New 1.3 text. 

------------------------------------------------------------------------------------------------------*/
define('_msg_op_cancel','Operácia bola zrušená');
define('_setup23','Importovať 1.0 Tabuľky');
define('_setup24','Open Source Credits');
define('_setup25','Prispôsobiť');
define('_setup26','Kontola systému');
define('_setup27','Jazykové súbory');
define('_setup28','Flash Players');
define('_setup29','Začať import');
define('_setup33','Začať kontrolu systému');
define('_setup30','Výsledky kontroly systému');
define('_setup31','Vaša verzia');
define('_setup32','Aktuálna verzia');

define('_msg_tableh1','Titul');
define('_msg_tableh2','Publikované');
define('_msg_tableh3','Alias');
define('_msg_tableh4','Usporiadanie');

define('_msg_categories','Kategórie');
define('_msg_categories1','Kategória');
define('_msg_categories_desc','Môžete vytvoriť kategórie na zoskupenie svojich albumov. Album môže byť vytvorený bez toho, aby patril do kategórie, ale nebude sa potom zobrazovať v prehľade kategórií');
define('_msg_categories2','Momentálne nie sú žiadne kategórie v databáze.');


define('_msg_discount','Zľava');

define('_msg_settings46','Počet dní pre uchovanie údajov v košíku');
define('_msg_settings47','Aktivovať Ajax');
define('_msg_settings48','Zobraziť vyhľadávacie pole');
define('_msg_settings49','Prídavná e-mailová adresa pre Paypal');
define('_msg_settings50','Minimálna suma pre platbu cez tento účet');
define('_msg_settings51','Ukázať link na sťahovanie po kúpe');
define('_msg_settings52','Zobraziť navigáciu');
define('_msg_settings53','Použiť funkciu Zväčšenia');

define('_msg_albums_error','Chyby: Jeden alebo viac albumov nemôže byť vymazaných');
define('_msg_albums21','Albumy vymazané');
define('_msg_albums22', 'Albumy publikované');
define('_msg_albums23', 'Albumy pridané!');

define('_msg_tracks5','Počet súborov');
define('_msg_tracks6','Vybraný súbor: ');
define('_msg_tracks7','Veľkosť: ');
define('_msg_tracks8','Typ: ');
define('_msg_tracks9','Pridať pod-adresáre: ');
define('_msg_tracks10','Linkovať na: ');
define('_msg_tracks11','Nemožno nájsť {PATH}. Choďte prosím do nastavení a opravte to');
define('_msg_tracks12','Objavila sa chyba a nie je možné nahrať súbor.');
define('_msg_tracks13','Nahranie súboru bolo uspešné: ');

define('_msg_upload_error1','Nemožno nahrať súbor na: ');
define('_msg_upload_error2','a my nevieme prečo.');

define('_msg_tools','Maian Music Tabuľky');
define('_msg_tools2','<font style="color:orange">Nájdené</font>');
define('_msg_tools3','<font style="color:red">Nenájdené</font>');
define('_msg_tools4','<font style="color:red">Výstraha!!!! Spustenie tohto importu môže prepísať všetky údaje, ktoré máte momentálne vo svojich 1.5 tabuľkách.</font>');

define('_msg_collapse_all','Zbaliť všetko');
define('_msg_expand_all','Rozbaliť všetko');

define('_msg_javascript41','Toto nastavuje koľko dní sa majú uchovávať údaje v nákupnom košíku. Ak je ponechané prázdne, bude predvolených 14 dní. Buďte opatrný, aby ste hodnotu nenastavili príliš vysoko, pretože to môže spôsobiť prílišnú veľkosť databázových tabuliek, a to najmä ak máte vysokú návštevnosť svojich stránok.');
define('_msg_javascript42','Ak máte implementované Mikro Platby na svojom primárnom Paypal Business účte, môžete tu pridať prídavný Paypal e-mail, aby ste maximalizovali svoj profiť.');
define('_msg_javascript43','Všetky platby, ktoré sú väčšie ako uvedená suma, budú spracované cez tento účet. Príklad: ak je zadaná hodnota 10, potom každá platba, ktorá je vyššia, bude spracovaná cez tento druhý Paypal účet.');
define('_msg_javascript44','Zobrazí v hlavičke vyhľadávacie políčko a tlačidlo');
define('_msg_javascript9','Paypal umožňuje prispôsobiť štýl stránky vo Vašej Paypal zóne. Ak nejakú máte, špecifikujte tu jej meno. Nechajte to voľné pre žiaden štýl.');
define('_msg_javascript40','Toto aktivuje Ajax nákupný košík vo frontende. Ak je ponechané prázdne, bude prednastavený odkaz na pôvodný nákupný košík');
define('_msg_javascript_show_link','Toto zobrazí link na stiahnutie súborov, po úspešnom zavŕšení platby, na stránke s poďakovaním.');
define('_msg_javascript45','Toto zobrazí navigačnú hlavičku na všetkých stránkach.');
define('_msg_javascript46','Toto zväčší obrázok albumu, keď návštevník klikne.');

define('_msg_free_download','Stiahnutie zadarmo');
define('_msg_go_to_download','Choďte na sťahovanie');
define('_msg_download_message','Pre urýchlenie a zvýšenie Vášho pohodlia, je link na sťahovanie uvedený nižšie');
define('_msg_download_message2','Váš email bol pridaný. Teraz môžete sťahovať súbory, ktoré sú zadarmo.');

define('_msg_require_field', 'je povinné políčko.');
define('_msg_invalid_email', 'je neplatná e-mailová adresa.');

define('_msg_no_download', 'Nie je prístupné pre sťahovanie.');

define('_msg_name', 'Meno');
define('_msg_email', 'E-mail');
define('_msg_submit', 'Odoslať');
define('_msg_no_free', 'V tomto momente nie sú k dispozícii žiadne súbory na stiahnutie zadarmo.');
define('_msg_must_provide', 'Musíte uviesť platnú e-mailovú adresu, predtým ako je Vám umožnené stiahnuť si súbor.');
define('_msg_theif', 'Pokúšate sa stiahnuť súbor, ktorý nie je zadarmo!!!!!');

define('_msg_albumsnameAZ','Názov albumu A-Z');
define('_msg_albumsnameZA','Názov albumu Z-A');
define('_msg_artistAZ','Meno autora A-Z');
define('_msg_artistZA','Meno autora Z-A');

define('_msg_enlarge','Kliknite pre zväčšenie obrázku');

define('_msg_publichome5','Najnovšie albumy');
define('_msg_publichome6','Najnovšie súbory');

define('_msg_backup','Tabuľky zálohy');
define('_msg_backup2','Začať zálohovanie');
define('_msg_backup3','<font style="color:red">Výstraha!!!! Spustenie tohto zálohovania prepíše všetky údaje, ktoré momentálne máte z toho predchádzajúceho.</font>');
define('_msg_backup4','<font style="color:green">Vytvoriť</font>');
define('_msg_backup5','Vyskytla sa chyba pri zálohovaní Vašich tabuliek. Použite prosím PHPMyAdmin a zálohujte manuálne');
define('_msg_backup6','Vaše tabuľky boli úspešne zálohované');

define('_msg_import','Vyskytla sa chyba pri importovaní Vašich tabuliek');
define('_msg_import2','Vaše 1.0 tabuľky boli úspešne importované');
define('_msg_error_bind','Problem Binding');
define('_msg_error_check','Kontrola problému');
define('_msg_error_store','Uloženie problému');

define('_msg_csv','Exportovať do CSV');
define('_msg_csv_album','Podľa Albumu');
define('_msg_csv_sale','Podľa predaja');

define('_msg_RM','RM Číslo');
define('_msg_UPC','UPC');

define('_msg_newsletter','Newsletter System nie je nainštalovaný');
define('_msg_return_to','Návrat na predchádzajúcu stránku');

define('_msg_append','Pripojiť URL');
define('_msg_label','Nálepka');
define('_msg_javascript47','Ak sú Vaše ukážky vo vnútri Vášho koreňového adresára, môžete pripojiť URL na flash playere.');
define('_msg_update','Aktualizovať');
define('_msg_upload','Nahrať');
/*-----------------------------------------------------------------------------------------------------

  New 1.4 text. 

------------------------------------------------------------------------------------------------------*/
define('_msg_frontpage_lang','Výber jazyka vo Frontende');
define('_msg_javascript_lang','Umožní používateľom vybrať si jazyk. Vlajky majú tie isté mená ako jazykové súbory umiestnené v com_maianmedia/media/flags');


define('_msg_lightbox','Deaktivovať Lightbox');
define('_msg_lightbox_javascript','Toto zobrazí súbory a albumy na priame sťahovanie, namiesto zobrazenia v okne Lightboxu.');
define('_msg_download_javascript','Na stránke s poďakovaním sa zobrazí link na stiahnutie súborov.');

define('_msg_active','Aktivovať');
define('_msg_inactive','Deaktivovať');

define('_msg_gen','Vygenerovať sťahovanie');  
              
define('_msg_continue','Pokračovať v nakupovaní');
define('_msg_physical','Physical CD');
define('_msg_javascript_zip','Will zip your albums if your server supports it.');
define('_msg_cart_zip','Download Cart');
?>
