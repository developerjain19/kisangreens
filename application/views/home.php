<?php $this->load->view('includes/header'); ?>
<section class="home-index-slider slider-arrow slider-dots">
    <div class="banner-part banner-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-6">
                    <div class="banner-content">
                        <h1>Freshness Delivered to Your Doorstep</h1>
                        <p>Discover the true essence of farm-fresh produce with KISAN Greens. We bring the vibrant goodness of nature right to your home.
                        </p>
                        <div class="banner-btn"><a class="btn btn-inline" href="#"><i class="fas fa-shopping-basket"></i><span>shop now</span></a><a class="btn btn-outline" href="offer.html"><i class="icofont-sale-discount"></i><span>get offer</span></a></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="banner-img"><img src="<?= base_url() ?>assets/images/home/index/01.png" alt="index"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-part banner-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-6">
                    <div class="banner-img"><img src="<?= base_url() ?>assets/images/home/index/02.png" alt="index"></div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="banner-content">
                        <h1>From Farm to Table, We Deliver Quality</h1>
                        <p>Experience the journey of flavor and nutrition as we source directly from local farmers. Taste the difference with KISAN Greens.</p>
                        <div class="banner-btn"><a class="btn btn-inline" href="<?= base_url('product') ?>"><i class="fas fa-shopping-basket"></i><span>shop now</span></a><a class="btn btn-outline" href="offer.html"><i class="icofont-sale-discount"></i><span>get offer</span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section suggest-part">
    <div class="container">
        <ul class="suggest-slider slider-arrow">
            <?php

            if ($cate != '') {
                foreach ($cate as $row) {
                    $count = getNumRows('product', array('category_id' => $row['category_id']));
            ?>

                    <li>
                        <a class="suggest-card" href="<?= base_url() ?>product?category=<?= encryptId($row['category_id']); ?>&&<?= url_title($row['category_name']); ?>">
                            <img src="<?= base_url(); ?>upload/category/<?= $row['image']; ?>" alt="<?= $row['category_name']; ?>">
                            <h5><?= $row['category_name'] ?> <span><?= $count ?? '0' ?> items</span></h5>
                        </a>
                    </li>

            <?php
                }
            }
            ?>

        </ul>
    </div>
</section>
<section class="section recent-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Recently sold items</h2>
                </div>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

            <?php
            if ($product != '') {
                   foreach ($product as $row) {
                    echo '<div class="col">';
                    product($row, 'normal');
                    echo '</div>';
                }
            }
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-btn-25"><a href="<?= base_url('product') ?>" class="btn btn-outline"><i class="fas fa-eye"></i><span>show more</span></a></div>
                </div>
            </div>
        </div>
</section>
<div class="section promo-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="promo-img"><a href="#"><img src="<?= base_url() ?>assets/images/promo/home/03.jpg" alt="promo"></a></div>
            </div>
        </div>
    </div>
</div>
<section class="section feature-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>our featured items</h2>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
           
        <?php
            if ($featurepro != '') {
                   foreach ($featurepro as $row) {

                    feature_product($row);
                 
                }
            }
            ?>


        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-btn-25"><a href="<?= base_url('product') ?>" class="btn btn-outline"><i class="fas fa-eye"></i><span>show more</span></a></div>
            </div>
        </div>
    </div>
</section>
<section class="section countdown-part">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mx-auto">
                <div class="countdown-content">
                    <h3>special discount offer for vegetable items</h3>
                    <p>Reprehenderit sed quod autem molestiae aut modi minus veritatis iste dolorum suscipit quis voluptatum fugiat mollitia quia minima</p>
                    <div class="countdown countdown-clock" data-countdown="2022/12/22"><span class="countdown-time"><span>00</span><small>days</small></span><span class="countdown-time"><span>00</span><small>hours</small></span><span class="countdown-time"><span>00</span><small>minutes</small></span><span class="countdown-time"><span>00</span><small>seconds</small></span></div>
                    <a href="<?= base_url('product') ?>" class="btn btn-inline"><i class="fas fa-shopping-basket"></i><span>shop now</span></a>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5">
                <div class="countdown-img">
                    <img src="<?= base_url() ?>assets/images/countdown.png" alt="countdown">
                    <div class="countdown-off"><span>20%</span><span>off</span></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section newitem-part">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-heading">
                    <h2>collected new items</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="new-slider slider-arrow">
                    <?php
                    if ($productdesc != '') {

                        foreach ($productdesc as $row) {
                            echo ' <li>';
                            product($row, 'new');
                            echo '</li>';
                        }
                    }
                    ?>


                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="section-btn-25"><a href="<?= base_url('product') ?>" class="btn btn-outline"><i class="fas fa-eye"></i><span>show more</span></a></div>
            </div>
        </div>
    </div>
