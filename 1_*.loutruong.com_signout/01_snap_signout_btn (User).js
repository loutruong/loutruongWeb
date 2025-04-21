< script >
    document.addEventListener('DOMContentLoaded', function() {
        const logoutButtonId = 'site-logout-button'; // Controller
    const logoutButton = document.getElementById(logoutButtonId);

    if (logoutButton) {
        logoutButton.href = '/wp-login.php?action=logout';
        } else {
        // console.warn('Logout button ID "' + logoutButtonId + '" not found on user.loutruong.com');
    }
    }); <
/script>