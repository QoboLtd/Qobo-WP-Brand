<?php
/*
Plugin Name: Qobo - Developed By
Plugin URI: http://www.qobo.biz
Description: Plugin for 'Developed by'
Author: Qobo ltd
Version: 0.1
Author URI: http://www.qobo.biz
*/

define('QBDEVBY__PLUGIN_DIR', plugin_dir_path( __FILE__ ));
require_once (QBDEVBY__PLUGIN_DIR.'qbdevby_settings.php');
require_once (QBDEVBY__PLUGIN_DIR.'qbdevby_widget.php');
require_once (QBDEVBY__PLUGIN_DIR.'qbdevby_developedby.php');

define('QBDEVBY__PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ));

new QBDEVBY_Settings();