<?php
   $middle_slider = woolearn_get_option("woolearn_slider_middle_group");
   ?>
<section id="special-offers">
   <div class="special-offers">
      <div class="container">
         <div class="row">
            <div id="myCarousel-fourth" class="carousel slide" data-ride="carousel">
               <ol class="carousel-indicators">
                  <?php
                     $i=0;
                     foreach($middle_slider as $item)
                     {
                         if( $i==0)
                         {
                             echo  " <li data-target=\"#myCarousel-fourth\" data-slide-to=\"0\" class=\"active\"></li>";
                         }
                         else
                         {
                             echo  "<li data-target=\"#myCarousel-fourth\" data-slide-to=\"{$i}\"></li>";
                         }
                         $i++;
                     }
                     ?>
               </ol>
               <div class="carousel-inner" role="listbox">
                  <?php
                     $i=0;
                     foreach($middle_slider as $item)
                     {
                     if( $i==0)
                     {
                         echo  "<div class=\"item active\">";
                     }
                     else
                     {
                         echo  "<div class=\"item\">";
                     }
                     ?>
                  <div class="col-md-6">
                     <div class="offer">
                        <div class="col-md-8 no-padding offer-content">
                           <h2><?php echo $item['title1']; ?></h2>
                           <p>
                              <?php echo $item['desc1']; ?>
                           </p>
                           <ul>
                              <li><a href="<?php echo @$item['first_button_link1']; ?>" class="btn-green"><?php echo $item['first_button1']; ?></a></li>
                              <li><a href="<?php echo @$item['second_button_link1']; ?>" class="btn-white"><?php echo $item['second_button1']; ?></a></li>
                           </ul>
                        </div>
                        <figure class="col-md-4 no-padding">
                           <img src="<?php echo @$item['image1']; ?>" alt="">
                        </figure>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="offer">
                        <div class="col-md-8 no-padding offer-content">
                           <h2><?php echo $item['title2']; ?></h2>
                           <p>
                              <?php echo $item['desc2']; ?>
                           </p>
                           <ul>
                              <li><a href="<?php echo @$item['first_button_link2']; ?>" class="btn-green"><?php echo $item['first_button2']; ?></a></li>
                              <li><a href="<?php echo @$item['second_button_link2']; ?>" class="btn-white"><?php echo $item['second_button2']; ?></a></li>
                           </ul>
                        </div>
                        <figure class="col-md-4 no-padding">
                           <img src="<?php echo @$item['image2']; ?>" alt="">
                        </figure>
                     </div>
                  </div>
               </div>
               <?php
                  $i++;
                  }
                  ?>
            </div>
         </div>
      </div>
   </div>
   </div>
</section>
<div class="clearfix"></div>