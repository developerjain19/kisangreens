<?php $this->load->view('includes/header'); ?>
<section class="inner-section single-banner">
    <div class="container">
        <h2>Your Order History</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders</li>
        </ol>
    </div>
</section>
<section class="inner-section orderlist-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="orderlist-filter">
                    <h5>Welcome <span><?= sessionId('login_user_name') ?></span></h5>
                    <div class="filter-short"><label class="form-label"></label>
                        <a href="<?= base_url('profile') ?>" style="color:green">My Profile<i class="icofont-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    echo "<h4 class='heading text-dark'>My Orders</h4>";
                    $i = 0;
                    if (!empty($orderDetails)) {
                        foreach ($orderDetails as $row) {
                            if ($row['booking_status'] != 2) {
                                $i = $i + 1;
                                $getnum = getNumRows('tbl_book_item', array('order_id' => $row['order_id']));
                    ?>
                                <div class="orderlist">
                                    <div class="orderlist-head">
                                        <h5>order#<?= $i ?></h5>
                                        <h5>order
                                            <?= ($row['booking_status'] == '0' ? 'Placed' : ($row['booking_status'] == '1' ? 'Accepted' : ($row['booking_status'] == '3' ? 'Dispatch' : ($row['booking_status'] == '4' ? 'Complete' : '<span class="text-danger">Cancel</span>')))) ?>
                                        </h5>
                                    </div>
                                    <div class="orderlist-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="order-track">
                                                    <ul class="order-track-list">
                                                        <li class="order-track-item placed active"><i class="icofont-check"></i><span>order
                                                                Placed</span></li>
                                                        <li class="order-track-item accept  <?php if (($row['booking_status'] == '1') ||  ($row['booking_status'] == '3') || ($row['booking_status'] == '4')) {
                                                                                            echo 'active';
                                                                                        } else {
                                                                                        } ?>">
                                                            <?php if (($row['booking_status'] == '1') ||  ($row['booking_status'] == '3') || ($row['booking_status'] == '4')) {
                                                                echo '<i class="icofont-check"></i>';
                                                            } else {
                                                                echo '<i class="icofont-close"></i>';
                                                            } ?>
                                                            <span>order
                                                                Accepted</span>
                                                        </li>

                                                        <li class="order-track-item dispatch  <?php if (($row['booking_status'] == '4') ||  ($row['booking_status'] == '3')) {
                                                                                            echo 'active';
                                                                                        } else {
                                                                                        } ?>">
                                                            <?php if (($row['booking_status'] == '4') ||  ($row['booking_status'] == '3')) {
                                                                echo '<i class="icofont-check"></i>';
                                                            } else {
                                                                echo '<i class="icofont-close"></i>';
                                                            } ?> <span>order Dispatch</span></li>



                                                        <li class="order-track-item   <?= ($row['booking_status'] == '4' ? 'active' :  '') ?>"> <?= ($row['booking_status'] == '4' ? '<i class="icofont-check"></i>' :  '<i class="icofont-close"></i>') ?><span>order
                                                                delivered</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <ul class="orderlist-details">
                                                    <li>
                                                        <h6>order id</h6>
                                                        <p><?= $row['order_id'] ?></p>
                                                    </li>
                                                    <li>
                                                        <h6>Total Item</h6>
                                                        <p><?= $getnum ?> Items</p>
                                                    </li>
                                                    <li>
                                                        <h6>Order Time</h6>
                                                        <p><?= $row['booking_date'] ?></p>
                                                    </li>
                                                    <li>
                                                        <h6>Delivery Time</h6>
                                                        <p><?= ($row['estimated_time'] != '' ? $row['estimated_time'] : 'Updated Soon...') ?></p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-4">
                                                <ul class="orderlist-details">
                                                    <li>
                                                        <h6>Sub Total</h6>
                                                        <p>₹ <?= $row['total_item_amount'] ?></p>
                                                    </li>
                                                    <li>
                                                        <h6>Coupon discount</h6>
                                                        <p><?= ($row['promocode_amount'] > '0' ? '₹     ' . $row['promocode_amount'] : '...') ?></p>
                                                    </li>
                                                    <li>
                                                        <h6>delivery fee</h6>
                                                        <p><?= ($row['delivery_charges'] > '0' ? '₹' . $row['delivery_charges'] : 'Free') ?></p>
                                                    </li>
                                                    <li>
                                                        <h6>Total</h6>
                                                        <p>₹ <?= $row['final_amount'] ?></p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="orderlist-deliver">
                                                    <h6>Delivery location</h6>
                                                    <p><?= $row['address'] ?></p>
                                                    <hr>
                                                    <h6>Pin Code
                                                        : <?= $row['postal_code'] ?></h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="table-scroll">
                                                    <table class="table-list">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Serial</th>
                                                                <th scope="col">Product</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Price</th>
                                                                <th scope="col">quantity</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $j = 0;
                                                            $checkoutProduct = getRowById('tbl_book_item', 'order_id', $row['order_id']);
                                                            if (!empty($checkoutProduct)) {
                                                                foreach ($checkoutProduct as $productRow) {
                                                                    $products = getRowById('product', 'product_id', $productRow['product_id'])[0];
                                                                    $data = getSingleRowById('product_image', array('product_id' => $products['product_id']));
                                                                    $j = $j + 1;
                                                            ?>
                                                                    <tr>
                                                                        <td class="table-serial">
                                                                            <h6><?= $j ?></h6>
                                                                        </td>
                                                                        <td class="table-image"><img src="<?= setImage($data['image_path'], 'upload/product/') ?>" alt="<?= $products['product_name'] ?>"></td>
                                                                        <td class="table-name">
                                                                            <h6><?= $products['product_name'] ?></h6>
                                                                        </td>
                                                                        <td class="table-price">
                                                                            <h6>₹ <?= $products['sale_price'] ?><small>/<?= $products['quantity'] ?><?= $products['quantity_type'] ?></small></h6>
                                                                        </td>
                                                                        <td class="table-quantity">
                                                                            <h6><?= $productRow['no_of_items'] ?></h6>
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php }
                            unset($row);
                        }
                    } else {
                        echo '<h3 class="text-center">No Order History Found</h3>';
                    }
                    ?>
                </div>
            </div>
    
      <div class="row">
                <div class="col-lg-12">
                    <?php
                    $i = 0;
                    if (!empty($cancelOrderDetails)) {

                        echo "<h4 class='heading'>Cancelled orders</h4>";
                        foreach ($cancelOrderDetails as $row) {
                            $i = $i + 1;
                            $getnum = getNumRows('tbl_book_item', array('order_id' => $row['order_id']));
                    ?>
                            <div class="orderlist">
                                <div class="orderlist-head">
                                    <h5>order#<?= $i ?></h5>
                                    <?php
                                    if ($row['cancel_date']) {
                                    ?>
                                        <h5 class="text-secondary">Cancelled on: <?= $row['cancel_date'] ?></h5>
                                    <?php }
                                    ?>
                                    <h5>
                                        <span class="text-danger"> Order Cancel</span>
                                    </h5>
                                </div>
                                <div class="orderlist-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="order-track">
                                                <ul class="order-track-list">
                                                    <li class="order-track-item placed active"><i class="icofont-check"></i><span>order
                                                            Placed</span></li>


                                                    <li class="order-track-item cancelled  <?= ($row['booking_status'] == '2' ? 'active' :  '') ?>"> <?= ($row['booking_status'] == '4' ? '<i class="icofont-check"></i>' :  '<i class="icofont-close"></i>') ?><span>order
                                                            Cancelled</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <ul class="orderlist-details">
                                                <li>
                                                    <h6>order id</h6>
                                                    <p><?= $row['order_id'] ?></p>
                                                </li>
                                                <li>
                                                    <h6>Total Item</h6>
                                                    <p><?= $getnum ?> Items</p>
                                                </li>
                                                <li>
                                                    <h6>Order Time</h6>
                                                    <p><?= $row['booking_date'] ?></p>
                                                </li>
                                                <li>
                                                    <h6>Delivery Time</h6>
                                                    <p><?= ($row['estimated_time'] != '' ? $row['estimated_time'] : 'Updated Soon...') ?></p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-4">
                                            <ul class="orderlist-details">
                                                <li>
                                                    <h6>Sub Total</h6>
                                                    <p>₹ <?= $row['total_item_amount'] ?></p>
                                                </li>
                                                <li>
                                                    <h6>discount</h6>
                                                    <p><?= ($row['promocode_amount'] > '0' ? '₹     ' . $row['promocode_amount'] : '...') ?></p>
                                                </li>
                                                <li>
                                                    <h6>delivery fee</h6>
                                                    <p><?= ($row['delivery_charges'] > '0' ? '₹' . $row['delivery_charges'] : 'Free') ?></p>
                                                </li>
                                                <li>
                                                    <h6>Total</h6>
                                                    <p>₹ <?= $row['final_amount'] ?></p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="orderlist-deliver">
                                                <h6>Delivery location</h6>
                                                <p><?= $row['address'] ?></p>
                                                <hr>
                                                <h6>Pin Code
                                                    : <?= $row['postal_code'] ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="table-scroll">
                                                <table class="table-list">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Serial</th>
                                                            <th scope="col">Product</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $j = 0;
                                                        $checkoutProduct = getRowById('tbl_book_item', 'order_id', $row['order_id']);
                                                        if (!empty($checkoutProduct)) {
                                                            foreach ($checkoutProduct as $productRow) {
                                                                $products = getRowById('product', 'product_id', $productRow['product_id'])[0];
                                                                $data = getSingleRowById('product_image', array('product_id' => $products['product_id']));
                                                                $j = $j + 1;
                                                        ?>
                                                                <tr>
                                                                    <td class="table-serial">
                                                                        <h6><?= $j ?></h6>
                                                                    </td>
                                                                    <td class="table-image"><img src="<?= setImage($data['image_path'], 'upload/product/') ?>" alt="<?= $products['product_name'] ?>"></td>
                                                                    <td class="table-name">
                                                                        <h6><?= $products['product_name'] ?></h6>
                                                                    </td>
                                                                    <td class="table-price">
                                                                        <h6>₹ <?= $products['sale_price'] ?><small>/<?= $products['quantity'] ?><?= $products['quantity_type'] ?></small></h6>
                                                                    </td>
                                                                    <td class="table-quantity">
                                                                        <h6><?= $productRow['no_of_items'] ?></h6>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    }
                    ?>
                </div>
            </div>
        </div>
</section>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
</body>

</html>