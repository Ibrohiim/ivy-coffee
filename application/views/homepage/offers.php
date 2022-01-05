<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?= base_url('assets/img/background.jpg'); ?>);">
    <h2 class="l-text2 t-center">
        <?= $title; ?>
    </h2>
    <p class="m-text13 t-center">
        English Ivy Coffee
    </p>
</section>
<!-- Banner Promo -->
<section class="banner2 bg5 p-t-45 p-b-45">
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
                                        <div class="flex-col-c-m bg11 m-l-5 m-r-5 p-1">
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
<!-- Product -->
<section class="bgwhite product-home p-t-55 p-b-10">
    <div class="container container-product">
        <div class="sec-title p-b-60">
            <h3 class="m-text5 t-center">
                Promo-IVY COFFEE
            </h3>
        </div>
        <div class="row">
            <?php foreach ($drinkoffers as $do) :
                $price = $do->price;
                $discount = $do->discount;
                $total_discount = ($discount / 100) * $price;
                $fixed_price = $price - $total_discount;
            ?>
                <div class="col-sm-6 col-md-6 col-lg-3 col-6 p-b-20">
                    <div class="bo9 bg15 bo-rad-5 block2">
                        <?php if ($do->stock == 'Sold-Out') { ?>
                            <div class="overlay"></div>
                            <div class="ribbon1">
                                <div class="ribbon1-content">
                                    <div class="img-container"><img src="<?= base_url('assets/img/') ?>configuration/sold-out.png" width="100%" /></div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="bo9 bo-rad-5 block2-img wrap-pic-w <?= $do->stock !== 'Sold-Out' ? ' of-hidden' : null ?> pos-relative">
                            <a href="<?= base_url('products/detail/' . $do->drink_code); ?>" class="block3-img dis-block hov-img-zoom">
                                <img src="<?= base_url('assets/img/') ?>product/drink/<?= $do->drink_image; ?>" alt="<?= $do->drink_name; ?>">
                            </a>
                            <?php if ($do->stock !== 'Sold-Out') { ?>
                                <div class="block2-overlay trans-0-4">
                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a>
                                    <div class="block2-btn-addcart w-size29 trans-0-4">
                                        <div class="add_qty_cart flex-w of-hidden">
                                            <button class="btn-num-product-down btn-qty colorwhite flex-c-m bg15 eff4">
                                                <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                            <input class="qty-num-product m-text18 t-center num-product" type="number" name="quantity" value="1" id="<?= $do->drink_code; ?>">
                                            <button class="btn-num-product-up btn-qty colorwhite flex-c-m bg15 eff4">
                                                <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <button class="add-cart add_to_cart flex-c-m hov7 s-text3 trans-0-4" data-productcode="<?= $do->drink_code; ?>" data-productname="<?= $do->drink_name; ?>" data-productprice="<?= $fixed_price; ?>" data-action="add">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="block2-btn-notavailable trans-0-4">
                                    <button class="btn_notavailable flex-c-m s-text21 trans-0-4" disabled>
                                        Item Not Available
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="block3-txt p-b-10 text-center bo-rad-5">
                            <h4>
                                <a href="<?= base_url('homepage/detail/' . $do->drink_code); ?>" class="block2-product-name">
                                    <?= $do->drink_name ?>
                                </a>
                            </h4>
                            <span class="block2-oldprice">
                                RP <?= number_format($price, '0', ',', '.') ?>
                            </span>
                            <span class="block2-newprice">
                                RP <?= number_format($fixed_price, '0', ',', '.') ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php foreach ($foodoffers as $fo) :
                $price = $fo->price;
                $discount = $fo->discount;
                $total_discount = ($discount / 100) * $price;
                $fixed_price = $price - $total_discount;
            ?>
                <div class="col-sm-6 col-md-6 col-lg-3 col-6 p-b-20">
                    <div class="bo9 bg15 bo-rad-5 block2">
                        <?php if ($fo->stock == 'Sold-Out') { ?>
                            <div class="overlay"></div>
                            <div class="ribbon1">
                                <div class="ribbon1-content">
                                    <div class="img-container"><img src="<?= base_url('assets/img/') ?>configuration/sold-out.png" width="100%" /></div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="bo9 bo-rad-5 block2-img wrap-pic-w <?= $fo->stock !== 'Sold-Out' ? ' of-hidden' : null ?> pos-relative">
                            <a href="<?= base_url('products/detail/' . $fo->food_code); ?>" class="block3-img dis-block hov-img-zoom">
                                <img src="<?= base_url('assets/img/') ?>product/food/<?= $fo->food_image; ?>" alt="<?= $fo->food_name; ?>">
                            </a>
                            <?php if ($fo->stock !== 'Sold-Out') { ?>
                                <div class="block2-overlay trans-0-4">
                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a>
                                    <div class="block2-btn-addcart w-size29 trans-0-4">
                                        <div class="add_qty_cart flex-w of-hidden">
                                            <button class="btn-num-product-down btn-qty colorwhite flex-c-m bg15 eff4">
                                                <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                            <input class="qty-num-product m-text18 t-center num-product" type="number" name="quantity" value="1" id="<?= $fo->food_code; ?>">
                                            <button class="btn-num-product-up btn-qty colorwhite flex-c-m bg15 eff4">
                                                <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <button class="add-cart add_to_cart flex-c-m hov7 s-text3 trans-0-4" data-productcode="<?= $fo->food_code; ?>" data-productname="<?= $fo->food_name; ?>" data-productprice="<?= $fixed_price; ?>" data-action="add">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="block2-btn-notavailable trans-0-4">
                                    <button class="btn_notavailable flex-c-m s-text21 trans-0-4" disabled>
                                        Item Not Available
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="block3-txt p-b-10 text-center bo-rad-5">
                            <h4>
                                <a href="<?= base_url('homepage/detail/' . $fo->food_code); ?>" class="block2-product-name">
                                    <?= $fo->food_name ?>
                                </a>
                            </h4>
                            <span class="block2-oldprice">
                                RP <?= number_format($price, '0', ',', '.') ?>
                            </span>
                            <span class="block2-newprice">
                                RP <?= number_format($fixed_price, '0', ',', '.') ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>