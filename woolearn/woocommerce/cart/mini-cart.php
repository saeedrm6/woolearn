<?php
   /**
    * Mini-cart
    *
    * Contains the markup for the mini-cart, used by the cart widget.
    *
    * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
    *
    * HOWEVER, on occasion WooCommerce will need to update template files and you
    * (the theme developer) will need to copy the new files to your theme to
    * maintain compatibility. We try to do this as little as possible, but it does
    * happen. When this occurs the version of the template file will be bumped and
    * the readme will list any important changes.
    *
    * @see     https://docs.woocommerce.com/document/template-structure/
    * @author  WooThemes
    * @package WooCommerce/Templates
    * @version 2.5.0
    */
   
   if ( ! defined( 'ABSPATH' ) ) {
   	exit; // Exit if accessed directly
   }
   
   ?>
<?php do_action( 'woocommerce_before_mini_cart' ); ?>
<table class="cart_list product_list_widget shadow-around<?php echo $args['list_class']; ?>">
   <?php if ( ! WC()->cart->is_empty() ) : ?>
   <?php do_action( 'woocommerce_before_mini_cart_contents' ); ?>
   <?php
      foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
      	$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
      	$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
      
      	if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
      		$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
      		$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
      		$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
      		$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
      		?>
   <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
      <?php if ( ! $_product->is_visible() ) : ?>
      <td><?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;'; ?></td>
      <?php else : ?>
      <td>
         <a href="<?php echo esc_url( $product_permalink ); ?>">
            <figure><?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?></figure>
         </a>
      </td>
      <?php endif; ?>
      <td>
         <h6><?php echo $product_name; ?></h6>
      </td>
      <?php echo WC()->cart->get_item_data( $cart_item ); ?>
      <td><?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?></td>
      <td><?php
         echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
         	'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-trash-o"></i></a>',
         	esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
         	__( 'Remove this item', 'woocommerce' ),
         	esc_attr( $product_id ),
         	esc_attr( $_product->get_sku() )
         ), $cart_item_key );
         ?></td>
   </tr>
   <?php
      }
      }
      ?>
   <?php do_action( 'woocommerce_mini_cart_contents' ); ?>
   <?php else : ?>
   <ul>
      <li class="empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>
   </ul>
   <?php endif; ?>
</table>
<!-- end product list -->
<?php if ( ! WC()->cart->is_empty() ) : ?>
<p class="total"><?php _e( 'Subtotal', 'woocommerce' ); ?>: <span class="pink"><?php echo WC()->cart->get_cart_subtotal(); ?></span></p>
<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
<p class="buttons">
   <a href="http://welearnacademy.ir/woolearn/تسویه-حساب/" class="btn btn-cart">تسویه حساب</a>
   <?php //do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>
</p>
<?php endif; ?>
<?php do_action( 'woocommerce_after_mini_cart' ); ?>