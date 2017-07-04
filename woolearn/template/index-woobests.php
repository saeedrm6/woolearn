<?php
   $products=new WP_Query(
   array(
   	'post_type'=>'product',
   	'product_cat'=>'best',
   	'posts_per_page'=>6
   )
   );
   
   if($products->have_posts())
   {
    
   ?>
<section id="new-product">
   <div class="new-product">
      <div class="container">
         <div class="row">
            <div class="col-md-9">
               <div class="title">
                  <h2>بهترین ها در وولرن</h2>
                  <sub>به روز شده در ۲۵ خرداد ۹۵</sub>
               </div>
               <div id="myCarousel-second" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                     <?php
                        for($i=0; $i< ceil($products->post_count/3);$i++)
                        {
                        	if($i==0)
                        	{
                        		echo  '<li data-target="#myCarousel-second" data-slide-to="0" class="active"></li>';
                        	}
                        	else
                        	{
                        		echo '<li data-target="#myCarousel-second" data-slide-to="'.$i.'"></li>';
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
                        	if($i%3==0)
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
                        	set_query_var('class','col-md-4');
                        	get_template_part('template/loop','product');
                        
                        	$i++;
                        	if($i%3==0)
                        	{
                        		echo '</div>';
                        	}
                        }
                        
                        if(($i%3) !=0)
                        	{
                        		echo '</div>';
                        	}
                        
                        ?>
                     <a class="left carousel-control left-arrow" href="#myCarousel-second" role="button" data-slide="prev">
                     <span class="fa fa-chevron-left" aria-hidden="true"></span>
                     <span class="sr-only">Previous</span>
                     </a>
                     <a class="right carousel-control right-arrow" href="#myCarousel-second" role="button" data-slide="next">
                     <span class="fa fa-chevron-right" aria-hidden="true"></span>
                     <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="quick-access">
                  <form action="" class="search-form">
                     <input name="s" type="text" placeholder="محصول مورد نظرتان را جستجو کنید...">
					 <input type='hidden' name="post_type" value='product' >
                     <button type="submit"><i class="fa fa-search"></i></button>
                  </form>
                  <ul>
				  <?php
					$cats=get_terms(
						array(
							'taxonomy'=>'product_cat'
						)
					);
					//var_dump($cats);
					foreach($cats as $cat)
					{
						$link=get_term_link($cat);
						echo "<li><a href='{$link}'><span>{$cat->count}</span>{$cat->name}</a></li>";
					}
				  
				  
				  ?>
                     
                     
                  </ul>
               </div>
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