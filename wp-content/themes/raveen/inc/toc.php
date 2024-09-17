<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

class Rivax_Toc {

    /**
     * @var array
     */
    private $headings;


    /**
     * @var string
     */
    private $permalink;


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


    function __construct() {

        if( rivax_get_option('toc') ) {

            add_filter('the_content', [$this, 'add_content_headings_anchors'], 100);
            add_filter('the_content', [$this, 'add_content_toc'], 100);
            add_filter('elementor/frontend/the_content', [$this, 'add_elementor_toc'], 100);
        }
    }


    /**
     * Check TOC is enabled
     *
     * @return bool
     */
    private function is_enabled() {

        if( rivax_get_option('toc') && is_singular('post')) {

            if(get_post_meta(get_the_ID(), 'rivax_single_disable_toc', true)) {
                return false;
            }

            if(rivax_is_amp() && rivax_get_option('toc-disable-in-amp') ) {
                return false;
            }

            // Do not execute for excerpt
            global $wp_current_filter;
            if( in_array('get_the_excerpt', $wp_current_filter) ) {
                return false;
            }

            return true;
        }

        return false;
    }


    /**
     * Current page from the post pagination
     *
     * @return int
     */
    private function get_current_page() {

        return intval(get_query_var( 'page' )) ?: 1;
    }



    /**
     * Strip tags from the heading
     *
     * @param array $matches The headings from the post content extracted with preg_match_all().
     *
     * @return void
     */
    private function strip_tags_headings( &$matches ) {

        foreach ($matches as $i => $match) {
            $matches[$i][3] = trim(wp_strip_all_tags($match[3]), ':');
        }
    }



    /**
     * Remove the excluded heading levels.
     *
     * @param array $matches The headings from the post content extracted with preg_match_all().
     *
     * @return void
     */
    private function remove_exclude_headings( &$matches ) {

        $levels = array_filter( rivax_get_option('toc-headings-support') );
        $levels = array_keys($levels);

        if ( count( $levels ) != 5 ) {

            $new_matches = array();

            foreach ( $matches as $match ) {

                if( in_array($match[2], $levels) ) {
                    $new_matches[] = $match;
                }
            }

            $matches = $new_matches;
        }

    }



    /**
     * Remove the excluded heading class.
     *
     * @param array $matches The headings from the post content extracted with preg_match_all().
     *
     * @return void
     */
    private function remove_exclude_class_headings( &$matches ) {

        $exclude_classes = rivax_get_option('toc-exclude-class');

        if($exclude_classes) {
            $exclude_list = explode(' ', $exclude_classes);
            $pattern = '/class=["\']([^"\']+)["\']/';
            $new_matches = array();

            foreach ( $matches as $match ) {
                $include = true;

                if (preg_match($pattern, $match[1], $preg_result)) { // Check heading has a class attribute
                    // Extract class names from the matched class attribute
                    $headingClass = $preg_result[1];
                    $headingClass_list = explode(' ', $headingClass);

                    if(!empty( array_intersect($exclude_list,$headingClass_list) )) {
                        $include = false;
                    }
                }

                if($include) {
                    $new_matches[] = $match;
                }
            }
            $matches = $new_matches;
        }
    }


    /**
     * Remove any empty headings from the TOC.
     *
     * @param array $matches The heading from the post content extracted with preg_match_all().
     *
     * @return void
     */
    private function remove_empty_headings( &$matches ) {

        $new_matches = array();

        foreach ( $matches as $match ) {

            if ( trim($match[3]) ) {
                $new_matches[] = $match;
            }
        }

        $matches = $new_matches;

    }


    /**
     * Add the heading `id` to the array.
     *
     * @see extract_headings()
     *
     * @param array $matches The heading from the post content extracted with preg_match_all().
     *
     * @return void
     */
    private function add_heading_ID( &$matches ) {

        foreach ( $matches as $i => $match ) {

            $matches[ $i ]['id'] = $this->generate_heading_ID( $match[3] );
        }
    }


