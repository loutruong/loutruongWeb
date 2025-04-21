<?php
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    echo esc_html($current_user->display_name);
    // Or use $current_user->last_name if you prefer
}
