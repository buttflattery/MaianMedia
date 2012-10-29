# Maian Media for Joomla

Maian-Media is a Joomla integration of Maian Music originally written by Maian Script World. It is currently only available as a Joomla component with corresponding modules and plugins. 
The purpose of this project to to decouple some of the Joomla functions and allow the script to be run in multiple modes such as stand alone and eventually WordPress.

-----------------------

List of requirements for the Final project submission:

### Using the componet in Joomla

Download the folder com_maianmedia into a zip file.  You can then use this for the installer in Joomla.

### Maian Templates

To protect your template changes from upgrades you are encouraged to duplicate and rename the classic or contemporary folders in the template directory.  If you are updating from a previous version of Maian Media/Music that does not have the template functionality you should setup and test on a different instance of Joomla.  The mapping between older versions and the current structure are as follows.
tempalte_name
|_assets
   |_css     <---------------> views/mm_stylesheet.css and rss_style.css
   |_media
     |_cart              <---------------> media\cart (Folder)
     |_icons    <---------------> media\icons (Folder)
|_email      <---------------> html\email (Folder)
|_pages     <----------------> html (All Files in base folder)
|_paypal    <---------------> html \paypal (Folder)
|_tpl      <---------------> html \tpl (Folder)
 
The files that control the template are as follows:
|_helper.php      <---------------> Add Helper Functions for your template here.
|_templateDetails.xml     <---> Add Parameters for your template here.
|_view.html.php     <---> Main functions that render the different views.
 
If you have some knowledge of PHP then you can create functions in the helper.php and call them from the browser with the following url.
http://yoursite.com/index.php?option=com_maianmedia&view=yourfunction
 
You can also call the functions from the parent helper class (inc/helper.php) using the following syntax:
echo $this->getTracks();

### Maian Players
 Players are required to have a player.php and playerDetails.xml.  The folder MUST match the Class name of the player that you are creating and extend the MaianPlayer class.  Your class must also gall the getplayer function.
 Use one of the exiting player to get an idea of how the players are created.