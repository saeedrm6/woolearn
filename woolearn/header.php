<!DOCTYPE html>
<html lang="fa">
   <head>
      <meta charset="UTF-8">
      <?php wp_head();  ?>
   </head>
   <body>
      <header>
         <div class="header-top">
            <div class="container">
               <div class="row">
                  <div class="col-md-6">
                     <ul class="pull-left">
                        <?php
                           $header_options=woolearn_get_option('header_sec');
                           ?>
                        <li><a href="#"><?php echo  $header_options[0]['top_text']; ?></a></li>
                     </ul>
                  </div>
                  <div class="col-md-6">
                     <?php
                        $args=array(
                            'theme_location'=>'top',
                            'depth'=>1
                        );
                        wp_nav_menu($args);
                        ?>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="header-main">
            <div class="container">
               <div class="row">
                  <a href="<?php bloginfo('url'); ?>" class="logo"><img src="<?php echo  $header_options[0]['logo']; ?>" alt="logo"></a>
                  <nav>
                     <?php
                        $args=array(
                            'theme_location'=>'main',
                            'depth'=>2
                        );
                        wp_nav_menu($args);
                        ?>
                     <a href="#" class="open-cart"></a>
                     <div class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></div>
                     <div class="table-responsive cart shadow-around">
                        <?php woocommerce_mini_cart(); ?>
                     </div>
					 <?php if (is_user_logged_in ()){ ?>
					 <a href="#" class="user-account"></a>
					 <div class="user-profile shadow-around">
					 خروج
					 </div>
					 <?php } else { ?>
					 <a href="#" class="user-account"></a>
					 <div class="user-profile shadow-around">
					 <?php echo do_shortcode("[woocommerce_my_account]"); ?>
					 </div>
					 <?php } ?>
                  </nav>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="container">
            <div class="header-bottom shadow-around">
               <div class="col-md-6">
                  <ul class="social">
                     <?php
                        $social = woolearn_get_option("woolearn_social_group");
                        $social = $social[0];
                        if(isset($social['facebook'])){
                            echo "<li><a href='{$social['facebook']}'><i class=\"fa fa-facebook\"></i></a></li>";
                        }
                        if(isset($social['twitter'])){
                            echo "<li><a href='{$social['twitter']}'><i class=\"fa fa-twitter\"></i></a></li>";
                        }
                        if(isset($social['instagram'])){
                            echo "<li><a href='{$social['instagram']}'><i class=\"fa fa-instagram\"></i></a></li>";
                        }
                        if(isset($social['telegram'])){
                            echo "<li><a href='{$social['telegram']}'><i class=\"fa fa-send\"></i></a></li>";
                        }
                        
                        ?>
                  </ul>
               </div>
               <div class="col-md-6">
                  <div class="search">
                     <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <!--<label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php _e( 'Search for:', 'woocommerce' ); ?></label>-->
                        <div class="col-md-4">
                           <?php wp_dropdown_categories( $args = array('taxonomy' => 'product_cat','name' => 'product_cat','value_field' => 'slug','class'              => 'selectpicker') ); ?> 
                        </div>
                        <div class="col-md-8">
                           <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="کالا یا محصول مورد نظر را جستجو کنید..." value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr__( 'Search for:', 'woocommerce' ); ?>" />
                           <button class="btn_responsive"><i class="fa fa-search"></i></button>
                        </div>
                        <!--<input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>" />-->
                        <input type="hidden" name="post_type" value="product" />
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <div class="clearfix"></div>