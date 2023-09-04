<ul class="cart-list">

	<?php foreach ($this->cart->contents() as $items) :
	?>
		<li class="cart-item">
			<div class="cart-media"><a href="<?= base_url('product-details/' . encryptId($items['id']) . '/' . url_title($items['name'])) ?>">
					<img src="<?= setImage($items['image'], 'upload/product/') ?>" alt="<?php echo $items['name']; ?>">
				</a><button class="cart-delete removeCarthm remove" data-id="<?= $items['rowid'] ?>"><i class="far fa-trash-alt"></i></button></div>
			<div class="cart-info-group">
				<div class="cart-info">
					<h6><a href="<?= base_url('product-details/' . encryptId($items['id']) . '/' . url_title($items['name'])) ?>"><?php echo $items['name']; ?></a> &nbsp;<button class="cart-delete removeCarthm remove" data-id="<?= $items['rowid'] ?>"><i class="far fa-trash-alt"></i></button></h6>
					<p>Quantity - <?php echo $items['qty']; ?> <?php echo $items['quantity_type']; ?> X <?php echo $this->cart->format_number($items['price']); ?></-< /p>
				</div>
				<div class="cart-action-group">
					<!-- <div class="product-action"><button class="action-minus qty-minus" data-rowid="<?= $items['id']; ?>" title="Quantity Minus"><i class="icofont-minus"></i></button>
						<input class="action-input" title="Quantity Number" type="text" id="qtysidecart<?= $items['id'] ?>" name="quantity" value="1">
						<button class="action-plus qty-plus" data-rowid="<?= $items['id']; ?>" title="Quantity Plus"><i class="icofont-plus"></i></button>
					</div> -->
					<h6>₹<?php echo $this->cart->format_number($items['price']) * $items['qty']; ?></h6>
				</div>
			</div>
		</li>

	<?php endforeach; ?>
</ul>