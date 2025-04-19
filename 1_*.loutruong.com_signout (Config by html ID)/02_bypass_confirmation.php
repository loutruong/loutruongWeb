<?php
add_action('check_admin_referer', 'logout_without_confirm', 10, 2);

function logout_without_confirm($action, $result)
{
    if ($action === "log-out" && !isset($_GET['_wpnonce'])) {
        $allowed_main_domain = 'loutruong.com';
        $redirect_to_url = '';

        // 1. Determine the intended redirect URL from the initial request's 'redirect_to' parameter
        // (This parameter should have been added correctly by the JavaScript snippet)
        if (isset($_REQUEST['redirect_to']) && !empty($_REQUEST['redirect_to'])) {
            // Sanitize and Validate the requested URL
            $requested_redirect = esc_url_raw(wp_unslash($_REQUEST['redirect_to']));
            $is_valid_redirect = false;

            if ($requested_redirect) {
                $parsed_requested_url = parse_url($requested_redirect);
                // Check if host exists and is within the allowed main domain
                if (
                    isset($parsed_requested_url['host']) &&
                    ($parsed_requested_url['host'] === $allowed_main_domain || str_ends_with($parsed_requested_url['host'], '.' . $allowed_main_domain))
                ) {
                    $is_valid_redirect = true;
                    // Use the validated URL from the original request
                    $redirect_to_url = $requested_redirect;
                }
            }

            if (!$is_valid_redirect) {
                // Security fallback: Invalid URL requested in link, default to home
                $redirect_to_url = home_url('/');
                // error_log("[SkipConfirmRedirect] Invalid 'redirect_to' requested: " . $_REQUEST['redirect_to'] . ". Defaulting to home.");
            }
        } else {
            // Fallback if 'redirect_to' was not in the original request link (JS might have failed)
            $redirect_to_url = home_url('/');
            // error_log("[SkipConfirmRedirect] No 'redirect_to' parameter found in request. Defaulting to home.");
        }

        // 2. Generate the final logout URL with the determined redirect target
        // Pass the validated $redirect_to_url to wp_logout_url()
        $logout_url = wp_logout_url($redirect_to_url);

        // 3. Perform the redirect immediately to the generated logout URL.
        // This bypasses the confirmation screen. WP will process the logout and then use the embedded redirect_to value.
        $location_safe = esc_url_raw(str_replace('&amp;', '&', $logout_url));

        if ($location_safe) {
            wp_safe_redirect($location_safe);
            exit; // Stop script execution
        }

        // Ultimate fallback if something went very wrong generating the URL
        error_log("[SkipConfirmRedirect] Failed to generate final logout URL.");
        wp_safe_redirect(home_url('/'));
        exit;
    }
}
