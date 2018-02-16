<?php $this->layout()->setLayout("etpz"); ?>
<?php $product = $this->product; ?>


<div id="page-content">
    <div id="page-header" class="parallax" data-stellar-background-ratio="0.1"> 
        <div id="page-header-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- container -->
        </div><!-- page-header-content -->

    </div><!-- page-header -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="headline">
                    <h1><?= $product->getName() ?></h1>
                </div><!-- headline -->
            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="projects-slider" id="single-project">
                    <div class="project-description">
                        <p><?= $product->getDescription() ?></p>
                        <br>
                        <ul class="project-details">
                            <li><span>Price: </span> <?=$this->product_price?> руб.</li>
                            <li><span>Brand: </span> <?= $product->getBrand_name() ?></li>
                            <li><span>Category: </span> <?=$this->category?></li>
                        </ul>
                    </div><!-- project-description -->
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                            <div class="owl-item active">
                                <div class="item">
                                    <img src="<?= $product->getPicture() ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- project-slider -->
                <ul class="projects-slider-thumbs">
                    <li><a class="active" href="#" data-slide="1"><img src="<?= $product->getPicture() ?>" alt=""></a></li>
                </ul><!-- projects-slider-thumbs -->
            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->


    <br>

</div>