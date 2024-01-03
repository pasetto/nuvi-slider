<?php

use Elementor\Controls_Manager;
use Elementor\Core\Base\Document;
use ElementorPro\Modules\QueryControl\Controls\Template_Query;
use ElementorPro\Modules\QueryControl\Module as QueryControlModule;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Elementor_Widget_Nuvi_Slider_Loop extends \Elementor\Widget_Base
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
        wp_register_script(
            "nuvi_slider_scripts_editor",
            plugins_url("../scripts/editor.js", __FILE__),
            [],
            "1.0.0",
            true
        );
    }

    public function get_name()
    {
        return "nuvi_slider_template";
    }

    public function get_title()
    {
        return __("Slider Template Tabs", "nuvi_slider");
    }

    public function get_icon()
    {
        return "eicon-slides";
    }

    public function get_categories()
    {
        return ["general", "nuvi-category"];
    }

    public function get_group() {
		return [ 'action' ];
	}

    protected function get_default_settings() {

		return [
			'show_label' => true,
			'label_block' => true,
			'separator' => 'after',
			'dynamic' => [
				'active' => true,
				'categories' => [
					\Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY,
					\Elementor\Modules\DynamicTags\Module::NUMBER_CATEGORY
				],
			],
		];

	}

    protected function _register_controls()
    {
        $this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Slides', 'textdomain' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Slides', 'textdomain' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'text',
						'label' => esc_html__( 'Slide Name', 'textdomain' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'Slide Name', 'textdomain' ),
						'default' => esc_html__( 'Slide Name', 'textdomain' ),
                        'dynamic' => [
                            'active' => true,
                        ],
					],
					[
						'name' => 'shortcode',
						'label' => esc_html__( 'Shortcode', 'textdomain' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => esc_html__( '[your-section-shortcode]', 'textdomain' ),
					],
					[
						'name' => 'id_template_section',
						'label' => esc_html__( 'Choose a template', 'elementor-pro' ),
						'type' => Template_Query::CONTROL_ID,
						'label_block' => true,
						'autocomplete' => [
							'object' => QueryControlModule::QUERY_OBJECT_LIBRARY_TEMPLATE,
							'query' => [
								'post_status' => Document::STATUS_PUBLISH,
								'meta_query' => [
									[
										'key' => Document::TYPE_META_KEY,
										'value' => 'section',
										'compare' => '=',
									],
								],
							],
						],
						'actions' => [
							'new' => [
								'visible' => true,
								'document_config' => [
									'type' => 'section',
								],
								'after_action' => 'redirect',
							],
							'edit' => [
								'visible' => true,
								'after_action' => 'redirect',
							],
						],
						'frontend_available' => true,
					]
				],
				'default' => [
					[
						'text' => esc_html__( 'Slide Name #1', 'textdomain' ),
						'link' => '',
					],
					[
						'text' => esc_html__( 'Slide Name #2', 'textdomain' ),
						'link' => '',
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);

		
        $this->end_controls_section();
















		$this->start_controls_section("sec1", [
            "label" => __("Settings", "nuvi_slider"),
            "tab" => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control("endless_loop", [
            "label" => esc_html__("Loop slider", "nuvi_slider"),
            "type" => Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "Yes",
        ]);

        $this->add_control("automatic_slider", [
            "label" => esc_html__("Autoplay", "nuvi_slider"),
            "type" => Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "Yes",
        ]);
        $this->add_control("autoplay_delay", [
            "label" => esc_html__(
                "Autoplay delay (ms)",
                "nuvi_slider"
            ),
            "type" => Controls_Manager::SLIDER,
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
            "type" => Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "No",
        ]);
        $this->add_control("pagination", [
            "label" => esc_html__("Show pagination", "nuvi_slider"),
            "type" => Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "No",
        ]);

        $this->add_control("mousewheel", [
            "label" => esc_html__("Mouse wheel", "nuvi_slider"),
            "type" => Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "No",
        ]);
        $this->add_control("arrows", [
            "label" => esc_html__("Show arrows", "nuvi_slider"),
            "type" => Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "No",
        ]);

        $this->add_control("hr_method", ["type" => Controls_Manager::DIVIDER ]);

        $this->add_control("overflow", [
            "label" => esc_html__("Hide slider overflow", "nuvi_slider"),
            "type" => Controls_Manager::SWITCHER,
                    'description' => esc_html__('If deactivated, the option will adopt the settings of the parent element, which may cause excessive scrolling.', 'nuvi_slider'),
            "label_on" => esc_html__("Yes", "nuvi_slider"),
            "label_off" => esc_html__("No", "nuvi_slider"),
            "return_value" => "yes",
            "default" => "yes",
        ]);



        $this->add_control("hr1", ["type" => Controls_Manager::DIVIDER ]);

        $this->add_control("slidesPerView", [
            "label" => esc_html__("Slides per View", "nuvi_slider"),
            "type" => Controls_Manager::NUMBER,
            "min" => 1,
            "max" => 50,
            "step" => 1,
            "default" => 2,
        ]);
        $this->add_control("slidesPerViewTablet", [
            "label" => esc_html__(
                "Slides per View (Tablet)",
                "nuvi_slider"
            ),
            "type" => Controls_Manager::NUMBER,
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
            "type" => Controls_Manager::NUMBER,
            "min" => 1,
            "max" => 50,
            "step" => 1,
            "default" => 1,
        ]);

        $this->add_control("hr2", [
            "type" => Controls_Manager::DIVIDER,
        ]);

        $this->add_control("spaceBetween", [
            "label" => esc_html__(
                "Space between slides",
                "nuvi_slider"
            ),
            "type" => Controls_Manager::NUMBER,
            "min" => 0,
            "max" => 100,
            "step" => 0,
            "default" => 30,
        ]);


        $this->add_control("hr_note1", [ "type" => Controls_Manager::DIVIDER ]);
        $this->add_control("info_note1", [
                    "type" => Controls_Manager::RAW_HTML,
                    "label" => "",
                    "raw" => __(
                        "Slideshow is only visible in the preview/final page, not in the editor.\nStyle arrows/pagination with custom CSS.",
                        "nuvi_slider"
                    ),
                ]);
        $this->add_control("hr_note2", [ "type" => Controls_Manager::DIVIDER ]);
        $this->add_control("info_note2", [
                    "type" => Controls_Manager::RAW_HTML,
                    "label" => "",
                    "raw" => __(
                        "For best results use a full width container and set overflow and width as needed.",
                        "nuvi_slider"
                    ),
                ]);
        $this->end_controls_section();

		/**
		 * 
		 * Style Tab
		 * 
		 */
		/**
		 * 
		 * Style Tab : Arrows
		 * 
		 */

		 $this->start_controls_section("arrows_style", [
			"label" => __("Arrows", "nuvi_slider"),
			"tab" => Controls_Manager::TAB_STYLE,
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

		

				$this->start_controls_tabs(
					'style_arrow_icon_tabs'
				);
		
				$this->start_controls_tab(
					'style_arrow_icon_tab',
					[
						'label' => esc_html__( 'Normal', 'textdomain' ),
					]
				);
		
				$this->add_control(
					'arrow_icon_color',
					[
						'label' => esc_html__( 'Icon color', 'textdomain' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#000000'
					]
				);
				
				$this->add_control(
					'arrow_icon',
					[
						'label' => esc_html__( 'Icon', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' => [
							'value' => 'fas fa-circle',
							'library' => 'fa-solid',
						],
						'recommended' => [
							'fa-solid' => [
								'circle',
								'dot-circle',
								'square-full',
							],
							'fa-regular' => [
								'circle',
								'dot-circle',
								'square-full',
							],
						],
					]
				);
		
				$this->end_controls_tab();
				$this->start_controls_tab(
					'style_arrow_icon_active_tab',
					[
						'label' => esc_html__( 'Active', 'textdomain' ),
					]
				);
		
		
				$this->add_control(
					'arrow_icon_active_color',
					[
						'label' => esc_html__( 'Icon color', 'textdomain' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#000000'
					]
				);
		
				$this->add_control(
					'arrow_icon_active',
					[
						'label' => esc_html__( 'Icon', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' => [
							'value' => 'fas fa-circle',
							'library' => 'fa-solid',
						],
						'recommended' => [
							'fa-solid' => [
								'circle',
								'dot-circle',
								'square-full',
							],
							'fa-regular' => [
								'circle',
								'dot-circle',
								'square-full',
							],
						],
					]
				);
		
		
		
				$this->end_controls_tab();
		
				$this->end_controls_tabs();

        $this->end_controls_section();

		/**
		 * 
		 * Style Tab : Paginator
		 * 
		 */

		$this->start_controls_section("paginator_style", [
			"label" => __("Paginator", "nuvi_slider"),
			"tab" => Controls_Manager::TAB_STYLE,
		]);

		$this->add_control(
			'dot_clickable',
			[
				'label' => esc_html__( 'Clickable', 'nuvi_slider' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'nuvi_slider' ),
				'label_off' => esc_html__( 'No', 'nuvi_slider' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'pagination' => 'yes',
				],
			]
			);
	
		$this->add_control(
			'dot_flex_direction',
			[
				'label' => esc_html__( 'Pagination direction', 'nuvi_slider' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'row' => esc_html__( 'Horizontal', 'nuvi_slider' ),
					'column' => esc_html__( 'Vertical', 'nuvi_slider' ),
				],
				'default' => 'row',
				'condition' => [
					'pagination' => 'yes',
				],
				
			]
		);
	
		$this->add_control(
			'dot_justify_content',
			[
				'label' => esc_html__( 'Pagination alignment', 'nuvi_slider' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'flex-start' => esc_html__( 'Left', 'nuvi_slider' ),
					'center' => esc_html__( 'Center', 'nuvi_slider' ),
					'flex-end' => esc_html__( 'Right', 'nuvi_slider' ),
					'space-between' => esc_html__( 'Space Between', 'nuvi_slider' ),
					'space-around' => esc_html__( 'Space Around', 'nuvi_slider' ),
				],
				'default' => 'center',
				'condition' => [
					'pagination' => 'yes',
				],
				
			]
		);
	
		$this->add_control(
			'dot_align_items',
			[
				'label' => esc_html__( 'Pagination vertical alignment', 'nuvi_slider' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'flex-start' => esc_html__( 'Top', 'nuvi_slider' ),
					'center' => esc_html__( 'Center', 'nuvi_slider' ),
					'flex-end' => esc_html__( 'Bottom', 'nuvi_slider' ),
				],
				'default' => 'center',
				'condition' => [
					'pagination' => 'yes',
					'dot_flex_direction' => 'row',
				],
				
			]
		);
	
		$this->add_control(
			'dot_align_self',
			[
				'label' => esc_html__( 'Pagination horizontal alignment', 'nuvi_slider' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'flex-start' => esc_html__( 'Left', 'nuvi_slider' ),
					'center' => esc_html__( 'Center', 'nuvi_slider' ),
					'flex-end' => esc_html__( 'Right', 'nuvi_slider' ),
				],
				'default' => 'center',
				'condition' => [
					'pagination' => 'yes',
					'dot_flex_direction' => 'column',
				],
				
			]
		);
	
		$this->add_control(
			'dot_width',
			[
				'label' => esc_html__( 'Pagination width', 'nuvi_slider' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px','%' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 3000,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'condition' => [
					'pagination' => 'yes',
				],
				
			]
		);
	
		$this->add_control(
			'dot_height',
			[
				'label' => esc_html__( 'Pagination height', 'nuvi_slider' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 2000,
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

		
		$this->add_control(
			'dot_margin',
			[
				'label' => esc_html__( 'Pagination margin', 'nuvi_slider' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'condition' => [
					'pagination' => 'yes',
				],				
			]
		);

		$this->add_control(
			'dot_padding',
			[
				'label' => esc_html__( 'Pagination padding', 'nuvi_slider' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'condition' => [
					'pagination' => 'yes',
				],		
			]
		);

		$this->add_control(
			'dot_bullet_width',
			[
				'label' => esc_html__( 'Pagination bullet width', 'nuvi_slider' ),
				'description' => esc_html__('Used when uploaded svg', 'nuvi_slider'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 3000,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'condition' => [
					'pagination' => 'yes',
				],
				
			]
			);

		$this->add_control(
			'dot_bullet_height',
			[
				'label' => esc_html__( 'Pagination bullet height', 'nuvi_slider' ),
				'description' => esc_html__('Used when uploaded svg', 'nuvi_slider'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 2000,
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

		$this->add_control(
			'dot_bullet_font_size',
			[
				'label' => esc_html__( 'Pagination bullet font size', 'nuvi_slider' ),
				'description' => esc_html__('Used on existent icons.', 'nuvi_slider'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 2000,
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

		$this->start_controls_tabs(
			'style_dot_icon_tabs'
		);

		$this->start_controls_tab(
			'style_dot_icon_tab',
			[
				'label' => esc_html__( 'Normal', 'textdomain' ),
			]
		);

		$this->add_control(
			'dot_icon_color',
			[
				'label' => esc_html__( 'Icon color', 'textdomain' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000'
			]
		);
		
		$this->add_control(
			'dot_icon',
			[
				'label' => esc_html__( 'Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'style_dot_icon_active_tab',
			[
				'label' => esc_html__( 'Active', 'textdomain' ),
			]
		);


		$this->add_control(
			'dot_icon_active_color',
			[
				'label' => esc_html__( 'Icon color', 'textdomain' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000'
			]
		);

		$this->add_control(
			'dot_icon_active',
			[
				'label' => esc_html__( 'Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
			]
		);



		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();
		/**
		 * 
		 * END /Style Tab : Paginator
		 * 
		 */
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
        return ["swiper", "nuvi_slider_scripts", "nuvi_slider_scripts_editor"];
    }

    public function get_style_depends()
    {

        return ["nuvi_slider_styles", "nuvi-slider-classic"];
    }

    protected function render()
    {
		
		// get element elementor id
		$element_id = $this->get_id();
        $settings = $this->get_settings_for_display();
		
		$isEditor = \Elementor\Plugin::$instance->editor->is_edit_mode();
		$settings = $this->get_settings_for_display();
		$loopValue = $settings["endless_loop"] == "yes" ? 1 : 0;
		$centerSlides = $settings["center_slides"] == "yes" ? 1 : 0;
		$mousewheel = $settings["mousewheel"] == "yes" ? 1 : 0;
		$automaticSlider = $settings["automatic_slider"] == "yes" ? 1 : 0;
		$overflow = $settings["overflow"] == "yes" ? 1 : 0;
		$overflowClass = $settings["overflow"] == "yes" ? ' overflow-hidden' : '';
		$pagination = $settings["pagination"] == "yes" ? 1 : 0;
		$arrows = $settings["arrows"] == "yes" ? 1 : 0;
		$dotPadding = 10;

		$dotIcon = (!isset($settings["dot_icon"]["value"]["url"]))? $settings["dot_icon"]["value"] . ' ' . $settings["dot_icon"]["library"] : 0;
		$dotIconActive = (!isset($settings["dot_icon_active"]["value"]["url"]))? $settings["dot_icon_active"]["value"] . ' ' . $settings["dot_icon_active"]["library"] : 0;

		$dotClickable = $settings["dot_clickable"] == "yes" ? 1 : 0;

		if (isset($settings["dot_padding"])) {
			$dotPadding = $settings["dot_padding"]["size"];
		}
		$automaticSliderDelay = !empty($settings["autoplay_delay"])
			? $settings["autoplay_delay"]["size"]
			: "";

		$latestSwiper = \Elementor\Plugin::$instance->experiments->is_feature_active('e_swiper_latest');

		?>
		<div id="nuvi-slider-<?php echo esc_attr($element_id); ?>" class="nuvi-slider-wrapper <?php echo $overflowClass; ?>">
		<?php foreach ( $settings['list'] as $index => $item ) : ?>
			<div class="nuvi-slider-slide">
				<?php
				if ( ! empty( $item['id_template_section'] ) ) {
					echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $item['id_template_section'] );
				} elseif ( ! empty( $item['shortcode'] ) ) {
					echo do_shortcode( $item['shortcode'] );
				}
				?>
			</div>
		<?php endforeach; ?>
		</div>
		<?php

		$currentClass = ($isEditor)? 'nuvi_slider_editor' : 'nuvi_slider';
		echo '<div class="' . $currentClass . '" data-mousewheel="'.esc_attr($mousewheel).'" data-sliderId="nuvi-slider-' .
			esc_attr($element_id) .
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
			'" data-overflow="' .
			esc_attr($overflow) .
			'" data-pagination="' .
			esc_attr($pagination) .'" '.
			'data-arrows="' .esc_attr($arrows) .'" '.
			'data-latestSwiper="' .$latestSwiper .'" '.
			'data-dot-padding="' .esc_attr($dotPadding) .'" '.
			'data-dot-icon="' .esc_attr($dotIcon) .'" '.
			'data-dot-icon-active="' .esc_attr($dotIconActive) .'" '.
			'data-dot-clickable="' .esc_attr($dotClickable) .'" '.
			'data-autoplay-delay="' .
			esc_attr($automaticSliderDelay) .
			'">';

		// if ($isEditor) {
		// 	echo "<div class='nuvi-is-editor'>";
		// 	echo "<center><strong>Nuvi Slider Classic</strong><br/>Assigned container ID: <strong>". $element_id.'</strong>';
		// 	if (\Elementor\Plugin::$instance->experiments->is_feature_active('container') == false) {
		// 		echo '<br/><strong>This widget only works with Flexbox. Please activate it!</strong>';
		// 	}
		// 	echo '</center>';
		// 	echo '</div>';
		// }
		echo '</div>';

		// if (!$isEditor) {
			echo '<style type="text/css">';
			echo '#nuvi-slider-'.$element_id.' .swiper-button-prev {background-image: none } ';
			echo '#nuvi-slider-'.$element_id.' .swiper-button-next {background-image: none } ';
			echo '#nuvi-slider-'.$element_id.' .swiper-button-prev svg path {fill:'.$settings["arrow_left"].'} ';
			echo '#nuvi-slider-'.$element_id.' .swiper-button-next svg path {fill:'.$settings["arrow_right"].'} ';

			$h = $settings["arrow_height"]["size"].$settings["arrow_height"]["unit"];
			$w = ($settings["arrow_height"]["size"] * 0.6).$settings["arrow_height"]["unit"];
			echo '#nuvi-slider-'.$element_id.' .swiper-button-next, #nuvi-slider-'.$element_id.' .swiper-button-prev {height:'.$h.'; width:'.$w.'} ';

			if (!empty($settings["arrow_bg"])) {
				echo '#nuvi-slider-'.$element_id.' .swiper-button-next, #nuvi-slider-'.$element_id.' .swiper-button-prev {background-color: '.$settings["arrow_bg"].'} ';
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
				echo '#nuvi-slider-'.$element_id.' .swiper-button-prev {top:'.$aLT.'; bottom:'.$aLB.'; left:'.$aLL.'; right:'.$aLR.';}';

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
				echo '#nuvi-slider-'.$element_id.' .swiper-button-next {top:'.$aRT.'; bottom:'.$aRB.'; left:'.$aRL.'; right:'.$aRR.';}';
			}
			echo '</style>';
		// }

		?>
		<style>
			<?php echo '#nuvi-slider-' . $element_id; ?>.nuvi-slider-wrapper  .nuvi-pagination{
				display: flex;
				flex-direction: <?php echo $settings["dot_flex_direction"]; ?>;
				justify-content: <?php echo $settings["dot_justify_content"]; ?>;
				align-items: <?php echo $settings["dot_align_items"]; ?>;
				align-self: <?php echo $settings["dot_align_self"]; ?>;
				width: <?php echo $settings["dot_width"]["size"].$settings["dot_width"]["unit"]; ?>;
				height: <?php echo $settings["dot_height"]["size"].$settings["dot_height"]["unit"]; ?>;
			}

			
			<?php echo '#nuvi-slider-' . $element_id; ?>.nuvi-slider-wrapper  .nuvi-pagination i{
				color: <?php echo $settings["dot_icon_color"]; ?>;
			}
			
			<?php echo '#nuvi-slider-' . $element_id; ?>.nuvi-slider-wrapper  .nuvi-pagination i{
				display: none;
			}

			<?php echo '#nuvi-slider-' . $element_id; ?>.nuvi-slider-wrapper  .nuvi-pagination .nuvi-pagination-active i.active{
				display: block;
			}
			<?php echo '#nuvi-slider-' . $element_id; ?>.nuvi-slider-wrapper  .nuvi-pagination .nuvi-pagination-bullet i.default{
				display: block;
			}
			<?php echo '#nuvi-slider-' . $element_id; ?>.nuvi-slider-wrapper  .nuvi-pagination .nuvi-pagination-bullet.nuvi-pagination-active i.default{
				display: none;
			}

			<?php echo '#nuvi-slider-' . $element_id; ?>.nuvi-slider-wrapper  .nuvi-pagination .nuvi-pagination-bullet{
				padding: <?php echo $settings["dot_padding"]["top"].$settings["dot_padding"]["unit"]; ?> <?php echo $settings["dot_padding"]["right"].$settings["dot_padding"]["unit"]; ?> <?php echo $settings["dot_padding"]["bottom"].$settings["dot_padding"]["unit"]; ?> <?php echo $settings["dot_padding"]["left"].$settings["dot_padding"]["unit"]; ?>;
				margin: <?php echo $settings["dot_margin"]["top"].$settings["dot_margin"]["unit"]; ?> <?php echo $settings["dot_margin"]["right"].$settings["dot_margin"]["unit"]; ?> <?php echo $settings["dot_margin"]["bottom"].$settings["dot_margin"]["unit"]; ?> <?php echo $settings["dot_margin"]["left"].$settings["dot_margin"]["unit"]; ?>
			}

			<?php if (isset($settings["dot_icon"]["value"]["url"])) { ?>			
			<?php echo '#nuvi-slider-' . $element_id; ?>.nuvi-slider-wrapper  .nuvi-pagination .nuvi-pagination-bullet i.default{
				background-image: url(<?php echo $settings["dot_icon"]["value"]["url"]; ?>);
				background-repeat: no-repeat;
				background-position: center;
				width: <?php echo $settings["dot_bullet_width"]["size"].$settings["dot_bullet_width"]["unit"]; ?>;
				height: <?php echo $settings["dot_bullet_height"]["size"].$settings["dot_bullet_height"]["unit"]; ?>;
			}
			<?php } ?>
			<?php if (isset($settings["dot_icon_active"]["value"]["url"])) { ?>
			<?php echo '#nuvi-slider-' . $element_id; ?>.nuvi-slider-wrapper  .nuvi-pagination .nuvi-pagination-active i.active{
				background-image: url(<?php echo $settings["dot_icon_active"]["value"]["url"]; ?>);
				background-repeat: no-repeat;
				background-position: center;
				width: <?php echo $settings["dot_bullet_width"]["size"].$settings["dot_bullet_width"]["unit"]; ?>;
				height: <?php echo $settings["dot_bullet_height"]["size"].$settings["dot_bullet_height"]["unit"]; ?>
			}
			<?php } ?>

			<?php echo '#nuvi-slider-' . $element_id; ?>.nuvi-slider-wrapper  .nuvi-pagination .nuvi-pagination-active i{
				font-size: <?php echo $settings["dot_bullet_font_size"]["size"].$settings["dot_bullet_font_size"]["unit"]; ?>;
			}

		</style>
		<?php
			if ($isEditor) {
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				nuvi_slider_init_editor();
			});
		</script>
		<?php
			}
		
    }
}
