<?php $this->load->view('includes/header'); ?>



<section class="inner-section single-banner" style="background: url(images/single-banner.jpg) no-repeat center;">
    <div class="container">
        <h2>contact us</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact</li>
        </ol>
    </div>
</section>
<section class="inner-section contact-part">
    <div class="container">
       
        <div class="row">
            <div class="col-lg-6">
            

            <div class="row">
            
            <div class="col-md-6 col-lg-6">
                <div class="contact-card active"><i class="icofont-phone"></i>
                    <h4>phone number</h4>
                    <p><a href="tel:7350273572">+91-7350273572</a></p>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="contact-card"><i class="icofont-email"></i>
                    <h4>Support mail</h4>
                    <p><a href="mailto:support@kisangreens.com">support@kisangreens.com</a></p>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="contact-card active"><i class="icofont-location-pin"></i>
                    <h4>Our Farm</h4>
                    <p>Bhopal, Madhya Pradesh</p>
                </div>
            </div>
        </div>

            </div>
            <div class="col-lg-6">
                <form method="post" class="contact-form">
                    <h4>Drop Your Thoughts</h4>
                    <?php
                    if ($this->session->has_userdata('msg')) {
                        echo $this->session->userdata('msg');
                        $this->session->unset_userdata('msg');
                    }
                    ?>
                    <div class="form-group">
                        <div class="form-input-group"><input class="form-control" type="text" name="name" placeholder="Your Name" required><i class="icofont-user-alt-3"></i></div>
                    </div>
                    <div class="form-group">
                        <div class="form-input-group"><input class="form-control" name="email" type="text" placeholder="Your Email" require><i class="icofont-email"></i></div>
                    </div>
                    <div class="form-group">
                        <div class="form-input-group"><input class="form-control" type="text" placeholder="Your Phone" maxlength="6" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="phone"><i class="icofont-phone"></i></div>
                    </div>
                    <div class="form-group">
                        <div class="form-input-group"><textarea name="message" class="form-control" placeholder="Your Message"></textarea><i class="icofont-paragraph"></i></div>
                    </div><button type="submit" class="form-btn-group"><i class="fas fa-envelope"></i><span>send
                            message</span></button>
                </form>
            </div>
        </div>

    </div>
</section>

<?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/footer-link'); ?>


</body>

</html>