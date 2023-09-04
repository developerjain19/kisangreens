<?php $this->load->view('includes/header'); ?>
<?php $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<section class="inner-section single-banner" style="background: url(images/single-banner.jpg) no-repeat center;">
    <div class="container">
        <h2><?= $details['product_name']; ?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Details</li>
        </ol>
    </div>
</section>
<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="details-gallery">
                    <div class="details-label-group"><label class="details-label new"><?= $details['quantity']; ?> <?= $details['quantity_type']; ?></label></div>
                    <ul class="details-preview">
                        <?php
                        $i = 0;
                        if ($products_image) {
                            foreach ($products_image as $img) {
                                $i = $i + 1;
                        ?>
                                <li><img src="<?= setImage($img['image_path'], 'upload/product/') ?>" alt="<?= $details['product_name']; ?>"></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                    <ul class="details-thumb">
                        <?php
                        $i = 0;
                        if ($products_image) {
                            foreach ($products_image as $img) {
                                $i = $i + 1;
                        ?>
                                <li><img src="<?= setImage($img['image_path'], 'upload/product/') ?>" alt="<?= $details['product_name']; ?>"></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="details-content">
                    <h3 class="details-name"><a href="#"><?= $details['product_name']; ?></a></h3>
                    <div class="details-meta">
                        <p>SKU:<span>#ITEM<?= $details['product_id']; ?></span></p>
                        <label class="details-label new"><?= $details['quantity']; ?> <?= $details['quantity_type']; ?></label>
                    </div>
                    <div class="details-rating"><i class="active icofont-star"></i><i class="active icofont-star"></i><i class="active icofont-star"></i><i class="active icofont-star"></i><i class="icofont-star"></i><a href="#">(3 reviews)</a>
                    </div>
                    <h3 class="details-price"><del>₹<?= $details['market_price']; ?></del><span>₹<?= $details['sale_price']; ?></span></h3>
                    <p class="details-desc">
                        <?= substr($details['description'], '0', '160'); ?> ...<a href="#description">More details</a> 
                    </p>

                    <div class="details-list-group"><label class="details-list-title">Share:</label>
                        <ul class="details-share-list">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?= $server_link ?>&t=<?= $details['product_name']; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" class="icofont-facebook" title="Facebook"></a></li>
                            <li><a href="https://twitter.com/share?url=<?= $server_link ?>&text=<?= $details['product_name']; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" class="icofont-twitter" title="Twitter"></a></li>
                            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $server_link ?>&t=<?= $details['product_name']; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" class="icofont-linkedin" title="Linkedin"></a></li>
                            <li><a href="whatsapp://send?text=<?= $server_link ?>" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp" class="icofont-whatsapp" title="Whatsapp"><i class="fab fa-whatsapp"></i> </a></li>
                        </ul>
                    </div>
                    <div class="details-add-group">
                    <div class="product-action">
                    <button class="action-minus" title="Quantity Minus" data-rowid="<?= $details['product_id'] ?>" data-type="sidecart"><i class="icofont-minus"></i></button>
                    <input class="action-input" title="Quantity Number" id="qtysidecart<?= $details['product_id'] ?>" type="text" name="quantity" value="1">
                    <button class="action-plus" title="Quantity Plus" data-rowid="<?= $details['product_id'] ?>" data-type="sidecart"><i class="icofont-plus"></i></button>
                </div>
                    </div>
                    <div class="details-action-group">
                         <button class="product-add  addCart  crtbtn-<?= $details['product_id'] ?>" data-id="<?= $details['product_id'] ?>" title="Add to Cart"><i class="fas fa-shopping-basket"></i><span>add</span></button>
                         <button class="details-compare bgchawlk  buynow" data-id="<?= $details['product_id'] ?>" title="Buy Now"><i class="fas fa-shopping-basket"></i><span> Buy Now</span></button>
                 </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="inner-section" id="description">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs">
                    <li><a href="#tab-desc" class="tab-link active" data-bs-toggle="tab">descriptions</a></li>
                    <li><a href="#tab-reve" class="tab-link" data-bs-toggle="tab">reviews (2)</a></li>
                </ul>
            </div>
        </div>
        <div class="tab-pane fade show active" id="tab-desc">
            <div class="row">
                <div class="col-lg-12" >
                    <div class="product-details-frame">
                        <div class="tab-descrip">
                            <p><?= $details['description'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab-reve">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-details-frame">
                        <ul class="review-list">
                            <li class="review-item">
                                <div class="review-media"><a class="review-avatar" href="#"><img src="images/avatar/01.jpg" alt="review"></a>
                                    <h5 class="review-meta"><a href="#">miron mahmud</a><span>June 02, 2020</span>
                                    </h5>
                                </div>
                                <ul class="review-rating">
                                    <li class="icofont-ui-rating"></li>
                                    <li class="icofont-ui-rating"></li>
                                    <li class="icofont-ui-rating"></li>
                                    <li class="icofont-ui-rating"></li>
                                    <li class="icofont-ui-rate-blank"></li>
                                </ul>
                                <p class="review-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Ducimus hic amet qui velit, molestiae suscipit perferendis, autem doloremque
                                    blanditiis dolores nulla excepturi ea nobis!</p>
                            </li>
                       
                        </ul>
                    </div>
                    <div class="product-details-frame">
                        <h3 class="frame-title">add your review</h3>
                        <form class="review-form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="star-rating"><input type="radio" name="rating" id="star-1"><label for="star-1"></label><input type="radio" name="rating" id="star-2"><label for="star-2"></label><input type="radio" name="rating" id="star-3"><label for="star-3"></label><input type="radio" name="rating" id="star-4"><label for="star-4"></label><input type="radio" name="rating" id="star-5"><label for="star-5"></label></div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group"><textarea class="form-control" placeholder="Describe"></textarea></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group"><input type="text" class="form-control" placeholder="Name"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group"><input type="email" class="form-control" placeholder="Email"></div>
                                </div>
                                <div class="col-lg-12"><button class="btn btn-inline"><i class="icofont-water-drop"></i><span>drop your review</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-heading">
                    <h2>related this items</h2>
                </div>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">

        <?php
                    $similar = getRowsByMoreIdWithOrderlimit('product', array('category_id' => $details['category_id'])  , 'product_id', 'DESC' , '10');
                    if (!empty($similar)) {
                        foreach ($similar as $row) {
                            echo '<div class="col">';
                            product($row, 'normal');
                            echo '</div>';
                        }
                    }
                    ?>

          



        </div>
    </div>
</section>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>

</body>

</html>