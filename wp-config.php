<?php // Modified for Hebrew translation
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

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

define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

$table_prefix  = 'wp_';

define ('WPLANG', 'he_IL');

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');
