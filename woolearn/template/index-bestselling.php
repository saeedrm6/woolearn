<section id="sales">
   <div class="container">
      <div class="row">
         <div class="title">
            <h2>پرفروش ترین محصولات</h2>
            <sub>در یک ماه اخیر</sub>
         </div>
         <div class="sales shadow-around">
		 <?php
		 $q=new WP_Query(
			array(
				'post_type'=>'product',
				'post_status'=>'publish',
				'posts_per_page'=>'5',
				'meta_key'=>'total_sales',
				'orderby'=>'meta_value_num',
				'order' => 'DESC'
			)
		 
		 );
		 $best_selling_products=array();
		 while($q->have_posts())
		 {
			 $q->the_post();
			 global $product;
			$price_html = $product->get_price_html();
			
			 $best_selling_products[]=array(
				'price'=>$price_html,
				'title'=>get_the_title(),
				'permalink'=>get_the_permalink(),
				'thumb'=>get_the_post_thumbnail_url(),
			 
			 );
		 }

		 ?>
            <div class="col-md-6">
               <div class="sales-item">
                  <figure>
                     <img src="<?php echo $best_selling_products[0]['thumb']; ?>" alt="">
                  </figure>
                  <figcaption>
                     <a href="<?php echo $best_selling_products[0]['permalink']; ?>" class="btn btn-blue">خرید آنلاین</a>
                  </figcaption>
                  <h2><a href="<?php echo $best_selling_products[0]['permalink']; ?>"><?php echo $best_selling_products[0]['title']; ?></a></h2>
                  <span><?php echo $best_selling_products[0]['price']; ?></span>
                 
               </div>
            </div>
            <div class="col-md-6">
			
				<?php
				for($i=1;$i<count($best_selling_products);$i++)
				{
					?>
					<div class="col-md-6 no-padding">
					  <div class="sales-item">
						 <figure>
							<img src="<?php echo $best_selling_products[$i]['thumb']; ?>" alt="">
						 </figure>
						 <figcaption>
							<a href="<?php echo $best_selling_products[$i]['permalink']; ?>" class="btn btn-blue">خرید آنلاین</a>
						 </figcaption>
						 <h2><a href="<?php echo $best_selling_products[$i]['permalink']; ?>"><?php echo $best_selling_products[$i]['title']; ?></a></h2>
						 <span><?php echo $best_selling_products[$i]['price']; ?></span>
						 
					  </div>
				   </div>
					
				<?php
				}
				?>

            </div>
         </div>
      </div>
   </div>
</section>
<div class="clearfix"></div>