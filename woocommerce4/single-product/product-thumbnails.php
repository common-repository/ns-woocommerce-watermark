<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids && $product->get_image_id() ) {
	foreach ( $attachment_ids as $attachment_id ) {
		// echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
		$image = wp_get_attachment_image_src( $attachment_id, 'single-post-thumbnail' );
		$title = get_the_title( $attachment_id, 'single-post-thumbnail' );
		$image_watermark = woocommerce_watermark_image($image[0]);

		$html = '<div data-thumb="'.$image_watermark.'" class="woocommerce-product-gallery__image" style="position: relative; overflow: hidden;"><a href="'.$image_watermark.'"><img width="416" height="312" src="'.$image_watermark.'" class="wp-post-image" alt="" title="'.$title.'" data-caption="" data-src="'.$image_watermark.'" data-large_image="'.$image_watermark.'" data-large_image_width="'.$image[1].'" data-large_image_height="'.$image[2].'" srcset="'.$image_watermark.' 416w, '.$image_watermark.' 800w, '.$image_watermark.' 768w, '.$image_watermark.' '.$image[1].'w" sizes="(max-width: 416px) 100vw, 416px"></a><img role="presentation" alt="" src="'.$image_watermark.'" class="zoomImg" style="position: absolute; top: -'.($image[1]/2).'px; left: -'.($image[2]/2).'px; opacity: 0; width: '.$image[1].'px; height: '.$image[2].'px; border: none; max-width: none; max-height: none;"></div>';
		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
	}
}
