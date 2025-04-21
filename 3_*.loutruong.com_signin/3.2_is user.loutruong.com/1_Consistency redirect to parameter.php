/**
* FINAL VERSION: Ensures 'redirect_to' persists in Polylang links on user subdomain,
* using rawurlencode() and manual concatenation to FORCE encoding.
* Function: loutruong_finalest_keep_redirect_in_lang_switcher_forced (ensure unique)
* Current time: Monday, April 21, 2025 at 09:30:10 AM +07.
*/

// !!! Verify 'pll_the_language_link' is the correct Polylang filter hook !!!
add_filter( 'pll_the_language_link', 'loutruong_finalest_keep_redirect_in_lang_switcher_forced', 10, 3 );

if (!function_exists('loutruong_finalest_keep_redirect_in_lang_switcher_forced')) {
function loutruong_finalest_keep_redirect_in_lang_switcher_forced( $url, $slug, $locale ) {
// Only run this logic on the user subdomain
if ( !isset($_SERVER['HTTP_HOST']) || $_SERVER['HTTP_HOST'] !== 'user.loutruong.com' ) {
return $url;
}

// Check if the redirect_to parameter exists in the CURRENT page's URL's query string
if ( isset( $_GET['redirect_to'] ) && ! empty( $_GET['redirect_to'] ) ) {

$redirect_value = wp_unslash( $_GET['redirect_to'] ); // Get the plain URL value

// Basic sanity check on length
if ( strlen($redirect_value) < 500 && filter_var($redirect_value, FILTER_VALIDATE_URL) ) { // Also check if it's a URL

    // --- Explicitly encode the value using rawurlencode ---
    // This converts ':' to %3A, '/' to %2F, etc.
    $encoded_redirect_value=rawurlencode( $redirect_value );

    // --- Manually append the parameter and ENCODED value ---
    // Check if the base URL ($url) already has query parameters
    if (strpos($url, '?' )===false) {
    // No existing params, add with ?
    $url .='?redirect_to=' . $encoded_redirect_value;
    } else {
    // Already has params, add with &
    $url .='&redirect_to=' . $encoded_redirect_value;
    }
    }
    }
    // Return the modified URL (with manually encoded redirect_to added) or the original URL
    return $url;
    }
    }