<div class="popup-search">
    <div class="popup-search-container">
        <span class="popup-search-closer"><?php esc_html_e('Close', 'raveen'); ?></span>
        <div class="popup-search-content">
            <div class="popup-search-title-wrapper">
                <h3><?php esc_html_e('What are you looking for?', 'raveen'); ?></h3>
            </div>
            <div class="popup-search-form-wrapper">
                <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="popup-search-form">
                    <input type="text" name="s" value="" class="search-field" placeholder="<?php esc_attr_e('Search ...', 'raveen'); ?>" aria-label="Search" required>
                    <button type="submit" class="submit" aria-label="Submit">
                        <i class="ri-search-2-line"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
