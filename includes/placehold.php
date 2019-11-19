<?php
/*
 * ------------------------------------------------------------------------
 * Copyright (C) 2009 - 2013 The YouTech JSC. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: The YouTech JSC
 * Websites: http://www.smartaddons.com - http://www.cmsportal.net
 * ------------------------------------------------------------------------
*/
// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );
global $is_placehold;
global $placehold_size;

// Array param for cookie
$placehold_size = array (
    'listing' => '870x870/673512/673512',
    'article' => '870x870/673512/673512',
    'related_items'=>'555x390/673512/673512',
    'slideshow' => '1150x450/673512/673512',
    'latest_news' => '270x270/673512/673512',
    'popular' => '70x70/673512/673512',
    'featured_posts' => '230x180/673512/673512',
    'hot_stories' => '270x250/673512/673512',
    'video_box' => '270x150/673512/673512',
    'style1' => '70x70/673512/673512',
    'style2' => '130x80/673512/673512',
    'style3' => '170x120/673512/673512',
    'style4' => '270x180/673512/673512',
    'style5' => '270x180/673512/673512',
    'style6' => '70x70/673512/673512',
    'hightlight' => '428x300/673512/673512',
    'style_mega' => '270x130/673512/673512',
    'k2user' => '83x83/673512/673512',
    'k2cat' => '570x300/673512/673512',
    'k2cat2' => '170x120/673512/673512',
    'k2itemimgb' => '870x420/673512/673512',
    'img_ourblog' => '370x280/673512/673512',
	'k2_item' => '870x870/673512/673512',
	

);

$is_placehold = 1;

if (!function_exists ('yt_placehold') ) {
    function yt_placehold ($size = '100x100',$icon='0xe942', $alt = '', $title = '' ) {
        return '<img src="http://placehold.it/'.$size.'" alt = "'. $alt .'" title = "'. $title .'"/>';
    }
    function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]);
      }
      return $text;
    }
}
?>
