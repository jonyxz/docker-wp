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
define( 'DB_NAME', 'wordpress_dp' );

/** Database username */
define( 'DB_USER', 'wordpress_user' );

/** Database password */
define( 'DB_PASSWORD', 'sandi_wordpress' );

/** Database hostname */
define( 'DB_HOST', 'mysql' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'k5N9f*RdwP2.&>u~M<pWeZ=km_EWnwCX5vb<zcH[}QZ<p|[jNEg1hU:Qzi_]_6>{' );
define( 'SECURE_AUTH_KEY',  'b?.b^ziu|Q!8]ZDyD?nrn vPA|rW{O@-m[^JS)OvW57a@<4/(R}+p/($K*EV2<Z(' );
define( 'LOGGED_IN_KEY',    'nicC~Q`+4w4,zCm/`:jn9fI0q*l%>V6EO-[nM?X !iC&AYMBiImwqBl|DpdpFr].' );
define( 'NONCE_KEY',        'I|PTrUQXwiK4pml8?6|xy/.Pv`8_[o!8F*Iw9BPk%h`naQ4X} ND0/V%mYfpSvU-' );
define( 'AUTH_SALT',        'xu=u/7ijiQ@`^E.(.Wf%$RW{7?YyJ`:wHgVwn#kvYeqg_f?IXOO!RA<TR  %h8P@' );
define( 'SECURE_AUTH_SALT', '-EF+[bewi2brRrL??$}CM.2t*+K5r1lEst/-hQ[y0g V_FE+]X8iR691^lJu]}1 ' );
define( 'LOGGED_IN_SALT',   '%Bj@: #2(?N42Ps#wLn13e2v;ztKqj{n)2P+,O1}%3-R/Yu^I^jOUfiNr<]#<V%l' );
define( 'NONCE_SALT',       '*[4xz!i^=>GNQY~Rh]eN#>VKS^Oe2R_rpSB*1`[)JPDw1j;<5?<g%]*A@)/wNZgy' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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

/* Add any custom values between this line and the "stop editing" line. */

define('FS_METHOD', 'direct');

define( 'WP_REDIS_HOST', 'redis-server' );
define( 'WP_REDIS_PORT', 6379 );
define( 'WP_REDIS_PREFIX', 'dolanan' );
define( 'WP_REDIS_DATABASE', 0 ); // 0-15
define( 'WP_REDIS_TIMEOUT', 1 );
define( 'WP_REDIS_READ_TIMEOUT', 1 );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
