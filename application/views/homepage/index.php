<!-- Sliders -->
<section class="slide1">
	<div class="wrap-slick1">
		<div class="slick1">
			<?php $no = 1 ?>
			<?php foreach ($slider as $sl) : ?>
				<?php if ($sl->is_active == 1) { ?>
					<div class="item-slick1 item1-slick1" style="background-image: url(<?= base_url('assets/img/') ?>configuration/slider/<?= $sl->image ?>);">
						<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
							<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15 bo7" data-appear="fadeInDown">
								<?= $sl->title; ?>
							</span>
							<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
								<?= $sl->caption; ?>
							</h2>
							<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
								<a href="<?= base_url($sl->link); ?>" class="flex-c-m size2 bo-rad-10 s-text1 bg15 hov7 trans-0-4">
									<?= $sl->text_link; ?>
								</a>
							</div>
						</div>
					</div>
				<?php } else {
				} ?>
				<?php $no++ ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Banner Offers -->
<section class="banner2 bg5 p-t-35 p-b-35">
	<?php if ($offers != null) { ?>
		<div class="container">
			<div class="wrap-slick4">
				<div class="slick4">
					<?php
					foreach ($offers as $off) :
						$date = date('d-M-Y', strtotime($off['expired']));
					?>
						<div class="item-slick4 p-l-15 p-r-15">
							<div class="bgwhite hov-img-zoom pos-relative">
								<img src="<?= base_url('assets/img/') ?>offers/<?= $off['image']; ?>" alt="IMG-OFFERS">
								<div class="ab-t-l sizefull flex-col-c-b p-l-15 p-r-15 p-b-20">
									<div class="offers">
										<div class="flex-col-c-m bg15 p-l-5 p-r-5 m-b-3">
											<span class="m-text9 fs-20-sm">
												<?= $off['name']; ?>
											</span>
										</div>
										<div class="flex-col-c-m bg11 p-1">
											<span class="s-text3">
												Expired : <?= $date; ?>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<div class="header-footer">
			<div class="container">
				<div class="py-4 align-items-center">
					<div class="text-center mb-md-0">
						<h6 class="mb-0">There are no offers for today</h6>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</section>

<!-- Fav Drinks -->
<section class="bgwhite p-t-35 p-b-35">
	<div class="container">
		<div class="sec-title p-b-22">
			<h3 class="m-text5 t-center">
				Favorite Drinks
			</h3>
		</div>
		<div class="wrap-slick2">
			<div class="slick2">
				<?php foreach ($drinks as $d) {
					$price = $d['price'];
					$discount = $d['discount'];
					$total_discount = ($discount / 100) * $price;
					$fixed_price = $price - $total_discount;
				?>
					<div class="item-slick2 p-l-15 p-r-15">
						<div class="bo9 bg15 bo-rad-5 block2 pos-relative">
							<?php if ($d['stock'] == 'Sold-Out') { ?>
								<div class="overlay-slick"></div>
								<div class="ribbon-slick">
									<div class="ribbon-slick-content">
										<div class="img-container"><img src="<?= base_url('assets/img/') ?>configuration/sold-out.png" width="100%" /></div>
									</div>
								</div>
							<?php } ?>
							<div class="bo9 bo-rad-5 block2-img wrap-pic-w <?= $d['stock'] !== 'Sold-Out' ? ' of-hidden' : null ?> pos-relative">
								<img src="<?= base_url('assets/img/') ?>product/drink/<?= $d['image']; ?>" alt="<?= $d['name'] ?>">
								<?php if ($d['stock'] !== 'Sold-Out') { ?>
									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>
										<div class="block2-btn-addcart-slick w-size30 trans-0-4">
											<div class="add_qty_cart_slick flex-w of-hidden">
												<button class="btn-num-product-down btn-qty-slick colorwhite flex-c-m bg15 eff4"><i class="fs-12 fa fa-minus" aria-hidden="true"></i>
												</button>
												<input class="qty-num-product-slick m-text18 t-center num-product" type="number" name="quantity" value="1" id="<?= $d['code']; ?>">
												<button class="btn-num-product-up btn-qty-slick colorwhite flex-c-m bg15 eff4"><i class="fs-12 fa fa-plus" aria-hidden="true"></i>
												</button>
											</div>
											<button class="add-cart add_to_cart_slick flex-c-m hov7 s-text3 trans-0-4" data-productcode="<?= $d['code']; ?>" data-productname="<?= $d['name']; ?>" data-productprice="<?= $fixed_price; ?>" data-action="add">
												Add to Cart
											</button>
										</div>
									</div>
								<?php } else { ?>
									<div class="block2-btn-notavailable w-size2 trans-0-4">
										<button class="btn_notavailable flex-c-m size26 bg11 bo-rad-10 s-text21 trans-0-4" disabled>
											Item Not Available
										</button>
									</div>
								<?php } ?>
							</div>
							<div class="block3-txt p-b-10 text-center">
								<h4>
									<a href="<?= base_url('homepage/detail/' . $d['code']); ?>" class="block2-product-name">
										<?= $d['name'] ?>
									</a>
								</h4>
								<?php if ($discount !== '0') { ?>
									<span class="block2-oldprice m-text7 p-r-5">
										RP <?= number_format($price, '0', ',', '.') ?>
									</span>
									<span class="block2-newprice m-text8 p-r-5">
										RP <?= number_format($fixed_price, '0', ',', '.') ?>
									</span>
								<?php } else { ?>
									<span class="block2-product-price">
										RP <?= number_format($fixed_price, '0', ',', '.') ?>
									</span>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>

<!-- Fav Food -->
<section class="bgwhite p-t-35 p-b-35">
	<div class="container">
		<div class="sec-title p-b-22">
			<h3 class="m-text5 t-center">
				Favorite Food
			</h3>
		</div>
		<div class="wrap-slick2">
			<div class="slick2">
				<?php foreach ($food as $f) {
					$price = $f['price'];
					$discount = $f['discount'];
					$total_discount = ($discount / 100) * $price;
					$fixed_price = $price - $total_discount;
				?>
					<div class="item-slick2 p-l-15 p-r-15">
						<div class="bo9 bg15 bo-rad-5 block2 pos-relative">
							<?php if ($f['stock'] == 'Sold-Out') { ?>
								<div class="overlay-slick"></div>
								<div class="ribbon-slick">
									<div class="ribbon-slick-content">
										<div class="img-container"><img src="<?= base_url('assets/img/') ?>configuration/sold-out.png" width="100%" /></div>
									</div>
								</div>
							<?php } ?>
							<div class="bo9 bo-rad-5 block2-img wrap-pic-w <?= $f['stock'] !== 'Sold-Out' ? ' of-hidden' : null ?> pos-relative">
								<img src="<?= base_url('assets/img/') ?>product/food/<?= $f['image']; ?>" alt="<?= $f['name'] ?>">
								<?php if ($f['stock'] !== 'Sold-Out') { ?>
									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>
										<div class="block2-btn-addcart-slick w-size30 trans-0-4">
											<div class="add_qty_cart_slick flex-w of-hidden">
												<button class="btn-num-product-down btn-qty-slick colorwhite flex-c-m bg15 eff4"><i class="fs-12 fa fa-minus" aria-hidden="true"></i>
												</button>
												<input class="qty-num-product-slick m-text18 t-center num-product" type="number" name="quantity" value="1" id="<?= $f['code']; ?>">
												<button class="btn-num-product-up btn-qty-slick colorwhite flex-c-m bg15 eff4"><i class="fs-12 fa fa-plus" aria-hidden="true"></i>
												</button>
											</div>
											<button class="add-cart add_to_cart_slick flex-c-m hov7 s-text3 trans-0-4" data-productcode="<?= $f['code']; ?>" data-productname="<?= $f['name']; ?>" data-productprice="<?= $fixed_price; ?>" data-action="add">
												Add to Cart
											</button>
										</div>
									</div>
								<?php } else { ?>
									<div class="block2-btn-notavailable w-size2 trans-0-4">
										<button class="btn_notavailable flex-c-m size26 bg11 bo-rad-10 s-text21 trans-0-4" disabled>
											Item Not Available
										</button>
									</div>
								<?php } ?>
							</div>
							<div class="block3-txt p-b-10 text-center">
								<h4>
									<a href="<?= base_url('homepage/detail/' . $f['code']); ?>" class="block2-product-name">
										<?= $f['name'] ?>
									</a>
								</h4>
								<?php if ($discount !== '0') { ?>
									<span class="block2-oldprice m-text7 p-r-5">
										RP <?= number_format($price, '0', ',', '.') ?>
									</span>
									<span class="block2-newprice m-text8 p-r-5">
										RP <?= number_format($fixed_price, '0', ',', '.') ?>
									</span>
								<?php } else { ?>
									<span class="block2-product-price">
										RP <?= number_format($fixed_price, '0', ',', '.') ?>
									</span>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>

<!-- Service -->
<section class="shipping bg5 p-t-50 p-b-46">
	<div class="flex-w p-l-15 p-r-15">
		<?php foreach ($service as $ser) { ?>
			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					<?= $ser['title']; ?>
				</h4>
				<a href="#" class="s-text11 t-center">
					<?= $ser['description']; ?>
				</a>
			</div>
		<?php } ?>
	</div>
</section>