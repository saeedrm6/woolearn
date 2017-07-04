<?php $woolearn_services = woolearn_get_option("woolearn_service_group"); if(  is_array($woolearn_services) ) : ?>
<section id="services">
   <div class="services shadow-bottom">
      <div class="container">
         <div class="row">
            <?php foreach( $woolearn_services as $i => $service_item) { ?>
            <div class="col-md-3">
               <i class="fa <?php echo $service_item['fa_icon']; ?>"></i>
               <div class="content">
                  <h4><?php echo $service_item['title']; ?></h4>
                  <p><?php echo $service_item['subtitle']; ?></p>
               </div>
            </div>
            <?php } ?>
         </div>
      </div>
   </div>
</section>
<div class="clearfix"></div>
<?php endif; ?>