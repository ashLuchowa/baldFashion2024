<?php
namespace RivaxStudio\Traits;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


trait Rivax_Post_skin_base {


    protected function render_pagination() {
        $settings  = $this->get_settings_for_display();

        $pagination_type    = $settings[ 'pagination_type' ];
        $page_limit         = $settings[ 'pagination_page_limit' ];
        $pagination_shorten = $settings[ 'pagination_numbers_shorten' ];

        if ( 'none' === $pagination_type ) {
            return;
        }

        if($settings['layout'] == 'carousel') {
            return;
        }

        // Get current page number.
        $current_page = $this->get_paged();

        $query       = $this->get_query_result();
        $total_pages = $query->max_num_pages;


        // Limit pages
        if ( $page_limit ) {
            $total_pages = min( $page_limit, $total_pages );
        }

        if ( 2 > $total_pages ) {
            return;
        }


        if ( in_array($pagination_type, ['load_more', 'infinite_scroll']) ) {
            $load_more_label                = $settings[ 'pagination_load_more_label' ]?: esc_html__( 'Load More', 'raveen' );
            $load_more_button_size          = $settings[ 'load_more_button_size' ];

            $document_id             = '';
            if ( null !== \Elementor\Plugin::$instance->documents->get_current() ) {
                $document_id = \Elementor\Plugin::$instance->documents->get_current()->get_main_id();
            }

            if($settings[ 'posts_source' ] == 'current_query') {
                $q_vars = $this->validate_load_more_current_query_args( $GLOBALS['wp_query']->query_vars );
                if(!empty($q_vars)) {
                    ?>
                    <script>const rivaxLoadMoreQVars = <?php echo json_encode($q_vars); ?>;</script>
                    <?php
                }
            }

            $infinite_scroll_cls = ($pagination_type == 'infinite_scroll')? 'infinite-scroll' : '';

            ?>
            <div class="rivax-posts-pagination-wrap">
                <div class="rivax-posts-pagination load-more-pagination">
                    <a class="rivax-post-load-more elementor-button elementor-size-<?php echo esc_attr( $load_more_button_size . ' ' . $infinite_scroll_cls ); ?>" href="#"
                       data-widget-id="<?php echo esc_attr($this->get_id()); ?>" data-current-page="1"
                       data-post-id="<?php echo esc_attr($document_id); ?>">
                        <span class="rivax-button-text">
							<?php echo esc_html( $load_more_label ); ?>
						</span>
                    </a>
                    <span class="rivax-post-load-more-loader"></span>
                </div>
            </div>
            <?php
        }
        else {

            $has_numbers   = in_array( $pagination_type, [ 'numbers', 'numbers_and_prev_next' ] );
            $has_prev_next = in_array( $pagination_type, [ 'prev_next', 'numbers_and_prev_next' ] );

            $paginate_args = array(
                'type'      => 'array',
                'current'   => $current_page,
                'total'     => $total_pages,
                'prev_next' => false,
                'show_all'  => 'yes' !== $pagination_shorten,
            );

            if ( $has_prev_next ) {
                $prev_label = $settings[ 'pagination_prev_label' ];
                $next_label = $settings[ 'pagination_next_label' ];

                $paginate_args['prev_next'] = true;

                if ( $prev_label ) {
                    $paginate_args['prev_text'] = $prev_label;
                }
                if ( $next_label ) {
                    $paginate_args['next_text'] = $next_label;
                }
            }

            if ( is_singular() && ! is_front_page() ) {
                global $wp_rewrite;
                if ( $wp_rewrite->using_permalinks() ) {
                    $paginate_args['base']   = trailingslashit( get_permalink() ) . '%_%';
                    $paginate_args['format'] = user_trailingslashit( 'page/%#%', 'single_paged' ); // Change Occurs For Fixing Pagination Issue.
                } else {
                    $paginate_args['format'] = '?page=%#%';
                }
            }

            $links = paginate_links( $paginate_args );

            if( $pagination_type == 'prev_next' ) { // Remove numbers from pagination
                $prev_next_links = [];
                if($current_page != 1) {
                    $prev_next_links[] = $links[0];
                }

                if($current_page != $total_pages) {
                    $prev_next_links[] = end($links);
                }

                $links = $prev_next_links;
            }

            ?>
            <div class="rivax-posts-pagination-wrap">
                <nav class="rivax-posts-pagination standard-pagination elementor-pagination" aria-label="<?php esc_attr_e( 'Pagination', 'raveen' ); ?>" data-total="<?php echo esc_attr( $total_pages ); ?>">
                    <?php echo implode( PHP_EOL, $links ); ?>
                </nav>
            </div>
            <?php
        }

    }


