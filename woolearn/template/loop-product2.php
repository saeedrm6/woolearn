<li class="col-md-4">
   <div class="product shadow-around">
      <figure>
         <img src="<?php echo the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="img-responsive">
         <figcaption>
            <ul>
               <li data-toggle="tooltip" title="<?php comments_number( 'بدون نظر', '1 نظر', '% نظر' ); ?>"><i class="fa fa-heart"></i></li>
               <li data-toggle="tooltip" title="<?php if(function_exists('the_views')) { the_views(); } ?>"><i class="fa fa-user"></i></li>
            </ul>
         </figcaption>
      </figure>
      <div class="product-content">
         <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
         <div class="color-op">
            <ul>
               <li><a href="#"> سفید</a></li>
               <li><a href="#"> مشکی</a></li>
               <li><a href="#"> نقره ای</a></li>
            </ul>
         </div>
         <?php global $product; if ( $price_html = $product->get_price_html() ) : ?>
         <span class="price"><?php echo $price_html; ?></span>
         <?php endif; ?>
         <a href="<?php the_permalink(); ?>" class="product-buy">خرید آنلاین</a>
      </div>
   </div>
</li>