
<?php $this->load_parts( [ 'header' ] ); ?>
<div class="container">
    <article class="amp-wp-article">
        <header class="amp-wp-article-header">
            <h1 class="amp-wp-title"><?php the_title(); ?></h1>
        </header>


        <div class="amp-wp-article-content">
            <?php echo apply_filters('rivax_post_amp_content', $this->get( 'post_amp_content' ) ); ?>
        </div>

        <footer class="amp-wp-article-footer">
            <?php
            /**
             * Filters the template parts to load in the footer area of the AMP legacy post template.
             *
             * @since 0.4
             * @param string[] Templates to load.
             */
            $this->load_parts( apply_filters( 'amp_post_article_footer_meta', [ 'meta-taxonomy', 'meta-comments-link' ] ) );
            ?>
        </footer>
    </article>
</div>

<?php $this->load_parts( [ 'footer' ] ); ?>