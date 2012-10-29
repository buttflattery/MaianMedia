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

$config =& JFactory::getConfig();
$config_tmp_path = rtrim($config->getValue('config.tmp_path'), '/');
$calculated_tmp_path = JPATH_ROOT . DS . 'tmp';

jimport( 'joomla.environment.uri' );

$uri =& JURI::getInstance();

$db =& JFactory::getDBO();

$db->setQuery("SELECT * FROM #__m15_settings");
$SETTINGS = $db->loadObject();

$download_path = $SETTINGS->mp3_path;
$preview_path = JPATH_SITE.$SETTINGS->preview_path;
?>


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
<script type="text/javascript"
	src="<?php echo $uri->root() ?>includes/js/joomla.javascript.js"></script>
<script type="text/javascript"
	src="<?php echo $uri->root() ?>administrator/components/com_maianmedia/js/mootools-1.2.4-core-yc.js"></script>
<script type="text/javascript"
	src="<?php echo $uri->root() ?>administrator/components/com_maianmedia/js/mootools.js"></script>
<script type="text/javascript"
	src="<?php echo $uri->root() ?>administrator/components/com_maianmedia/js/mif-tree-v1.2.6.js"></script>
<script type="text/javascript"
	src="<?php echo $uri->root() ?>administrator/components/com_maianmedia/js/request.js"></script>

<style type="text/css">
#tree_container {
	border: solid 1px #b4b4b4;
	position: relative;
	height: 300px;
	width: 200px;
}

/*@global*/
.mif-tree-wrapper {
	position: absolute;
	z-index: 100;
	width: 100%;
	height: 100%;
	margin: 0;
	padding: 0;
	overflow: auto;
	font-family: sans-serif;
	font-size: 11px;
	line-height: 18px; /******Tree node height******/
	white-space: nowrap;
	cursor: default;
}

.mif-tree-bg {
	width: 100%;
	height: 100%;
	position: absolute;
	overflow: hidden;
}

.mif-tree-bg-container {
	width: 100%;
	display: none;
}

.mif-tree-bg-node {
	width: 100%;
	height: 18px;
}

.mif-tree-bg-selected {
	background-color: #dcd7ab;
}

.mif-tree-wrapper:focus {
	outline: 0;
}

.mif-tree-wrapper span {
	padding-bottom: 2px;
	padding-top: 2px;
	cursor: inherit;
}

.mif-tree-children {
	padding-left: 18px;
	width: 18px;
}

.mif-tree-node {
	width: 18px;
	background: url('components/com_maianmedia/images/line.gif') repeat-y
		8px 0px;
}

.mif-tree-node-last {
	background: url('components/com_maianmedia/images/line.gif') no-repeat
		8px 0px;
}

.mif-tree-name {
	cursor: default;
	overflow: hidden;
	margin-left: 4px;
}

.mif-tree-name a {
	color: red;
}

.mif-tree-name a:hover {
	color: blue;
}

.mif-tree-node-wrapper {
	background: url('components/com_maianmedia/images/horizontal-line.gif')
		no-repeat 9px center;
}

/*@gadjets*/
.mif-tree-gadjet {
	background-image: url('components/com_maianmedia/images/gadjets.gif');
	padding-right: 16px;
	z-index: 1;
	overflow: hidden;
	background-repeat: no-repeat;
	cursor: default;
}

.mif-tree-gadjet-none {
	background: none;
}

.mif-tree-gadjet-minus {
	background-position: 0px 50%;
}

.mif-tree-gadjet-plus {
	background-position: -18px 50%;
}

.mif-tree-gadjet-hover .mif-tree-gadjet-minus {
	background-position: -54px 50%;
}

.mif-tree-gadjet-hover .mif-tree-gadjet-plus {
	background-position: -72px 50%;
}

/*@checkbox*/
.mif-tree-checkbox {
	padding-left: 18px;
	background-image: url('components/com_maianmedia/images/checkboxes.gif');
	background-repeat: no-repeat;
}

.mif-tree-node-checked {
	background-position: 0px center;
}

.mif-tree-node-unchecked {
	background-position: -18px center;
}

.mif-tree-node-nochecked {
	background-position: -108px center;
}

.mif-tree-hover-checkbox .mif-tree-node-checked {
	background-position: -36px center;
}

.mif-tree-hover-checkbox .mif-tree-node-unchecked {
	background-position: -54px center;
}

.mif-tree-node-partially {
	background-position: -72px center;
}

.mif-tree-hover-checkbox .mif-tree-node-partially {
	background-position: -90px center;
}

