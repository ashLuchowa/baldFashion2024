<footer class="amp-footer">
	<div class="container">
        <div class="footer-logo-wrap">
            <a id="footer-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                $logo = rivax_get_option('amp-logo');

                if( !empty($logo['url']) ) {
                    ?>
                    <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="<?php echo esc_attr($logo['width']); ?>" height="<?php echo esc_attr($logo['height']); ?>">
                    <?php
                }
                else {
                    bloginfo('name');
                }
                ?>
            </a>
        </div>

        <?php if(rivax_get_option('amp-copyright') ): ?>
            <p class="footer-copyright"><?php echo esc_html( rivax_get_option('amp-copyright') ); ?></p>
        <?php endif; ?>

        <?php if(rivax_get_option('amp-back-top') ): ?>
		<a href="#top" class="back-to-top"><?php esc_html_e( 'Back to top', 'raveen' ); ?></a>
        <?php endif; ?>
	</div>
</footer>
<?php
/**
 * Fires just before printing the </body> closing tag.
 *
 * @since 0.2
 * @see wp_footer()
 *
 * @param AMP_Post_Template $this
 */
do_action( 'amp_post_template_footer', $this );
?>
</body>
</html>