<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

// We can pass $args or get meta from option panel
$single_default_meta = rivax_get_option('single-layout-1-meta');

if(!$single_default_meta) {
    $single_default_meta = array(
        'category'      => true,
        'author-avatar' => true,
        'author-name'   => true,
        'date'          => true,
        'date-updated'  => false,
        'reading-time'  => false,
        'views'         => false,
        'comments'      => true,
    );
}

$show_category = isset($args['category'])? $args['category'] : $single_default_meta['category'];
$show_author_avatar = isset($args['author-avatar'])? $args['author-avatar'] : $single_default_meta['author-avatar'];
$show_author_name = isset($args['author-name'])? $args['author-name'] : $single_default_meta['author-name'];
$show_date = isset($args['date'])? $args['date'] : $single_default_meta['date'];
$show_date_updated = isset($args['date-updated'])? $args['date-updated'] : $single_default_meta['date-updated'];
$show_reading_time = isset($args['reading-time'])? $args['reading-time'] : $single_default_meta['reading-time'];
$show_views = isset($args['views'])? $args['views'] : $single_default_meta['views'];
$show_comments = isset($args['comments'])? $args['comments'] : $single_default_meta['comments'];
$show_title = isset($args['title'])? $args['title'] : true;


?>
<div class="single-hero-title">
    <?php rivax_breadcrumb(); ?>
	<?php if( $show_category ): ?>
        <div class="category">
			<?php
			$categories = get_the_category();
			foreach ($categories as $category) {
				echo '<a class="term-id-' . $category->term_id . '" href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( $category->name ) . '"><span>' . esc_html( $category->name ) . '</span></a>';
			}
			?>
        </div>
	<?php endif; ?>

    <?php if( $show_title ): ?>
        <h1 class="title"><?php the_title(); ?></h1>
    <?php endif; ?>

    <div class="meta">
        <?php if( $show_author_avatar ): ?>
            <div class="author-avatar">
                <a target="_blank" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ))); ?>">
                    <?php echo get_avatar( get_the_author_meta( 'user_email' ), 55 ); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="meta-details">
            <?php if( $show_author_name ): ?>
                <div class="author-name">
                    <a target="_blank" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ))); ?>">
                        <?php echo esc_html(get_the_author()); ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php if( $show_date ): ?>
                <div class="meta-item date">
                    <span><?php echo get_the_date(); ?></span>
                </div>
            <?php endif; ?>

            <?php if( $show_date_updated ): ?>
                <div class="meta-item date-updated">
                    <span><?php echo esc_html__('Updated on ', 'raveen') . get_the_modified_date(); ?></span>
                </div>
            <?php endif; ?>

            <?php if( $show_reading_time ): ?>
                <div class="meta-item reading-time">
                <span>
                <?php
                $mins = rivax_get_reading_time();
                printf( esc_html( _n( 'One Min Read', '%d  Mins Read', $mins, 'raveen'  ) ), $mins );
                ?>
                </span>
                </div>
            <?php endif; ?>

            <?php if( $show_views ): ?>
                <div class="meta-item views">
                    <span><?php echo rivax_get_post_views(get_the_ID()) . ' ' . esc_html__('Views', 'raveen'); ?></span>
                </div>
            <?php endif; ?>

            <?php if( $show_comments ): ?>
                <div class="meta-item comments">
                    <a href="#comments">
                        <?php $comments_count = get_comments_number(); ?>
                        <span><?php printf( esc_html( _n( '%d Comment', '%d Comments', $comments_count, 'raveen'  ) ), $comments_count ); ?></span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
