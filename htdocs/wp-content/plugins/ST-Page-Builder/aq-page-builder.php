<?php
/** بسم الله الرحمن الرحيم **

Plugin Name: Aqua Page Builder
Plugin URI: http://aquagraphite.com/page-builder
Description: Easily create custom page templates with intuitive drag-and-drop interface. Requires PHP5 and WP3.5
Version: 1.1.2
Author: Syamil MJ
Author URI: http://aquagraphite.com

*/
 
/**
 * Copyright (c) 2013 Syamil MJ. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */

//definitions
if(!defined('AQPB_VERSION')) define( 'AQPB_VERSION', '1.1.2' );
if(!defined('AQPB_PATH')) define( 'AQPB_PATH', plugin_dir_path(__FILE__) );
if(!defined('AQPB_DIR')) define( 'AQPB_DIR', plugin_dir_url(__FILE__) );

//required functions & classes
require_once(AQPB_PATH . 'functions/aqpb_config.php');
require_once(AQPB_PATH . 'functions/aqpb_blocks.php');
require_once(AQPB_PATH . 'classes/class-aq-page-builder.php');
require_once(AQPB_PATH . 'classes/class-aq-block.php');
//require_once(AQPB_PATH . 'classes/class-aq-plugin-updater.php');
require_once(AQPB_PATH . 'functions/aqpb_functions.php');

//some default blocks
require_once(AQPB_PATH . 'blocks/st-text-block.php');
//require_once(AQPB_PATH . 'blocks/aq-richtext-block.php'); //buggy
//require_once(AQPB_PATH . 'blocks/st-clear-block.php');
require_once(AQPB_PATH . 'blocks/st-widgets-block.php');
require_once(AQPB_PATH . 'blocks/st-alert-block.php');
require_once(AQPB_PATH . 'blocks/st-tabs-block.php');

require_once(AQPB_PATH . 'blocks/st-section-block.php');
require_once(AQPB_PATH . 'blocks/st-row-block.php');
//require_once(AQPB_PATH . 'blocks/st-banner-block.php');
//require_once(AQPB_PATH . 'blocks/st-testimonials-block.php');
//require_once(AQPB_PATH . 'blocks/st-contact-block.php');
require_once(AQPB_PATH . 'blocks/st-partner-block.php');
require_once(AQPB_PATH . 'blocks/st-ourprocess-block.php');
require_once(AQPB_PATH . 'blocks/st-ourfact-block.php');
//require_once(AQPB_PATH . 'blocks/st-about-block.php');
//require_once(AQPB_PATH . 'blocks/st-team-block.php');
//require_once(AQPB_PATH . 'blocks/st-portfolio-block.php');
require_once(AQPB_PATH . 'blocks/st-timeline-block.php');
//require_once(AQPB_PATH . 'blocks/st-services-block.php');
//require_once(AQPB_PATH . 'blocks/st-pricetable-block.php');

require_once(AQPB_PATH . 'blocks/st-chart-block.php');
require_once(AQPB_PATH . 'blocks/st-post-block.php');
//require_once(AQPB_PATH . 'blocks/st-map-block.php');
require_once(AQPB_PATH . 'blocks/st-slideshow-block.php');
//require_once(AQPB_PATH . 'blocks/st-cta-block.php');
require_once(AQPB_PATH . 'blocks/st-twitter-block.php');
//require_once(AQPB_PATH . 'blocks/st-number-block.php');
//require_once(AQPB_PATH . 'blocks/st-letwork-block.php');



//register default blocks
//aq_register_block('ST_Text_Block');
//aq_register_block('ST_Richtext_Block'); //buggy
//aq_register_block('ST_Clear_Block');
aq_register_block('ST_Widgets_Block');
aq_register_block('ST_Alert_Block');
aq_register_block('ST_Tabs_Block');

aq_register_block('ST_Row_Block');
aq_register_block('ST_Row_Col_Block');
//aq_register_block('ST_Banner_Block');
//aq_register_block('ST_About_Block');
aq_register_block('ST_Timeline_Block');
//aq_register_block('ST_Team_Block');
aq_register_block('ST_Ourfacts_Block');
//aq_register_block('ST_Services_Block');
aq_register_block('ST_Ourprocess_Block');
//aq_register_block('ST_Portfolio_Block');
aq_register_block('ST_Partner_Block');
//aq_register_block('ST_Testimonials_Block');
//aq_register_block('ST_Price_Table_Block');
//aq_register_block('ST_Contact_Block');
aq_register_block('ST_Post_Block');
aq_register_block('ST_Chart_Block');
//aq_register_block('ST_Map_Block');
aq_register_block('ST_Slide_Show_Block');
aq_register_block('ST_Twitter_Block');
//aq_register_block('ST_Letwork_Block');
//aq_register_block('ST_CTA_Block');
//aq_register_block('ST_Number_Block');



//fire up page builder
$aqpb_config = aq_page_builder_config();
$aq_page_builder = new AQ_Page_Builder($aqpb_config);
if(!is_network_admin()) $aq_page_builder->init();