    /**
     * Add the heading `page` number to the array.
     *
     * @see extract_headings()
     *
     * @param array $matches The heading from the post content extracted with preg_match_all().
     *
     * @return void
     */
    private function add_heading_page( &$matches, $content ) {



        $split = preg_split( '/<!--nextpage-->/msuU', $content );
        foreach ($matches as $key => $match) {

            if(count($split) > 1) {
                foreach ($split as $i => $split_content) {

                    if( strpos($split_content, $match[0]) !== false ) {
                        $matches[$key]['page'] = $i + 1;
                    }

                }
            }

            if(!isset($matches[$key]['page'])) {
                $matches[$key]['page'] = 1;
            }
        }

    }


    /**
     * Create unique heading ID from heading string.
     *
     * @param string $heading
     *
     * @return string
     */
    private function generate_heading_ID( $heading ) {

        $output = '';

        if ( $heading ) {
            $output = trim( strip_tags( $heading ) );
            $output = preg_replace( "/\p{P}/u", "", $output );
            $output = str_replace( "&nbsp;", " ", $output );
            $output = remove_accents( $output );
            $output = sanitize_title_with_dashes( $output );
        }

        return $output;
    }



    /**
     * Extract the headings.
     *
     * @param string $content
     *
     * @return array
     */
    private function extract_headings( $content ) {

        $matches = array();


        $regEx = apply_filters( 'rivax_toc_regex_filter', '/(<h([1-6]{1})[^>]*>)(.*)<\/h\2>/msuU' );

        // Get all headings
        if ( preg_match_all( $regEx, $content, $matches, PREG_SET_ORDER ) ) {

            $minimum = absint( rivax_get_option('toc-min-count') );

            $this->strip_tags_headings( $matches );
            $this->remove_exclude_headings( $matches );
            $this->remove_exclude_class_headings( $matches );
            $this->remove_empty_headings( $matches );

            if ( count( $matches ) >= $minimum ) {

                $this->add_heading_ID( $matches );
                $this->add_heading_page( $matches, $content );

            } else {

                return array();
            }

        }

        return array_values( $matches );
    }


    /**
     * Get post content
     *
     * @return string
     */
    private function get_post_content() {

        $post = get_post(get_the_ID());
        if($post) {

            remove_filter( 'the_content', [$this, 'add_content_headings_anchors'], 100 );
            remove_filter( 'the_content', [$this, 'add_content_toc'], 100 );
            $the_content = apply_filters('the_content', strip_shortcodes($post->post_content));
            $this->permalink = esc_url( get_permalink($post->ID) );

            return $the_content;
        }

        return '';
    }



    /**
     * Get headings from the current post content
     *
     * @return array
     */
    private function get_headings() {

        if(!is_null($this->headings)) {
            return $this->headings;
        }

        $headings = $this->extract_headings($this->get_post_content());
        $this->headings = $headings;
        return $headings;
    }



    /**
     * Add headings anchors to the content
     *
     * @return string
     */
    function add_content_headings_anchors($content) {

        if( $this->is_enabled() ) {
            $headings = $this->get_headings();
            $num = 0;
            if($headings) {
                foreach ($headings as $heading) {
                    $span = '<span class="rivax-toc-section" data-num="toc-' . ++$num . '" id="' . $heading['id'] . '"></span>';
                    $content = str_replace( $heading[0], $span . $heading[0], $content );
                }
            }
        }

        return $content;
    }


    /**
     * Add TOC to the content
     *
     * @return string
     */
    function add_content_toc($content) {

        if( $this->is_enabled() ) {
            $toc = $this->get_toc();
            if($toc) {
                $toc_inline = rivax_get_option('toc-inline');

                if(strpos($content, 'RivaxToc')) { // Elementor widget in post
                    $content = str_replace('RivaxToc', $toc, $content);
                }
                elseif($toc_inline) {
                    if( rivax_get_option('toc-position') == 'after-p' ) {

                        $p_pos = strpos($content, '</p>');
                        if($p_pos) {
                            $p_pos += 4;
                            $left_string = substr($content, 0, $p_pos);
                            $right_string = substr($content, $p_pos);
                            $content =  $left_string . $toc . $right_string;
                        }
                    }
                    else {
                        $content = $toc . $content;
                    }
                }
            }
        }

        return $content;
    }


