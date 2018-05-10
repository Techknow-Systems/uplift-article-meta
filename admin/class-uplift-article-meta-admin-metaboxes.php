<?php

/**
 * The metabox-specific functionality for UPLIFT Banner Adverts.
 *
 * @link 		http://www.techknowsystems.com.au
 * @since 		1.0.0
 *
 * @package 	Uplift_Article_Meta
 * @subpackage 	Uplift_Article_Meta/admin
 */

/**
 * The metabox-specific functionality of the plugin.
 *
 * @package 	Uplift_Article_Meta
 * @subpackage 	Uplift_Article_Meta/admin
 * @author 		Shaa Taylor <shaa@uplift.global>
 */

class Uplift_Article_Meta_Admin_Metaboxes {

	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$plugin_name 		The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$version 			The current version of this plugin.
	 */
	private $version;

	/**
	 * The prefix for all metabox fields.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$prefix 			The prefix for all metabox fields.
	 */
	private $prefix;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 			$Now_Hiring 		The name of this plugin.
	 * @param 		string 			$version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->prefix = '_upl_';

	}

	/**
	 * Creates all custom metaboxes.
	 *
	 * This is the public facing fuction for creating all custom metaboxes. This method simply farms the
	 * process out to other functions so that it doesn't get unweildly.
	 *
	 * @since     1.0.0
	 */
	public function create_metabox($metaBox = 'all') {

		$this->article_general_metabox();
		$this->page_excerpt_metabox();
//		$this->desktop_campaign_banner_metabox();
		$this->desktop_campaign_banner_metabox_new();
		$this->reblog_metabox();
		$this->guest_post_metabox();
		$this->references_metabox();
        $this->free_text_metabox();
		$this->related_articles_metabox();
		$this->inarticle_banners_metabox();

	}

	/**
	 * Creates the Article General Custom Meta Box
	 *
	 * @since     1.0.0
	 * @access 	  private
	 */
	private function article_general_metabox() {

	    // Initiate the metabox
	    $cmb_subtitle = new_cmb2_box (array(
	        'id'            => 'article-subtitle-metabox',
	        'title'         => __( 'Article General', 'cmb2' ),
	        'object_types'  => array( 'post', ), // Post type
	        'context'       => 'normal',
	        'priority'      => 'high',
	        'show_names'    => true, // Show field names on the left
	    ));

	    // The Article Subtitle definition - its a regular text field
	    $cmb_subtitle->add_field (array(
	        'name'       => __( 'Article Subtitle', 'cmb2' ),
	        'desc'       => __( 'The Article Subtitle displays below the featured image', 'cmb2' ),
	        'id'         => $this->prefix . 'article_subtitle',
	        'type'       => 'text',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ));

        // The Article Feature Image Credit- its a regular text field
        $cmb_subtitle->add_field (array(
            'name'       => __( 'Feature Image Credit', 'cmb2' ),
            'desc'       => __( 'The Feature Image credit', 'cmb2' ),
            'id'         => $this->prefix . 'feature_image_credit',
            'type'       => 'text',
            'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        ));

        // The URL for the article featured image credit
        $cmb_subtitle->add_field (array(
            'name'       => __( 'Feature Image Credit URL', 'cmb2' ),
            'desc'       => __( 'The link for the Feature Image credit', 'cmb2' ),
            'id'         => $this->prefix . 'feature_image_credit_url',
            'type'       => 'text_url',
            'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        ));

        // Read Next Articles for selection
        $cmb_subtitle->add_field( array(
            'name'       => __( 'Read Next Article', 'cmb2' ),
            'desc'       => __( 'This article is shown when Read Next button is clicked', 'cmb2' ),
            'id'         => $this->prefix . 'read_next_article',
            'type'       => 'pw_select',
            'options_cb' => 'get_readnext_articles',
            'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        ) );

        // The Article Read Next Button Text - its a regular text field
        $cmb_subtitle->add_field (array(
            'name'       => __( 'Read Next Button Text', 'cmb2' ),
            'desc'       => __( 'A short text reference for the Read Next article which is shown on the button', 'cmb2' ),
            'id'         => $this->prefix . 'read_next_button',
            'type'       => 'text',
            'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        ));


        /**
         * Callback to populate the list of articles in the Read Next article drop down
         *
         * @since     1.0.0
         */
        function get_readnext_articles() {

            $args = array(
                'post_type'	=> 'post',
                'posts_per_page'	=> -1,
                'order'	=> 'ASC',
                'orderby'	=> 'title',
            );

            $posts = get_posts( $args );

            $post_options = array();
            if ( $posts ) {
                foreach ( $posts as $post ) {
                    $post_options[ $post->ID ] = $post->post_title;
                }
            }

            return $post_options;

        }

	}


	/**
	 * Creates the Page Excerpt Custom Meta Box
	 *
	 * @since     1.0.0
	 * @access 	  private
	 */
	private function page_excerpt_metabox() {

	    // Initiate the Page Excerpt metabox
	    $cmb_pageexcerpt = new_cmb2_box( array(
	        'id'            => 'page-excerpt-metabox',
	        'title'         => __( 'Page Excerpt', 'cmb2' ),
	        'object_types'  => array( 'page', ), // Page type
	        'context'       => 'normal',
	        'priority'      => 'high',
	        'show_names'    => false, // Show field names on the left
	        // 'cmb_styles' => false, // false to disable the CMB stylesheet
	        // 'closed'     => true, // Keep the meatball closed by default
	    ) );

	    // The Article Subtitle definition - its a regular text field
	    $cmb_pageexcerpt->add_field( array(
	        'name'       => __( 'Page Excerpt', 'cmb2' ),
	        'desc'       => __( 'The page excerpt acts exactly like an excerpt on an article', 'cmb2' ),
	        'id'         => $this->prefix . 'page_excerpt',
	        'type'       => 'textarea_small',
   	     	'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
   	 	) );

	}

	/**
	 * Creates the Desktop Campaign Banner Custom Meta Box
	 *
	 * @since     1.0.0
	 * @access 	  private
	 */
/*	private function desktop_campaign_banner_metabox() {

	    // Initiate Desktop Campaign Banner metabox 
	    $cmb_postcampaignbanner = new_cmb2_box( array(
	        'id'            => 'post-campaign-banner-metabox',
	        'title'         => __( 'Post Campaign Banner', 'cmb2' ),
	        'object_types'  => array( 'post', ), // Post only
 	      	'context'       => 'normal',
  	      	'priority'      => 'core',
	        'show_names'    => true, // Show field names on the left
	        'cmb_styles' 	=> false, // false to disable the CMB stylesheet
	        // 'closed'     => true, // Keep the meatball closed by default
	    ) );

	    // Show Campaign banner on Post - Checkbox
	    $cmb_postcampaignbanner->add_field( array(
	        'name'       => __( 'Show on Post', 'cmb2' ),
	        'desc'       => __( 'Turn campaign image on for this post', 'cmb2' ),
	        'id'         => $this->prefix . 'cb_show_on_post',
	        'type'       => 'checkbox',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

	    // URL of the image to show - Text_URL
	    $cmb_postcampaignbanner->add_field( array(
	        'name'       => __( 'Click Through URL', 'cmb2' ),
	        'desc'       => __( 'URL click target of the banner', 'cmb2' ),
	        'id'         => $this->prefix . 'cb_click_url',
	        'type'       => 'text_url',
   	     	'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
    	) );

	    // URL of the image to show - Text_URL
	    $cmb_postcampaignbanner->add_field( array(
	        'name'       => __( 'Image URL', 'cmb2' ),
	        'desc'       => __( 'URL of the image to display', 'cmb2' ),
	        'id'         => $this->prefix . 'cb_image_url',
	        'type'       => 'text_url',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

	    // URL of the image to show on mobile - Text_URL
	    $cmb_postcampaignbanner->add_field( array(
	        'name'       => __( 'Mobile Image URL', 'cmb2' ),
	        'desc'       => __( 'URL of the image to display on mobile', 'cmb2' ),
	        'id'         => $this->prefix . 'cb_mobile_image_url',
	        'type'       => 'text_url',
 	       	'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
    	) );

	    // Text to show on the banner (so it displays nicely on mobile as well) - Text
	    $cmb_postcampaignbanner->add_field( array(
	        'name'       => __( 'Responsive Text', 'cmb2' ),
	        'desc'       => __( 'Text to display under the banner (supports basic HTML)', 'cmb2' ),
	        'id'         => $this->prefix . 'cb_responsive_text',
 	       	'type'       => 'text',
			'sanitization_cb' => array($this, 'sanitize_text_callback'), // function should return a sanitized value
        	'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
    	) );

	    // Size of the text to show on the banner - text_small
	    $cmb_postcampaignbanner->add_field( array(
	        'name'       => __( 'Text Size', 'cmb2' ),
	        'desc'       => __( 'Text size (DO NOT include "px"', 'cmb2' ),
	        'id'         => $this->prefix . 'cb_text_size',
	        'type'       => 'text_small',
			'default'	 => '20',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

		// Colour of the text - Colour Picker
	    $cmb_postcampaignbanner->add_field( array(
	        'name'       => __( 'Text Colour', 'cmb2' ),
	        'desc'       => __( 'The colour of the display text', 'cmb2' ),
	        'id'         => $this->prefix . 'cb_text_colour',
	        'type'       => 'colorpicker',
			'default' 	 => '#fff',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

		// Colour of the background - Colour Picker
	    $cmb_postcampaignbanner->add_field( array(
	        'name'       => __( 'Background Colour', 'cmb2' ),
	        'desc'       => __( 'The colour of the text background', 'cmb2' ),
	        'id'         => $this->prefix . 'cb_background_colour',
	        'type'       => 'colorpicker',
			'default'	 => '#003284',
   	     	'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

	} */
    
	/**
	 * Creates the Desktop Campaign Banner Custom Meta Box
	 *
	 * @since     1.0.0
	 * @access 	  private
	 */
	private function desktop_campaign_banner_metabox_new() {

	    // Initiate Desktop Campaign Banner metabox 
	    $cmb_postcampaignbanner_new = new_cmb2_box( array(
	        'id'            => 'post-campaign-banner-metabox-new',
	        'title'         => __( 'Post Campaign Banner', 'cmb2' ),
	        'object_types'  => array( 'post', ), // Post only
 	      	'context'       => 'normal',
  	      	'priority'      => 'core',
	        'show_names'    => true, // Show field names on the left
	        'cmb_styles' 	=> false, // false to disable the CMB stylesheet
	        // 'closed'     => true, // Keep the meatball closed by default
	    ) );

	    // Show Campaign banner on Post - Checkbox
	    $cmb_postcampaignbanner_new->add_field( array(
	        'name'       => __( 'Show Campaign Banner', 'cmb2' ),
	        'desc'       => __( 'Turn campaign image on for this post', 'cmb2' ),
	        'id'         => $this->prefix . 'cbnew_show_on_post',
	        'type'       => 'checkbox',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

		// Related Posts field 1 
	    $cmb_postcampaignbanner_new->add_field( array(
	        'name'       => __( 'Campaign Banner to Display', 'cmb2' ),
	        'desc'       => __( 'Show this Campaign Banner at the end of the article', 'cmb2' ),
	        'id'         => $this->prefix . 'cbnew_banner_name',
	        'type'       => 'pw_select',
	        'default'	 => 'Use Previous Settings',
	        'options_cb' => 'get_campaign_banners_for_select',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

		/**
		 * Callback to populate the list of mobile banners in the mobile banner drop down
		 *
		 * @since     1.0.0
		 */
	   	function get_campaign_banners_for_select() {

	   		$mbSettings = new Uplift_Article_Meta_Admin_Settings ();
	   		return $mbSettings->get_campaign_banner ('', true);

	   	}

	}

	/**
	 * Creates the Article Reblog Custom Meta Box
	 *
	 * @since     1.0.0
	 * @access 	  private
	 */
	private function reblog_metabox() {

	    // Initiate Reblog metabox 
	    $cmb_articlereblog = new_cmb2_box( array(
	        'id'            => 'article-reblog-metabox',
	        'title'         => __( 'Article Reblog', 'cmb2' ),
	        'object_types'  => array( 'post', ), // Post only
	        'context'       => 'normal',
	        'priority'      => 'core',
	        'show_names'    => true, // Show field names on the left
	        'cmb_styles' 	=> false, // false to disable the CMB stylesheet
	        // 'closed'     => true, // Keep the meatball closed by default
	    ) );

	    // This is a reblog - Checkbox
	    $cmb_articlereblog->add_field( array(
	        'name'       => __( 'This is a Reblog', 'cmb2' ),
	        'desc'       => __( 'Check to indicate that this article is a reblog from another site', 'cmb2' ),
	        'id'         => $this->prefix . 'rebl_is_reblog',
	        'type'       => 'checkbox',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

	    // Original Author Name
	    $cmb_articlereblog->add_field( array(
	        'name'       => __( 'Author Name', 'cmb2' ),
	        'desc'       => __( 'Name of the original author of the article', 'cmb2' ),
	        'id'         => $this->prefix . 'rebl_author_name',
	        'type'       => 'text',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );
    
	    // URL attached to the Author - Text_URL
	    $cmb_articlereblog->add_field( array(
	        'name'       => __( 'Author URL', 'cmb2' ),
	        'desc'       => __( 'Link for the Author', 'cmb2' ),
	        'id'         => $this->prefix . 'rebl_author_url',
	        'type'       => 'text_url',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

	    // Sitename Where the original article appeared
	    $cmb_articlereblog->add_field( array(
	        'name'       => __( 'Original Site Name', 'cmb2' ),
	        'desc'       => __( 'Name of the website that this article originally appeared on', 'cmb2' ),
	        'id'         => $this->prefix . 'rebl_original_site_name',
	        'type'       => 'text',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

        //Sitedescription Description of the site of original article
        $cmb_articlereblog->Add_field( array(
            'name'       => __( 'Original Site Description', 'cmb2' ),
            'desc'       => __( 'Description of the website that this article originally appeared on', 'cmb2' ),
            'id'         => $this->prefix . 'rebl_original_site_description',
            'type'       => 'text',
            'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        ));

	    // URL of the original article - Text_URL
	    $cmb_articlereblog->add_field( array(
	        'name'       => __( 'Orginal Article URL', 'cmb2' ),
	        'desc'       => __( 'URL of the original article', 'cmb2' ),
	        'id'         => $this->prefix . 'rebl_original_url',
	        'type'       => 'text_url',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

	}
    
	/**
	 * Creates the Guest Post Reblog Custom Meta Box
	 *
	 * @since     1.0.0
	 * @access 	  private
	 */
	private function guest_post_metabox() {

	    // Initiate Reblog metabox 
	    $cmb_guestpost = new_cmb2_box( array(
	        'id'            => 'article-guest-post-metabox',
	        'title'         => __( 'Article Guest Post', 'cmb2' ),
	        'object_types'  => array( 'post', ), // Post only
	        'context'       => 'normal',
	        'priority'      => 'core',
	        'show_names'    => true, // Show field names on the left
	        'cmb_styles' 	=> false, // false to disable the CMB stylesheet
	        // 'closed'     => true, // Keep the meatball closed by default
	    ) );

	    // This is a guest post - Checkbox
	    $cmb_guestpost->add_field( array(
	        'name'       => __( 'This is a Guest Post', 'cmb2' ),
	        'desc'       => __( 'Check to indicate that this article is a guest post (i.e. is not published on another site). Please make sure that the "Article Reblog" is not active at the same time, otherwise this informaton will not show.', 'cmb2' ),
	        'id'         => $this->prefix . 'gp_is_guest_post',
	        'type'       => 'checkbox',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

	    // Primary Author Name - Text
	    $cmb_guestpost->add_field( array(
	        'name'       => __( 'Primary Author Name', 'cmb2' ),
	        'desc'       => __( 'Name of the original / primary author of the article', 'cmb2' ),
	        'id'         => $this->prefix . 'gp_author_primary_name',
	        'type'       => 'text',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );
    
	    // URL attached to the Primary Author - Text_URL
	    $cmb_guestpost->add_field( array(
	        'name'       => __( 'Primary Author URL', 'cmb2' ),
	        'desc'       => __( 'Link for the Primary Author', 'cmb2' ),
	        'id'         => $this->prefix . 'gp_author_primary_url',
	        'type'       => 'text_url',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

	    // Co-Author Name - Text
	    $cmb_guestpost->add_field( array(
	        'name'       => __( 'Co-Author Name', 'cmb2' ),
	        'desc'       => __( 'Name of the collorating author for this article', 'cmb2' ),
	        'id'         => $this->prefix . 'gp_author_co_name',
	        'type'       => 'text',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );
    
	    // URL attached to the Co-Author - Text_URL
	    $cmb_guestpost->add_field( array(
	        'name'       => __( 'Co-Author URL', 'cmb2' ),
	        'desc'       => __( 'Link for the collaborating Author', 'cmb2' ),
	        'id'         => $this->prefix . 'gp_author_co_url',
	        'type'       => 'text_url',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

	    // Bio for both authors - Textarea_Small
	    $cmb_guestpost->add_field( array(
	        'name'       => __( 'Author(s) Bio', 'cmb2' ),
	        'desc'       => __( 'The bio for the Author(s) of this article', 'cmb2' ),
	        'id'         => $this->prefix . 'gp_author_bio',
	        'type'       => 'textarea_small',
   	     	'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
   	 	) );

	}
    
	/**
	 * Creates the Article References Custom Meta Box
	 *
	 * @since     1.0.0
	 * @access 	  private
	 */
	private function references_metabox() {

	    // Initiate Article References metabox 
	    $cmb_articlereferences = new_cmb2_box( array(
	        'id'            => 'article-references-metabox',
	        'title'         => __( 'References', 'cmb2' ),
	        'object_types'  => array( 'post', ), // Post only
	        'context'       => 'normal',
	        'priority'      => 'core',
	        'show_names'    => true, // Show field names on the left
	        'cmb_styles' 	=> false, // false to disable the CMB stylesheet
	        // 'closed'     => true, // Keep the meatball closed by default
	    ) );

	    // This is a reblog - checkbox
	    $cmb_articlereferences->add_field( array(
	        'name'       => __( 'Add References', 'cmb2' ),
	        'desc'       => __( 'Check to include references at the bottom of this article', 'cmb2' ),
	        'id'         => $this->prefix . 'ref_show_references',
	        'type'       => 'checkbox',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

	    // Original Author Name
	    $cmb_articlereferences->add_field( array(
	        'name'       => __( 'References Text', 'cmb2' ),
	        'desc'       => __( 'References. Please organise them as they are to appear in article (Supports Basic HTML)', 'cmb2' ),
	        'id'         => $this->prefix . 'ref_references_text',
	        'type'       => 'textarea',
			'sanitization_cb' => array ($this, 'sanitize_text_callback'), // function should return a sanitized value
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

	}
	

	/**
     * Creates the Article Related Articles (for Podcasts) Custom Meta Box
     *
     * @since     1.0.0
     * @access 	  private
     */
    private function free_text_metabox() {

        // Initiate Article Related Articles metabox
        $cmb_freetext = new_cmb2_box( array(
            'id'            => 'free-text-metabox',
            'title'         => __( 'Free Text for Podcasts', 'cmb2' ),
            'object_types'  => array( 'post', ), // Post only
            'context'       => 'normal',
            'priority'      => 'core',
            'show_names'    => true, // Show field names on the left
            'cmb_styles' 	=> false, // false to disable the CMB stylesheet
            // 'closed'     => true, // Keep the meatball closed by default
        ) );

        // Show the Free Text - checkbox
        $cmb_freetext->add_field( array(
            'name'       => __( 'Add Free Text', 'cmb2' ),
            'desc'       => __( 'Check to include a block of free text eg: related articles at the bottom of this article', 'cmb2' ),
            'id'         => $this->prefix . 'ref_show_free_text',
            'type'       => 'checkbox',
            'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        ) );

        // Block Title
        $cmb_freetext->add_field( array(
            'name'       => __( 'Free Text Block Title', 'cmb2' ),
            'desc'       => __( 'Title of the block shown on the page', 'cmb2' ),
            'id'         => $this->prefix . 'ref_free_text_title',
            'type'       => 'text',
            'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        ) );

        // Free Text Content
        $cmb_freetext->add_field( array(
            'name'       => __( 'Free Text', 'cmb2' ),
            'desc'       => __( 'Free Text (Supports Basic HTML).', 'cmb2' ),
            'id'         => $this->prefix . 'ref_free_text',
            'type'       => 'textarea',
            'sanitization_cb' => array ($this, 'sanitize_text_callback'), // function should return a sanitized value
            'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        ) );

    }


	/**
	 * Creates the Related Articles Custom Meta Box
	 *
	 * @since     1.0.0
	 * @access 	  private
	 */
	private function related_articles_metabox() {

	    // The RELATED ARTICLES Metaox
	    $cmb_relatedarticles = new_cmb2_box( array(
	        'id'            => 'article-related-metabox',
	        'title'         => __( 'Related Articles', 'cmb2' ),
	        'object_types'  => array( 'post', ), // Post type
	        'context'       => 'normal',
	        'priority'      => 'high',
	        'show_names'    => true, // Show field names on the left
	        // 'cmb_styles' => false, // false to disable the CMB stylesheet
	        // 'closed'     => true, // Keep the meatball closed by default
	    ) );

	    // How to show Related Article - Inline Rado Nutton
	    $cmb_relatedarticles->add_field( array(
	        'name'       => __( 'Show Articles', 'cmb2' ),
	        'desc'       => __( 'Choose how to show articles relaed to this one', 'cmb2' ),
	        'id'         => $this->prefix . 'related_to_show',
	        'type'       => 'radio_inline',
	        'show_option_none' => 'Random',
 	       	'options'	 => array(
 	           	//'random' => __( 'Totally Random', 'cmb_relatedarticles' ),
            	'category' => __( 'Related to Category', 'cmb_relatedarticles' ),
            	'specify' => __( 'Specify 3 Articles', 'cmb_relatedarticles' ),
	        ),
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

	    // List of Categories - Taxonomy Select
	    $cmb_relatedarticles->add_field( array(
	        'name'       => __( 'Related to Category', 'cmb2' ),
	        'desc'       => __( 'Show related articles from this category. Only works when "Related to Category" radio button is selected above.', 'cmb2' ),
	        'id'         => $this->prefix . 'related_category',
	        'type'       => 'select',
	        'show_option_none' => true,
	        'options'	 => $this->get_term_options(),
	    ) );

		// Related Posts field 1 
	    $cmb_relatedarticles->add_field( array(
	        'name'       => __( 'Specified Article #1', 'cmb2' ),
	        'desc'       => __( 'Show this article in position #1 of related articles. Only works when "Specify 3 Articles" is selected.', 'cmb2' ),
	        'id'         => $this->prefix . 'related_article_1',
	        'type'       => 'pw_select',
	        'options_cb' => 'get_articles_for_select',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

		// Related Posts field 2 
	    $cmb_relatedarticles->add_field( array(
	        'name'       => __( 'Specified Article #2', 'cmb2' ),
	        'desc'       => __( 'Show this article in position #2 of related articles. Only works when "Specify 3 Articles" is selected.', 'cmb2' ),
	        'id'         => $this->prefix . 'related_article_2',
	        'type'       => 'pw_select',
	        'options_cb' => 'get_articles_for_select',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

		// Related Posts field 3
	    $cmb_relatedarticles->add_field( array(
	        'name'       => __( 'Specified Article #3', 'cmb2' ),
	        'desc'       => __( 'Show this article in position #3 of related articles. Only works when "Specify 3 Articles" is selected.', 'cmb2' ),
	        'id'         => $this->prefix . 'related_article_3',
	        'type'       => 'pw_select',
	        'options_cb' => 'get_articles_for_select',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

		/**
		 * Callback to populate the list of articles in the related artciles drop downs
		 *
		 * @since     1.0.0
		 */
	   	function get_articles_for_select() {
    
		    $args = array(
		        'post_type'	=> 'post',
		        'posts_per_page'	=> -1,
		        'order'	=> 'ASC',
		        'orderby'	=> 'title',
		    );

		    $posts = get_posts( $args );

		    $post_options = array();
		    if ( $posts ) {
		        foreach ( $posts as $post ) {
		          	$post_options[ $post->ID ] = $post->post_title;
		        }
		    }

		    return $post_options;

		}

	}



	/**
	 * Creates the Desktop Campaign Banner Custom Meta Box
	 *
	 * @since     1.0.0
	 * @access 	  private
	 */


	private function inarticle_banners_metabox() {

	    // Initiate Desktop Campaign Banner metabox 
	    $cmb_inarticlebanner = new_cmb2_box( array(
	        'id'            => 'mobile-banner-metabox',
	        'title'         => __( 'In Article Banners', 'cmb2' ),
	        'object_types'  => array( 'post', ), // Post only
 	      	'context'       => 'normal',
  	      	'priority'      => 'core',
	        'show_names'    => true, // Show field names on the left
	        'cmb_styles' 	=> false, // false to disable the CMB stylesheet
	        // 'closed'     => true, // Keep the meatball closed by default
	    ) );

        $cmb_inarticlebanner->add_field( array(
	        'name'       => __( 'Show In Article Banner', 'cmb2' ),
	        'desc'       => __( 'Check to include a banner within this article.', 'cmb2' ),
	        'id'         => $this->prefix . 'mb_show_banner',
	        'type'       => 'checkbox',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

        $cmb_inarticlebanner->add_field( array(
	        'name'       => __( 'In Article Banner to Display', 'cmb2' ),
	        'desc'       => __( 'Show this Banner in the article with the [mobilebanner] shortcode', 'cmb2' ),
	        'id'         => $this->prefix . 'mb_banner_name',
	        'type'       => 'pw_select',
	        'options_cb' => 'get_mobile_banners_for_select',
	        'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
	    ) );

        $cmb_inarticlebanner->add_field( array(
            'name'       => __( 'Show Sign Up Banner (Weekly List)', 'cmb2' ),
            'desc'       => __( 'Check to include a sign up banner (weekly list) with the [signupbanner] shortcode.', 'cmb2' ),
            'id'         => $this->prefix . 'mb_show_signup_banner',
            'type'       => 'checkbox',
            'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        ) );

        $cmb_inarticlebanner->add_field( array(
            'name'       => __( 'Alternative to Sign Up Banner', 'cmb2' ),
            'desc'       => __( 'Show this banner if the user is already signed up to the weekly list.', 'cmb2' ),
            'id'         => $this->prefix . 'mb_altsignup_banner_name',
            'type'       => 'pw_select',
            'options_cb' => 'get_mobile_banners_for_select',
            'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
        ) );


        /**
		 * Callback to populate the list of mobile banners in the mobile banner drop down
		 *
		 * @since     1.0.0ss
		 */
	   	function get_mobile_banners_for_select() {

	   		$mbSettings = new Uplift_Article_Meta_Admin_Settings ();
	   		return $mbSettings->get_mobile_banner ('', true);
	   	}

	}

	/**
	 * Callback to allow HTML in the _upl_cb_responsive_text field
	 *
	 * @since     1.0.0
	 * @access 	  public
	 */
	public function sanitize_text_callback( $value, $field_args, $field ) {

		// Allow the following HTML tags in the text field: <p><a><br><br/><strong>
		$value = strip_tags( $value, '<h3><p><a><br><br/><strong><span>' );
	    return $value;

	}

	/**
	 * Callback for getting the categoriws for a select
	 *
	 * @since     1.0.0
	 * @access 	  public 
	 */
	public function get_term_options( $taxonomy = 'category', $args = array() ) {

	    $args['taxonomy'] = $taxonomy;
	    $args = wp_parse_args( $args, array( 'taxonomy' => 'category' ) );
	    $taxonomy = $args['taxonomy'];
	    $terms = (array) get_terms( $taxonomy, $args );

	    // Initate an empty array
	    $term_options = array();
	    if ( ! empty( $terms ) ) {
	        foreach ( $terms as $term ) {
    	        $term_options[ $term->term_id ] = $term->name;
	        }
	    }

	    return $term_options;
	}

}