<?php

/*------------------------------------------
 MAIAN MUSIC v1.3
 Written by David Ian Bennett
 E-Mail: support@maianscriptworld.co.uk
 Website: www.maianscriptworld.co.uk
 This File: English language file
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

$_msg_author = 'Leonardo Cordero';
$_msg_website  = 'http://www.DisfruteLaVida.com';

/*--------------------------------------
 INC/HEADER.PHP
 -------------------------------------*/

define( '_msg_public_header','Nuestra Tienda de M&uacute;sica @ {website}');
define( '_msg_public_header2','Carrito de Compras');
define( '_msg_public_header3','Más Popular');
define( '_msg_public_header4','M&uacute;sica');
define( '_msg_public_header5','Contacto');
define( '_msg_public_header6','Somos');
define( '_msg_public_header7','Buscar');
define( '_msg_public_header8','Keywords');
define( '_msg_public_header9','Premium Beat Flash Player');
define( '_msg_public_header10','Este sistema utiliza<br />Premium Beat Flash Player<br /><b>&copy); Premium Beat.com</b>');
define( '_msg_public_header11','Artículo en Carrito');
define( '_msg_public_header12','Licencia');
define( '_msg_public_header13','MP3 Tracks para bajar de nuestra tienda de m&uacute;sica.');
define( '_msg_public_header14','mp3,downloads,albums,tracks,music,music store');
define( '_msg_public_header15','Texto más Popular');



/*--------------------------------------
 TEMPLATES/ALBUM.TPL.PHP
 -------------------------------------*/

define( '_msg_publicalbum','Pre-escuchar/Comprar Pistas');
define( '_msg_publicalbum2','Por favor utilice los botones para escuchar y/o comprar las Pistas.  Puede adquirir solamente las Pistas que se venden individualmente, no todas se venden individualmente a petición del Artista. Gracias.');
define( '_msg_publicalbum3','Pre-escuchar');
define( '_msg_publicalbum4','Agregar al Carrito');
define( '_msg_publicalbum5','Nombre de la Pista');
define( '_msg_publicalbum6','Costo');
define( '_msg_publicalbum7','Agregar al Carrito');
define( '_msg_publicalbum8','Agregar todas las pistas al Carrito');
define( '_msg_publicalbum9','Agregar las pistas seleccionadas al Carrito');
define( '_msg_publicalbum10','Escuchar las Pistas');
define( '_msg_publicalbum11','Pista');
define( '_msg_publicalbum12','Esta página ha sido vista <b>{count}</b> veces.');
define( '_msg_publicalbum13','Guardar <b>{amount}</b> %');
define( '_msg_publicalbum14','Albums relacionados');


/*--------------------------------------
 TEMPLATES/CART.TPL.PHP
 -------------------------------------*/

define( '_msg_cart','Tienda');
define( '_msg_cart2','Las pistas que están en su carrito se muestran abajo.  Utilice los botones que se ofrecen para remover.  Cuando lo desee con sus selecciones, haga click en \'Pagar\' para proceder:');
define( '_msg_cart3','En este momento hay 0 pistas en su carrito.');
define( '_msg_cart4','{count} Pistas en su Carrito');
define( '_msg_cart5','Total');
define( '_msg_cart6','Limpiar Carrito');
define( '_msg_cart7','Pagar');
define( '_msg_cart8','De:');
define( '_msg_cart9','Usted Ahorra {discount}%');


/*--------------------------------------
 TEMPLATES/CONTACT.TPL.PHP
 -------------------------------------*/

define( '_msg_contact','<div id="mm_contact">Si usted está experimentando problemas o le gustaría hacernos preguntas con referencia a la m&uacute;sica, por favor llene la forma que se ofrece a continuación:</div>');
define( '_msg_contact2','Contáctenos');
define('_msg_contact3','Tema');
define('_msg_contact4','Comentarios');
define('_msg_contact5','Enviar Mensaje');
define('_msg_contact6','Por favor incluye un tema...');
define('_msg_contact7','Por favor incluye alg&uacute;n comentario...');
define('_msg_contact8','Su mensaje ha sido enviado.<br /><br />Pronto le estaremos contactando.');
define('_msg_contact9','Nombre');
define('_msg_contact10','Dirección de E-Mail');
define('_msg_contact11','Ponga el Código');
define('_msg_contact12','Código Inválido, por favor trate de nuevo..');
define('_msg_contact13','Gracias!');
define('_msg_contact14','¡Mensaje Enviado!');
define('_msg_contact15','Por favor incluya su nombre...');
define('_msg_contact16','Por favor incluya un E-Mail Válido...');
define('_msg_contact17','Click Captcha para refrescar');


/*--------------------------------------
 TEMPLATES/CONTACT.TPL.PHP
 -------------------------------------*/

