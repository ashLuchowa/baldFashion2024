<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$show_label = $settings['show_label'];
?>

<div class="rivax-contact-form-wrapper">
    <form method="post" class="rivax-contact-form">
        <div class="fields-wrapper">
            <div class="field-wrap first-name-wrap">
                <?php if($show_label && $settings['first_name_label']): ?><label for="first-name"><?php echo esc_html($settings['first_name_label']); ?></label><?php endif; ?>
                <input type="text" placeholder="<?php echo esc_attr($settings['first_name_placeholder']); ?>" name="first-name" id="first-name" required>
            </div>
            <?php if($settings['show_last_name']): ?>
            <div class="field-wrap last-name-wrap">
                <?php if($show_label && $settings['last_name_label']): ?><label for="last-name"><?php echo esc_html($settings['last_name_label']); ?></label><?php endif; ?>
                <input type="text" placeholder="<?php echo esc_attr($settings['last_name_placeholder']); ?>" name="last-name" id="last-name" required>
            </div>
            <?php endif; ?>
            <div class="field-wrap email-wrap">
                <?php if($show_label && $settings['email_label']): ?><label for="email"><?php echo esc_html($settings['email_label']); ?></label><?php endif; ?>
                <input type="email" placeholder="<?php echo esc_attr($settings['email_placeholder']); ?>" name="email" id="email" required>
            </div>
            <?php if($settings['show_subject']): ?>
            <div class="field-wrap subject-wrap">
                <?php if($show_label && $settings['subject_label']): ?><label for="subject"><?php echo esc_html($settings['subject_label']); ?></label><?php endif; ?>
                <input type="text" placeholder="<?php echo esc_attr($settings['subject_placeholder']); ?>" name="subject" id="subject" required>
            </div>
            <?php endif; ?>
            <div class="field-wrap message-wrap">
                <?php if($show_label && $settings['message_label']): ?><label for="message"><?php echo esc_html($settings['message_label']); ?></label><?php endif; ?>
                <textarea placeholder="<?php echo esc_attr($settings['message_placeholder']); ?>" name="message" id="message" cols="30" rows="10" minlength="5" required></textarea>
            </div>
        </div>
        <div class="submit-wrapper">
            <button type="submit" class="button submit-btn"><?php echo esc_attr($settings['button_label']); ?> <span class="btn-loading-bar"></span></button>
        </div>
    </form>
    <div class="msg-wrapper">
        <span class="msg" data-success="<?php echo esc_attr($settings['success_msg']); ?>" data-error="<?php echo esc_attr($settings['error_msg']); ?>" data-fill="<?php echo esc_attr($settings['fill_msg']); ?>"></span>
    </div>
</div>