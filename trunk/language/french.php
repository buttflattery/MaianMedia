<?php

/*------------------------------------------
  MAIAN MUSIC v1.2
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

define( '_msg_charset','utf-8');

$_msg_author = 'Damien Hirlimann';
$_msg_website  = 'http://www.anatalprostudio.com';

/*--------------------------------------
  INC/HEADER.PHP
  -------------------------------------*/
  
define( '_msg_public_header','Notre site de vente de musique t&eacute;l&eacute;chargeables @ {website}');  
define( '_msg_public_header2','Dans le panier');
define( '_msg_public_header3','Les plus populaires');
define( '_msg_public_header4','Musique');
define( '_msg_public_header5','Contact');
define( '_msg_public_header6','A propos');
define( '_msg_public_header7','Recherche');
define( '_msg_public_header8','Mots clefs');
define( '_msg_public_header9','Lecteur Flash Premium Beat');
define( '_msg_public_header10','Ce syst&egrave;me utilise le<br />lecteur Flash Premium Beat<br /><b>&copy); Premium Beat.com</b>');
define( '_msg_public_header11','Morceaux dans le panier');
define( '_msg_public_header12','Licence');
define( '_msg_public_header13','Morceaux MP3 &agrave; t&eacute;l&eacute;charger depuis votre site de vente.');
define( '_msg_public_header14','mp3,t&eacute;l&eacute;chargements,albums,morceaux,musique,vente de musique');
define( '_msg_public_header15','Texte le plus populaire');



/*--------------------------------------
  TEMPLATES/ALBUM.TPL.PHP
  -------------------------------------*/
  
define( '_msg_publicalbum','Ecouter/ Acheter des morceaux');  
define( '_msg_publicalbum2','Merci d\'utiliser les boutons pr&eacute;vus pour &eacute;couter ou acheter un morceau. Vous pouvez ajouter autant de morceaux que vous le souhaitez. Merci.');
define( '_msg_publicalbum3','Ecouter');
define( '_msg_publicalbum4','Ajouter au panier');
define( '_msg_publicalbum5','Nom du morceau');
define( '_msg_publicalbum6','Prix');
define( '_msg_publicalbum7','Ajouter au panier');
define( '_msg_publicalbum8','Ajouter tous les morceaux au panier');
define( '_msg_publicalbum9','Ajouter les morceaux selectionn&eacute;s au panier');
define( '_msg_publicalbum10','Ecouter les morceaux');
define( '_msg_publicalbum11','Morceau');
define( '_msg_publicalbum12','Cette page a &eacute;t&eacute; vue <b>{count}</b> fois.');
define( '_msg_publicalbum13','Sauvegarder <b>{amount}</b> %');
define( '_msg_publicalbum14','Albums similaires');


/*--------------------------------------
  TEMPLATES/CART.TPL.PHP
  -------------------------------------*/
  
define( '_msg_cart','Panier');
define( '_msg_cart2','Les morceaux de votre panier sont affich&eacute;s ci-dessous. Utilisez les boutons pr&eacute;vus &agrave; cet effet pour supprimer n\'importe quel morceau. Quand votre selection vous convient, cliquez sur Payer pour finaliser votre commande:');  
define( '_msg_cart3','Il n\'y a actuellement aucun morceau dans votre panier.');
define( '_msg_cart4','{count} morceaux dans votre panier');
define( '_msg_cart5','Total');
define( '_msg_cart6','Vider le panier');
define( '_msg_cart7','Payer');
define( '_msg_cart8','De:');
define( '_msg_cart9','Vous economisez {discount}%');


/*--------------------------------------
  TEMPLATES/CONTACT.TPL.PHP
  -------------------------------------*/

define( '_msg_contact','<div id="mm_contact">Si vous rencontrez un probl&egrave;me, ou que vous souhaitez nous poser n\'importe quelle question sur notre musique, merci de remplir le formulaire ci-dessous:</div>');
define( '_msg_contact2','Nous contacter');
define('_msg_contact3','Sujet');
define('_msg_contact4','Commentaires');
define('_msg_contact5','Envoyer le message');
define('_msg_contact6','Merci d\'ajouter un sujet...');
define('_msg_contact7','Merci d\'ajouter des commentaires...');
define('_msg_contact8','Votre message a &eacute;t&eacute; envoy&eacute;.<br /><br />Une r&eacute;ponse vous sera donn&eacute;e d&egrave;s que possible.');
define('_msg_contact9','Name');
define('_msg_contact10','Adresse E-Mail');
define('_msg_contact11','Entrez le Code');
define('_msg_contact12','Code invalide, merci d\'essayer de nouveau..');
define('_msg_contact13','Merci!');
define('_msg_contact14','Message envoy&eacute;!');
define('_msg_contact15','Merci de mettre votre nom...');
define('_msg_contact16','Merci de mettre une adresse e-mail valide...');
define('_msg_contact17','Cliquez sur Captcha pour le rafraichir');


/*--------------------------------------
  TEMPLATES/CONTACT.TPL.PHP
  -------------------------------------*/
  
define('_msg_publichome','Merci de l\'inter&ecirc;t que vous portez &agrave; notre musique. Utilisez le lien sur la gauche du menu pour naviguer &agrave; travers notre collection d\'albums. Vous pouvez acheter un seul morceau ou tout un album en utilisant les boutons pr&eacute;vus &agrave; cet effet. Vous pouvez &eacute;galement &eacute;couter un extrait des morceaux au format MP3 avant de les acheter.<br /><br />Tous les paiements sont s&eacute;curis&eacute;s et se font via paypal sans que vous n\'ayez besoin d\'avoir un compte.<br /><br />Merci de me contacter pour toutes questions, merci!');  
define('_msg_publichome2','La majorit&eacute; des cartes de cr&eacute;dit est accept&eacute;e sur Paypal');
define('_msg_publichome3','Morceaux les plus populaires');
define('_msg_publichome4','Albums les plus populaires');


/*--------------------------------------
  TEMPLATES/DOWNLOAD_ITEM.TPL.PHP
  -------------------------------------*/


define('_msg_downloaditem','<br /><br /><span class="sorry">D&eacute;sol&eacute;!</span><br /><br /><span class="sorry_msg">Ce lien de t&eacute;l&eacute;chargement a expir&eacute;!</span><br /><br /><br />Merci d\'utiliser l\'option contact<br />pour pouvoir les recharger.');  
define('_msg_downloaditem2','<br /><br /><span class="sorry">Erreur!</span><br /><br /><span class="sorry_msg">Vous n\'avez pas les autorisations <br>pour visualiser cette page!</span><br /><br /><br />Merci d\'utiliser l\'option contact<br />si vous pensez que c\'est incorrecte.');  


