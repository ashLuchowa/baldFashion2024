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
define( 'DB_NAME', 'baldfashion2024' );

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
define( 'AUTH_KEY',         'YZT{UiBT%B~+Y[lBg^j`i%RHF3wpdNxZ=8>M>Hj,[A9R`L=Wc8k)1|ssX2SSnqS&' );
define( 'SECURE_AUTH_KEY',  '+dE.?o[2em5!X`U=TUqdjA~,Xr=>=9qz3KKV*T&EoxgduZ HvCF,<;hq&<Km^H`5' );
define( 'LOGGED_IN_KEY',    'x$`V]S}K]mrFZjj%b8~B!!1f6Qs;27PJ 9Sbb=!&}mIl4o) `&a#@Pb=LU4_^!v/' );
define( 'NONCE_KEY',        'P1wH.&|@TAJm}RHlWrr0Yx@{m/:D%|CY!s,%@Zh6O=SB}y!i*@*ZqDWsLgko[?,z' );
define( 'AUTH_SALT',        'tYI-bS#zMWkj~FVvKZ(~R_^(rIcZvZ?,+YGToa_q~omI]8(Vw,C725^3r`<B`Y9-' );
define( 'SECURE_AUTH_SALT', 'KN7no(&<2}!0*nu5L5qvsN>2EkeBmzC~~ZPy%*rl?nfOmuJd9N,LQ;pYQjp~}mAD' );
define( 'LOGGED_IN_SALT',   'LaZ62)@MMj_;BI}<6YqVI+#QhQ<fc;G 5YVu}d.BT!2M+QR@ZwAbZEHHvy~X!P.s' );
define( 'NONCE_SALT',       'r(D/wKH^9GXau!q|RrbVmI++(YNhih_ArkBHMO6J)qqEy6sYba5}RHb2]eok.v@/' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
