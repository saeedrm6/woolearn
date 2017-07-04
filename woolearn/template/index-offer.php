<?php
$woolearn_order = woolearn_get_option("woolearn_offer_group");
$woolearn_order=$woolearn_order[0];


$timer=0;
$now=current_time('timestamp');
$start_time=$woolearn_order['start_timestamp'];
$duration=$woolearn_order['duration'] * 60;
if(($now>$start_time) && ( ($now-$start_time) < $duration ) ){
    $timer=$duration - ($now-$start_time);
    $timer= $timer/60;
}
if($timer > 0)
{
    ?>
    <div class="container">
        <section class="sale-timeout">
            <div class="sale-inner">
                <div class="sale-timeout-content">
                    <h2><?php echo $woolearn_order['title']; ?></h2>
                    <span><?php echo $woolearn_order['subtitle']; ?></span>

                    <div class="sale-timeout-counter" data-minutes-left="<?php echo $timer; ?>"></div>
                    <a href="<?php echo $woolearn_order['button_link']; ?>"><?php echo $woolearn_order['button_text']; ?></a>
                </div>
                <figure>
                    <img src="<?php echo $woolearn_order['image']; ?>" alt="">
                </figure>
            </div>
        </section>
    </div>
    <div class="clearfix"></div>
<?php
}
?>