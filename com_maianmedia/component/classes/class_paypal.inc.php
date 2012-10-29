<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

Script: Maian Music v1.2
Written by: David Ian Bennett
E-Mail: support@maianscriptworld.co.uk
Website: http://www.maianscriptworld.co.uk

++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

This File: class_paypal.inc.php
Description: Paypal Process Class
Original code written by:
scriptdevelopers.net & Micah Carrick
Modified by: David Ian Bennett

++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

class paypalIPN extends genericOptions {

	var $paypal_post_vars;
	var $paypal_response;
	var $paypal_pdt;
	var $protocol;
	var $url_string;
	var $timeout;
	var $fields         = array();
	var $prefix;


	function __construct($paypal_post_vars,$settings,$protocol="s"){
		$this->paypal_post_vars = array();
		$this->paypal_post_vars  = $paypal_post_vars;
		$this->timeout           = 120;
		$this->url_string        = "http".$protocol.($settings->paypal_mode ? '://www.sandbox.paypal.com/cgi-bin/webscr?' : '://www.paypal.com/cgi-bin/webscr?');

		parent::__construct();
	}

	// Class Constructor..
	function paypalIPN($paypal_post_vars,$settings,$protocol="s") {
		$this->paypal_post_vars = array();
		$this->paypal_post_vars  = $paypal_post_vars;
		$this->timeout           = 120;
		$this->url_string        = "http".$protocol.($settings->paypal_mode ? '://www.sandbox.paypal.com/cgi-bin/webscr?' : '://www.paypal.com/cgi-bin/webscr?');
	}

	// Send data back to Paypal..
	function send_response() {
		foreach($this->paypal_post_vars AS $key => $value) {
			$values[] = $key.'='.urlencode($this->strip_slashes($value));
		}

		$this->url_string .= @implode("&", $values);
		$this->url_string .= "&cmd=_notify-validate";

		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $this->url_string);
		curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; www.ScriptDevelopers.NET; PayPal IPN Class)");
		curl_setopt ($ch, CURLOPT_HEADER, 1);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

		//WARNING: this would prevent curl from detecting a 'man in the middle' attack
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);

		// Prevent basedir & safe mode errors..
		if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		}

		curl_setopt ($ch, CURLOPT_TIMEOUT, $this->timeout);
		$this->paypal_response = curl_exec ($ch);
		curl_close($ch);
	}

	function send_pdt($tx, $it) {

		$ch = curl_init($this->url_string);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt ($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt ($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "&cmd=_notify-synch&tx=".$tx."&at=".$it);

		// Prevent basedir & safe mode errors..
		if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		}

		$lines = explode("\n", curl_exec ($ch));
		curl_close($ch);

		//if (strcmp ($lines[0], "SUCCESS") == 0) {
		for ($i=1; $i<count($lines);$i++){
			list($key,$val) = explode("=", $lines[$i]);
			$this->paypal_post_vars[urldecode($key)] = urldecode($val);
		}
		//}


		// return $this->paypal_post_vars;
	}

	// Was payment verified..
	function is_verified() {
		if(ereg("VERIFIED", $this->paypal_response)) {
			return true;
		} else {
			return false;
		}
	}

	// Returns payment status..
	function get_payment_status() {
		return $this->paypal_post_vars['payment_status'];
	}

	// Logs error messages..
	function error_out($message2,$subject,$subject2,$subject4,$log) {
		//global $mosConfig_absolute_path;
		$date     = date("D M j G:i:s T Y", time());
		$message  = '';
			
		$message .= $this->define_newline().$this->define_newline().$subject4.$this->define_newline().$this->define_newline();

		reset($this->paypal_post_vars);

		while(list($key,$value) = each($this->paypal_post_vars) ) {
			$message .= $key.':'." \t".$value.$this->define_newline();
		}

		$message .= $this->define_newline().$this->define_newline().$this->url_string.$this->define_newline().$this->define_newline().$this->paypal_response.$this->define_newline().$this->define_newline();
		$message .= $subject2;

		return $message;
	}

	// Assigns field array..
	function add_field($field,$value) {
		$this->fields[$field] = $value;
	}

	// Loads processing screen..
	function loadHiddenFields() {
		$html = '<form method="post" name="paypal_form" action="'.$this->url_string.'">';

		foreach ($this->fields AS $name => $value) {
			$html .= '<input type="hidden" name="'.$name.'" value="'.$this->strip_slashes($value).'" />'."\n";
		}

		$html .= '</form>';

		return $html;
	}

}

?>
