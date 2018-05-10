<?php

/**
 * Stores the settings for the Campaign Banners and Mobile Banners.
 *
 * This is here until the admin pages are built to create banners and store them via the Settings API.
 * Holds all the settings for the banners in Arrays. This class will do the abstractiin so that this can
 * be changed when I have time to write the admin settings pages.
 *
 * @link       //techknowsystems.com.au
 * @since      1.0.0
 *
 * @package    Uplift_Article_Meta
 * @subpackage Uplift_Article_Meta/admin
 */

/**
 * The Settings pages abstraction class.
 *
 * @package    Uplift_Article_Meta
 * @subpackage Uplift_Article_Meta/admin
 * @author     Shaa Taylor <shaa@uplift.global>
 */
class Uplift_Article_Meta_Admin_Settings {

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
	 * The array of campaign banners
	 *
     * Acts like a constant. This will eventually be abstracted and stored in the WPDB
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $campaignBanners    The 'constant' array of campaign banners
	 */
	private $campaignBanners = [];

	/**
	 * The array of mobile banners
	 *
     * Acts like a constant. This will eventually be abstracted and stored in the WPDB
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $mobileBanners    The 'constant' array of mobile banners
	 */
	private $mobileBanners = [];


    /**
     * The array of signup banners
     *
     * Acts like a constant. This will eventually be abstracted and stored in the WPDB
     *
     * @since    1.0.0
     * @access   private
     * @var      array    $signupBanners    The 'constant' array of signup banners
     */
    private $signupBanners = [];

