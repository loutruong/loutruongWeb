<script>
// JS for Sign In Page - Updates the link going TO the Sign Up page
// Targets Elementor element with ID 'signin_to_signup'
// Current time: Sunday, April 20, 2025 at 7:41:15 PM +07. Location: Ho Chi Minh City, Vietnam.
document.addEventListener('DOMContentLoaded', function() {
    // --- Configure ---
    const signUpLinkId = 'signin_to_signup'; // <<< ID for the Elementor button/link going to Sign Up
    const signUpPathVi = '/dang-ky/';    // <<< Path to VI Sign Up page
    const signUpPathEn = '/en/sign-up/'; // <<< Path to EN Sign Up page
    const defaultLang = 'vi';
    // --- End Configure ---

    const signUpLink = document.getElementById(signUpLinkId); // Find the target link/button

    // Step 1: Search the current page URL for the 'redirect_to' parameter
    const currentParams = new URLSearchParams(window.location.search);
    const redirectValue = currentParams.get('redirect_to'); // This will be null if the parameter doesn't exist

    // Determine language for the target Sign Up path
    const pageLang = document.documentElement.lang.substring(0, 2) || defaultLang;
    let signUpPagePath = signUpPathVi;
    if (pageLang === 'en') { signUpPagePath = signUpPathEn; }
    /* Add other lang conditions if needed */

    // Step 2: Check if the Sign Up link element exists AND if the redirect_to parameter was found
    if (signUpLink) {
        if (redirectValue) { // Only proceed if redirectValue is not null/empty
            try {
                // Step 3: Grab value and concatenate to the Sign Up page URL
                const targetUrl = new URL(signUpPagePath, window.location.origin);
                targetUrl.searchParams.set('redirect_to', redirectValue); // Appends ?redirect_to=...
                signUpLink.href = targetUrl.toString(); // Update the link's href
                // console.log('Sign Up link updated on Sign In page:', signUpLink.href);
            } catch (e) {
                console.error("Error updating sign up link:", e);
                // Fallback to base sign up path on error
                signUpLink.href = signUpPagePath;
            }
        } else if (!signUpLink.getAttribute('href') || signUpLink.getAttribute('href') === '#') {
             // If NO redirect_to param found, just set the base Sign Up link (if href was initially empty or '#')
             signUpLink.href = signUpPagePath;
        }
         // else: Element exists, no redirectValue, but href already set - leave it alone.
    } else {
         console.warn('Element with ID "' + signUpLinkId + '" not found on Sign In page.');
    }
});
</script>