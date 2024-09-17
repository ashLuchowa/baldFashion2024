<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-end.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Sidebar Position for woocommerce
if( is_shop() ) {
    $sidebar_position = rivax_get_sidebar_position ('woocommerce-shop', 'none');
}
elseif( is_product_category() || is_product_tag()) {
    $sidebar_position = rivax_get_sidebar_position ('woocommerce-archive', 'none');
}
else {
    $sidebar_position = 'none';
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
	</div>
</main>

