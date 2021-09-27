<?php
/**
 * Plugin Name: Brilliant Logic Slick Slider and Image Carousel Pro
 * Plugin URI: http://www.brilliantlogic.com.au
 * Description: Customised version of the Slick Slider and Image Carousel Pro 
 * Author: Brilliant Logic
 * Version: 2021.02
 * Author URI: ttp://www.brilliantlogic.com.au
 *
 * @package WordPress
 * @author WP Online Support
 */
//
// v2020.01 - Initial release
// v2020.02 - Added missing carousel templates and disable swipebox support.
// v2021.01 - Blocks CPT from WP search results
// v2021.02 - Repleased bad release
//

if( !defined( 'WPSISAC_PRO_VERSION' ) ) {
	define( 'WPSISAC_PRO_VERSION', '1.2.1' ); // Version of plugin
}
if( !defined( 'WPSISAC_PRO_PLUGIN_BASENAME' ) ) {
	define( 'WPSISAC_PRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // plugin base name
}

register_activation_hook( __FILE__, 'pro_wpsisac_install_premium_version' );
function pro_wpsisac_install_premium_version(){
if( is_plugin_active('wp-slick-slider-and-image-carousel/wp-slick-image-slider.php') ){
     add_action('update_option_active_plugins', 'pro_wpsisac_deactivate_premium_version');
    }
}
function pro_wpsisac_deactivate_premium_version(){
   deactivate_plugins('wp-slick-slider-and-image-carousel/wp-slick-image-slider.php',true);
}
add_action( 'admin_notices', 'pro_wpsisac_rpfs_admin_notice');
function pro_wpsisac_rpfs_admin_notice() {
    $dir = ABSPATH . 'wp-content/plugins/wp-slick-slider-and-image-carousel/wp-slick-image-slider.php';
    if( is_plugin_active( 'wp-slick-slider-and-image-carousel-pro/wp-slick-image-slider.php' ) && file_exists($dir)) {
        global $pagenow;
        if( $pagenow == 'plugins.php' ){
            deactivate_plugins ( 'wp-slick-slider-and-image-carousel/wp-slick-image-slider.php',true);
            if ( current_user_can( 'install_plugins' ) ) {
                echo '<div id="message" class="updated notice is-dismissible"><p><strong>Thank you for activating  WP Slick Slider and Image Carousel Pro</strong>.<br /> It looks like you had FREE version <strong>(<em> WP Slick Slider and Image Carousel</em>)</strong> of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it. </p></div>';
            }
        }
    }
} 

define( 'EDD_SLICKSPRO_STORE_URL', 'http://wponlinesupport.com' );
define( 'EDD_SLICKSPRO_ITEM_NAME', 'WP Slick Slider and Image Carousel Pro' ); 
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {	
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

function edd_sl_slickspro_plugin_updater() {
	
	$license_key = trim( get_option( 'edd_slickspro_license_key' ) );

	$edd_updater = new EDD_SL_Plugin_Updater( EDD_SLICKSPRO_STORE_URL, __FILE__, array(
			'version' 	=> WPSISAC_PRO_VERSION, 		// current version number
			'license' 	=> $license_key, 				// license key (used get_option above to retrieve from DB)
			'item_name' => EDD_SLICKSPRO_ITEM_NAME, 	// name of this plugin
			'author' 	=> 'WP Online Support'  		// author of this plugin
	));
}
add_action( 'admin_init', 'edd_sl_slickspro_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/edd-slickslider-plugin.php' ); 

/**
 * Function to unique number value
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.2
 */
function wpsisac_pro_get_unique() {
  static $unique = 0;
  $unique++;

  return $unique;
}

add_action( 'wp_enqueue_scripts','pro_wpsisacstyle_css' );
function pro_wpsisacstyle_css() {
	wp_enqueue_script( 'prowpsisac_slick_jquery', plugin_dir_url( __FILE__ ) . 'assets/js/slick.min.js', array('jquery'), WPSISAC_PRO_VERSION );
	wp_enqueue_style( 'prowpsisac_slick_style',  plugin_dir_url( __FILE__ ) . 'assets/css/slick.css', null, WPSISAC_PRO_VERSION );
	wp_enqueue_style( 'prowpsisac_recent_post_style',  plugin_dir_url( __FILE__ ) . 'assets/css/slick-slider-style.css', null, WPSISAC_PRO_VERSION );
}

add_action('plugins_loaded', 'pro_wpsisac_load_textdomain');
function pro_wpsisac_load_textdomain() {
    load_plugin_textdomain( 'wp-slick-slider-and-image-carousel', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

/**
 * Show row meta on the plugin screen.
 *
 * @param	mixed $links Plugin Row Meta
 * @param	mixed $file  Plugin Base file
 * @return	array
 */
function wpsisac_pro_plugin_row_meta( $links, $file ) {
	if ( $file == WPSISAC_PRO_PLUGIN_BASENAME ) {
		
		$license_link =  add_query_arg( array( 'page' => 'slickspro-license'), admin_url( 'plugins.php' ) );
		
		$row_meta = array(
			'docs'    		=> '<a href="' . esc_url( 'http://wponlinesupport.com/pro-plugin-document/document-wp-slick-slider-and-image-carousel-pro/' ) . '" title="' . esc_attr( __( 'View Documentation', 'woocommerce' ) ) . '">' . __( 'Docs', 'woocommerce' ) . '</a>',
			'license_key' 	=> '<a href="' . esc_url($license_link) . '" title="' . esc_attr( __( 'Add License Key', 'woocommerce' ) ) . '">' . __( 'License Key', 'woocommerce' ) . '</a>',
		);

		return array_merge( $links, $row_meta );
	}
	return (array) $links;
}

// Filter to add plugin row action
add_filter( 'plugin_row_meta', 'wpsisac_pro_plugin_row_meta', 10, 2 );

require_once( 'wpsisac-slider-custom-post.php' );
require_once( 'templates/wpsisac-carousel-template.php' );
require_once( 'templates/wpsisac-template.php' );
require_once( 'templates/wpsisac-gallery-carousel-template.php' );
require_once( 'wpsisac_post_menu_function.php' );



function bl_slick_load_updater() {
	
	// Init auto-update from GitHub repo
	require 'plugin-update-checker/plugin-update-checker.php';
	$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
		'https://github.com/BruceMcKinnon/bl-slick-image-slider',
		__FILE__,
		'bl-slick-image-slider'
	);
}
add_action( 'init', 'bl_slick_load_updater' );