<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly
?>
<div class="rivax-mailchimp-wrapper">
	<?php if ( \Elementor\Plugin::$instance->editor->is_edit_mode() && $settings['mailchimp_success_message_show_in_editor'] ) : ?>
        <div class="rivax-mailchimp-response-message success"><?php esc_html_e( 'This is a dummy message for success. This won\'t show in preview.', 'raveen' ); ?></div>
	<?php endif; ?>
	<?php if ( \Elementor\Plugin::$instance->editor->is_edit_mode() && $settings['mailchimp_error_message_show_in_editor'] ) : ?>
        <div class="rivax-mailchimp-response-message error"><?php esc_html_e( 'This is a dummy message for error. This won\'t show in preview.', 'raveen' ); ?></div>
	<?php endif; ?>
    <div class="rivax-mailchimp-response-message"></div>
    <form class="rivax-mailchimp-form" data-list-id="<?php echo esc_attr( $settings['mailchimp_list'] ); ?>">
		<?php if ( $settings['enable_name'] ) : ?>
            <div class="rivax-mailchimp-input-wrapper">
				<?php if ( ! empty( $settings['fname_label'] ) ) : ?>
                    <label class="rivax-mailchimp-input-label"><?php echo esc_html( $settings['fname_label'] ); ?></label>
				<?php endif; ?>
                <div class="rivax-mailchimp-input">
                    <input type="text" name="fname" placeholder="<?php echo esc_attr( $settings['fname_placeholder'] ); ?>">
                </div>
            </div>
            <div class="rivax-mailchimp-input-wrapper">
				<?php if ( ! empty( $settings['lname_label'] ) ) : ?>
                    <label class="rivax-mailchimp-input-label"><?php echo esc_html( $settings['lname_label'] ); ?></label>
				<?php endif; ?>
                <div class="rivax-mailchimp-input">
                    <input type="text" name="lname" placeholder="<?php echo esc_attr( $settings['lname_placeholder'] ); ?>">
                </div>
            </div>
		<?php endif; ?>
		<?php if ( $settings['enable_phone'] ) : ?>
            <div class="rivax-mailchimp-input-wrapper">
				<?php if ( ! empty( $settings['phone_label'] ) ) : ?>
                    <label class="rivax-mailchimp-input-label"><?php echo esc_html( $settings['phone_label'] ); ?></label>
				<?php endif; ?>
                <div class="rivax-mailchimp-input">
                    <input type="text" name="phone" placeholder="<?php echo esc_attr( $settings['phone_placeholder'] ); ?>">
                </div>
            </div>
		<?php endif; ?>
        <div class="rivax-mailchimp-input-wrapper">
			<?php if ( ! empty( $settings['email_label'] ) ) : ?>
                <label class="rivax-mailchimp-input-label"><?php echo esc_html( $settings['email_label'] ); ?></label>
			<?php endif; ?>
            <div class="rivax-mailchimp-input">
                <input type="email" name="email" placeholder="<?php echo esc_attr( $settings['email_placeholder'] ); ?>" required>
            </div>
        </div>
        <div class="rivax-mailchimp-button-wrapper">

            <button type="submit" class="rivax-mailchimp-button" name="rivax-mailchimp" aria-label="Mailchimp">
	            <?php if($settings['button_icon']['value']): ?>
                    <span class="button-icon">
			            <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'] ); ?>
                    </span>
	            <?php endif; ?>
				<span class="button-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
            </button>
        </div>
    </form>
</div>
