<?php
   /**
    * Show messages
    *
    * This template can be overridden by copying it to yourtheme/woocommerce/notices/success.php.
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
    * @version     1.6.4
    */
   
   if ( ! defined( 'ABSPATH' ) ) {
   	exit; // Exit if accessed directly
   }
   
   if ( ! $messages ) {
   	return;
   }
   
   ?>
<script>
   jQuery(window).load(function(){
   	jQuery('#mymessage').modal('show');
   });
</script>
<?php foreach ( $messages as $message ) : ?>
<div id="mymessage" class="modal-message modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">
            <i class="fa fa-check-circle"></i>
            <p>
               <?php echo wp_kses_post( $message ); ?>
            </p>
         </div>
      </div>
   </div>
</div>
<?php endforeach; ?>