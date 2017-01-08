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
define('DB_NAME', 'blogmusicsupervisorguide');

/** MySQL database username */
define('DB_USER', 'musicsupervisorg');

/** MySQL database password */
define('DB_PASSWORD', '20musicsuper14!');

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
define('AUTH_KEY',         'B%dWHUV*irPu9/^/zS9]CzjRVF9_4J}~>]~w=x^}7/>+r8}T7Wu^1lLt.$K#N!5V');
define('SECURE_AUTH_KEY',  '-*RIQ(@#c.-x?mM*&PS(T1637!e>rspbgNJ?WI`IaCa|I1z|`_TUEXwqZD:S9/&$');
define('LOGGED_IN_KEY',    '@g3[ KghKsWjorKawLYIE4hAq2Ieyn[33;tv`*u4]cQh->m~|3+$/6_L2f!f6!P&');
define('NONCE_KEY',        'Xl2r?YUHTLLh|(g?rbg;|-BC}%rqT-e|UGQL@#N8*2&*zNr1bxWOs%beUr|cXI[`');
define('AUTH_SALT',        'ziM|M[W[aKU^o|ws1d3JRJ ZIO:-xu;T}5QxyF.dC&g5|.vmW,ED7+4Q5^}+Z@:}');
define('SECURE_AUTH_SALT', 'Pea/G{q.T|^iQ?KL+7)=ji.{&yN<0I$y<n<lrUYyAIEO#Wc2d(2Yr{m`Q|GPv.JB');
define('LOGGED_IN_SALT',   '$OLezMVWrfoMAMy/ *lS`o=BWo*$EKpr+Ab8Z>Oe23^0It*_v-Ig69`~%3bzs>:P');
define('NONCE_SALT',       'HIQGO.$B2R&+A4} S0+pKE;P#%;&[! +H H1+cid~Xn<`R~oz4Sfe+-$QkkhLuSS');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
