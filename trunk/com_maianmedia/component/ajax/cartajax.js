var req;
var elementToUpdate;
var imgLoad= "\'components/com_maianmedia/ajax/ajax-loader.gif\'";
var updating = 0; 
var xmlHttp
var componet = "com_maianmedia";
var element = "";

function updateCart(url, nameOfFormToPost, elementId) {
	if(updating == 0){
		updating = 1;
		changeCart(url, nameOfFormToPost, elementId);
	}
}

function changeCart(url, nameOfFormToPost, elementId) {

	// get the (form based) params to push up as part of the get request
	// url = url + getFormAsString(nameOfFormToPost);
	//var requestParams = getFormAsString(nameOfFormToPost);
	var requestParams = "";
	elementToUpdate = elementId;
	
	// Do the Ajax call
	if (window.XMLHttpRequest) { // Non-IE browsers
		req = new XMLHttpRequest();
		req.onreadystatechange = processStateChange;
		try {
			req.open("POST", url, true);
			req.setRequestHeader("Content-Type",
					"application/x-www-form-urlencoded");
		} catch (e) {
			alert("Problem Communicating with Server\n" + e);
		}
	
		req.send(requestParams);
					
	} else if (window.ActiveXObject) { // IE

		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processStateChange;
			req.open("POST", url, true);
			req.setRequestHeader("Content-Type",
					"application/x-www-form-urlencoded");
			req.send(requestParams);
			
		}
	}

	document.getElementById(elementId).innerHTML="<span id='ajax-loader'></span>";
}

function refreshCart(task, elementId) {

	//if(task == 'total'){
		updating = 0;
	//}
	
	// get the (form based) params to push up as part of the get request
	var url = 'index.php?option=com_maianmedia&format=raw&section=cart&task=updateCart&update='+task;
	//var requestParams = getFormAsString(nameOfFormToPost);
	var requestParams = "";
	elementToUpdate = elementId;
	//document.getElementById(elementId).innerHTML="<img src="+imgLoad+"style=\'display:block;margin: 0 auto;\' alt=\'Updating ...\'/>";
	// Do the Ajax call
	if (window.XMLHttpRequest) { // Non-IE browsers
		req = new XMLHttpRequest();
		req.onreadystatechange = processRefreshChange;
		try {
			req.open("POST", url, true);
			req.setRequestHeader("Content-Type",
					"application/x-www-form-urlencoded");
		} catch (e) {
			alert("Problem Communicating with Server\n" + e);
		}
		req.send(requestParams);
	} else if (window.ActiveXObject) { // IE

		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processRefreshChange;
			req.open("POST", url, true);
			req.setRequestHeader("Content-Type",
					"application/x-www-form-urlencoded");
			req.send(requestParams);
		}
	}
}

function processStateChange() {
	if (req.readyState == 4) { // Complete
		if (req.status == 200) { // OK response
			replaceExistingWithNewHtml(req.responseText);
			
			window.setTimeout("refreshCart('count', 'mm_cart')", 250);
			//window.setTimeout("refreshCart('total', 'cart_total')", 1000);
		} else {
			alert("Problem with server response:\n " + req.statusText);
		}
	}
}

function processRefreshChange() {
	if (req.readyState == 4) { // Complete
		if (req.status == 200) { // OK response
			replaceExistingWithNewHtml(req.responseText);
			
		} else {
			alert("Problem with server response:\n " + req.statusText);
		}
	}
}

function getFormAsString(formName) {
	// Setup the return String
	returnString = "";

	// Get the form values
	formElements = document.forms[formName].elements;

	for ( var i = formElements.length - 1; i >= 0; --i) {
		// we escape (encode) each value
		returnString = returnString + "&" + escape(formElements[i].name) + "="
				+ escape(formElements[i].value);
	}

	// return the values
	return returnString;
}

function replaceExistingWithNewHtml(newTextElement) {
	if (newTextElement != null && trim(newTextElement).length > 0) {
		document.getElementById(elementToUpdate).innerHTML = newTextElement;
	}
}

function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g, "");
}

function isAjaxSupported() {
	var req;

	try {
		// NON-IE
		req = new XMLHttpRequest();
	} catch (e) {
		try {
			// IE 6.0+
			req = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				// IE 5.5+
				req = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// alert('outdated browser');
				return false;
			}
		}
	}

	return true;
}

function ajaxRequest(div, url, gif){ 
	xmlHttp=GetXmlHttpObject()
	
	var params = "";
	element = div;
	
	if (xmlHttp==null)
 	{
 		alert ("Browser does not support HTTP Request");
 		return
 	}
	//alert(document.getElementsByTagName("input"));
	//alert(getElementsByName_iefix("input"));
	//var arr=Array.prototype.slice.call(document.getElementsByTagName("input"));
	var arr = getElementsByName_iefix("input");
	
	for (i=0; i<arr.length;i++) {
	
		if(i==0){
			params = arr[i].name+" = "+arr[i].value;
		}else{
			params = params+"&"+arr[i].name+" = "+arr[i].value;
		}
		
		if(arr[i].name == "runModal"){
			isRunModal = true;
		}

	}//end for
	
	var sel = getElementsByName_iefix("select");
	
	for (i=0; i<sel.length;i++) {
	
		if(params.length==0){
			params = sel[i].name+" = "+sel[i].value;
		}else{
			params = params+"&"+sel[i].name+" = "+sel[i].value;
		}

	}//end for
	

	url=url+"&"+params+"&sid="+Math.random();
	if(gif==1){
		document.getElementById(div).innerHTML="<div height='30px' width='85px'><img src="+imgLoad+"style=\'display:block;margin: 0 auto;\' alt=\'Loading ...\'/></div>";
		}
	xmlHttp.onreadystatechange=loadResponse;
	xmlHttp.open("POST",url,true);
	
	//Send the proper header information along with the request
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");
	
	xmlHttp.send(params);
	
}

function loadResponse() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		var parentElement = document.getElementById(element);
		//alert(element);
		try {
			document.getElementById(element).innerHTML=xmlHttp.responseText;
		}catch (e) {
		     // IE fails unless we wrap the string in another element.
			var wrappingDiv = document.createElement('div');
		     wrappingDiv.innerHTML = xmlHttp.responseText;
		     parentElement.appendChild(wrappingDiv);

		}
		
	} 
}

function GetXmlHttpObject()
{
	var xmlHttp=null;
	try {
			// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}catch (e) {
		//Internet Explorer
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e) {
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}//end catch
	}//end try
	return xmlHttp;
}


function getElementsByName_iefix(tag) {          
	var elem = document.getElementsByTagName(tag);     
	var arr = new Array();     
	for(i = 0,iarr = 0; i < elem.length; i++) {          
		//att = elem[i].getAttribute("name");          
		//if(att == name) {               
			arr[iarr] = elem[i];               
			iarr++;          
		//}     
	}     
	return arr;
}