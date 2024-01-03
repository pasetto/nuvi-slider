<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


use Elementor\Plugin;

/**
 * Main plugin class.
 *
 * @package Nuvi_Slider
 */

class Nuvi_Slider {

	private static $initiated = false;

	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	/**
	 * Initializes WordPress hooks
	 */
	private static function init_hooks() {
		self::$initiated = true;
		// add_action( 'wp_insert_comment', array( 'Akismet', 'auto_check_update_meta' ), 10, 2 );
		// add_filter( 'preprocess_comment', array( 'Akismet', 'auto_check_comment' ), 1 );
		self::register_elements_styles();
		// check if elementor is active
		if (did_action('elementor/loaded')) {
			self::load_elementor_helpers();
			self::load_elementor_widgets();
		}
	}

	// public static function get_api_key() {
	// 	return apply_filters( 'akismet_get_api_key', defined('WPCOM_API_KEY') ? constant('WPCOM_API_KEY') : get_option('wordpress_api_key') );
	// }
	public static function load_elementor_helpers() {
			\Elementor\Plugin::instance()->elements_manager->add_category(
				'nuvi-category',
				[
					'title'  => 'Nuvi Slider',
					'icon' => 'font'
				],
				1
			);
	}
	public static function load_elementor_widgets() {
		require_once( NUVI_SLIDER__PLUGIN_DIR . '/widgets/classic-slider.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_Widget_nuvi_slider_classic());
			
		require_once( NUVI_SLIDER__PLUGIN_DIR . '/widgets/slider-loop.php');
			\Elementor\Plugin::instance()->widgets_manager->register(new \Elementor_Widget_Nuvi_Slider_Loop());
	}
	public static function plugin_activation() {
		return ;
	}
	public static function plugin_deactivation() {
		return ;
	}

	public static function register_elements_styles() {
		wp_register_style(
			'nuvi-slider-classic',
			NUVI_SLIDER__PLUGIN_URL . 'styles/nuvi-slider.css',
			[],
			'1.0.0'
		);
	}

}
