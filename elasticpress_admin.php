<?php
/**
 * Plugin Name: ElasticPress Admin
 * Plugin URI:  http://github.com/10up/ElasticPress-Admin
 * Description: Extend Elasticsearch coverage to replace Admin search.
 * Version:     0.1.0
 * Author:      Aaron Holbrook, 10up
 * Author URI:  http://10up.com
 * License:     GPLv2+
 * Text Domain: epa
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2014 Aaron Holbrook, 10up (email : info@10up.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using grunt-wp-plugin
 * Copyright (c) 2013 10up, LLC
 * https://github.com/10up/grunt-wp-plugin
 */

/**
 * This plugin requires ElasticPress
 * http://github.com/10up/ElasticPress
 *
 * Deactivate if ElasticPress is not running
 */
function epa_init() {
	if ( class_exists( 'EP_ElasticPress' ) ) {
		// Useful global constants
		define( 'EPA_VERSION', '0.1.0' );
		define( 'EPA_URL',     plugin_dir_url( __FILE__ ) );
		define( 'EPA_PATH',    dirname( __FILE__ ) . '/' );

		require_once( EPA_PATH . 'includes/epa-init.php' );
	} else {
		// ElasticPress was unable to be found, deactivate plugin


		add_action( 'admin_notice', function() {
			echo '<div class="updated"><p><strong>Plug-in name</strong> was folded into WordPress core in 3.5; the plug-in has been <strong>deactivated</strong>.</p></div>';
			if ( isset( $_GET['activate'] ) )
				unset( $_GET['activate'] );
		});

		add_action( 'admin_init', function() {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		});

	}
}
add_action( 'plugins_loaded', 'epa_init' );

//	if ( current_user_can( 'activate_plugins' ) ) {
//
//		add_action( 'admin_init', 'my_plugin_deactivate' );
//		add_action( 'admin_notices', 'my_plugin_admin_notice' );
//
//		function my_plugin_deactivate() {
//			deactivate_plugins( plugin_basename( __FILE__ ) );
//		}
//
//		function my_plugin_admin_notice() {
//			echo '<div class="updated"><p><strong>Plug-in name</strong> was folded into WordPress core in 3.5; the plug-in has been <strong>deactivated</strong>.</p></div>';
//			if ( isset( $_GET['activate'] ) )
//				unset( $_GET['activate'] );
//		}
//
//	}
