<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_genixdb' );

/** Database username */
define( 'DB_USER', 'god' );

/** Database password */
define( 'DB_PASSWORD', 'stROnG4evEr69' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '-S4q:01 9Q&ghvL)4_O #tlX-0;7I!Wt?_j&@z@gRP4MEM`i](Z63~NlXZ|,{]^*' );
define( 'SECURE_AUTH_KEY',  '?$~uOw4~SY=fh}VgM5/*<dJz<;`!>)+_*dZ6~?p(:[F7:DCT)&|4+U2gSU[D{<%J' );
define( 'LOGGED_IN_KEY',    'y{DZU!f@>.J&}=|2IsC _^Q5zeFAmq)|2jPw5`8?7P)*1PV^gu6HF(L_=.Q?:AZ9' );
define( 'NONCE_KEY',        '#,;`z_gmui0qnM]u&KfM%CY+I*;KEaP3cnB(EO(IqTLoe.iE+X2E3o2we-c%K5JT' );
define( 'AUTH_SALT',        '!coXtS&8l*5m+(u-58c7G;nXUU9!S4(.f>YG]CW~bRFh&nr-Y5w49Q&Sv)+5Xge2' );
define( 'SECURE_AUTH_SALT', 'qC:;gS7]h,z=F!3__uKj+={K^*9]SDzD`/0~_k_y.QhS5onYtnssudb7VH^*s{Cm' );
define( 'LOGGED_IN_SALT',   'rY7+Sb;;L5RvKE0cnuIm;2,4s,=I<>fZj38CdZCrzVk3IeS+UueRfM|UOB7XT1o>' );
define( 'NONCE_SALT',       'Lh5ls;V[F%./OhYj;HJA}c.{M|1y+,l1k0P,!IlxSaz2cR&x8X~Hqfpe8:Ti<tM*' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