    protected function render_post_body($current_post_num = -1) {
        $settings = $this->get_settings_for_display();

        $widget_path_name = str_replace('rivax-', '', $this->get_name() );
        include RIVAX_THEME_DIR . '/elementor/templates/' . $widget_path_name . '/post-body.php';
    }


    public function render_ajax_posts() {

        $settings  = $this->get_settings_for_display();


        $data = '';
        $no_more_posts = true;
        $msg = esc_html__( 'No more posts found!', 'raveen' );

        $page_limit         = $settings[ 'pagination_page_limit' ];
        $query = $this->get_query_result();
        $total_pages = $query->max_num_pages;

        // Limit pages
        if ( $page_limit ) {
            $total_pages = min( $page_limit, $total_pages );
        }

        if ( $query->have_posts() ) :
            if(intval($query->query["paged"] < $total_pages)) {
                $no_more_posts = false;
                $msg = '';
            }

            ob_start();
            while ( $query->have_posts() ) :
                $query->the_post();

                $this->render_post_body();

            endwhile;
            $data = ob_get_clean();
        endif;
        wp_reset_postdata();


        $return = array(
            'data'          => $data,
            'no_more'       => $no_more_posts,
            'msg'           => $msg,
        );

        return $return;
    }


protected function render_carousel_header() {
    $settings        = $this->get_settings_for_display();

    if($settings['layout'] != 'carousel') {
        return;
    }

    $id = 'rivax-carousel-' . $this->get_id();
    $this->add_render_attribute( 'carousel', 'id', $id );
    $this->add_render_attribute( 'carousel', 'class', 'rivax-posts-carousel-wrapper' );

    if ( $settings['carousel_pagination'] ) {
        $pagination_type = $settings['carousel_pagination_type'];
    } else {
        $pagination_type = '';
    }

    // Elementor responsive is max-width while swiper is min-width. We need to correct this.
    $responsive_settings = array();
    $breakpoints = \Elementor\Plugin::$instance->breakpoints->get_active_breakpoints();

    $responsive_settings[0]["slidesPerView"] = 1; // Don't need its value. Just add index 0

    foreach ($breakpoints as $key => $breakpoint) {
        $breakpoint_size = $breakpoint->get_value() + 1;

        if( !empty($settings["columns_" . $key]) ) {
            $responsive_settings[$breakpoint_size]["slidesPerView"] = intval($settings["columns_" . $key]);
        }
        if( !empty($settings["carousel_slides_to_scroll_" . $key]) ) {
            $responsive_settings[$breakpoint_size]["slidesPerGroup"] = intval($settings["carousel_slides_to_scroll_" . $key]);
        }
        if( !empty($settings["column_gap_" . $key]["size"]) ) {
            $responsive_settings[$breakpoint_size]["spaceBetween"] = intval($settings["column_gap_" . $key]["size"]);
        }
    }

    // Add desktop values
    $responsive_settings[3000]["slidesPerView"] = !empty($settings["columns"])? intval($settings["columns"]) : 3;
    $responsive_settings[3000]["slidesPerGroup"] = !empty($settings["carousel_slides_to_scroll"])? intval($settings["carousel_slides_to_scroll"]) : 1;
    $responsive_settings[3000]["spaceBetween"] = !empty($settings["column_gap"]["size"])? intval($settings["column_gap"]["size"]) : 20;

    // Shift values to previous index
    $final_responsive = [];
    foreach ($responsive_settings as $key => $responsive_setting) {
        $next = next($responsive_settings);
        if($next) {
            $final_responsive[$key] = $next;
        }
    }
    $final_responsive = count($final_responsive) > 1 ? $final_responsive : [];

    $carousel_settings = [
        "autoplay"              => ( "yes" == $settings["carousel_autoplay"] ) ? [ "delay" => $settings["carousel_autoplay_speed"] ] : false,
        "loop"                  => ( $settings["carousel_loop"] == "yes" ),
        "speed"                 => $settings["carousel_speed"]["size"],
        "pauseOnMouseEnter"     => ( $settings["carousel_pauseonhover"] == "yes" ),
        "slidesPerView"         => !empty($settings["columns"]) ? intval($settings["columns"]) : 3,
        "slidesPerGroup"        => !empty($settings["carousel_slides_to_scroll"]) ? intval($settings["carousel_slides_to_scroll"]) : 1,
        "spaceBetween"          => !empty($settings["column_gap"]["size"]) ? intval($settings["column_gap"]["size"]) : 20,
        "centeredSlides"        => ( $settings["carousel_centered_slides"] == "yes" ),
        "grabCursor"            => ( $settings["carousel_grab_cursor"] == "yes" ),
        "effect"                => $settings["carousel_effect"],
        "autoHeight"            => ( $settings["carousel_auto_height"] == "yes" ),
        "observer"              => ( $settings["carousel_observer"] == "yes" ),
        "observeParents"        => ( $settings["carousel_observer"] == "yes" ),
        "direction"             => $settings['carousel_direction'],
        "breakpoints"           => $final_responsive,
        "navigation"            => [
            "nextEl" => "#" . $id . " .carousel-nav-next",
            "prevEl" => "#" . $id . " .carousel-nav-prev",
        ],
        "pagination"            => [
            "el"             => "#" . $id . " .carousel-pagination",
            "type"           => $pagination_type,
            "clickable"      => "true",
            'dynamicBullets' => ( "yes" == $settings["carousel_dynamic_bullets"] ),
        ],
        "a11y"            => [
            "enabled"             => "false",
        ],
        "fadeEffect"            => [
            "crossFade" => true,
        ],

    ];


    $this->add_render_attribute('carousel', 'data-settings', wp_json_encode(array_filter($carousel_settings)) );

    ?>
    <div <?php $this->print_render_attribute_string( 'carousel' ); ?>>
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php
                }


