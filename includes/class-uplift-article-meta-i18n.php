<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://techknowsystems.com.au
 * @since      1.0.0
 *
 * @package    Uplift_Article_Meta
 * @subpackage Uplift_Article_Meta/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Uplift_Article_Meta
 * @subpackage Uplift_Article_Meta/includes
 * @author     Shaa Taylor <shaa@uplift.global>
 */
class Uplift_Article_Meta_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'uplift-article-meta',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}
