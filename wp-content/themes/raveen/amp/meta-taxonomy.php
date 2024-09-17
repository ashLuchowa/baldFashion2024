<?php
$categories = get_the_category_list( ', ', '', $this->ID );
?>
<?php if ( $categories ) : ?>
	<div class="amp-wp-meta amp-wp-tax-category">
		<?php
		printf( esc_html__( 'Categories: %s', 'raveen' ), $categories );
		?>
	</div>
<?php endif; ?>

<?php
$tags = get_the_tag_list('', ', ','',	$this->ID);
?>
<?php if ( $tags && ! is_wp_error( $tags ) ) : ?>
	<div class="amp-wp-meta amp-wp-tax-tag">
		<?php
		printf( esc_html__( 'Tags: %s', 'raveen' ), $tags );
		?>
	</div>
<?php endif; ?>
