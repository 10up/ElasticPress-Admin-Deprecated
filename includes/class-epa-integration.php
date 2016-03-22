<?php

class EPA_Integration {

	/**
	 * Placeholder method
	 *
	 * @since 0.9
	 */
	public function __construct() { }

	/**
	 *
	 */
	public function setup() {

		// Override the admin integration in ElasticPress
		add_filter( 'ep_admin_wp_query_integration', array( $this, 'admin_integration' ) );

		// Search all available post meta fields
		add_filter( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
	}

	/**
	 * Allow integration on the admin side of things
	 * This is pretty much the entire point of the plugin
	 *
	 * @param $integration
	 *
	 * @return bool
	 */
	public function admin_integration( $integration ) {
		if ( is_admin() && apply_filters( 'epa_query_integration', true ) ) {
			$integration = true;
		}

		return $integration;
	}

	public function pre_get_posts( $query ) {
		if ( is_admin() && $query->is_main_query() ) {
			$query->set( 'search_fields', array( 'meta' => '*' ) );
		}
	}

	/**
	 * Return a singleton instance of the current class
	 *
	 * @since 0.9
	 * @return object
	 */
	public static function factory() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new self();
			$instance->setup();
		}

		return $instance;
	}
}

EPA_Integration::factory();