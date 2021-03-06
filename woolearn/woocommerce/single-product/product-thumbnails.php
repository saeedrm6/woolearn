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
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post, $product, $woocommerce;
$attachment_ids = $product->get_gallery_attachment_ids();
echo ' <div class="product-thumb"><div id="owl-example" class="owl-carousel">';
if ( $attachment_ids ) {
	foreach ( $attachment_ids as $attachment_id ) {
		$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
		$thumbnail        = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
		$thumbnail_post   = get_post( $attachment_id );
		$image_title      = $thumbnail_post->post_content;
		$attributes = array(
			'title'                   => $image_title,
			'data-large-image'        => $full_size_image[0],
			'data-large-image-width'  => $full_size_image[1],
			'data-large-image-height' => $full_size_image[2],
		);
		echo '<div><figure>';
			echo '<a href="' . wp_get_attachment_image_url($attachment_id , $size = 'full' , $icon = false) . '" class="fancybox" rel="group"><img src="' . wp_get_attachment_image_url($attachment_id , $size = 'full' , $icon = false) . '" width="102" height="82"></a>';
		echo '</figure></div>';
	}
}
echo '</div></div>';