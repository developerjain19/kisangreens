<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php $this->load->view('includes/header-link'); ?>
<body>
	<div class="backdrop"></div>
	<a class="backtop fas fa-arrow-up" href="#"></a>
	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-5">
					<div class="header-top-welcome">
						<p>Welcome to Kisan Greens - Farm Fresh Product!</p>
					</div>
				</div>
				<div class="col-md-7 col-lg-7">
					<ul class="header-top-list">
						<!-- <li><a href="#">offers</a></li> -->
						<li><a href="tel:7350273572">need help</a></li>
						<li><a href="<?= base_url('contact') ?>">contact us</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<header class="header-part">
		<div class="container">
			<div class="header-content">
				<div class="header-media-group"><button class="header-user">
						<i class="fas fa-bars"></i></button>
					<a href="<?= base_url() ?>">
						<img src="<?= base_url() ?>assets/images/logo.png" alt="Kisan Greens - Farm Fresh Product"></a><button class="header-src"><i class="fas fa-search"></i></button>
				</div>
				<a href="<?= base_url() ?>" class="header-logo"><img src="<?= base_url() ?>assets/images/logo.png" alt="Kisan Greens - Farm Fresh Product"></a>
				<?php
				if ($this->session->has_userdata('login_user_id')) :
				?>
					<a href="<?= base_url('orders') ?>" class="header-widget" title="My Account">
						<img src="<?= base_url() ?>assets/images/user.png" alt="user"><span><?= $this->profile[0]['name'] ?></span></a>
				<?php
				else :
				?>
					<a href="<?= base_url('login') ?>" class="header-widget" title="My Account"><img src="<?= base_url() ?>assets/images/user.png" alt="user"><span>Login</span></a>
				<?php
				endif;
				?>
				<form action="<?= base_url('product') ?>" action="" class="header-form">
					<input placeholder="Enter Product Name..." type="text" name="searchbox" list="browsers" id="browser">
					<datalist id="browsers">
						<?php
						$products = getAllRow('product');
						if (!empty($products)) {
							foreach ($products as $products_row) {
						?>
								<option value="<?= strtoupper($products_row['product_name']); ?>"><?= strtoupper($products_row['product_name']); ?></option>
						<?php
							}
						}
						?>
					</datalist><button type="submit"><i class="fas fa-search"></i></button>
				</form>
				<div class="header-widget-group">
					<button class="header-widget header-cart" title="Cartlist"><i class="fas fa-shopping-basket"></i><sup>
							<p class="totalitem"><?= $this->cart->total_items(); ?></p>
						</sup><span>total price<small class="totalamount">₹<?php echo $this->cart->format_number($this->cart->total()); ?></small></span></button>
				</div>
			</div>
		</div>
	</header>
	<nav class="navbar-part">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="navbar-content">
						<ul class="navbar-list">
							<?php
							$category =	getAllRow('tbl_category');
							if (!empty($category)) {
								foreach ($category as $category_row) {
							?>
									<li class="navbar-item dropdown"><a class="navbar-link dropdown-arrow" href="<?= base_url() ?>product?category=<?= encryptId($category_row['category_id']); ?>&&<?= url_title($category_row['category_name']); ?>">
											<?= $category_row['category_name']; ?>
										</a>
										<?php
										$subcate = $this->CommonModel->getRowById('sub_category', 'category_id', $category_row['category_id']);
										if (!empty($subcate)) {
											echo ' <ul class="dropdown-position-list">';
											foreach ($subcate as $subcate_row) {
										?>
									<li><a href="<?= base_url() ?>product?subcate=<?= encryptId($subcate_row['sub_category_id']); ?>&&<?= url_title($subcate_row['sub_category_name']); ?>">
											<?= $subcate_row['sub_category_name'] ?></a>
									</li>
							<?php
											}
											echo '</ul>';
										} ?>
							</li>
					<?php
								}
							} ?>
						</ul>
						<div class="navbar-info-group">
							<div class="navbar-info">
								<i class="icofont-ui-touch-phone"></i>
								<p><small>call us</small><span>(+91) 7350273572</span></p>
							</div>
							<div class="navbar-info">
								<i class="icofont-ui-email"></i>
								<p><small>email us</small><span>support@kisangreens.com</span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<aside class="cart-sidebar">
		<div class="cart-header">
			<div class="cart-total"><i class="fas fa-shopping-basket"></i> total item &nbsp;<span class="totalitem"> ( <?= $this->cart->total_items(); ?>)</span></div>
			<button class="cart-close"><i class="icofont-close"></i></button>
		</div>
		<div id="cart"></div>
	</aside>
	<aside class="nav-sidebar">
		<div class="nav-header"><a href="#"><img src="<?= base_url() ?>assets/images/logo.png" alt="logo"></a><button class="nav-close"><i class="icofont-close"></i></button></div>
		<div class="nav-content">
			<ul class="nav-list">
				<?php
				$category =	getAllRow('tbl_category');
				if (!empty($category)) {
					foreach ($category as $category_row) {
				?>
						<li><a class="nav-link dropdown-link" href="#">
								<?= $category_row['category_name']; ?>
							</a>
							<?php
							$subcate = $this->CommonModel->getRowById('sub_category', 'category_id', $category_row['category_id']);
							if (!empty($subcate)) {
								echo ' <ul class="dropdown-list">';
								foreach ($subcate as $subcate_row) {
							?>
						<li><a href="<?= base_url() ?>product?subcate=<?= encryptId($subcate_row['sub_category_id']); ?>&&<?= url_title($subcate_row['sub_category_name']); ?>">
								<?= $subcate_row['sub_category_name'] ?></a>
						</li>
				<?php
								}
								echo '</ul>';
							} ?>
				</li>
		<?php
					}
				} ?>
		<li><a class="nav-link" href="<?= base_url('logout') ?>"><i class="icofont-logout"></i>logout</a></li>
			</ul>
			<div class="nav-info-group">
				<div class="nav-info"><i class="icofont-ui-touch-phone"></i>
					<p><small>call us</small><span>+91-7350273572</span></p>
				</div>
				<div class="nav-info"><i class="icofont-ui-email"></i>
					<p><small>email us</small><span>support@kisangreens.com
							carrer@kisangreens.com
						</span></p>
				</div>
			</div>
			<div class="nav-footer">
				<p>All Rights Reserved by <a href="<?= base_url() ?>">Kisan Greens</a></p>
			</div>
		</div>
	</aside>
	<div class="mobile-menu">
		<a href="<?= base_url() ?>" title="Home Page"><i class="fas fa-home"></i><span>Home</span></a>
		<a href="<?= base_url('product') ?>" class="cate-btn" title="Category List"><i class="fas fa-list"></i><span>All Products</span></a>
		<button class="cart-btn" title="Cartlist"><i class="fas fa-shopping-basket"></i><span>cartlist</span><sup class="totalitem"><?= $this->cart->total_items(); ?>+</sup></button>
		<?php
		if ($this->session->has_userdata('login_user_id')) {
		?>
			<a href="<?= base_url('orders'); ?>"><i class="fas fa-shopping-bag"></i><span>Orders</span></a>
			<a href="<?= base_url('profile') ?>"><i class="fas fa-user"></i><span>My Account</span></a>
		<?php
		} else {
		?>
			<a href="<?= base_url('login') ?>"><i class="fas fa-sign-out-alt"></i><span>Sign In</span></a>
			<a href="<?= base_url('register') ?>"> <i class="fas fa-user"></i><span>Register </span></a>
		<?php
		}
		?>
	</div>