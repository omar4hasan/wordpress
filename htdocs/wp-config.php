<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bitnami_wordpress');

/** MySQL database username */
define('DB_USER', 'bn_wordpress');

/** MySQL database password */
define('DB_PASSWORD', '9cbe69a4b0');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

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
define('AUTH_KEY',         'edb4be6d3cb3c1d19182cb748e4aae1c118896f044e140940b00a1fb6a6afa54');
define('SECURE_AUTH_KEY',  '1638d31fb0551b23f7b1e1f300dbc461856cf6384581a8e029351a1810ce7e51');
define('LOGGED_IN_KEY',    '49faff10205c3daf5b785c5ce6b6134bacacd337e48f79874ad94b6d62d175ff');
define('NONCE_KEY',        '194fa300fe9dde9f3da7596ab3b2b9cbe57daa47d4b252af818ba4c3606a97ce');
define('AUTH_SALT',        'd2d65b5dde6c8d12a8a1b69d91f9e40b6ff3c919a4fa069e73107ea5b95e2eb0');
define('SECURE_AUTH_SALT', '5fed47c881d16b755fb303dfa898a799fcd0b3e256de95eda1023040316b066a');
define('LOGGED_IN_SALT',   'ed144ca7ebfb97560754dfb998161622794a3e62d6f47f0319a2f37cece0cb89');
define('NONCE_SALT',       '34af8ddb97701ead57105fe184678db531f07490d78d60ef4c23c205ac7d04da');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
*/

define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');


/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_TEMP_DIR', 'D:/XAMMP/apps/wordpress/tmp');

