<ul class="cart-list">

	<?php foreach ($this->cart->contents() as $items) :
	?>
		<li class="cart-item">
			<div class="cart-media"><a href="#">
					<img src="<?= setImage($items['image'], 'uploads/products/') ?>" alt="<?php echo $items['name']; ?>">
				</a><button class="cart-delete removeCarthm remove" data-id="<?= $items['rowid'] ?>"><i class="far fa-trash-alt"></i></button></div>
			<div class="cart-info-group">
				<div class="cart-info">
					<h6><a href="product-single.html"><?php echo $items['name']; ?></a></h6>
					<p>Unit Price - <?php echo $items['qty']; ?> <?php echo $items['quantity_type']; ?> x ₹ <?php echo $this->cart->format_number($items['price']); ?> /-/p>
				</div>
				<div class="cart-action-group">
					<div class="product-action"><button class="action-minus qty-minus" data-rowid="<?= $items['rowid']; ?>" title="Quantity Minus"><i class="icofont-minus"></i></button>
						<input class="action-input" title="Quantity Number" type="text" name="quantity" value="1">
						<button class="action-plus qty-plus" data-rowid="<?= $items['rowid']; ?>" title="Quantity Plus"><i class="icofont-plus"></i></button>
					</div>
					<h6>₹56.98</h6>
				</div>
			</div>
		</li>

	<?php endforeach; ?>
</ul>

<div class="cart-footer">
	<!-- <button class="coupon-btn">Do you have a coupon code?</button>
	<form class="coupon-form"><input type="text" placeholder="Enter your coupon code"><button type="submit"><span>apply</span></button></form> -->
	<a class="cart-checkout-btn" href="<?= base_url('checkout') ?>"><span class="checkout-label">Proceed to Checkout</span><span class="checkout-price">₹ <?php echo $this->cart->format_number($this->cart->total()); ?></span></a>
</div>