	/**
	 * Initialize the admon settings class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name   The name of this plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct() {

//		$this->plugin_name = $plugin_name;
//		$this->version = $version;

		// Banners at the bottom of articles. Only one size for both Desktop and Mobile.
		// responsive_text is the text shown on mobile.
		$this->campaignBanners = array ( 
			'UPLIFT TV' => array (
					'show' => true,
					'click_url' => '//uplift.tv/',
					'click_new_window' => true,
					'image_url' => WP_HOME . '/wp-content/uploads/2017/11/UPLIFTtvCampaignBanner.jpg',
					'text' => esc_attr__("Watch all the UPLIFT films free on our new video platform!", 'uplift-article-meta'),
					'responsive_text' => __("Watch all the UPLIFT films free \Aon our new video platform!", 'uplift-article-meta'),
					'text_size' => 20,
					'text_colour' => '#eee',
					'back_colour' => '#000000', //#f67f03
			),
			'Building Compassion' => array (
					'show' => true,
					'click_url' => '//uplift.tv/2017/watch-building-compassion/',
					'click_new_window' => true,
					'image_url' => WP_HOME . '/wp-content/uploads/2018/04/BuildingCompassionCampaignBannerEvergreenedReplacementPic.jpg',
					'text' => esc_attr__("Join the Campaign to Build a More Compassionate World.", 'uplift-article-meta'),
					'responsive_text' => __("Join the Campaign to Build a \AMore Compassionate World.", 'uplift-article-meta'),
					'text_size' => 20,
					'text_colour' => '#fff',
					'back_colour' => '#003284', //#f67f03
			),
			'The Inner Peace Revolution' => array (
					'show' => true,
					'click_url' => '//uplift.tv/2017/inner-peace-revolution-film/',
					'click_new_window' => false,
					'image_url' => WP_HOME . '/wp-content/uploads/2016/09/InnerPeaceRevolutionBannerBottomOfArticle.jpg',
					'text' => esc_attr__("Click here to Watch the 'Join the Inner Peace Revolution' film", 'uplift-article-meta'),
					'responsive_text' => __("Click here to Watch\A 'Join the Inner Peace Revolution'", 'uplift-article-meta'),
					'text_size' => 20,
					'text_colour' => '#fff',
					'back_colour' => '#003284', //#f67f03
			),
			'The Science Behind Yoga' => array (
					'show' => true,
					'click_url' => '//uplift.tv/2017/watch-science-behind-yoga/',
					'click_new_window' => false,
					'image_url' => WP_HOME . '/wp-content/uploads/2016/07/ScienceBehindYogaBannerInArticle2.jpg',
					'text' => esc_attr__("Click here to watch 'The Science Behind Yoga' film", 'uplift-article-meta'),
					'responsive_text' => __("Click here to watch\A 'The Science Behind Yoga' film", 'uplift-article-meta'),
					'text_size' => 20,
					'text_colour' => '#fff',
					'back_colour' => '#003284', //#f67f03
			),
			'Yoga Day Summit 2016' => array (
					'show' => true,
					'click_url' => '//uplift.tv/',
					'click_new_window' => true,
					'image_url' => WP_HOME . '/wp-content/uploads/2016/06/YogaSummitBannerInArticleAFTER-1.jpg',
					'text' => esc_attr__("Click here to watch the Yoga Day Summit video", 'uplift-article-meta'),
					'responsive_text' => __("Click here to watch the\A Yoga Day Summit video", 'uplift-article-meta'),
					'text_size' => 20,
					'text_colour' => '#fff',
					'back_colour' => '#3f4d08', //#f67f03
			),
			'Water is Sacred' => array (
					'show' => true,
					'click_url' => '//blessthewater.com/bless-the-water-video/',
					'click_new_window' => true,
					'image_url' => WP_HOME . '/wp-content/uploads/2016/03/WaterIsSacredBannerArticles.png',
					'text' => esc_attr__("Click here to watch 'Water is Sacred' the film", 'uplift-article-meta'),
					'responsive_text' => __("Click here to watch \'Water is Sacred\' the film", 'uplift-article-meta'),
					'text_size' => 20,
					'text_colour' => '#fff',
					'back_colour' => '#003284',
			),
			'The Science Behind Yoga and Stress' => array (
					'show' => true,
					'click_url' => '//upliftconnect.com/yoga-and-stress-video/',
					'click_new_window' => false,
					'image_url' => WP_HOME . '/wp-content/uploads/2015/11/ysBannerArticles.png',
					'text' => esc_attr__("The Science Behind Yoga and Stress - Click here to watch it FREE online", 'uplift-article-meta'),
					'responsive_text' => __("Click here to watch the FREE short film\A\'The Science Behind Yoga and Stress\'", 'uplift-article-meta'),
					'text_size' => 20,
					'text_colour' => '#fff',
					'back_colour' => '#003284',
			),
			'The Science of Breathing' => array (
					'show' => true,
					'click_url' => '//uplift.tv/2017/breathing-in-yoga-video/',
					'click_new_window' => false,
					'image_url' => WP_HOME . '/wp-content/uploads/2016/02/ScienceOfBreathingBannerArticles.png',
					'text' => esc_attr__("Click here to watch the FREE short film 'The Science of Breathing'", 'uplift-article-meta'),
					'responsive_text' => __("Click here to watch the FREE short film\A\'The Science of Breathing\'", 'uplift-article-meta'),
					'text_size' => 20,
					'text_colour' => '#fff',
					'back_colour' => '#003284',
			),
			'Yoga for Change' => array (
					'show' => true,
					'click_url' => '//upliftconnect.com/yoga-for-change-video/',
					'click_new_window' => false,
					'image_url' => WP_HOME . '/wp-content/uploads/2015/10/yoga-for-change-banner.jpg',
					'text' => esc_attr__("Click here to watch the free 45 minute documentary 'Yoga for Change'", 'uplift-article-meta'),
					'responsive_text' => __("Click here to watch the FREE\A 45 minute film \'Yoga for Change\'", 'uplift-article-meta'),
					'text_size' => 20,
					'text_colour' => '#fff',
					'back_colour' => '#003284',
			),
			'Inner Peace to World Peace' => array (
					'show' => true,
					'click_url' => '//upliftconnect.com/peace-day-video/',
					'click_new_window' => false,
					'image_url' => WP_HOME . '/wp-content/uploads/2015/10/inner-peace-world-peace-banner.jpg',
					'text' => esc_attr__("Click here to watch the FREE film 'Inner Peace to World Peace'", 'uplift-article-meta'),
					'responsive_text' => __("Click here to watch the FREE film\A\'Inner Peace to World Peace\'", 'uplift-article-meta'),
					'text_size' => 20,
					'text_colour' => '#fff',
					'back_colour' => '#003284',
			),
            'Bless The Water 2017' => array (
                    'show' => true,
                    'click_url' => '//uplift.tv/',
                    'click_new_window' => false,
                    'image_url' => WP_HOME . '/wp-content/uploads/2017/03/BTWcampaingBanner.jpg',
                    'text' => esc_attr__("Click here to join us on World Water Day to Bless The Water", 'uplift-article-meta'),
                    'responsive_text' => __("Join us on World Water Day to Bless The Water", 'uplift-article-meta'),
                    'text_size' => 20,
                    'text_colour' => '#fff',
                    'back_colour' => '#003284',
            ),
            'Water Is Life' => array (
                    'show' => true,
                    'click_url' => '//uplift.tv/',
                    'click_new_window' => false,
                    'image_url' => WP_HOME . '/wp-content/uploads/2017/03/WaterIsLifecampaignBanner.jpg',
                    'text' => esc_attr__("Click here to watch the new UPLIFT film free", 'uplift-article-meta'),
                    'responsive_text' => __("Watch the new UPLIFT film free", 'uplift-article-meta'),
                    'text_size' => 20,
                    'text_colour' => '#fff',
                    'back_colour' => '#003284',
            ),
            'The Hunger Project 2017' => array (
                    'show' => true,
                    'click_url' => '//uplift.tv/2017/watch-we-have-the-power/',
                    'click_new_window' => false,
                    'image_url' => WP_HOME . '/wp-content/uploads/2017/05/WeHaveThePowerBannerInArticleMobileEvergreened.jpg',
                    'text' => esc_attr__("Click here to watch the new UPLIFT film", 'uplift-article-meta'),
                    'responsive_text' => __("Click here to watch the new UPLIFT film", 'uplift-article-meta'),
                    'text_size' => 20,
                    'text_colour' => '#fff',
                    'back_colour' => '#003284',
            ),
            'Yoga Day Summit 2017' => array (
                    'show' => true,
                    'click_url' => '//uplift.tv/',
                    'click_new_window' => false,
                    'image_url' => WP_HOME . '/wp-content/uploads/2017/06/YogaSummitCampaignBanner.jpg',
                    'text' => esc_attr__("Register now for your FREE PASS and watch the premiere of 'The New Science Behind Yoga’", 'uplift-article-meta'),
                    'responsive_text' => __("Register now for your FREE PASS and watch the premiere of 'The New Science Behind Yoga’", 'uplift-article-meta'),
                    'text_size' => 20,
                    'text_colour' => '#fff',
                    'back_colour' => '#003284',
            ),
            'New Science Behind Yoga Film 2017' => array (
                    'show' => true,
                    'click_url' => '//upliftconnect.com/watch-new-science-behind-yoga/',
                    'click_new_window' => false,
                    'image_url' => WP_HOME . '/wp-content/uploads/2017/06/NewScienceBehindYogaBannerInArticle.jpg',
                    'text' => esc_attr__("Watch the new UPLIFT film for free here", 'uplift-article-meta'),
                    'responsive_text' => __("Watch the new UPLIFT film for free here", 'uplift-article-meta'),
                    'text_size' => 20,
                    'text_colour' => '#fff',
                    'back_colour' => '#003284',
            )          
		);

		// In-Article banners. Come in 2 different sizes for Desktop & Mobile.
		$this->mobileBanners = array (
			'Building Compassion' => array (
					'show' => true,
					'click_url' => '//uplift.tv/2017/watch-building-compassion/',
					'click_new_window' => true,
					'desktop_image_url' => WP_HOME . '/wp-content/uploads/2018/04/BuildingCompassionInArticleBannerEvergreenedPicReplacement.jpg',
					'image_url' => WP_HOME . '/wp-content/uploads/2018/04/BuildingCompassionInArticleBannerEvergreenedPicReplacement.jpg',
					'show_text' => false,
					'text' => '',
					'text_size' => 16,
					'text_colour' => '#fff',
					'back_colour' => '#003284', // #003284
			),
			'The Inner Peace Revolution' => array (
					'show' => true,
					'click_url' => '//uplift.tv/2017/inner-peace-revolution-film/',
					'click_new_window' => false,
					'desktop_image_url' => WP_HOME . '/wp-content/uploads/2016/09/InnerPeaceRevolutionInArticleBanner.jpg',
					'image_url' => WP_HOME . '/wp-content/uploads/2016/09/InnerPeaceRevolutionInArticleBannerMOBILE.jpg',
					'show_text' => false,
					'text' => '',
					'text_size' => 16,
					'text_colour' => '#fff',
					'back_colour' => '#003284', // #003284
			),
			'The Science Behind Yoga' => array (
					'show' => true,
					'click_url' => '//uplift.tv/2017/watch-science-behind-yoga/',
					'click_new_window' => false,
					'desktop_image_url' => WP_HOME . '/wp-content/uploads/2016/07/ScienceBehindYogabannerArticlesDesktop.jpg',
					'image_url' => WP_HOME . '/wp-content/uploads/2016/07/ScienceBehindYogabannerArticlesMobile2.jpg',
					'show_text' => false,
					'text' => '',
					'text_size' => 16,
					'text_colour' => '#fff',
					'back_colour' => '#003284', // #003284
			),
			'Yoga Day Sumit 2016' => array (
					'show' => true,
					'click_url' => '//iplift.tv/',
					'click_new_window' => true,
					'desktop_image_url' => WP_HOME . '/wp-content/uploads/2016/06/YDSbannerArticlesDesktopAFTER.jpg',
					'image_url' => WP_HOME . '/wp-content/uploads/2016/06/YogaSummitBannerInArticleAFTER-1.jpg',
					'show_text' => false,
					'text' => '',
					'text_size' => 16,
					'text_colour' => '#fff',
					'back_colour' => '#75872b', // #003284
			),
			'Water is Sacred' => array (
					'show' => true,
					'click_url' => '//uplift.tv/',
					'click_new_window' => true,
					'desktop_image_url' => WP_HOME . '/wp-content/uploads/2016/05/waterIsSacredMobileBanner.png',
					'image_url' => WP_HOME . '/wp-content/uploads/2016/05/waterIsSacredMobileBanner.png',
					'show_text' => false,
					'text' => '',
					'text_size' => 16,
					'text_colour' => '#fff',
					'back_colour' => '#003284',
			),
            'Bless the Water 2017' => array (
                    'show' => true,
                    'click_url' => '//uplift.tv',
                    'click_new_window' => true,
                    'desktop_image_url' => WP_HOME . '/wp-content/uploads/2017/03/BlessTheWater2017MobileBanner.jpg',
                    'image_url' => WP_HOME . '/wp-content/uploads/2017/03/BlessTheWater2017MobileBanner.jpg',
                    'show_text' => false,
                    'text' => '',
                    'text_size' => 16,
                    'text_colour' => '#fff',
                    'back_colour' => '#003284',
            ),
            'Water Is Life' => array (
                      'show' => true,
                      'click_url' => '//uplift.tv',
                      'click_new_window' => true,
                      'desktop_image_url' => WP_HOME . '/wp-content/uploads/2017/03/WaterIsLifeCampaignBannerSkinny.jpg',
                      'image_url' => WP_HOME . '/wp-content/uploads/2017/03/WaterIsLifeCampaignBannerSkinny.jpg',
                      'show_text' => false,
                      'text' => '',
                      'text_size' => 16,
                      'text_colour' => '#fff',
                      'back_colour' => '#003284',
              ),
            'The Hunger Project 2017' => array (
                      'show' => true,
                      'click_url' => '//uplift.tv/2017/watch-we-have-the-power/',
                      'click_new_window' => true,
                      'desktop_image_url' => WP_HOME . '/wp-content/uploads/2017/05/WeHaveThePowerBannerInArticleSkinnyEvergreened.jpg',
                      'image_url' => WP_HOME . '/wp-content/uploads/2017/05/WeHaveThePowerBannerInArticleEvergreened.jpg',
                      'show_text' => false,
                      'text' => '',
                      'text_size' => 16,
                      'text_colour' => '#fff',
                      'back_colour' => '#003284',
              ),
            'Yoga Day Summit 2017' => array (
                      'show' => true,
                      'click_url' => '//uplift.tv',
                      'click_new_window' => true,
                      'desktop_image_url' => WP_HOME . '/wp-content/uploads/2017/06/YDSbannerInArticle2017.jpg',
                      'image_url' => WP_HOME . '/wp-content/uploads/2017/06/YDSbannerInArticle2017.jpg',
                      'show_text' => false,
                      'text' => '',
                      'text_size' => 16,
                      'text_colour' => '#fff',
                      'back_colour' => '#003284',
            ),
          	'New Science Behind Yoga Film 2017' => array (
                      'show' => true,
                      'click_url' => '//upliftconnect.com/watch-new-science-behind-yoga/',
                      'click_new_window' => true,
                      'desktop_image_url' => WP_HOME . '/wp-content/uploads/2017/08/NewScienceBehindYogaBannerInArticleSkinny_New.jpg',
                      'image_url' => WP_HOME . '/wp-content/uploads/2017/08/NewScienceBehindYogaBannerInArticleSkinny_New.jpg',
                      'show_text' => false,
                      'text' => '',
                      'text_size' => 16,
                      'text_colour' => '#fff',
                      'back_colour' => '#003284',
            )
		);

		// To display a banner for signing up to a list.
        $this->signupBanners = array (
            'Sign Up (Weekly List)' => array (
                'show' => true,
                'click_url' => '#',
                'click_new_window' => false,
                'desktop_image_url' => WP_HOME . '/wp-content/uploads/2016/11/UpliftWeeklySignUpBannerDesktop.jpg',
                'image_url' => WP_HOME . '/wp-content/uploads/2016/11/UpliftWeeklySignUpBannerMobile.jpg',
                'show_text' => false,
                'text' => '',
                'text_size' => 16,
                'text_colour' => '#fff',
                'back_colour' => '#003284',
                'class' => 'ubam-sign-up-banner',
            )
        );
	}

	/**
	 * Get the campaign banner private array.
	 *
	 * @since    	1.0.0
	 * @access 	 	public
     * @param 		string    	$bannerName     The name of the required sign up banner. Leave blank for entire array
	 * @param 		bool 		$keysOnly		Just return keys only - for use in dropdowns on Metaboxes
	 * @return 		array 						Keys, array subset or entire array, depending on how it is called.
	 */
	public function get_campaign_banner ($bannerKey = '', $keysOnly = false) {

		if ($bannerKey !== '') {

			return $this->campaignBanners[$bannerKey];

		} else {

			if ($keysOnly) {

				$dropDownKeys = [];
				foreach ($this->campaignBanners as $key=>$value) {
					$dropDownKeys[$key] = $key;
				}
				return $dropDownKeys;

			} else {

				return $this->campaignBanners;

			}

		}

	}

