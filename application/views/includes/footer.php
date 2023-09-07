<footer class="footer-part">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-xl-4">
				<div class="footer-widget">
					<a class="footer-logo" href="#"><img src="<?= base_url() ?>assets/images/logo.png" alt="Kisan Greens - Farm Fresh Product"></a>
					<p class="footer-desc">Become a part of our thriving community that celebrates healthy living. Join hands with KISAN Greens for a greener, healthier future.
					</p>
					<ul class="footer-social">
						<li><a class="icofont-facebook" href="https://www.facebook.com/kisangreens"></a></li>

						<li><a class="icofont-instagram" href="https://www.instagram.com/kisangreens/"></a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-6 col-xl-4">
				<div class="footer-widget contact">
					<h3 class="footer-title">contact us</h3>
					<ul class="footer-contact">
						<li>
							<i class="icofont-ui-email"></i>
							<p><span>support@kisangreens.com</span><span>carrer@kisangreens.com</span></p>
						</li>
						<li>
							<i class="icofont-ui-touch-phone"></i>
							<p><span>+91-9755572682</span> </p>
						</li>
						<li>
							<i class="icofont-location-pin"></i>
							<p>Bhopal, Madhya Pradesh</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-sm-6 col-xl-4">
				<div class="footer-widget">
					<h3 class="footer-title">quick Links</h3>
					<div class="footer-links">
						<ul>
							<li><a href="<?= base_url('about') ?>">About Comapny</a></li>

							<?php
							if ($this->session->has_userdata('login_user_id')) {
							?>
								<li> <a href="<?= base_url('orders') ?>"><i class="w-icon-account"></i>My Orders</a></li>
								<li> <a href="<?= base_url('logout'); ?>"><i class="w-icon-lock"></i>Logout</a></li>
							<?php
							} else {
							?>
								<li> <a href="<?= base_url('login') ?>"><i class="w-icon-account"></i>Sign In</a> </li>
								<li> <a href="<?= base_url('register') ?>"> Register</a></li>
							<?php
							}
							?>
							<li><a href="<?= base_url('contact') ?>">contact us</a></li>
						</ul>
						<ul>
							<li><a href="<?= base_url('shipping-policy'); ?>">Return / Refund / Cancellation Policy</a></li>
							<li><a href="<?= base_url('term-condition'); ?>">Terms & Conditions</a></li>
							<li><a href="<?= base_url('privacy-policy'); ?>">Privacy Policy</a></li>
						</ul>
					</div>
				</div>
			</div>

		</div>
		<div class="row">
			<div class="col-12">
				<div class="footer-bottom">
					<p class="footer-copytext">&copy; All Copyrights Reserved by <a href="#">KisanGreens</a></p>
					<div class="footer-card"><a href="#"><img src="<?= base_url() ?>assets/images/payment/jpg/01.jpg" alt="payment"></a><a href="#"><img src="<?= base_url() ?>assets/images/payment/jpg/02.jpg" alt="payment"></a><a href="#"><img src="<?= base_url() ?>assets/images/payment/jpg/03.jpg" alt="payment"></a><a href="#"><img src="<?= base_url() ?>assets/images/payment/jpg/04.jpg" alt="payment"></a></div>
				</div>
			</div>
		</div>
	</div>
</footer>