                protected function render_carousel_footer() {
                $settings = $this->get_settings_for_display();

                if($settings['layout'] != 'carousel') {
                    return;
                }

                ?>
            </div> <!-- .swiper-wrapper -->
        </div><!-- .swiper -->
        <?php
        // Arrows
        if ( $settings['carousel_arrows'] ) {
            $carousel_nav_cls = 'carousel-nav-wrapper';
            $carousel_nav_cls .= ' rivax-position-' . esc_attr($settings['carousel_arrows_position']);
            $carousel_nav_cls .= $settings['carousel_arrow_show_on_hover']? ' show-on-hover' : '';
            $carousel_nav_cls .= $settings['carousel_hide_arrow_mobile']? ' elementor-hidden-phone' : '';

            ?>
            <div class="<?php echo esc_attr($carousel_nav_cls); ?>">
                <a href="" class="carousel-nav-prev">
                    <i class="<?php echo esc_attr($settings['carousel_arrows_icon']); ?>"></i>
                    <?php if($settings['carousel_arrows_prev_label']) {
                        echo '<span class="carousel-nav-prev-label">' . esc_html($settings['carousel_arrows_prev_label']) . '</span>';
                    } ?>
                </a>
                <a href="" class="carousel-nav-next">
                    <?php if($settings['carousel_arrows_next_label']) {
                        echo '<span class="carousel-nav-next-label">' . esc_html($settings['carousel_arrows_next_label']) . '</span>';
                    } ?>
                    <i class="<?php echo esc_attr($settings['carousel_arrows_icon']); ?>"></i>
                </a>
            </div>
            <?php
        }

        // Pagination
        if ( $settings['carousel_pagination'] ) {
            $pagination_cls = 'carousel-pagination-wrapper';
            $pagination_cls .= ' type-' . esc_attr($settings['carousel_pagination_type']);
            $pagination_cls .= ' rivax-position-' . esc_attr($settings['carousel_pagination_position']);

            ?>
            <div class="<?php echo esc_attr($pagination_cls); ?>">
                <div class="carousel-pagination"></div>
            </div>
            <?php
        }

        ?>


    </div><!-- .rivax-posts-carousel-wrapper -->
    <?php
}



