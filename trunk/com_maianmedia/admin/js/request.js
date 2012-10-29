var xmlHttp
var componet = "com_maianmedia";
var imgSrc = "\'components/com_maianmedia/js/loader.gif\'";
var params = "";
var element = "";
var isRunModal = false;

var mp3path = "";
var previewpath = "";
var sessionid = "";
var sessionname = "";
var assets = "";
var managerLang = "";
var global_id = "";

function ajaxRequest(div, url, gif, mp3, pre, sess, count, lang) {
	xmlHttp = GetXmlHttpObject();

	element = div;
	mp3path = mp3;
	previewpath = pre;
	sessionid = sess;
	assets = count;
	managerLang = lang;

	if (xmlHttp == null) {
		alert("Browser does not support HTTP Request");
		return

		

	}
	if (element == "run_update") {

		var checked = '';
		tree.getChecked().each(
				function(node) {
					checked += '<input type="hidden" id="selected_' + node.name
							+ '" name="selected_files[]" value="'
							+ node.getPath() + '"/>';
				});
		$('run_update').innerHTML = checked;

	}
	var arr = getElementsByName_iefix("input");

	for (i = 0; i < arr.length; i++) {

		if (i == 0) {
			params = arr[i].name + " = " + arr[i].value;
		} else {
			if (arr[i].name == "active_cart_search" && getCheckedValue(arr[i]) != '') {
				
				params = params + "&active_cart =" + getCheckedValue(arr[i]);
			}else{
				params = params + "&" + arr[i].name + " = " + arr[i].value;
			}
		}

		if (arr[i].name == "runModal") {
			isRunModal = true;
		}

	}// end for

	var sel = getElementsByName_iefix("select");

	for (i = 0; i < sel.length; i++) {

		if (params.length == 0) {
			params = sel[i].name + " = " + sel[i].value;
		} else {
			params = params + "&" + sel[i].name + " = " + sel[i].value;
		}

	}// end for

	//url = url + "&" + params + "&sid=" + Math.random();
	url = url + "&sid=" + Math.random();
	if (gif == 1) {
		document.getElementById(div).innerHTML = "<div height='30px' width='85px'><img src="
				+ imgSrc
				+ "style=\'display:block;margin: 0 auto;\' alt=\'Loading data...\'/></div>";
	}
	xmlHttp.onreadystatechange = loadResponse;
	xmlHttp.open("POST", url, true);

	// Send the proper header information along with the request
	xmlHttp.setRequestHeader("Content-type",
			"application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");

	xmlHttp.send(params);

	if (isRunModal == true) {
		runModal();
		// window.setTimeout('runModal()', 500);
	}
	// runModal();

}

function loadResponse() {
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
		var parentElement = document.getElementById(element);
		// alert(element);
		try {
			document.getElementById(element).innerHTML = xmlHttp.responseText;
		} catch (e) {
			// IE fails unless we wrap the string in another element.
			var wrappingDiv = document.createElement('div');
			wrappingDiv.innerHTML = xmlHttp.responseText;
			if(parentElement != null)
			parentElement.appendChild(wrappingDiv);
			// alert(element);
			// alert(xmlHttp.responseText);
		}

		if (isRunModal == true) {
			runModal();
			// window.setTimeout('runModal()', 500);
		}

		if (element == "run_download") {
			// document.getElementById('tree_container').innerHTML="";
			readFiles();

		}

		if (element == "tracks") {
			loadManager();
		}

	}
}

function GetXmlHttpObject() {
	var xmlHttp = null;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp = new XMLHttpRequest();
	} catch (e) {
		// Internet Explorer
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}// end catch
	}// end try
	return xmlHttp;
}

function getElementsByName_iefix(tag) {
	var elem = document.getElementsByTagName(tag);
	var arr = new Array();
	for (i = 0, iarr = 0; i < elem.length; i++) {
		// att = elem[i].getAttribute("name");
		// if(att == name) {
		arr[iarr] = elem[i];
		iarr++;
		// }
	}
	return arr;
}

function runModal() {
	window.addEvent('domready', function() {

		SqueezeBox.initialize( {});

		$$('a.modal-button').each(function(el) {
			el.addEvent('click', function(e) {
				new Event(e).stop();
				SqueezeBox.fromElement(el);
			});
		});
	});

	window.addEvent('domready', function() {

		SqueezeBox.initialize( {});

		$$('a.modal').each(function(el) {
			el.addEvent('click', function(e) {
				new Event(e).stop();
				SqueezeBox.fromElement(el);
			});
		});
	});

}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function setGlobal(el, count){
	
	global_id = el.substring(count, el.length);
}

function loadManager() {

	window.addEvent('domready', function() {

		var i = 0;
		var el;

		for (i = 0; i < assets; i++) {
			
			var complete_mp3 = function(path, file) {
				
				var el = $('mp3_path_'+global_id);

				var el_n = $('track_name_'+global_id);
				var el_l = $('track_length_'+global_id);

				el.set('value', '');
				el.set('value', path.substring(path.indexOf('/')+1));
				
				if(file.mime == "audio/mpeg"){
					el_l.set('value', file.mp3_length);
					el_n.set('value', file.mp3_title);
				}
				
			};
			
			var complete_preview = function(path, file) {

				var el_p = $('preview_path_'+global_id);
				
				el_p.set('value', '');
				el_p.set('value', path.substring(path.indexOf('/')+1));

			};

			var downloadmanager = new FileManager( {
				url : 'components/com_maianmedia/utilities/filemanager/manager.php?path='
						+ mp3path + '&sessionid=' + sessionid,
				assetBasePath : 'components/com_maianmedia/utilities/filemanager/Assets',
				language : managerLang,
				uploadAuthData : {
					session : sessionid
				},
				absolutePath: mp3path,
				selectable : true,
				onComplete : complete_mp3
			});

			var previewmanager = new FileManager( {
				url : 'components/com_maianmedia/utilities/filemanager/manager.php?path='
						+ previewpath + '&sessionid=' + sessionid,
				assetBasePath : 'components/com_maianmedia/utilities/filemanager/Assets',
				language : managerLang,
				uploadAuthData : {
					session : sessionid
				},
				absolutePath: previewpath,
				selectable : true,
				onComplete : complete_preview
			});

			$('mp3_manager_'+i).addEvents({
				'click':downloadmanager.show.bind(downloadmanager),
				 'mouseenter':function() {setGlobal(this.id, 12);}
			});
			
			$('preview_manager_'+i).addEvents({
				'click':previewmanager.show.bind(previewmanager),
				 'mouseenter':function() {setGlobal(this.id, 16);}
			});

		}
	});

}
