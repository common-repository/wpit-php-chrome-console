<?php
/*

Plugin Name: WPIT PHP Chrome Console
Plugin URI: http://www.wordpress-it.it
Description: A simple plugin to send data to Google Chrome Console. Based on the ChromePhp class (https://github.com/ccampbell/chromephp) by Craig Campbell(http://www.craigiam.com/). You have to install ChromePHP extension(https://chrome.google.com/webstore/detail/noaneddfkdjfnfdakjjmocngnfkfehhd) on Chrome to have this plugin to work.
Version: 0.1beta
Author: Stefano Aglietti
Author URI: http://www.wordpress-it.it
License: GPL2
Last change: 03.12.2011

	Copyright 2011  WordPress Italy  (email : info@wordpress-it.it)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

include (dirname(__FILE__) . '\inc\ChromePhp.php');

add_action ('init', 'wpit_php_init_debug_console');

function wpit_php_init_debug_console() {

	if ( current_user_can('manage_options') ) {
    	define ("ALLOW_DEBUG", 1);

		add_action('wp_head', 'wpit_php_buffer_start');
		add_action('wp_footer', 'wpit_php_buffer_end');

		$GLOBALS['timers'] = array();

		error_reporting(E_ALL);
ini_set('display_errors', '1');

	} else {
		define ("ALLOW_DEBUG", 0);
	}
}

function wpit_php_buffer_start() {

	ob_start();

}

function wpit_php_buffer_end() {

	ob_end_flush();

}


function &_wpit_php_get_object() {

	static $phpdebug;

	if ( is_null($phpdebug) && ALLOW_DEBUG ) {

		$phpdebug = ChromePhp::getInstance();
		$phpdebug->useFile(WP_CONTENT_DIR, WP_CONTENT_URL);

	}

	return $phpdebug;

}

function wpit_cons_log( $msg = '' ) {

	if ( ALLOW_DEBUG && $msg ) {
		$wpit_console = _wpit_php_get_object();
		return $wpit_console->log( $msg );
	}

	return;
}

function wpit_cons_var ( $msg = '', $var = '' ) {

	if ( ALLOW_DEBUG && $var ) {
		$wpit_console = _wpit_php_get_object();
		return $wpit_console->log( $msg, $var);
	}

	return;
}

function wpit_cons_info ( $msg = '', $var = '' ) {

	if ( ALLOW_DEBUG && $msg ) {
		$wpit_console = _wpit_php_get_object();
		return $wpit_console->info( $msg, $var);
	}

	return;
}

function wpit_cons_warn ( $msg = '', $var = '' ) {

	if ( ALLOW_DEBUG && $msg ) {
		$wpit_console = _wpit_php_get_object();
		return $wpit_console->warn( $msg, $var);
	}

	return;
}

function wpit_cons_error ( $msg = '', $var = '' ) {

	if ( ALLOW_DEBUG  && $msg ) {
		$wpit_console = _wpit_php_get_object();
		return $wpit_console->error( $msg, $var);
	}

	return;
}


function wpit_cons_start_timer( $timer_name = null ) {

	if ( ALLOW_DEBUG && $timer_name ) {
		$wpit_console = _wpit_php_get_object();
		$GLOBALS['timers'][$timer_name]['start'] = microtime( true );
		return $wpit_console->log( 'Avviato il timer ' . $timer_name );
	}

	return;
}

function wpit_cons_stop_timer( $timer_name = null, $forced = false ) {

	$warning = '';

	if ( ALLOW_DEBUG && $timer_name && $GLOBALS['timers'][$timer_name]['start'] ) {
		if ( $forced ) {
			$warning = '(forced) ';
		}

		$wpit_console = _wpit_php_get_object();
		$GLOBALS['timers'][$timer_name]['stop'] = microtime( true );
		return $wpit_console->log( 'Fermato il timer ' . $warning . $timer_name );

	}

	return;
}

function wpit_cons_get_timer( $timer_name = null ) {

	if ( ALLOW_DEBUG && $timer_name && $GLOBALS['timers'][$timer_name]['start'] ) {
		$wpit_console = _wpit_php_get_object();

		if ( ! @$GLOBALS['timers'][$timer_name]['stop'] ) {
			wpit_cons_stop_timer( $timer_name, true );
		}

		$GLOBALS['timers'][$timer_name]['time'] = round ( $GLOBALS['timers'][$timer_name]['stop'] - $GLOBALS['timers'][$timer_name]['start'], 5);
		return wpit_cons_var( 'Tempo di esecuzione di ' . $timer_name, $GLOBALS['timers'][$timer_name]['time'] );
	}

	return;
}

function wpit_cons_group( $msg = '' ) {

	if ( ALLOW_DEBUG && $msg ) {
		$wpit_console = _wpit_php_get_object();
		return $wpit_console->group( $msg );
	}

	return;
}

function wpit_cons_group_collapsed(  $msg = '' ) {

	if ( ALLOW_DEBUG && $msg ) {
		$wpit_console = _wpit_php_get_object();
		return $wpit_console->groupCollapsed( $msg );
	}

	return;
}

function wpit_cons_group_end(  $msg = '' ) {

	if ( ALLOW_DEBUG && $msg ) {
		$wpit_console = _wpit_php_get_object();
		return $wpit_console->groupEnd( $msg );
	}

	return;
}

