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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         ' ?kF$Ho,K(k8uXeN/{{ <r/t?-pEltUfMU~X-DaCSms#w0Xx%N;QphBD3.HF{Pxf' );
define( 'SECURE_AUTH_KEY',  '5m;sDiX3j-O=M7JG)69DSlg$^g@{(o# NDkBX)n6XS>hLXRk[WN2~d+ej5B}o,V_' );
define( 'LOGGED_IN_KEY',    '~tOcx9F:07Ms|D5$Uo&mZrJd@L:cD1ENdil,.T;>jKE,#<w-Z@gV(iDrb1z_T9Wc' );
define( 'NONCE_KEY',        'kpGJII,@sG (lXhKv;s|Co$Mh`,Y#FM^tO(Bz[vO5T=RJhe V_wvE`$.>;a7GRlp' );
define( 'AUTH_SALT',        '@.m*8xb]EnGK0yx?QKP<#7XWaMXHI[~>cn~Ks,<vQ*VLn5s0Jie^|WHB%V^g5y)C' );
define( 'SECURE_AUTH_SALT', 'x,7#IZ2{GfiK{%()aP=@#>TyM$//;~KkNbtE|4Na29N@CiF`<V]x%8*I]/k$H-S0' );
define( 'LOGGED_IN_SALT',   '9wX8Cy)1kf{ah)kjd7dB%K!w82$.,WvB9qA+G:y/sp% OpFQ2owrGh;,:Vk@ SU0' );
define( 'NONCE_SALT',       'Pz2YNn^!V>J$)zAfUC[c}q~m<]$Q)!S@zDgF@*fw8/>.`)u6;5B%&,3SN(R(>=!=' );

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
