<?php

/**
 *
 * @link              https://agilestorelocator.com
 * @since             1.0.0
 * @package           AgileStoreLocator
 *
 * @wordpress-plugin
 * Plugin Name:       Agile Store Locator
 * Plugin URI:        http://agilestorelocator.com
 * Description:       Agile Store Locator is a WordPress Plugin that renders stores list with google maps V3 API. Paste ShortCode [ASL_STORELOCATOR] in your page/post.
 * Version:           1.0.0
 * Author:            AGILELOGIX
 * Author URI:        https://agilestorelocator.com/
 * License:           Copyrights 2016
 * License URI:       
 * Text Domain:       asl_locator
 * Domain Path:       /languages/
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'AGILESTORELOCATOR_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'AGILESTORELOCATOR_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'AGILESTORELOCATOR_PREFIX', $wpdb->prefix."asl_" );
define( 'AGILESTORELOCATOR_PLUGIN_BASE', dirname( plugin_basename( __FILE__ ) ) );


global $wp_version;


if (version_compare($wp_version, '3.3.2', '<=')) {
	//die('version not supported');
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-agile-store-locator-activator.php
 */
function activate_AgileStoreLocator() {
	require_once AGILESTORELOCATOR_PLUGIN_PATH . 'includes/class-agile-store-locator-activator.php';
	AgileStoreLocator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-agile-store-locator-deactivator.php
 */
function deactivate_AgileStoreLocator() {
	require_once AGILESTORELOCATOR_PLUGIN_PATH . 'includes/class-agile-store-locator-deactivator.php';
	AgileStoreLocator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_AgileStoreLocator' );
register_deactivation_hook( __FILE__, 'deactivate_AgileStoreLocator' );



/*
function asl_filter_mce_css( $mce_css ) {
	global $current_screen;
	
	//[base] => as-locator_page_infobox-maker
	if($current_screen->parent_base == 'asl-plugin')
		$mce_css .= ', ' . plugins_url( 'public/css/blue/all-css.min.css', __FILE__ ).', ' .plugins_url( 'public/css/test2c0.css', __FILE__ );
	
	return $mce_css;
}
add_filter( 'mce_css', 'asl_filter_mce_css' );

*/


 function asl_filter_mce_css( $mce ) {
	global $current_screen;

	if($current_screen->parent_base == 'asl-plugin') {
		$mce_css .= ', ' . plugins_url( 'public/css/all-css.min' . '.css', __FILE__ );
		$mce_css .= ', ' . plugins_url( 'public/css/blue/test2c0' . '.css', __FILE__ );
	}
	return $mce_css;
}
add_filter( 'mce_css', 'asl_filter_mce_css' );







/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require AGILESTORELOCATOR_PLUGIN_PATH . 'includes/class-agile-store-locator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_AgileStoreLocator() {

	$plugin = new AgileStoreLocator();
	$plugin->run();
}

run_AgileStoreLocator();
