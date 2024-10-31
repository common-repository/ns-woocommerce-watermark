<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


function ns_watermark_plugin_path_gallery_thumbnails() {
 
  // gets the absolute path to this plugin directory
 
  return untrailingslashit( plugin_dir_path( __FILE__ ) );
 
}
 
add_filter( 'woocommerce_locate_template', 'ns_watermark_woocommerce_locate_template_gallery_thumbnails', 19, 3 ); 

function ns_watermark_woocommerce_locate_template_gallery_thumbnails( $template, $template_name, $template_path ) {
 
  global $woocommerce;

  $_template = $template;
 
  if ( ! $template_path ) $template_path = $woocommerce->template_url;
 
  $ns_theme = wp_get_theme();
  $ns_theme_name = $ns_theme['Name'];

  if( $ns_theme_name == 'Flatsome' || $ns_theme_name == 'Flatsome Child Theme'){
	if (version_compare( $woocommerce->version, '3.0', ">=" )) {
		$plugin_path  = ns_watermark_plugin_path_gallery_thumbnails() . '/woocommerce3/';
	} else {
		$plugin_path  = ns_watermark_plugin_path_gallery_thumbnails() . '/woocommerce2/';
	}
  } else {
	if (version_compare( $woocommerce->version, '3.0', ">=" )) {
		$plugin_path  = ns_watermark_plugin_path_gallery_thumbnails() . '/woocommerce4/';
	} else {
		$plugin_path  = ns_watermark_plugin_path_gallery_thumbnails() . '/woocommerce/';
	}
  } 
 
 
  // Look within passed path within the theme - this is priority
 
  $template = locate_template(
 
    array(
 
      $template_path . $template_name,
 
      $template_name
 
    )
 
  );
 
 
 
  // Modification: Get the template from this plugin, if it exists
// echo $template_name;
  //if ( ! $template && file_exists( $plugin_path . $template_name ) )
 if (strpos($template_name, '/woocommerce/' ) === false)
	 $template_name = substr($template_name, 12, strlen($template_name));
	 
 if ( $template_name == 'single-product/product-gallery-thumbnails.php' )
 // if (!strpos($template_name, 'single-product/product-gallery-thumbnails.php' ) === false)

    $template = $plugin_path . $template_name;
 
 
 
  // Use default template
 
  if ( ! $template )
 
    $template = $_template;

  // Return what we found
  return $template;
 
}
?>