/*@icons*/
.mif-tree-icon {
	padding-right: 18px;
	background-position: 0 50%;
	background-repeat: no-repeat;
	cursor: inherit;
}

.mif-tree-open-icon {
	background-image: url('components/com_maianmedia/images/openicon.gif')
}

.mif-tree-close-icon {
	background-image: url('components/com_maianmedia/images/closeicon.gif')
}

.mif-tree-loader-open-icon,.mif-tree-loader-close-icon {
	background-image:
		url('components/com_maianmedia/images/mootree_loader.gif');
}

.mif-tree-file-open-icon,.mif-tree-file-close-icon {
	background: url('components/com_maianmedia/images/file.gif') no-repeat;
}

/*@selection*/
.mif-tree-node-selected .mif-tree-name {
	background-color: #010161;
	color: #fff;
}

.mif-tree-highlighter {
	height: 18px;
	overflow: hidden;
	width: 100%;
	background: #b64553;
	position: absolute;
}

/*@d'n'd*/
.mif-tree-pointer {
	height: 1px;
	overflow: hidden;
	position: absolute;
	background-image: url('components/com_maianmedia/images/images/1.gif');
	background-repeat: repeat-x;
	background-color: #292fef;
}

.mif-tree-ghost {
	background-color: #fff;
	border: solid 2px #e8e8f7;
	padding-left: 2px;
}

.mif-tree-ghost .mif-tree-node-wrapper {
	background: none;
}

.mif-tree-ghost span.mif-tree-text {
	padding-top: 1px;
	padding-bottom: 1px;
}

.mif-tree-ghost-icon {
	padding-left: 16px;
	background-color: #fff;
	background-repeat: no-repeat;
	background-image: url('components/com_maianmedia/images/dropzone.gif');
}

.mif-tree-ghost-after {
	background-position: -64px 2px;
}

.mif-tree-ghost-before {
	background-position: -48px 2px;
}

.mif-tree-ghost-between {
	background-position: -16px 2px;
}

.mif-tree-ghost-inside {
	background-position: -0px 2px;
}

.mif-tree-ghost-notAllowed {
	background-position: -32px 2px;
}

.mif-tree-drag-current {
	background-color: #cfcfd8;
}

.mif-tree-replace {
	background-color: #99c8fb;
}

/*@checkbox*/
.mif-tree-checkbox {
	padding-left: 18px;
}

.mif-tree-node-checked,.mif-tree-node-checked .mif-tree-checkbox {
	background: url('components/com_maianmedia/images/checked.gif') center
		2px no-repeat;
}

.mif-tree-node-unchecked,.mif-tree-node-unchecked .mif-tree-checkbox {
	background: url('components/com_maianmedia/images/unchecked.gif') center
		2px no-repeat;
}

.mif-tree-node-checked-selected {
	background: url('components/com_maianmedia/images/checked_selected.gif')
		center 2px no-repeat;
}

.mif-tree-node-unchecked-selected {
	background:
		url('components/com_maianmedia/images/unchecked_selected.gif') center
		2px no-repeat;
}

.mif-tree-hover-checkbox .mif-tree-node-checked {
	background: url('components/com_maianmedia/images/checked_selected.gif')
		center 2px no-repeat;
}

.mif-tree-hover-checkbox .mif-tree-node-unchecked {
	background:
		url('components/com_maianmedia/images/unchecked_selected.gif') center
		2px no-repeat;
}

/*@rename*/
.mif-tree-rename {
	display: inline;
	line-height: 14px;
	height: 14px;
	cursor: default;
	overflow: hidden;
	font-family: sans-serif;
	font-size: 11px;
	padding: 1px 0;
	border: solid 1px black;
}
</style>
<script type="text/javascript">

Mif.Tree.Node.implement({
	
	getPath: function(){
		var path=[];
		var node=this;
		while(node){
			path.push(node.name);
			node=node.getParent();
		}
		return path.reverse().join('/');
	}

});


var tree = new Mif.Tree({
	container: $('tree_container'),
	initialize: function(){
		this.initCheckbox('deps');
		new Mif.Tree.KeyNav(this);
		this.addEvent('nodeCreate', function(node){
			node.set({
				property:{
					id:	node.getPath()
				}
			});
		});
		var storage=new Mif.Tree.CookieStorage(this);
		this.addEvent('load', function(){
			storage.restore();
		}).addEvent('loadChildren', function(parent){
			storage.restore();
		});
	},
	types: {
		folder:{
			openIcon: 'mif-tree-open-icon',
			closeIcon: 'mif-tree-close-icon',
			loadable: true
		},
		file:{
			openIcon: 'mif-tree-file-open-icon',
			closeIcon: 'mif-tree-file-close-icon'
		},
		loader:{
			openIcon: 'mif-tree-loader-open-icon',
			closeIcon: 'mif-tree-loader-close-icon',
			DDnotAllowed: ['inside','after']
		}
	},
	dfltType:'folder'
});

