<?php
namespace RivaxStudio\Traits;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


trait Rivax_Group_Control_Query {

	/**
	 * Register Query Controls
	 */
	protected function register_query_builder_controls() {

		$this->start_controls_section( 'section_post_query_builder', [
			'label' => esc_html__( 'Query', 'raveen' ) ,
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control(
			'posts_source',
			[
				'label'   => esc_html__( 'Posts Source', 'raveen' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->get_posts_source(),
				'default' => 'post',
			]
		);

		$this->add_control(
			'current_query_note',
			[
				'label'             => '',
				'type'              => Controls_Manager::RAW_HTML,
				'raw'               => esc_html__( 'Use it for archive template.', 'raveen' ),
				'content_classes'   => 'elementor-panel-alert elementor-panel-alert-info',
				'condition' => [
					'posts_source' => 'current_query',
				],
			]
		);

		$this->add_control(
			'related_posts_note',
			[
				'label'             => '',
				'type'              => Controls_Manager::RAW_HTML,
				'raw'               => esc_html__( 'Use it for related posts template.', 'raveen' ),
				'content_classes'   => 'elementor-panel-alert elementor-panel-alert-info',
				'condition' => [
					'posts_source' => 'related',
				],
			]
		);

		$this->add_control( 'posts_per_page', [
			'label'     => esc_html__( 'Posts Per Page', 'raveen' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => '3',
			'condition' => [
				'posts_source!' => ['current_query'],
			]
		] );

		$this->start_controls_tabs(
			'tabs_posts_include_exclude',
			[
				'condition' => [
					'posts_source!' => ['current_query', 'related'],
				]
			]
		);

		$this->start_controls_tab(
			'tab_posts_include',
			[
				'label'     => esc_html__( 'Include', 'raveen' ),
				'condition' => [
					'posts_source!' => ['current_query', 'related'],
				]
			]
		);

		$this->add_control(
			'posts_include_by',
			[
				'label'       => esc_html__( 'Include By', 'raveen' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => [
					'taxonomy' => esc_html__( 'Taxonomy', 'raveen' ),
					'authors' => esc_html__( 'Authors', 'raveen' ),
					'current_author' => esc_html__( 'Current Author', 'raveen' ),
					'manual_selection' => esc_html__( 'Manual Selection', 'raveen' ),
				],
				'condition'   => [
					'posts_source!' => ['current_query', 'related'],
				]
			]
		);

		$this->add_control(
			'posts_include_taxonomy_ids',
			array(
				'label'       => esc_html__( 'Select Taxonomy', 'raveen' ),
				'description'       => esc_html__( 'Select Categories, Tags, Post Format or custom taxonomies.', 'raveen' ),
				'label_block' => true,
				'type'        => 'rivax-select2',
				'multiple' => true,
				'source_type' => 'taxonomy',
				'condition'   => [
					'posts_include_by' => 'taxonomy',
					'posts_source!' => ['current_query', 'related'],
				]
			)
		);

		$this->add_control(
			'posts_include_author_ids',
			array(
				'label'       => esc_html__( 'Select Authors', 'raveen' ),
				'label_block' => true,
				'type'        => 'rivax-select2',
				'multiple' => true,
				'source_type' => 'author',
				'condition'   => [
					'posts_include_by' => 'authors',
					'posts_source!' => ['current_query', 'related'],
				]
			)
		);

		$this->add_control(
			'posts_include_post_ids',
			array(
				'label'       => esc_html__( 'Select Posts', 'raveen' ),
				'label_block' => true,
				'type'        => 'rivax-select2',
				'multiple' => true,
				'source_type' => 'post',
				'condition'   => [
					'posts_include_by' => 'manual_selection',
					'posts_source!' => ['current_query', 'related'],
				]
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_posts_exclude',
			[
				'label'     => esc_html__( 'Exclude', 'raveen' ),
				'condition' => [
					'posts_source!' => ['current_query', 'related'],
				]
			]
		);

		$this->add_control(
			'posts_exclude_by',
			[
				'label'       => esc_html__( 'Exclude By', 'raveen' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => [
					'taxonomy' => esc_html__( 'Taxonomy', 'raveen' ),
					'authors' => esc_html__( 'Authors', 'raveen' ),
					'current_author' => esc_html__( 'Current Author', 'raveen' ),
					'manual_selection' => esc_html__( 'Manual Selection', 'raveen' ),
				],
				'condition'   => [
					'posts_source!' => ['current_query', 'related'],
				]
			]
		);

		$this->add_control(
			'posts_exclude_taxonomy_ids',
			array(
				'label'       => esc_html__( 'Select Taxonomy', 'raveen' ),
				'description'       => esc_html__( 'Select Categories, Tags, Post Format or custom taxonomies.', 'raveen' ),
				'label_block' => true,
				'type'        => 'rivax-select2',
				'multiple' => true,
				'source_type' => 'taxonomy',
				'condition'   => [
					'posts_exclude_by' => 'taxonomy',
					'posts_source!' => ['current_query', 'related'],
				]
			)
		);

		$this->add_control(
			'posts_exclude_author_ids',
			array(
				'label'       => esc_html__( 'Select Authors', 'raveen' ),
				'label_block' => true,
				'type'        => 'rivax-select2',
				'multiple' => true,
				'source_type' => 'author',
				'condition'   => [
					'posts_exclude_by' => 'authors',
					'posts_source!' => ['current_query', 'related'],
				]
			)
		);

		$this->add_control(
			'posts_exclude_post_ids',
			array(
				'label'       => esc_html__( 'Select Posts', 'raveen' ),
				'label_block' => true,
				'type'        => 'rivax-select2',
				'multiple' => true,
				'source_type' => 'post',
				'condition'   => [
					'posts_exclude_by' => 'manual_selection',
					'posts_source!' => ['current_query', 'related'],
				]
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'posts_divider',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'posts_select_date',
			[
				'label'     => esc_html__( 'Date', 'raveen' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'anytime',
				'options'   => [
					'anytime' => esc_html__( 'All', 'raveen' ),
					'today'   => esc_html__( 'Past Day', 'raveen' ),
					'week'    => esc_html__( 'Past Week', 'raveen' ),
					'month'   => esc_html__( 'Past Month', 'raveen' ),
					'quarter' => esc_html__( 'Past Quarter', 'raveen' ),
					'year'    => esc_html__( 'Past Year', 'raveen' ),
					'exact'   => esc_html__( 'Custom', 'raveen' ),
				],
				'condition' => [
					'posts_source!' => 'current_query',
				]
			]
		);

		$this->add_control(
			'posts_date_before',
			[
				'label'       => esc_html__( 'Before', 'raveen' ),
				'type'        => Controls_Manager::DATE_TIME,
				'description' => esc_html__( 'Setting a ‘Before’ date will show all the posts published until the chosen date (inclusive).', 'raveen' ),
				'condition'   => [
					'posts_select_date' => 'exact',
					'posts_source!' => 'current_query',
				]
			]
		);

		$this->add_control(
			'posts_date_after',
			[
				'label'       => esc_html__( 'After', 'raveen' ),
				'type'        => Controls_Manager::DATE_TIME,
				'description' => esc_html__( 'Setting an ‘After’ date will show all the posts published since the chosen date (inclusive).', 'raveen' ),
				'condition'   => [
					'posts_select_date' => 'exact',
					'posts_source!' => 'current_query',
				]
			]
		);

		$this->add_control(
			'posts_orderby',
			[
				'label'   => esc_html__( 'Order By', 'raveen' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'title'         => esc_html__( 'Title', 'raveen' ),
					'date'          => esc_html__( 'Date', 'raveen' ),
					'views_count'   => esc_html__( 'Views Count', 'raveen' ),
					'modified'      => esc_html__( 'Last Modified Date', 'raveen' ),
					'author'        => esc_html__( 'Author', 'raveen' ),
					'comment_count' => esc_html__( 'Comment Count', 'raveen' ),
					'menu_order'    => esc_html__( 'Menu Order', 'raveen' ),
					'rand'          => esc_html__( 'Random', 'raveen' ),
				],
				'condition'    => [
					'posts_source!' => 'current_query',
				]
			]
		);

		$this->add_control(
			'posts_order',
			[
				'label'   => esc_html__( 'Order', 'raveen' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc'  => esc_html__( 'ASC', 'raveen' ),
					'desc' => esc_html__( 'DESC', 'raveen' ),
				],
				'condition'    => [
					'posts_source!' => 'current_query',
				]
			]
		);

		$this->add_control(
			'posts_ignore_sticky_posts',
			[
				'label'        => esc_html__( 'Ignore Sticky Posts', 'raveen' ),
				'type'         => Controls_Manager::SWITCHER,
				'condition'    => [
					'posts_source'     => 'post',
				]
			]
		);

		$this->add_control(
			'posts_ignore_current_post',
			[
				'label'        => esc_html__( 'Ignore Current Post', 'raveen' ),
				'type'         => Controls_Manager::SWITCHER,
				'condition'    => [
					'posts_source!' => 'current_query',
				]
			]
		);

		$this->add_control(
			'posts_only_with_featured_image',
			[
				'label'        => esc_html__( 'Only Featured Image Post', 'raveen' ),
				'description'  => esc_html__( 'Enable to display posts only when featured image is present.', 'raveen' ),
				'type'         => Controls_Manager::SWITCHER,
				'condition'    => [
					'posts_source!' => 'current_query',
				]
			]
		);

		$this->add_control(
			'posts_offset',
			[
				'label'        => esc_html__( 'Offset', 'raveen' ),
				'description'  => esc_html__( 'number of posts to skip them.', 'raveen' ),
				'type'         => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 20,
				'condition'    => [
					'posts_source!' => 'current_query',
				]
			]
		);
		
		$this->add_control(
            'query_id',
            [
                'label'       => esc_html__('Query ID', 'raveen'),
                'description' => esc_html__('Give your Query a custom unique id to allow server side filtering.', 'raveen'),
                'type'        => Controls_Manager::TEXT,
                'separator'   => 'before',
            ]
        );

		$this->end_controls_section();

	}


	/**
	 * Get All Post Source
	 * @return array
	 */
	protected function get_posts_source()
	{
		$post_types = get_post_types(['public' => true, 'show_in_nav_menus' => true], 'objects');
		$post_types = wp_list_pluck($post_types, 'label', 'name');

		$include = [
			'related' => esc_html__( 'Related Posts', 'raveen' ),
			'current_query' => esc_html__( 'Current Query', 'raveen' ),
		];

		$post_types = array_merge($post_types, $include);
		unset($post_types['elementor_library'], $post_types['page'], $post_types['e-landing-page'], $post_types['product'], $post_types['e-floating-buttons']);

		return $post_types;
	}


	/**
	 * @param array $term_ids
	 *
	 * @return array
	 */
	private function group_terms_by_taxonomy( $term_ids = [] ) {

		if(!$term_ids)
			return [];

		$terms = get_terms(
			[
				'include' => $term_ids,
				'hide_empty'       => false,
			] );

		$group_terms = [];

		foreach ( $terms as $term ) {
			$group_terms[ $term->taxonomy ][] = $term->term_id;
		}

		return $group_terms;
	}


	/**
	 * @return array
	 */
	private function get_meta_args() {

		$args = [];
		$settings = $this->get_settings_for_display();


		/**
		 * Order
		 */
		$args['order']   = $settings[ 'posts_order' ];

		if($settings[ 'posts_orderby' ] == 'views_count') {
			$args['orderby']  = 'meta_value_num';
			$args['meta_key'] = 'post_views';
		}
		else {
			$args['orderby'] = $settings[ 'posts_orderby' ];
		}


		/**
		 * Set Feature Images
		 */
		if ( $settings[ 'posts_only_with_featured_image' ] ) {
			$args['meta_key'] = '_thumbnail_id';
		}


		/**
		 * Set Ignore Sticky
		 */
		if ( $settings['posts_source'] == 'post' && $settings[ 'posts_ignore_sticky_posts' ] ) {
			$args['ignore_sticky_posts'] = true;
		}


		/**
		 * Set Date
		 */

		$selected_date = $settings['posts_select_date'];

		if ( $selected_date ) {
			$date_query = [];

			switch ( $selected_date ) {
				case 'today':
					$date_query['after'] = '-1 day';
					break;

				case 'week':
					$date_query['after'] = '-1 week';
					break;

				case 'month':
					$date_query['after'] = '-1 month';
					break;

				case 'quarter':
					$date_query['after'] = '-3 month';
					break;

				case 'year':
					$date_query['after'] = '-1 year';
					break;

				case 'exact':
					$after_date = $settings['posts_date_after'];
					if ( $after_date ) {
						$date_query['after'] = $after_date;
					}

					$before_date = $settings['posts_date_before'];
					if ( $before_date ) {
						$date_query['before'] = $before_date;
					}

					$date_query['inclusive'] = true;
					break;
			}

			if ( $date_query ) {
				$args['date_query'] = $date_query;
			}
		}

		return $args;

	}


	/**
	 * Returns the paged number for the query.
	 *
	 * @return int
	 */
	protected function get_paged() {
		$settings = $this->get_settings_for_display();
		$pagination_type = isset($settings['pagination_type'])? $settings['pagination_type'] : 'none';

		if ( in_array($pagination_type, ['load_more', 'infinite_scroll']) ) {
			if ( isset( $_POST['pageNumber'] ) && $_POST['pageNumber'] ) {
				return $_POST['pageNumber'];
			}
		}

		return max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
	}



	/**
	 * Get Query Args
	 *
	 * @return array
	 */
	protected function get_query_args() {

		$args = [];
		$settings = $this->get_settings_for_display();
		$pagination_type = isset($settings['pagination_type'])? $settings['pagination_type'] : 'none';

		/**
		 * Set paged
		 * Disable args['paged'] for widgets that have not pagination to prevent paginate them by mistake.
		 */
		$paged = ( $pagination_type != 'none' )? $this->get_paged() : '';
		$args['paged'] = $paged;


		/**
		 * Current Query
		 */
		if( $settings['posts_source'] == 'current_query' ) {

			if (\Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode()) {
				$args = [
					'post_type'         => 'post',
					'post_status'       => 'publish',
					'posts_per_page'    => intval(get_option( 'posts_per_page' )),
				];
			}
			else {

				$args = $GLOBALS['wp_query']->query_vars;

				if( in_array($pagination_type, ['load_more', 'infinite_scroll']) && empty($args) && !empty($_POST['qVars']) ) { // Fix load more query_vars
					$args = $_POST['qVars'];
					$args = $this->validate_load_more_current_query_args($args);
				}

				$args['paged'] = $paged; // Fix Load more paged
				$args['post_status']         = 'publish';

				$args = apply_filters( 'RivaxStudio/Traits/get_query_args/current_query', $args );
			}

			return $args;
		}


		/**
		 * Posts Per Page
		 */
		$args['posts_per_page'] = $settings['posts_per_page'];


		/**
		 * Single Post Id
		 */
		$single_post_id = ( is_singular() && get_queried_object_id() )? intval(get_queried_object_id()) : 0;

		/**
		 * Post Type
		 */
		$post_type = 'post';
		if( $settings['posts_source'] == 'related' ) {

			if (\Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode()) {
				$post_type = 'post';
			}
			elseif($single_post_id) {
				$post_type = get_post_type($single_post_id);
			}
		}
		else {
			$post_type = $settings['posts_source'];
		}

		$args['post_status']         = 'publish';
		$args['suppress_filters']    = false;
		$args['post_type']           = $post_type;


		if( $settings['posts_source'] != 'related' ) {

			/**
			 * Authors
			 */
			$author__in = [];
			$author__not_in = [];

			if( in_array( 'authors', (array)$settings['posts_include_by'] )) {
				$author__in = wp_parse_id_list( $settings['posts_include_author_ids'] );
			}

			if( in_array( 'authors', (array)$settings['posts_exclude_by'] )) {
				$author__not_in = wp_parse_id_list( $settings['posts_exclude_author_ids'] );
			}

			if( $single_post_id && in_array( 'current_author', (array)$settings['posts_include_by'] ) ) {
				$single_author_id = get_post_field( 'post_author', $single_post_id );
				$author__in[] = intval($single_author_id);
			}

			if($single_post_id && in_array( 'current_author', (array)$settings['posts_exclude_by'] ) ) {
				$single_author_id = get_post_field( 'post_author', $single_post_id );
				$author__not_in[] = intval($single_author_id);
			}

			if($author__in) {
				$args['author__in'] = $author__in;
			}
			if($author__not_in) {
				$args['author__not_in'] = $author__not_in;
			}

		}


		/**
		 * Manual Selection
		 */
		$post__in = [];
		$post__not_in = [];

		if( $settings['posts_source'] != 'related' ) {

			if( in_array( 'manual_selection', (array)$settings['posts_include_by'] )) {
				$post__in = wp_parse_id_list( $settings['posts_include_post_ids'] );
			}

			if( in_array( 'manual_selection', (array)$settings['posts_exclude_by'] )) {
				$post__not_in = wp_parse_id_list( $settings['posts_exclude_post_ids'] );
			}

		}

		if( $single_post_id && $settings['posts_ignore_current_post'] ) {
			$post__not_in[] = $single_post_id;
		}

		if($post__in) {
			$args['post__in'] = $post__in;
		}
		if($post__not_in) {
			$args['post__not_in'] = $post__not_in;
		}



		/**
		 * Taxonomy
		 */
		$include_term_ids = [];
		$exclude_term_ids = [];

		if( $settings['posts_source'] == 'related' ) {
			if($single_post_id && !(\Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode())) {
				$taxonomies = get_object_taxonomies( $post_type );
				if($post_type == 'post') { // Remove post_format taxonomy from post
					$taxonomies = array_diff( $taxonomies, ['post_format'] );
				}

				if($taxonomies) {
					$include_term_ids = wp_get_post_terms($single_post_id, $taxonomies, ['fields' => 'ids', 'orderby' => 'count', 'order' => 'DESC', 'number' => 6]);
				}

			}
		}
		else {
			if( in_array( 'taxonomy', (array)$settings['posts_include_by'] ) ) {
				$include_term_ids = wp_parse_id_list( $settings['posts_include_taxonomy_ids'] );
			}

			if( in_array( 'taxonomy', (array)$settings['posts_exclude_by'] ) ) {
				$exclude_term_ids = wp_parse_id_list( $settings['posts_exclude_taxonomy_ids'] );
				$exclude_term_ids = array_diff( $exclude_term_ids, $include_term_ids );
			}
		}

		$include_taxonomy_terms = $this->group_terms_by_taxonomy($include_term_ids);
		$exclude_taxonomy_terms = $this->group_terms_by_taxonomy($exclude_term_ids);

		$terms_query = [];

		if ( $include_taxonomy_terms ) {

			foreach ( $include_taxonomy_terms as $tax => $terms ) {
				$terms_query[] = [
					'taxonomy' => $tax,
					'field'    => 'term_id',
					'terms'    => $terms,
					'operator' => 'IN',
				];
			}
		}

		if ( $exclude_taxonomy_terms ) {

			foreach ( $exclude_taxonomy_terms as $tax => $terms ) {
				$terms_query[] = [
					'taxonomy' => $tax,
					'field'    => 'term_id',
					'terms'    => $terms,
					'operator' => 'NOT IN',
				];
			}
		}


		if ( $terms_query ) {
			$args['tax_query']             = $terms_query;
			$args['tax_query']['relation'] = 'AND';
		}


		$args = array_merge($args, $this->get_meta_args());

		return $args;

	}



	/**
	 * Get Query
	 * @return array
	 */
	protected function get_query_result() {
		$settings = $this->get_settings_for_display();

		$query_args = $this->get_query_args();

		$offset_control = $settings['posts_offset'];

		if ( 0 < $offset_control ) {
			/**
			 * Offset break the pagination. Using WordPress's work around
			 *
			 * @see https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
			 */
			add_action( 'pre_get_posts', [ $this, 'fix_query_offset' ], 1 );
			add_filter( 'found_posts', [ $this, 'fix_query_found_posts' ], 1 );
		}
		
		if ($settings['query_id']) {
            $query_id = $settings['query_id'];
            $query_args = apply_filters("RivaxStudio/Query/{$query_id}", $query_args);
        }

		$query_result = new \WP_Query( $query_args );

		remove_action( 'pre_get_posts', [ $this, 'fix_query_offset' ], 1 );
		remove_filter( 'found_posts', [ $this, 'fix_query_found_posts' ], 1 );

		return $query_result;

	}


	/**
	 * @param \WP_Query $query
	 */
	public function fix_query_offset( &$query ) {
		$settings = $this->get_settings_for_display();
		$offset = $settings['posts_offset'];

		if ( $query->is_paged ) {
			$post_offset = $offset + ( ( intval($query->query_vars['paged']) - 1 ) * intval($query->query_vars['posts_per_page']) );
		} else {
			$post_offset = $offset;
		}

		$query->set('offset', $post_offset);
	}

	/**
	 * @param int       $found_posts
	 *
	 * @return int
	 */
	public function fix_query_found_posts( $found_posts ) {
		$settings = $this->get_settings_for_display();
		$offset = $settings['posts_offset'];

		if ( $offset ) {
			$found_posts -= $offset;
		}

		return $found_posts;
	}


	/*
	 * validate args for current query load more
	 * */
	protected function validate_load_more_current_query_args ($args) {
		if(!is_array($args)) {
            return [];
        }

        $unnecessary_args = ['cache_results', 'update_post_term_cache', 'lazy_load_term_meta', 'update_post_meta_cache', 'comments_per_page'];
        $args = array_filter($args);
        $args = array_diff_key($args, array_flip($unnecessary_args));

		return $args;
	}


}

