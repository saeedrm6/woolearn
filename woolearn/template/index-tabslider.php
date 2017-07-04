<?php
$tab_slider = woolearn_get_option("woolearn_tab_slider_group");
?>
   <section id="tab-slider">
        <div class="tab-slider">
            <div class="container">
                <div class="row">
                    <ul class="nav nav-tabs">
					<?php
					$counter=0;
					foreach($tab_slider as $tab)
					{
						$icon=$tab['fa_icon'];
						
						$term=get_term($tab['tab_cat'],'product_cat');
						$name=$term->name;
						
						if($counter==0)
						{
							echo "<li class='active'><a href='#cat{$tab['tab_cat']}' data-toggle='tab'><i class='fa {$icon}'></i>{$name}</a></li>";
						}
						else
						{
							echo "<li><a href='#cat{$tab['tab_cat']}' data-toggle='tab'><i class='fa {$icon}'></i>{$name}</a></li>";
						}
						$counter++;
					}
					
					?>
                       
                    </ul>
					
					
					
                    <div class="tab-content shadow-around">
					<?php
					$counter=0;
					foreach($tab_slider as $tab)
					{
						$term=get_term($tab['tab_cat'],'product_cat');
						if($counter==0)
						{
							echo "<div id='cat{$tab['tab_cat']}' class='tab-pane fade in active'>";
						}
						else
						{
							echo "<div id='cat{$tab['tab_cat']}' class='tab-pane fade in'>";
						}
						
						$products=new WP_Query(
						   array(
							'post_type'=>'product',
							'product_cat'=>$term->slug,
							'posts_per_page'=>12
						   )
						);

						   if($products->have_posts())
						   {
							    while($products->have_posts())
								{
									$products->the_post();
									global $product;
									?>
									<div class="col-md-3 col-sm-4 col-xs-6">
										<div class="tab-item">
											<figure>
												<img src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="">
											</figure>
											<div class="tab-item-content">
												<h6><?php the_title(); ?></h6>
												<span><?php echo $product->get_price_html(); ?></span>
											</div>
										</div>
									</div>
									<?php
								}
						   }
						$counter++;
						echo '</div>' ;
					}
					
					?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>