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



<section class="inner-section invoice-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert-info">
                    <p>Thank you! We have recieved your order.</p>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        <h4>order recieved</h4>
                    </div>
                    <div class="account-content">
                        <div class="invoice-recieved">
                            <h6>order number <span>1665</span></h6>
                            <h6>order date <span>february 02, 2021</span></h6>
                            <h6>total amount <span>₹24,176.00</span></h6>
                            <h6>payment method <span>Cash on delivery</span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="account-card">
                    <div class="account-title">
                        <h4>Order Details</h4>
                    </div>
                    <div class="account-content">
                        <ul class="invoice-details">
                            <li>
                                <h6>Total Item</h6>
                                <p>2 Items</p>
                            </li>
                            <li>
                                <h6>Order Time</h6>
                                <p>1.00pm 10-12-2021</p>
                            </li>
                            <li>
                                <h6>Delivery Time</h6>
                                <p>90 Minute Express Delivery</p>
                            </li>
                            <li>
                                <h6>Delivery Location</h6>
                                <p>House 17/A, West Jalkuri, Dhaka.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="account-card">
                    <div class="account-title">
                        <h4>Amount Details</h4>
                    </div>
                    <div class="account-content">
                        <ul class="invoice-details">
                            <li>
                                <h6>Sub Total</h6>
                                <p>₹10,864.00</p>
                            </li>
                            <li>
                                <h6>discount</h6>
                                <p>₹20.00</p>
                            </li>
                            <li>
                                <h6>Payment Method</h6>
                                <p>Cash On Delivery</p>
                            </li>
                            <li>
                                <h6>Total<small>(Incl. VAT)</small></h6>
                                <p>₹10,874.00</p>
                            </li>
                        </ul>
                    </div>
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
                            <tr>
                                <td class="table-serial">
                                    <h6>01</h6>
                                </td>
                                <td class="table-image"><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></td>
                                <td class="table-name">
                                    <h6>product name</h6>
                                </td>
                                <td class="table-price">
                                    <h6>₹19</h6>
                                </td>
                               <td class="table-quantity">
                                    <h6>3</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-serial">
                                    <h6>02</h6>
                                </td>
                                <td class="table-image"><img src="<?= base_url() ?>assets/images/product/02.jpg" alt="product"></td>
                                <td class="table-name">
                                    <h6>product name</h6>
                                </td>
                                <td class="table-price">
                                    <h6>₹19</h6>
                                </td>
                                <td class="table-quantity">
                                    <h6>5</h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center mt-5"><a class="btn btn-inline" href="#" target="_blank"><i class="icofont-download"></i><span>download invoice</span></a>
                <div class="back-home"><a href="<?= base_url() ?>">Back to Home</a></div>
            </div>
        </div>
    </div>
</section>


<?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/footer-link'); ?>


</body>

</html>