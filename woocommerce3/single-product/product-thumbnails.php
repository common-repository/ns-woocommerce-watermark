<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids && has_post_thumbnail() ) {
  foreach ( $attachment_ids as $attachment_id ) {
    $full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
    $thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
    $image_title     = get_post_field( 'post_excerpt', $attachment_id );

    $attributes = array(
      'title'                   => $image_title,
      'data-src'                => woocommerce_watermark_image($full_size_image[0]),
      'data-large_image'        => woocommerce_watermark_image($full_size_image[0]),
      'data-large_image_width'  => $full_size_image[1],
      'data-large_image_height' => $full_size_image[2],
    );

    // $html  = '<div data-thumb="' . woocommerce_watermark_image(esc_url( $thumbnail[0] )) . '" class="woocommerce-product-gallery__image slide"><a href="' . woocommerce_watermark_image(esc_url( $full_size_image[0] )) . '">';
    // $html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
    // $html .= '<img width="100" height="100" src="'.woocommerce_watermark_image(esc_url( $full_size_image[0] )).'" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="" srcset="'.woocommerce_watermark_image(esc_url( $full_size_image[0] )).' 100w, '.woocommerce_watermark_image(esc_url( $full_size_image[0] )).' 300w, '.woocommerce_watermark_image(esc_url( $full_size_image[0] )).' 340w, '.woocommerce_watermark_image(esc_url( $full_size_image[0] )).' 600w" sizes="(max-width: 100px) 100vw, 100px" data-src="'.woocommerce_watermark_image(esc_url( $full_size_image[0] )).'">';
    // $html .= '</a></div>';
	$html = '<div data-thumb="'.woocommerce_watermark_image(esc_url($thumbnail[0])).'" class="woocommerce-product-gallery__image slide is-selected" style="position: absolute; left: 100%;"><a href="'.woocommerce_watermark_image(esc_url($full_size_image[0])).'"><img width="600" height="400" src="'.woocommerce_watermark_image(esc_url($full_size_image[0])).'" class="attachment-shop_single size-shop_single" alt="" title="" data-src="'.woocommerce_watermark_image(esc_url($full_size_image[0])).'" data-large_image="'.woocommerce_watermark_image(esc_url($full_size_image[0])).'" data-large_image_width="1280" data-large_image_height="853" srcset="'.woocommerce_watermark_image(esc_url($full_size_image[0])).' 600w, '.woocommerce_watermark_image(esc_url($full_size_image[0])).' 800w, '.woocommerce_watermark_image(esc_url($full_size_image[0])).' 768w, '.woocommerce_watermark_image(esc_url($full_size_image[0])).' 1280w" sizes="(max-width: 600px) 100vw, 600px"></a></div>';

    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
  }
}
?>
