<?php
define("WL_TDU", get_template_directory_uri());

add_action('after_setup_theme' , "woocommerce_support");
function woocommerce_support(){
	add_theme_support('woocommerce');
}
function woolearn_setup(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(
        array(
            'top'=>'منوی بالا',
            'main'=>'منوی اصلی'
        )
    );


}
add_action('after_setup_theme' , "woolearn_setup");


function woolearn_scripts()
{
    wp_enqueue_style('bootstrap',WL_TDU . '/css/bootstrap.min.css');
    wp_enqueue_style('font-awesome',WL_TDU . '/css/font-awesome.min.css');
    wp_enqueue_style('bootstrap-select',WL_TDU . '/css/bootstrap-select.css');
    wp_enqueue_style('owl.carousel',WL_TDU . '/css/owl.carousel.css');
    wp_enqueue_style('jquery.fancybox',WL_TDU . '/css/jquery.fancybox.css');
    wp_enqueue_style('woolearn-style',WL_TDU . '/style.css');
    wp_enqueue_style('responsive',WL_TDU . '/css/responsive.css');
	
    wp_enqueue_script('simple-timer',WL_TDU . '/js/jquery.simple.timer.js',array('jquery'),'1',true);
    wp_enqueue_script('owl.carousel',WL_TDU . '/js/owl.carousel.js',array('jquery'),'1',true);
	wp_enqueue_script('jquery.fancybox.pack',WL_TDU . '/js/jquery.fancybox.pack.js',array('jquery'),'1',true);
	wp_enqueue_script('jquery.elevateZoom',WL_TDU . '/js/jquery.elevateZoom-3.0.8.min.js',array('jquery'),'1',true);
    wp_enqueue_script('bootstrap',WL_TDU . '/js/bootstrap.min.js',array('jquery'),'1',true);
    wp_enqueue_script('bootstrap-select',WL_TDU . '/js/bootstrap-select.js',array('jquery','bootstrap'),'1',true);
    wp_enqueue_script('woolearn-script',WL_TDU . '/js/index.js',array('jquery'),'1',true);

}
add_action('wp_enqueue_scripts','woolearn_scripts');

function woolearn_style(){
	if(isset($_GET['action']) && $_GET['action'] == 'yith-woocompare-view-table'){
		echo "<link href='http://welearnacademy.ir/woolearn/wp-content/themes/woolearn/css/newcompare.css' rel='stylesheet'>";
	}
}
add_action('wp_head','woolearn_style');

function woolearn_widgets_init()
{
    register_sidebar(array(
        'name'=>'فوتر',
        'id'=>'wg_footer',
        'before_widget'=>'<div class="col-md-3">',
        'after_widget'=>'</div>',
        'before_title'=>'<h4>',
        'after_title'=>'</h4>',

    ));
    register_sidebar(array(
        'name'=>'خبرنامه',
        'id'=>'wg_news',
        'before_widget'=>'',
        'after_widget'=>'',
        'before_title'=>'',
        'after_title'=>'',
    ));
	register_sidebar( array(
		'name'          => 'ستون سمت چپ اول',
		'id'            => 'first_sidebar',
		'before_widget' => '<div class="widget-category">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="title-sidebar">',
		'after_title'   => '</span>',
	) );
	register_sidebar( array(
		'name'          => 'ستون سمت چپ دوم',
		'id'            => 'second_sidebar',
		'before_widget' => '<div class="widget"><div class="widget-content">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<span class="title-sidebar">',
		'after_title'   => '</span>',
	) );
	register_sidebar( array(
		'name'          => 'ستون فروشگاه',
		'id'            => 'shop_sidebar',
		'before_widget' => '<div class="widget"><div class="widget-content"><div class="sidebar-input">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<span class="title-sidebar">',
		'after_title'   => '</span>',
	) );
}
add_action('widgets_init','woolearn_widgets_init');
require_once dirname( __FILE__ ) . '/cmb2/init.php';
require_once dirname( __FILE__ ) . '/functions/cmb2-options.php';
function update_cmb2_meta_box_url( $url ) {
    if(strpos($url,basename(TEMPLATEPATH))!==false)
    {
        return get_template_directory_uri()."/cmb2";
    }
    return $url;
}
add_filter( 'cmb2_meta_box_url', 'update_cmb2_meta_box_url' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5 );
add_filter('woocommerce_sale_flash', 'woo_custom_hide_sales_flash');
function woo_custom_hide_sales_flash()
{
    return false;
}
add_filter('woocommerce_checkout_fields','custom_override_checkout_fields');
function custom_override_checkout_fields($fields){
	unset($fields['billing']['billing_company']);
	unset($fields['billing']['billing_country']);
	unset($fields['billing']['billing_address_2']);
	unset($fields['billing']['billing_postcode']);
	$fields['billing']['billing_address_1']['placeholder'] = 'آدرس کامل خود را به همراه کد پستی وارد نمایید';
	$fields['billing']['billing_mobile'] = array(
        'label'     => __('همراه', 'woocommerce'),
    'placeholder'   => _x('شماره همراه خود را وارد نمایید', 'placeholder', 'woocommerce'),
    'required'  => true,
    'class'     => array('form-row-first'),
    'clear'     => false
     );
	 $fields['billing']['billing_text'] = array(
        'label'     => __('متن', 'woocommerce'),
    'placeholder'   => _x('متن خود را وارد نمایید', 'placeholder', 'woocommerce'),
    'required'  => false,
    'class'     => array('form-row-last'),
    'clear'     => false
     );
	return $fields;
} 
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p><strong>'.__('Phone From Checkout Form').':</strong> ' . get_post_meta( $order->id, '_billing_mobile', true ) . '</p>';
    echo '<p><strong>'.__('Phone From Checkout Form').':</strong> ' . get_post_meta( $order->id, '_billing_text', true ) . '</p>';
}
?>
<?php
/**
 * Plugin Name: WooCommerce Registration Fields
 * Plugin URI: http://claudiosmweb.com/
 * Description: My Custom registration fields.
 * Version: 1.0
 * Author: Claudio Sanches
 * Author URI: http://claudiosmweb.com/
 * License: GPL2
 */

/**
 * Add new register fields for WooCommerce registration.
 *
 * @return string Register fields HTML.
 */
function wooc_extra_register_fields() {
    ?>

    <p class="form-row form-row-first">
    <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>

    <p class="form-row form-row-last">
    <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>

    <div class="clear"></div>

    <p class="form-row form-row-wide">
    <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />
    </p>

    <?php
}

add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );

/**
 * Validate the extra register fields.
 *
 * @param  string $username          Current username.
 * @param  string $email             Current email.
 * @param  object $validation_errors WP_Error object.
 *
 * @return void
 */
function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
        $validation_errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
    }

    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
        $validation_errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
    }


    if ( isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) ) {
        $validation_errors->add( 'billing_phone_error', __( '<strong>Error</strong>: Phone is required!.', 'woocommerce' ) );
    }
}

add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

/**
 * Save the extra register fields.
 *
 * @param  int  $customer_id Current customer ID.
 *
 * @return void
 */
function wooc_save_extra_register_fields( $customer_id ) {
    if ( isset( $_POST['billing_first_name'] ) ) {
        // WordPress default first name field.
        update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );

        // WooCommerce billing first name.
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
    }

    if ( isset( $_POST['billing_last_name'] ) ) {
        // WordPress default last name field.
        update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );

        // WooCommerce billing last name.
        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
    }

    if ( isset( $_POST['billing_phone'] ) ) {
        // WooCommerce billing phone
        update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
    }
}

add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );
?>