/*--------------------------------------
  TEMPLATES/MUSIC.TPL.PHP
  -------------------------------------*/

define('_msg_music','Merci de cliquer sur les liens pour avoir plus d\'informations sur un album et pour &eacute;couter/acheter les morceaux. Merci.');
define('_msg_music2','Plus d\'information');
define('_msg_music3','Morceaux: {count}');


/*--------------------------------------
  TEMPLATES/PAYPAL/CANCEL.TPL.PHP
  TEMPLATES/PAYPAL/CHECKOUT.TPL.PHP
  TEMPLATES/PAYPAL/DOWNLOAD.TPL.PHP
  TEMPLATES/PAYPAL/ERROR.TPL.PHP
  TEMPLATES/PAYPAL/THANKS.TPL.PHP
  -------------------------------------*/
  
define('_msg_paypal','En connexion avec les serveurs de Paypal.....Merci de patienter....');  
define('_msg_paypal2','Achats sur le site de Musique');
define('_msg_paypal3','Transaction annul&eacute;e!');
define('_msg_paypal4','Votre transaction a &eacute;t&eacute; successivement annul&eacute;e et aucun paiement n\'a &eacute;t&eacute; envoy&eacute;.<br /><br />Merci de votre inter&eacute;t pour notre musique.');
define('_msg_paypal5','Transaction invalide!');
define('_msg_paypal6','La transaction apparait comme invalide puisque le montant pay&eacute; ne correspond pas au montant du panier.<br /><br />Le webmaster a &eacute;t&eacute; inform&eacute; de cette tentative et pourra prendre une d&eacute;cision ult&eacute;rieurement.<br /><br />Si vous pensez que c\'est une erreur, merci de nous contacter en utilisant le lien du menu de gauche.<br /><br />Merci.');
define('_msg_paypal7','Merci!');
define('_msg_paypal8','Votre transaction s\'est d&eacute;roul&eacute;e avec succ&egrave;s.<br /><br />Merci de v&eacute;rifier votre boite mail : "<b>{email}</b>". Ce message contient un lien de t&eacute;l&eacute;chargement des morceaux que vous avez achet&eacute;. En cliquant sur ce lien, vous serez redirig&eacute; vers la page de t&eacute;l&eacute;chargement. Si vous ne recevez pas ce mail, merci de nous contacter en utilisant le lien du menu de gauche.<br /><br />Nous esp&eacute;rons que vous appr&eacute;cierez notre musique,<br /><br /><b>{store}</b>');
define('_msg_paypal9','Une erreur s\'est produite!');
define('_msg_paypal10','Nous n\'avez pas la permission de voir cette page, d&eacute;sol&eacute;.');  
define('_msg_paypal11','Aucune information d\'achat n\'a &eacute;t&eacute; trouv&eacute;. Merci de v&eacute;rifier de nouveau le lien fournit dans l\'email re&ccedil;u.<br/><br />Si vous pensez qu\'une erreur s\'est produite, merci de nous contacter en utilisant le lien du menu de gauche.<<br /><br />Merci.');                            
define('_msg_paypal12','La page de t&eacute;l&eacute;chargement a expir&eacute;e!');
define('_msg_paypal13','Ce lien est maintenant expir&eacute; et ne peut plus &ecirc;tre atteint. Notre syt&egrave;me restreint automatiquement le nombre de fois que la page de t&eacute;l&eacute;chargement peut &ecirc;tre atteinte pour des raisons de s&eacute;curit&eacute;.<br /><br />Si vous souhaitez acceder de nouveau &agrave; cette page, merci de nous contacter en utilisant le lien pr&eacute;vu dans le menu de gauche afin que nous reinitialisions le lien.<br /><br />D&eacute;sol&eacute; pour ce d&eacute;sagr&eacute;ment,<br /><br /><b>{store}</b>');
define('_msg_paypal14','Pages de t&eacute;l&eacute;chargement');
define('_msg_paypal15','Merci pour vos achats, vos t&eacute;l&eacute;chargements sont affich&eacute;s ci-dessous.<br /><br />Merci de <b>NE PAS</b>rafraichir ou sauvegarder cette page comme signet puisqu\'elle risque d\'expirer ou a d&eacute;j&agrave; expir&eacute;.<br /><br />Vous avez le droit de t&eacute;l&eacute;charger chaque morceau {duration}. Si vous rencontrez le moindre probl&egrave;me, merci de nous contacter en utilisant le lien du menu de gauche.');                              
define('_msg_paypal16','une fois');
define('_msg_paypal17','deux fois');
define('_msg_paypal18','plusieurs fois');
define('_msg_paypal19','Albums achet&eacute;s');
define('_msg_paypal20','Morceaux achet&eacute;s');
define('_msg_paypal21','Aucune trace de l\'achat d\'un album n\'a &eacute;t&eacute; trouv&eacute;');
define('_msg_paypal22','Aucune trace de l\'achat d\'un morceau n\'a &eacute;t&eacute; trouv&eacute;');
define('_msg_paypal23','En esp&eacute;rant que vous appreciez nos nouveaux morceaux!');
define('_msg_paypal24','T&eacute;l&eacute;charger le morceau');
define('_msg_paypal25','T&eacute;l&eacute;charger la pochette');
define('_msg_paypal26','T&eacute;l&eacute;charger les morceaux');
define('_msg_paypal27','Le fichier n\'existe pas!');
define('_msg_paypal28','Tous les morceaux =');
define('_msg_paypal29','Cliquez sur le(s) boutons(s) pour t&eacute;l&eacute;charger le(s) morceau(x)!');
define('_msg_paypal30','Retour &agrave; la page pr&eacute;c&eacute;dente');
define('_msg_paypal31','Le t&eacute;l&eacute;chargement a expir&eacute;');


/*--------------------------------------
  TEMPLATES/SEARCH.TPL.PHP
  -------------------------------------*/

define('_msg_publicsearch','R&eacute;sultats de la recherche');
define('_msg_publicsearch2','Votre r&eacute;sultat de recherche pour "<b>{keywords}</b>" sont affich&eacute;s ci-dessous. Si votre recherche n\'a g&eacute;n&eacute;r&eacute;e aucun r&eacute;sultat, essayez avec des mots clefs multiples s&eacute;par&eacute;s par un espace pour une recherche plus d&eacute;taill&eacute;e.');
define('_msg_publicsearch3','<br /><b>Aucun r&eacute;sultat...Merci d\'essayer de nouveau...</b>');
define('_msg_publicsearch4','{count} r&eacute;sultats de la recherche');


/*--------------------------------------
  ADMIN/INC/HEADER.PHP
  -------------------------------------*/

