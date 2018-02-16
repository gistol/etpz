<?php $this->layout()->setLayout("etpz"); ?>

<div id="page-content">
    <div id="page-header" class="parallax" data-stellar-background-ratio="0.1" style="background-image: url(&quot;/website/static/etpz/images/backgrounds/page-header-7.jpg&quot;); background-position: 50% 495px;"> 
        <div id="page-header-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1><?= $this->getTitle() ?></h1>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- container -->
        </div><!-- page-header-content -->
    </div><!-- page-header -->
    <br>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="isotope col-3">
                    <?php
                    if ($this->brands) {
                        foreach ($this->brands as $brand) {
                            ?>
                            <div class="isotope-item">
                                <div class="portfolio-item">
                                    <div class="portfolio-item-details">
                                        <h5><a href="/brands/<?= strtolower($brand['name']) ?>"><?= $brand['name'] ?></a></h5>
                                    </div><!-- portfolio-item-details -->
                                </div><!-- portfolio-item -->
                            </div><!-- isotope-item -->
                            <?php
                        }
                    }
                    ?>
                </div><!-- isotope -->

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->
</div>