<?php
/**
 * Template part for displaying footer
 */
?>
<footer id="site-footer">
    <?php
    // Singular Custom Footer
    $footer_id = rivax_get_layout_template_id('footer');
    $footer = rivax_get_display_elementor_content($footer_id);

    if($footer) {
        echo apply_filters('rivax_print_footer_template', $footer);
    }
	else {
		?>
		<div class="site-default-footer">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<?php 
						if( is_active_sidebar( 'rivax_footer_widgets' ) ) {
							dynamic_sidebar( 'rivax_footer_widgets' );
						}
						else { // Default Footer
							?>
							<div class="default-footer-copyright">
								<p><?php esc_html_e('All Right Reserved!', 'BaldFashion'); ?></p>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
        <?php
	}    
    ?>
</footer>
