<?php $this->layout()->setLayout("etpz"); ?>

<div id="page-content">

    <div id="page-header" class="parallax" data-stellar-background-ratio="0.1" style="background-image:url(/website/static/etpz/images/backgrounds/page-header-7.jpg);"> 
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
                <div class="isotope col-3 gutter">
                    <?php
                    if ($this->products) {
                        foreach ($this->products as $product) {
                            ?>
                            <div class="isotope-item">
                                <div class="portfolio-item">
                                    <div class="portfolio-item-thumbnail">
                                        <img src="<?= $product->getPicture() ?>" alt="">
                                        <div class="portfolio-item-hover">
                                            <a class="fancybox zoom-action" data-fancybox-group="portfolio" href="<?= $product->getPicture() ?>">+</a>
                                        </div><!-- portfolio-item-hover -->
                                    </div><!-- portfolio-item-thumbnail -->
                                    <div class="portfolio-item-details">
                                        <h5><a href="/products/<?= $product->getId() ?>"><?= $product->getName() ?></a></h5>
                                        <div class="project-description">
                                            <p><?= $product->getDescription() ?></p>
                                            <br>
                                            <ul class="project-details">
                                                <li><span>Price: </span>
                                                    <?php
                                                    if ($this->currency_array[$product->getCurrencyid()]['name'] == "RUB") {
                                                        echo $product->getPrice();
                                                    } else {
                                                        echo round($product->getPrice() * $this->currency_array[$product->getCurrencyid()]['rate']);
                                                    }
                                                    ?> руб.
                                                </li>
                                            </ul>
                                        </div><!-- project-description -->
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

    <?php
    if ($this->products) {

        echo $this->paginationControl($this->products, 'Sliding', '/includes/pagination.php', [
            'urlprefix' => $this->document->getFullPath() . '?page=',
            'appendQueryString' => true
        ]);
    }
    ?>

</div>