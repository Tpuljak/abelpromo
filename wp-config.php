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
define( 'DB_NAME', 'snap_products' );

/** MySQL database username */
define( 'DB_USER', 'snapUser' );

/** MySQL database password */
define( 'DB_PASSWORD', 'test1234' );

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
define( 'AUTH_KEY',         '3F9K`Y[jb*DC^i|wgu_Z+*B6YK;~XIXhw%+PjKHMi5kcLWJY;p0gIB*t~m0j:+Th' );
define( 'SECURE_AUTH_KEY',  'rqhjnt.+,]UxpNYryZl5&=pP)q5yjyM;D@C BUpke f}nP>-i;BpQWe;<WdkOD{p' );
define( 'LOGGED_IN_KEY',    'iKz8/H_@x xK$*f6z/>spHpP8{KO}{TeM)vRrp:d%7G-]T}(kb@!)cjU5$g}^/SF' );
define( 'NONCE_KEY',        'KjsW4*0FQgr--JdYG?jZm~;_PcRB:j7IqT&kKZZ+,tmR2G!--/bCHh*u[T^-^XOF' );
define( 'AUTH_SALT',        'oQw!_&7`U-s*&Nq`5TAGrhTVfz$h]vvz?$:Yhz7M> 9-U=4NME;,_VpgE4-!O&?v' );
define( 'SECURE_AUTH_SALT', 'NF]U%(>>=LZP.x~3woH,]92{$v`! VjrhK5dc?R`5pQjNroE?Q.n@wV,|pLW83Ff' );
define( 'LOGGED_IN_SALT',   'd>fDN2?z2}E-waV@$:kx4l*{Y_dk;G::K,{KK*r=$Q{3GCVKnA`*OKtcG&z.QFwN' );
define( 'NONCE_SALT',       '3fCag:|JkiM?1CH)Be!Nfftaa?3|SCF&Dam4Z:jWCrNra1?g?7WHgpRc:g-$y;Dp' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
