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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'karya' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'I!A}~NUL;k%GIpc&_8ISl+26WN>3wlGp=@{n&{>9Z<gRWaX`uxlh8q72%O[T,s#`' );
define( 'SECURE_AUTH_KEY',  '[bo?DTV}qo<y6y9$S9vb4rr9?#{RYf;Juddps3{mDP!},q_5Qer`Yq&FCZI`{,%5' );
define( 'LOGGED_IN_KEY',    ';>bJVv$*Rm&G>~fj#@Rd@1Cv8Od;o/W%;RU/J^MMnsDZ~!cpK,xm/fG{Gsh.;u=K' );
define( 'NONCE_KEY',        '|U0T1>,_Pxy; uZmj=SU]EDKI{{Lx+Dw3A@Q [EOeX#Z^#=6?=Me,{J5_Q/,Kk|<' );
define( 'AUTH_SALT',        ']9*&t[J|=SJhn~)ZF2~Q?Y_KLh2_lj7Ez`Rd(ZlTI/8iB62>+OMXP;!V.T[.@cnQ' );
define( 'SECURE_AUTH_SALT', '+K><j,owqQjU*8^5;aA1=mbY^SDFc,J~%Mzt-r)_kjyGcl@Ck(&rr_6(-Qexax;M' );
define( 'LOGGED_IN_SALT',   'f[4P,&<Hns&&i=1K`9e6ChcJuqhu.BTu+H8&U>[4&m;5%e-$rr[CJ%_q+81!1c03' );
define( 'NONCE_SALT',       'H/CebbI:U(.S.j9#$8cs`>&5Y27lb 7i{+0,rUxEc5k+w@St],^iA55|3Dem?vZ#' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
