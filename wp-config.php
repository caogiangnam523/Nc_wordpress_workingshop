<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'byconsol_6003');

/** MySQL database username */
define('DB_USER', 'byconsol_6003');

/** MySQL database password */
define('DB_PASSWORD', 'abcd6003');

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
define('AUTH_KEY',         'l#5-^9|qOW+1>[F,!K?NiMWB@NM_/BwXZ|</Tly svdl3RI|2M=viii-c*_ ).tJ');
define('SECURE_AUTH_KEY',  '$*7.-+z8C%%FfXX_;~>g)t-Xd(y+cR,yu&tFgI4[=mxJW6X^#CSY2e.#k F4P$m:');
define('LOGGED_IN_KEY',    '3oXOr,f^gnFmulr+-$bDGd!-g?dnESid|]+/Gd)cAm!$+xc]jA0+|=|N-?4BKa,3');
define('NONCE_KEY',        'QNCutd&g*y4JDL|q4iI+0MVs/4bUnw8zRn;$pww;-X`gl0Qvb}!B2dp{IsV{.WUb');
define('AUTH_SALT',        ' k)$QiQRb<_a7?|l=x|p0F6a8H:AVQeJnc`_o!%)939s_%V`-[nuZ(HZd9DL|P,$');
define('SECURE_AUTH_SALT', 'XN5%dmZ-h]&HY/Jr%-pck-BM-vU-!pYXdnz,M-w,Kc||XD)fizW6JNnPDDl.=D8D');
define('LOGGED_IN_SALT',   'b~k@E3ACdn(+:<9a5-sb@# uBUw+0zyC|QRc5&erWUG[4LL&wN?bhB*4$C(PUCBr');
define('NONCE_SALT',       '>Yz3jpg!niAlf_-XU{yc{ILZg21B/sfDG{ybw4TABsc^vQ6:bI*}*Bc/MB*bM-M.');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_baguettedurompoint';

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
