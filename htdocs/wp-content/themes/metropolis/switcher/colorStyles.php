<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'wp-load.php');

$highlight_color = $_GET["_main_color"];
if( !empty($highlight_color) ) {
	thb_component("tpl-skin", array(
		"highlight_color" => $highlight_color,
		"slogan_color" => thb_get_option("_font_slogan_color"),
		"page_title" => thb_get_option("_font_pagetitle_color"),
		"page_subtitle" => thb_get_option("_font_pagesubtitle_color")
	));
}