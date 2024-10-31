<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;
$class_type_wat_var = get_post_meta($post->ID, 'custom_tab_type_ns', true);
$class_type_wat = ( !empty($class_type_wat_var)  ? $class_type_wat_var : 'roundedNS');
$class_type_wat_var2 = get_post_meta($post->ID, 'custom_tab_type_ns2', true);
$class_type_wat2 = ( !empty($class_type_wat_var2)  ? $class_type_wat_var2 : 'roundedNS');
$watermark_enabled =  get_post_meta($post->ID, 'custom_tab_enabled', true);
$watermark_enabled2 =  get_post_meta($post->ID, 'custom_tab_enabled_two', true);
?>
<div class="images">
<?php
		if ( has_post_thumbnail() ) {
			$image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
			$attachment_count = count( $product->get_gallery_image_ids() );
			$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
			$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$image         = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	=> get_the_title( get_post_thumbnail_id() )
			) );

			$attachment_count = count( $product->get_gallery_image_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			// $url_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
			$url_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), 0);
			
			// echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', woocommerce_watermark_image($url_image[0]), $image_caption ), $post->ID );
			echo apply_filters(
				'woocommerce_single_product_image_html',
				sprintf(
					'<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto%s"><img src="%s" alt="%s" /></a>',
					esc_url( woocommerce_watermark_image($props['url']) ).'.jpg',
					esc_attr( $props['caption'] ),
					$gallery,
					woocommerce_watermark_image($url_image[0]),
					esc_attr( $props['caption'] )
				),
				$post->ID
			);
		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' );	?>
</div>

