<?php
/*
Plugin Name: NS Watermark For WooCommerce
Plugin URI: https://wordpress.org/plugins/ns-woocommerce-watermark/
Description: Add a Watermark on woocommerce image
Version: 3.0.0
Author: NsThemes
Author URI: http://nsthemes.com
Text Domain: ns-woocommerce-watermark
Domain Path: /languages
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** 
 * @author        PluginEye
 * @copyright     Copyright (c) 2019, PluginEye.
 * @version         1.0.0
 * @license       https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * PLUGINEYE SDK
*/

require_once('plugineye/plugineye-class.php');
$plugineye = array(
    'main_directory_name'       => 'ns-woocommerce-watermark',
    'main_file_name'            => 'woocommerce-watermark.php',
    'redirect_after_confirm'    => 'admin.php?page=ns-woocommerce-watermark%2Fns-admin-options%2Fns_admin_option_dashboard.php',
    'plugin_id'                 => '221',
    'plugin_token'              => 'NWNmZTdhODg5M2EyZDg4Y2Y5ODY0NDliNjFhZWJhOTBhNGJhZWRmYWViYTk1Y2MxMmU4ZDA0ZGVkZmViZTUzYjc4ZGQyOWZjMGE0YWM=',
    'plugin_dir_url'            => plugin_dir_url(__FILE__),
    'plugin_dir_path'           => plugin_dir_path(__FILE__)
);

$plugineyeobj221 = new pluginEye($plugineye);
$plugineyeobj221->pluginEyeStart();      


if ( ! defined( 'WATERMARK_NS_PLUGIN_DIR' ) )
    define( 'WATERMARK_NS_PLUGIN_DIR', plugin_dir_path(  __FILE__ ) );

if ( ! defined( 'WATERMARK_NS_WW_PLUGIN_DIR' ) )
    define( 'WATERMARK_NS_WW_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );

$ns_theme = wp_get_theme();
$ns_theme_name = $ns_theme['Name'];

/* *** include css *** */
function wfw_woocommerce_watermark_css( $hook ) {
	wp_enqueue_style('ns-style-watermark', WATERMARK_NS_WW_PLUGIN_DIR . '/css/custom-avada.css');
}
if( $ns_theme_name == 'Avada' || $ns_theme_name == 'Avada Child'){
	add_action( 'wp_enqueue_scripts', 'wfw_woocommerce_watermark_css' );
}

/* *** include css admin *** */
function wfw_woocommerce_watermark_css_admin( $hook ) {
	wp_enqueue_style('ns-style-watermark-admin', WATERMARK_NS_WW_PLUGIN_DIR . '/css/style.css');
}
add_action( 'admin_enqueue_scripts', 'wfw_woocommerce_watermark_css_admin' );



/* *** include js *** */
function wfw_woocommerce_watermark_js( $hook ) {
	wp_enqueue_script('ns-custom-script-ww', WATERMARK_NS_WW_PLUGIN_DIR . '/js/custom.js', array('jquery'));
	wp_localize_script( 'ns-custom-script-ww', 'nsdismisswat', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'wfw_woocommerce_watermark_js' );

/* *** include text domain *** */
function wfw_woocommerce_watermark_load_plugin_textdomain() {
    load_plugin_textdomain( 'ns-woocommerce-watermark', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'wfw_woocommerce_watermark_load_plugin_textdomain' );


/* *** plugin review trigger *** */
require_once( plugin_dir_path( __FILE__ ) .'/class/class-plugin-theme-review-request.php');


// includere qua if shop
/* *** include loop product watermark *** */
require_once( WATERMARK_NS_PLUGIN_DIR.'/woocommerce-watermark-loop.php');

/* *** include single product watermark *** */
require_once( WATERMARK_NS_PLUGIN_DIR.'/woocommerce-watermark-single-product.php');

/* *** include variations utilities *** */
require_once( WATERMARK_NS_PLUGIN_DIR.'/woocommerce-watermark-product-variations.php');

/* *** include single product gallery watermark *** */
require_once( WATERMARK_NS_PLUGIN_DIR.'/woocommerce-watermark-product-thumbnails.php');

/* *** include single product gallery thumbnails watermark *** */
require_once( WATERMARK_NS_PLUGIN_DIR.'/woocommerce-watermark-product-gallery-thumbnails.php');

/* *** include admin option *** */
require_once( WATERMARK_NS_PLUGIN_DIR.'/woocommerce-watermark-admin.php');

function wfw_activate_set_default_options() {
	add_option('woocommerce_watermark_enabled_plugin', '0');
    add_option('woocommerce_watermark_img', WATERMARK_NS_WW_PLUGIN_DIR.'/img/logo-nsthemes-black.png');
	add_option('woocommerce_watermark_notice', 'no');
}
 
register_activation_hook( __FILE__, 'wfw_activate_set_default_options');

function woocommerce_watermark_image($image) {
	
	$current_user = wp_get_current_user();
	$not_user = (!isset($current_user->user_email) OR $current_user->user_email == '') ? true : false;

	if (get_option('woocommerce_watermark_enabled_plugin') == 0 OR (get_option('woocommerce_watermark_enabled_plugin') == 2 AND $not_user)) {
		$param_img = urlencode('image_path='.$image.'&wt_path='.get_option('woocommerce_watermark_img').'&other=none');
		return WATERMARK_NS_WW_PLUGIN_DIR.'/ns_image.php?param='.esc_attr($param_img);
	} else {
		return $image;
	}
}

####################################################################
add_action( 'wp_ajax_ns_dismisswatermark_ajax', 'ns_dismisswatermark_ajax' );
add_action( 'wp_ajax_nopriv_ns_dismisswatermark_ajax', 'ns_dismisswatermark_ajax' );

function ns_dismisswatermark_ajax() {
	update_option( 'woocommerce_watermark_notice', 'yes' );
    die();    
}


/* *** add link premium *** */
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'nswatermark_add_action_links' );

function nswatermark_add_action_links ( $links ) {	
 $mylinks = array('<a id="nswatlinkpremiumlinkpremium" href="https://www.nsthemes.com/product/woocommerce-watermark/?ref-ns=2&campaign=linkpremium" target="_blank">'.__( 'Premium Version', 'ns-woocommerce-watermark' ).'</a>');
return array_merge( $links, $mylinks );
}
?>