<?php get_header(); ?>
<?php while(have_posts()) : the_post(); ?>
<div class="cover-single">
   <div class="container">
      <div class="row">
         <h1><?php the_title(); ?></h1>
         <?php woocommerce_breadcrumb(); ?>
      </div>
   </div>
</div>
<div class="clearfix"></div>
<div class="container">
   <div class="row">
      <div class="block-white shadow-around">
         <?php the_content(); ?>
      </div>
   </div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>