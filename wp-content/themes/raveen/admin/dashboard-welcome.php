<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly
?>
<div class="rivax-dashboard-wrapper">
    <div class="rivax-dashboard-header">
        <div class="rivax-dashboard-header-content">
            <?php
            $theme = wp_get_theme(); 
            $theme = $theme->parent() ?: $theme;
            ?>
			<div class="rivax-dashboard-stars"><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></div>
            <h1><?php esc_html_e('Welcome to Raveen - Version ', 'raveen'); echo esc_html($theme->get( 'Version' )); ?></h1>
            <p><?php esc_html_e('Thank you so much for joining with Rivax Studio family! Hope you enjoy working with the theme.', 'raveen'); ?></p>
            <p><?php printf(esc_html__('Please do not forget to rate this theme %1$s 5 stars %2$s. This encourages us to add more features to it.', 'raveen'), '<b>', '</b>'); ?></p>
            <p><?php printf(esc_html__('Please %1$srate it here%2$s.', 'raveen'), '<a target="_blank" class="rivax-dashboard-link" href="https://themeforest.net/downloads">', '</a>'); ?></p>
            <div class="rivax-dashboard-hr"></div>
			<p><?php esc_html_e('If you are interested in our theme, Please look at our other themes on themeforest.', 'raveen'); ?> <a class="rivax-dashboard-link" href="https://1.envato.market/7m70Rd" target="_blank"><?php esc_html_e('Rivax Studio Themes', 'raveen'); ?></a></p>
        </div>
        <div class="rivax-dashboard-header-logo">
            <a href="https://1.envato.market/7m70Rd" target="_blank">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/admin/assets/img/developer-logo.png'); ?>" alt="<?php esc_html_e('Rivax Studio', 'raveen'); ?>">
                <span><?php esc_html_e('Rivax Studio', 'raveen'); ?></span>
            </a>
        </div>
    </div>
    <div class="rivax-dashboard-body">
        <div class="rivax-dashboard-card">
            <div class="rivax-dashboard-card-inner card-1">
                <h3><?php esc_html_e('Step 1 : Install Required Plugins', 'raveen'); ?></h3>
                <p><?php esc_html_e('Our theme has some required and optional plugins to function properly. Please install them.', 'raveen'); ?></p>
                <a class="rivax-dashboard-btn" href="<?php echo esc_url(admin_url( 'themes.php?page=tgmpa-install-plugins' )); ?>"><?php esc_html_e('Install Plugins', 'raveen'); ?></a>
            </div>
        </div>
        <div class="rivax-dashboard-card">
            <div class="rivax-dashboard-card-inner card-2">
                <h3><?php esc_html_e('Step 2 : Import Demo Content', 'raveen'); ?></h3>
                <p><?php esc_html_e('Importing demo data (post, pages, images, theme settings, etc.) is the quickest and easiest way to set up your new theme.', 'raveen'); ?></p>
                <a class="rivax-dashboard-btn" href="<?php echo esc_url(admin_url( 'admin.php?page=rivax-demo-importer' )); ?>"><?php esc_html_e('Import Demo', 'raveen'); ?></a>
            </div>
        </div>
        <div class="rivax-dashboard-card">
            <div class="rivax-dashboard-card-inner card-3">
                <h3><?php esc_html_e('Step 3 : Read Theme Documentation', 'raveen'); ?></h3>
                <p><?php esc_html_e('Follow our documentation and read the theme setup and configurations to learn how to use the theme.', 'raveen'); ?></p>
                <a class="rivax-dashboard-btn" href="https://docs.rivaxstudio.com/raveen/" target="_blank"><?php esc_html_e('Read Documentation', 'raveen'); ?></a>
            </div>
        </div>
        <div class="rivax-dashboard-card">
            <div class="rivax-dashboard-card-inner card-4">
                <h3><?php esc_html_e('Step 4 : Check Video Tutorials', 'raveen'); ?></h3>
                <p><?php esc_html_e('We have made some helpful video tutorials to show you how to work with the theme.', 'raveen'); ?></p>
                <a class="rivax-dashboard-btn" href="https://www.youtube.com/@rivaxstudio/playlists" target="_blank"><?php esc_html_e('Check Video Tutorials', 'raveen'); ?></a>
            </div>
        </div>
		<div class="rivax-dashboard-card">
            <div class="rivax-dashboard-card-inner card-5">
                <h3><?php esc_html_e('Step 5 : Need Any Help?', 'raveen'); ?></h3>
                <p><?php esc_html_e('If you need any assistance, feel free to contact us and ask your question.', 'raveen'); ?></p>
                <a class="rivax-dashboard-btn" href="https://1.envato.market/7m70Rd" target="_blank"><?php esc_html_e('Ask Question', 'raveen'); ?></a>
            </div>
        </div>
    </div>
</div>