define('_msg_header','Administration');
define('_msg_header2','A propos');  
define('_msg_header3','Configuration');  
define('_msg_header4','G&eacute;rer les Albums');  
define('_msg_header5','Ajouter des nouvelles pistes');  
define('_msg_header6','G&eacute;rer les pistes');  
define('_msg_header7','Ventes');  
define('_msg_header8','Rechercher dans les ventes'); 
define('_msg_header9','Menu de navigation');
define('_msg_header10','Categories'); 
define('_msg_header11','Statistics');
  
  
/*--------------------------------------
  ADMIN/INC/FOOTER.PHP
  TEMPLATES/FOOTER.TPL.PHP
  -------------------------------------*/

define('_msg_footer','Copyright');
define('_msg_footer2','Tous droits r&eacute;serv&eacute;s');  
define('_msg_footer3','Merci d\'activer le javascript de votre navigateur. Merci !');


/*--------------------------------------
  ADMIN/DATA_FILES/ADD.PHP
  -------------------------------------*/
  
define('_msg_add','Ici vous ajoutez vos morceaux MP3/MP4. Avant de les ajouter, bien v&eacute;rifier que la version compl&eacute;te et la version d\'&eacute;coute sont uploa&eacute;es dans les dossiers specifi&eacute;s de votre configuration. Utilisez le menu d&eacute;roulant pour choisir le nombre de pistes que vous souhaitez ajouter puis remplissez les informations pour chacun des morceaux. Utilisez le lien d\'aide si vous n\'&ecirc;tes pas sur.<br><br><i>Notez que si vous oubliez le nom du morceau, le chemin d\'acc&egrave;s ou le prix, le morceau ne sera pas ajout&eacute;.</i>');  
define('_msg_add2','Morceaux &agrave; ajouter');
define('_msg_add3','Combien de morceaux souhaitez-vous ajouter ? Vous pouvez rafraichir cela &agrave; n\'importe quel moment et rien ne sera perdu.');
define('_msg_add4','Morceau');
define('_msg_add5','Ajouter des morceaux');
define('_msg_add6','Nom du morceau');
define('_msg_add7','Ajouter &agrave; l\'album');
define('_msg_add8','chemin des fichiers MP3');
define('_msg_add9','Chemin d\'extraits');
define('_msg_add10','Dur&eacute;e du morceau');
define('_msg_add11','Prix');
define('_msg_add12','Achat unique');
define('_msg_add13','<b>{count}</b> morceau(x) ajout&eacute;(s) successivement. Vous pouvez g&eacute;rer vos morceaux ci-dessous..');
define('_msg_add14','Affichage');
define('_msg_add15','Pour tous les morceaux.');


/*--------------------------------------
  ADMIN/DATA_FILES/ALBUMS.PHP
  -------------------------------------*/
  
define('_msg_albums','Les fichiers MP3 sont regroup&eacute;s en albums. Quand vous ajoutez un morceau, vous aurez besoin de sp&eacute;cifier l\'album dans lequel vous souhaitez le mettre. Le visiteurs peuvent acheter un seul morceau ou un album entier. Une fois ajout&eacute;, l\'album apparaitra plus bas.');  
define('_msg_albums2','Album');
define('_msg_albums3','Nom de l\'album');
define('_msg_albums4','Albums actuels -- Cliquer sur le nom pour l\&eacute;diter');
define('_msg_albums5','URL de l\'image de l\'album');
define('_msg_albums20','Albums');
define('_msg_albums6','Illustrations de l\'album (fichier Zip)');
define('_msg_albums7','Commentaires/Info');
define('_msg_albums8','Activer l\'album');
define('_msg_albums9','Il n\'y a actuellement aucun album dans votre base.');
define('_msg_albums10','Mettre &agrave; jour l\'album');
define('_msg_albums11','Artiste');
define('_msg_albums12','mots clefs');
define('_msg_albums13','T&eacute;l&eacute;chargement');
define('_msg_albums14','Mise &agrave; z&eacute;ro du t&eacute;l&eacute;chargement des morceaux');
define('_msg_albums15','Hits');
define('_msg_albums16','Cat&eacute;gorie');
define('_msg_albums17','Meilleures ventes');
define('_msg_albums18','Sans cat&eacute;gorie');
define('_msg_albums19','Remise sur les achats d\'albums');

/*--------------------------------------
  ADMIN/DATA_FILES/HOME.PHP
  -------------------------------------*/
  
