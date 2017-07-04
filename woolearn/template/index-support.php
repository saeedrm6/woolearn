<?php
$woolearn_supports = woolearn_get_option("woolearn_support_group");
if( is_array($woolearn_supports) ){
    ?>
    <section id="support">
        <div class="container">
            <div class="row">
                <div class="support shadow-around">
                    <?php
                    foreach( $woolearn_supports as $i => $support_item){
                        $active_class = ($i == 0) ? "active" : "" ;
                        $image_url = wp_get_attachment_image_src( $support_item['image_id'], "thumbnail" );
                        $image_url = @$image_url[0];
                        ?>
                        <div class="col-md-2">
                            <a href="<?php echo @$support_item['link']; ?>"><img src="<?php echo $image_url; ?>" alt=""></a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
<?php
}
?>