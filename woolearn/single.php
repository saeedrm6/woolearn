<?php get_header(); ?>
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
      <div class="col-md-9">
         <div class="blog-wrapper">
            <?php while(have_posts()) : the_post(); ?>
            <div class="blog-item shadow-around">
               <figure>
                  <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                  <div class="meta-time">
                     <span class="date"><em><?php echo get_the_date('d'); ?></em> <?php echo get_the_date('F'); ?></span>
                     <span class="year"><?php echo get_the_date('Y'); ?></span>
                  </div>
               </figure>
               <header>
                  <h2 class="title-blog">
                     <?php the_title(); ?>
                  </h2>
               </header>
               <article>
                  <?php the_content(); ?>
               </article>
               <footer>
                  <div class="blog-social">
                     <div class="title-social">
                        <i class="fa fa-share-alt"></i>
                        <div class="content-social">
                           اشتراک در شبکه های اجتماعی
                        </div>
                     </div>
                     <ul>
                        <li><a href="http://www.facebook.com/share.php?v=4&src=bm&u=<?php the_permalink(); ?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="http://plus.google.com/share?url=<?php the_permalink(); ?>" class="goops"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="http://twitter.com/home?status=<?php the_permalink(); ?>" class="twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                     </ul>
                  </div>
                  <div class="clearfix"></div>
                  <div class="tags-item">
                     <i class="fa fa-tags"></i>
                     <?php the_tags('',''); ?>
                  </div>
               </footer>
            </div>
            <?php endwhile; ?>
         </div>
      </div>
      <div class="col-md-3">
         <div class="sidebar">
            <?php dynamic_sidebar('first_sidebar'); ?>
            <?php dynamic_sidebar('second_sidebar'); ?>
         </div>
      </div>
   </div>
</div>
<?php get_footer(); ?>