<?php
/**
 * @package		Maian Media
 * @subpackage	com_maianmedia
 * @copyright	Copyright (C) Are Times. All rights reserved.
 * @license		GNU/GPL
 * @author 		Arelowo Alao
 * @based on  	Maian Music v1.2 by David Bennet
 * @link		http://www.AreTimes.com
 * @link 		http://www.maianscriptworld.co.uk
 *
 * Maian Media is based on an open source script orginaly written by Maian Script World.
 * You must attribute the work in the manner specified by the author or licensor
 * (but not in any way that suggests that they endorse you or your use of the work).
 */
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


$uri =& JURI::getInstance();
$db =& JFactory::getDBO();

jimport( 'joomla.html.parameter' );

$skin = JRequest::getVar( 'skin');

$db->setQuery("SELECT * FROM #__m15_settings LIMIT 1");
$SETTINGS = $db->loadObject();

$templateXMLFile = JPATH_COMPONENT_SITE.DS.'templates'.DS.$skin.DS.'templateDetails.xml';

$objDOM = new DOMDocument();
$objDOM->load($templateXMLFile); //make sure path is correct

$node = $objDOM->getElementsByTagName("name");
$name = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

$node = $objDOM->getElementsByTagName("creationDate");
$creationDate = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

$node = $objDOM->getElementsByTagName("author");
$author = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

$node = $objDOM->getElementsByTagName("authorUrl");
$authorUrl = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

$node = $objDOM->getElementsByTagName("copyright");
$copyright = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

$node = $objDOM->getElementsByTagName("license");
$license = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

$node = $objDOM->getElementsByTagName("version");
$version = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

$node = $objDOM->getElementsByTagName("description");
$description = isset($node->item(0)->nodeValue)? $node->item(0)->nodeValue:'';

$description = explode("\n", $description);

jimport( 'joomla.application.component.view' );

jimport('joomla.html.pane');

//$bar =& new JToolBar( 'My Toolbar' );
//$bar->appendButton( 'Standard', 'save', 'Save', 'save', false );

$form_action = JRequest::getVar('form_action');

$is15 = strpos(JVERSION, "1.5") === false ? false:true;
$style='class="icon-32-save"';

if($is15 == false){
	$style='style="background-image: url('.$uri->root().'administrator/templates/bluestork/images/toolbar/icon-32-save.png);"';
}?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb"
	dir="ltr">
<head>
<link
	href="<?php echo $uri->root() ?>administrator/components/com_maianmedia/stylesheet.css"
	rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="templates/system/css/system.css"
	type="text/css" />
<link
	href="<?php echo $uri->root() ?>administrator/components/com_maianmedia/utilities/template/css/template.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo $uri->root() ?>administrator/components/com_maianmedia/utilities/template/css/icon.css"
	rel="stylesheet" type="text/css" />
<script type="text/javascript"
	src="<?php echo $uri->root() ?>administrator/components/com_maianmedia/js/request.js"></script>

<script type="text/javascript">
function frmSubmit() {
document.templateForm.submit();
}
</script>

</head>
<body id="minwidth-body">
<?php if (isset($form_action)){?>
	<dd>
		<h2 style="color: green">Settings Saved!</h2>
	</dd>
	<?php }?>
	<form id="adminForm" enctype="multipart/form-data"
		action="index.php?option=com_maianmedia&controller=settings&format=raw&task=updateParams"
		method="post" name="templateForm">

		<div class="m">
			<div class="toolbar" id="maian-toolbar">
				<table id="maian-toolbar-table" class="toolbar">
					<tr>
						<td class="button" id="maian-toolbar-save"><a href="#"
							onclick="javascript: frmSubmit()" class="toolbar"> <span
							<?php echo $style?> title="Save Record"> </span> <b>Save Settings</b>
						</a>
						</td>

					</tr>
				</table>
			</div>
		</div>
		<span id="madmin-top"> <b><?php echo $name; ?> </b><br /> <?php echo $author; ?><br />
			<a href="<?php echo $authorUrl; ?>"><?php echo $authorUrl; ?> </a><br />
			<?php
			foreach($description as $line){
				echo $line.'<br>
	';
			}
			?> </span>

		<fieldset style="background-color: #FFF" id="mm_adminform"
			class="adminform">
			<legend>
			<?php echo MaianText::_( _msg_header3); ?>
			</legend>


			<?php
			//$UI = new JParameter( $SETTINGS->extra_params, $templateXMLFile );
			//echo $UI->render( 'params' );
			echo $this->renderSettings($templateXMLFile, $SETTINGS->extra_params);
			?>

		</fieldset>
		<input type="hidden" name="form_action" value="submit" /> <input
			type="hidden" name="skin" value="<?php echo $skin; ?>" />
	</form>
</body>
</html>
