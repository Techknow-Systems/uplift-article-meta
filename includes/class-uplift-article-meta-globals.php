<?php

/**
 * Globally accessible functions
 *
 * @link		http://www.techknowsystems.com.au
 * @since		1.0.0
 *
 * @package		Uplift_Article_Meta
 * @subpackage	Uplift_Article_Meta/includes
 */

/**
 * Writes a nicely formatted error_log message
 *
 * Simply calls the Global class write_debug_log function
 *
 * @since	1.0.0
 * @var		string		$message		The message to output to the error file
 */
function uplift_article_meta_debug_log ($message) {

	Uplift_Article_Meta_Globals::write_debug_log ($message);
	
}

/**
 * The class that houses the globally accessible functions.
 *
 * @since      1.0.0
 * @package    Uplift_Article_Meta
 * @subpackage Uplift_Article_Meta/includes
 * @author     Shaa Taylor <shaa@uplift.global>
 */
class Uplift_Article_Meta_Globals {

	/**
	 * Writes a nicely formatted debug to a chosen location.
	 *
	 * NGINX is painful when it comes to debug logging as it sticks everything in the system log for the server.
	 * This function allows nicely formatted debug logging
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public static function write_debug_log ($message) {

		$dt = date("D M j Y G:i:s", time()+36000);
		$prefix = " [UPLIFT Banner Ad:] ";
		$fileLocation = "/var/log/nginx/wp-error.log";

		if (is_array($message) || is_object($message)) {

			error_log($dt . $prefix, 3, $fileLocation);
			error_log(print_r ($message) . "\n", 3, $fileLocation);
	
		} else {

			error_log($dt . $prefix . $message . "\n", 3, $fileLocation);

		}

	}	

}
