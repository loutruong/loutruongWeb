// Targets Elementor button with ID 'to_signin'
// Adds redirect_to parameter pointing to current page
document.addEventListener('DOMContentLoaded', function () {
    // --- Configure ---
    const signInButtonId = 'to_signin'; // <<< Your Elementor Sign In button ID
    const baseUserDomain = 'https://user.loutruong.com'; // <<< Your user subdomain URL
    const defaultLang = 'vi';
    // --- End Configure ---

    const signInButton = document.getElementById(signInButtonId);
    const siteLang = document.documentElement.lang.substring(0, 2) || defaultLang;

    if (signInButton) {
        const currentPageUrl = window.location.href;
        let signInPath = '/'; // Path on user domain for 'vi'
        if (siteLang && siteLang !== defaultLang) {
            signInPath = '/' + siteLang + '/'; // Assumes /en/, /cn/ etc. <<< Adjust if needed
        }
        const baseSignInUrl = baseUserDomain + signInPath;
        try {
            const targetUrl = new URL(baseSignInUrl);
            targetUrl.searchParams.set('redirect_to', currentPageUrl);
            signInButton.href = targetUrl.toString();
            // console.log('Sign In link updated on ' + window.location.hostname + ':', signInButton.href);
        } catch (e) {
            console.error("JS Error constructing Sign In URL: ", e);
            signInButton.href = baseSignInUrl; // Fallback
        }
    } else {
        // console.warn('Sign In button element with ID "' + signInButtonId + '" not found on ' + window.location.hostname);
    }
});
