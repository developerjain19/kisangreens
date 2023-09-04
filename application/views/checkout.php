<?php $this->load->view('includes/header'); ?>
<section class="inner-section single-banner" style="background: url(assets/images/single-banner.jpg) no-repeat center">
    <div class="container">
        <h2>Checkout</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
    </div>
</section>
<section class="inner-section checkout-part">
    <div class="container">
        <form method="post">
            <div class="row">
                <div class="col-lg-6">
                    <div class="account-card">
                        <div class="account-title">
                            <h4>User Info</h4>
                        </div>
                        <input class="form-control" type="hidden" name="total_item_amount" id="totalamount" value="<?php echo $this->cart->total(); ?>">
                        <input class="form-control" type="hidden" name="final_amount" id="grand_total" value="<?php echo $this->cart->total(); ?>">
                        <input class="form-control" type="hidden" name="user_id" value="<?= $this->session->userdata('login_user_id') ?>">
                        <div class="ec-check-bill-form">

                            <div class="form-outline">
                                <label>Full name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name:" value="<?= $login[0]['name'] ?>" required>
                            </div>

                            <div class="form-outline ">
                                <label>Contact No.</label>
                                <input type="text" class="form-control" name="contact_no" placeholder="Phone No:" value="<?= $login[0]['contact_no'] ?>" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                            </div>
                            <div class="form-outline">
                                <label>State</label>
                                <select class="form-control" name="state" required id="state">
                                    <option value="">Select state </option>
                                    <?php
                                    if ($state_list) {
                                        foreach ($state_list as $state) {
                                    ?>
                                            <option value="<?= $state['state_id'] ?>" <?= (($state['state_id'] ==  $login[0]['state']) ? 'Selected' : '') ?>><?= $state['state_name'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-outline ">
                                <label>City</label>
                                <select name="city" class="form-control" id="city">
                                    <?php
                                    if ($login[0]['city'] != '') {
                                    ?>
                                        }
                                        <option value="<?= $login[0]['city'] ?>" selected> <?= $login[0]['city'] ?></option>
                                    <?php
                                    }
                                    ?>
                                    <option value="">Select city</option>
                                </select>
                            </div>
                            <div class="form-outline ">
                                <label>Pincode</label>
                                <input type="text" class="form-control" name="postal_code" placeholder="Pincode*" value="<?= $login[0]['postal_code'] ?>" maxlength="6" required>
                            </div>
                            <div class="form-outline">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Address*" value="<?= $login[0]['address'] ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="account-card">
                        <div class="account-title">
                            <h4>Amount Details</h4>
                        </div>
                        <div id="cartlist" class="bottom-border"></div>
                        <div class="account-content">
                            <div class="faq-parent">
                                <div class="faq-child">
                                    <div class="faq-que"><button type="button">Check coupon</button></div>
                                    <div class="faq-ans">
                                        <div class="wallet-card-group">

                                            <?php


                                            if (!empty($promocode)) {
                                                foreach ($promocode as $promo) {
                                                    if ($promo['minimum_order'] <= $this->cart->total()) {
                                            ?>
                                                        <div class="wallet-card cborder">
                                                            <input class="coupon-code" id="coupon<?= $promo['promocode_id'] ?>" value="<?= $promo['promocode'] ?>" readonly>
                                                            <span class="copy-button" data-id="<?= $promo['promocode_id'] ?>" onclick="myFunction('coupon<?= $promo['promocode_id'] ?>')">Copy</span>
                                                            <h6 class="pl-2">You Get Flat - <?= $promo['amount'] ?> Off </h6>
                                                        </div>
                                            <?php

                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="chekout-coupon">
                                <button type="button" class="coupon-btn">Do you have a coupon code?</button>
                                <div class="coupon-form">

                                    <input type="text" id="promocode" name="promocode" placeholder="Enter your coupon code">
                                    <input class="form-control form-control-md mr-1 mb-2" type="hidden" placeholder="Enter Your Coupon Code" name="promocode_amount" id="promocode_amt" value="">
                                    <button type="submit" id="promo"><span>apply</span></button>
                                    <!-- <h6 id="promomsg" class="text-green"></h6> -->

                                </div>
                            </div>
                            <ul class="invoice-details">

                                <li>
                                    <h6>Sub Total</h6>
                                    <p><span class="totalamount"></span></p>
                                </li>
                                <li>
                                    <h6>Delivery Charges</h6>
                                    <p> <?php
                                        if ($delivery['min_amount'] >= $this->cart->total()) { ?>
                                            ₹ <?= $delivery['amount']; ?>
                                            <input type="hidden" value="<?= $delivery['amount']; ?>" id="shipping_charges">
                                        <?php   } else { ?>
                                            Free
                                            <input type="hidden" value="0" id="shipping_charges">
                                        <?php } ?>
                                    </p>
                                </li>
                                <li>
                                    <h6>Payment Method</h6>
                                    <p>Cash On Delivery</p>
                                </li>
                                <li>
                                    <h6>Total</h6>
                                    <p><span id="cartgrandprice"> ₹ <?php echo $this->cart->format_number($this->cart->total()); ?> /- </span></p>
                                </li>
                            </ul>

                            <div class="checkout-check"><input type="checkbox" id="checkout-check" checked required><label for="checkout-check">By making this purchase you agree to our <a href="#">Terms and
                                        Conditions</a>.</label></div>
                            <input type="hidden" name="payment_mode" value="1">
                            <div class="checkout-proced"><button type="submit" class="btn btn-inline">proced to
                                    checkout</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>

<script>
    function myFunction(wrapper) {
        // Get the text field
        var copyText = document.getElementById(wrapper);

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);
    }
    
</script>
</body>


/html>