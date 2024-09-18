<div class="default-archive-container">
    <?php
    if( have_posts() ) {
        ?>
        <div class="default-archive-wrap">
        <?php
        while(have_posts()) {
            the_post();
            ?>
            <article <?php post_class( 'default-post-list-item' ); ?>>

                <?php if ( has_post_thumbnail() ) : ?>
                <div class="image-container">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('rivax-small', array( 'title' => get_the_title() )); ?>
                    </a>
                    <?php rivax_print_post_format_icon(); ?>
                    <div class="category">
                        <?php
                        $category = get_the_category()[0];
                        echo '<a class="term-id-' . $category->term_id . '" href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( $category->name ) . '"><span>' . esc_html( $category->name ) . '</span></a>';

                        ?>
                    </div>
                </div>
                <?php endif; ?>
                <div class="content-container">
                    <?php if ( !has_post_thumbnail() ) : ?>
                    <div class="category">
                        <?php
                        $categories = get_the_category();
                        foreach ($categories as $category) {
                            echo '<a class="term-id-' . $category->term_id . '" href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( $category->name ) . '"><span>' . esc_html( $category->name ) . '</span></a>';
                        }
                        ?>
                    </div>
                    <?php endif; ?>
                    <h3 class="title"><a class="title-animation-underline-in-out" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="meta-details">
                        <div class="meta author">
                            <div class="author-image"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ); ?></div>
                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ))); ?>">
                                <?php echo esc_html(get_the_author()); ?>
                            </a>
                        </div>
                        <div class="meta date">
                            <span><?php echo get_the_date(); ?></span>
                        </div>
                    </div>
                    <?php
                    $excerpt = rivax_get_the_excerpt(100);
                    if ($excerpt) {
	                    echo '<p class="excerpt">' . $excerpt . '</p>';
                    }
                    ?>
                    <a href="<?php the_permalink(); ?>" class="rivax-read-more icon-after">
                        <span class="read-more-title"><?php esc_html_e('Read More', 'raveen'); ?></span>
                        <i class="ri-angle-right-solid"></i>
                    </a>
                </div>
            </article>
            <?php
        }
        ?>
        </div>
        <?php

        // Pagination
        global $wp_query;
        if ( $wp_query->max_num_pages > 1 ) :
            ?>
            <nav class="default-post-list-pagination">
                <?php
                $paginate_args = array(
	                'current'   => max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) ),
	                'total'     => $wp_query->max_num_pages,
	                'prev_next' => false,
                );

                echo paginate_links( $paginate_args );
                ?>
            </nav>
        <?php endif;

    }
    else {
        rivax_query_not_found_msg ();
    }
    ?>
</div>