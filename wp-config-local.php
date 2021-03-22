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
define( 'DB_NAME', 'digityze_TRV' );

/** MySQL database username */
define( 'DB_USER', 'digityze_TRV' );

/** MySQL database password */
define( 'DB_PASSWORD', 'pccfIJZbmE' );

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
define( 'AUTH_KEY',         'jLY/F:b*m*@zdm>Q|MC;txu|dI%QI-%zjN,MG+ay1ImogPS[=~chS*X:fNrq3(Ph' );
define( 'SECURE_AUTH_KEY',  'oIt=d`R1}85V(+{w$&X&+Gs2YAQL4I?HqiLb~MIvwy#1o4M({.{Jd)8%7.<]EiOt' );
define( 'LOGGED_IN_KEY',    'j%r)MKii_b0dvWoTM!$<E`,9?W?|bio*;]c[]vE`NWly0JE!`{o>EtXua4_dcR=Z' );
define( 'NONCE_KEY',        'm)V_1UiAQ8:=:PN7GcxM3)]ttAKLeSd|Ai:}[4TgRzP$m}*4iZtL:i)`2.C ;3?:' );
define( 'AUTH_SALT',        ':PUaH4d;zPH}qAV!?NmS6pTJJr#5L7!N2tEF-%58-I$z.eKU=WHutvP.~v =M7w^' );
define( 'SECURE_AUTH_SALT', '4, < E7|x%}Dp8?}}@OwCu%T1lYB~8>e_yGq38$I_c7jcc3obN [5Il)g/9f-%y}' );
define( 'LOGGED_IN_SALT',   '<[d[L0QR~PnS5U9_1Jyo(czj@M1=6KL|:!HybSDu?>w(V`7|l^cp[sN4ZoGOB|B2' );
define( 'NONCE_SALT',       '!*0mLVXKd{)OhZN92RVE.KRwEL=|BAoBNcWCL^>mr-M0k>BL_RmX.9&!6$g9%!<4' );

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
