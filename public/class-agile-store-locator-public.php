<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://agilelogix.com
 * @since      1.0.0
 *
 * @package    AgileStoreLocator
 * @subpackage AgileStoreLocator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    AgileStoreLocator
 * @subpackage AgileStoreLocator/public
 * @author     Your Name <email@agilelogix.com>
 */
class AgileStoreLocator_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $AgileStoreLocator    The ID of this plugin.
	 */
	private $AgileStoreLocator;

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
	 * @param      string    $AgileStoreLocator       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $AgileStoreLocator, $version ) {

		$this->AgileStoreLocator = $AgileStoreLocator;
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
		 * defined in AgileStoreLocator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The AgileStoreLocator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->AgileStoreLocator.'-all-css',  AGILESTORELOCATOR_URL_PATH.'public/css/all-css.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->AgileStoreLocator.'-asl-responsive',  AGILESTORELOCATOR_URL_PATH.'public/css/asl_responsive.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->AgileStoreLocator.'-asl',  AGILESTORELOCATOR_URL_PATH.'public/css/asl.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in AgileStoreLocator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The AgileStoreLocator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$title_nonce = wp_create_nonce( 'asl_remote_nonce' );
		
		
		global $wp_scripts,$wpdb;

		$sql = "SELECT `key`,`value` FROM ".AGILESTORELOCATOR_PREFIX."configs WHERE `key` = 'api_key'";
		$all_result = $wpdb->get_results($sql);
		

		$map_url = '//maps.googleapis.com/maps/api/js?libraries=places,drawing';

		if($all_result[0] && $all_result[0]->value) {
			$api_key = $all_result[0]->value;

			$map_url .= '&key='.$api_key;
		}

		

		//dd($wp_scripts->registered);
		wp_enqueue_script('google-map', $map_url );
		wp_enqueue_script( $this->AgileStoreLocator.'-lib', AGILESTORELOCATOR_URL_PATH . 'public/js/libs_new.min.js', array('jquery'), $this->version, false );
		wp_enqueue_script( $this->AgileStoreLocator.'-script', AGILESTORELOCATOR_URL_PATH . 'public/js/site_script.js', array('jquery'), $this->version, false );
		wp_localize_script( $this->AgileStoreLocator.'-script', 'ASL_REMOTE', array(
		    'ajax_url' => admin_url( 'admin-ajax.php' ),
		    'nonce'    => $title_nonce // It is common practice to comma after
		) );
	}


	public function load_stores()
	{
		//header('Content-Type: application/json');
		global $wpdb;
				

		$nonce = isset($_GET['nonce'])?$_GET['nonce']:null;
		if ( ! wp_verify_nonce( $nonce, 'asl_remote_nonce' ))
 			die ( 'CRF check error.');


		$AGILESTORELOCATOR_PREFIX = AGILESTORELOCATOR_PREFIX;

		$bound   = '';

		$extra_sql = '';
		$country_field = '';

		

		$query   = "SELECT s.`id`, `title`,  `description`, `street`,  `city`,  `state`, `postal_code`, {$country_field} `lat`,`lng`,`phone`,  `fax`,`email`,`website`,`logo_id`,{$AGILESTORELOCATOR_PREFIX}storelogos.`path`,
					group_concat(category_id) as categories FROM {$AGILESTORELOCATOR_PREFIX}stores as s 
					LEFT JOIN {$AGILESTORELOCATOR_PREFIX}storelogos ON logo_id = {$AGILESTORELOCATOR_PREFIX}storelogos.id
					LEFT JOIN {$AGILESTORELOCATOR_PREFIX}stores_categories ON s.`id` = {$AGILESTORELOCATOR_PREFIX}stores_categories.store_id
					$extra_sql
					WHERE (is_disabled is NULL || is_disabled = 0) 
					GROUP BY s.`id` ";

		$query .= "LIMIT 1000";

		
		$all_results = $wpdb->get_results($query);


		echo json_encode($all_results);die;
	}

}
