<?php
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    // Echo avatar HTML tag. Adjust size (e.g., 32) as needed.
    echo get_avatar($current_user->ID, 32);
}
