<?php

/**
 * Plugin Name: XRPTIPBOT Widget
 * Plugin URI: http://audamob.com/xrptipbot-wordpress-widget/
 * Description: Displays a Twitter XRPTIPBOT tips button.
 * Author: HoussemBenSlama
 * Author URI: http://www.audamob.com/
 * Version: 1.0.2
 * License: GPLv2 or later
*/

require_once( plugin_dir_path( __FILE__ ) . 'class.xrptipbot-widget.php' );

add_action( 'widgets_init', 'xrptipbot_widget_register' );
function xrptipbot_widget_register() {
	register_widget( 'XRPTIPBOT_Widget' );
}
