<?php
/**
 * Template part for displaying archive
 */

get_header();

$sidebar_position = rivax_get_sidebar_position ('blog', 'none');

?>
<main class="main-wrapper">
    <div class="content-wrapper">
        <?php get_template_part("template-parts/archive/archive-title"); ?>
        <?php
        $template_id = rivax_get_layout_template_id('archive');
        $template = rivax_get_display_elementor_content($template_id);

        if($template && $sidebar_position == 'none') {
            echo apply_filters('rivax_print_archive_template', $template);
        }
        else {
            ?>
            <div class="container">
                <div class="page-content-wrapper <?php echo 'sidebar-' . $sidebar_position; ?>">
                    <div class="content-container archive-content-container">
                        <?php
                        if($template) {
                            echo apply_filters('rivax_print_archive_template', $template);
                        }
                        else {
                            get_template_part("template-parts/archive/archive-default");
                        }
                        ?>
                    </div>
                    <?php if($sidebar_position == 'left' || $sidebar_position == 'right'): ?>
                        <aside class="sidebar-container <?php if(rivax_get_option('sticky-sidebar')) echo 'sticky'; ?>">
                            <?php get_sidebar(); ?>
                        </aside>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</main>
<?php
get_footer();