	/**
	 * Get the mobile banner private array.
	 *
	 * @since    	1.0.0
	 * @access 	 	public
     * @param 		string    	$bannerName     The name of the required sign up banner. Leave blank for entire array
	 * @param 		bool 		$keysOnly		Just return keys only - for use in dropdowns on Metaboxes
	 * @return 		array 						Keys, array subset or entire array, depending on how it is called.
	 */
	public function get_mobile_banner ($bannerKey = '', $keysOnly = false) {

		if ($bannerKey !== '') {

			return $this->mobileBanners[$bannerKey];

		} else {

			if ($keysOnly) {

				$dropDownKeys = [];
				foreach ($this->mobileBanners as $key=>$value) {
					$dropDownKeys[$key] = $key;
				}
				return $dropDownKeys;

			} else {

				return $this->mobileBanners;

			}

		}

	}

    /**
     * Get the signup banner private array.
     *
     * @since    	1.0.0
     * @access 	 	public
     * @param 		string    	$bannerName     The name of the required signup banner. Leave blank for entire array
     * @param 		bool 		$keysOnly		Just return keys only - for use in dropdowns on Metaboxes
     * @return 		array 						Keys, array subset or entire array, depending on how it is called.
     */
    public function get_signup_banner ($bannerKey = '', $keysOnly = false) {

        if ($bannerKey !== '') {

            return $this->signupBanners[$bannerKey];

        } else {

            if ($keysOnly) {

                $dropDownKeys = [];
                foreach ($this->signupBanners as $key=>$value) {
                    $dropDownKeys[$key] = $key;
                }
                return $dropDownKeys;

            } else {

                return $this->signupBanners;

            }

        }

    }

}