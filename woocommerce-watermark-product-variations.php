<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Used to apply watermark to all product variation images
add_filter( 'woocommerce_available_variation', 'wfw_watermark_to_all_variations', 10, 3 );
function wfw_watermark_to_all_variations( $data, $product, $variation ) {

        $watermarkimg = woocommerce_watermark_image($data['image']['url']);
        $data['image']['src'] = $watermarkimg;
        $data['image']['url'] = $watermarkimg;
        $data['image']['full_src'] = $watermarkimg;
        $data['image']['srcset'] = $watermarkimg;
        $data['image']['gallery_thumbnail_src'] = $watermarkimg;
        $data['image']['thumb_src'] = $watermarkimg;

    return $data;     
} 
?>