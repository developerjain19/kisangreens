<?php $this->load->view('includes/header'); ?>


<section class="user-form-part">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">

                <div class="user-form-card">
                    <div class="user-form-title">
                        <h2>Welcome Please Continue!</h2>
                        <!-- <p>Use your credentials to access</p> -->
                        <?php if ($this->session->userdata('loginError') != '') { ?>
                            <?= $this->session->userdata('loginError'); ?>
                        <?php  }
                        $this->session->unset_userdata('loginError'); ?>
                    </div>
                    <div class="user-form-group">
                        <div class="user-form-social text-center dm-none">
                            <img src="<?= base_url() ?>assets/img/login-img.png" alt="Image" width="320px">
                        </div>
                        <div class="user-form-divider">
                            <!-- <p>or</p> -->
                        </div>
                        <form class="user-form" method="post" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" name="uname" placeholder="Enter your Username/Phone" required />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" minlength="4" placeholder="Enter your password" required />
                            </div>
                            <div class="form-button">
                                <button type="submit">login</button>
                                <p>
                                    Forgot your password?<a href="<?= base_url('forgot-password') ?>">reset here</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="user-form-remind">
                    <p>
                        Don't have any account?<a href="<?= base_url('register') ?>">register here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/footer-link'); ?>


</body>

</html>