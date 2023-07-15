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
define( 'DB_NAME', 'sizhen' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'E2+`o]F7MypkHd@wYB/bliT#e!>3$U4z6MmJ#%dm,1hBb]s}UrYnm8~^G v#Mg>;' );
define( 'SECURE_AUTH_KEY',  '-!I{&$bSQ`F>ICIgyI`+>?v7%x&}#?0-oz5HsoYWH%[0~oK<:Ru^}gtANr9wn?Dl' );
define( 'LOGGED_IN_KEY',    'oA&{NQqi>Y%X,z)DN}|v4_8=b2V!r Im8j+[#8!P_/<zVpbDFwWE0%OnO(opSWU0' );
define( 'NONCE_KEY',        '~7F*$eAIiRoRlxaLYUqvd_:xj] 8b`ks7tZt^68Sr|$YJJxKF48!g8[T I%}Y4Zk' );
define( 'AUTH_SALT',        '(<wu|*GT#=zIGE:n>iN>E8A9ZjyG9;SW8,Fg|y4/DZDVDC+PU[{*g8o:s+YSHZQ.' );
define( 'SECURE_AUTH_SALT', 'hp4Z0r&50GC]p%fz*oKL*,kfhUY*%ydvyTz.X`}oB)f>]~!04K]n>+!%6+?HO@fY' );
define( 'LOGGED_IN_SALT',   'P=j!;#aq62 $EZ(s d_,9S]J@=D_UOrtH5rkr=rxUd>B/tf~*9oY4psjCv7tzI8L' );
define( 'NONCE_SALT',       'gAd9PhV=CN<{u?TI7;2vOjq^anw;W,S.be#-lL>RYv0G@Bhy/fkYEGrDG,VK^h9x' );

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
