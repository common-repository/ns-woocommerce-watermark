<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}


global $product;


$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );

?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper">
		<?php
		if ( $product->get_image_id() ) {
			// $html = wc_get_gallery_image_html( $post_thumbnail_id, true );
			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' );
			$title = get_the_title( get_post_thumbnail_id(), 'single-post-thumbnail' );
			$image_watermark = woocommerce_watermark_image($image[0]);

			$html = '<div data-thumb="'.$image_watermark.'" class="woocommerce-product-gallery__image" style="position: relative; overflow: hidden;"><a href="'.$image_watermark.'"><img width="416" height="312" src="'.$image_watermark.'" class="wp-post-image" alt="" title="'.$title.'" data-caption="" data-src="'.$image_watermark.'" data-large_image="'.$image_watermark.'" data-large_image_width="'.$image[1].'" data-large_image_height="'.$image[2].'" srcset="'.$image_watermark.' 416w, '.$image_watermark.' 800w, '.$image_watermark.' 768w, '.$image_watermark.' 1280w" sizes="(max-width: 416px) 100vw, 416px"></a><img role="presentation" alt="" src="'.$image_watermark.'" class="zoomImg" style="position: absolute; top: -'.($image[1]/2).'px; left: -'.($image[1]/2).'px; opacity: 0; width: '.$image[1].'px; height: '.$image[2].'px; border: none; max-width: none; max-height: none;"></div>';
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( woocommerce_watermark_image(wc_placeholder_img_src( 'woocommerce_single' )) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
			$html .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>
</div>
