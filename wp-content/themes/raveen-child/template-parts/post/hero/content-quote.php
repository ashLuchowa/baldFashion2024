<?php
/**
 * Template part for displaying single post Quote hero content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$quote_content = get_post_meta( get_the_ID(), 'rivax_single_quote_content', true);
$quote_author = get_post_meta( get_the_ID(), 'rivax_single_quote_author', true);

?>
<div class="single-hero-quote">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php get_template_part('template-parts/post/hero/title-section'); ?>
                <div class="single-hero-quote-container">
                    <div class="quote-content">
                        <span class="icon"><i class="ri-double-quotes-l"></i></span>
                        <p class="content"><?php echo esc_html($quote_content); ?></p>
                        <p class="author"><?php echo esc_html($quote_author); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

