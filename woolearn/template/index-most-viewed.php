 <section id="best-seller">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>پربازدیدترین محصولات</h2>
                    <sub>مرتب شده بر اساس تعداد بازدید از محصولات وولرن</sub>
                </div>
                <div class="best-seller shadow-around">
                    <ul>
					
						<?php
							 $q=new WP_Query(
								array(
									'post_type'=>'product',
									'post_status'=>'publish',
									'posts_per_page'=>'8',
									'meta_key'=>'views',
									'orderby'=>'meta_value_num',
									'order' => 'DESC'
								)
							 
							 );
							  while($q->have_posts())
							 {
								 $q->the_post();
								 global $product;
								$price_html = $product->get_price_html();
								
								
								?>
								<li class="col-md-3 no-padding">
									<div class="best-item">
										<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
										<h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
										<span><?php echo $price_html; ?></span>
										
									</div>
								</li>
								<?php

							 }
						
						?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>