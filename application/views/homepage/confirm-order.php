<section class="confirm-order banner2 bgwhite p-t-55 p-b-55">
    <div class="container">
        <div class="alert alert-danger text-center" role="alert">
            <h4><strong>Please come to the cashier and show the order code! </strong></h4>
        </div>
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-3 m-l-r-auto p-t-15 p-b-15">
                <div class="block2-img wrap-pic-w of-hidden pos-relative pos-relative">
                    <img src="<?= base_url('assets/img/') ?>qrcode/<?= $confirmorder->qrcode; ?>" alt="<?= $confirmorder->transaction_code; ?>">
                </div>
            </div>
            <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto p-t-15 p-b-15">
                <div class="card bo8">
                    <div class="card-body p-0">
                        <table class="table table-striped table-responsive" style="margin-bottom: 0;">
                            <tbody>
                                <tr class="table-row s-text7">
                                    <td class="text-center s-text23">Order Code</td>
                                    <td><?= $confirmorder->transaction_code; ?></td>
                                </tr>
                                <tr class="table-row s-text7">
                                    <td class="text-center s-text23">Table</td>
                                    <td><?= $table->table_name; ?></td>
                                </tr>
                                <tr class="table-row s-text7">
                                    <td class="text-center s-text23">Customer</td>
                                    <td><?= $confirmorder->customer_name; ?></td>
                                </tr>
                                <tr class="table-row s-text7">
                                    <td class="text-center s-text23">Order Date</td>
                                    <td><?= $confirmorder->transaction_date; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-10 col-md-8 col-lg-5 m-l-r-auto p-t-15 p-b-15">
                <div class="card bo8">
                    <div class="card-body p-0">
                        <table class="table table-striped table-responsive text-center" style="margin-bottom: 0;">
                            <thead>
                                <tr>
                                    <th class="text-center s-text23">Product</th>
                                    <th class="text-center s-text23">Price</th>
                                    <th class="text-center s-text23">Quantity</th>
                                    <th class="text-center s-text23">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart as $c) {
                                    $code       = $c->code_product;
                                    $product    = $this->transaction->detailCart($code);
                                ?>
                                    <tr class="table-row s-text7">
                                        <td>
                                            <?php if (substr($code, 0, 5) != 'DRINK') {
                                                echo $product->food_name;
                                            } else {
                                                echo $product->drink_name;
                                            } ?>
                                        </td>
                                        <td>Rp. <?= number_format($c->price, '0', ',', '.'); ?></td>
                                        <td>
                                            <div>
                                                <input class="size7 s-text7 t-center num-product" type="number" name="qty" value="<?= $c->quantity; ?>">
                                            </div>
                                        </td>
                                        <td>Rp.
                                            <?php
                                            $subtotal = $c->price * $c->quantity;
                                            echo number_format($subtotal, '0', ',', '.');
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                                <tr class="table-head bg6 s-text23">
                                    <th class="text-right" colspan="5">Total : Rp. <?= number_format($confirmorder->total_transaction, '0', ',', '.'); ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>