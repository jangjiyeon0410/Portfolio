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
define('DB_NAME', 'jiyeonjang');

/** MySQL database username */
define('DB_USER', 'jiyeonjang');

/** MySQL database password */
define('DB_PASSWORD', 'qweasd123!');

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
define('AUTH_KEY',         'qD)CbWYzEoFLW; ^jdvF60[B-#4,W2Ab!-nSUq0am4n;8!j]%F}0V)4c/>J$&Hgb');
define('SECURE_AUTH_KEY',  '30f]E&)pUFZTJdXJiecdOF8e.L:d3&nrDnN;/Rq4bGkS|VriCg]V>%P/Z3*3=+}~');
define('LOGGED_IN_KEY',    'X@xjKG1;.UERS]h(QbbV}9}88jwz|qf|p#+%% OVB -Rq=reBVUrPi-wX&z|E`29');
define('NONCE_KEY',        'W&`qbK$OChd6ri#I^Lh|K#}{x$C&1dSP0Xg/&Yo(U|(|Jc2fwC}oQy-FHaPuN[c.');
define('AUTH_SALT',        '#;da>9.8s;WCW:V~Md}W018aV0*I>4@KVR^t5/PW1jb?WG].WXP~zYvfWo/E}y2A');
define('SECURE_AUTH_SALT', 'mcSE%5hqmudL)uT.R4tURE-c{HKM/)U7T13tOHP)D aZNanb #Y*UhH#N@TS*I)<');
define('LOGGED_IN_SALT',   'qqV^K=q:!>!s8AQt-a#fB0#{0&@)bFRYRt241LP,rxzS]gm.9px+d:)[&>!.f$8p');
define('NONCE_SALT',       '9ec6uz$UJ;tw&X0L{TEok9hRw$u?I-F=@Jd*://.o=.=%<y@@D^*;M0(KP/57]uJ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
