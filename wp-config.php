<?

define('IS_LOCAL', $_SERVER['HTTP_HOST'] == 'localhost');

if(IS_LOCAL){

	define('DB_NAME', 'matchrepo');

	define('DB_USER', 'root');

	define('DB_PASSWORD', '');

	define('WP_DEBUG', true);
}
else{
	define('DB_NAME', 'shiduch_wp');

	define('DB_USER', 'shiduch_wp');

	define('DB_PASSWORD', '1fWrp7YQ');

	define('WP_DEBUG', false);
}

define('DB_HOST', 'localhost');

define('DB_CHARSET', 'utf8');

define('DB_COLLATE', '');

/* Loading Contact Form 7 javascript and stylesheet only when it's necessary */

define('WPCF7_LOAD_CSS', false);

define('WPCF7_LOAD_JS', false);

$table_prefix  = 'wp_';

define ('WPLANG', 'he_IL');

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');
