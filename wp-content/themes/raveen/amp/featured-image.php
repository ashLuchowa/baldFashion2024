<figure class="amp-wp-article-featured-image">
    <?php
    $post_format = get_post_format() ? : 'standard';

    if( $post_format == 'gallery' ) {
        $gallery_images = get_post_meta( get_the_ID(), 'rivax_single_gallery_images', true);
        if(is_array($gallery_images)) {
            ?>
            <figure class="is-layout-flex wp-block-gallery has-nested-images columns-default">
                <?php
                foreach ($gallery_images as $id => $gallery_image) {

                    $image_url = wp_get_attachment_image_url($id, 'rivax-large');
                    if($image_url) {
                        echo '<img src="' . esc_url($image_url) . '" alt="' . get_the_title() . '">';
                    }
                }
                ?>
            </figure>
            <?php
        }

    }
    elseif( $post_format == 'video' ) {
        $video_url = esc_url(get_post_meta( get_the_ID(), 'rivax_single_video_url', true));
        if( $video_url ) echo wp_oembed_get($video_url , array('width' => '830'));
    }
    elseif( $post_format == 'audio') {
        $audio_url = esc_url(get_post_meta( get_the_ID(), 'rivax_single_audio_url', true));
        if($audio_url) echo wp_oembed_get($audio_url);
    }
    elseif( $post_format == 'link') {
        $link_url = get_post_meta( get_the_ID(),'rivax_single_link_url', true);
        $link_title = get_post_meta( get_the_ID(),'rivax_single_link_title', true);

        $link_url_text = preg_replace('/https?:\/\/(www.)?/', '', $link_url);; // Remove http / www
        ?>
        <div class="article-featured-link">
            <a class="link" target="_blank" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_url_text); ?></a>
            <p class="title"><?php echo esc_html($link_title); ?></p>
        </div>
        <?php
    }
    elseif( $post_format == 'quote' ) {
        $quote_content = get_post_meta( get_the_ID(), 'rivax_single_quote_content', true);
        $quote_author = get_post_meta( get_the_ID(), 'rivax_single_quote_author', true);
        ?>
        <div class="article-featured-quote">
            <p class="content"><?php echo esc_html($quote_content); ?></p>
            <p class="author">- <?php echo esc_html($quote_author); ?></p>
        </div>
        <?php
    }
    elseif( $post_format == 'standard' ) {
        the_post_thumbnail('rivax-medium', array( 'title' => get_the_title() ));
    }
    ?>
</figure>
