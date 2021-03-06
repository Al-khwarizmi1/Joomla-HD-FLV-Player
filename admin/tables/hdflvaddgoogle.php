<?php

/**
 * @name 	        hdflvplayer
 ** @version	        2.3
 * @package	        Apptha
 * @since	        Joomla 1.5
 * @subpackage	        hdflvplayer
 * @author      	Apptha - http://www.apptha.com/
 * @copyright 		Copyright (C) 2011 Powered by Apptha
 * @license 		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @abstract      	com_hdflvplayer installation file.
 ** @Creation Date	23 Feb 2011
 ** @modified Date	26 Nov 2014
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class Tablehdflvaddgoogle extends JTable
{
    var $id = null;
    var $code = null;
    var $showoption = null;
    var $closeadd = null;
    var $reopenadd = null;
    var $publish = null;
    var $ropen = null;
    var $showaddc = null;
    var $showaddm = null;
    var $showaddp = null;
    
    function __construct(&$db)
    {
        parent::__construct( '#__hdflvaddgoogle', 'id', $db );

    }
}

?>