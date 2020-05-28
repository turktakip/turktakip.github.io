<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ozgun_new');

/** MySQL database username */
define('DB_USER', 'ozgun_new');

/** MySQL database password */
define('DB_PASSWORD', 'turk002581');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'ypio9xkmst1fiszour0cyoahwta1tck977wcosf0tbfktutekkxm6rpazs82kch8');
define('SECURE_AUTH_KEY',  '004xoh3j27fzqnmozrsif40icfuohxxolgb4tzktsxh6ehebsuwjusrnhqlnh2je');
define('LOGGED_IN_KEY',    'lfhpijf8qxtchsffo0rafwiabfrcmnsrtpdghbxzezjetvewscee0ap0odw7qde0');
define('NONCE_KEY',        'nsl08cwjmfncucsetcme2izgcp5chin7gto00yvqduedud4zm3bcxvtrgzbfb2bo');
define('AUTH_SALT',        'xtwx90y9ushcvybdeb5r4xof01svwawyn4h7xtawmwzf9vdq7ygfekhziscar23k');
define('SECURE_AUTH_SALT', 'gy7qicqb3g5iojtufhtpzcnuprqvhwthjprumqe6fsp1zruqvnbb2u6sd7ujrinp');
define('LOGGED_IN_SALT',   'mvg1p9zn1bepelcm1p9coibok3ep02pwgzwoqfliyhzm7deprgeoqzjzeiisoyid');
define('NONCE_SALT',       'fqvjiacfaryitfmcsi1swbesl2dyf3sh5e2tsvqvyjntx97rnxizhbzi1zukrmdl');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpm4_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
