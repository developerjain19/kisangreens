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
						<li><a href="#">offers</a></li>
						<li><a href="#">need help</a></li>
						<li><a href="#">contact us</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<header class="header-part">
		<div class="container">
			<div class="header-content">
				<div class="header-media-group"><button class="header-user"><img src="<?= base_url() ?>assets/images/user.png" alt="user"></button><a href="index.html"><img src="<?= base_url() ?>assets/images/logo.png" alt="Kisan Greens - Farm Fresh Product"></a><button class="header-src"><i class="fas fa-search"></i></button></div>
				<a href="<?= base_url() ?>" class="header-logo"><img src="<?= base_url() ?>assets/images/logo.png" alt="Kisan Greens - Farm Fresh Product"></a>
				<a href="login.html" class="header-widget" title="My Account"><img src="<?= base_url() ?>assets/images/user.png" alt="user"><span>User Name</span></a>
				<form class="header-form"><input type="text" placeholder="Search anything..."><button><i class="fas fa-search"></i></button></form>
				<div class="header-widget-group">
					<button class="header-widget header-cart" title="Cartlist"><i class="fas fa-shopping-basket"></i><sup>9+</sup><span>total price<small>₹345.00</small></span></button>
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
			<div class="cart-total"><i class="fas fa-shopping-basket"></i><span>total item (5)</span></div>
			<button class="cart-close"><i class="icofont-close"></i></button>
		</div>
		<ul class="cart-list">
			<li class="cart-item">
				<div class="cart-media"><a href="#"><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></a><button class="cart-delete"><i class="far fa-trash-alt"></i></button></div>
				<div class="cart-info-group">
					<div class="cart-info">
						<h6><a href="product-single.html">existing product name</a></h6>
						<p>Unit Price - ₹8.75</p>
					</div>
					<div class="cart-action-group">
						<div class="product-action"><button class="action-minus" title="Quantity Minus"><i class="icofont-minus"></i></button><input class="action-input" title="Quantity Number" type="text" name="quantity" value="1"><button class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i></button></div>
						<h6>₹56.98</h6>
					</div>
				</div>
			</li>
			<li class="cart-item">
				<div class="cart-media"><a href="#"><img src="<?= base_url() ?>assets/images/product/02.jpg" alt="product"></a><button class="cart-delete"><i class="far fa-trash-alt"></i></button></div>
				<div class="cart-info-group">
					<div class="cart-info">
						<h6><a href="product-single.html">existing product name</a></h6>
						<p>Unit Price - ₹8.75</p>
					</div>
					<div class="cart-action-group">
						<div class="product-action"><button class="action-minus" title="Quantity Minus"><i class="icofont-minus"></i></button><input class="action-input" title="Quantity Number" type="text" name="quantity" value="1"><button class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i></button></div>
						<h6>₹56.98</h6>
					</div>
				</div>
			</li>
			<li class="cart-item">
				<div class="cart-media"><a href="#"><img src="<?= base_url() ?>assets/images/product/03.jpg" alt="product"></a><button class="cart-delete"><i class="far fa-trash-alt"></i></button></div>
				<div class="cart-info-group">
					<div class="cart-info">
						<h6><a href="product-single.html">existing product name</a></h6>
						<p>Unit Price - ₹8.75</p>
					</div>
					<div class="cart-action-group">
						<div class="product-action"><button class="action-minus" title="Quantity Minus"><i class="icofont-minus"></i></button><input class="action-input" title="Quantity Number" type="text" name="quantity" value="1"><button class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i></button></div>
						<h6>₹56.98</h6>
					</div>
				</div>
			</li>
			<li class="cart-item">
				<div class="cart-media"><a href="#"><img src="<?= base_url() ?>assets/images/product/04.jpg" alt="product"></a><button class="cart-delete"><i class="far fa-trash-alt"></i></button></div>
				<div class="cart-info-group">
					<div class="cart-info">
						<h6><a href="product-single.html">existing product name</a></h6>
						<p>Unit Price - ₹8.75</p>
					</div>
					<div class="cart-action-group">
						<div class="product-action"><button class="action-minus" title="Quantity Minus"><i class="icofont-minus"></i></button><input class="action-input" title="Quantity Number" type="text" name="quantity" value="1"><button class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i></button></div>
						<h6>₹56.98</h6>
					</div>
				</div>
			</li>
			<li class="cart-item">
				<div class="cart-media"><a href="#"><img src="<?= base_url() ?>assets/images/product/05.jpg" alt="product"></a><button class="cart-delete"><i class="far fa-trash-alt"></i></button></div>
				<div class="cart-info-group">
					<div class="cart-info">
						<h6><a href="product-single.html">existing product name</a></h6>
						<p>Unit Price - ₹8.75</p>
					</div>
					<div class="cart-action-group">
						<div class="product-action"><button class="action-minus" title="Quantity Minus"><i class="icofont-minus"></i></button><input class="action-input" title="Quantity Number" type="text" name="quantity" value="1"><button class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i></button></div>
						<h6>₹56.98</h6>
					</div>
				</div>
			</li>
		</ul>
		<div class="cart-footer">
			<button class="coupon-btn">Do you have a coupon code?</button>
			<form class="coupon-form"><input type="text" placeholder="Enter your coupon code"><button type="submit"><span>apply</span></button></form>
			<a class="cart-checkout-btn" href="checkout.html"><span class="checkout-label">Proceed to Checkout</span><span class="checkout-price">₹369.78</span></a>
		</div>
	</aside>
	<aside class="nav-sidebar">
		<div class="nav-header"><a href="#"><img src="<?= base_url() ?>assets/	images/logo.png" alt="logo"></a><button class="nav-close"><i class="icofont-close"></i></button></div>
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
	<div class="mobile-menu"><a href="index.html" title="Home Page"><i class="fas fa-home"></i><span>Home</span></a><button class="cate-btn" title="Category List"><i class="fas fa-list"></i><span>category</span></button><button class="cart-btn" title="Cartlist"><i class="fas fa-shopping-basket"></i><span>cartlist</span><sup>9+</sup></button><a href="wishlist.html" title="Wishlist"><i class="fas fa-heart"></i><span>wishlist</span><sup>0</sup></a><a href="compare.html" title="Compare List"><i class="fas fa-random"></i><span>compare</span><sup>0</sup></a></div>
	<div class="modal fade" id="product-view">
		<div class="modal-dialog">
			<div class="modal-content">
				<button class="modal-close icofont-close" data-bs-dismiss="modal"></button>
				<div class="product-view">
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<div class="view-gallery">
								<div class="view-label-group"><label class="view-label new">new</label><label class="view-label off">-10%</label></div>
								<ul class="preview-slider slider-arrow">
									<li><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></li>
									<li><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></li>
									<li><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></li>
									<li><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></li>
									<li><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></li>
									<li><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></li>
									<li><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></li>
								</ul>
								<ul class="thumb-slider">
									<li><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></li>
									<li><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></li>
									<li><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></li>
									<li><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></li>
									<li><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></li>
									<li><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></li>
									<li><img src="<?= base_url() ?>assets/images/product/01.jpg" alt="product"></li>
								</ul>
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="view-details">
								<h3 class="view-name"><a href="product-video.html">existing product name</a></h3>
								<div class="view-meta">
									<p>SKU:<span>1234567</span></p>
									<p>BRAND:<a href="#">radhuni</a></p>
								</div>
								<div class="view-rating"><i class="active icofont-star"></i><i class="active icofont-star"></i><i class="active icofont-star"></i><i class="active icofont-star"></i><i class="icofont-star"></i><a href="product-video.html">(3 reviews)</a></div>
								<h3 class="view-price"><del>₹38.00</del><span>₹24.00<small>/per kilo</small></span></h3>
								<p class="view-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit non tempora magni repudiandae sint suscipit tempore quis maxime explicabo veniam eos reprehenderit fuga</p>
								<div class="view-list-group">
									<label class="view-list-title">tags:</label>
									<ul class="view-tag-list">
										<li><a href="#">organic</a></li>
										<li><a href="#">vegetable</a></li>
										<li><a href="#">chilis</a></li>
									</ul>
								</div>
								<div class="view-list-group">
									<label class="view-list-title">Share:</label>
									<ul class="view-share-list">
										<li><a href="#" class="icofont-facebook" title="Facebook"></a></li>
										<li><a href="#" class="icofont-twitter" title="Twitter"></a></li>
										<li><a href="#" class="icofont-linkedin" title="Linkedin"></a></li>
										<li><a href="#" class="icofont-instagram" title="Instagram"></a></li>
									</ul>
								</div>
								<div class="view-add-group">
									<button class="product-add" title="Add to Cart"><i class="fas fa-shopping-basket"></i><span>add to cart</span></button>
									<div class="product-action"><button class="action-minus" title="Quantity Minus"><i class="icofont-minus"></i></button><input class="action-input" title="Quantity Number" type="text" name="quantity" value="1"><button class="action-plus" title="Quantity Plus"><i class="icofont-plus"></i></button></div>
								</div>
								<div class="view-action-group"><a class="view-wish wish" href="#" title="Add Your Wishlist"><i class="icofont-heart"></i><span>add to wish</span></a><a class="view-compare" href="compare.html" title="Compare This Item"><i class="fas fa-random"></i><span>Compare This</span></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>