<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$query = $this->get_query_result();
if ( ! $query->found_posts ) {

    rivax_query_not_found_msg ();

    return;
}

$this->add_render_attribute('wrapper', 'class', 'rivax-posts-wrapper');
$this->add_render_attribute('wrapper', 'class', 'layout-' . $settings['layout']);

?>
<div class="rivax-posts-container">
    <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
        <?php $this->render_carousel_header(); ?>
        <?php
        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) :
                $query->the_post();

                $this->render_post_body($query->current_post);

            endwhile;
        endif;
        wp_reset_postdata();
        ?>
        <?php $this->render_carousel_footer(); ?>
    </div>
    <?php $this->render_pagination(); ?>
</div>
