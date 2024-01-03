<?php

class Elementor_Widget_Category_Nuvi_Slider {

	private static $initiated = false;

    public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

    public function init_hooks() {
        $initiated = true;
        add_action( 'elementor/elements/categories_registered', array( 'Elementor_Widget_Category_Nuvi_Slider' ,'add_elementor_widget_categories'), 1 );
    }

    function add_elementor_widget_categories( $elements_manager ) {

        $elements_manager->add_category(
            'first-category',
            [
                'title' => esc_html__( 'First Category', 'textdomain' ),
                'icon' => 'fa fa-plug',
            ]
        );
        $elements_manager->add_category(
            'second-category',
            [
                'title' => esc_html__( 'Second Category', 'textdomain' ),
                'icon' => 'fa fa-plug',
            ]
        );
    
    }
}