<?php $this->load->view('includes/header'); ?>
    <nav aria-label="breadcrumb" class="breadcrumb mb-0">
        <div class="container">
            <ol class="d-flex align-items-center mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-success">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ol>
        </div>
    </nav>


    <section class="py-4 osahan-main-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-4 bg-white rounded shadow-sm">
                    <?php
                    if ($this->session->has_userdata('msg')) {
                        echo $this->session->userdata('msg');
                        $this->session->unset_userdata('msg');
                    }
                    ?>
                    </p>
                    <form action="" method="post" class="row ">
                        <span class=" col-md-12">
                            <label> Name*</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" required data-error="Please enter your name">

                        </span>

                        <span class=" col-md-6">
                            <label>Email*</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required data-error="Please enter your email">

                        </span>
                        <span class=" col-md-6">
                            <label>Phone Number*</label>
                            <input type="text" pattern="\d*" maxlenght="10" name="phone" placeholder="Phone" required data-error="Please enter your number" class="form-control">

                        </span>
                        <span class=" col-md-12">
                            <label>Comments/Questions*</label>
                            <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Write message" required data-error="Write your message"></textarea>

                        </span>

                        <span class="ec-contact-wrap ec-contact-btn">
                            <br>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </span>
                    </form>
                </div>
            </div>
        </div>


    </section>
    <?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/footer-link'); ?>


</body>

</html>