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
//No direct acesss
defined('_JEXEC') or die();

//importing default joomla components
jimport('joomla.application.component.model');

/*
 * HDFLV player Model class to save functions,fetch language settings while edit.
 */
class hdflvplayerModeleditlanguage extends HdflvplayerModel {

	//Function to fetch language details
	function editlanguagemodel()
	{
		$db = JFactory::getDBO();
		$showlanguage = array();
		
		//Fetch language settings details
		$query = 'SELECT id,player_lang FROM `#__hdflvplayerlanguage`';
		$db->setQuery( $query);
		$showlanguage = $db->loadObject();
		return $showlanguage;
	}

	//Function to store language details
	function savelanguagesetup($task)
	{
		global $option;
		$option 	= 'com_hdflvplayer';
		$langsettings 	= JTable::getInstance('hdflvplayerlanguage', 'Table');
		$langsettings->load();//to load the the record from table
                $settingsResult             = JRequest::get('post');
                $player_lang                = array(
                'pause'                      => strip_tags($settingsResult['pause']),
                'play'                      => strip_tags($settingsResult['play']),
                'replay'                    => strip_tags($settingsResult['replay']),
                'changequality'             => strip_tags($settingsResult['changequality']),
                'zoom'                      => strip_tags($settingsResult['zoom']),
                'zoomin'                    => strip_tags($settingsResult['zoomin']),
                'zoomout'                   => strip_tags($settingsResult['zoomout']),
                'share'                     => strip_tags($settingsResult['share']),
                'fullscreen'                => strip_tags($settingsResult['fullscreen']),
                'exitfullScreen'            => strip_tags($settingsResult['exitfullScreen']),
                'playlisthide'              => strip_tags($settingsResult['playlisthide']),
                'playlistview'              => strip_tags($settingsResult['playlistview']),
                'sharetheword'              => strip_tags($settingsResult['sharetheword']),
                'sendanemail'               => strip_tags($settingsResult['sendanemail']),
                'email'                     => strip_tags($settingsResult['email']),
                'to'                        => strip_tags($settingsResult['to']),
                'from'                      => strip_tags($settingsResult['from']),
                'note'                      => strip_tags($settingsResult['note']),
                'send'                      => strip_tags($settingsResult['send']),
                'copy'                      => strip_tags($settingsResult['copy']),
                'copylink'                  => strip_tags($settingsResult['copylink']),
                'copyembed'                 => strip_tags($settingsResult['copyembed']),
                'social'                    => strip_tags($settingsResult['social']),
                'quality'                   => strip_tags($settingsResult['quality']),
                'facebook'                  => strip_tags($settingsResult['facebook']),
                'googleplus'                => strip_tags($settingsResult['googleplus']),
                'tumblr'                    => strip_tags($settingsResult['tumblr']),
                'tweet'                     => strip_tags($settingsResult['tweet']),
                'turnoffplaylistautoplay'   => strip_tags($settingsResult['turnoffplaylistautoplay']),
                'turnonplaylistautoplay'    => strip_tags($settingsResult['turnonplaylistautoplay']),
                'adindicator'               => strip_tags($settingsResult['adindicator']),
                'skipadd'                   => strip_tags($settingsResult['skipadd']),
                'skipvideo'                 => strip_tags($settingsResult['skipvideo']),
                'download'                  => strip_tags($settingsResult['download']),
                'volume'                    => strip_tags($settingsResult['volume']),
                'mid'                       => strip_tags($settingsResult['mid']),
                'nothumbnail'               => strip_tags($settingsResult['nothumbnail']),
                'live'                      => strip_tags($settingsResult['live']),
                'fillrequiredfields'        => strip_tags($settingsResult['fillrequiredfields']),
                'wrongemail'                => strip_tags($settingsResult['wrongemail']),
                'emailwait'                 => strip_tags($settingsResult['emailwait']),
                'emailsent'                 => strip_tags($settingsResult['emailsent']),
                'notallow_embed'            => strip_tags($settingsResult['notallow_embed']),
                'youtube_ID_Invalid'        => strip_tags($settingsResult['youtube_ID_Invalid']),
                'video_Removed_or_private'  => strip_tags($settingsResult['video_Removed_or_private']),
                'streaming_connection_failed' => strip_tags($settingsResult['streaming_connection_failed']),
                'audio_not_found'           => strip_tags($settingsResult['audio_not_found']),
                'video_access_denied'       => strip_tags($settingsResult['video_access_denied']),
                'FileStructureInvalid'      => strip_tags($settingsResult['FileStructureInvalid']),
                'NoSupportedTrackFound'     => strip_tags($settingsResult['NoSupportedTrackFound']),
            );
        $settingsResult['player_lang'] = serialize($player_lang);

        if (!$langsettings->bind($settingsResult))
		{
			JError::raiseError(500, JText::_($langsettings->getError()));
		}
		
		//Save language settings into table.
		if (!$langsettings->store()) {
			JError::raiseError(500, JText::_($langsettings->getError()));
		}
		
		//set message with redirect link
		switch ($task)
		{
			case 'applylanguagesetup':
				$msg = 'Changes Saved';
				$link = 'index.php?option=' . $option .'&task=editlanguagesetup';
				break;
			case 'savelanguagesetup':
			default:
				$msg = 'Saved';
				$link = 'index.php?option=' . $option.'&task=languagesetup';
				break;
		}
		
		// page redirect
		JFactory::getApplication()->redirect($link, $msg);
	}
}
?>
