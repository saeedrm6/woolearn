<section id="blog">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>آخرین اخبار</h2>
                    <sub>به روز ۲۵ خرداد ۹۵</sub>
                </div>
                <div class="blog">
				<?php while(have_posts()) : the_post(); ?>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <article class="shadow-around">
                            <figure><img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"></figure>
                            <div class="blog-content">
                                <header>
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                </header>
                                <p>
                                    <?php echo get_the_excerpt(); ?>
                                </p>
                            </div>
                        </article>
                    </div>
					<?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>