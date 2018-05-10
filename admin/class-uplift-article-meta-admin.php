<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://techknowsystems.com.au
 * @since      1.0.0
 *
 * @package    Uplift_Banner_Ad
 * @subpackage Uplift_Banner_Ad/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Uplift_Article_Meta
 * @subpackage Uplift_Article_Meta/admin
 * @author     Shaa Taylor <shaa@uplift.global>
 */
class Uplift_Article_Meta_Admin {

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
	 * @param    string    $plugin_name       The name of this plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/uplift-article-meta-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/uplift-article-meta-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Adds a 'Settings' link to the plugin on the 'Installed Plugins' page.
	 *
	 * @since    1.0.0
	 */
	public function add_settings_link($links) {

		$links[] = sprintf ('<a href="%s">%s</a>', esc_url (admin_url ('options-general.php?page=' . $this->plugin_name)), esc_html__( 'Settings', $this->plugin_name));
		return $links;

	}

	/**
	 * Adds a settings page under the 'Settings' menu
	 *
	 * @since    1.0.0
	 */
	public function add_menu() {

		$hookSuffix = add_options_page (
			__('UPLIFT Banner Adverts & Metaboxes', $this->plugin_name), 
			__('UPLIFT Ads & Metabox', $this->plugin_name), 
			'manage_options',
			$this->plugin_name,
			array ($this, 'create_settings_page')
		);

	}  // add_menu

	/**
	 * The content for the settings page
	 *
	 * The HTML + PHP is stored in a separate file to segment and easy editing
	 *
	 * @since    1.0.0
	 */
	public function create_settings_page () {

		echo '<h1>UPLIFT Banner Ads Settings</h1>';
		echo '<p>This is the page content</p>';

	} // create_settings_page

	/**
	 * Extra CSS for the CMB2 metaboxes
	 *
	 * This CSS colours the titles of the defined CMB2 Metaboxes to make them easier to find in the back-end. 
	 * The users admin colours are fetched to colour the metabox titles to work in with the users 
	 * choice of admin colours
	 *
	 * @since    1.0.0
	 */
	public function set_cmb2_css() {

    	global $_wp_admin_css_colors;
    	$admin_colors = $_wp_admin_css_colors;
    	$color_scheme = $admin_colors[get_user_option('admin_color')];
    	$color_scheme_array = get_object_vars($color_scheme);
		echo '<style type="text/css">' .
				'#post-campaign-banner-metabox .hndle, ' .
				'#post-campaign-banner-metabox-new .hndle,' .
				'#article-subtitle-metabox .hndle, ' . 
				'#tagsdiv-article_class .hndle, ' .
				'#postexcerpt .hndle, ' .
				'#article-references-metabox .hndle, ' .
                '#free-text-metabox .hndle, ' .
				'#article-reblog-metabox .hndle, ' .
				'#article-guest-post-metabox .hndle, ' .
				'#article-related-metabox .hndle, ' .
                '#powerpress-podcast .hndle, ' .
				'#mobile-banner-metabox .hndle {' .
            		'background-color:' . $color_scheme_array['colors'][1] . ';' . //#003284;
            		'color:#fff;' .
        	 	'}' .
			'</style>';

	}

	/**
	 * Function to run the TGM Plugin Activator for external plugin dependencies
	 *
	 * The UPLIFT Banner Adverts & Metaboxes plugin required the folowing plugins to be installed and active:
	 *
	 * - CMB2
	 * - CMB Field Type: Select2
	 *
	 * This function uses the TGM Plugin Activator to make sure this is so.
	 *
	 * @since    1.0.0
	 */
	public function register_required_plugins () {

		/*	
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			// The CMB2 plugin from the WP repository
			array(
				'name'      => 'CMB2',
				'slug'      => 'cmb2',
				'required'  => true,
			),

			// The CMB Field Type: Select2 plugin from Github
			array(
				'name'      => 'CMB Field Type: Select2',
				'slug'      => 'cmb-field-select2-master',
				'source'    => 'https://github.com/mustardBees/cmb-field-select2/archive/master.zip',
				'required'  => true,
			),

		);

		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'uplift-article-meta',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'plugins.php',            // Parent menu slug.
			'capability'   => 'manage_options',    // Capability needed to view plugin install page, should be a Capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.

		);

		tgmpa( $plugins, $config );

	}

}
