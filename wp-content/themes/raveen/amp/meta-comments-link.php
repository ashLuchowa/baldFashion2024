<?php

$comments_link_url = $this->get( 'comments_link_url' );
?>
<?php if ( $comments_link_url ) : ?>
	<div class="amp-wp-meta amp-wp-comments-link">
		<a href="<?php echo esc_url( $comments_link_url ); ?>">
            <?php esc_html_e( 'Leave a Comment', 'raveen' ); ?>
		</a>
	</div>
<?php endif; ?>
