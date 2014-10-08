<?php

/**
 * Default initialization for the plugin:
 * - Registers the default textdomain.
 */
function epa_init() {
	$locale = apply_filters( 'plugin_locale', get_locale(), 'epa' );
	load_textdomain( 'epa', WP_LANG_DIR . '/epa/epa-' . $locale . '.mo' );
	load_plugin_textdomain( 'epa', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

/**
 * Activate the plugin
 */
function epa_activate() {
	// First load the init scripts in case any rewrite functionality is being loaded
	epa_init();

	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'epa_activate' );

/**
 * Deactivate the plugin
 * Uninstall routines should be in uninstall.php
 */
function epa_deactivate() {

}
register_deactivation_hook( __FILE__, 'epa_deactivate' );

// Wireup actions
add_action( 'init', 'epa_init' );

// Wireup filters

// Wireup shortcodes
