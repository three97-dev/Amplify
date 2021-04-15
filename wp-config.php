<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
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
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home2/ampligd4/public_html/test/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'ampligd4_WP_prod' );

/** MySQL database username */
define( 'DB_USER', '' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'sT5>CjtVnp+uCQhK@0 vEZUA=|b[-)Jf2[v^xW[V<ovmq.AH7u&mB Ur$Fn^|{uP' );
define( 'SECURE_AUTH_KEY',  'Jb0I}NVrJ3*dRAAG+8ZY9Xrs!mO>25=Ofbe/Jgv pJ[KrDt9vkj-#gJ>@LoQy`*D' );
define( 'LOGGED_IN_KEY',    'uGG8w#M%z(69?4m:Kb]VigM7,;~v A#t2V]UZ4gPyu#$!=|p#IF*n):Pf$El]bb#' );
define( 'NONCE_KEY',        'D+kzd%fj2@a5#*{1=1C3HT5Q(dceo:je|$0xWJv[Tg3c10NUu53pQsf78P)fLy^S' );
define( 'AUTH_SALT',        '0USX/U%B$mzVQ,pOchjz#pDA[B4]pRgl|X:)GgH1p`9vPUKf9(NM(wy`zn0@kG6w' );
define( 'SECURE_AUTH_SALT', '~hs dE{Ur;EIk_)]LDQOdD~-+E6zM`Y*|VqURWzg}Npu%JZzD0i%Bed>24lX72k3' );
define( 'LOGGED_IN_SALT',   'j#:?T?`TrBS{*pay/~czN?f6bcX=YV*w%D(%j>a>x6<p4P@m)H{A-oDU([`KW+HL' );
define( 'NONCE_SALT',       '#F8 UXNQ4|*-V`n@(9Kr*/<R>N m2)RG5f0]D~`nr@X~T45|.x{DFcPO)p`m/PMx' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