    protected function render_author() {
        $settings = $this->get_settings_for_display();
        if (!$settings['show_author']) {
            return;
        }
        ?>
        <div class="post-author-wrapper">
            <?php
            if($settings['show_author_image']) {
                echo '<div class="author-image">' . get_avatar( get_the_author_meta( 'user_email' ), 60 ) . '</div>';
            }
            ?>
            <div class="author-wrapper">
                <div class="author-meta">
                    <?php
                    if($settings['show_author_icon']) {
                        ?>
                        <span class="icon"><i class="ri-user-3-line"></i></span>
                        <?php
                    }

                    if($settings['show_author_by']) {
                        ?>
                        <span class="by"><?php echo esc_html($settings['author_by_text']); ?></span>
                        <?php
                    }
                    ?>
                    <a href="<?php echo  get_author_posts_url( get_the_author_meta( 'ID' ) ) ; ?>">
                        <?php echo get_the_author() ; ?>
                    </a>
                </div>
                <?php $this->render_date('under-author'); ?>
            </div>
        </div>
        <?php
    }




    protected function render_date($position = 'inline') {
        $settings = $this->get_settings_for_display();
        if (!$settings['show_date'] || $settings['meta_date_position'] != $position) {
            return;
        }
        ?>
        <div class="date-wrapper date-<?php echo esc_attr($settings['meta_date_position']); ?>">
            <?php if ($settings['show_date_icon']) : ?>
                <i class="ri-calendar-line"></i>
            <?php endif; ?>
            <span class="date">
                <?php
                if ($settings['human_diff_time'] == 'yes') {
                    printf( esc_html__( '%s ago', 'raveen' ), human_time_diff( get_the_time('U'), current_time('timestamp') ) );
                } else {
                    echo get_the_date();
                }

                if ($settings['show_time']) : ?>
                    <span class="time">
			        <?php echo ' - ' . get_the_time(); ?>
                </span>
                <?php endif; ?>
            </span>
        </div>
        <?php
    }



    protected function render_comments() {
        $settings = $this->get_settings_for_display();

        if ( !$settings['show_comments'] ) {
            return;
        }
        $comments_count = get_comments_number();
        ?>
        <div class="comments-wrapper">
            <?php if ( $settings['show_comments_icon'] ): ?>
                <i class="ri-chat-1-line"></i>
            <?php endif; ?>
            <span class="comments">
                <?php
                if( $settings['comments_just_count'] ) {
                    echo intval($comments_count);
                }
                else {

                    if( $comments_count == 0 ) {
                        esc_html_e('No Comment', 'raveen');
                    }
                    elseif ( $comments_count == 1 ) {
                        esc_html_e('One Comment', 'raveen');
                    }
                    else {
                        printf( esc_html__('%d Comments', 'raveen'), $comments_count );
                    }
                }
                ?>
            </span>
        </div>
        <?php
    }



    protected function render_views_count() {
        $settings = $this->get_settings_for_display();

        if ( !$settings['show_views_count'] ) {
            return;
        }
        ?>
        <div class="views-wrapper">
            <?php if ( $settings['show_views_count_icon'] ): ?>
                <i class="ri-fire-line"></i>
            <?php endif; ?>
            <span class="views">
                <?php
                echo rivax_get_post_views(get_the_ID());
                if( $settings['views_count_text'] ) {
                    echo ' ' . esc_html($settings['views_count_text']);
                }
                ?>
            </span>
        </div>
        <?php
    }



    protected function render_reading_time() {
        $settings = $this->get_settings_for_display();

        if ( !$settings['show_reading_time'] ) {
            return;
        }
        ?>
        <div class="reading-time-wrapper">
            <?php if ( $settings['show_reading_time_icon'] ): ?>
                <i class="ri-time-line"></i>
            <?php endif; ?>
            <span class="reading-time">
                <?php
                echo rivax_get_reading_time();
                if( $settings['reading_time_text'] ) {
                    echo ' ' . esc_html($settings['reading_time_text']);
                }
                ?>
            </span>
        </div>
        <?php
    }


