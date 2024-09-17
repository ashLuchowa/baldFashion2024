<?php
/**
 * Template part for displaying single post
 */

get_header();
?>
	<main class="main-wrapper">
        <div class="single-post-wrapper">
        <?php
        /* Start the Loop */
        while ( have_posts() ) :
            the_post();

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
                <?php get_template_part('template-parts/post/content-top'); ?>
                <?php get_template_part('template-parts/post/single-hero'); ?>
                <div class="content-wrapper">
                    <div class="container">
                        <div class="page-content-wrapper <?php echo 'sidebar-' . $sidebar_position; ?>">
                            <div class="content-container">
                                <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-content' ); ?> >
                                    <?php the_content(); ?>
                                    <?php wp_link_pages(); ?>
                                    <?php get_template_part('template-parts/post/tags'); ?>
                                </article>
                                <?php get_template_part('template-parts/post/share'); ?>
                                <?php get_template_part('template-parts/post/author-box'); ?>
                                <?php get_template_part('template-parts/post/next-prev-posts'); ?>
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
                <?php get_template_part('template-parts/post/content-bottom'); ?>
                <?php
            }
            rivax_autoload_next_post_info();
        endwhile; // End of the loop.
        ?>
        </div>
	</main>
<?php
rivax_autoload_next_post_indicator();

if(rivax_get_option('post-reading-progress-indicator')) {echo '<div class="post-reading-progress-indicator"><span></span></div>';}

get_footer();