define('_msg_publichome','Gracias por su interés en nuestra m&uacute;sica.  Utilice el enlace en el men&uacute; de la izquierda para visitar nuestra colección de albums.  Usted puede comprar pista individuales o el album entero utilizando los botones.  También puede escuchar parte de las pitas antes de comprarlas. <br /><br />Todos los pagos son manejados por el Ultraseguro servidor de Paypal y no necesita tener una cuenta con Paypal para pagar con su tarjeta de crédito o débito.<br /><br />  Por favor contáctenos si tiene alguna pregunta, ¡gracias!
                         ');  
define('_msg_publichome2','Todas las tarjetas de Crédito y Débito principales son aceptadas via Paypal');
define('_msg_publichome3','Pistas más populares');
define('_msg_publichome4','Albums más populares');


/*--------------------------------------
 TEMPLATES/DOWNLOAD_ITEM.TPL.PHP
 -------------------------------------*/


define('_msg_downloaditem','<br /><br /><span class="sorry">¡Disculpe!</span><br /><br /><span class="sorry_msg">¡Esta descarga ha expirado!</span><br /><br /><br />Por favor contáctenos para reactivarle la descarga.');
define('_msg_downloaditem2','<br /><br /><span class="sorry">¡Error!</span><br /><br /><span class="sorry_msg">¡Usted no tiene permiso<br />para ver esta página!</span><br /><br /><br />Por favor contáctenos si piensa que esto es incorrecto.');


/*--------------------------------------
 TEMPLATES/MUSIC.TPL.PHP
 -------------------------------------*/

define('_msg_music','Por favor haga click en los enlaces para ver más información acerca de un album y para escuchar/comprar los temas.  Gracias.');
define('_msg_music2','Más información');
define('_msg_music3','Temas: {count}');


/*--------------------------------------
 TEMPLATES/PAYPAL/CANCEL.TPL.PHP
 TEMPLATES/PAYPAL/CHECKOUT.TPL.PHP
 TEMPLATES/PAYPAL/DOWNLOAD.TPL.PHP
 TEMPLATES/PAYPAL/ERROR.TPL.PHP
 TEMPLATES/PAYPAL/THANKS.TPL.PHP
 -------------------------------------*/

define('_msg_paypal','Conectándose al servidor de Paypal.....Por favor espere....');
define('_msg_paypal2','Compras de la Tienda de M&uacute;sica');
define('_msg_paypal3','Transacción Cancelada!');
define('_msg_paypal4','Su transacción ha sido exitósamente cancelada y ning&uacute;n pago ha diso procesado ni enviado.<br /><br />Gracias por su interés en nuestra m&uacute;sica.');
define('_msg_paypal5','¡Transacción Inválida!');
define('_msg_paypal6','Esto parece ser una transacción inválida debido a que la cantidad del pago es diferente a la cantidad del carrito de compras.<br /><br />El webmaster ya ha sido informado y este podrá tomar otras acciones.<br /><br />Si usted siente que esto es un error, por favor contáctenos.  <br /><br />Gracias.');
define('_msg_paypal7','¡Gracias!');
define('_msg_paypal8','Su transacción ha sido exitósamente completada.<br /><br />
                              Por favor revise su bandeja de entrada y/o su bandeja de correo spam en su cuenta de correo electrónico "<b>{email}</b>". Esta contiene el enlace para descargar los temas o albums que usted ha comprado. Por favor siga estos enlaces para ir a la página de descargas. Si usted no recibiera este correo electrónico, por favor contáctenos lo antes posible para procesarlo manualmente.<br /><br />
                              Esperamos que disfrute mucho de nuestra m&uacute;sica,<br /><br />
                              <b>{store}</b>');
define('_msg_paypal9','¡Un Error ha Ocurrido!');
define('_msg_paypal10','Disculpe, usted no tiene permiso para ver esta página.');
define('_msg_paypal11','Ninguna información de comprar realizada ha sido encontrada.  Por favor revise de nuevo el enlace que activó en su correo electrónico. <br/><br />Si usted siente que ha ocurrido un error, por favor contáctenos.<br /><br />¡Gracias!');
define('_msg_paypal12','¡¡Página de Descarga ha Expirado!');
define('_msg_paypal13','Este enlace ha expirado y no se puede accesar más.  Nuestro sistema automáticamente restringe el tiempo que la página de descarga puede ser accesada por razones de seguridad.<br /><br />  Si usted necesita accesar esta página de nuevo, por favor contáctenos para reactivar el enlace.<br /><br />
                              Disculpe cualquier inconveniente que esto le pueda ocasionar,<br /><br />
                              <b>{store}</b>');
define('_msg_paypal14','Página de Descarga');
define('_msg_paypal15','Gracias por su compra, sus descargas se muestran abajo.<br /><br />Por favor<b>NO</b> refreque o marque como favorito este sitio web, ya que pudo haber expirado cuando usted regrese al mismo.<br /><br />Usted tiene permitido descargar cada archivo {duration}.   Si usted experimenta cualquier problema, por favor contáctenos.');
define('_msg_paypal16','Una vez');
define('_msg_paypal17','Dos veces');
define('_msg_paypal18','veces');
define('_msg_paypal19','Albums Comprados');
define('_msg_paypal20','Temas Comprados');
define('_msg_paypal21','No se ha encontrado información acerca de ning&uacute;n album comprado');
define('_msg_paypal22','No se ha encontrado información acerca de ning&uacute;n tema comprado');
define('_msg_paypal23','¡Que disfrute su nueva m&uacute;sica!');
define('_msg_paypal24','Descargar Album');
define('_msg_paypal25','Descargar Arte');
define('_msg_paypal26','Descargar Temas');
define('_msg_paypal27','¡El Archivo no existe!');
define('_msg_paypal28','Todos los temas =');
define('_msg_paypal29','¡Haga click al botón(es) para descargar!');
define('_msg_paypal30','Devolverse a la página anterior');
define('_msg_paypal31','Descargar Expirado');


/*--------------------------------------
 TEMPLATES/SEARCH.TPL.PHP
 -------------------------------------*/

define('_msg_publicsearch','Resultados de B&uacute;squeda');
define('_msg_publicsearch2','Sus resultados de b&uacute;squeda para "<b>{keywords}</b>" se muestran a continuación.   Si su b&uacute;squeda no genera resultados, trate de utilizar varias palabras claves, separadas por un espacio, para lograr una b&uacute;squeda más detallada.');
define('_msg_publicsearch3','<br /><b>Ning&uacute;n resultado fue encontrado...por favor trate de nuevo...</b>');
define('_msg_publicsearch4','{count} Resultados de B&uacute;squeda');


/*--------------------------------------
 ADMIN/INC/HEADER.PHP
 -------------------------------------*/

define('_msg_header','Administration');
define('_msg_header2','About');
define('_msg_header3','Settings');
define('_msg_header4','Manage Albums');
define('_msg_header5','Add New Tracks');
define('_msg_header6','Manage Tracks');
define('_msg_header7','Sales');
define('_msg_header8','Search Sales');
define('_msg_header9','Navigational Menu');
define('_msg_header10','Categories');
define('_msg_header11','Statistics');


/*--------------------------------------
 ADMIN/INC/FOOTER.PHP
 TEMPLATES/FOOTER.TPL.PHP
 -------------------------------------*/

define('_msg_footer','Copyright');
define('_msg_footer2','All Rights Reserved');
define('_msg_footer3','Please enable javascript in your browser. Thank you!');


/*--------------------------------------
 ADMIN/DATA_FILES/ADD.PHP
 -------------------------------------*/

define('_msg_add','Here you add your mp3/mp4 tracks. Before adding make sure full length &amp); preview tracks are uploaded into the folders specified in your settings. Use the drop down menu below to select
                              how many tracks you would like to add and then fill out the details for each track. Use the help links for information if you aren`t sure.<br><br>
                              <i>Note that if you omit the track name, mp3 file path or cost, the file will NOT be added.</i>');  
define('_msg_add2','Tracks to Add');
define('_msg_add3','How many tracks would you like to add? You can refresh this at any time and no form data will be lost.');
define('_msg_add4','Track');
define('_msg_add5','Add Tracks');
define('_msg_add6','Track Name');
define('_msg_add7','Add to Album');
define('_msg_add8','MP3 File Path');
define('_msg_add9','Preview File Path');
define('_msg_add10','Length of Track');
define('_msg_add11','Cost');
define('_msg_add12','Single Purchase');
define('_msg_add13','<b>{count}</b> track(s) were successfully added. You can manage tracks, below.');
define('_msg_add14','Display');
define('_msg_add15','for all tracks.');


/*--------------------------------------
 ADMIN/DATA_FILES/ALBUMS.PHP
 -------------------------------------*/

define('_msg_albums','MP3s are grouped into albums. When you add tracks, you`ll
                              need to specify which album to put it into. Visitors can purchase single tracks or whole albums. Once you add a new album it will appear below.');  
define('_msg_albums2','Album');
define('_msg_albums3','Album Name');
define('_msg_albums4','Current Albums -- Click name to edit');
define('_msg_albums5','Album Image URL');
define('_msg_albums20','Albums');
//define('_msg_albums21','Height:');
//define('_msg_albums22','Width:');
define('_msg_albums6','Album Artwork (Zip File)');
define('_msg_albums7','Comments/Info');
define('_msg_albums8','Enable Album');
define('_msg_albums9','There are currently 0 albums in the database.');
define('_msg_albums10','Updated Album');
define('_msg_albums11','Artist');
define('_msg_albums12','Keywords');
define('_msg_albums13','Downloads');
define('_msg_albums14','Reset Track Downloads');
define('_msg_albums15','Hits');
define('_msg_albums16','Category');
define('_msg_albums17','Top Level Album');
define('_msg_albums18','Uncategorized');
define('_msg_albums19','Album Purchase Discount');

/*--------------------------------------
 ADMIN/DATA_FILES/HOME.PHP
 -------------------------------------*/

define('_msg_home','Welcome to Maian Music for Joomla, a simple music store system that enables you to preview and sell your own music
                              in mp3/mp4 format.  This script was orginaly written by <a href="http://www.maianscriptworld.co.uk" title="Maian Script World" target="_blank">Maian Script World</a> and now has been converted to Joomla by <a href="http://www.aretimes.com" title="Are Times" target="_blank">Are Times</a>.
                              To use this system you must have a paypal bussiness account.  It is recommened to enable Auto Return for a more streamlined customer expreince.  When configuring this componnet look for
                               [<b><span style="color:#FF7700">?</span></b>] tooltips for more information.<br><br> 
                              If you have any problems, please post on the <a href="http://www.aretimes.com/component/option,com_fireboard/Itemid,33/" title="Support Forums" target="_blank">support forums</a>.<br><br>
                              Please contact me via our website if you have comments or find any bugs. <br><br>
                              I hope you enjoy your music system,<br><br>Alao.<br><br><b>Are Times</b><br><a href="http://www.aretimes.com" title="Are Times" target="_blank">http://www.aretimes.com</a>');
define('_msg_dedicate','<br><br>Dedicated to <a href="http://www.lpierce927.com" title="Looch" target="_blank">Lamar Anthony Pierce</a> A.K.A <a href="http://www.myspace.com/thereallooch" title="Looch" target="_blank">Looch</a>');
define('_msg_home2','Donation');
define('_msg_home3','If you like this script and would like to show support please consider either making a donation or purchacing music from Are Times');
define('_msg_home4','Donations are not necessary, but very much appreciated. Thank you!');
define('_msg_home5','Music Store Overview');
define('_msg_home6','You currently have <b>{tracks}</b> tracks, grouped into <b>{albums}</b> albums.<br><br>
                              Paypal Fees: <b>{fees}</b><br>
                              Profit: <b>{profit}</b><br><br>
                              <b>{a_purchases}</b> albums and <b>{t_purchases}</b> single tracks have currently been purchased.
                         ');
 

/*--------------------------------------
 ADMIN/DATA_FILES/LOGIN.PHP
 -------------------------------------*/

define('_msg_login','Administration Login');
define('_msg_login2','Please login to your administration area below:');
define('_msg_login3','Username');
define('_msg_login4','Password');
define('_msg_login5','Login');
define('_msg_login6','Invalid');
define('_msg_login7','Remember Me');


/*--------------------------------------
 ADMIN/DATA_FILES/SALES.PHP
 -------------------------------------*/

define('_msg_sales','Your processed sales are shown below. Use the order by options if required. Use the links provided to manage your sales or contact buyers. If you need to locate an entry, use the search option from the menu.');
define('_msg_sales2','Show');
define('_msg_sales3','Per Page');
define('_msg_sales4','Newest Sales');
define('_msg_sales5','Oldest Sales');
define('_msg_sales6','Tracks Purchased');
define('_msg_sales7','Albums Purchased');
define('_msg_sales8','Highest Grossing');
define('_msg_sales9','Lowest Grossing');
define('_msg_sales10','Buyers Name A-Z');
define('_msg_sales11','Buyers Name Z-A');
define('_msg_sales12','Viewing {count} Sales');
define('_msg_sales13','There are currently <b>0</b> sales in the database.');
define('_msg_sales14','Remove Selected Sales');
define('_msg_sales15','Albums Purchased');
define('_msg_sales16','Tracks Purchased');
define('_msg_sales17','<b>0</b> albums purchased.');
define('_msg_sales18','<b>0</b> tracks purchased.');
define('_msg_sales19','by');
define('_msg_sales20','Albums');
define('_msg_sales21','Tracks');
define('_msg_sales22','View Sales Information');
define('_msg_sales23','Contact Buyer');
define('_msg_sales24','Subject');
define('_msg_sales25','Comments');
define('_msg_sales26','Or if you have an e-mail client, click <a href="mailto:{email}" title="Click to launch e-mail client"><b><u>here</u></b></a>.');
define('_msg_sales27','Message Sent!');
define('_msg_sales28','Send Message');
define('_msg_sales29','Reset Downloads &amp; Re-Send Download E-Mail');
define('_msg_sales30','Buyer/Paypal Information');
define('_msg_sales31','E-Mail Sent to Buyer!');
define('_msg_sales32','Click to View');
define('_msg_sales33','Buyer');
define('_msg_sales34','E-Mail');
define('_msg_sales35','Date');
define('_msg_sales36','Address');
define('_msg_sales37','Buyer Memo');
define('_msg_sales38','Payment Status');
define('_msg_sales39','Gross/Fee/Total');
define('_msg_sales40','Paypal Transaction ID');
define('_msg_sales41','Customers');
define('_msg_sales42','Info');
define('_msg_sales43','Remove');
define('_msg_sales44','Paypal Transaction ID');
define('_msg_sales45','Invoice No');

/*--------------------------------------
 ADMIN/DATA_FILES/SEARCH.PHP
 -------------------------------------*/

define('_msg_search','This feature lets you search your sales. Useful if you have lots of entries and need to locate a specific one. Please specify your criteria below. You can enter one or all search terms, but you must include at least one option:');
define('_msg_search2','Enter Search Criteria');
define('_msg_search3','Where \'name\' like');
define('_msg_search4','Where \'e-mail\' like');
define('_msg_search5','Where \'invoice no\' =');
define('_msg_search6','Where \'trans id\' =');
define('_msg_search7','Where \'date\' between');
define('_msg_search8','Search');
define('_msg_search9','No matches found...Please try another search...');
define('_msg_search10','Search Results');
define('_msg_search11','Your search results are shown below');
define('_msg_search12','New Search');


/*--------------------------------------
 ADMIN/DATA_FILES/SETTINGS.PHP
 -------------------------------------*/

define('_msg_settings','Update your program settings below. All fields should be completed unless stated as optional.');
define('_msg_settings2','Website/General Settings');
define('_msg_settings3','Music Store Name');
define('_msg_settings4','E-Mail Address');
define('_msg_settings5','Homepage URL');
define('_msg_settings6','URL to Installation Folder');
define('_msg_settings7','Language');
define('_msg_settings8','Enable Captcha');
define('_msg_settings9','MP3/Download Settings');
define('_msg_settings10','MP3 Folder Path');
define('_msg_settings11','MP3 Preview Folder Path');
define('_msg_settings12','Update Settings');
define('_msg_settings13','Search Engine Friendly URLs');
define('_msg_settings14','Paypal Settings');
define('_msg_settings15','Enable Paypal IPN');
define('_msg_settings16','Enable Sandbox');
define('_msg_settings17','Live');
define('_msg_settings18','Log Errors');
define('_msg_settings19','Page Style');
define('_msg_settings20','Paypal E-Mail Address');
define('_msg_settings21','Processing Currency');
define('_msg_settings22','');
define('_msg_settings23','Page(s) Text');
define('_msg_settings24','<a href="http://en.wikipedia.org/wiki/HTML" title="Hypertext Markup Language" target="_blank">HTML</a> is allowed');
define('_msg_settings25','Download Page Expiry');
define('_msg_settings26','Total Albums for RSS Feed');
define('_msg_settings27','Total Popular Links');
define('_msg_settings28','SSL Enabled');
define('_msg_settings29','SMTP Port');
define('_msg_settings30','Reset All Album Hits');
define('_msg_settings31','Download Item Expiry');
define('_msg_settings32','License Page Text');
define('_msg_settings33','SMTP Settings');
define('_msg_settings34','Enable SMTP');
define('_msg_settings35','SMTP Host');
define('_msg_settings36','SMTP Username');
define('_msg_settings37','SMTP Password');
define('_msg_settings38','Mp3 Player Configuration');
define('_msg_settings39','Player');
define('_msg_settings40','Payment Data Transfer');
define('_msg_settings41','Default Page');
define('_msg_settings42','Most Popular');
define('_msg_settings43','Music');
define('_msg_settings44','Music Page Text');

/*--------------------------------------
 ADMIN/DATA_FILES/STATISTICS.PHP
 -------------------------------------*/

define('_msg_statistics','This page lets you see at a glance how many times each album or track has been purchased. Click the buttons to expand an album for track stats.
                         ');
define('_msg_statistics2','Order By');
define('_msg_statistics3','Most Hits');
define('_msg_statistics4','Least Hits');
define('_msg_statistics5','Album');
define('_msg_statistics6','Single');
define('_msg_statistics7','<li>Hits: <b>{hits}</b> </li> <li>Album Purchases: <b>{albums}</b> </li> <li> Track Purchases: <b>{tracks}</b></li>');
define('_msg_statistics8','View Track Statistics');
define('_msg_statistics9','This displays a list of each track for this album and the total amount of purchases for each track.');
define('_msg_statistics10','Expand All');
define('_msg_statistics11','Collapse All');


/*--------------------------------------
 ADMIN/DATA_FILES/TRACKS.PHP
 -------------------------------------*/

define('_msg_tracks','This page lets you manage your current tracks. Select an album from below to view tracks in that album and then use the buttons provided to update tracks.');
define('_msg_tracks2','<b>{count}</b> tracks');
define('_msg_tracks3','View Tracks');
define('_msg_tracks4','No Tracks');


/*--------------------------------------
 ADMIN/DATA_FILES/VIEW_TRACKS.PHP
 -------------------------------------*/

define('_msg_viewtracks','Update Tracks');
define('_msg_viewtracks2','Click on the links to edit a track. You can update or delete any track and also change the order by option which determines the order
                              in which the tracks are displayed in the public view.');
define('_msg_viewtracks3','Update This Track');
define('_msg_viewtracks4','Move Up');
define('_msg_viewtracks5','Move Down');
define('_msg_viewtracks6','This album currently has 0 tracks');
define('_msg_viewtracks7','Cancel');
define('_msg_viewtracks8','Track successfully updated!');
define('_msg_viewtracks9','Refresh');


/*---------------------
 RESPONSE DATA FOR IPN
 PAYPAL E-MAILS
 ----------------------*/

define('_msg_ipn','Orden Inválida');
define('_msg_ipn2','Paypal IPN Error!!');
define('_msg_ipn3','Si es posible, este error ha sido registrado en el archivo de errores.');
define('_msg_ipn4','Los siguientes datos han sido recibidos de (y enviados de vuelta a) PayPal:');
define('_msg_ipn5','Pago falló');
define('_msg_ipn6','Pago denegado');
define('_msg_ipn7','Status del pago desconocido');
define('_msg_ipn8','¡Compra en la Tienda de M&uacute;sica pendiente!');
define('_msg_ipn9','¡Transacción de compra inválida!');
define('_msg_ipn10','¡Información para descargar la M&uacute;sica!');
define('_msg_ipn11','Transacción en la Tienda de M&uacute;sica!');


/*-------------------------------------
 GENERAL VARIABLES
 ------------------------------------*/

define('_msg_script','Maian Music');
define('_msg_script2','Si');
define('_msg_script3','No');
define('_msg_script4','Opcional');
define('_msg_script5','Primero');
define('_msg_script6','Apellido');
define('_msg_script7','Editar');
define('_msg_script8','Borrar');
define('_msg_script9','Cancelar');
define('_msg_script10','Refrescar');
define('_msg_script11','Imprimir');
define('_msg_script12','ilimitado');


/*-----------------------------
 RSS Feeds
 -------------------------------*/

define('_msg_rss','Ultimos albums @ {website_name}');
define('_msg_rss2','Estos son los &uacute;ltimos albums que se han añadido a  {website_name}');
define('_msg_rss3','Album:');


/*----------------------
 ADMIN/INC/CALENDAR.PHP
 -----------------------*/

define('_msg_calendar','Enero');
define('_msg_calendar2','Febrero');
define('_msg_calendar3','Marzo');
define('_msg_calendar4','Abril');
define('_msg_calendar5','Mayo');
define('_msg_calendar6','Junio');
define('_msg_calendar7','Julio');
define('_msg_calendar8','Agosto');
define('_msg_calendar9','Setiembre');
define('_msg_calendar10','Octubre');
define('_msg_calendar11','Noviembre');
define('_msg_calendar12','Deciembre');


/*--------------------------------------------------------------------------------------------------
 ZIP FILE FOLDER NAMES
 These are the names of the folders that are created inside the zip file when someone downloads
 an album or track. These should NOT contain any illegal characters that may prevent the creation
 of the folder. If you are unsure, leave them as they are
 --------------------------------------------------------------------------------------------------*/

define('_msg_folder','temas');
define('_msg_folder2','album');


/*-----------------------------------------------------------------------------------------------------
 JAVASCRIPT VARIABLES
 IMPORTANT: If you want to use apostrophes in these variables, you MUST escape them with 3 backslashes
 Failure to do this will result in the script malfunctioning on javascript code. Unless you
 specifically need them, using double quotes is recommended.
 EXAMPLE: d\\\'apostrophe
 ------------------------------------------------------------------------------------------------------*/

define('_msg_javascript','Help/Information');
define('_msg_javascript2','Full url to folder containing files. NO trailing slash.<br><br><b>http://www.yoursite.com/music</b>');
define('_msg_javascript3','A captcha can help spam coming via your contact option. The <b>GD Library with Freetype support</b> is required to be installed on your server for this to work. See the docs for more information.');
define('_msg_javascript4','MP3 files should always be stored outside of the web root. This is the relative path from the music root folder to the MP3 folder. Name it manually and make sure it exists. NO trailing slash.<br><br><b>/home/user/mp3</b>');
define('_msg_javascript5','Same as above, but this is the path to the MP3 preview folder. This can be alongside or inside the above MP3 folder. NO trailing slash.<br><br><b>../mp3/mp3_preview or /mp3_preview</b>');
define('_msg_javascript6','Enables mod_rewrite for search engine friendly urls. For this to work, your server must support <b>.htaccess</b> Once enabled rename <b>htaccess_COPY.txt</b> file to <b>.htaccess</b><br><br>May result in server error if enabled and <b>.htaccess</b> isn`t supported.');
define('_msg_javascript7','Paypal enables you to test the system without actually submitting a live payment. This is the <b>sandbox</b> mode and more details can be found <a href="https://developer.paypal.com" title="Sandbox" target="_blank">here</a>.<br><br>Check the box to enable sandbox. Uncheck for live processing.');
define('_msg_javascript8','This is your business or premier account paypal e-mail address.');
define('_msg_javascript9','Paypal enables you to create a page style in your Paypal area. If you have one, specify its name here. Leave blank for no page style.');
define('_msg_javascript10','If an invalid response is sent back from Paypal, you can log the error. This is useful for debugging and I recommend you leave this enabled when testing.');
define('_msg_javascript11','Specify your processing currency. The list shows the ones supported by Paypal at the time this script was created.');
define('_msg_javascript12','If you have a preview image you would like to display for this album, specify the full url starting http://<br><br>Note that image displays full size by default and should be <b>65</b>x<b>65</b> pixels.<br><br><i>(Optional)</i>');
define('_msg_javascript13','If a visitor purchases a full album and you would also like them to be able to download the cover art, put the files in a .zip file, upload and specify the path here starting http://<br><br>If someone purchases a full album, this link will also be included along with the link to download the mp3s.<br><br><i>(Optional)</i>');
define('_msg_javascript14','Set the status for this album. If disabled, it is not viewable by the public.');
define('_msg_javascript15','Are you sure?\n\nThis will also delete mp3 files attached to this album.\n\nNote that actual files should be removed manually.');
define('_msg_javascript16','Specify the mp3 file path <b>ONLY</b> here unless you have the mp3 file inside of another folder in the main mp3 folder. This file should be uploaded into the relevant folder. Examples:<br><br><b>music_file.mp3</b><br><b>album1/music_file.mp3</b>');
define('_msg_javascript17','If you want to use a shorter track for a preview, specify the file name here. This file should exist in the preview folder in your settings. If no preview file is added, preview will be full length track.<br><br>Optional');
define('_msg_javascript18','Specify the length of this track. Examples:<br><br>4:32<br>4mins 32 seconds<br>4-32');
define('_msg_javascript19','Specify the cost you are selling this track at. NO currency symbol before the price. So, if you were selling for &pound);0.75 you would put <b>0.75</b>.');
define('_msg_javascript20','Is this track available as a single purchase? If not, track can only be purchased by buying whole album.');
define('_msg_javascript21','Are you sure you wish to delete this track?');
define('_msg_javascript22','Enter keywords that best describe the music of this album. Appears in the meta keywords head tag on page.');
define('_msg_javascript23','If you want visitors to get a discount for purchasing a whole album, specify the percentage here. Set as 0 for no discount.');
define('_msg_javascript24','When someone purchases tracks, they are sent the link to a download page. To prevent them from sending this link to other people you can specify how many times this page can be accessed before the link expires. <b>Set to 0 for unlimited</b>.');
define('_msg_javascript25','Are you sure you want to clear your cart?');
define('_msg_javascript26','Delete this item?');
define('_msg_javascript27','This option lets you batch reset download counts. For individual albums, use the option when updating album. For individual tracks, use the option when updating track.');
define('_msg_javascript28','If you check the box, all tracks in this album will have the download count set to 0.');
define('_msg_javascript29','If you check this box, all hits for all albums will be reset to 0. To update individual album, use the manage albums page.');
define('_msg_javascript30','This is the limit that any purchase can be downloaded. <b>Set to 0 for unlimited</b>.');
define('_msg_javascript31','Keeps you logged in for 30 days. <b>NOT</b> recommended for shared computers.<br /><br />Cookies must be enabled for this function to work.');
define('_msg_javascript32','Some hosts disable the PHP mail function and require you to use SMTP to send mail. If the mail isn`t working, try enabling this option. If you are unsure of your SMTP details, contact your hosting company.');
define('_msg_javascript33','Are you sure you want to delete these sales?');
define('_msg_javascript34','Are you sure?');
define('_msg_javascript35','If your site is on a Secure Socket Layer, enable SSL to have the processing return to your secure area. Do <b>NOT</b> enable this is you don`t have a SSL certificate installed on your server.');
define('_msg_javascript36','How many latest albums do you want to display on the RSS feed? Max 999');
define('_msg_javascript37','How many popular links do you want to display on homepage? Max 999');
define('_msg_javascript38','To get your Idenity Token under your Paypal profile go to:<br><br><b>Profile ->Website Payment Preferences</b><br><br> Turn on Payment Data Transfer and copy and paste your Identity Token');
define('_msg_javascript39','Determines which page the component defaults to');
/*-----------------------------------------------------------------------------------------------------

Pre-installiation check.

------------------------------------------------------------------------------------------------------*/

define('_setup15','CURL Support <i>(Paypal Processing)</i>');
define('_setup16','PHP Version');
define('_setup17','Compatibility Check if not ok contact your host');
define('_setup18','GD Graphic Support <i>(Captcha)</i>');
define('_setup19','<font style="color:orange">OK</font>');
define('_setup20','<font style="color:red">Not Installed</font>');
define('_setup22','<font style="color:red">Version Too Old</font>');

/*-----------------------------------------------------------------------------------------------------

New 1.3 text.

------------------------------------------------------------------------------------------------------*/
define('_msg_op_cancel','Operation Cancelled');
define('_setup23','Import 1.0 Tables');
define('_setup24','Open Source Credits');
define('_setup25','Customize');
define('_setup26','System Check');
define('_setup27','Language Files');
define('_setup28','Flash Players');
define('_setup29','Start Import');
define('_setup33','Start System Check');
define('_setup30','System Check Results');
define('_setup31','Your Version');
define('_setup32','Current Version');

define('_msg_tableh1','Title');
define('_msg_tableh2','Published');
define('_msg_tableh3','Alias');
define('_msg_tableh4','Order');

define('_msg_categories','Categories');
define('_msg_categories1','Category');
define('_msg_categories_desc','You can create categories to group your albums.  An album can be created without it belonging to a category but it won\'t show up in the category views');
define('_msg_categories2','There are currently no categories in the database.');


define('_msg_discount','Discount');

define('_msg_settings46','Keep Cart Data');
define('_msg_settings47','Activate Ajax');
define('_msg_settings48','Include Search Field');
define('_msg_settings49','Additional Paypal E-Mail Address');
define('_msg_settings50','Minimum Payment');
define('_msg_settings51','Show Download Link After Purchase');
define('_msg_settings52','Show Navigation');

define('_msg_albums_error','Error: One or More Albums Could not be Deleted');
define('_msg_albums21','Album(s) Deleted');
define('_msg_albums22', 'Album Published');
define('_msg_albums23', 'Album Added!');

define('_msg_tracks5','Number of Tracks');
define('_msg_tracks6','Selected File: ');
define('_msg_tracks7','Size: ');
define('_msg_tracks8','Type: ');
define('_msg_tracks9','Add Sub Folder: ');
define('_msg_tracks10','Link To: ');
define('_msg_tracks11','Could not find {PATH}.  Please go to settings and correct');
define('_msg_tracks12','An error occured could not upload file.');
define('_msg_tracks13','Upload Success: ');

define('_msg_upload_error1','Could not upload to: ');
define('_msg_upload_error2','and I don\'t know why.');

define('_msg_tools','Maian Music Tables');
define('_msg_tools2','<font style="color:orange">Found</font>');
define('_msg_tools3','<font style="color:red">Not Found</font>');
define('_msg_tools4','<font style="color:red">Warning!!!! Running this import may overwrite any data you currently have in your 1.5 tables.</font>');

define('_msg_collapse_all','Collapse All');
define('_msg_expand_all','Expand All');

define('_msg_javascript41','This determines how many days to keep unsued data in the cart.  If left blank it will default is 14 days.  Be careful not to make it to high because it will cause the database table to become large especally if you have a lot of traffic on your site.');
define('_msg_javascript42','If you have implemented Micro Payments on your primary Paypal Bussiness account you can enter an additional paypal email here to maximize profits.');
define('_msg_javascript43','All payments that are greater than the value provided will be proceseed by this account.  Example if 10 is entered then any payment that is above 10 will be processed by this second paypal account.');
define('_msg_javascript44','Will show the search text box and button in the header');
define('_msg_javascript40','This will activate an ajax cart on the front end. If left blank it will default to the legacy cart');
define('_msg_javascript_show_link','This will show the download link after a successful transaction on the thank you page.');
define('_msg_javascript45','This will show a navigation header on all pages.');


define('_msg_free_download','Free Download\'s');
define('_msg_go_to_download','Go To Download');
define('_msg_download_message','For you convince a download link has been provided below');
define('_msg_download_message2','Your email was added.  You may now download free tracks.');

define('_msg_require_field', 'is a required field.');
define('_msg_invalid_email', 'is an invalid email address.');

define('_msg_no_download', 'Not available for download.');

define('_msg_name', 'Name');
define('_msg_email', 'Email');
define('_msg_submit', 'Submit');
define('_msg_no_free', 'No free downloads are being offered at this time.');
define('_msg_must_provide', 'Must provide valid email address before you can download a track.');
define('_msg_theif', 'U hebt geprobeerd te downloaden van een track die niet vrij !!!!!');

define('_msg_albumsnameAZ','Album Name A-Z');
define('_msg_albumsnameZA','Album Name Z-A');
define('_msg_artistAZ','Artist Name A-Z');
define('_msg_artistZA','Artist Name Z-A');

define('_msg_enlarge','Click for Larger Image');

define('_msg_publichome5','Latest Albums');
define('_msg_publichome6','Latest Tracks');

define('_msg_backup','Backup Tables');
define('_msg_backup2','Start Backup');
define('_msg_backup3','<font style="color:red">Warning!!!! Running this backup overwrite any data you currently have from a previous backup.</font>');
define('_msg_backup4','<font style="color:green">Create</font>');
define('_msg_backup5','The was an error backing up your tables. Please use PHPMyAdmin and back up you tables manually');
define('_msg_backup6','Your Tables Were Backed Up Successfully');

define('_msg_import','The was an error importing your tables');
define('_msg_import2','Your 1.0 Tables Were Imported Successfully');
define('_msg_error_bind','Problem Binding');
define('_msg_error_check','Problem Checking');
define('_msg_error_store','Problem Storing');

define('_msg_csv','Export to CSV');
define('_msg_csv_album','By Album');
define('_msg_csv_sale','By Sale');

define('_msg_RM','RM Number');
define('_msg_UPC','UPC');

define('_msg_newsletter','Newsletter System Not Installed');
define('_msg_return_to','Return To Previous Page');

define('_msg_append','Append URL');
define('_msg_label','Label');
define('_msg_javascript47','If your previews are inside your websites root folder you can append the url for the flash players.');
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
define('_msg_cart_zip','Download Cart');
?>
