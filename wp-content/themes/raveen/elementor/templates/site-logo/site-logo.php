<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$image_src = esc_url( $settings['image']['url'] );
$image_attributes = wp_get_attachment_image_src( $settings['image']['id'], 'full' );
$mobile_image_src = esc_url( $settings['mobile_image']['url'] );
$retina_image_src = esc_url( $settings['retina_image']['url'] );


$image_src_dark = esc_url( $settings['image_dark']['url'] );
$image_attributes_dark = wp_get_attachment_image_src( $settings['image_dark']['id'], 'full' );
$mobile_image_src_dark = esc_url( $settings['mobile_image_dark']['url'] );
$retina_image_src_dark = esc_url( $settings['retina_image_dark']['url'] );


// Title
$title = '';
if ( 'default' === $settings['title_type'] ) {
    $title = esc_html(get_bloginfo( 'name' ) );
}
elseif ( 'custom' === $settings['title_type'] ) {
    $title = esc_html( $settings['custom_title'] );
}

// Description
$description = '';
if ( 'default' === $settings['description_type'] ) {
    $description =  esc_html( get_bloginfo( 'description' ) );
}
elseif ( 'custom' === $settings['description_type'] ) {
    $description = esc_html( $settings['custom_description'] );
}

// Logo URL
$this->add_render_attribute( 'url_attr', 'rel', 'home' );

if ( 'default' === $settings['url_type'] ) {
    $this->add_render_attribute( 'url_attr', 'href',  esc_url(home_url('/')) );
}
elseif ( 'custom' === $settings['url_type'] ) {

    $this->add_link_attributes( 'url_attr', $settings['custom_url'] );
}

// Logo URL Title
if($title) {
    $this->add_render_attribute( 'url_attr', 'title', $title );
}
else {
    $this->add_render_attribute( 'url_attr', 'title', esc_html( get_bloginfo( 'name' ) ) );
}

?>

<div class="rivax-logo">

    <?php if ( !empty( $image_src ) ) : ?>
    <a <?php $this->print_render_attribute_string( 'url_attr' ); ?>>

        <?php if ( !empty( $image_src_dark ) ) : ?>
            <picture class="rivax-logo-image dark-logo">
                <?php if ( ! empty( $mobile_image_src_dark ) ) : ?>
                    <source media="(max-width: 767px)" srcset="<?php echo esc_attr($mobile_image_src_dark); ?>">
                <?php endif; ?>

                <?php if ( ! empty( $retina_image_src_dark ) ) : ?>
                    <source srcset="<?php echo esc_attr( $image_src_dark ); ?> 1x, <?php echo esc_url( $retina_image_src_dark ); ?> 2x">
                <?php endif; ?>

                <img src="<?php echo esc_url($image_src_dark); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="<?php echo !empty($image_attributes_dark[1])? esc_attr($image_attributes_dark[1]) : ''; ?>" height="<?php echo !empty($image_attributes_dark[2])? esc_attr($image_attributes_dark[2]) : ''; ?>">
            </picture>
        <?php endif; ?>

        <picture class="rivax-logo-image">
            <?php if ( ! empty( $mobile_image_src ) ) : ?>
                <source media="(max-width: 767px)" srcset="<?php echo esc_attr($mobile_image_src); ?>">
            <?php endif; ?>

            <?php if ( ! empty( $retina_image_src ) ) : ?>
                <source srcset="<?php echo esc_attr( $image_src ); ?> 1x, <?php echo esc_url( $retina_image_src ); ?> 2x">
            <?php endif; ?>

            <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="<?php echo !empty($image_attributes[1])? esc_attr($image_attributes[1]) : ''; ?>" height="<?php echo !empty($image_attributes[2])? esc_attr($image_attributes[2]) : ''; ?>">
        </picture>
    </a>
    <?php endif; ?>


    <?php if ( ! empty( $title ) || ! empty( $description ) ) : ?>
        <div class="rivax-logo-text">
            <?php if ( ! empty( $title ) ) : ?>
            <p class="rivax-logo-title">
                <a <?php $this->print_render_attribute_string( 'url_attr' ); ?>>
                <?php echo esc_html($title); ?>
                </a>
            </p>
            <?php endif; ?>

            <?php
            if ( ! empty( $description ) ) : ?>
                <p class="rivax-logo-description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>