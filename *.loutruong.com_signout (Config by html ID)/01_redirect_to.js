<script>
document.addEventListener('DOMContentLoaded', function() {
    
    const logoutButtonId = 'site-logout-button'; // Controller
    const logoutButton = document.getElementById(logoutButtonId);
    
    if (logoutButton) {
        const currentPageUrl = window.location.href; // Get the current page's full URL
        const logoutBasePath = '/wp-login.php?action=logout'; // Construct the basic logout URL path relative to the domain root
        
        // Use the URL object for safely adding parameters
        try {
            const logoutUrl = new URL(logoutBasePath, window.location.origin);
            logoutUrl.searchParams.set('redirect_to', currentPageUrl); // Add the current page URL as the redirect_to parameter
            logoutButton.href = logoutUrl.toString(); // Set the button's href attribute to the fully constructed URL
        } 
        catch (e) {
             console.error("Error constructing logout URL: ", e);
        }
    } 
    else {
    }
});
</script>