function readFiles(){
tree.load({
	url: '<?php echo $uri->root() ?>administrator/index.php?option=com_maianmedia&task=tools&format=raw&tool=load_root&abs_path=<?=urlencode($download_path)?>'
});

tree.loadOptions=function(node){
	return {
		url: '<?php echo $uri->root() ?>administrator/index.php?option=com_maianmedia&task=tools&format=raw&tool=load_tree&abs_path=<?=urlencode($download_path)?>',
		data: {'abs_path': node.data.abs_path}
	};

	$('getChecked').addEvent('click', function(){
		var checked='';
		tree.getChecked().each(function(node){
			checked+='<input type="text" id="selected_'+node.name+'" name="selected_files[]" value="'+node.name+'"/>';
		});
		$('checked').innerHTML=checked;
	});
	
};

document.addEvent('keydown', function(event){
	if(event.key!='r') return;
	var node=tree.selected;
    if(!node) return;
    node.rename();
});
}
</script>
</head>
<body id="update-screen">
<?php if($this->calculated_tmp_path != $this->config_tmp_path){ ?>
	<p style="font-weight: bold; color: orange;">
		Warning: Potentially invalid temporary path.<br /> Configured path: <span
			style="font-weight: bold; color: black"><?php echo $this->config_tmp_path ?>
		</span><br /> Suggested path: <span
			style="font-weight: bold; color: black"><?php echo $this->calculated_tmp_path ?>
		</span>
	</p>
	<?php }else{?>
	<div class="button2-right">
		<div class="start">
			<a
				href="javascript:ajaxRequest('run_download', 'index.php?option=com_maianmedia&amp;task=tools&amp;format=raw&amp;tool=run_download', 1)"
				title="Start" onclick="">Download Zip</a>
		</div>
	</div>
	<?php }?>
	<p>If you have a proxy server you will need to enter your details
		below. If you are unable to update try again or perform a manual
		update by backing up your tables.</p>
	<fieldset id="config">
		<legend>Configuration</legend>

		<table id="config-table" class="paramlist admintable" cellspacing="1">
			<tr>
				<td width="40%" class="paramlist_key"><span class="editlinktip"><label
						id="paramsproxy_host-lbl" for="paramsproxy_host" class="hasTip"
						title="Proxy hostname::Hostname of the proxy server">Proxy
							hostname</label> </span></td>
				<td class="paramlist_value"><input type="text"
					name="params[proxy_host]" id="paramsproxy_host" value=""
					class="text_area" /></td>
			</tr>
			<tr>
				<td width="40%" class="paramlist_key"><span class="editlinktip"><label
						id="paramsproxy_port-lbl" for="paramsproxy_port" class="hasTip"
						title="Proxy port::Port of the proxy server">Proxy port</label> </span>
				</td>
				<td class="paramlist_value"><input type="text"
					name="params[proxy_port]" id="paramsproxy_port" value=""
					class="text_area" /></td>
			</tr>
			<tr>
				<td width="40%" class="paramlist_key"><span class="editlinktip"><label
						id="paramsproxy_user-lbl" for="paramsproxy_user" class="hasTip"
						title="Proxy username::Username for proxy servers that require authentication. Authentication is disabled if left blank">Proxy
							username</label> </span></td>

				<td class="paramlist_value"><input type="text"
					name="params[proxy_user]" id="paramsproxy_user" value=""
					class="text_area" /></td>
			</tr>
			<tr>
				<td width="40%" class="paramlist_key"><span class="editlinktip"><label
						id="paramsproxy_pass-lbl" for="paramsproxy_pass" class="hasTip"
						title="Proxy password::Password for proxy servers taht require authentication. This is ignored if the username is left blank">Proxy
							password</label> </span></td>
				<td class="paramlist_value"><input type="password"
					name="params[proxy_pass]" id="paramsproxy_pass" value=""
					class="text_area" /></td>
			</tr>
		</table>
	</fieldset>

	<div id="run_download"></div>
	<br><br>

			<fieldset id="file_tree">
				<legend>File Tree</legend>
				<div id="tree_container"></div>
			</fieldset>

			<div id="checked"></div>

</body>
</html>
