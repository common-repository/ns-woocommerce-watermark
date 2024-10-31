<?php

/**
 * Custom Product image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */


global $post, $product, $woocommerce, $flatsome_opt, $wc_cpdf;
$attachment_ids = $product->get_gallery_image_ids();



if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if(flatsome_option('product_layout') == 'gallery-wide'){
  wc_get_template_part( 'single-product/product-image', 'wide' );
  return;
}

if(flatsome_option('product_image_style') == 'vertical'){
  wc_get_template_part( 'single-product/product-image', 'vertical' );
  return;
}

global $post, $product;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$thumbnail_post    = get_post( $post_thumbnail_id );
$image_title       = $thumbnail_post->post_content;
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
  'woocommerce-product-gallery',
  'woocommerce-product-gallery--' . $placeholder,
  'woocommerce-product-gallery--columns-' . absint( $columns ),
  'images',
) );

$slider_classes = array('product-gallery-slider','slider','slider-nav-small','mb-half');

// Image Zoom
if(get_theme_mod('product_zoom', 0)){
  $slider_classes[] = 'has-image-zoom';
}

$rtl = 'false';
if(is_rtl()) $rtl = 'true';

if(get_theme_mod('product_lightbox','default') == 'disabled'){
  $slider_classes[] = 'disable-lightbox';
}

?>
<?php do_action('flatsome_before_product_images'); ?>

<div class="product-images relative mb-half has-hover <?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">

  <?php do_action('flatsome_sale_flash'); ?>

  <div class="image-tools absolute top show-on-hover right z-3">
    <?php do_action('flatsome_product_image_tools_top'); ?>
  </div>

  <figure class="woocommerce-product-gallery__wrapper <?php echo implode(' ', $slider_classes); ?>"
        data-flickity-options='{
                "cellAlign": "center",
                "wrapAround": true,
                "autoPlay": false,
                "prevNextButtons":true,
                "adaptiveHeight": true,
                "imagesLoaded": true,
                "lazyLoad": 1,
                "dragThreshold" : 15,
                "pageDots": false,
                "rightToLeft": <?php echo $rtl; ?>
       }'>
    <?php
    $attributes = array(
      'title'                   => $image_title,
      'data-src'                => woocommerce_watermark_image($full_size_image[0]),
      'data-large_image'        => woocommerce_watermark_image($full_size_image[0]),
      'data-large_image_width'  => $full_size_image[1],
      'data-large_image_height' => $full_size_image[2],
    );

    if ( has_post_thumbnail() ) {
      $html  = '<div data-thumb="' . woocommerce_watermark_image(esc_url( $full_size_image[0] )) . '" class="first slide woocommerce-product-gallery__image"><a href="' . woocommerce_watermark_image(esc_url( $full_size_image[0] )) . '">';
      // $html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
      $html .= '<img width="600" height="400" src="'.woocommerce_watermark_image(esc_url( wc_placeholder_img_src() )).'" class="attachment-shop_single size-shop_single wp-post-image" alt="" title="" data-src="'.$attributes['data-large_image'].'" data-large_image="'.$attributes['data-large_image'].'" data-large_image_width="1280" data-large_image_height="853" srcset="'.$attributes['data-large_image'].' 800w, '.$attributes['data-large_image'].' 768w, '.$attributes['data-large_image'].' 1280w" sizes="(max-width: 600px) 100vw, 600px">';
      $html .= '</a></div>';
    } else {
      $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
      $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', woocommerce_watermark_image(esc_url( wc_placeholder_img_src() )), esc_html__( 'Awaiting product image', 'woocommerce' ) );
      $html .= '</div>';
    }

    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );

    // do_action( 'woocommerce_product_thumbnails' );
	include_once('product-thumbnails.php');
    ?>
  </figure>

  <div class="image-tools absolute bottom left z-3">
    <?php do_action('flatsome_product_image_tools_bottom'); ?>
  </div>
</div>
<?php do_action('flatsome_after_product_images'); ?>

<?php // wc_get_template( 'woocommerce/single-product/product-gallery-thumbnails.php' ); ?>
<?php include_once('product-gallery-thumbnails.php'); ?>
