<?php
/**
 * @name 	        playersettings.php
 ** @version	        2.3
 * @package	        Apptha
 * @since	        Joomla 1.5
 * @author      	Apptha - http://www.apptha.com/
 * @copyright 		Copyright (C) 2011 Powered by Apptha
 * @license 		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @abstract      	Contus HD FLV Player settings model file
 * @Creation Date	23 Feb 2011
 * @modified Date	26 Nov 2014
 */
## No direct acesss
defined('_JEXEC') or die();

## importing defalut joomla components
jimport('joomla.application.component.model');

## importing defalut joomla file system libraries
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

/*
 * HDFLV player Model class to change/show player settings
 */

class hdflvplayerModelplayersettings extends HdflvplayerModel {

    ## Fetch player settings
    function playersettingsmodel() {
        $db = JFactory::getDBO();

        ## Query to display player settings
        $query = 'SELECT `id`, `published`, `logopath`,`player_icons` , `player_colors`, `player_values` FROM `#__hdflvplayersettings`';
        $db->setQuery($query);
        $settingResult = $db->loadObject();

        ##  Get player settings from table
        return($settingResult);
    }

    ## Save player settings
    function saveplayersettings($task) {
        $option                     = 'com_hdflvplayer';
        $db                         = JFactory::getDBO();
        $rs_savesettings            = JTable::getInstance('hdflvplayer', 'Table');

        ## Loads record from table
        $cid                        = JRequest::getVar('cid', array(0), '', 'array');
        $id                         = intVal($cid[0]);
        $rs_savesettings->load($id);

        $settingsResult             = JRequest::get('post');

        ## Get Player colors and serialize data
        $player_color               = array(
            'sharepanel_up_BgColor'     => strip_tags($settingsResult['sharepanel_up_BgColor']),
            'sharepanel_down_BgColor'   => strip_tags($settingsResult['sharepanel_down_BgColor']),
            'sharepaneltextColor'       => strip_tags($settingsResult['sharepaneltextColor']),
            'sendButtonColor'           => strip_tags($settingsResult['sendButtonColor']),
            'sendButtonTextColor'       => strip_tags($settingsResult['sendButtonTextColor']),
            'textColor'                 => strip_tags($settingsResult['textColor']),
            'skinBgColor'               => strip_tags($settingsResult['skinBgColor']),
            'seek_barColor'             => strip_tags($settingsResult['seek_barColor']),
            'buffer_barColor'           => strip_tags($settingsResult['buffer_barColor']),
            'skinIconColor'             => strip_tags($settingsResult['skinIconColor']),
            'pro_BgColor'               => strip_tags($settingsResult['pro_BgColor']),
            'playButtonColor'           => strip_tags($settingsResult['playButtonColor']),
            'playButtonBgColor'         => strip_tags($settingsResult['playButtonBgColor']),
            'playerButtonColor'         => strip_tags($settingsResult['playerButtonColor']),
            'playerButtonBgColor'       => strip_tags($settingsResult['playerButtonBgColor']),
            'relatedVideoBgColor'       => strip_tags($settingsResult['relatedVideoBgColor']),
            'scroll_barColor'           => strip_tags($settingsResult['scroll_barColor']),
            'scroll_BgColor'            => strip_tags($settingsResult['scroll_BgColor'])
        );
        $settingsResult['player_colors'] = serialize($player_color);
        
        ## Get Player values and serialize data
        $player_values                  = array(
            'buffer'                    => strip_tags($settingsResult['buffer']),
            'width'                     => strip_tags($settingsResult['playerwidth']),
            'height'                    => strip_tags($settingsResult['playerheight']),
            'normalscale'               => strip_tags($settingsResult['normalscale']),
            'fullscreenscale'           => strip_tags($settingsResult['fullscreenscale']),
            'volume'                    => strip_tags($settingsResult['volume']),
            'ffmpegpath'                => strip_tags($settingsResult['ffmpegpath']),
            'stagecolor'                => strip_tags($settingsResult['stagecolor']),
            'licensekey'                => strip_tags($settingsResult['licensekey']),
            'logourl'                   => strip_tags($settingsResult['logourl']),
            'logoalpha'                 => strip_tags($settingsResult['logoalpha']),
            'logoalign'                 => strip_tags($settingsResult['logoalign']),
            'adsSkipDuration'           => strip_tags($settingsResult['adsSkipDuration']),
            'googleanalyticsID'         => strip_tags($settingsResult['googleanalyticsID']),
            'midbegin'                  => strip_tags($settingsResult['midbegin']),
            'midinterval'               => strip_tags($settingsResult['midinterval']),
            'related_videos'            => strip_tags($settingsResult['related_videos']),
            'relatedVideoView'          => strip_tags($settingsResult['relatedVideoView']),
            'nrelated'                  => strip_tags($settingsResult['nrelated']),
            'urllink'                   => strip_tags($settingsResult['urllink'])
        );
        $settingsResult['player_values'] = serialize($player_values);
        
        ## Get player icon options and serialize data
        $player_icons                   = array(
            'autoplay'                  => strip_tags($settingsResult['autoplay']),
            'playlist_autoplay'         => strip_tags($settingsResult['playlist_autoplay']),
            'playlist_open'             => strip_tags($settingsResult['playlist_open']),
            'skin_autohide'             => strip_tags($settingsResult['skin_autohide']),
            'fullscreen'                => strip_tags($settingsResult['fullscreen']),
            'zoom'                      => strip_tags($settingsResult['zoom']),
            'timer'                     => strip_tags($settingsResult['timer']),
            'shareurl'                  => strip_tags($settingsResult['shareurl']),
            'email'                     => strip_tags($settingsResult['email']),
            'volumevisible'             => strip_tags($settingsResult['volumevisible']),
            'progressbar'               => strip_tags($settingsResult['progressbar']),
            'hddefault'                 => strip_tags($settingsResult['hddefault']),
            'imageDefault'              => strip_tags($settingsResult['imageDefault']),
            'download'                  => strip_tags($settingsResult['download']),
            'prerollads'                => strip_tags($settingsResult['prerollads']),
            'postrollads'               => strip_tags($settingsResult['postrollads']),
            'imaAds'                    => strip_tags($settingsResult['imaAds']),
            'adsSkip'                   => strip_tags($settingsResult['adsSkip']),
            'midrollads'                => strip_tags($settingsResult['midrollads']),
            'midadrotate'               => strip_tags($settingsResult['midadrotate']),
            'midrandom'                 => strip_tags($settingsResult['midrandom']),
            'title_ovisible'            => strip_tags($settingsResult['title_ovisible']),
            'description_ovisible'      => strip_tags($settingsResult['description_ovisible']),
            'showTag'                   => strip_tags($settingsResult['showTag']),
            'viewed_visible'            => strip_tags($settingsResult['viewed_visible']),
            'embedcode_visible'         => strip_tags($settingsResult['embedcode_visible']),
            'playlist_dvisible'         => strip_tags($settingsResult['playlist_dvisible']),
        );
        $settingsResult['player_icons'] = serialize($player_icons);
        
        ## Binds the given input fields with table columns
        if (!$rs_savesettings->bind($settingsResult)) {
            JError::raiseError(500, JText::_($rs_savesettings->getError()));
        }

        ## Stores the given input in appropriate fields in the table
        if (!$rs_savesettings->store()) {
            JError::raiseError(500, JText::_($rs_savesettings->getError()));
        }

        ## Uploads logo file
        $file                           = strip_tags(JRequest::getVar('logopath', null, 'files', 'array'));
        $logo_name                      = JFile::makeSafe($file['name']);
        $src                            = $file['tmp_name'];            ## Getting source path to upload
        $exts                           = JFile::getExt($logo_name);    ## Getting extension of file to upload


        if ($logo_name != '') {
            $vpath                      = VPATH . '/';
            $target_path_logo           = $vpath . $logo_name;

            ##  Validation for logopath extensions
            if (($exts != "png") && ($exts != "gif") && ($exts != "jpeg") && ($exts != "jpg")) { ##  To check file type
                JError::raiseWarning(406, JText::_('File Extensions:Allowed Extensions for image file is .jpg,.jpeg,.png'));
            }

            ##  To store images to a directory called components/com_hdflvplayer/videos
            else if (JFile::upload($src, $target_path_logo)) {
                $query = 'UPDATE #__hdflvplayersettings SET logopath=\'' . $logo_name . '\'';
                $db->setQuery($query);
                $db->query();
            }
        }

        ## After changes, redirect based on task.
        switch ($task) {
            case 'applyplayersettings':
                $msg    = 'Changes Saved';
                $link   = 'index.php?option=' . $option . '&task=editplayersettings&cid[]=' . $rs_savesettings->id;
                break;
            case 'saveplayersettings':
            default:
                $msg    = 'Saved';
                $link   = 'index.php?option=' . $option . '&task=playersettings';
                break;
        }

        ##  page redirect
        JFactory::getApplication()->redirect($link, $msg);
    }

}
?>