<?php

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'musicsupervisorguide');

/** MySQL database username */
define('DB_USER', 'root'); //musicsupervisorg

/** MySQL database password */
define('DB_PASSWORD', ''); //20musicsuper14!

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
define('AUTH_KEY',         'b0,E|+9vmmXxJ4s#Vprg,{ZLX^z%B1rp-DG6e]7CbU:]9TKE1+B&vX+;T-V7@+x&');
define('SECURE_AUTH_KEY',  'JF,d0)<n>|YX _|,6cI=U[_xAD)ah1XGtpJUoFFy9V~k3x=^zc3[n+^-WD7!12kT');
define('LOGGED_IN_KEY',    '^Gi||O#0Rd+0&%k,DYB6;Be|^~jDH-NjwFrJ6Xzknn!GTj$nu 16whdR/ LK3YS+');
define('NONCE_KEY',        ' O|N,4C%Zpx.[H}hU!uU9McC; Dh@4:Ma,Y-jCE0z< o<uf>A=?qPD:#=%u-+ltV');
define('AUTH_SALT',        '%b%-`hO}B1=eM>TNH4K+5?U+|+AjEl#kZIWy:@2wO2%~[ZdgX5rcbxxfm(yxeA]<');
define('SECURE_AUTH_SALT', 'X}cGbhmkw(zad5r2l^,N@K$Rh>~3k`S)XQd$j$S{6JyO*1gus%(Uf1Sq}9R[k3X]');
define('LOGGED_IN_SALT',   'bk%|o;YGUCqrk<[Z|=/=cTXPpzp%kYUD]<^~aKg0PXN&?#*]>wQlG(K$6 iPhY`0');
define('NONCE_SALT',       'K7i}+95=ugH)H*Mugm+<?T GMG/Lgex7B+sg^+0}|9C_jc>7``unS<0M$}@@KDJ~');

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
define('WP_DEBUG', false);
define('FS_METHOD','direct');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
