<?php
/*
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://upliftconnect.com/
 * @since             1.0.0
 * @package           Uplift_Article_Meta
 *
 * @wordpress-plugin
 * Plugin Name:       UPLIFT Article Meta - Banners & Metaboxes
 * Plugin URI:        http://www.techknowsystems.com.au/uplift-article-meta
 * Description:       Creation and display of desktop and mobile banners as well as metaboxes for article editing. Impression and click-thru analytics coming soon.
 * Version:           1.0.0
 * Author:            Shaa Taylor
 * Author URI:        http://www.techknowsystems.com.au
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       uplift-article-meta
 * Domain Path:       /languages
 */
if ( ! defined( 'WPINC' ) ) {     // If this file is called directly, abort.

    die;
}

// Used for referring to the plugin file or basename
if ( ! defined( 'UPLIFT_ARTICLE_META_FILE' ) ) {
	define( 'UPLIFT_ARTICLE_META_FILE', plugin_basename( __FILE__ ) );
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-uplift-article-meta-activator.php
 */
function activate_uplift_article_meta() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-uplift-article-meta-activator.php';
	Uplift_Article_Meta_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-uplift-article-meta-deactivator.php
 */
function deactivate_uplift_article_meta() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-uplift-article-meta-deactivator.php';
	Uplift_Article_Meta_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_uplift_article_meta' );
register_deactivation_hook( __FILE__, 'deactivate_uplift_article_meta' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-uplift-article-meta.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_uplift_article_meta() {

	$plugin = new Uplift_Article_Meta();
	$plugin->run();

}
run_uplift_article_meta();
