<?php

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Core\Schemes;
use Elementor\Icons_Manager;

/**
 * AnWP Post Grid Elements :: Classic Slider
 *
 * @since   0.6.0
 * @package AnWP_Post_Grid
 */

class AnWP_Post_Grid_Element_Classic_Slider extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 * @since  0.1.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'anwp-pg-classic-slider';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 * @since  0.1.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Classic Slider', 'anwp-post-grid' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 * @since  0.1.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'anwp-pg-element anwp-pg-classic-slider__admin-icon';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'carousel', 'posts', 'post', 'post carousel', 'posts carousel', 'posts slider', 'slider', 'anwp' ];
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @return array Widget categories.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'anwp-pg' ];
	}

	/**
	 * Register widget controls.
	 *
	 * @since  0.1.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'section_anwp_grid_options',
			[
				'label' => __( 'Query', 'anwp-post-grid' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'posts_to_show',
			[
				'label'       => __( 'Posts to Show', 'anwp-post-grid' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'latest',
				'options'     => anwp_post_grid()->elements->get_posts_to_show_options(),
				'label_block' => true,
			]
		);

		$this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		if ( anwp_post_grid()->elements->published_posts > anwp_post_grid()->elements->published_posts_limit ) {
			$this->add_control(
				'include_ids',
				[
					'label'       => __( 'Selected Posts', 'anwp-post-grid' ),
					'description' => __( 'Post IDs, separated by commas', 'anwp-post-grid' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => '',
					'condition'   => [
						'posts_to_show' => 'custom',
					],
				]
			);
		} else {
			$this->add_control(
				'include_ids',
				[
					'label'       => __( 'Selected Posts', 'anwp-post-grid' ),
					'type'        => Controls_Manager::SELECT2,
					'multiple'    => true,
					'label_block' => true,
					'default'     => [],
					'options'     => anwp_post_grid()->elements->get_posts_all_options(),
					'condition'   => [
						'posts_to_show' => 'custom',
					],
				]
			);
		}

		$this->add_control(
			'filter_by_category',
			[
				'label'       => __( 'Filter by Category', 'anwp-post-grid' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'default'     => [],
				'options'     => anwp_post_grid()->elements->get_category_options(),
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'filter_by_tag',
			[
				'label'       => __( 'Filter by Tag', 'anwp-post-grid' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'default'     => [],
				'options'     => anwp_post_grid()->elements->get_tag_options(),
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'filter_by_post_format',
			[
				'label'       => __( 'Filter by Post Format', 'anwp-post-grid' ),
				'type'        => Controls_Manager::SELECT,
				'multiple'    => true,
				'label_block' => true,
				'default'     => 'all',
				'options'     => anwp_post_grid()->elements->get_post_format_options(),
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'filter_by_author',
			[
				'label'       => __( 'Filter by Author', 'anwp-post-grid' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'default'     => '',
				'options'     => anwp_post_grid()->elements->get_author_options(),
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'hr2',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'limit',
			[
				'label'       => __( 'Posts Limit', 'anwp-post-grid' ),
				'label_block' => false,
				'description' => __( 'Set post limit. Use "-1" to show all.', 'anwp-post-grid' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => -1,
				'step'        => 1,
				'default'     => 6,
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'hr3',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		if ( anwp_post_grid()->elements->published_posts > anwp_post_grid()->elements->published_posts_limit ) {
			$this->add_control(
				'exclude_ids',
				[
					'label'       => __( 'Exclude Posts', 'anwp-post-grid' ),
					'description' => __( 'Post IDs, separated by commas', 'anwp-post-grid' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => '',
					'condition'   => [
						'posts_to_show!' => 'custom',
					],
				]
			);
		} else {
			$this->add_control(
				'exclude_ids',
				[
					'label'       => __( 'Exclude Posts', 'anwp-post-grid' ),
					'type'        => Controls_Manager::SELECT2,
					'multiple'    => true,
					'label_block' => true,
					'default'     => [],
					'options'     => anwp_post_grid()->elements->get_posts_all_options(),
					'condition'   => [
						'posts_to_show!' => 'custom',
					],
				]
			);
		}

		$this->add_control(
			'exclude_by_category',
			[
				'label'       => __( 'Exclude by Category', 'anwp-post-grid' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'default'     => [],
				'options'     => anwp_post_grid()->elements->get_category_options(),
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'hr4',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'offset',
			[
				'label'       => __( 'Posts Offset', 'anwp-post-grid' ),
				'description' => __( 'number of post to pass over', 'anwp-post-grid' ),
				'label_block' => false,
				'type'        => Controls_Manager::NUMBER,
				'min'         => 0,
				'step'        => 1,
				'default'     => 0,
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'hr5',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->add_control(
			'published_in_last_days',
			[
				'label'       => __( 'Published in Last days', 'anwp-post-grid' ),
				'label_block' => false,
				'type'        => Controls_Manager::NUMBER,
				'min'         => 0,
				'default'     => 0,
				'condition'   => [
					'posts_to_show!' => 'custom',
				],
			]
		);

		$this->end_controls_section();

		/*
		|--------------------------------------------------------------------
		| Header
		|--------------------------------------------------------------------
		*/
		$this->start_controls_section(
			'section_anwp_grid_header',
			[
				'label' => __( 'Widget Header', 'anwp-post-grid' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'grid_widget_title',
			[
				'label'       => __( 'Title', 'anwp-post-grid' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'anwp-post-grid' ),
			]
		);

		$this->add_control(
			'header_style',
			[
				'label'        => __( 'Header Style', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => [
					'a' => __( 'Style A', 'anwp-post-grid' ),
					'b' => __( 'Style B', 'anwp-post-grid' ),
					'c' => __( 'Style C', 'anwp-post-grid' ),
					'd' => __( 'Style D', 'anwp-post-grid' ),
					'e' => __( 'Style E', 'anwp-post-grid' ),
					'f' => __( 'Style F', 'anwp-post-grid' ),
					'g' => __( 'Style G', 'anwp-post-grid' ),
				],
				'default'      => 'b',
				'prefix_class' => 'anwp-pg-widget-header-style--',
			]
		);

		$this->add_control(
			'header_size',
			[
				'label'   => __( 'Header Text HTML Tag', 'anwp-post-grid' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Header Text Color', 'anwp-post-grid' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .anwp-pg-widget-header__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'header_icon',
			[
				'label' => __( 'Header Icon', 'anwp-post-grid' ),
				'type'  => Controls_Manager::ICONS,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .anwp-pg-widget-header__title',
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label'     => __( 'Secondary Color', 'anwp-post-grid' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#61CE70',
				'selectors' => [
					'{{WRAPPER}} .anwp-pg-widget-header__secondary-line'                       => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.anwp-pg-widget-header-style--b .anwp-pg-widget-header__title' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.anwp-pg-widget-header-style--c .anwp-pg-widget-header__title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'header_margin_bottom',
			[
				'label'      => __( 'Bottom Margin', 'anwp-post-grid' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors'  => [
					'{{WRAPPER}} .anwp-pg-widget-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'secondary_line_size',
			[
				'label'      => __( 'Secondary Line Size', 'anwp-post-grid' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors'  => [
					'{{WRAPPER}}.anwp-pg-widget-header-style--b .anwp-pg-widget-header__secondary-line' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.anwp-pg-widget-header-style--c .anwp-pg-widget-header__secondary-line' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.anwp-pg-widget-header-style--d .anwp-pg-widget-header__secondary-line' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.anwp-pg-widget-header-style--e .anwp-pg-widget-header__secondary-line' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.anwp-pg-widget-header-style--f .anwp-pg-widget-header__secondary-line' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.anwp-pg-widget-header-style--g .anwp-pg-widget-header__secondary-line' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.anwp-pg-widget-header-style--g .anwp-pg-widget-header__title' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * After Control Section - Header.
		 *
		 * @param AnWP_Post_Grid_Element_Classic_Slider $this The element.
		 *
		 * @since 0.7.0
		 */
		do_action( 'anwp-pg-el/element-classic-slider/after_control_section_header', $this );

		/*
		|--------------------------------------------------------------------
		| Styles and Layout Section
		|--------------------------------------------------------------------
		*/
		$this->start_controls_section(
			'section_anwp_grid_style_layout',
			[
				'label' => __( 'Styles and Layout', 'anwp-post-grid' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label'        => __( 'Show Excerpt', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'anwp-post-grid' ),
				'label_off'    => __( 'No', 'anwp-post-grid' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'hr_style_1',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'show_category',
			[
				'label'        => __( 'Show Category', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'anwp-post-grid' ),
				'label_off'    => __( 'No', 'anwp-post-grid' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'category_limit',
			[
				'label'     => __( 'Category Limit', 'anwp-post-grid' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 7,
				'step'      => 1,
				'default'   => 1,
				'condition' => [
					'show_category' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_date',
			[
				'label'        => __( 'Show Post Date', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'anwp-post-grid' ),
				'label_off'    => __( 'No', 'anwp-post-grid' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_comments',
			[
				'label'        => __( 'Show Comments & Views', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'anwp-post-grid' ),
				'label_off'    => __( 'No', 'anwp-post-grid' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'hr_style_4',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'card_height',
			[
				'label'      => __( 'Post Card Height (px)', 'anwp-post-grid' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 150,
						'max'  => 500,
						'step' => 10,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 180,
				],
			]
		);

		$this->add_control(
			'hr_style_7',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'label'   => __( 'Image Size', 'anwp-post-grid' ),
				'name'    => 'grid_thumbnail',
				'exclude' => [ 'custom' ],
				'default' => 'medium',
			]
		);

		$this->add_control(
			'hr_style_8',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'category_background',
			[
				'label'     => __( 'Category Background Color', 'anwp-post-grid' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'alpha'     => false,
				'selectors' => [
					'{{WRAPPER}} .anwp-pg-classic-slider .anwp-pg-category__wrapper-filled' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'card_bg_color',
			[
				'label'     => __( 'Post Card Background Color', 'anwp-post-grid' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'alpha'     => true,
				'selectors' => [
					'{{WRAPPER}} .anwp-pg-classic-slider .anwp-pg-post-teaser__content' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'card_bg_color_hover',
			[
				'label'     => __( 'Post Card Background Color on Hover', 'anwp-post-grid' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'alpha'     => true,
				'selectors' => [
					'{{WRAPPER}} .anwp-pg-classic-slider .anwp-pg-post-teaser--layout-d:hover .anwp-pg-post-teaser__content' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'hr_style_21',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'post_content_text_align',
			[
				'label'     => __( 'Title and Meta Text Align', 'anwp-post-grid' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''       => __( 'default', 'anwp-post-grid' ),
					'center' => __( 'center', 'anwp-post-grid' ),
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .anwp-pg-post-teaser__title' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .anwp-pg-post-teaser__bottom-meta' => '-ms-flex-pack: {{VALUE}} !important; justify-content: {{VALUE}} !important;: ;',
				],
			]
		);

		$this->add_control(
			'post_excerpt_text_align',
			[
				'label'     => __( 'Excerpt Text Align', 'anwp-post-grid' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''       => __( 'default', 'anwp-post-grid' ),
					'center' => __( 'center', 'anwp-post-grid' ),
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .anwp-pg-post-teaser__content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'post_title_options_heading',
			[
				'label'     => __( 'Post Title', 'anwp-post-grid' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_teaser_title',
				'label'    => __( 'Typography', 'anwp-post-grid' ),
				'selector' => '{{WRAPPER}} .anwp-pg-post-teaser__title a',
			]
		);

		$this->add_control(
			'post_title_color',
			[
				'label'     => __( 'Color', 'anwp-post-grid' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .anwp-pg-post-teaser__title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'post_meta_options_heading',
			[
				'label'     => __( 'Post Meta', 'anwp-post-grid' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography_teaser_meta',
				'label'    => __( 'Typography', 'anwp-post-grid' ),
				'selector' => '{{WRAPPER}} .anwp-pg-post-teaser__meta-comments, {{WRAPPER}} .anwp-pg-post-teaser__category-wrapper, {{WRAPPER}} .anwp-pg-post-teaser__meta-views, {{WRAPPER}} .anwp-pg-post-teaser__bottom-meta',
			]
		);

		$this->add_control(
			'post_meta_vertical_margin',
			[
				'label'     => __( 'Vertical Margin', 'anwp-post-grid' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'-5px' => '-5px',
					'0'    => '0',
					'5px'  => '5px',
					'10px' => '10px',
					'15px' => '15px',
					'20px' => '20px',
				],
				'default'   => '10px',
				'selectors' => [
					'{{WRAPPER}} .anwp-pg-post-teaser__bottom-meta' => 'margin-top: {{VALUE}}; margin-bottom: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'post_meta_background_color',
			[
				'label'     => __( 'Background Color', 'anwp-post-grid' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .anwp-pg-post-teaser__bottom-meta' => 'background-color: {{VALUE}}; padding: 3px 5px;',
				],
			]
		);

		$this->end_controls_section();

		/*
		|--------------------------------------------------------------------
		| Read More button
		|--------------------------------------------------------------------
		*/
		$this->start_controls_section(
			'section_anwp_grid_read_more',
			[
				'label' => __( 'Read More', 'anwp-post-grid' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_read_more',
			[
				'label'        => __( 'Show "Read More" button', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'anwp-post-grid' ),
				'label_off'    => __( 'No', 'anwp-post-grid' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'read_more_label',
			[
				'label'       => __( '"Read more" alternative text', 'anwp-post-grid' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
			]
		);

		$this->add_control(
			'read_more_class',
			[
				'label'       => __( '"Read more" custom classes', 'anwp-post-grid' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
			]
		);

		$this->add_control(
			'read_more_class_note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw'  => 'You can use Bootstrap Button classes. <br>E.g.: "btn btn-danger"<br> More info <a target="_blank" href="https://getbootstrap.com/docs/4.5/components/buttons/">here</a><br>Default: "btn btn-sm btn-outline-info w-100 text-decoration-none"',
			]
		);

		$this->end_controls_section();

		/*
		|--------------------------------------------------------------------
		| Slider Options
		|--------------------------------------------------------------------
		*/
		$this->start_controls_section(
			'section_anwp_grid_slider',
			[
				'label' => __( 'Slider Options', 'anwp-post-grid' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'       => __( 'Slides to Show', 'anwp-post-grid' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'max'         => 8,
				'default'     => 3,
				'required'    => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'required' => false,
						'default'  => 2,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'required' => false,
						'default'  => 1,
					],
				],
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label'       => __( 'Slides to Scroll', 'anwp-post-grid' ),
				'description' => __( 'Set how many slides are scrolled per swipe.', 'anwp-post-grid' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'max'         => 8,
				'default'     => 1,
				'required'    => true,
				'device_args' => [
					Controls_Stack::RESPONSIVE_TABLET => [
						'required' => false,
						'default'  => 1,
					],
					Controls_Stack::RESPONSIVE_MOBILE => [
						'required' => false,
						'default'  => 1,
					],
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => __( 'Autoplay', 'anwp-post-grid' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'anwp-post-grid' ),
					'no'  => __( 'No', 'anwp-post-grid' ),
				],
			]
		);

		$this->add_control(
			'autoplay_delay',
			[
				'label'     => __( 'Autoplay Speed (ms)', 'anwp-post-grid' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'spacing_between',
			[
				'label'   => __( 'Distance between slides in px', 'anwp-post-grid' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20,
				],
			]
		);

		$this->add_control(
			'direction',
			[
				'label'   => __( 'Direction', 'anwp-post-grid' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => [
					'ltr' => __( 'Left', 'anwp-post-grid' ),
					'rtl' => __( 'Right', 'anwp-post-grid' ),
				],
			]
		);

		$this->add_control(
			'effect',
			[
				'label'       => __( 'Effect', 'anwp-post-grid' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'slide',
				'options'     => [
					'slide' => __( 'Slide', 'anwp-post-grid' ),
					'fade'  => __( 'Fade', 'anwp-post-grid' ),
				],
				'description' => __( 'Fade effect works when "Slides to Show" is 1', 'anwp-post-grid' ),
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'   => __( 'Navigation', 'anwp-post-grid' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dots',
				'options' => [
					'both'   => __( 'Arrows and Dots', 'anwp-post-grid' ),
					'arrows' => __( 'Arrows', 'anwp-post-grid' ),
					'dots'   => __( 'Dots', 'anwp-post-grid' ),
					'none'   => __( 'None', 'anwp-post-grid' ),
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label'        => __( 'Arrows Position', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'inside',
				'options'      => [
					'inside'  => __( 'Inside', 'anwp-post-grid' ),
					'outside' => __( 'Outside', 'anwp-post-grid' ),
				],
				'prefix_class' => 'elementor-arrows-position-',
				'condition'    => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __( 'Arrows Color', 'anwp-post-grid' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label'        => __( 'Dots Position', 'anwp-post-grid' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'outside',
				'options'      => [
					'outside' => __( 'Outside', 'anwp-post-grid' ),
					'inside'  => __( 'Inside', 'anwp-post-grid' ),
				],
				'prefix_class' => 'elementor-pagination-position-',
				'condition'    => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __( 'Dots Color', 'anwp-post-grid' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label'     => __( 'Dots Size', 'anwp-post-grid' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Before end of controls.
		 *
		 * @param AnWP_Post_Grid_Element_Classic_Slider $this The element.
		 *
		 * @since 0.7.0
		 */
		do_action( 'anwp-pg-el/element-classic-slider/before_controls_end', $this );

		/**
		 * Before end of controls.
		 *
		 * @param Widget_Base $this The element.
		 *
		 * @since 0.7.0
		 */
		do_action( 'anwp-pg-el/element/before_controls_end', $this );
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since  0.6.0
	 * @access protected
	 */
	protected function render() {

		/*
		|--------------------------------------------------------------------
		| Merge arguments into defaults array
		|--------------------------------------------------------------------
		*/
		$data = (object) wp_parse_args(
			$this->get_settings_for_display(),
			[
				'posts_to_show' => 'latest',
				'limit'         => 3,
				'header_icon'   => '',
			]
		);

		/*
		|--------------------------------------------------------------------
		| Get Posts
		|--------------------------------------------------------------------
		*/
		$data->slider_posts = anwp_post_grid()->elements->get_grid_posts( $data );

		// Icon
		if ( ! empty( $data->header_icon ) ) {
			ob_start();

			Icons_Manager::render_icon( $data->header_icon, [ 'class' => 'anwp-pg-widget-header__icon' ], 'span' );
			$data->header_icon = ob_get_clean();
		}

		/*
		|--------------------------------------------------------------------
		| Render
		|--------------------------------------------------------------------
		*/
		anwp_post_grid()->load_partial( $data, 'classic-slider' );
	}
}

