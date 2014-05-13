<? // Modified for Hebrew translation
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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'matchrepo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+,C:EKgFz@|!VY {eE)Y6@A1%<mK*(*L~&=0A^4Sed7u1p|_8uhB^~4.|.#p8rkT');
define('SECURE_AUTH_KEY',  'A7~12N{Ma5+4ps/7XQ~`Kz-IEq-H(|qO2dFQ+b=R[8yVrk;[Hg2P)L:gn3EjZ3W7');
define('LOGGED_IN_KEY',    '~b2pIZg)DeG,Xl=Q4x,?&^B[L: ^x~#aE-d(?=!T}G,-vW,H1ap+xZLJl`yA6;SX');
define('NONCE_KEY',        '$k!Wa-^oZNENq9_!ji:8j|Ez.mB+to~U-~(/+S4UHI[?wfZn7N}8jM%pwnsB;i-l');
define('AUTH_SALT',        'EdSy26*&1|-D&u@T$2]!X?Q@a}T7Ib{ANkm!A5$G|LaA08h_]tq-[F5SZ@qWdlm<');
define('SECURE_AUTH_SALT', 'k]oPaAg*DQa,>nPBJ]7pQ;:`@<}$1FFibk1+x0|nK!UT;aDG^<QSqMe~sqL1|Du)');
define('LOGGED_IN_SALT',   '|#0Rrf`jXq1r8FA{j{|&yl4/BEdn--3M_9>P}GB4k|=S )+S4Zu:?x>Lu61kpvo-');
define('NONCE_SALT',       'Y*-E+tZt_={}B?a6l:]DtVtXf}-toV7$*~TC4ja/K0BtIs;j S>>1:H+Z.I(406u');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. By default, the Hebrew locale 
 * is used. To use another locale, a corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define ('WPLANG', 'he_IL');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