</section>
<div class="section promo-part">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6 px-xl-3">
                <div class="promo-img"><a href="#"><img src="<?= base_url() ?>assets/images/promo/home/01.jpg" alt="promo"></a></div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 px-xl-3">
                <div class="promo-img"><a href="#"><img src="<?= base_url() ?>assets/images/promo/home/02.jpg" alt="promo"></a></div>
            </div>
        </div>
    </div>
</div>
<section class="section niche-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Browse by Top Niche</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs">
                    <li><a href="#top-order" class="tab-link active" data-bs-toggle="tab"><i class="icofont-price"></i><span>top order</span></a></li>
                    <li><a href="#top-rate" class="tab-link" data-bs-toggle="tab"><i class="icofont-star"></i><span>top rating</span></a></li>
                    <li><a href="#top-disc" class="tab-link" data-bs-toggle="tab"><i class="icofont-sale-discount"></i><span>top discount</span></a></li>
                </ul>
            </div>
        </div>
        <div class="tab-pane fade show active" id="top-order">
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">


                <?php
                if ($product != '') {

                    foreach ($product as $row) {
                        echo '<div class="col">';
                        product($row, 'normal');
                        echo '</div>';
                    }
                }
                ?>


            </div>
        </div>
        <div class="tab-pane fade" id="top-rate">
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

                <?php
                if ($product != '') {

                    foreach ($product as $row) {
                        echo '<div class="col">';
                        product($row, 'rate');
                        echo '</div>';
                    }
                }
                ?>

            </div>
        </div>
        <div class="tab-pane fade" id="top-disc">
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">


                <?php
                if ($product != '') {

                    foreach ($product as $row) {
                        echo '<div class="col">';
                        product($row, 'discount');
                        echo '</div>';
                    }
                }
                ?>


            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-btn-25"><a href="<?= base_url('product') ?>" class="btn btn-outline"><i class="fas fa-eye"></i><span>show more</span></a></div>
            </div>
        </div>
    </div>
</section>

<section class="news-part" style="background: url(images/newsletter.jpg) no-repeat center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 col-lg-6 col-xl-7">
                <div class="news-text">
                    <h2>Get 20% Discount for Subscriber</h2>
                    <p>Deeply rooted in ethics and values</p>
                </div>
            </div>
            <div class="col-md-7 col-lg-6 col-xl-5">
                <form class="news-form"><input type="text" placeholder="Enter Your Email Address"><button><span><i class="icofont-ui-email"></i>Subscribe</span></button></form>
            </div>
        </div>
    </div>
</section>
<section class="intro-part">
    <div class="container">
        <div class="row intro-content">
            <div class="col-sm-6 col-lg-3">
                <div class="intro-wrap">
                    <div class="intro-icon"><i class="fas fa-truck"></i></div>
                    <div class="intro-content">
                        <h5>free home delivery</h5>
                        <p>deeply rooted in ethics and values</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="intro-wrap">
                    <div class="intro-icon"><i class="fas fa-sync-alt"></i></div>
                    <div class="intro-content">
                        <h5>instant return policy</h5>
                        <p>deeply rooted in ethics and values</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="intro-wrap">
                    <div class="intro-icon"><i class="fas fa-headset"></i></div>
                    <div class="intro-content">
                        <h5>quick support system</h5>
                        <p>deeply rooted in ethics and values</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="intro-wrap">
                    <div class="intro-icon"><i class="fas fa-lock"></i></div>
                    <div class="intro-content">
                        <h5>secure payment way</h5>
                        <p>deeply rooted in ethics and values</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/footer-link'); ?>

</body>

</html>