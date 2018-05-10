<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://techknowsystems.com.au
 * @since      1.0.0
 *
 * @package    Uplift_Article_Meta
 * @subpackage Uplift_Article_Meta/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Uplift_Article_Meta
 * @subpackage Uplift_Article_Meta/public
 * @author     Shaa Taylor <shaa@uplift.global>
 */
class Uplift_Article_Meta_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Uplift_Article_Meta_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Uplift_Article_Meta_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/uplift-article-meta-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Uplift_Article_Meta_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Uplift_Article_Meta_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/uplift-article-meta-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Registers all the plugin shortcodes
	 *
	 * Currently all the shortcodes are defined in the 
	 *
	 * @since 		1.0.0
	 * @param 		string 			$Now_Hiring 		The name of this plugin.
	 * @param 		string 			$version 			The version of this plugin.
	 */
	public function register_shortcodes () {

		// Class for all shortcode functions
		$shortcodes = new Uplift_Article_Meta_Public_Shortcodes( $this->plugin_name, $this->version );

		add_shortcode ('articlereferences', array ($shortcodes, 'show_article_references'));
        add_shortcode ('freetext', array ($shortcodes, 'show_free_text'));
		add_shortcode ('articlebanner', array ($shortcodes, 'show_article_banner'));
		add_shortcode ('mobilebanner', array ($shortcodes, 'show_mobile_banner'));
		add_shortcode ('articleauthor', array ($shortcodes, 'show_author'));
		add_shortcode ('articleattribution', array ($shortcodes, 'show_attribution'));
        add_shortcode ('featureimagecredit', array ($shortcodes, 'show_feature_image_credit'));
        add_shortcode ('readnextbutton', array ($shortcodes, 'show_read_next_button'));
        add_shortcode ('signupbanner', array ($shortcodes, 'show_signup_banner'));

	}

}
