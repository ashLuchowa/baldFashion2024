<?php
/**
 * Template for rivax template preview
 */
 if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="site">
	<div id="site-inner">
		<main class="main-wrapper">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
		</main>
	</div><!-- #site-inner -->
</div><!-- #site -->
<?php get_template_part("template-parts/footer/dark-mode-switcher"); ?>
<?php wp_footer(); ?>

</body>
</html>