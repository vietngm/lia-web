<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'liaspeed');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost:8889');

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '#dQoGYM(@C(j1R1)AmY7RcYP~11bI03Dktk@*p;$0YR=-)//W6(}<qQYoT9B|H[,' );
define( 'SECURE_AUTH_KEY',  'H#&fJUb:?&hQgcg0`>j4T}`h5UJGVw#7TS[ I:SR-~t@k0r0z)6di@_b.}Y|.I%B' );
define( 'LOGGED_IN_KEY',    '}.Yj@Pu{;xzwb$DL}dEdrc jD7)NYZ|.;)!jwZ48 [Kh)^Tn,Co^z_q1}g2>ss5~' );
define( 'NONCE_KEY',        ']iAgwmg|EGdGQZwGb;IqEb,6p;(}qlh,1&GcPHP__pOAUd-LeszV-+F,X8J+>t%l' );
define( 'AUTH_SALT',        '-q=q9+Galu3EZ0hrmj0p*n>/3^_0[SWkK6b+;x:h2JhUvX],1`a:z8GWo=bf5{4c' );
define( 'SECURE_AUTH_SALT', ';ly9{C2>#QCFI,^T+{=RZ#a{QJ;+(;9WOH#)iGrt0x+Vf_=RY?`zHmoOF+F&i eS' );
define( 'LOGGED_IN_SALT',   'hM-d/2Oah&|p?s!*oxsa*^xr^y)JC(c{}6yrr3xRUjP!78-YJ/O=N[9p@n~x-O`:' );
define( 'NONCE_SALT',       '9|L:[{dt~#sAsYx~5jyF7Hc8ssuG48zn9#)rO=a0U-lj@3&%spoyt<OcvRX=C[T7' );

/**#@-*/
// define( 'WP_HOME', 'http://localhost:10009/' );
// define( 'WP_SITEURL', 'http://localhost:10009/' );
/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'tbc_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );
// define( 'WP_DEBUG_LOG', true );

/* Add any custom values between this line and the "stop editing" line. */

define('DB_CHARSET', 'utf8mb4');

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';