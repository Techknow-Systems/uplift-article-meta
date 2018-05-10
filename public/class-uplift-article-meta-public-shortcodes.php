<?php

require (WP_CONTENT_DIR . '/uplift-resources/mc3-signup/php/mcApiCall.php');

/**
 * The shortcode definitions for UPLIFT Banner Adverts & Metaboxes.
 *
 * @link 		http://www.techknowsystems.com.au
 * @since 		1.0.0
 *
 * @package 	Uplift_Article_Meta
 * @subpackage 	Uplift_Article_Meta/public
 */

/**
 * The metabox-specific functionality of the plugin.
 *
 * @package 	Uplift_Article_Meta
 * @subpackage 	Uplift_Article_Meta/public
 * @author 		Shaa Taylor <shaa@uplift.global>
 */

class Uplift_Article_Meta_Public_Shortcodes {

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
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$postID 			The ID of the current post.
	 */
	private $postID;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 			$plugin_name 		The name of this plugin.
	 * @param 		string 			$version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	    $currentURL = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	    $this->postID = url_to_postid ($currentURL);

	}

	/**
	 * Create a reference section
	 *
	 * Uses the "_upl_ref_references_text" post meta field to create the references section
	 *
	 * @since 		1.0.0
	 * @return 		sstring 		$HTML 		Output HTML from the shortcode
	 */
	public function show_article_references () {

	    $HTML = '';
    
 	    if ( get_post_meta($this->postID, '_upl_ref_show_references', true )) {

	    	// Output the custom field that storeds the page excerpt
	        $HTML = '<style type="text/css">';
	        	$HTML .= '.upllfe-article-references-wrapper {';
					$HTML .= 'display: block;';
				$HTML .= '}';
			$HTML .= '</style>';
	    	$HTML .= '<div id="ubam-references-container">';
	    	$HTML .= '<h3>References</h3>';
	    	$HTML .= '<span>' . wpautop( get_post_meta( $this->postID, '_upl_ref_references_text', true )) . '</span></div>';

		} else {

		    // Don't display the references block

		}

		return $HTML;
    
	}


 	/**
     * Create a free text section
     *
     * Uses the "_upl_ref_free_text" post meta field to create the free text section
     *
     * @since 		1.0.0
     * @return 		sstring 		$HTML 		Output HTML from the shortcode
     */
    public function show_free_text () {

        $HTML = '';

        if ( get_post_meta($this->postID, '_upl_ref_show_free_text', true )) {

            // Output the custom field that storeds the page excerpt
            $HTML = '<style type="text/css">';
            $HTML .= '.upllfe-podcast-freetext-wrapper {';
            $HTML .= 'display: block;';
            $HTML .= '}';
            $HTML .= '</style>';
            $HTML .= '<div id="ubam-references-container">';
            $HTML .= '<h3>' . get_post_meta($this->postID, '_upl_ref_free_text_title', true ) . '</h3>';
            $HTML .= '<span>' . wpautop( get_post_meta( $this->postID, '_upl_ref_free_text', true )) . '</span></div>';

        } else {

            // Don't display the free text block

        }

        return $HTML;

    }


	/**
	 * Create a campaign banner for desktop and a mobile banner mid article. 
	 *
	 * @since 		1.0.0
	 * @param 		array 		$atts 		Shortcode parameters
	 * @return 		string 		$HTML 		Output HTML from the shortcode
	 */
	public function show_article_banner () {

	    $HTML = '';
		$cbName = get_post_meta ($this->postID, '_upl_cbnew_banner_name', true);

	    if (!empty ($cbName)) {

			if ( get_post_meta ($this->postID, '_upl_cbnew_show_on_post', true)) {

				$cbSettingsObj = new Uplift_Article_Meta_Admin_Settings ();
		   		$cbSettings = $cbSettingsObj->get_campaign_banner ($cbName);

		   		$HTML = '<div id="ubam-campaign-banner-container">';
			    $HTML .= '<a href="' . $cbSettings['click_url'] . '"';
				if ($cbSettings['click_new_window']) { $HTML .= ' target="_blank"'; }
			    $HTML .= '><img src="' . $cbSettings['image_url']. '" />';
	        	$HTML .= '<div style="font-size: ' . $cbSettings['text_size'] . 'px; color: ' . $cbSettings['text_colour'] . '; background: ' . $cbSettings['back_colour'] . ';"><span>' . $cbSettings['text'] . '</span></div></a></div>';

			    // Add in a media query to take care of the text size & responsive text on mobile. Nice hack!
	        	$HTML .= '<style type="text/css">';
	        		$HTML .= '@media only screen and (max-width: 750px) {';
	        			$HTML .= '#ubam-campaign-banner-container div {';
	        				$HTML .= 'font-size: ' . ($cbSettings['text_size'] - 3) . 'px !important;';
	        			$HTML .= '}';
	        			$HTML .= '#ubam-campaign-banner-container div span {';
	        				$HTML .= 'display: none;';
	        			$HTML .= '}';
	        			$HTML .= '#ubam-campaign-banner-container div:after {';
	        				$HTML .= 'content: "' . $cbSettings['responsive_text'] . '";';
	        				$HTML .= 'white-space: pre;';
	        			$HTML .= '}';
	        		$HTML .= '}';
	        	$HTML .= '</style>';

	        }

	    } else if ( get_post_meta ($this->postID, '_upl_cb_show_on_post', true)) {

	    	// Backwards compatability with the old metabox
		    // If the "Show on Post" checkbox is checked, then display the image
		    $banner['imageURL'] = get_post_meta ($this->postID, '_upl_cb_image_url', true);
	        $banner['mobileImageURL'] = get_post_meta ($this->postID, '_upl_cb_mobile_image_url', true);
		    $banner['clickURL'] = get_post_meta ($this->postID, '_upl_cb_click_url', true);
		    $banner['responsiveText'] = get_post_meta ($this->postID, '_upl_cb_responsive_text', true);
		    $banner['textColour'] = get_post_meta ($this->postID, '_upl_cb_text_colour', true);
		    $banner['textSize'] = get_post_meta ($this->postID, '_upl_cb_text_size', true);
		    $banner['boxColour'] = get_post_meta ($this->postID, '_upl_cb_background_colour', true);

		    // Output the custom field that storeds the page excerpt
		   	$HTML = '<div id="ubam-campaign-banner-container">';
		    $HTML .= '<a href="' . $banner['clickURL'] . '"><img src="' . $banner['imageURL']  . '" />';
		    $HTML .= '<div style="font-size: ' . $banner['textSize'] . 'px; color: ' . $banner['textColour'] . '; background: ' . $banner['boxColour'] . ';">' . $banner['responsiveText'] . '</div></a></div>';

		    // Add in a media query to take care of the text size on mobile. Nice hack!
	        $HTML .= '<style type="text/css">';
	        	$HTML .= '@media only screen and (max-width: 750px) {';
	        		$HTML .= '#ubam-campaign-banner-container div {';
	        			$HTML .= 'font-size: ' . ($banner['textSize'] - 2) . 'px !important;';
	        		$HTML .= '}';
	        	$HTML .= '}';
	        $HTML .= '</style>';

		} else {

		    // Don't display this block

		}

		return $HTML;

	}

	/**
	 * Generates the HTML for in article banners
	 * parameters: mbSettings -  array of banner settings
     *             mbClass - CSS class
     *             display - default visibility true = visible, false = hidden
	 * @since 	    1.0.0
	 * @return 		string 		$HTML 		Output HTML from the shortcode
	 */
    public function show_banner ($mbsettings, $mbclass, $mbdisplay) {

		$HTML = '';

            if($mbclass != '') {
                $mbclass = 'class="' . $mbclass .'" ';
            }

            if(!$mbdisplay) {
                $display = 'style="display:none;" ' ;
            } else {
                $display = '';
            }

            $HTML .= '<div ' . $mbclass . $display . ' id="ubam-article-mobile-banner-container" >';
                $HTML .= '<a class="ubam-banner-link" href="' . $mbsettings['click_url'] . '"';
                if ($mbsettings['click_new_window']) {
                    $HTML .= ' target="_blank"';
                }
                $HTML .= '><img class="ubam-desktop-img" src="' . $mbsettings['desktop_image_url'] . '"/>';
                $HTML .= '<img class="ubam-mobile-img" src="' . $mbsettings['image_url'] . '"/>';

                if ($mbsettings['show_text']) {

                  $HTML .= '<div class="ubam-article-mobile-banner-textbox" style=" font-size: ' . $mbsettings['text_size'] . 'px; color: ' . $mbsettings['text_colour'] . '; background: ' . $mbsettings['back_colour'] . '; border-top: 2px solid #a099cb;">' . $mbsettings['text'] . '</div>';

                }

                $HTML .= '</a><div class="ubam-article-mobile-banner-spacer"></div></div>';


		return $HTML;

	}


    /**
     * Create a banner mid article for desktop and mobile.
     *
     * Grabs the settings from the Uplift_Article_Meta_Admin_Settings object and displays the banner mid article
     *
     * @since 		1.0.0
     * @return 		string 		$HTML 		Output HTML from the shortcode
     */
    public function show_mobile_banner () {

        $HTML = '';
        $mbName = get_post_meta($this->postID, '_upl_mb_banner_name', true);

        if (get_post_meta ($this->postID, '_upl_mb_show_banner', true) && $mbName != null) {

            $mbSettingsObj = new Uplift_Article_Meta_Admin_Settings ();
            $mbSettings = $mbSettingsObj->get_mobile_banner ($mbName);
            $mbclass = $mbSettings['class'];

            $HTML = $this->show_banner($mbSettings, $mbclass, true);

        }

        return $HTML;

    }

    /**
     * Create a sign up banner mid article for desktop and mobile.
     * If the user is already subscribed to the weekly list then show alternate banner in its place
     *
     * @since 		1.0.0
     * @param 		array 		$atts 		Shortcode parameters
     * @return 		string 		$HTML 		Output HTML from the shortcode
     */
    public function show_signup_banner () {

        $HTML_SignUp_Weekly = '';
        $HTML_SignUp_Alt = '';
        $HTML = '';
        $email = '';

        // get user email from cookie if is set

        if(!isset($_COOKIE[WP_HOME])) {

            $cookieContent = base64_decode($_COOKIE["upllfe-subscribe"]);

            if ($cookieContent !=  '') {

                $myArray = explode(';', $cookieContent);

                foreach($myArray as $val) {

                    if (strchr($val, "email") != '') {
                        $email = substr($val, strrpos($val, ":") + 1, strlen($val) - (strrpos($val, ":")));
                    }
                }
            }
        }

        $mc = new MailChimp('UPLIFT');
        $signUpWeekly = $mc->checkSignupStatus($email, true);
        $mbSettingsObj = new Uplift_Article_Meta_Admin_Settings ();

        if (get_post_meta($this->postID, '_upl_mb_show_signup_banner', true)) {   //checkbox is true for sign up banner

            // get the alternate banner html if been defined
            $mbAltName = get_post_meta($this->postID, '_upl_mb_altsignup_banner_name', true);

            if (!$signUpWeekly){         // user hasn't signed up for weekly list

                $mbSettings = $mbSettingsObj->get_signup_banner('Sign Up (Weekly List)');
                $mbClass = $mbSettings['class'];
                $HTML_SignUp_Weekly .= $this->show_banner($mbSettings, $mbClass, true);

                if ($mbAltName != null) {
                    $mbAltSettings = $mbSettingsObj->get_mobile_banner($mbAltName);
                    $HTML_SignUp_Alt .= $this->show_banner($mbAltSettings, 'ubam-alt-sign-up-banner', false);   //alt sign up is default hidden, and has div class default
                }

                $HTML .= $HTML_SignUp_Weekly .  $HTML_SignUp_Alt;

            } else {

                if ($mbAltName != null) {
                    $mbAltSettings = $mbSettingsObj->get_mobile_banner($mbAltName);
                    $HTML .= $this->show_banner($mbAltSettings, 'ubam-alt-sign-up-banner', true);
                }
            }
       }

        return $HTML;

    }


    /**
	 * Create the author, publication date & time at the top of the article
	 *
	 * @since 		1.0.0
	 * @return 		string 		$HTML 		Output HTML from the shortcode
	 */
	public function show_author() {

		$HTML = '';
    	$upl_publish_time = get_the_time('l F jS, Y', $this->postID);

	    // Handle the reblog situation
	    if (get_post_meta ($this->postID, '_upl_rebl_is_reblog', true )) {

        	$upl_reblog_author = get_post_meta ($this->postID, '_upl_rebl_author_name', true );
        	$upl_reblog_author_url = get_post_meta ($this->postID, '_upl_rebl_author_url', true );
    
        	if ($upl_reblog_author_url == '') {
                
            	$HTML .= '<p>By ' . $upl_reblog_author . ' on ' . $upl_publish_time . '</p>';
        
        	} else {
    
            	$HTML .= '<p>By <a href="' . $upl_reblog_author_url . '" target="_blank">' . $upl_reblog_author . '</a> on ' . $upl_publish_time . '</p>';
    
        	}
        
    	// Handle the Guest Post situation    
    	} else if (get_post_meta ($this->postID, '_upl_gp_is_guest_post', true )) {

        	$HTML .= '<p>By ';

        	$upl_gp_primary_author = get_post_meta ($this->postID, '_upl_gp_author_primary_name', true );
        	$upl_gp_primary_author_url = get_post_meta ($this->postID, '_upl_gp_author_primary_url', true );
        	$upl_gp_co_author = get_post_meta ($this->postID, '_upl_gp_author_co_name', true );
        	$upl_gp_co_author_url = get_post_meta ($this->postID, '_upl_gp_author_co_url', true );

        	// Handle the Primary Author
        	if ($upl_gp_primary_author_url !== '') {
                    
            	$HTML .= '<a href="' . $upl_gp_primary_author_url . '" target="_blank">' . $upl_gp_primary_author . '</a>';
                        
        	} else {
                    
            	$HTML .= $upl_gp_primary_author;
                        
        	}
                    
        	// Handle the Co-Author
        	if ($upl_gp_co_author !== '') {
                    
            	if ($upl_gp_co_author_url !== '') {
                        
                	$HTML .= ' &amp; <a href="' . $upl_gp_co_author_url . '" target="_blamk">' . $upl_gp_co_author . '</a>';
                            
            	} else {
                        
                	$HTML .= ' &amp; ' . $upl_gp_co_author;
                            
            	}
        	}
                    
        	$HTML .= ' on ' . $upl_publish_time . '</p>';

    	// Otherwise just output the author
    	} else {

//        	$HTML .= '<p>By <a href="' . get_author_posts_url (get_the_author_meta ($this->postID)) . '"> ' . get_the_author() . '</a> on ' . $upl_publish_time . '</p>';
            $authorID = get_post_field ('post_author', $this->postID);
            $HTML .= '<p>By <a href="' . get_the_author_meta ("user_url", $authorID) . '" target="_blank">' . get_the_author_meta ('display_name', $authorID) . '</a> on ' . $upl_publish_time . '</p>';

    	}

    	return $HTML;

	}

	/**
	 * Create the author, publication date & time at the top of the article
	 *
	 * @since 		1.0.0
	 * @return 		string 		$HTML 		Output HTML from the shortcode
	 */
	public function show_attribution() {

		$HTML = '';

        // If the Article is a reblog
        if ( get_post_meta ($this->postID, '_upl_rebl_is_reblog', true )) {
                
           	// Get the Author mets
           	$upl_reblog_author = get_post_meta ($this->postID, '_upl_rebl_author_name', true );
          	$upl_reblog_author_url = get_post_meta ($this->postID, '_upl_rebl_author_url', true );
            $upl_reblog_site_name = get_post_meta ($this->postID, '_upl_rebl_original_site_name', true );
            $upl_reblog_site_description = get_post_meta($this-> postID, '_upl_rebl_original_site_description', true);


            $upl_reblog_original_url = get_post_meta ($this->postID, '_upl_rebl_original_url', true );

            if ($upl_reblog_author_url == '') {

                $HTML .= '<h3>Words By ' . $upl_reblog_author . '</h3>';
                    
            } else {
                    
                $HTML .= '<h3>Words By <a href="' . $upl_reblog_author_url . '" target="_blank">' . $upl_reblog_author . '</a></h3>';

            }    

            $HTML .= '<p>Originally posted on <a href="' . $upl_reblog_original_url . '" target="_blank">' . $upl_reblog_site_name . '</a>'. (($upl_reblog_site_description !== '') ? ', ' . $upl_reblog_site_description : '') .'</p>';

                
        // If the Article is a Guest Post    
        } else if ( get_post_meta ($this->postID, '_upl_gp_is_guest_post', true )) {

            $HTML .= '<h3>Words By ';

            $upl_gp_primary_author = get_post_meta ($this->postID, '_upl_gp_author_primary_name', true );
            $upl_gp_primary_author_url = get_post_meta ($this->postID, '_upl_gp_author_primary_url', true );
            $upl_gp_co_author = get_post_meta ($this->postID, '_upl_gp_author_co_name', true );
            $upl_gp_co_author_url = get_post_meta ($this->postID, '_upl_gp_author_co_url', true );
            $upl_gp_author_bio = get_post_meta ($this->postID, '_upl_gp_author_bio', true );
                    
            // Handle the Primary Author
            if ($upl_gp_primary_author_url !== '') {
                    
               	$HTML .='<a href="' . $upl_gp_primary_author_url . '" target="_blank">' . $upl_gp_primary_author . '</a>';
                        
            } else {
                    
               	$HTML .= $upl_gp_primary_author;
                        
            }
                    
            // Handle the Co-Author
           	if ($upl_gp_co_author !== '') {
                    
                if ($upl_gp_co_author_url !== '') {
                        
                  	$HTML .= ' &amp; <a href="' . $upl_gp_co_author_url . '" target="_blamk">' . $upl_gp_co_author . '</a>';
                            
                } else {
                        
                    $HTML .= ' &amp; ' . $upl_gp_co_author;
                            
              	}
                       
            }
                    
            $HTML .= '</h3>';
                    
            if ($upl_gp_author_bio !== '' ) {
                    
                $HTML .='<p>' . $upl_gp_author_bio . '</p>';

            }
                    
        } else {
                
          	$HTML .= '<h3><a href="' . get_the_author_meta( "user_url" ) . '" target="_blank">' . get_the_author() . '</a></h3>';
           	$HTML .= '<p>' . get_the_author_meta('description') . '</p>';
                    
        }

        return $HTML;

	}

    /**
     * Create the Feature Image Credit at the top of the article
     *
     * @since 		1.0.0
     * @return 		string 		$HTML 		Output HTML from the shortcode
     */
    public function show_feature_image_credit() {

        $HTML = '';

        $upl_feature_image_credit = get_post_meta ($this->postID, '_upl_feature_image_credit', true );
        $upl_feature_image_credit_url = get_post_meta ($this->postID, '_upl_feature_image_credit_url', true );

        // Show the feature image credit
        if ($upl_feature_image_credit !== '' &&  $upl_feature_image_credit !== "Artist Unknown" ) {

            $HTML .= '<p id="upl-art-feature-image-credit-para">Image: ';

            if ($upl_feature_image_credit_url !== '') {

                $HTML .= '<a href="' .  $upl_feature_image_credit_url . '" target="_blank">';

            }

            $HTML .= $upl_feature_image_credit;
            $HTML .= ($upl_feature_image_credit_url !== '') ? '</a></p>' : '<p>';

        }

        return $HTML;
    }

    /**
     * Create the Read Next button at the bottom of the article
     * Referenced by Join The Conversation block
     * @since 		1.0.0
     * @return 		string 		$HTML 		Output HTML from the shortcode
     */
    public function show_read_next_button() {

        $readnextarticleid = get_post_meta ($this->postID, '_upl_read_next_article', true);
        $readnextbuttontext = get_post_meta ($this->postID, '_upl_read_next_button', true);
        $readnexturl = get_post_permalink ( $readnextarticleid, false, false );

        $HTML = '';

        if (($readnextarticleid !== '') && ($readnextbuttontext !== '')) {

            //$readnextbuttontext = 'Read Next: ' . get_the_title($readnextarticleid);

            $HTML .=  '<p><a href="'. $readnexturl . '">';
            $HTML .=  '<div id="upllfe-art-readnext-button" class="upllfe-article-meta-button" >';
            $HTML .= '<span class="upllfe-article-meta-button-text">' . $readnextbuttontext . '</span>';
            $HTML .=  '</div>';
            $HTML .=  '</a><br><br></p>';

        }

        return $HTML;

    }

}