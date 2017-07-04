<?php
   /**
    * Login Form
    *
    * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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
    * @version 2.6.0
    */
   
   if ( ! defined( 'ABSPATH' ) ) {
   	exit; // Exit if accessed directly
   }
   
   ?>
<?php wc_print_notices(); ?>
<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
<div class="page-account" id="customer_login">
   <div class="col-md-9 block-center">
      <div class="col-md-6">
         <div class="login-form">
            <?php endif; ?>
            <h2><?php _e( 'Login', 'woocommerce' ); ?></h2>
            <div class="form-icon shadow-around">
               <i class="fa fa-sign-in"></i>
            </div>
            <form method="post" class="login">
               <?php do_action( 'woocommerce_login_form_start' ); ?>
               <p>
                  <!--<label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>-->
                  <input type="text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" placeholder="پست الکترونیک" />
               </p>
               <p>
                  <!--<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>-->
                  <input type="password" name="password" id="password" placeholder="رمز عبور" />
               </p>
               <?php do_action( 'woocommerce_login_form' ); ?>
               <p>
                  <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                  <input type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
                  <input name="rememberme" type="checkbox" id="rememberme" value="forever" /><label for="rememberme">مرا به خاطر بسپار</label>
               </p>
               <p>
                  <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
               </p>
               <?php do_action( 'woocommerce_login_form_end' ); ?>
            </form>
            <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
         </div>
      </div>
      <div class="col-md-6">
         <div class="signup-form">
            <h2><?php _e( 'Register', 'woocommerce' ); ?></h2>
            <div class="form-icon shadow-around">
               <i class="fa fa-user-plus"></i>
            </div>
            <form method="post" class="register">
               <?php do_action( 'woocommerce_register_form_start' ); ?>
               <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
               <p>
                  <!--<label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>-->
                  <input type="text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
               </p>
               <?php endif; ?>
               <p>
                  <!--<label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>-->
                  <input type="email" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" placeholder="پست الکترونیک" />
               </p>
               <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
               <p>
                  <!--<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>-->
                  <input type="password" name="password" id="reg_password" placeholder="رمز عبور" />
               </p>
               <?php endif; ?>
               <!-- Spam Trap -->
               <div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off" /></div>
               <?php do_action( 'woocommerce_register_form' ); ?>
               <?php do_action( 'register_form' ); ?>
               <p class="woocomerce-FormRow form-row">
                  <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                  <input type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
               </p>
               <?php do_action( 'woocommerce_register_form_end' ); ?>
            </form>
         </div>
      </div>
   </div>
</div>
<?php endif; ?>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>