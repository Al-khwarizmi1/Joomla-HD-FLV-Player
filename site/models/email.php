<?php
/**
 * @name 	        email.php
 ** @version	        2.3
 * @package	        Apptha
 * @since	        Joomla 1.5
 * @author      	Apptha - http://www.apptha.com/
 * @copyright 		Copyright (C) 2011 Powered by Apptha
 * @license 		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @abstract      	Contus HD FLV Player email file
 * @Creation Date	23 Feb 2011
 * @modified Date	26 Nov 2014
 */
## No direct acesss
defined('_JEXEC') or die();

## imports libraries
jimport('joomla.application.component.model');

/*
 * HDFLV player view class for email task in player
 */

class hdflvplayerModelemail extends HdflvplayerModel {

    function getemail() {

    	$referrer = parse_url( $_SERVER['HTTP_REFERER'] );
    	$referrer_host = $referrer['scheme'] . '://' . $referrer['host'];
    	$pageURL  = 'http';
    		
    	if (isset( $_SERVER['HTTPS'] )&& $_SERVER['HTTPS'] == 'on' ) {
    		$pageURL .= 's';
    	}

    	$pageURL .= '://';
    		
    	if ( $_SERVER['SERVER_PORT'] != '80' ) {
    		$pageURL .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
    	} else {
    		$pageURL .= $_SERVER['SERVER_NAME'];
    	}

    	ob_clean();

    	if($referrer_host === $pageURL ) {
	    	$to         = strip_tags(filter_var(JRequest::getVar('to', 'post'),FILTER_VALIDATE_EMAIL));
	        $from       = strip_tags(filter_var(JRequest::getVar('from', 'post'),FILTER_VALIDATE_EMAIL));
	        $url        = strip_tags(filter_var(JRequest::getVar('url', 'post'),FILTER_VALIDATE_URL));
	        $note       = strip_tags(JRequest::getVar('Note', '', 'post'));
	        $subject    = "You have received a video!";
	        $headers    = "From: " . "<" . $from . ">\r\n";
	        $message    = $note . "\n\n";
	        $message   .= "Video URL: " . $url;
	if(empty($to) || empty($from) || empty($note)) {
		echo "success=error";
		exit();
	}
	        if (mail($to, $subject, $message, $headers)) {
	            echo "success=sent";
	            $headers = "From: " . "<" . $to . ">\r\n";
	            $message = "Thank You ";
	            mail($from, $subject, $message, $headers);
	        } else {
	            echo "success=error";
	        }
  	  } else {
          echo "success=error";
      }
        exit();
    }
}