<?php

class Elementor_Widget_nuvi_slider_classic extends \Elementor\Widget_Base
{
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);

        wp_register_script(
            "nuvi_slider_scripts",
            plugins_url("../scripts/main.js", __FILE__),
            [],
            "1.0.0",
            true
        );
    }

    public function get_name()
    {
        return "nuvi_slider_title";
    }

    public function get_title()
    {
        return __("Classic Slider Anything", "nuvi_slider");
    }

    public function get_icon()
    {
        return "eicon-slides";
    }

    public function get_categories()
    {
        return ["general", "nuvi-category"];
    }

    protected function _register_controls()
    {
        $this->start_controls_section("sec1", [
            "label" => __("Settings", "nuvi_slider"),
            "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control("sliderId", [
            "label" => esc_html__("Slider ID", "nuvi_slider"),
            "type" => \Elementor\Controls_Manager::TEXT,
            "default" => esc_html__("", "nuvi_slider"),
            "placeholder" => esc_html__(
                "Type your #id here",
                "nuvi_slider"
            ),
        ]);

        $this->add_control("endless_loop", [
            "label" => esc_html__("Loop slider", "nuvi_slider"),
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "No",
        ]);

        $this->add_control("automatic_slider", [
            "label" => esc_html__("Autoplay", "nuvi_slider"),
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "No",
        ]);
        $this->add_control("autoplay_delay", [
            "label" => esc_html__(
                "Autoplay delay (ms)",
                "nuvi_slider"
            ),
            "type" => \Elementor\Controls_Manager::SLIDER,
            "size_units" => ["px"],
            "range" => [
                "px" => [
                    "min" => 100,
                    "max" => 10000,
                    "step" => 100,
                ],
            ],
            "default" => [
                "unit" => "px",
                "size" => 3000,
            ],
            "selectors" => ["none"],
            "condition" => ["automatic_slider" => "yes"],
        ]);

        $this->add_control("center_slides", [
            "label" => esc_html__("Center slides", "nuvi_slider"),
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "No",
        ]);
        $this->add_control("pagination", [
            "label" => esc_html__("Show pagination", "nuvi_slider"),
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "No",
        ]);

        $this->add_control(
            'dot_padding',
            [
                'label' => esc_html__('Pagination position', 'nuvi_slider'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'condition' => [
                    'pagination' => 'yes',
                ],
            ]
        );

        $this->add_control("mousewheel", [
            "label" => esc_html__("Mouse wheel", "nuvi_slider"),
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "No",
        ]);
        $this->add_control("arrows", [
            "label" => esc_html__("Show arrows", "nuvi_slider"),
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "No",
        ]);

        $this->add_control("hr_method", ["type" => \Elementor\Controls_Manager::DIVIDER ]);

        $this->add_control("newmethod", [
            "label" => esc_html__("Keep child structure", "nuvi_slider"),
            "type" => \Elementor\Controls_Manager::SWITCHER,
                    'description' => esc_html__('Adds a <div> around each slide to keep Elementor settings.', 'nuvi_slider'),
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "No",
        ]);



        $this->add_control("hr1", ["type" => \Elementor\Controls_Manager::DIVIDER ]);

        $this->add_control("slidesPerView", [
            "label" => esc_html__("Slides per View", "nuvi_slider"),
            "type" => \Elementor\Controls_Manager::NUMBER,
            "min" => 1,
            "max" => 50,
            "step" => 1,
            "default" => 4,
        ]);
        $this->add_control("slidesPerViewTablet", [
            "label" => esc_html__(
                "Slides per View (Tablet)",
                "nuvi_slider"
            ),
            "type" => \Elementor\Controls_Manager::NUMBER,
            "min" => 1,
            "max" => 50,
            "step" => 1,
            "default" => 2,
        ]);
        $this->add_control("slidesPerViewPhone", [
            "label" => esc_html__(
                "Slides per View (Phone)",
                "nuvi_slider"
            ),
            "type" => \Elementor\Controls_Manager::NUMBER,
            "min" => 1,
            "max" => 50,
            "step" => 1,
            "default" => 1,
        ]);

        $this->add_control("hr2", [
            "type" => \Elementor\Controls_Manager::DIVIDER,
        ]);

        $this->add_control("spaceBetween", [
            "label" => esc_html__(
                "Space between slides",
                "nuvi_slider"
            ),
            "type" => \Elementor\Controls_Manager::NUMBER,
            "min" => 1,
            "max" => 100,
            "step" => 1,
            "default" => 30,
        ]);


        $this->add_control("hr_note1", [ "type" => \Elementor\Controls_Manager::DIVIDER ]);
        $this->add_control("info_note1", [
                    "type" => \Elementor\Controls_Manager::RAW_HTML,
                    "label" => "",
                    "raw" => __(
                        "Slideshow is only visible in the preview/final page, not in the editor.\nStyle arrows/pagination with custom CSS.",
                        "nuvi_slider"
                    ),
                ]);
        $this->add_control("hr_note2", [ "type" => \Elementor\Controls_Manager::DIVIDER ]);
        $this->add_control("info_note2", [
                    "type" => \Elementor\Controls_Manager::RAW_HTML,
                    "label" => "",
                    "raw" => __(
                        "For best results use a full width container and set overflow and width as needed.",
                        "nuvi_slider"
                    ),
                ]);
        $this->end_controls_section();

        $this->start_controls_section("sec2", [
            "label" => __("Styling", "nuvi_slider"),
            "tab" => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control(
            'arrow_left',
            [
                'label' => esc_html__('Arrow color (left)', 'nuvi_slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );
        $this->add_control(
            'arrow_right',
            [
                'label' => esc_html__('Arrow color (right)', 'nuvi_slider'),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'arrow_radius',
            [
                'label' => esc_html__('Arrow border radius', 'nuvi_slider'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'custom' ],
                ],
        );


        $this->add_control(
            'arrow_height',
            [
                'label' => esc_html__('Arrow height', 'nuvi_slider'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                        'step' => 2,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 44,
                ]
            ]
        );


        $this->add_control("abs_arrows", [
            "label" => esc_html__("Position arrows absolute", "nuvi_slider"),
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "No",
        ]);
        $this->add_control(
            'arrow_left_pos',
            [
                'label' => esc_html__('Arrow position (left)', 'nuvi_slider'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'custom' ],
                'condition' => ['abs_arrows' => 'yes'],
                'default' => [
                    'unit' => 'custom',
                    'size' => '',
                ]
            ]
        );
        $this->add_control(
            'arrow_right_pos',
            [
                'label' => esc_html__('Arrow position (right)', 'nuvi_slider'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'custom' ],
                'condition' => ['abs_arrows' => 'yes'],
                'default' => [
                    'unit' => 'custom',
                    'size' => '',
                ]
            ]
        );
        $this->add_control("arrow_note", [
                    "type" => \Elementor\Controls_Manager::RAW_HTML,
                    "label" => "",
                    'condition' => ['abs_arrows' => 'yes'],
                    "raw" => __(
                        "e.g. use 'inherit | 40px | 20px | inherit' to move the left arrow to the bottem right.",
                        "nuvi_slider"
                    ),
                ]);
        $this->end_controls_section();
    }

    public function get_script_depends()
    {
        wp_register_script(
            "swiper",
            ELEMENTOR_ASSETS_URL . "/lib/swiper/swiper.min.js",
            ["jquery"],
            false,
            true
        );
        return ["swiper", "nuvi_slider_scripts"];
    }

    public function get_style_depends()
    {

        return ["nuvi_slider_styles", "nuvi-slider-classic"];
    }

    protected function render()
    {
        $isEditor = \Elementor\Plugin::$instance->editor->is_edit_mode();
        $settings = $this->get_settings_for_display();
        $loopValue = $settings["endless_loop"] == "yes" ? 1 : 0;
        $centerSlides = $settings["center_slides"] == "yes" ? 1 : 0;
        $mousewheel = $settings["mousewheel"] == "yes" ? 1 : 0;
        $automaticSlider = $settings["automatic_slider"] == "yes" ? 1 : 0;
        $newmethod = $settings["newmethod"] == "yes" ? 1 : 0;
        $pagination = $settings["pagination"] == "yes" ? 1 : 0;
        $arrows = $settings["arrows"] == "yes" ? 1 : 0;
        $dotPadding = 10;
        if (isset($settings["dot_padding"])) {
            $dotPadding = $settings["dot_padding"]["size"];
        }
        $automaticSliderDelay = !empty($settings["autoplay_delay"])
            ? $settings["autoplay_delay"]["size"]
            : "";

        $latestSwiper = \Elementor\Plugin::$instance->experiments->is_feature_active('e_swiper_latest');

        echo '<div class="nuvi_slider" data-mousewheel="'.esc_attr($mousewheel).'" data-sliderId="' .
            esc_attr($settings["sliderId"]) .
            '" data-spv="' .
            esc_attr($settings["slidesPerView"]) .
            '" data-spvt="' .
            esc_attr($settings["slidesPerViewTablet"]) .
            '" data-spvp="' .
            esc_attr($settings["slidesPerViewPhone"]) .
            '" data-spacebetween="' .
            esc_attr($settings["spaceBetween"]) .
            '" data-loop="' .
            esc_attr($loopValue) .
            '" data-centerSlides="' .
            esc_attr($centerSlides) .
            '" data-autoplay="' .
            esc_attr($automaticSlider) .
            '" data-newmethod="' .
            esc_attr($newmethod) .
            '" data-pagination="' .
            esc_attr($pagination) .'" '.
            'data-arrows="' .esc_attr($arrows) .'" '.
            'data-latestSwiper="' .$latestSwiper .'" '.
            'data-dot-padding="' .esc_attr($dotPadding) .'" '.
            'data-autoplay-delay="' .
            esc_attr($automaticSliderDelay) .
            '">';

        if ($isEditor) {
            echo "<div class='nuvi-is-editor'>";
            echo "<center><strong>Nuvi Slider Classic</strong><br/>Assigned container ID: <strong>". $settings["sliderId"].'</strong>';
            if (\Elementor\Plugin::$instance->experiments->is_feature_active('container') == false) {
                echo '<br/><strong>This widget only works with Flexbox. Please activate it!</strong>';
            }
            echo '</center>';
            echo '</div>';
        }
        echo '</div>';

        if (!$isEditor) {
            echo '<style type="text/css">';
            echo '#'.$settings["sliderId"].' .swiper-button-prev {background-image: none } ';
            echo '#'.$settings["sliderId"].' .swiper-button-next {background-image: none } ';
            echo '#'.$settings["sliderId"].' .swiper-button-prev svg path {fill:'.$settings["arrow_left"].'} ';
            echo '#'.$settings["sliderId"].' .swiper-button-next svg path {fill:'.$settings["arrow_right"].'} ';

            $h = $settings["arrow_height"]["size"].$settings["arrow_height"]["unit"];
            $w = ($settings["arrow_height"]["size"] * 0.6).$settings["arrow_height"]["unit"];
            echo '#'.$settings["sliderId"].' .swiper-button-next, #'.$settings["sliderId"].' .swiper-button-prev {height:'.$h.'; width:'.$w.'} ';

            if (!empty($settings["arrow_bg"])) {
                echo '#'.$settings["sliderId"].' .swiper-button-next, #'.$settings["sliderId"].' .swiper-button-prev {background-color: '.$settings["arrow_bg"].'} ';
            }

            if ($settings["abs_arrows"] == 'yes') {
                $posL = $settings["arrow_left_pos"];
                $posR = $settings["arrow_right_pos"];

                $aLT = $posL["top"];
                $aLL = $posL["left"];
                $aLR = $posL["right"];
                $aLB = $posL["bottom"];
                if ($posL["unit"] != "custom") {
                    $aLT .= $posL["unit"];
                    $aLL .= $posL["unit"];
                    $aLR .= $posL["unit"];
                    $aLB .= $posL["unit"];
                }
                echo '#'.$settings["sliderId"].' .swiper-button-prev {top:'.$aLT.'; bottom:'.$aLB.'; left:'.$aLL.'; right:'.$aLR.';}';

                $aRT = $posR["top"];
                $aRL = $posR["left"];
                $aRR = $posR["right"];
                $aRB = $posR["bottom"];
                if ($posR["unit"] != "custom") {
                    $aLT .= $posR["unit"];
                    $aLL .= $posR["unit"];
                    $aLR .= $posR["unit"];
                    $aLB .= $posR["unit"];
                }
                echo '#'.$settings["sliderId"].' .swiper-button-next {top:'.$aRT.'; bottom:'.$aRB.'; left:'.$aRL.'; right:'.$aRR.';}';
            }
            echo '</style>';
        }
    }
}
