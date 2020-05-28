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
define( 'DB_NAME', 'ozgun_wp200' );

/** MySQL database username */
define( 'DB_USER', 'ozgun_wp200' );

/** MySQL database password */
define( 'DB_PASSWORD', '1X5(7p1S-o' );

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
define( 'AUTH_KEY',         'musgns8e0us9faa6eqmmamqutaetcfxeouduqvor3j0fflnqitobvd72gkzogae0' );
define( 'SECURE_AUTH_KEY',  'bn6clmd15gcehlduzuvrjn8u22bt3vvvmjcpxgfgttqp7mtvjth2d14wljmw7s6t' );
define( 'LOGGED_IN_KEY',    '1vphwo7gpumkx9ewjp5xafkyw4303uufhkkw1eytkihrmxlf7zgasixifetpnktt' );
define( 'NONCE_KEY',        'xto7s0ja3ihd6rqfvitzmj5b22jvxy5h0crpxqokob7vl6ysntqa1ahjd1nmebns' );
define( 'AUTH_SALT',        'ibfuxzvr9dsxdpaoeacqb7pk4exjw8svuv4hxnmfou4heyo6n9ay7hk0rj5zcztp' );
define( 'SECURE_AUTH_SALT', 'okfsdodmp8dg7hp9vc2s4vn9v0bjupkbbrtnzkriuezlyyubliojjssev7gsqlhe' );
define( 'LOGGED_IN_SALT',   'ntvxgn8tpyx69cjdh6lzyy0wzu9advrmunb34iupzkklxq6cns71giz6ksfwnx9r' );
define( 'NONCE_SALT',       'mhz8uco2bc0zuzxsunaw2lrixph1qumhdf6gxdytwmvbcta6mp32xzyoa24t0ac8' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpkg_';

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
