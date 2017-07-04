<?php
   $woolearn_footer = woolearn_get_option("woolearn_footer_group");
   $woolearn_footer = $woolearn_footer[0];
   ?>
<div class="clearfix"></div>
<div id="newsletter">
   <div class="newsletter text-center">
      <?php dynamic_sidebar('wg_news'); ?>
      <p>با عضـویت در خبرنامه هـــیچ یک از مطالـب سایت را از دست نخواهیـد داد و همیـــشه بروز خواهــید بود</p>
   </div>
</div>
<div class="clearfix"></div>
<footer>
   <div class="footer-content">
      <div class="container">
         <div class="row">
            <?php dynamic_sidebar('wg_footer'); ?>
         </div>
      </div>
   </div>
   <div class="footer-bottom">
      <p><?php echo $woolearn_footer['copy']; ?></p>
   </div>
</footer>
<?php  wp_footer(); ?>
</body>
</html>