    protected function render_terms() {
        $settings = $this->get_settings_for_display();
        if (!$settings['show_terms'] || !$settings['terms_taxonomy']) {
            return;
        }

        $terms = get_the_terms( get_the_ID(), $settings['terms_taxonomy'] );
        if(!empty($terms)) {

            $term_cls = '';

            if($settings['term_shape']) {
                $term_cls .= ' term-shape';
            }

            echo '<div class="terms-wrapper ' . $term_cls . '">';

            $term_limit = max(1, $settings['term_limit']);
            $i = 0;

            foreach ($terms as $term) {
                if($i >= $term_limit) { break; }
                $i++;
                echo '<a class="term-item term-id-' . esc_attr($term->term_id) . '" href="' . esc_url(get_term_link($term->term_id)) . '"><span>' . esc_html($term->name) . '</span></a>';
            }

            if($settings['show_date_after_terms']) {
                echo '<span class="date-after-terms">' . get_the_date() . '</span>';
            }

            echo '</div>';
        }

    }


    protected function render_title() {
        $settings = $this->get_settings_for_display();
        ?>
        <<?php echo esc_attr($settings['title_tag']); ?> class="title">
        <a href="<?php echo esc_url(get_permalink()) ?>" class="title-animation-<?php echo esc_attr($settings['title_hover_style']); ?>" title="<?php echo esc_attr(get_the_title()) ?>">
            <?php
            if($settings['title_limit_words']) {
                echo wp_trim_words(get_the_title(), $settings['title_limit_words_count'], $settings['title_limit_words_more_text']);
            }
            else {
                echo get_the_title();
            }
            ?>
        </a>
        </<?php echo esc_attr($settings['title_tag']); ?>>
        <?php
    }


    protected function render_excerpt() {
        $settings = $this->get_settings_for_display();
        if (!$settings['show_excerpt']) {
            return;
        }
        $excerpt = get_the_excerpt();
        if ($excerpt) {
            $excerpt = wp_strip_all_tags($excerpt);
			if( strlen($excerpt) <= absint($settings['excerpt_length']) ) {
				$result = $excerpt;
			}
			else {
				$excerpt = substr($excerpt, 0, absint($settings['excerpt_length']));
				$result = substr($excerpt, 0, strrpos($excerpt, ' '));
				$result .= '...';
			}            
            $cls = $settings['excerpt_hide_on_mobile']? 'excerpt elementor-hidden-phone' : 'excerpt';
            echo '<p class="' . esc_attr($cls) . '">' . $result . '</p>';
        }
    }


    protected function render_read_more() {
        $settings = $this->get_settings_for_display();
        if (!$settings['show_read_more']) {
            return;
        }

        $read_more_text = $settings['read_more_text'];

        $btn_cls = "rivax-read-more";
        if($settings['read_more_show_icon']) {
            $btn_cls .= " icon-" . $settings['read_more_icon_position'];
        }

        ?>
        <div class="rivax-read-more-wrapper<?php if($settings['read_more_hide_on_mobile']) echo ' elementor-hidden-phone'; ?>">
            <a href="<?php the_permalink(); ?>" class="<?php echo esc_attr($btn_cls); ?>">
                <span class="read-more-title"><?php echo esc_html($read_more_text); ?></span>
                <?php if($settings['read_more_show_icon'] && $settings['read_more_icon']['value']): ?>
                    <span class="icon">
		            <?php \Elementor\Icons_Manager::render_icon( $settings['read_more_icon'] ); ?>
                    </span>
                <?php endif; ?>
            </a>
        </div>
        <?php

    }


    protected function render_post_format_icon() {
        $settings = $this->get_settings_for_display();
        if (!$settings['show_post_format_icon']) {
            return;
        }

        $post_format = get_post_format() ? : 'standard';

        if ($post_format == 'standard') {
            return;
        }

        switch ($post_format) {
            case 'gallery':
                $post_format_icon = 'ri-images';
                break;
            case 'video':
                $post_format_icon = 'ri-youtube-line';
                break;
            case 'audio':
                $post_format_icon = 'ri-volume-up-line';
                break;
            case 'link':
                $post_format_icon = 'ri-link-solid';
                break;
            case 'quote':
                $post_format_icon = 'ri-double-quotes-l';
                break;
            default:
                $post_format_icon = 'ri-images';
        }

        ?>
        <div class="post-format-icon rivax-position-<?php echo esc_attr($settings['post_format_icon_position']) ?>">
            <i class="<?php echo esc_attr($post_format_icon) ?>"></i>
        </div>
        <?php
    }


}

