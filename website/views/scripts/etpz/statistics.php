<?php $this->layout()->setLayout("etpz"); ?>
<?php $product = $this->product; ?>
<?php

function buildMenu($array, $parent_link = "/statistics") {
    ?>
    <ul>
        <?php
        $parent_link = $parent_link . "/" . $array['id'];
        ?>
        <li><a href="<?= $parent_link ?>"><?= $array['name'] ?></a></li>
        <?php
        if (!empty($array['children'])) {
            foreach ($array['children'] as $child_array) {
                buildMenu($child_array, $parent_link);
                ?>

                <?php
            }
        }
        ?>
    </ul>             
<?php }
?>

<?php

function buildCategory($array, $parent_link = "/statistics") {
    ?>

    <?php
    $parent_link = $parent_link . "/" . $array['id'];
    ?>
    <div class="blog-article">
        <div class="blog-article-content">
            <h4 class="blog-article-title"><a href="#"><?= $array['name'] ?></a></h4>
            <?php
            if (!empty($array['brands'])) {
                foreach ($array['brands'] as $brands) {
                    ?>
                    <a class="btn btn-white" href="#"><?= $brands['name']; ?><br>
                        <span>Кол-во товаров: <?= $brands['count_products']; ?></span>
                        <span style="padding-left: 20px;">Сумма товаров: <?= $brands['price']; ?> руб.</span>
                    </a>
                    <?php
                }
            }
            ?>

            <?php
            if (!empty($array['children'])) {
                foreach ($array['children'] as $child_array) {
                    buildCategory($child_array, $parent_link);
                    ?>
                    <?php
                }
            }
            ?>
        </div><!-- blog-article-content -->													
    </div><!-- blog-article -->
<?php }
?>


<!-- PAGE CONTENT -->
<div id="page-content">
    <div id="page-header" class="parallax" data-stellar-background-ratio="0.1" style="background-image:url(images/backgrounds/page-header-9.jpg);"> 
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
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="widget widget-search">
                </div><!-- widget-search -->
                <div class="widget widget-categories">
                    <h6 class="widget-title"><span>Categories</span></h6>
                    <?php
                    foreach ($this->category_tree as $array) {
                        echo buildMenu($array);
                    }
                    ?>
                    <style>
                        ul ul {
                            padding-left: 40px;
                        }
                        .btn-white span {
                            font-size: 10px;
                            color: #000;
                        }

                        .btn + .btn {
                            margin-left: 0;
                        }
                        li.active {
                            font-weight: bolder;
                        }

                    </style>
                </div><!-- widget-categories -->
            </div><!-- col -->
            <div class="col-sm-9">
                <h2>Статистика по категориям</h2>
                <?php
                if ($this->category_tree) {
                    foreach ($this->category_tree as $category) {
                        echo buildCategory($category);
                    }
                } else {
                    echo "Статистика с разбивкой по категориям отсутствует";
                }
                ?>
                <h2>Статистика по брендам</h2>
                <?php
                if ($this->category_tree) {
                    foreach ($this->brands_array as $brand) {
                        ?>
                        <div class="blog-article">
                            <div class="blog-article-content">
                                <h4 class="blog-article-title"><a href="#"><?= $brand['name'] ?></a></h4>
                                <a class="btn btn-white" href="#">Кол-во товаров: <?= $brand['count_products']; ?>
                                    <span>Сумма товаров в рублях: <?= $brand['price_rub']; ?> руб.</span>
                                    <span style="padding-left: 20px;">Сумма товаров в долларах: <?= $brand['price_usd']; ?> $</span>
                                </a>
                            </div><!-- blog-article-content -->													
                        </div><!-- blog-article -->
                        <?php
                    }
                } else {
                    echo "Статистика по брендам отсутствует";
                }
                ?>
            </div>								
        </div>
    </div>	
</div>	