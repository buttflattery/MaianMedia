<?php

/*------------------------------------------
  MAIAN MUSIC v1.3
  Written by Efthimio Malagraki
  E-Mail: support@maianscriptworld.co.uk
  Website: www.maianscriptworld.co.uk
  This File: Greek language file
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

define( '_msg_charset','UTF8');

$_msg_author = 'mpc.gr';
$_msg_website  = 'http://www.mpc.gr';

/*--------------------------------------
  INC/HEADER.PHP
  -------------------------------------*/
  
define( '_msg_public_header','Το Μουσικό Σας Κατάστημα. @ {website}');  
define( '_msg_public_header2','Τραγούδια στο καλάθι');
define( '_msg_public_header3','Ποιο δημοφιλείς');
define( '_msg_public_header4','Μουσική');
define( '_msg_public_header5','Επαφή');
define( '_msg_public_header6','Σχετικά');
define( '_msg_public_header7','Αναζήτηση');
define( '_msg_public_header8','Λέξεις κλειδιά');
define( '_msg_public_header9','Premium Beat Flash Player');
define( '_msg_public_header10','Αυτό το σύστημα χρησιμοποιεί<br />Premium Beat Flash Player<br /><b>&copy); Premium Beat.com</b>');
define( '_msg_public_header11','Τραγούδια στο καλάθι');
define( '_msg_public_header12','Άδεια');
define( '_msg_public_header13','MP3 Τραγούδια για κατέβασμα από το κατάστημά μας.');
define( '_msg_public_header14','mp3,downloads,albums,tracks,music,music store');
define( '_msg_public_header15','Δημοφιλέστερο κείμενο');



/*--------------------------------------
  TEMPLATES/ALBUM.TPL.PHP
  -------------------------------------*/
  
