<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://techknowsystems.com.au
 * @since      1.0.0
 *
 * @package    Uplift_Article_Meta
 * @subpackage Uplift_Article_Meta/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Uplift_Article_Meta
 * @subpackage Uplift_Article_Meta/includes
 * @author     Shaa Taylor <shaa@uplift.global>
 */
class Uplift_Article_Meta {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Uplift_Article_Meta_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'uplift-article-meta';
		$this->version = '0.1.5';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		$this->define_metabox_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Uplift_Article_Meta_Loader. Orchestrates the hooks of the plugin.
	 * - Uplift_Article_Meta_i18n. Defines internationalization functionality.
	 * - Uplift_Article_Meta_Admin. Defines all hooks for the admin area.
	 * - Uplift_Article_Meta_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-uplift-article-meta-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-uplift-article-meta-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-uplift-article-meta-admin.php';

		/**
		 * The class responsible for defining all actions relating to metaboxes.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-uplift-article-meta-admin-metaboxes.php';

		/**
		 * The class responsible for defining all actions relating to metaboxes.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-uplift-article-meta-admin-settings.php';

		/**
		 * The class responsible for plugin dependencies.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-tgm-plugin-activation.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-uplift-article-meta-public.php';

		/**
		 * The class responsible for defining all public-facing shortodes
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-uplift-article-meta-public-shortcodes.php';

		/**
		 * The class responsible for all global functions
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-uplift-article-meta-globals.php';

		$this->loader = new Uplift_Article_Meta_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Uplift_Article_Meta_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Uplift_Article_Meta_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Uplift_Article_Meta_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_menu' );
		$this->loader->add_filter( 'plugin_action_links_' . UPLIFT_ARTICLE_META_FILE, $plugin_admin, 'add_settings_link');
		$this->loader->add_action( 'admin_head', $plugin_admin, 'set_cmb2_css');
		$this->loader->add_action( 'tgmpa_register', $plugin_admin, 'register_required_plugins');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Uplift_Article_Meta_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_public, 'register_shortcodes');

	}

	/**
	 * Register all of the hooks related to the admin metaboxes functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_metabox_hooks() {

		$plugin_metaboxes = new Uplift_Article_Meta_Admin_Metaboxes( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'cmb2_init', $plugin_metaboxes, 'create_metabox' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Uplift_Article_Meta_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
