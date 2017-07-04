<?php
$woolearn_customers = woolearn_get_option("woolearn_customer_group");
//
?>
<section id="customers">
    <div class="customers">
        <div class="container">
            <div class="row">
                <div id="myCarousel-fifth" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                        $i=0;
                        foreach($woolearn_customers as $customer)
                        {
                            if ($i == 0) {
                                echo '<li data-target="#myCarousel-fifth" data-slide-to="0" class="active"></li>';
                            } else {
                                echo "<li data-target=\"#myCarousel-fifth\" data-slide-to=\"{$i}\"></li>";
                            }
                            $i++;
                        }
                        ?>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $i=0;
                        foreach($woolearn_customers as $customer)
                        {
                        if($i==0)
                        {
                            echo '<div class="item active">';
                        }
                        else
                        {
                            echo '<div class="item">';
                        }
                        ?>
                        <div class="col-md-6 col-md-offset-3">
                            <div class="customers-item">
                                <div class="customers-thumb">
                                    <?php
                                    $image_id=$customer['image_id'];
                                    $image=wp_get_attachment_image_src($image_id,'thumbnail');
                                    ?>
                                    <img src="<?php echo $image[0]; ?>" alt="" class="shadow-around">
                                </div>
                                <div class="customers-content">
                                    <p>
                                        <?php echo $customer['desc']; ?>
                                    </p>
                                </div>
                                <div class="customers-title">
                                    <span><?php echo $customer['name']; ?></span>
                                </div>
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