<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'cnxwpdb');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'root');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'w#+21cDTn+5wBSZX`+68I_RDK_QM.:CV%o=q8mf}~R7@@)?IC,* LJ8711TR5;7$'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', '>dSw>NH3MJ.&3ID].R&-!jAi{S-47F+G^ SQ24fv#jL0iQw@< KyI7V3 Yk2}IR '); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', '|e:mvkT^? ({9B;u^<L/8{9,YpHxn5MFov fs}V|5]$uz|1kt:q=$fNy;hl|:=l:'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', 'MB@h)Xeqsw^cm 1&EDV0x6H~dA]vVa=,$L~R>=`}:Zlh5aKDbC<rr0P&&?{[@&+k'); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', 'K-UIVgzlTV$U|uiVF.vb1CIhM](00=(mjt72)w2M6iq_D=7S(H1cxrR4j-A34Lqo'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', '~v086T95CNA]nooSz.+`8FR.+X-|Q22Wbyb.o(YTn8A0Q6`]75CdU+|&|`3R 6.n'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', 'wbZzdg74+h?E{:s(Hg|X8Ha?0*(0T|I%Wky(9Z4I`ps2OejRUL&{/D707^j~l##!'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', '1<r-*1|!_59-gz?GTbF*-/6MOLsIS{mH9u@/ZjR7K)i@os*|D7Ho}hk=)vs&kb05'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiándolo a wp-content/languages y define WPLANG como 'ca_ES'
 * para traducir WordPress al catalán.
 */
define('WPLANG', 'es_ES');

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