define('_msg_home','Bienvenue sur Maian Music pour Joomla, un magasin de vente de musique simple qui permet la lecture et la vente de vos propres musiques au format MP3/MP4. ce script a &eacute;t&eacute; &eacute;crit &agrave; l\'origine par <a href="http://www.maianscriptworld.co.uk" title="Maian Script World" target="_blank">Maian Script World</a> et a maintenant &eacute;t&eacute; converti pour JOOMLA par <a href="http://www.aretimes.com" title="Are Times" target="_blank">Are Times</a>. Pur utiliser ce syst&egrave;me, vous devez avoir un compte business paypal. Il est recommand&eacute; d\'activer le retour automatique dans vos options paypal .......(chemin d\'acces &agrave; l\'option paypal)......... pour une meilleure ergonomie de fonctionnement. Quand vous configurez ce composant, veuillez utiliser les[<b><span style="color:#FF7700">?</span></b>] bulles d\'aides pour plus d\'infos.<br><br>Si vous avez le moindre soucis, merci de poster vos probl&egrave;mes sur le <a href="http://www.aretimes.com" title="Support Forums" target="_blank"> forum</a>.<br><br>Merci de me contacter via le site web si vous avez des commentaires &agrave; faire ou si vous trouvez des erreurs.<br><br>J\'esp&egrave;re que vous appr&eacute;ciez notre syst&egrave;me de vente de musique,<br><br>Alao.<br><br><b>Are Times</b><br><a href="http://www.aretimes.com" title="Are Times" target="_blank">http://www.aretimes.com</a>');
define('_msg_dedicate','<br><br>D&eacute;di&eacute; &agrave; <a href="http://www.lpierce927.com" title="Looch" target="_blank">Lamar Anthony Pierce</a> A.K.A <a href="http://www.myspace.com/thereallooch" title="Looch" target="_blank">Looch</a>');
define('_msg_home2','Faire un don');                                
define('_msg_home3','Si vous aimez ce script et que vous souhaitez nous t&eacute;moigner des encouragements, merci de penser &agrave; soit faire un don soit acheter de la musique sur Are Times');
define('_msg_home4','Les dons ne sont pas obligatoires, mais tr&egrave;s appr&eacute;ci&eacute;. Merci!');
define('_msg_home5','Survol du site de vente de musique en ligne');
define('_msg_home6','Vous avez actuellement <b>{tracks}</b> morceaux, regroup&eacute; dans <b>{albums}</b> albums.<br><br>
                              Frais Paypal : <b>{fees}</b><br>
                              Profit: <b>{profit}</b><br><br>
                              <b>Pour le moment, {a_purchases}</b> albums et <b>{t_purchases}</b> morceaux ont &eacute;t&eacute; achet&eacute;.');
                         
                              
/*--------------------------------------
  ADMIN/DATA_FILES/LOGIN.PHP
  -------------------------------------*/   
  
define('_msg_login','Login Administrateur');                             
define('_msg_login2','Merci de vous connecter &agrave; l\'interface administrateur ci-dessous:');
define('_msg_login3','Nom d\'utilisateur');
define('_msg_login4','Mot de passe');
define('_msg_login5','Login');
define('_msg_login6','Invalide');
define('_msg_login7','Se souvenir de moi');


/*--------------------------------------
  ADMIN/DATA_FILES/SALES.PHP
  -------------------------------------*/
  
define('_msg_sales','Vos processus de vente sont montr&eacute;s ci-dessous. Utilisez les commandes par option si n&eacute;cessaire. Utilisez les liens fournis pour g&eacute;rer les commandes ou les demandes de contact des acheteurs. Si vous avez besoin de localiser une entr&eacute;e specifique, utiliser l\'option de recherche du menu.');  
define('_msg_sales2','Montrer');
define('_msg_sales3','Par Page');
define('_msg_sales4','Nouvelles ventes');
define('_msg_sales5','Anciennes ventes');
define('_msg_sales6','Morceaux achet&eacute;s');
define('_msg_sales7','Albums achet&eacute;');
define('_msg_sales8','Meilleure vente');
define('_msg_sales9','Moins bonne vente');
define('_msg_sales10','Nom des acheteurs de A-Z');
define('_msg_sales11','Nom des acheteurs de Z-A');
define('_msg_sales12','Visualiser {count} ventes');
define('_msg_sales13','Il y a actuellement <b>0</b> ventes dans la base de donn&eacute;es.');
define('_msg_sales14','Supprimer les ventes selectionn&eacute;es');
define('_msg_sales15','Albums achet&eacute;s');
define('_msg_sales16','Morceaux achet&eacute;s');
define('_msg_sales17','<b>0</b> albums achet&eacute;s.');
define('_msg_sales18','<b>0</b> morceaux achet&eacute;s.');
define('_msg_sales19','par');
define('_msg_sales20','Albums');
define('_msg_sales21','Morceaux');
define('_msg_sales22','Voir les informations de vente');
define('_msg_sales23','Contacter l\'acheteur');
define('_msg_sales24','Sujet');
define('_msg_sales25','Commentaires');
define('_msg_sales26','ou si vous avez l\'email d\'un client cliquez <a href="mailto:{email}" title="Cliquez pour envoyer un mail au client"><b><u>ici</u></b></a>.');
define('_msg_sales27','Message envoy&eacute;!');
define('_msg_sales28','Envoyer le message');
define('_msg_sales29','Remise &agrave; z&eacute;ro des t&eacute;l&eacute;chargements &amp; renvoi de l\'email de t&eacute;l&eacute;chargement');
define('_msg_sales30','Informations Acheteur/Paypal');
define('_msg_sales31','E-Mail envoy&eacute; &agrave; l\'acheteur!');
define('_msg_sales32','Cliquez pour visualiser');
define('_msg_sales33','Acheteur');
define('_msg_sales34','E-Mail');
define('_msg_sales35','Date');
define('_msg_sales36','Adresse');
define('_msg_sales37','memo de l\'acheteur');
define('_msg_sales38','Status du paiement');
define('_msg_sales39','Gross/Fee/Total');
define('_msg_sales40','ID de transaction Paypal');
define('_msg_sales41','Clients');
define('_msg_sales42','Information');
define('_msg_sales43','Supprimer');
define('_msg_sales44','ID de transaction Paypal');
define('_msg_sales45','Facture No');

/*--------------------------------------
  ADMIN/DATA_FILES/SEARCH.PHP
  -------------------------------------*/
  
define('_msg_search','Cette fonction vous permet de faire des recherches dans vos ventes. utile si vous avez beaucoup d\'entr&eacute;es et que vous souhaitez en localiser une. Merci de sp&eacute;cifier vos crit&egrave;res de recherche ci-dessous. Vous pouvez entrer un ou plusieurs crit&egrave;res, mais vous devez inclure au moins une option de recherche:');
define('_msg_search2','Entrer vos crit&egrave;res de recherche');
define('_msg_search3','Where \'name\' like');
define('_msg_search4','Where \'e-mail\' like');
define('_msg_search5','Where \'invoice no\' =');
define('_msg_search6','Where \'trans id\' =');
define('_msg_search7','Where \'date\' between');
define('_msg_search8','Rechercher');
define('_msg_search9','Pas de r&eacute;sultat...Merci d\'essayer avec d\'autres crit&egrave;res...');
define('_msg_search10','R&eacute;sultats de la recherche');
define('_msg_search11','Votre r&eacute;sultat de recherche est affich&eacute;ci-dessous');
define('_msg_search12','Nouvelle recherche');


/*--------------------------------------
  ADMIN/DATA_FILES/SETTINGS.PHP
  -------------------------------------*/
  
define('_msg_settings','Mise &agrave; jour de votre configuration ci-dessous. Tous les champs doivent &ecirc;tre remplis &agrave; moins qu\'indiqu&eacute;s comme optionnels.');  
define('_msg_settings2','configuration du site / g&eacute;n&eacute;ral');
define('_msg_settings3','Nom du magasin de vente de musique en ligne');
define('_msg_settings4','Adresse E-Mail');
define('_msg_settings5','URL de la page d\'accueil');
define('_msg_settings6','La voie vers le dossier d\'installation');
define('_msg_settings7','Langage');
define('_msg_settings8','Activer Captcha');
define('_msg_settings9','configuration MP3/T&eacute;l&eacute;chargement');
define('_msg_settings10','Chemin d\'acc&egrave;s au dossier MP3');
define('_msg_settings11','Chemin d\'acc&egrave;s au dossier de previsualisation MP3');
define('_msg_settings12','Configuration des mises &agrave; jour');
define('_msg_settings13','URLs du moteur de recherche');
define('_msg_settings14','Configuration Paypal');
define('_msg_settings15','Activer Paypal IPN');
define('_msg_settings16','Activer Sandbox');
define('_msg_settings17','Live');
define('_msg_settings18','Erreurs Log');
define('_msg_settings19','Style des pages');
define('_msg_settings20','Adresse email paypal');
define('_msg_settings21','Devise');
define('_msg_settings22','');
define('_msg_settings23','Texte des Page(s)');
define('_msg_settings24','<a href="http://en.wikipedia.org/wiki/HTML" title="Hypertext Markup Language" target="_blank">HTML</a> est autoris&eacute;');
define('_msg_settings25','expiration de la page de t&eacute;l&eacute;chargement');
define('_msg_settings26','Total des Albums pour flux RSS');
define('_msg_settings27','Total des liens populaires');
define('_msg_settings28','Activer SSL');
define('_msg_settings29','Port SMTP');
define('_msg_settings30','Remise &agrave; z&eacute;ro des vues de tous les albums');
define('_msg_settings31','Expiration des &eacute;l&eacute;ments &agrave; t&eacute;l&eacute;charger');
define('_msg_settings32','Texte de la page Licence');
define('_msg_settings33','Configuration SMTP');
define('_msg_settings34','Activer SMTP');
define('_msg_settings35','Serveur SMTP');
define('_msg_settings36','Utilisateur SMTP');
define('_msg_settings37','Mot de passe SMTP');
define('_msg_settings38','configuration du lecteur MP3');
define('_msg_settings39','Lecteur');
define('_msg_settings40','Donn&eacute;es de paiements &agrave; transferer');
define('_msg_settings41','Page par d&eacute;faut');
define('_msg_settings42','Les plus populaires');
define('_msg_settings43','Musique');
define('_msg_settings44','Texte de la page Musique');

/*--------------------------------------
  ADMIN/DATA_FILES/STATISTICS.PHP
  -------------------------------------*/

define('_msg_statistics','cette page vous permet de voir rapidement combien de fois chaque piste et chaque album a &eacute;t&eacute; achet&eacute;. Cliquez sur le bouton pour faire apparaitre les informations d\'un album et les statistiques de ces morceaux.');
define('_msg_statistics2','Class&eacute;s par');
define('_msg_statistics3','Meilleures vues');
define('_msg_statistics4','Moins bonnes vues');
define('_msg_statistics5','Album');
define('_msg_statistics6','Single');
define('_msg_statistics7','<li>Vues: <b>{hits}</b> </li> <li>Album(s) achet&eacute;(s): <b>{albums}</b> </li> <li> Morceau(s) achet&eacute;(s): <b>{tracks}</b></li>');
define('_msg_statistics8','Voir les statistiques des morceaux');
define('_msg_statistics9','Ceci affiche une liste de chaque morceau de cet album et le nombre total d\'achat pour chaque piste.');
define('_msg_statistics10','Tout faire apparaitre');
define('_msg_statistics11','Tout faire disparaitre');


/*--------------------------------------
  ADMIN/DATA_FILES/TRACKS.PHP
  -------------------------------------*/
  
define('_msg_tracks','Cette page vous permet de g&eacute;rer vos morceaux. Selectionnez un album ci-dessous pour voir les morceaux qui le compose et utilisez les boutons d&eacute;di&eacute;s pour mettre &agrave; jour les morceaux.');  
define('_msg_tracks2','<b>{count}</b> morceaux');
define('_msg_tracks3','Voir les morceaux');
define('_msg_tracks4','No du Morceau');


/*--------------------------------------
  ADMIN/DATA_FILES/VIEW_TRACKS.PHP
  -------------------------------------*/
  
define('_msg_viewtracks','Mettre &agrave; jour les morceaux');  
define('_msg_viewtracks2','Cliquez sur le lien pour &eacute;diter une piste. Vous pouvez mettre &agrave; jour ou supprimer n\'importe quel morceau mais &eacute;galement changer l\'ordre d\'apparition des morceaux.');
define('_msg_viewtracks3','Mettre &agrave; jour ce morceau');
define('_msg_viewtracks4','D&eacute;plcer vers le haut');
define('_msg_viewtracks5','D&eacute;placer vers le bas');
define('_msg_viewtracks6','Cet album n\'a actuellement aucun morceau');
define('_msg_viewtracks7','Annuler');
define('_msg_viewtracks8','Morceau mis &agrave; jour!');
define('_msg_viewtracks9','Rafraichir');


/*---------------------
  RESPONSE DATA FOR IPN
  PAYPAL E-MAILS
----------------------*/

define('_msg_ipn','Commande Invalide');
define('_msg_ipn2','Erreur Paypal IPN!!');
define('_msg_ipn3','Si activ&eacute;e, cette erreur a &eacute;t&eacute; ajout&eacute;e au fichier de log.');
define('_msg_ipn4','L\'entr&eacute;e suivante a &eacute;t&eacute; re&ccedil;ue de (et renvoy&eacute;e &agrave;) PayPal:');
define('_msg_ipn5','Paiement &eacute;chou&eacute;');
define('_msg_ipn6','Paiement refus&eacute;');
define('_msg_ipn7','Status de paiement inconnu');
define('_msg_ipn8','Achat sur le site en attente!');
define('_msg_ipn9','Transaction d\'achat invalide!');
define('_msg_ipn10','Information du site de vente de musique en ligne!');
define('_msg_ipn11','Transaction du site de vente de musique en ligne!');


/*-------------------------------------
  GENERAL VARIABLES
  ------------------------------------*/

define('_msg_script','Maian Music');
define('_msg_script2','Oui');
define('_msg_script3','Non');
define('_msg_script4','Optionel');
define('_msg_script5','Premier');
define('_msg_script6','Dernier');
define('_msg_script7','Editer');
define('_msg_script8','Supprimer');
define('_msg_script9','Annuler');
define('_msg_script10','Rafraichir');
define('_msg_script11','Imprimer');
define('_msg_script12','Illimit&eacute;');


/*-----------------------------
  RSS Feeds
-------------------------------*/

define('_msg_rss','Derniers albums @ {website_name}');
define('_msg_rss2','Ces albums ont &eacute;t&eacute; les derniers &agrave; avoir &eacute;t&eacute; ajout&eacute;s au site {website_name}');
define('_msg_rss3','Album:');


/*----------------------
  ADMIN/INC/CALENDAR.PHP
-----------------------*/

define('_msg_calendar','Janvier');
define('_msg_calendar2','Fevrier');
define('_msg_calendar3','Mars');
define('_msg_calendar4','Avril');
define('_msg_calendar5','Mai');
define('_msg_calendar6','Juin');
define('_msg_calendar7','Juillet');
define('_msg_calendar8','Aout');
define('_msg_calendar9','Septembre');
define('_msg_calendar10','Octobre');
define('_msg_calendar11','Novembre');
define('_msg_calendar12','D&eacute;cembre');


/*--------------------------------------------------------------------------------------------------
  ZIP FILE FOLDER NAMES
  These are the names of the folders that are created inside the zip file when someone downloads 
  an album or track. These should NOT contain any illegal characters that may prevent the creation 
  of the folder. If you are unsure, leave them as they are
  --------------------------------------------------------------------------------------------------*/
  
define('_msg_folder','morceau');
define('_msg_folder2','album');
  

/*-----------------------------------------------------------------------------------------------------
  JAVASCRIPT VARIABLES
  IMPORTANT: If you want to use apostrophes in these variables, you MUST escape them with 3 backslashes
             Failure to do this will result in the script malfunctioning on javascript code. Unless you
             specifically need them, using double quotes is recommended.
  EXAMPLE: d\\\'apostrophe
------------------------------------------------------------------------------------------------------*/

define('_msg_javascript','Aide/Information');
define('_msg_javascript2','Adresse compl&egrave;te vers le dossier contenant les fichiers. Pas de slash en fin d\'adresse.<br><br><b>http://www.votresite.com/music</b>');
define('_msg_javascript3','Un captcha  peut aider &agrave; supprimer les spams venant via vos options de contact. La <b>librairie GD avec support Freetype</b> est n&eacute;cessaire et doit &ecirc;tre install&eacute;e sur votre serveur afin que cette option fonctionne. Voir la docu pour plus d\'informations.');
define('_msg_javascript4','Les fichiers MP3 devraient toujours &ecirc;tre sauvegard&eacute;s &agrave; l\'ext&eacute;rieur de votre dossier de d&eacute;part. Ceci est le chemin relatif entre le dossier de musique et le dossier MP3. PAS de "slash" &agrave; la fin de l\'adresse.<br><br><b>/home/user/mp3</b>. Vous aider de la fonction phpinfos()');
define('_msg_javascript5','Pareil qu\'au dessus, mais ceci est le chemin d\'acc&egrave;s aux extraits MP3. Ils peuvent &ecirc;tre &agrave; l\'int&eacute;rieur ou &agrave; l\'ext&eacute;rieur du dossier MP3. PAS de "slash" &agrave; la fin de l\'adresse.<br><br><b>../mp3/mp3_extraits or /mp3_extraits</b>');
define('_msg_javascript6','Active le mode mod_rewrite  pour  urls des moteurs de recherche. Pour que cela fonctionne, votre serveur doit supporter le <b>.htaccess</b> Une fois activ&eacute;e, renommer le fichier <b>htaccess_COPY.txt</b> en <b>.htaccess</b><br><br>Une erreur serveur peut appara&icirc;tre si activ&eacute;e et que le <b>.htaccess</b> n\'est pas support&eacute;.');
define('_msg_javascript7','Paypal vous permet de tester votre syst&egrave;me sans pour autant soumettre un paiement v&eacute;ritable. C\'est le mode <b>sandbox</b>. Plus de d&eacute;tails peuvent &ecirc;tre trouv&eacute; &agrave; l\'adresse <a href="https://developer.paypal.com" title="Sandbox" target="_blank">suivante</a>.<br><br>Cochez cette fonction pour activer le mode sandbox.  D&eacute;cocher pour un processus de paiement v&eacute;ritable.');
define('_msg_javascript8','Ceci est votre adresse email du compte paypal business ou premier.');
define('_msg_javascript9','Paypal vous permet de cr&eacute;er un style de page personnel dans votre environnement Paypal. Si vous en avez une, sp&eacute;cifiez son nom ici. Sinon laisser vider.');
define('_msg_javascript10','Si une r&eacute;ponse invalide est renvoy&eacute;e par paypal, vous pouvez logger l\'erreur. C\'est utile pour d&eacute;buguer et je vous recommande de laisser cette option activ&eacute;e lors des phases de test.');
define('_msg_javascript11','Sp&eacute;cifiez la monnaie du processus de paiement. La liste montre celles support&eacute;es par paypal lorsque le script a &eacute;t&eacute; &eacute;crit.');
define('_msg_javascript12','Si vous avez une image de que vous souhaitez afficher pour pr&eacute;senter un album, sp&eacute;cifiez l\'url compl&egrave;te commen&ccedil;ant par http://<br><br>Notez que les images sont affich&eacute;es &agrave; la taille maximale par d&eacute;faut et qu\'elles devraient &ecirc;tre de <b>65</b>x<b>65</b> pixels.<br><br><i>(Optionnel)</i>');
define('_msg_javascript13','Si un visiteur ach&egrave;te un album entier et que vous souhaitez en plus qu\'il puisse t&eacute;l&eacute;charger la couveture, mettez le fichier dans une archive .zip, le t&eacute;l&eacute;charger  et sp&eacute;ficiez le chemin d\'acc&egrave;s ici commen&ccedil;ant par http://<br><br>Si quelqu\'un ach&egrave;te un album entier, ce lien sera &eacute;galement inclus avec le lien de t&eacute;l&eacute;chargement des mp3s.<br><br><i>(Optionnel)</i>');
define('_msg_javascript14','Modifiez le status de cet album. Si d&eacute;sactiv&eacute;, il n\'est pas visible par les visiteurs.');
define('_msg_javascript15','&Ecirc;tes-vous sur ?\n\n Cela supprimera &eacute;galement le fichier mp3 attach&eacute; &agrave; cet album.\n\nNotez que les fichiers doivent &ecirc;tre supprim&eacute;s manuellement.');
define('_msg_javascript16','Sp&eacute;cifiez le chemin d\'acc&egrave;s aux fichiers MP3 <b>SEULEMENT</b> ici &agrave; moins que vous n\'ayez plac&eacute;s les fichiers MP3 &agrave; l\int&eacute;rieur d\'un autre dossier dans votre dossier MP3 principal. Ce fichier devrait &ecirc;tre t&eacute;l&eacute;charg&eacute; dans le dossier ad&eacute;quat. Exemple :<br><br><b>fichier_musique.mp3</b><br><b>album1/fichier_musique.mp3</b>');
define('_msg_javascript17','si vous souhaitez utiliser un extrait  d\'un morceau, sp&eacute;cifiez son nom ici. Le fichier doit exister dans le dossier des extraits. Si aucun fichier ne se trouve dans le dossier, l\'extrait sera le morceau entier.<br><br>Optionnel');
define('_msg_javascript18','Sp&eacute;cifiez la dur&eacute;e du morceau. Exemples<br><br>4:32<br>4mins 32 secondes<br>4-32');
define('_msg_javascript19','Sp&eacute;cifiez le prix de vente du morceau. Aucun symbole de  monnaie ne doit &ecirc;tre indiqu&eacute;. Par exemple si vous vendez votre morceau pour 0,99 &euro; mettre <b>0.99</b>.');
define('_msg_javascript20','Est-ce que ce morceau est disponible en achat unique ? si non , le morceau ne peut &ecirc;tre achet&eacute; qu\'avec tous les morceaux de l\'album.');
define('_msg_javascript21','&Ecirc;tes-vous sur de vouloir supprimer ce morceau?');
define('_msg_javascript22','Entrez les mots clefs qui d&eacute;crivent la musique de cet album. Ils apparaissent dans les balises meta des mots clefs de la page.');
define('_msg_javascript23','Si vous souhaitez que le visiteur puisse obtenir une remise &agrave; l\'achat d\'un album entier, sp&eacute;cifier le pourcentage de remise ici. Mettre 0 pour aucune r&eacute;duction.');
define('_msg_javascript24','Lorsque quelqu\'un ach&egrave;te des morceaux, le lien vers la page de t&eacute;l&eacute;chargement lui est envoy&eacute;. Pour lui &eacute;viter d\'envoyer ce lien &agrave; d\'autres personnes, vous pouvez d&eacute;terminer combien de fois cette page peut &ecirc;tre accessible avant que le lien n\'expire. <b>Placer &agrave; 0 pour un acc&egrave;s illimit&eacute;</b>.');
define('_msg_javascript25','&Ecirc;tes-vous sur de vouloir supprimer votre panier ?');
define('_msg_javascript26','Supprimer cet &eacute;l&eacute;ment ?');
define('_msg_javascript27','Cette option vous permet de remettre les compteurs de t&eacute;l&eacute;chargement de tous les albums &agrave; z&eacute;ro. Pur chaque album, utilisez l\'option &agrave; la mise &agrave; jour de l\'album. pour chaque morceau, utilisez l\'option &agrave; la mise &agrave; jour des morceaux.');
define('_msg_javascript28','Si vous cochez cette case, toutes les pistes de cet album auront leur compteur de t&eacute;l&eacute;chargement remis &agrave; z&eacute;ro.');
define('_msg_javascript29','Si vous cochez cette case, tous les clics pour tous les albums seront remis &agrave; z&eacute;ro. Pour mettre &agrave; jour chaque album individuellement, utilisez la page de gestion des albums.');
define('_msg_javascript30','Ceci est le prix d\'achat maximum d\'un fichier en t&eacute;l&eacute;chargement. <b>Placer &agrave; 0 pour une somme infinie</b>.');
define('_msg_javascript31','Vous garde connect&eacute; pendant 30 jours. <b>NON</b> recommand&eacute;e pour les ordinateurs partag&eacute;s.<br /><br />Les cookies doivent &ecirc;tre activ&eacute;s pour permettre &agrave; cette fonction de fonctionner.');
define('_msg_javascript32','Certains hebergeurs d&eacute;sactivent la fonction Mail de php et vous obligent &agrave; utiliser SMTP pour envoyer des mails. si les mails ne fonctionnent pas essayer d\'activer cette fonction. Si vous n\'&ecirc;tes pas sur de vos d&eacute;tails SMTP, contactez votre hebergeur.');
define('_msg_javascript33','&Ecirc;tes-vous sur de vouloir supprimer ces ventes ?');
define('_msg_javascript34','&Ecirc;tes-vous sur ?');
define('_msg_javascript35','Si votre site poss&egrave;de un certificat SSL, activer SSL pour avoir le processus de retour vers votre zone s&eacute;curis&eacute;e. Ne <b>PAS</b> l\'activer si vous ne possedez pas de certificats SSL sur votre serveur.');
define('_msg_javascript36','Combien de derniers albums vus souhaitez-vous afficher dans le flux RSS ? 999 Max');
define('_msg_javascript37','Combien de liens populaires souhaitez-vous activer sur la page d\'accueil ? 999 Max');
define('_msg_javascript38','Pour obtenir votre ID TOKEN par paypal aller dans les preferences de votre compte : <br><br><b>Pr&eacute;f&eacute;rences ->Website Payment Preferences</b><br><br>Activer vos transferts de donn&eacute;es de paiement et copier et coller votre ID TOKEN fournit par Paypal');
define('_msg_javascript39','D&eacute;termine quelle page le composant se ref&egrave;re par d&eacute;faut');
/*-----------------------------------------------------------------------------------------------------

  Pre-installiation check. 

------------------------------------------------------------------------------------------------------*/

define('_setup15','Support CURL<i>(Processus Paypal)</i>');
define('_setup16','Version PHP');
define('_setup17','V&eacute;rification de la compatibilit&eacute;, si non ok, contactez votre hebergeur');
define('_setup18','Support Graphique GD <i>(Captcha)</i>');
define('_setup19','<font style="color:orange">OK</font>');
define('_setup20','<font style="color:red">Non Install&eacute;</font>');
define('_setup22','<font style="color:red">Version trop vieille</font>');

/*-----------------------------------------------------------------------------------------------------

  New 1.3 text. 

------------------------------------------------------------------------------------------------------*/
define('_msg_op_cancel','Operation annul&eacute;e');
define('_setup23','Importer tables 1.0');
define('_setup24','Credits Open Source');
define('_setup25','Personnaliser');
define('_setup26','V&eacute;rification du Syst&egrave;me');
define('_setup27','Fichiers de langue');
define('_setup28','Lecteur Flash');
define('_setup29','D&eacute;buter l\'import');
define('_setup33','D&eacute;buter la v&eacute;rification du syst&egrave;me');
define('_setup30','Resultats de la v&eacute;rification du syst&egrave;me');

define('_msg_tableh1','Titre');
define('_msg_tableh2','Publi&eacute;');
define('_msg_tableh3','Alias');
define('_msg_tableh4','Ordre');

define('_msg_categories','Cat&eacute;gories');
define('_msg_categories1','Cat&eacute;gorie');
define('_msg_categories_desc','Vous pouvez cr&eacute;er des cat&eacute;gories pour grouper vos albums. Un album peut-&ecirc;tre cr&eacute;&eacute; sans appartenir &agrave; une cat&eacute;gorie mais il n\'apparaitra pas dans la vue par cat&eacute;gorie');
define('_msg_categories2','Il n\'y a aucune cat&eacute;gorie dans la base pour le moment.');


define('_msg_discount','R&eacute;duction');

define('_msg_settings46','Garder les informations du panier');
define('_msg_settings47','Activer Ajax');
define('_msg_settings48','Inclure le champs de recherche');
define('_msg_settings49','Adresse email paypal compl&eacute;mentaire');
define('_msg_settings50','Minimum de paiement');
define('_msg_settings51','Montrer le lien de t&eacute;l&eacute;chargement apr&egrave;s achat');
define('_msg_settings52','Montrer la Navigation');
define('_msg_settings53','Utilisez Enlargeit');	

define('_msg_albums_error','Erreur : un ou plusieurs albums n\'ont pas pu &ecirc;tre supprim&eacute;s');
define('_msg_albums21','Album(s) Supprim&eacute;(s)');
define('_msg_albums22', 'Album Publi&eacute;');
define('_msg_albums23', 'Album Ajout&eacute;!');

define('_msg_tracks5','Nombre de morceaux');
define('_msg_tracks6','Fichier selectionn&eacute;: ');
define('_msg_tracks7','Taille: ');
define('_msg_tracks8','Type: ');
define('_msg_tracks9','Ajouter un sous-repertoire: ');
define('_msg_tracks10','Lien vers: ');
define('_msg_tracks11','Impossible de trouver {PATH}. Merci de modifier vos param&egrave;tres');
define('_msg_tracks12','Une erreur s\'est produite ! Impossible de t&eacute;l&eacute;charger le fichier.');
define('_msg_tracks13','Charg&eacute; avec succ&egrave;s: ');

define('_msg_upload_error1','Impossible de t&eacute;l&eacute;charger vers: ');
define('_msg_upload_error2','et je ne sais pas pourquoi.');

define('_msg_tools','Tables Maian Music');
define('_msg_tools2','<font style="color:orange">Trouv&eacute;</font>');
define('_msg_tools3','<font style="color:red">Non trouv&eacute;</font>');
define('_msg_tools4','<font style="color:red">Attention!!!! Lancer cette importation peut r&eacute;&eacute;crire toutes les donn&eacute;es que vous avez dans vos tables version 1.5</font>');

define('_msg_collapse_all','Tout faire dispara&icirc;tre');
define('_msg_expand_all','Tout faire appara&icirc;tre');

define('_msg_javascript41','ceci d&eacute;termine le nombre de jours pour garder les donn&eacute;es dans le panier. Si laiss&eacute; vide, le dur&eacute;e par d&eacute;faut sera de 14 jours. Faites attention &agrave; ne pas avoir une valeur trop &eacute;lev&eacute;e pour ne pas saturer la base de donn&eacute;es.');
define('_msg_javascript42','Si vous avez impl&eacute;ment&eacute; le micro-paiement sur votre premier compte paypal, vous pouvez entrer un second compte paypal pour maximiser vos profits.');
define('_msg_javascript43','Tous les paiements plus importants que la valeur entr&eacute;e seront g&eacute;r&eacute;es par ce compte. Par exemple, si on entre la valeur 10, alors tout paiement sup&eacute;rieur sera g&eacute;r&eacute; par ce second compte paypal.');
define('_msg_javascript44','Affichera la boite de recherche et le bouton dans l\'en-t&ecirc;te.');
define('_msg_javascript9','Paypal permet de cr&eacute;er une page avec un style personnel dans votre zone paypal.Si vous en avez une, sp&eacute;cifiez son nom ici. Sinon laissez vide pour la page par d&eacute;faut.');
define('_msg_javascript40','Ceci affichera un panier AJAX sur la page utilisateur. Si laiss&eacute; vide, le panier par d&eacute;faut sera affich&eacute;');
define('_msg_javascript_show_link','Ceci affichera le lien de chargement apr&egrave;s une transaction faite avec succ&egrave;s sur la page de remerciements.');
define('_msg_javascript45','Ceci affichera une en-t&ecirc;te de navigation sur toutes les pages.');
define('_msg_javascript46','Cela permettra d\'agrandir l\'image album lorsque l\'utilisateur clique sur la pochette d\'album');

define('_msg_free_download','T&eacute;l&eacute;chargements gratuits');
define('_msg_go_to_download','Vers le t&eacute;l&eacute;chargement');
define('_msg_download_message','Pour votre convenance, un lien de t&eacute;l&eacute;chargement vous est fourni ci-dessous');
define('_msg_download_message2','Votre email a &eacute;t&eacute; ajout&eacute;. Vous pouvez maintenant t&eacute;l&eacute;charger les morceaux gratuits.');

define('_msg_require_field', 'est un champs requis.');
define('_msg_invalid_email', 'est une adresse email invalide.');

define('_msg_no_download', 'Non disponible au t&eacute;l&eacute;chargement.');

define('_msg_name', 'Nom');
define('_msg_email', 'Email');
define('_msg_submit', 'Valider');
define('_msg_no_free', 'Aucun t&eacute;l&eacute;chargement gratuit n\'est propos&eacute; pour le moment.');

define('_msg_albumsnameAZ','Nom de l\'album de A-Z');
define('_msg_albumsnameZA','Nom de l\'album de Z-A');
define('_msg_artistAZ','Nom de l\'artiste de A-Z');
define('_msg_artistZA','Nom de l\'artiste de Z-A');

define('_msg_enlarge','Cliquez pour une image plus grande');

define('_msg_publichome5','Derniers Albums');
define('_msg_publichome6','Derniers Morceaux');

define('_msg_backup','Sauvegarde des tables');
define('_msg_backup2','Lancer la sauvegarde');
define('_msg_backup3','<font style="color:red">Attention !!!! Lancer la sauvegarde &eacute;crase les donn&eacute;es existantes de vos pr&eacute;c&eacute;dentes sauvegardes.</font>');
define('_msg_backup4','<font style="color:green">Cr&eacute;er</font>');
define('_msg_backup5','Erreur lors de la sauvegarde de vos tables. Merci d\'utiliser phpMyAdmin pour sauvegarder vos tables manuellement.');
define('_msg_backup6','Vos tables ont &eacute;t&eacute; sauvegard&eacute;es avec succ&egrave;s');

define('_msg_import','Il y a eu une erreur lors de l\'importation de vos tables');
define('_msg_import2','Vos tables 1.0 ont &eacute;t&eacute; import&eacute;es avec succ&egrave;s');
define('_msg_error_bind','Probl&egrave;me de recherche');
define('_msg_error_check','Probl&egrave;me de v&eacute;rification');
define('_msg_error_store','Probl&egrave;me d\'ajout');

define('_msg_csv','Exporter au format CSV');
define('_msg_csv_album','Par Album');
define('_msg_csv_sale','Par Vente');

define('_msg_RM','Nombre RM');
define('_msg_UPC','UPC');

define('_msg_newsletter','Lettre d\'information du système n\'est pas installé');
define('_msg_return_to','Retour à la page précédente');

define('_msg_append','ajouter URL');
define('_msg_label','Label');
define('_msg_javascript47','Si votre extraits sont au coeur de vos sites Web au dossier racine, vous pouvez ajouter l\'URL pour les joueurs flash.');
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

