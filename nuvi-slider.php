<?php
/**
* Plugin Name:       Nuvi Slider
* Plugin URI:        #
* Description:       Create a swiper slider, simple and complex
* Version:           0.0.0
* Requires at least: 5.2
* Requires PHP:      7.2
* Author:            Nuvi Digital
* Author URI:        https://www.nuvidigital.com/
* License:           GPL v2 or later
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       nuvi_slider
* Elementor tested up to:  3.16.4
*/

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'NUVI_SLIDER_VERSION', '5.2' );
define( 'NUVI_SLIDER__MINIMUM_WP_VERSION', '5.8' );
define( 'NUVI_SLIDER__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'NUVI_SLIDER__PLUGIN_URL', plugin_dir_url( __FILE__ ) );

register_activation_hook( __FILE__, array( 'Nuvi_Slider', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Nuvi_Slider', 'plugin_deactivation' ) );

require_once( NUVI_SLIDER__PLUGIN_DIR . 'class.nuvi-slider.php' );

add_action( 'init', array( 'Nuvi_Slider', 'init' ) );