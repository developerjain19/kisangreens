<?php
function product($row, $ss)
{
    $data = getSingleRowById('product_image', array('product_id' => $row['product_id']));
?>
    <div class="product-card">
        <div class="product-media">
            <div class="product-label">
                <?php if ($ss == 'new') {  ?>
                    <label class="label-text new">new</label>
                <?php  } else if ($ss == 'rate') { ?>
                    <label class="label-text rate">4.8</label>

                <?php  } else  if ($ss == 'discount') { ?>
                    <label class="label-text off">-10%</label>

                <?php } else {  ?>
                    <label class="label-text sale"><?= $row['quantity']; ?> <?= $row['quantity_type']; ?></label>
                <?php } ?>


            </div>
            <button class="product-wish wish"><i class="fas fa-heart"></i></button>

            <a class="product-image" href="<?= base_url('product-details/' . encryptId($row['product_id']) . '/' . url_title($row['product_name'])) ?>">
                <img src="<?= setImage($data['image_path'], 'upload/product/') ?>" alt="product"></a>


            <!-- <div class="product-widget"><a title="Product Compare" href="compare.html" class="fas fa-random"></a><a title="Product Video" href="https://youtu.be/9xzcVxSBbG8" class="venobox fas fa-play" data-autoplay="true" data-vbtype="video"></a><a title="Product View" href="#" class="fas fa-eye" data-bs-toggle="modal" data-bs-target="#product-view"></a></div> -->
        </div>
        <div class="product-content">
            <div class="product-rating"><i class="active icofont-star"></i><i class="active icofont-star"></i><i class="active icofont-star"></i><i class="active icofont-star"></i><i class="icofont-star"></i><a href="<?= base_url('product-details/' . encryptId($row['product_id']) . '/' . url_title($row['product_name'], 'dash', true)) ?>">(3)</a></div>
            <h6 class="product-name"><a href="<?= base_url('product-details/' . encryptId($row['product_id']) . '/' . url_title($row['product_name'], 'dash', true)) ?>"><?= $row['product_name']; ?></a></h6>
            <h6 class="product-price"><del>₹<?= $row['market_price']; ?></del><span>₹<?= $row['sale_price']; ?><small></small></span></h6>


            <button class="product-add  addCart  crtbtn-<?= $row['product_id'] ?>" data-id="<?= $row['product_id'] ?>" title="Add to Cart"><i class="fas fa-shopping-basket"></i><span>add</span></button>
            <div class="product-action">
                <button class="action-minus" title="Quantity Minus" data-rowid="<?= $row['product_id'] ?>" data-type="sidecart"><i class="icofont-minus"></i></button>
                <input class="action-input" title="Quantity Number" id="qtysidecart<?= $row['product_id'] ?>" type="text" name="quantity" value="1">
                <button class="action-plus" title="Quantity Plus" data-rowid="<?= $row['product_id'] ?>" data-type="sidecart"><i class="icofont-plus"></i></button>
            </div>
        </div>
    </div>

<?php
}
?>