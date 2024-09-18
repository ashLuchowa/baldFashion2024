<?php
/**
 * Template part for displaying default page 404
 */
?>
<div class="container">
    <div class="page-content-wrapper">
        <div class="content-container">
            <div class="page-content page-404" >
                <h1>404</h1>
                <p>
                    <?php esc_html_e('It looks like nothing was found at this location.', 'raveen'); ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Return to Home Page', 'raveen'); ?></a>
                </p>
            </div>
        </div>
    </div>
</div>
