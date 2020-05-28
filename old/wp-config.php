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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/ozgun/public_html/old/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'ozgun_wp381');

/** MySQL database username */
define('DB_USER', 'ozgun_wp381');

/** MySQL database password */
define('DB_PASSWORD', '364Pb)Se)8');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'siqhlxvzyaww9nisfis6gpot0gdeu3wmb8xtdjvbogfolbg7i33jdsqd8zkgdoga');
define('SECURE_AUTH_KEY',  'gdtn9c4qvl1vawxvr1xakxrjsilngjxx7dv8qtuet4mm9dw4qhaygjssg3tx4lui');
define('LOGGED_IN_KEY',    'ndjbcoeoiaxpgiucrcb2gh3koadpmrnp6e1is59r6g5op2vvupps2wnodpowpgot');
define('NONCE_KEY',        'xyp5hmgorrk9yrdel702rwlclhfs4lcesnykufooytfwzjs8affytu9hrzww8ezt');
define('AUTH_SALT',        '6lwlzvbeuw0nlnauakdklbjvnq8h1d0bbqifj5rm7dpfwhywgp9ilq4zmpvbnrob');
define('SECURE_AUTH_SALT', 'fuc0ggr4inbo7tbsotlf3pj1nb9cdcpt5rhtt7fq4znlbjv3xlsmq7s6lfgaxbzt');
define('LOGGED_IN_SALT',   'd7lstdstdwbavqp5ld5votdh2kgiplgpl667ljvusi1r9itphnx0cbxz7znha01e');
define('NONCE_SALT',       '7bfkmjrrkkl9ynjlqwglpavmn93svurhdske7lexfegfhuiborc3efcg4kcczkgg');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp5l_';

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
