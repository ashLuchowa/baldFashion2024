<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class Rivax_Helper {

    public static $_instance;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     */
    public static function get_instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    /**
     * Load Construct
     *
     */
    public function __construct(){

        // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            return false;
        }


        // Custom Elementor Controller for rivax-select2
        add_action('wp_ajax_rivax_select2_search_query', [$this, 'rivax_select2_search_query']);
        add_action('wp_ajax_nopriv_rivax_select2_search_query', [$this, 'rivax_select2_search_query']);

        add_action('wp_ajax_rivax_select2_get_title', [$this, 'rivax_select2_get_title']);
        add_action('wp_ajax_nopriv_rivax_select2_get_title', [$this, 'rivax_select2_get_title']);


        // Load more posts
        add_action('wp_ajax_rivax_get_load_more_posts', [$this, 'rivax_get_load_more_posts']);
        add_action('wp_ajax_nopriv_rivax_get_load_more_posts', [$this, 'rivax_get_load_more_posts']);


	    // Mailchimp
	    add_action('wp_ajax_rivax_mailchimp_subscribe', [$this, 'rivax_mailchimp_subscribe']);
	    add_action('wp_ajax_nopriv_rivax_mailchimp_subscribe', [$this, 'rivax_mailchimp_subscribe']);
		
		
		// Contact Form
        add_action('wp_ajax_rivax_submit_contact_form', [$this, 'rivax_submit_contact_form']);
        add_action('wp_ajax_nopriv_rivax_submit_contact_form', [$this, 'rivax_submit_contact_form']);
		
		
		// Autoload next post in single post
        add_action('wp_ajax_rivax_autoload_next_post', [$this, 'rivax_autoload_next_post']);
        add_action('wp_ajax_nopriv_rivax_autoload_next_post', [$this, 'rivax_autoload_next_post']);

    }

    /*
     * $posts_source = post type
     * $source_type = post, taxonomy, author
     * */
    public function rivax_select2_search_query() {
        $posts_source = 'post';
        $source_type = 'post';

        if ( !empty( $_GET[ 'source_type' ] ) ) {
            $source_type = sanitize_text_field( $_GET[ 'source_type' ] );
        }

        if ( !empty( $_GET[ 'posts_source' ] ) ) {
            $posts_source = sanitize_text_field( $_GET[ 'posts_source' ] );
        }

        $search = !empty( $_GET[ 'term' ] ) ? sanitize_text_field( $_GET[ 'term' ] ) : '';
        $results = $query_result = [];

        if($source_type == 'post') {
            $args = [
                'post_type' => $posts_source,
                'numberposts' => '10',
                's'           => $search,
            ];
            $query_result = wp_list_pluck(get_posts($args), 'post_title', 'ID');
        }
        elseif($source_type == 'taxonomy') {
            $taxonomies = get_object_taxonomies( $posts_source );

            if($taxonomies) {
                $args = [
                    'hide_empty' => false,
                    'taxonomy' => $taxonomies,
                    'number'     => '10',
                    'search'     => $search,
                    'fields'     => 'all',
                ];

                $terms_result = get_terms($args);
                foreach ($terms_result as $term_item) {
                    $query_result[$term_item->term_id] = $term_item->taxonomy . ': ' . $term_item->name;
                }
            }

        }
        elseif($source_type == 'author') {
            $search = $search? '*' . $search . '*' : '';
            $args = [
                'fields'  => [ 'ID', 'display_name' ],
                'orderby' => 'display_name',
                'has_published_posts' => true,
                'number'     => '10',
                'search'     => $search,
            ];
            $query_result = wp_list_pluck(get_users($args), 'display_name', 'ID');
        }


        if ( !empty( $query_result ) ) {
            foreach ( $query_result as $key => $item ) {
                $results[] = [ 'text' => $item, 'id' => $key ];
            }
        }

        wp_send_json( [ 'results' => $results ] );
        wp_die();
    }


    public function rivax_select2_get_title() {

        if ( empty( $_POST[ 'id' ] ) ) {
            wp_send_json_error( [] );
        }

        if ( empty( array_filter($_POST[ 'id' ]) ) ) {
            wp_send_json_error( [] );
        }
        $ids          = array_map('intval',$_POST[ 'id' ]);

        $source_type = 'post';

        if ( !empty( $_POST[ 'source_type' ] ) ) {
            $source_type = sanitize_text_field( $_POST[ 'source_type' ] );
        }

        $results = $query_result = [];

        if($source_type == 'post') {
            $args = [
                'post_type' => 'any',
                'numberposts' => '-1',
                'orderby'     => 'title',
                'order'     => 'ASC',
                'include'    => $ids,
            ];
            $query_result = wp_list_pluck(get_posts($args), 'post_title', 'ID');
        }
        elseif($source_type == 'taxonomy') {
            $args = [
                'hide_empty' => false,
                'include'    => $ids,
                'fields'     => 'all',
            ];

            $terms_result = get_terms($args);
            foreach ($terms_result as $term_item) {
                $query_result[$term_item->term_id] = $term_item->taxonomy . ': ' . $term_item->name;
            }
        }
        elseif($source_type == 'author') {
            $args = [
                'fields'  => [ 'ID', 'display_name' ],
                'include'    => $ids,
            ];
            $query_result = wp_list_pluck(get_users($args), 'display_name', 'ID');
        }


        $results = $query_result;

        if ( !empty( $results ) ) {
            wp_send_json_success( [ 'results' => $results ] );
        } else {
            wp_send_json_error( [] );
        }
        wp_die();

    }



    /**
     * Get load more ajax posts
     */
    public function rivax_get_load_more_posts() {

        $post_id   = esc_attr($_POST['postId']);
        $widget_id = esc_attr($_POST['widgetId']);

        $data = array(
            'data'              => '',
            'no_more'           => true,
            'msg'       => esc_html__( 'No more posts found!', 'raveen' ),
        );

        $elementor = \Elementor\Plugin::$instance;
        $elements      = $elementor->documents->get( $post_id )->get_elements_data();

        if($elements) {

            $widget_data = $this->find_element_recursive( $elements, $widget_id );

            if($widget_data) {
                $widget = $elementor->elements_manager->create_element_instance( $widget_data );
                $rendered_widget = $widget->render_ajax_posts();
                $data = array(
                    'data'          => $rendered_widget['data'],
                    'no_more'       => $rendered_widget['no_more'],
                    'msg'           => $rendered_widget['msg'],
                );
            }

        }

        wp_send_json( $data );
    }


    public function find_element_recursive( $elements, $form_id ) {

        foreach ( $elements as $element ) {
            if ( $form_id === $element['id'] ) {
                return $element;
            }

            if ( ! empty( $element['elements'] ) ) {
                $element = $this->find_element_recursive( $element['elements'], $form_id );

                if ( $element ) {
                    return $element;
                }
            }
        }

        return false;
    }



	/**
	 * Mailchimp subscriber handler Ajax call
	 */
	public function rivax_mailchimp_subscribe() {

		parse_str( isset( $_POST['subscriber_info'] ) ? $_POST['subscriber_info'] : '', $subsciber );


		$return = [];

		$api_key = rivax_get_option('mailchimp-api-key');
		$double_opt_in = rivax_get_option('mailchimp-double-opt-in');


		$auth = [
			'api_key' => $api_key,
			'list_id' => esc_attr($_POST['list_id']),
		];

		$data = [
			'email_address' => ( isset( $subsciber['email'] ) ? sanitize_email($subsciber['email']) : '' ),
			'status'        => $double_opt_in? 'pending' : 'subscribed' ,
			'status_if_new' => $double_opt_in ? 'pending' : 'subscribed' ,
			'merge_fields'  => [
				'FNAME' => ( isset( $subsciber['fname'] ) ? esc_attr($subsciber['fname']) : '' ),
				'LNAME' => ( isset( $subsciber['lname'] ) ? esc_attr($subsciber['lname']) : '' ),
				'PHONE' => ( isset( $subsciber['phone'] ) ? esc_attr($subsciber['phone']) : '' ),
			],
		];


		$server = explode( '-', $auth['api_key'] );

		if ( ! isset( $server[1] ) ) {
            $return = ['status' => 0, 'msg' => esc_html__( 'Invalid API key.', 'raveen' )];
            echo wp_send_json( $return );
            wp_die();
		}

		$url = 'https://' . $server[1] . '.api.mailchimp.com/3.0/lists/' . $auth['list_id'] . '/members/';

		$response = wp_remote_post(
			$url,
			[
				'method'      => 'POST',
				'data_format' => 'body',
				'timeout'     => 45,
				'headers'     => [
					'Authorization' => 'apikey ' . $auth['api_key'],
					'Content-Type'  => 'application/json; charset=utf-8',
				],
				'body'        => json_encode( $data ),
			]
		);

		if ( is_wp_error( $response ) ) {
			$error_message    = $response->get_error_message();
			$return['status'] = 0;
			$return['msg']    = esc_html__( 'Something went wrong: ', 'raveen' ) . esc_html( $error_message );
		} else {
			$body           = (array) json_decode( $response['body'] );
			$return['body'] = $body;
			if ( $body['status'] > 399 && $body['status'] < 600 ) {
				$return['status'] = 0;
				$return['msg']    = $body['title'];
			} elseif ( $body['status'] == 'subscribed' ) {
				$return['status'] = 1;
				$return['msg']    = esc_html__( 'You have subscribed successfully.', 'raveen' );
			} elseif ( $body['status'] == 'pending' ) {
				$return['status'] = 1;
				$return['msg']    = esc_html__( 'Please confirm your subscription from your email.', 'raveen' );
			} else {
				$return['status'] = 0;
				$return['msg']    = esc_html__( 'Something went wrong. Try again later.', 'raveen' );
			}
		}


		echo wp_send_json( $return );

		wp_die();
	}
	
	
	/**
     * Contact Form
     * msg: fill | error | success
     */
    public function rivax_submit_contact_form() {

        if ( empty($_POST['firstName']) || empty($_POST['email']) || !is_email($_POST['email']) || empty($_POST['message'])) {
            wp_send_json( ['msg' => 'fill'] );
        }

        $name = esc_html($_POST['firstName']);
        if(!empty($_POST['lastName'])) {
            $name .= ' ' . esc_html($_POST['lastName']);
        }
        $email = sanitize_email($_POST['email']);
        $subject = empty($_POST['subject'])? '' : esc_attr($_POST['subject']);
        $message = sanitize_textarea_field($_POST['message']);

        $admin_mail = esc_attr(get_bloginfo('admin_email'));

        do_action('rivax_contact_form_submit');

        // Send email
        $headers = "From: {$name} <{$email}>\r\n";
        $headers .= "Reply-To: {$email}\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8";

        $sent = wp_mail( $admin_mail, $subject, $message, $headers );

        if ( $sent ) {
            wp_send_json( ['msg' => 'success'] );
        }
        else {
            wp_send_json( ['msg' => 'error'] );
        }

        wp_die();

    }
	
	
	/**
     * Autoload next post
     */
    public function rivax_autoload_next_post() {

        if ( !isset($_POST['postsLoaded']) || !isset($_POST['nextID'])) {
            wp_send_json_error( [] );
        }

        global $wp_query;
        $max_load_posts = absint(rivax_get_option('autoload-next-post-max'));
        $posts_loaded = absint($_POST[ 'postsLoaded' ]) + 1;
        $next_ID = absint($_POST[ 'nextID' ]);
        $next_post_ID = 0; // For next auto load
        $content = '';


        $wp_query = new WP_Query( array( 'p' => $next_ID, 'post_type' => 'post' ) );

        if ( $wp_query->have_posts() ) {
            while ( $wp_query->have_posts() ) {
                $wp_query->the_post();

                // Set the next post id
                if($posts_loaded < $max_load_posts) {
                    if ( rivax_get_option('autoload-next-post-same-cat') ) {
                        $post_prev = get_previous_post( true );
                    } else {
                        $post_prev = get_previous_post();
                    }

                    if($post_prev) {
                        $next_post_ID = $post_prev ->ID;
                    }
                }

                ob_start(); // From single.php
                ?>
                <div class="single-post-wrapper">
                    <?php
                    $sidebar_position = rivax_get_sidebar_position ('single-post', 'none-narrow');
                    if($sidebar_position == 'elementor') {
                        ?>
                        <div class="content-wrapper">
                            <?php the_content(); ?>
                        </div>
                        <?php
                    }
                    else {
                        ?>
                        <?php if(rivax_get_option('autoload-next-post-content-top')) {get_template_part('template-parts/post/content-top');} ?>
                        <?php get_template_part('template-parts/post/single-hero'); ?>
                        <div class="content-wrapper">
                            <div class="container">
                                <div class="page-content-wrapper <?php echo 'sidebar-' . $sidebar_position; ?>">
                                    <div class="content-container">
                                        <?php get_template_part('template-parts/post/single-hero-inside'); ?>
                                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-content' ); ?> >
                                            <?php the_content(); ?>
                                            <?php wp_link_pages(); ?>
                                            <?php get_template_part('template-parts/post/tags'); ?>
                                        </article>
                                        <?php if(rivax_get_option('autoload-next-post-share-box')) {get_template_part('template-parts/post/share');} ?>
                                        <?php if(rivax_get_option('autoload-next-post-author-box')) {get_template_part('template-parts/post/author-box');} ?>
                                        <?php if(rivax_get_option('autoload-next-post-comments')) {comments_template();} ?>
                                    </div>
                                    <?php if($sidebar_position == 'left' || $sidebar_position == 'right'): ?>
                                        <aside class="sidebar-container <?php if(rivax_get_option('sticky-sidebar')) echo 'sticky'; ?>">
                                            <?php get_sidebar(); ?>
                                        </aside>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if(rivax_get_option('autoload-next-post-content-bottom')) {get_template_part('template-parts/post/content-bottom');} ?>
                        <?php
                    }
                    rivax_autoload_next_post_info();
                    ?>
                </div>
                <?php
                $content = ob_get_clean();
            }
        }

        // Restore original Post Data.
        wp_reset_postdata();

        wp_send_json_success( [ 'content' => $content , 'nextID' => $next_post_ID, 'loaded' => $posts_loaded] );
        wp_die();

    }


}
Rivax_Helper::get_instance();