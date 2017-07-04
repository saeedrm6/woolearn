<?php
$top_slider = woolearn_get_option("woolearn_slider_group");
?>
<section id="slider">
    <div class="slider">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                $i=0;
                foreach($top_slider as $item)
                {
                    if( $i==0)
                    {
                        echo  "<li data-target='#myCarousel' data-slide-to='{$i}' class='active'></li>";
                    }
                    else
                    {
                        echo  "<li data-target='#myCarousel' data-slide-to='{$i}' ></li>";
                    }
                    $i++;
                }
                ?>
            </ol>
            <div class="container">
                <div class="row">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $i=0;
                        foreach($top_slider as $item)
                        {
                        if( $i==0)
                        {
                            echo  "<div class=\"item active\">";
                        }
                        else
                        {
                            echo  "<div class=\"item\">";
                        }
                        ?>
                        <div class="col-md-6">
                            <img src="<?php echo $item['image']; ?>" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="slide-content">
                                <h1><?php echo $item['title']; ?></h1>
                                <p><?php echo $item['desc']; ?></p>
                                <a href="<?php echo @$item['first_button_link']; ?>" class="btn btn-gray shadow-around"><?php echo $item['first_button']; ?></a>
                                <a href="<?php echo @$item['second_button_link']; ?>" class="btn btn-blue shadow-around"><?php echo $item['second_button']; ?></a>
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