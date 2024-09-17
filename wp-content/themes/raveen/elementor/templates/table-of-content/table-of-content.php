<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if(!empty($_GET['elementor-preview']) || \Elementor\Plugin::$instance->editor->is_edit_mode()) {

    $toc_title = esc_html(rivax_get_option('toc-title'));
    $toc_collapsable = rivax_get_option('toc-collapsable');
    $cls = "rivax-toc-items";
    $cls .= rivax_get_option('toc-hierarchically')? ' toc-hierarchically' : ' toc-flat';
    $cls .= rivax_get_option('toc-counter')? ' toc-counter' : '';
    ?>
    <div class="rivax-toc-wrap">
        <?php
        $toc_title = esc_html(rivax_get_option('toc-title'));
        $toc_collapsable = rivax_get_option('toc-collapsable');

        if($toc_title || $toc_collapsable) {
            ?>
            <div class="toc-header">
                <div class="toc-header-title-wrap">
                    <?php
                    if($toc_title) {
                        echo '<h3>' . esc_html($toc_title) . '</h3>';
                    }
                    ?>
                </div>
                <div class="toc-header-collapse-wrap">
                    <?php
                    if($toc_collapsable) {
                        echo '<span class="toc-header-collapse"><i class="ri-arrow-up-s-line"></i></span>';
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>

        <ul class="<?php echo esc_attr($cls); ?>">
            <li class="toc-item-heading-2 level-1"><a class="rivax-toc-anchor" href="#sample-heading-h2"><?php echo esc_html__('Sample heading H2', 'raveen'); ?></a></li>
            <li class="toc-item-heading-2 level-1"><a class="rivax-toc-anchor" href="#sample-heading-h2"><?php echo esc_html__('Sample heading H2', 'raveen'); ?></a></li>
            <li class="toc-item-heading-3 level-2"><a class="rivax-toc-anchor" href="#sample-heading-h3"><?php echo esc_html__('Sample heading H3', 'raveen'); ?></a></li>
            <li class="toc-item-heading-3 level-2"><a class="rivax-toc-anchor" href="#sample-heading-h3"><?php echo esc_html__('Sample heading H3', 'raveen'); ?></a></li>
            <li class="toc-item-heading-3 level-2"><a class="rivax-toc-anchor" href="#sample-heading-h3"><?php echo esc_html__('Sample heading H3', 'raveen'); ?></a></li>
            <li class="toc-item-heading-4 level-3"><a class="rivax-toc-anchor" href="#sample-heading-h4"><?php echo esc_html__('Sample heading H4', 'raveen'); ?></a></li>
            <li class="toc-item-heading-4 level-3"><a class="rivax-toc-anchor" href="#sample-heading-h4"><?php echo esc_html__('Sample heading H4', 'raveen'); ?></a></li>
            <li class="toc-item-heading-4 level-3"><a class="rivax-toc-anchor" href="#sample-heading-h4"><?php echo esc_html__('Sample heading H4', 'raveen'); ?></a></li>
            <li class="toc-item-heading-2 level-1"><a class="rivax-toc-anchor" href="#sample-heading-h2"><?php echo esc_html__('Sample heading H2', 'raveen'); ?></a></li>
            <li class="toc-item-heading-2 level-1"><a class="rivax-toc-anchor" href="#sample-heading-h2"><?php echo esc_html__('Sample heading H2', 'raveen'); ?></a></li>
        </ul>

    </div>
    <?php
}
else {
    $toc = Rivax_Toc::get_instance();
    $toc->elementor_toc();
}
?>


