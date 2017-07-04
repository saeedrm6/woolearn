<?php
$woolearn_ads = woolearn_get_option("woolearn_ads_group");
if(  is_array($woolearn_ads) ) {
    ?>
    <section id="ads">
        <div class="container">
            <div class="row">
                <?php
                foreach ($woolearn_ads as $i => $ads_item) {
                    ?>
                    <div class="col-md-6 no-lpadding">
                        <div class="ads-item">
                            <a href="<?php echo @$ads_item['link']; ?>">
                                <div class="ads-content">
                                    <span><?php echo @$ads_item['title']; ?></span>
                                </div>
                                <img src="<?php echo @$ads_item['image']; ?>" alt="<?php echo @$ads_item['title']; ?>"
                                     class="shadow-around">
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
<?php
}
?>