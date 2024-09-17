<?php
/**
 * Template part for displaying page 404
 */

get_header();
?>
    <main class="main-wrapper">
        <div class="content-wrapper">
            <?php
            $template_id = rivax_get_layout_template_id('404');
            $template = rivax_get_display_elementor_content($template_id);

            if($template) {
                echo apply_filters('rivax_print_404_template', $template);
            }
            else {
                get_template_part("template-parts/404-default");
            }
            ?>
        </div>
    </main>
<?php
get_footer();
