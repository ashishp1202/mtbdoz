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
define('REVISR_WORK_TREE', '/home1/ridetour4u/public_html/'); // Added by Revisr
define('REVISR_GIT_PATH', ''); // Added by Revisr
define('DB_NAME', 'ridetour_mtbdozdb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'm_mZ_qwdwAfIM lYW#WZ.7}MtC@xHM*z-SLWP;{_#6YkA8O}7>^p|Jv:xa*!HypQ');
define('SECURE_AUTH_KEY',  'P?Q>YagOSm]_seYmGt(#h`8&8iE_&Oia}*4 [XzR$4N3@A`L.cCX}QF9|mS2%:<A');
define('LOGGED_IN_KEY',    'f.grgGeff_yehky7 A[P=fm.Gl.y(VE?wYjSWZ}e)HB3]W%~SoDOQ02_R,GZ#Qk:');
define('NONCE_KEY',        'a>>s)O?73jRIBJ8QDx5 Q4&f;V0@WiN2*gAlX8)I~ztq3!}%_L([@H}#R1MRb+] ');
define('AUTH_SALT',        '+[n@Y8!Bo*rNAuAL~aM0:q>+W<I/#Ph/I|A.C{L|W`x~oFgcpG^$_%<~/c7!s=J=');
define('SECURE_AUTH_SALT', '9|,Cd#=eh}+ rp.fJAbo}#`mM0[GA1UY`{>jYAAt/%ovgcaKBrDEf&%fclm>p3z^');
define('LOGGED_IN_SALT',   'F}U:-C(5M8MrGgn@hY&#Y@]uw2mAHa?uGxrAI67QWCUcAEg#|:~;B=Yhj5UCm[!{');
define('NONCE_SALT',       'Kk)5-Y$5#tNeba*#c7v<LpO9aD08,6gOhlSIUNBxO{-mof7r>Tvii@k1)=Kdg=~6');

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
//define('WP_DEBUG', false);

ini_set('log_errors','On');
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
