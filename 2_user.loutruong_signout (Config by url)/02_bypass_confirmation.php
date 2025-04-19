<?php
add_action('check_admin_referer', 'custom_logout_redirect_for_polylang', 10, 2);

function custom_logout_redirect_for_polylang($action, $result)
{
    // Check if it's the logout action and the confirmation nonce is missing
    if ($action === "log-out" && !isset($_GET['_wpnonce'])) {

        // --- 1. Determine Current Language using Polylang ---
        $current_language = 'vi';
        if (function_exists('pll_current_language')) {
            $lang_slug = pll_current_language('slug');
            if (!empty($lang_slug)) {
                $current_language = $lang_slug; // If Polylang returns a valid language slug ('vi', 'en', 'cn', etc.), use it.
            }
        }

        // --- 2. Determine Target Path based on Language ---
        $target_path = '';
        if ($current_language === 'vi') {
            $target_path = '/'; // Path for default Vietnamese language
        } elseif ($current_language === 'en') {
            $target_path = '/en'; // Path for explicit English language
        } else {
            $target_path = '';
        }

        // --- 3. Construct the Full Redirect URL ---
        $final_redirect_url = home_url('/' . $target_path);

        // --- 4. Generate Secure Logout URL & Redirect ---
        $logout_url = wp_logout_url($final_redirect_url);
        wp_safe_redirect(str_replace('&amp;', '&', $logout_url));
        exit; // Always exit after a redirect
    }
}
