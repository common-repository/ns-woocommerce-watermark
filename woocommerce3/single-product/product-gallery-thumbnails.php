<?php

global $post, $product, $woocommerce;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$small_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'thumb' );
$thumbnail_post    = get_post( $post_thumbnail_id );
$image_title       = $thumbnail_post->post_content;
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
  'woocommerce-product-gallery',
  'woocommerce-product-gallery--' . $placeholder,
  'woocommerce-product-gallery--columns-' . absint( $columns ),
  'images',
) );

$attachment_ids = $product->get_gallery_image_ids();

$thumb_count = count($attachment_ids)+1;

// Disable thumbnails if there is only one extra image.
if($thumb_count == 1) return;

$rtl = 'false';

if(is_rtl()) $rtl = 'true';

$thumb_cell_align = "left";

if ( $attachment_ids ) {
  $loop     = 0;
  $columns  = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );

  $gallery_class = array('product-thumbnails','thumbnails');

  if($thumb_count <= 5){
    $gallery_class[] = 'slider-no-arrows';
  }

  $gallery_class[] = 'slider row row-small row-slider slider-nav-small small-columns-4';
  ?>

  <div class="<?php echo implode(' ', $gallery_class); ?>"
    data-flickity-options='{
              "cellAlign": "<?php echo $thumb_cell_align;?>",
              "wrapAround": false,
              "autoPlay": false,
              "prevNextButtons":true,
              "asNavFor": ".product-gallery-slider",
              "percentPosition": true,
              "imagesLoaded": true,
              "pageDots": false,
              "rightToLeft": <?php echo $rtl; ?>,
              "contain": true
          }'
    ><?php


    if ( has_post_thumbnail() ) : ?>
      <div class="col is-nav-selected first">
		  <a>
			<?php echo '<img width="100" height="100" src="'.woocommerce_watermark_image(esc_url($small_size_image[0])).'" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="" srcset="'.woocommerce_watermark_image(esc_url($small_size_image[0])).' 100w, '.woocommerce_watermark_image(esc_url($small_size_image[0])).' 300w, '.woocommerce_watermark_image(esc_url($small_size_image[0])).' 340w, '.woocommerce_watermark_image(esc_url($small_size_image[0])).' 600w" sizes="(max-width: 100px) 100vw, 100px">'; ?>
			<?php // echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) ) ?>
		  </a>
	  </div>
    <?php endif;

    foreach ( $attachment_ids as $attachment_id ) {

      $classes = array( '' );
      $image_title  = esc_attr( get_the_title( $attachment_id ) );
      $image_caption  = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
      $image_class = esc_attr( implode( ' ', $classes ) );
	  
	  $small_size_image   = wp_get_attachment_image_src( $attachment_id, 'thumb' );

      $image       = '<img width="100" height="100" src="'.woocommerce_watermark_image(esc_url($small_size_image[0])).'" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="" srcset="'.woocommerce_watermark_image(esc_url($small_size_image[0])).' 100w, '.woocommerce_watermark_image(esc_url($small_size_image[0])).' 300w, '.woocommerce_watermark_image(esc_url($small_size_image[0])).' 340w, '.woocommerce_watermark_image(esc_url($small_size_image[0])).' 600w" sizes="(max-width: 100px) 100vw, 100px">';
	  // woocommerce_watermark_image(esc_url($small_size_image[0]));
	  // wp_get_attachment_image(
	  // $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
        // 'title' => $image_title,
        // 'alt' => $image_title
        // ) );
      echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="col"><a class="%s" title="%s" >%s</a></div>', $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );

      $loop++;
    }
  ?>
  </div><!-- .product-thumbnails -->
  <?php
} ?>
