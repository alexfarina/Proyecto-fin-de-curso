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
define( 'DB_NAME', 'sobre_ruedas' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         ':TOM@fU`8.N<al2!vtwxV].|R]cQ$7=;ec|cx*e.#D|]M&L:UO:O#Ahv}xILdNc[');
define('SECURE_AUTH_KEY',  'zqC-?fG@p%p4^CuuHGg~hRnH&Mmd)g?U8!{;^Dh#/.rOCdHW95}M I!{|+_v*#UQ');
define('LOGGED_IN_KEY',    'mQEx6_T-[+<otFL9sd(s)mm;7-)g.LlP.3(_tf>2N(Ws`$t?7ExR x0]h?)W]3h5');
define('NONCE_KEY',        'E3J:(W|ri2S-/Xkw)M|n{DLKPow}UTq)quT0!B[h:<^+4x9rUm3=.A+&>E0/I#q*');
define('AUTH_SALT',        'brID[fM<|hS0,]O)yp-{jmT++`6C5>M;E$06-|KX]d,r`QU o(^vVyr36BJ?`!e1');
define('SECURE_AUTH_SALT', '+/pzUIKKw5ajK2f$izzk6^+[?&AYYUVoBCFetmaPxwF};fpF; (2Lbe?.vrlko+Z');
define('LOGGED_IN_SALT',   '5]2chm[{Lc(U0%9Awq|,/E-dyjKS#/[;IkXe0a-4>0Ar^|X6_Kz9]jK5q7j6V)?E');
define('NONCE_SALT',       'H5S+:&P3$jp>d}90Ba ,VNQJEB%g%?rl%i(4~y4i+;^J=7!o<h36,p}I:<%WVS-f');

/**#@-*/

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