define( '_msg_publicalbum','Αναπαραγωγή / Αγορά τραγουδιών');  
define( '_msg_publicalbum2','Παρακαλώ χρησιμοποιήστε τον Player για να ακούσετε τα τραγούδια που σας παρέχουμε. <br />Μπορείτε να προσθέσετε
                              όσα τραγούδια θέλετε πριν από την αγορά. <br />Σας ευχαριστούμε.');
define( '_msg_publicalbum3','Αναπαραγωγή');
define( '_msg_publicalbum4','Τραγούδια στο καλάθι');
define( '_msg_publicalbum5','Τίτλος');
define( '_msg_publicalbum6','Κόστος');
define( '_msg_publicalbum7','Προσθήκη στο καλάθι');
define( '_msg_publicalbum8','Προσθήκη όλων των τραγουδιών στο καλάθι');
define( '_msg_publicalbum9','Προσθήκη επιλεγμένων τραγουδιών στο καλάθι');
define( '_msg_publicalbum10','Αναπαραγωγή τραγουδιών');
define( '_msg_publicalbum11','Τραγούδι');
define( '_msg_publicalbum12','Αυτή η σελίδα έχει προβληθεί <b>{count}</b> φορές.');
define( '_msg_publicalbum13','Κερδίστε <b>{amount}</b> %');
define( '_msg_publicalbum14','Σχετικά άλμπουμ');


/*--------------------------------------
  TEMPLATES/CART.TPL.PHP
  -------------------------------------*/
  
define( '_msg_cart','Καλάθι αγορών');
define( '_msg_cart2','Τα τραγούδια που βρίσκονται στο καλάθι σας φαίνονται παρακάτω. <br />Χρησιμοποιήστε το κουμπί που φαίνεται παρακάτω για να αφαιρέσετε οποιοδήποτε τραγούδι.<br />Όταν είστε ικανοποιημένος κάντε κλικ στο \'Ταμείο\' για να συνεχίσετε:');  
define( '_msg_cart3','Υπάρχουν 0 τραγούδια στο καλάθι σας.');
define( '_msg_cart4','{count} τραγούδια στο καλάθι σας.');
define( '_msg_cart5','Σύνολο');
define( '_msg_cart6','Άδειασε το καλάθι');
define( '_msg_cart7','Ταμείο');
define( '_msg_cart8','Απο:');
define( '_msg_cart9','Εξοικονομείτε {discount}%');


/*--------------------------------------
  TEMPLATES/CONTACT.TPL.PHP
  -------------------------------------*/

define( '_msg_contact','<div id="mm_contact">Εάν έχετε οποιοδήποτε πρόβλημα ή θα θέλατε να μας υποβάλετε οποιαδήποτε ερώτηση για την μουσική μας, <br />παρακαλώ χρησιμοποιήστε την παρακάτω φόρμα. :</div>');
define( '_msg_contact2','Επικοινωνία');
define('_msg_contact3','Θέμα');
define('_msg_contact4','Σχόλια');
define('_msg_contact5','Αποστολή μηνύματος');
define('_msg_contact6','Παρακαλώ βάλτε θέμα...');
define('_msg_contact7','Παρακαλώ βάλτε σχόλιο...');
define('_msg_contact8','Το μήνυμά σας στάλθηκε.<br /><br />Θα σας απαντήσουμε το συντομότερο δυνατό.');
define('_msg_contact9','Όνομα');
define('_msg_contact10','E-Mail');
define('_msg_contact11','Κωδικός');
define('_msg_contact12','Λάθος κωδικός, παρακαλώ ξαναπροσπαθήστε.');
define('_msg_contact13','Ευχαριστούμε!');
define('_msg_contact14','Το μήνυμα στάλθηκε!');
define('_msg_contact15','Παρακαλώ πληκτρολογήστε το όνομά σας...');
define('_msg_contact16','Παρακαλώ πληκτρολογήστε ένα έγκυρο e-mail...');
define('_msg_contact17','Κάντε κλικ στο Captcha για ανανέωση');


/*--------------------------------------
  TEMPLATES/CONTACT.TPL.PHP
  -------------------------------------*/
  
define('_msg_publichome','Ευχαριστούμε για το ενδιαφέρον σας στην μουσική μας. Χρησιμοποιήστε το μενού στα αριστερά
                          για περιηγηθείτε στις συλλογές μας. Μπορείτε να αποκτήσετε μεμονωμένα τραγούδια ή ολόκληρα
						  άλμπουμ απλά κάνοντας κλικ στο κουμπί προσθήκη. Μπορείτε επίσης να ακούσετε τα mp3 πριν τα αγοράσετε.
						  Όλες οι αγορές είναι ασφαλείς και γίνονται μέσω Paypal χωρείς να χρειάζεται να έχετε Paypal λογαριασμό.
						  Επικοινωνήστε μαζί μας εάν έχετε κάποια απορία. <br /><br />Ευχαριστούμε!
                         ');  
define('_msg_publichome2','Δεκτές όλες οι πιστωτικές κάρτες μέσω Paypal');
define('_msg_publichome3','Τα ποιο δημοφιλή τραγούδια');
define('_msg_publichome4','Τα ποιο δημοφιλή άλμπουμ');


/*--------------------------------------
  TEMPLATES/DOWNLOAD_ITEM.TPL.PHP
  -------------------------------------*/


define('_msg_downloaditem','<br /><br /><span class="sorry">Συγγνώμη!</span><br /><br /><span class="sorry_msg">Αυτό το τραγούδι δεν είναι διαθέσιμο!</span><br /><br /><br />Παρακαλώ χρησιμοποιήστε την επιλογή επικοινωνία<br />για να γίνει ξανά διαθέσιμο.');  
define('_msg_downloaditem2','<br /><br /><span class="sorry">Σφάλμα!</span><br /><br /><span class="sorry_msg">Δεν έχετε δικαίωμα<br />Να δείτε αυτήν την σελίδα!</span><br /><br /><br />Παρακαλώ χρησιμοποιήστε την επιλογή επικοινωνία<br />εάν πιστεύετε ότι κάτι έγινε λάθος.');  


/*--------------------------------------
  TEMPLATES/MUSIC.TPL.PHP
  -------------------------------------*/

define('_msg_music','Παρακαλώ κάντε κλικ στο Link για να δείτε περισσότερες πληροφορίες σχετικά με ένα άλμπουμ ή για ακούσετε / αποκτήσετε ένα τραγούδι. Ευχαριστούμε.');
define('_msg_music2','Περισσότερες πληροφορίες');
define('_msg_music3','Τραγούδια: {count}');


/*--------------------------------------
  TEMPLATES/PAYPAL/CANCEL.TPL.PHP
  TEMPLATES/PAYPAL/CHECKOUT.TPL.PHP
  TEMPLATES/PAYPAL/DOWNLOAD.TPL.PHP
  TEMPLATES/PAYPAL/ERROR.TPL.PHP
  TEMPLATES/PAYPAL/THANKS.TPL.PHP
  -------------------------------------*/
  
define('_msg_paypal','Σύνδεση με Paypal server.....Παρακαλώ περιμένετε....');  
define('_msg_paypal2','Μουσική παραγγελία');
define('_msg_paypal3','Η συναλλαγή ακυρώθηκε!');
define('_msg_paypal4','Η συναλλαγή σας ακυρώθηκε επιτυχώς και καμία πληρωμή δεν στάλθηκε.<br /><br />Σας ευχαριστούμε για το ενδιαφέρον σας για τη μουσική μας.');
define('_msg_paypal5','Άκυρη συναλλαγή!');
define('_msg_paypal6','Αυτό εμφανίζεται να είναι μια άκυρη συναλλαγή δεδομένου ότι το ποσό πληρωμής δεν ταιριάζει με το ποσό στο καλάθι σας.<br /><br />Ο webmaster έχει ενημερωθεί για αυτήν την προσπάθεια και θα λάβει περαιτέρω μέτρα.<br /><br />Εάν πιστεύετε ότι αυτό είναι ένα λάθος, παρακαλώ χρησιμοποιήστε από το μενού την επιλογή επικοινωνία.<br /><br />Ευχαριστούμε.');
define('_msg_paypal7','Ευχαριστούμε!');
define('_msg_paypal8','Η συναλλαγή σας έχει ολοκληρωθεί επιτυχώς.<br /><br />
                              Παρακαλώ ελέγξτε το inbox σας "<b>{email}</b>". Αυτό περιέχει ένα link με τα τραγούδια που παραγγείλατε. Παρακαλώ κάντε κλικ σε αυτό το link για να μεταφερθείτε στην σελίδα από όπου μπορείτε να κατεβάσετε τα τραγούδια που ζητήσατε. Εάν δεν λάβετε σύντομα email και είδη έχετε κοιτάξει και στα spam email σας, τότε χρησιμοποιήστε την επικοινωνία αριστερά στο μενού για να έρθετε σε επαφή μαζί μας και να ολοκληρώσουμε την παραγγελία σας.<br /><br />
                              Ελπίζουμε να απολαμβάνετε την μουσική σας,<br /><br />
                              <b>{store}</b>');
define('_msg_paypal9','Ένα λάθος προέκυψε!');
define('_msg_paypal10','Δεν έχετε άδεια να δείτε αυτήν την σελίδα, συγγνώμη.');  
define('_msg_paypal11','Καμία παραγγελία δεν βρέθηκε. Παρακαλώ κάντε έλεγχο στο link από το email που παραλάβατε ότι είναι το σωστό.<br/><br />Παρακαλώ χρησιμοποιήστε την επιλογή επικοινωνία εάν πιστεύετε ότι κάτι έγινε λάθος.<br /><br />Ευχαριστούμε.');                            
define('_msg_paypal12','Η σελίδα αυτή έχει λήξη!');
define('_msg_paypal13','Αυτό το link έχει λήξη και δεν μπορεί να ξαναχρησιμοποιηθεί. Το σύστημα αποτρέπει την συνέχεις προσπέλαση της σελίδας για λόγους ασφαλείας.<br /><br />
                              Εάν χρειάζεστε ξανά πρόσβαση στην σελίδα αυτή επικοινωνήστε μαζί μας για να ξανά ενεργοποιήσουμε αυτήν την σελίδα.<br /><br />
                              Συγγνώμη για την ενόχληση,<br /><br />
                              <b>{store}</b>');
define('_msg_paypal14','Σελίδα λήξης');
define('_msg_paypal15','Ευχαριστούμε για την αγορά σας, οι επιλογές σας παρουσιάζονται παρακάτω.<br /><br />Παρακαλώ <b>ΝΑ ΜΗΝ</b> ανανεώσετε ή προσθέσετε την σελίδα στα αγαπημένα γιατί θα έχει λήξη όταν θα επιστρέψετε ξανά σε αυτή.<br /><br />Σας επιτρέπετε να κατεβάσετε κάθε αρχείο {duration}. Αν αντιμετωπίζετε κάποιο πρόβλημα ενημερώστε μας σχετικά από την επιλογή επικοινωνία.');                              
define('_msg_paypal16','μία');
define('_msg_paypal17','δύο');
define('_msg_paypal18','φορές');
define('_msg_paypal19','Αγορά άλμπουμ');
define('_msg_paypal20','Αγορά τραγουδιών');
define('_msg_paypal21','Κανένα άλμπουμ δεν παραγγέλθηκε');
define('_msg_paypal22','Κανένα τραγούδι δεν παραγγέλθηκε');
define('_msg_paypal23','Ελπίζουμε να απολαμβάνετε τα καινούργια σας τραγούδια!');
define('_msg_paypal24','Λήξη τραγουδιού');
define('_msg_paypal25','Λήξη καλλιτέχνη');
define('_msg_paypal26','Λήξη τραγουδιών');
define('_msg_paypal27','Το αρχείο δεν υπάρχει!');
define('_msg_paypal28','Σύνολο τραγουδιών =');
define('_msg_paypal29','Κάντε κλικ στο(α) κουμπί(α) για λήψη!');
define('_msg_paypal30','Επιστροφή στην προηγούμενη σελίδα');
define('_msg_paypal31','Η λήψη έληξε');


/*--------------------------------------
  TEMPLATES/SEARCH.TPL.PHP
  -------------------------------------*/

define('_msg_publicsearch','Αποτελέσματα αναζήτησης');
define('_msg_publicsearch2','Τα αποτελέσματα αναζήτησής σας για "<b>{keywords}</b>" παρουσιάζεται κατωτέρω. Εάν η αναζήτησή σας δεν παρήγαγε κανένα αποτέλεσμα, δοκιμάστε τις πολλαπλάσιες λέξεις κλειδιά που χωρίζονται από ένα διάστημα για μια πιό λεπτομερή αναζήτηση.');
define('_msg_publicsearch3','<br /><b>Κανένα αποτέλεσμα δεν βρέθηκε...Παρακαλώ προσπαθήστε πάλι...</b>');
define('_msg_publicsearch4','{count} Αποτελέσματα αναζήτησης');


/*--------------------------------------
  ADMIN/INC/HEADER.PHP
  -------------------------------------*/

define('_msg_header','Διαχείριση');
define('_msg_header2','Σχετικά');  
define('_msg_header3','Ρυθμίσεις');  
define('_msg_header4','Διαχείριση άλμπουμ');  
define('_msg_header5','Προσθήκη νέων τραγουδιών');  
define('_msg_header6','Διαχείριση τραγουδιών');  
define('_msg_header7','Πωλήσεις');  
define('_msg_header8','Αναζήτηση πωλήσεων'); 
define('_msg_header9','Μενού');
define('_msg_header10','Κατηγορίες'); 
define('_msg_header11','Στατιστικά');
  
  
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
  
define('_msg_add','Εδώ προσθέτετε τα mp3/mp4. Πριν ξεκινήσετε να προσθέτετε τραγούδια σιγουρευτείτε ότι τα έχετε ανεβάσει στους αντίστοιχους φακέλους. Χρησιμοποιήστε το drop down μενού για να επιλέξετε
                              πόσα τραγούδια θέλετε να προσθέσετε και μετά συμπληρώστε τις λεπτομέρειες για κάθε τραγούδι. Χρησιμοποιήστε τους συνδέσμους βοήθειας εάν δεν είστε σίγουρη.<br><br>
                              <i>Σημειώστε ότι εάν παραλείψετε το όνομα του τραγουδιού την διαδρομή του αρχείου ή το κόστος, το τραγούδι δεν θα προστεθεί.</i>');  
define('_msg_add2','Τραγούδια για προσθήκη');
define('_msg_add3','Πόσα τραγούδια θέλετε να προσθέσετε? Μπορείτε να ανανεώσετε αυτήν την σελίδα όσες φορές θέλετε και καμία πληροφορία δεν θα χαθεί.');
define('_msg_add4','Τραγούδι');
define('_msg_add5','Προσθήκη τραγουδιών');
define('_msg_add6','Όνομα τραγουδιού');
define('_msg_add7','Προσθήκη στο άλμπουμ');
define('_msg_add8','MP3 διαδρομή');
define('_msg_add9','Διαδρομή προεπισκόπησης αρχείου');
define('_msg_add10','Διάρκεια τραγουδιού');
define('_msg_add11','Κόστος');
define('_msg_add12','Single Purchase');
define('_msg_add13','<b>{count}</b> τραγούδι(α) προστέθηκαν. Μπορείτε να τα διαχειριστείτε παρακάτω.');
define('_msg_add14','Επιλογή άλμπουμ ');
define('_msg_add15',' για όλα τα τραγούδια.');


/*--------------------------------------
  ADMIN/DATA_FILES/ALBUMS.PHP
  -------------------------------------*/
  
define('_msg_albums','Τα MP3 ομαδοποιούνται σε άλμπουμ. Όταν προσθέτετε τραγούδια,
                              πρέπει να διευκρινίζετε και το άλμπουμ στο οποίο ανήκει. Οι επισκέπτες μπορούν να αγοράσουν μόνο κομμάτια ή ολόκληρα άλμπουμ. Μόλις προσθέσετε ένα νέο άλμπουμ θα εμφανιστεί παρακάτω.');  
define('_msg_albums2','Άλμπουμ');
define('_msg_albums3','Όνομα Άλμπουμ');
define('_msg_albums4','Τρέχων άλμπουμ -- Κλικ στο όνομα για επεξεργασία');
define('_msg_albums5','Διεύθυνση φωτογραφίας του άλμπουμ.');
define('_msg_albums20','Άλμπουμς');
//define('_msg_albums21','Height:');
//define('_msg_albums22','Width:');
define('_msg_albums6','Καλλιτέχνης Άλμπουμ (Zip Αρχείο)');
define('_msg_albums7','Σχόλια/πληροφορίες');
define('_msg_albums8','Ενεργοποίηση Άλμπουμ');
define('_msg_albums9','Υπάρχουν 0 άλμπουμ στη βάση δεδομένων.');
define('_msg_albums10','Ενημέρωση Άλμπουμ');
define('_msg_albums11','Καλλιτέχνης');
define('_msg_albums12','Λέξεις κλειδιά');
define('_msg_albums13','Λείψεις');
define('_msg_albums14','Επαναφορά λήψης');
define('_msg_albums15','Hits');
define('_msg_albums16','Κατηγορία');
define('_msg_albums17','Ανώτερο επίπεδο άλμπουμ');
define('_msg_albums18','Μη κατηγοριοποιημένο');
define('_msg_albums19','Έκπτωση αγοράς άλμπουμ.');

/*--------------------------------------
  ADMIN/DATA_FILES/HOME.PHP
  -------------------------------------*/
  
define('_msg_home','Καλώς ήλθατε στο Music Action');
define('_msg_dedicate','<br><br>Dedicated to <a href="http://www.lpierce927.com" title="Looch" target="_blank">Lamar Anthony Pierce</a> A.K.A <a href="http://www.myspace.com/thereallooch" title="Looch" target="_blank">Looch</a>');
define('_msg_home2','Δωρεά');                                
define('_msg_home3','Η δωρεά δεν είναι υποχρεωτική. Ευχαριστούμε.');
define('_msg_home4','Οι δωρεά δεν είναι απαραίτητη, αλλά οποιαδήποτε δωρεά θα εκτιμηθεί πάρα πολύ. Σας ευχαριστούμε!');
define('_msg_home5','Music Action Επισκόπηση');
define('_msg_home6','Βρίσκεστε εδώ <b>{tracks}</b> τραγούδια, σε γκρουπ των <b>{albums}</b> άλμπουμς.<br><br>
                              Αμοιβή Paypal: <b>{fees}</b><br>
                              Κέρδος: <b>{profit}</b><br><br>
                              <b>{a_purchases}</b> άλμπουμς και <b>{t_purchases}</b> τραγούδια έχετε στην παραγγελία σας.
                         ');
                         
                              
/*--------------------------------------
  ADMIN/DATA_FILES/LOGIN.PHP
  -------------------------------------*/   
  
define('_msg_login','Σύνδεση');                             
define('_msg_login2','Παρακαλώ συνδεθείτε στην διαχείριση παρακάτω:');
define('_msg_login3','Όνομα χρήστη');
define('_msg_login4','Κωδικός');
define('_msg_login5','Σύνδεση');
define('_msg_login6','Ακυρο');
define('_msg_login7','Να με θυμάσαι');


/*--------------------------------------
  ADMIN/DATA_FILES/SALES.PHP
  -------------------------------------*/
  
define('_msg_sales','Οι πωλήσεις σας παρουσιάζονται παρακάτω. Χρησιμοποιήστε την επιλογή ταξινόμηση κατά αν είναι απαραίτητο. Χρησιμοποιήστε τις συνδέσεις που παρέχονται για να διαχειριστούν τις πωλήσεις ή για να έρθετε σε επαφή με τους πελάτες σας. Για να βρείτε μια εγγραφή, χρησιμοποιήστε την επιλογή αναζήτησης από τις επιλογές.');  
define('_msg_sales2','Προβολή');
define('_msg_sales3','Ανά σελίδα');
define('_msg_sales4','Νεώτερες πωλήσεις');
define('_msg_sales5','Παλαιότερες πωλήσεις');
define('_msg_sales6','Αγορά τραγουδιών');
define('_msg_sales7','Αγορά άλμπουμ');
define('_msg_sales8','Υψηλότερη συνολική είσπραξη');
define('_msg_sales9','Χαμηλότερη συνολική είσπραξη');
define('_msg_sales10','Όνομα πελάτη A-Z');
define('_msg_sales11','Όνομα πελάτη Z-A');
define('_msg_sales12','Προβολή {count} πωλήσεων');
define('_msg_sales13','Υπάρχουν <b>0</b> πωλήσεις στη βάση δεδομένων.');
define('_msg_sales14','Αφαιρέστε τις επιλεγμένες πωλήσεις');
define('_msg_sales15','Άλμπουμ που αγοράστηκαν ');
define('_msg_sales16','Τραγούδια που αγοράστηκαν ');
define('_msg_sales17','<b>0</b> άλμπουμ αγορασμένα.');
define('_msg_sales18','<b>0</b> τραγούδια αγορασμένα.');
define('_msg_sales19','από');
define('_msg_sales20','Άλμπουμ');
define('_msg_sales21','Τραγούδια');
define('_msg_sales22','Πληροφορίες πωλήσεων');
define('_msg_sales23','Επικοινωνήστε με τον πελάτη ');
define('_msg_sales24','Θέμα');
define('_msg_sales25','Σχόλια');
define('_msg_sales26','Ή εάν έχετε ένα e-mail client, κάντε κλικ <a href="mailto:{email}" title="Click to launch e-mail client"><b><u>εδώ</u></b></a>.');
define('_msg_sales27','Μήνυμα εστάλη!');
define('_msg_sales28','Αποστολή μηνύματος');
define('_msg_sales29','Επανάληψη λήψης &amp; Αποστολή E-Mail λήψης');
define('_msg_sales30','Πελάτη/Paypal Πληροφορίες');
define('_msg_sales31','Το E-Mail στάλθηκε στον πελάτη!');
define('_msg_sales32','Κάντε κλικ για Προβολή');
define('_msg_sales33','Πελάτης');
define('_msg_sales34','E-Mail');
define('_msg_sales35','Ημερομηνία');
define('_msg_sales36','Διεύθυνση');
define('_msg_sales37','Υπόμνημα πελάτη');
define('_msg_sales38','Κατάσταση Πληρωμής');
define('_msg_sales39','Προμήθεια/Κέρδος/Σύνολο');
define('_msg_sales40','Paypal κωδικός συναλλαγής');
define('_msg_sales41','Πελάτες');
define('_msg_sales42','Πληροφορίες');
define('_msg_sales43','Αφαίρεση');
define('_msg_sales44','Paypal κωδικός συναλλαγής');
define('_msg_sales45','Τιμολόγιο No');

/*--------------------------------------
  ADMIN/DATA_FILES/SEARCH.PHP
  -------------------------------------*/
  
define('_msg_search','Η επιλογές αυτές σας επιτρέπουν να κάνετε αναζήτηση των πωλήσεων σας. Χρήσιμο αν έχετε πολλές καταχωρήσεις και πρέπει να εντοπίσετε μία συγκεκριμένη καταχώρηση. Προσδιορίστε τα κριτήρια σας παρακάτω. Μπορείτε να εισάγετε έναν ή όλους τους όρους αναζήτησης, αλλά θα πρέπει να περιλαμβάνει τουλάχιστον μία επιλογή:');
define('_msg_search2','Εισάγετε κριτήρια αναζήτησης');
define('_msg_search3','Όπου \'όνομα\' ίδιο με');
define('_msg_search4','Όπου \'e-mail\' ίδιο με');
define('_msg_search5','Όπου \'Νο τιμολόγιου\' =');
define('_msg_search6','Όπου \'Κωδ συναλλαγής\' =');
define('_msg_search7','Όπου \'Ημερομηνία\' μεταξύ');
define('_msg_search8','Αναζήτηση');
define('_msg_search9','Δεν βρέθηκαν αποτελέσματα ... Παρακαλώ δοκιμάστε μια άλλη αναζήτηση...');
define('_msg_search10','Αποτελέσματα Αναζήτησης');
define('_msg_search11','Τα αποτελέσματα αναζήτησής φαίνεται παρακάτω');
define('_msg_search12','Νέα Αναζήτηση');


/*--------------------------------------
  ADMIN/DATA_FILES/SETTINGS.PHP
  -------------------------------------*/
  
define('_msg_settings','Ενημερώστε τις ρυθμίσεις του προγράμματός σας κατωτέρω. Όλα τα πεδία πρέπει να συμπληρωθούν εκτός και αν είναι προαιρετικά.');  
define('_msg_settings2','Γενικές ρυθμίσεις');
define('_msg_settings3','Όνομα καταστήματος');
define('_msg_settings4','E-Mail');
define('_msg_settings5','Διεύθυνση αρχικής σελίδας');
define('_msg_settings6','Διαδρομή στο φάκελο εγκατάστασης');
define('_msg_settings7','Γλώσσα');
define('_msg_settings8','Ενεργοποίηση Captcha');
define('_msg_settings9','MP3/Ρυθμίσεις λήψης');
define('_msg_settings10','Διαδρομή φακέλου MP3');
define('_msg_settings11','Προβολή φακέλου MP3');
define('_msg_settings12','Ενημέρωση ρυθμίσεων');
define('_msg_settings13','Search Engine Friendly URLs');
define('_msg_settings14','Ρυθμίσεις Paypal');
define('_msg_settings15','Ενεργοποίηση Paypal IPN');
define('_msg_settings16','Ενεργοποίηση Sandbox');
define('_msg_settings17','Ζωντανά');
define('_msg_settings18','Καταγραφή λαθών');
define('_msg_settings19','Στυλ σελίδας');
define('_msg_settings20','Paypal E-Mail');
define('_msg_settings21','Επεξεργασία νομίσματος');
define('_msg_settings22','');
define('_msg_settings23','Σελίδα(ες) Κείμενο');
define('_msg_settings24','<a href="http://en.wikipedia.org/wiki/HTML" title="Hypertext Markup Language" target="_blank">HTML</a> επιτρέπεται');
define('_msg_settings25','Λήξη σελίδας λήψης');
define('_msg_settings26','Συνολικά RSS Feed για άλμπουμ');
define('_msg_settings27','Συνολικά οι δημοφιλέστερες επιλογές');
define('_msg_settings28','Ενεργοποίηση SSL');
define('_msg_settings29','SMTP Πόρτα');
define('_msg_settings30','Μηδενισμός όλων των δεικτών επίσκεψης άλμπουμ');
define('_msg_settings31','Λήξη τραγουδιού λήψης');
define('_msg_settings32','Σελίδα άδειας');
define('_msg_settings33','SMTP Ρυθμίσεις');
define('_msg_settings34','Ενεργοποίηση SMTP');
define('_msg_settings35','SMTP Host');
define('_msg_settings36','SMTP Username');
define('_msg_settings37','SMTP Password');
define('_msg_settings38','Διαμόρφωση Mp3 Player');
define('_msg_settings39','Player');
define('_msg_settings40','Πληροφορίες πληρωμής');
define('_msg_settings41','Προεπιλεγμένη σελίδα');
define('_msg_settings42','Τα πιο δημοφιλή');
define('_msg_settings43','Μουσική');
define('_msg_settings44','Κείμενο σελίδας τραγουδιού');

/*--------------------------------------
  ADMIN/DATA_FILES/STATISTICS.PHP
  -------------------------------------*/

define('_msg_statistics','Αυτή η σελίδα σας επιτρέπει να δείτε με μια ματιά πόσες φορές από κάθε άλμπουμ έχει αγοραστεί κάθε κομμάτι. Κάντε κλικ στα κουμπιά για την επέκταση ενός άλμπουμ για στατιστικά.
                         ');
define('_msg_statistics2','Ταξινόμηση κατά');
define('_msg_statistics3','Περισσότερες επισκέψεις');
define('_msg_statistics4','Λιγότερες επισκέψεις');
define('_msg_statistics5','Άλμπουμ');
define('_msg_statistics6','Τραγούδια');
define('_msg_statistics7','<li>Επισκέψεις: <b>{hits}</b> </li> <li>Αγορές Άλμπουμ: <b>{albums}</b> </li> <li> Αγορές τραγουδιών: <b>{tracks}</b></li>');
define('_msg_statistics8','Δείτε Στατιστικά τραγουδιών');
define('_msg_statistics9','Εμφανίζετε μια λίστα με κάθε κομμάτι για αυτό το άλμπουμ και το συνολικό ποσό των αγορών για κάθε κομμάτι.');
define('_msg_statistics10','Ανάπτυξη όλων');
define('_msg_statistics11','Σύμπτυξη όλων');


/*--------------------------------------
  ADMIN/DATA_FILES/TRACKS.PHP
  -------------------------------------*/
  
define('_msg_tracks','Αυτή η σελίδα σας επιτρέπει να διαχειριστείτε τρέχουσα κομμάτια σας. Επιλέξτε ένα άλμπουμ από κάτω για να δείτε τα κομμάτια σε αυτό το άλμπουμ και στη συνέχεια χρησιμοποιήστε τα κουμπιά για την ενημέρωση των κομματιών.');  
define('_msg_tracks2','<b>{count}</b> τραγούδια');
define('_msg_tracks3','Προβολή τραγουδιών');
define('_msg_tracks4','Κανένα τραγούδι');


/*--------------------------------------
  ADMIN/DATA_FILES/VIEW_TRACKS.PHP
  -------------------------------------*/
  
define('_msg_viewtracks','Ενημέρωση τραγουδιών');  
define('_msg_viewtracks2','Κάντε κλικ στις συνδέσεις για να επεξεργαστείτε ένα κομμάτι. Μπορείτε να ενημερώσετε ή να διαγράψετε οποιαδήποτε τραγούδι και επίσης να αλλάξετε τη σειρά με την επιλογή που καθορίζει τη σειρά με την οποία τα κομμάτια εμφανίζονται.');
define('_msg_viewtracks3','Ενημέρωση του τραγουδιού');
define('_msg_viewtracks4','Μετακίνηση επάνω');
define('_msg_viewtracks5','Μετακίνηση κάτω');
define('_msg_viewtracks6','Αυτό το άλμπουμ έχει αυτή τη στιγμή 0 τραγούδια');
define('_msg_viewtracks7','Άκυρο');
define('_msg_viewtracks8','Το τραγούδι ενημερώθηκε με επιτυχία!');
define('_msg_viewtracks9','Ανανέωση');


/*---------------------
  RESPONSE DATA FOR IPN
  PAYPAL E-MAILS
----------------------*/

define('_msg_ipn','Άκυρη παραγγελία');
define('_msg_ipn2','Paypal IPN Error!!');
define('_msg_ipn3','Αν ενεργοποιηθεί αυτό το λάθος θα καταγραφή στο αρχείο λαθών.');
define('_msg_ipn4','Οι ακόλουθη εισαγωγή παρελήφθη από το (και αποστέλλεται πίσω) PayPal:');
define('_msg_ipn5','Η πληρωμή απέτυχε');
define('_msg_ipn6','Η πληρωμή ακυρώθηκε');
define('_msg_ipn7','Άγνωστη Κατάσταση Πληρωμής');
define('_msg_ipn8','Αναστολή λειτουργίας αγορών!');
define('_msg_ipn9','Άκυρη Συναλλαγή Αγοράς!');
define('_msg_ipn10','Πληροφορίες λήψης!');
define('_msg_ipn11','Συναλλαγή!');


/*-------------------------------------
  GENERAL VARIABLES
  ------------------------------------*/

define('_msg_script','Μusic action');
define('_msg_script2','Ναι');
define('_msg_script3','Όχι');
define('_msg_script4','Επεξεργασία');
define('_msg_script5','Αρχή');
define('_msg_script6','Τελος');
define('_msg_script7','Επεξεργασία');
define('_msg_script8','Διαγραφή');
define('_msg_script9','Ακύρωση');
define('_msg_script10','Ανανέωση');
define('_msg_script11','Εκτύπωση');
define('_msg_script12','απεριόριστη');


/*-----------------------------
  RSS Feeds
-------------------------------*/

define('_msg_rss','Τελευταία άλμπουμ @ {website_name}');
define('_msg_rss2','Αυτά είναι τα τελευταία άλμπουμ που έχουν προστεθεί στο {website_name}');
define('_msg_rss3','Άλμπουμ:');


/*----------------------
  ADMIN/INC/CALENDAR.PHP
-----------------------*/

define('_msg_calendar','Ιανουάριος');
define('_msg_calendar2','Φεβρουάριος');
define('_msg_calendar3','Μάρτιος');
define('_msg_calendar4','Απρίλιος');
define('_msg_calendar5','Μάιος');
define('_msg_calendar6','Ιούνιος');
define('_msg_calendar7','Ιούλιος');
define('_msg_calendar8','Αύγουστος');
define('_msg_calendar9','Σεπτέμβριος');
define('_msg_calendar10','Οκτώβριος');
define('_msg_calendar11','Νοέμβριος');
define('_msg_calendar12','Δεκέμβριος');


/*--------------------------------------------------------------------------------------------------
  ZIP FILE FOLDER NAMES
  These are the names of the folders that are created inside the zip file when someone downloads 
  an album or track. These should NOT contain any illegal characters that may prevent the creation 
  of the folder. If you are unsure, leave them as they are
  --------------------------------------------------------------------------------------------------*/
  
define('_msg_folder','τραγούδι');
define('_msg_folder2','άλμπουμ');
  

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
define('_msg_javascript33','Είστε σίγουροι ότι θέλετε να διαγράψετε αυτές τις πωλήσεις;');
define('_msg_javascript34','Είστε σίγουρος;');
define('_msg_javascript35','If your site is on a Secure Socket Layer, enable SSL to have the processing return to your secure area. Do <b>NOT</b> enable this is you don`t have a SSL certificate installed on your server.');
define('_msg_javascript36','How many latest albums do you want to display on the RSS feed? Max 999');
define('_msg_javascript37','How many popular links do you want to display on homepage? Max 999');
define('_msg_javascript38','To get your Idenity Token under your Paypal profile go to:<br><br><b>Profile ->Website Payment Preferences</b><br><br> Turn on Payment Data Transfer and copy and paste your Identity Token');
define('_msg_javascript39','Determines which page the component defaults to');
/*-----------------------------------------------------------------------------------------------------

  Pre-installiation check. 

------------------------------------------------------------------------------------------------------*/

define('_setup15','CURL Υποστήριξη <i>(Paypal Επεξεργασία)</i>');
define('_setup16','Έκδοση PHP');
define('_setup17','Έλεγχος συμβατότητας, αν δεν είναι όλα ΟΚ επικοινωνήστε με τον πάροχο');
define('_setup18','GD Γραφική Υποστήριξη <i>(Captcha)</i>');
define('_setup19','<font style="color:orange">OK</font>');
define('_setup20','<font style="color:red">Δεν υποστηρίζετε</font>');
define('_setup22','<font style="color:red">Έκδοση πολύ παλιά</font>');

/*-----------------------------------------------------------------------------------------------------

  New 1.3 text. 

------------------------------------------------------------------------------------------------------*/
define('_msg_op_cancel','Η διαδικασία ακυρώθηκε');
define('_setup23','Εισαγωγή 1.0 Πίνακες');
define('_setup24','Συντελεστές ανοιχτού κώδικα');
define('_setup25','Προσαρμογή');
define('_setup26','Έλεγχος συστήματος');
define('_setup27','Αρχεία γλώσσας');
define('_setup28','Flash Players');
define('_setup29','Ξεκινήστε την εισαγωγή');
define('_setup33','Έλεγχος εκκίνησης συστήματος');
define('_setup30','Αποτελέσματα ελέγχου συστήματος');
define('_setup31','Η έκδοσή σας');
define('_setup32','Τρέχουσα έκδοση');

define('_msg_tableh1','Τίτλος');
define('_msg_tableh2','Δημοσιευμένο');
define('_msg_tableh3','Ψευδώνυμο');
define('_msg_tableh4','Σειρά');

define('_msg_categories','Κατηγορίες');
define('_msg_categories1','Κατηγορία');
define('_msg_categories_desc','Μπορείτε να δημιουργήσετε κατηγορίες για να ομαδοποιήσετε τα άλμπουμ. Ένα άλμπουμ μπορεί να δημιουργηθεί χωρείς να ανήκει σε μια κατηγορία, αλλά δεν θα εμφανίζετε στην προβολή κατηγοριών');
define('_msg_categories2','Δεν υπάρχουν κατηγορίες στη βάση δεδομένων.');


define('_msg_discount','Έκπτωση');

define('_msg_settings46','Αποθηκεύστε το καλάθι');
define('_msg_settings47','Ενεργοποίηση Ajax');
define('_msg_settings48','Συμπεριλάβετε πεδία αναζήτησης');
define('_msg_settings49','Εναλλακτική E-Mail διεύθυνση Paypal');
define('_msg_settings50','Ελάχιστη πληρωμή');
define('_msg_settings51','Παρουσίαση συνδέσου λήψης μετά την αγορά');
define('_msg_settings52','Προβολή Πλοήγησης');
define('_msg_settings53','Χρήση μεγέθυνσης');

define('_msg_albums_error','Σφάλμα: Ένα ή περισσότερα άλμπουμ δεν μπορούν να διαγραφούν');
define('_msg_albums21','Άλμπουμ(ς) Διαγράφεται');
define('_msg_albums22', 'Άλμπουμ Δημοσιεύθηκε');
define('_msg_albums23', 'Άλμπουμ Προστέθηκε!');

define('_msg_tracks5','Αριθμός τραγουδιών');
define('_msg_tracks6','Επιλεγμένο αρχείο: ');
define('_msg_tracks7','Μέγεθος: ');
define('_msg_tracks8','Τύπος: ');
define('_msg_tracks9','Προσθήκη υποφακέλου: ');
define('_msg_tracks10','Σύνδεση με : ');
define('_msg_tracks11','Δεν βρήκατε η (PATH). Παρακαλώ πηγαίνετε στις ρυθμίσεις και διορθώστε');
define('_msg_tracks12','Παρουσιάστηκε ένα σφάλμα και δεν φορτώθηκε το αρχείο.');
define('_msg_tracks13','Φορτώθηκε με επιτυχία: ');

define('_msg_upload_error1','Δεν είναι δυνατό το ανέβασμα στο: ');
define('_msg_upload_error2','και δεν ξέρω γιατί.');

define('_msg_tools','Μουσική Πίνακες');
define('_msg_tools2','<font style="color:orange">Βρέθηκε</font>');
define('_msg_tools3','<font style="color:red">Δεν Βρέθηκε</font>');
define('_msg_tools4','<font style="color:red">Προειδοποίηση!!!! Εκτελώντας αυτή τη διαδικασία ενδέχεται να αντικαταστήσετε όλα τα δεδομένα που έχουν οι πίνακες της βάσης.</font>');

define('_msg_collapse_all','Σύμπτυξη όλων');
define('_msg_expand_all','Ανάπτυξη όλων');

define('_msg_javascript41','Καθορίζει πόσες μέρες θα κρατήσετε αχρησιμοποίητα δεδομένα στο καλάθι αν μείνει κενό, η προεπιλογή είναι 14 ημέρες.');
define('_msg_javascript42','Εάν έχετε πολλές μικροπληρωμές στον πρώτο Paypal λογαριασμό σας, μπορείτε να εισάγετε έναν πρόσθετο λογαριασμό paypal  εδώ για να μεγιστοποιήσετε τα κέρδη.');
define('_msg_javascript43','Όλες οι πληρωμές που είναι μεγαλύτερες από την καθορισμένη αρχική αξία θα υποβληθούν για επεξεργασία από αυτόν τον λογαριασμό. Παράδειγμα, εάν η αρχική αξία είναι 10 ευρώ, κάθε πληρωμή που είναι άνω των 10 ευρώ θα υποβληθούν σε επεξεργασία από το δεύτερο λογαριασμό PayPal.');
define('_msg_javascript44','Θα δείξει το πλαίσιο κειμένου αναζήτησης στην κεφαλίδα');
define('_msg_javascript9','Η Paypal σας επιτρέπει να δημιουργήσετε ένα στυλ σελίδας για την Paypal περιοχή σας. Εάν έχετε ένα, δηλώστε το όνομα του εδώ. Αφήστε το κενό αν δεν έχετε κανένα στυλ.');
define('_msg_javascript40','Ενεργοποίηση καλαθιού Ajax για το front end.');
define('_msg_javascript_show_link','Αυτό θα δείξει το σύνδεσμο λήψης μετά από μια επιτυχή συναλλαγή για τη σελίδα σας ευχαριστώ.');
define('_msg_javascript45','Αυτό θα δείξει ένα μενού περιήγησης στην κεφαλίδα όλων των σελίδων.');
define('_msg_javascript46','Αυτή η επιλογή θα μεγεθύνει την εικόνα του άλμπουμ όταν ο χρήστης κάνει κλικ επάνω της.');

define('_msg_free_download','Δωρεάν Downloads');
define('_msg_go_to_download','Πήγαινε στα Download');
define('_msg_download_message','Για επιβεβαίωση ένας δεσμός λήψης περιέχεται παρακάτω');
define('_msg_download_message2','Το email σας προστέθηκε. Μπορείτε να κατεβάσετε τώρα δωρεάν κομμάτια.');

define('_msg_require_field', 'είναι υποχρεωτικό πεδίο.');
define('_msg_invalid_email', 'είναι μια άκυρη διεύθυνση ηλεκτρονικού ταχυδρομείου.');

define('_msg_no_download', 'Δεν είναι διαθέσιμο για λήψη.');

define('_msg_name', 'Όνομα');
define('_msg_email', 'Email');
define('_msg_submit', 'Υποβολή');
define('_msg_no_free', 'Δεν επέρχεται καμία δωρεάν λήψη αυτή τη στιγμή.');
define('_msg_must_provide', 'Πρέπει να εισάγετε μία έγκυρη διεύθυνση email για να μπορέσετε να κατεβάσετε ένα τραγούδι.');
define('_msg_theif', 'Προσπαθείτε να κάνετε λήψη ενός τραγουδιού το οποίο δεν διατίθεται δωρεάν !!!!!');

define('_msg_albumsnameAZ','Όνομα άλμπουμ A-Z');
define('_msg_albumsnameZA','Όνομα άλμπουμ Z-A');
define('_msg_artistAZ','Όνομα καλλιτέχνη A-Z');
define('_msg_artistZA','Όνομα καλλιτέχνη Z-A');

define('_msg_enlarge','Κάντε κλικ για Μεγέθυνση της εικόνας');

define('_msg_publichome5','Τελευταία άλμπουμ');
define('_msg_publichome6','Τελευταία τραγούδια');

define('_msg_backup','Αντίγραφα ασφαλείας πινάκων');
define('_msg_backup2','Έναρξη Αντιγράφου ασφαλείας');
define('_msg_backup3','<font style="color:red">Προσοχή!! Η εκτέλεση αυτού του αντιγράφου ασφαλείας θα αντικαταστήσει τα δεδομένα από όλα τα προηγούμενα αντίγραφα ασφαλείας.</font>');
define('_msg_backup4','<font style="color:green">Δημιουργία</font>');
define('_msg_backup5','Δημιουργήθηκε ένα σφάλμα κατά την λήψη του αντιγράφου ασφαλείας. Παρακαλώ χρησιμοποιήστε το PHPMyAdmin και πάρτε αντίγραφο ασφαλείας με το χέρι');
define('_msg_backup6','Το αντίγραφο ασφαλείας δημιουργήθηκε με επιτυχία');

define('_msg_import','Υπήρξε λάθος κατά την εισαγωγή των πινάκων');
define('_msg_import2','Οι πίνακες εισήχθησαν με επιτυχία');
define('_msg_error_bind','Πρόβλημα δέσμευσης');
define('_msg_error_check','Πρόβλημα στον έλεγχο');
define('_msg_error_store','Πρόβλημα αποθήκευσης');

define('_msg_csv','Εξαγωγή σε CSV');
define('_msg_csv_album','Κατά άλμπουμ');
define('_msg_csv_sale','Κατά Πώληση');

define('_msg_RM','RM Αριθμός');
define('_msg_UPC','UPC');

define('_msg_newsletter','Το Newsletter σύστημα δεν είναι εγκατεστημένο');
define('_msg_return_to','Επιστροφή στην προηγούμενη σελίδα');

define('_msg_append','Προσθήκη URL');
define('_msg_label','Ετικέτα');
define('_msg_javascript47','Αν οι προεπισκοπήσεις των τραγουδιών είναι στο root της ιστοσελίδας, μπορείτε να προσθέσετε το url για τον flash players.');

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
