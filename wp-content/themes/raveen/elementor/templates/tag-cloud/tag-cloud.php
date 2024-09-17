<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$args = [
    'taxonomy'   => $settings["taxonomy"],
    'orderby'    => $settings["orderby"],
    'order'      => $settings["order"],
    'include'    => esc_attr($settings["include"]),
    'exclude'    => esc_attr($settings["exclude"]),
    'parent'     => $settings["parent"],
    'number'     => $settings["item_limit"]["size"],
];
$categories = get_categories( $args );


if (!empty($categories)) :

    ?>
    <div class="rivax-tag-cloud">
        <?php
        if( !empty($settings['multiple_background']) ){

            $multiple_bg = explode(',', rtrim($settings['multiple_background'], ','));
            $total_category = count($categories);

            // re-creating array for the multiple colors
            $jCount= count($multiple_bg);
            $j=0;
            for ($i=0; $i < $total_category; $i++) {
                if($j == $jCount) {
                    $j = 0;
                }
                $multiple_bg_create[$i]=$multiple_bg[$j];
                $j++;
            }
        }

        foreach ( $categories as $index => $cat ) :

            $this->add_render_attribute('category-item', 'class', 'rivax-tag-cloud-item term-id-' . $cat->term_id, true);
            $this->add_render_attribute( 'category-item', 'href', get_category_link( $cat->term_id ), true );

            if ($settings['single_background'] == '') {

                if( !empty($settings['multiple_background']) ){
                    $bg_color =  $multiple_bg_create[$index];
                    if(!preg_match('/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/', $multiple_bg_create[$index])){
                        $bg_color = rivax_strToHex($cat->name);
                    }
                }
                else {
                    $bg_color = rivax_strToHex($cat->name);
                }


                $this->add_render_attribute('category-item', 'style', "background-color: $bg_color", true);
            }

            ?>

        <div class="rivax-tag-cloud-item-wrapper">
            <a <?php $this->print_render_attribute_string('category-item'); ?> >
                <span class="rivax-tag-cloud-name"><?php echo esc_html($cat->name); ?></span>

                <?php if ( $settings['show_count'] == 'yes' ) : ?>
                    <span class="rivax-tag-cloud-count"><?php echo esc_html($cat->count); ?></span>
                <?php endif; ?>
            </a>
        </div>
            <?php

        endforeach;
        ?>
    </div>
<?php
else :

    echo '<p>'.esc_html__('Category Not Found!', 'raveen').'</p>';

endif;