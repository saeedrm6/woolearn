<?php
$woolearn_preorder = woolearn_get_option("woolearn_preorder_group");
$woolearn_preorder=$woolearn_preorder[0];
?>
<section id="pre-order">
    <div class="container">
        <div class="row">
            <div class="pre-order">
                <div class="col-md-6">
                    <img src="<?php echo $woolearn_preorder['image']; ?>" alt="">
                </div>
                <div class="col-md-6">
                    <div class="pre-order-content">
                        <div class="col-md-12">
                            <div class="pre-order-title">
                                <?php echo $woolearn_preorder['title']; ?>
                            </div>
                            <p>
                                <?php echo $woolearn_preorder['desc']; ?>
                            </p>
                            <?php echo do_shortcode($woolearn_preorder['contact_form']);  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>