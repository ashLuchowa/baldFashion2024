<?php
/**
 * Template part for displaying single post Standard hero content - Layout 1
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly
?>
<div class="single-hero-layout-1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                get_template_part('template-parts/post/hero/title-section');
                ?>
				<?php if(has_post_thumbnail() && !rivax_get_option('single-layout-1-hide-image')): ?>
                <div class="image-container">
                    <?php
                    the_post_thumbnail('rivax-large-wide', array( 'title' => get_the_title() ));
                    ?>
                </div>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>