    /**
     * Add TOC to the elementor widget
     * Do not execute it for the post made with the Elementor. add_content_toc() apply to it.
     *
     * @return string
     */
    function add_elementor_toc($content) {

        if( $this->is_enabled() ) {
            if(strpos($content, 'RivaxToc') && !strpos($content, 'data-elementor-id="' . get_the_ID() . '"')) {
                $toc = $this->get_toc();
                if($toc) {
                    $content = str_replace('RivaxToc', $toc, $content);
                }

            }

        }

        return $content;
    }


    /**
     * Generate the TOC list items
     *
     * @return string The HTML list of TOC items.
     */
    private function create_toc_list() {

        $headings = $this->get_headings();
        if(!count($headings)) {
            return '';
        }

        $min_depth  = 100;
        $anchor_number = 0; // Number of anchor

        foreach ( $headings as $heading ) {
            if ( $min_depth > $heading[2] ) {
                $min_depth = intval($heading[2]);
            }
        }

        $cls = "rivax-toc-items";
        $cls .= rivax_get_option('toc-hierarchically')? ' toc-hierarchically' : ' toc-flat';
        $cls .= rivax_get_option('toc-counter')? ' toc-counter' : '';

        $html = '<ul class="' . esc_attr($cls) . '">' . PHP_EOL;

        foreach ( $headings as $heading ) {

            $level = intval($heading[2]) - $min_depth + 1;
            $cls = 'toc-item-heading-' . $heading[2] . ' level-' . $level;

            $html .= '<li class="' . esc_attr($cls) . '">';
            $html .= $this->create_toc_item_anchor($heading, ++$anchor_number);
            $html .= '</li>' . PHP_EOL;
        }

        $html .= '</ul>' . PHP_EOL;

        return $html;
    }


    /**
     * Create toc item anchor
     *
     * @param array    $heading
     * @return string
     */
    private function create_toc_item_anchor( $heading, $anchor_number ) {

        $current_page = $this->get_current_page();

        if ( $current_page == $heading['page'] || rivax_is_amp() ) {

            $link = '#' . $heading['id'];
        }
        elseif ( 1 == $heading['page'] ) {

            $link = trailingslashit( $this->permalink ) . '#' . $heading['id'];
        }
        else {

            $link = trailingslashit( $this->permalink ) . $heading['page'] . '/#' . $heading['id'];
        }

        return '<a class="rivax-toc-anchor" href="' . $link . '" data-num="toc-' . $anchor_number . '">' . esc_html($heading[3]) . '</a>';
    }


    /**
     * Generate the TOC container
     *
     * @return string The HTML container included list of TOC items.
     */
    private function get_toc() {

        $toc_list = $this->create_toc_list();
        if(!$toc_list) {
            return '';
        }

        $html = '<div class="rivax-toc-wrap">' . PHP_EOL;
        $toc_title = esc_html(rivax_get_option('toc-title'));
        $toc_collapsable = rivax_get_option('toc-collapsable');

        if($toc_title || $toc_collapsable) {
            $html .= '<div class="toc-header">' . PHP_EOL;
            $html .= '<div class="toc-header-title-wrap">' . PHP_EOL;
            if($toc_title) {
                $html .= '<h3>' . $toc_title . '</h3>' . PHP_EOL;
            }
            $html .= '</div>' . PHP_EOL;

            $html .= '<div class="toc-header-collapse-wrap">' . PHP_EOL;
            if($toc_collapsable) {
                $html .= '<span class="toc-header-collapse"><i class="ri-arrow-up-s-line"></i></span>' . PHP_EOL;
            }
            $html .= '</div>' . PHP_EOL;
            $html .= '</div>' . PHP_EOL;
        }
        $html .= $toc_list . PHP_EOL;
        $html .= '</div>' . PHP_EOL;

        return $html;
    }


    /**
     * Get toc for Elementor
     *
     * @return void
     */
    function elementor_toc() {

        if( $this->is_enabled() ) {
            echo 'RivaxToc';
        }
    }

}

$toc = Rivax_Toc::get_instance();