<?php $this->load->view('includes/header'); ?>


<section class="user-form-part">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">
                <div class="user-form-card">
                    <div class="user-form-title">
                        <h2>Join Now!</h2>
                        <p>Setup A New Account In A Minute</p>
                    </div>
                    <div class="user-form-group">
                        <div class="user-form-social text-center">
                            <img src="<?= base_url() ?>assets/img/register-img.png" alt="Image" width="320px">
                        </div>
                        <div class="user-form-divider">
                            <!-- <p>or</p> -->
                        </div>
                        <form class="user-form">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Enter name" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Enter email" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" placeholder="Enter Phone" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Enter password" />
                            </div>
                            <div class="form-button">
                                <button type="submit">register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="user-form-remind">
                    <p>Already Have An Account?<a href="<?= base_url('login') ?>">login here</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/footer-link'); ?>


</body>

</html>