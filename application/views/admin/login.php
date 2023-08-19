<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="<?= base_url() ?>assets/admin/images/favicon.png">

    <link href="<?= base_url() ?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <link href="<?= base_url() ?>assets/admin/css/icons.min.css" rel="stylesheet" type="text/css" />

    <link href="<?= base_url() ?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p>Sign in to continue to Kisan Greens.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="<?= base_url('assets/admin/images/logo.png') ?>" alt="" class="img-fluid" >
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0 mt-3">

                            <?php if ($this->session->flashdata('login_error') != '') {
                            ?>
                                <div class="alert alert-danger">
                                    <span><?= $this->session->flashdata('login_error'); ?></span>
                                </div>
                            <?php
                            } ?>
                            <div class="p-2">
                                <form class="form-horizontal" action="" method="post">
                                    <div class="mb-3">
                                        <label class="form-label">Contact Number</label>
                                        <input type="text" class="form-control input-mask" id="input-repeat" data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" placeholder="Enter Contact Number" required name="contact_no" value="<?= set_value('contact_no') ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" placeholder="Enter password" required aria-label="Password" name="password" value="<?= set_value('password') ?>" aria-describedby="password-addon">
                                            <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>

                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url() ?>assets/admin/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/js/app.js"></script>
    <script src="<?= base_url() ?>assets/admin/libs/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/js/pages/form-mask.init.js"></script>
</body>

</html>