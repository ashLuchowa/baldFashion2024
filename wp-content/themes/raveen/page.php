<?php
/**
 * Template part for displaying single page
 */

get_header();
?>
<main class="main-wrapper">
    <?php
    $sidebar_position = rivax_get_sidebar_position ('single-page', 'none');

    /* Start the Loop */
    while ( have_posts() ) :
        the_post();

        if($sidebar_position == 'elementor') {
            ?>
            <div class="content-wrapper">
                <?php the_content(); ?>
            </div>
            <?php
        }
        else {
            ?>
            <div class="content-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <header class="single-page-title-wrapper">
                                <h1 class="single-page-title"><?php the_title(); ?></h1>
                            </header>
                        </div>
                    </div>
                    <div class="page-content-wrapper <?php echo 'sidebar-' . $sidebar_position; ?>">
                        <div class="content-container">
                            <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-content' ); ?> >
                                <?php the_content(); ?>
                                <?php wp_link_pages(); ?>
                            </article>
                            <?php comments_template(); ?>
                        </div>
                        <?php if($sidebar_position == 'left' || $sidebar_position == 'right'): ?>
                            <aside class="sidebar-container <?php if(rivax_get_option('sticky-sidebar')) echo 'sticky'; ?>">
                                <?php get_sidebar(); ?>
                            </aside>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
        }
    endwhile; // End of the loop.
    ?>
</main>
<?php
get_footer();
