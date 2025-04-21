define( 'WP_ALLOW_MULTISITE', true );
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', true );
define( 'DOMAIN_CURRENT_SITE', 'loutruong.com' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );


// SMTP email settings
define( 'SMTP_USER', 'AKIAXUYKD4LSUBSXZ7HI' );
define( 'SMTP_PASS', 'BOjHvnI8thEIAxLcNoyYZg+GMgYdCfxcoQuWslUF0h7Z' );
define( 'SMTP_HOST', 'email-smtp.ap-southeast-1.amazonaws.com' );
define( 'SMTP_FROM', 'hi@loutruong.com' );
define( 'SMTP_NAME', 'Lou Trương' );
define( 'SMTP_PORT', '587' );
define( 'SMTP_SECURE', 'tls' );
define( 'SMTP_AUTH', true );


// Send email via SMTP
add_action( 'phpmailer_init', 'my_phpmailer_example' );
function my_phpmailer_example( $phpmailer ) {
$phpmailer->isSMTP();
$phpmailer->Host = SMTP_HOST;
$phpmailer->SMTPAuth = SMTP_AUTH;
$phpmailer->Port = SMTP_PORT;
$phpmailer->Username = SMTP_USER;
$phpmailer->Password = SMTP_PASS;
$phpmailer->SMTPSecure = SMTP_SECURE;
$phpmailer->From = SMTP_FROM;
$phpmailer->FromName = SMTP_NAME;
}


define('DISABLE_WP_CRON', true);
