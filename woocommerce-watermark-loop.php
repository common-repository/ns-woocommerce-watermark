<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$ns_theme = wp_get_theme();
$ns_theme_name = $ns_theme['Name'];

if( $ns_theme_name == 'Avada' || $ns_theme_name == 'Avada Child'){
    $ns_priority  = 20;
} else {
    $ns_priority  = 10;
} 

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', $ns_priority);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', $ns_priority);

/**
 * WooCommerce Product Thumbnail
 **/
 if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
	
	function woocommerce_get_product_thumbnail(  $size = 'shop_catalog', $deprecated1 = 0, $deprecated2 = 0  ) {
		global $post;

		$ns_theme = wp_get_theme();
		$ns_theme_name = $ns_theme['Name'];


			$output = '<div class="imagewrapper">';
			if ( has_post_thumbnail() ) {
				$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;

				$image_size = wp_get_attachment_metadata(get_post_thumbnail_id($post->ID), 'shop_catalog' );
				$image_width = $image_size['sizes']['shop_catalog']['width'];
				$image_height = $image_size['sizes']['shop_catalog']['height'];
				
				$image_class = wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'shop_catalog' );
				$start_class = strpos($image_class, 'class="')+7;
				$image_class =  substr($image_class, $start_class);
				$end_class = strpos($image_class, '"');
				$image_class =  substr($image_class, 0, $end_class);

				
				$url_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'shop_catalog');
				
				if ($ns_theme_name == 'Divi' || $ns_theme_name == 'Divi Child' || $ns_theme_name == 'Avada' || $ns_theme_name == 'Avada Child') {
					$output .= sprintf('<img src="%s">', woocommerce_watermark_image($url_image[0]));
				} else {
					// $output .= '<a href="'.get_permalink($post->ID).'"><img class="'.$image_class.'" src="'. woocommerce_watermark_image($url_image[0]) .'" alt="'.$image_caption.'" width="'.$image_width.'" height="'.$image_height.'" /></a>';
					$output .= '<img src="'. woocommerce_watermark_image($url_image[0]) .'" class="'.$image_class.'" alt="'.$image_caption.'" width="'.$image_width.'" height="'.$image_height.'" />';
				}
				
				if( $ns_theme_name == 'Flatsome' || $ns_theme_name == 'Flatsome Child Theme' || $ns_theme_name == 'Avada' || $ns_theme_name == 'Avada Child' || $ns_theme_name == 'Divi' || $ns_theme_name == 'Divi Child') {
					$output .= "<script>jQuery('.inner-wrap .product-image').remove();</script>";
				}
				
				
			} else {
			
				$output .= '<img src="'. wc_placeholder_img_src() .'" />';

			}
			
			$output .= '</div>';
			
			return $output;
	}
 }

?>