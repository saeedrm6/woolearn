 <?php
 $products=new WP_Query(
	array(
		'post_type'=>'product',
		'posts_per_page'=>8
	)
 );

 if($products->have_posts())
 {
	 
 ?>
 <section id="new-product">
        <div class="new-product">
            <div class="container">
                <div class="row">
                    <div class="title">
                        <h2>جدید ترین محصولات</h2>
                        <sub>به روز شده در ۲۵ خرداد ۹۵</sub>
                    </div>
                    <div id="myCarousel-third" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
							<?php
							for($i=0; $i< ceil($products->post_count/4);$i++)
							{
								if($i==0)
								{
									echo  '<li data-target="#myCarousel-third" data-slide-to="0" class="active"></li>';
								}
								else
								{
									echo '<li data-target="#myCarousel-third" data-slide-to="'.$i.'"></li>';
								}
							}
							?>
                        </ol>
                        <div class="carousel-inner" role="listbox">
						<?php
						
						$i=0;
						while($products->have_posts())
						{
							$products->the_post();
							if($i%4==0)
							{
								if($i==0)
								{
									echo  '<div class="item active">';
								}
								else
								{
									echo '<div class="item">';
								}
							}
							set_query_var('class','col-md-3');
							get_template_part('template/loop','product');

							$i++;
							if($i%4==0)
							{
								echo '</div>';
							}
						}
						
						?>
					   </div>
                        <a class="left carousel-control left-arrow" href="#myCarousel-third" role="button" data-slide="prev">
                            <span class="fa fa-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control right-arrow" href="#myCarousel-third" role="button" data-slide="next">
                            <span class="fa fa-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
<?php
}
wp_reset_postdata();
?>