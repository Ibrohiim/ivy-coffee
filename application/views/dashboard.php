<style type="text/css">
    @media print {
        body * {
            visibility: hidden;
        }

        #printSection * {
            visibility: visible;
        }

        .modal {
            position: absolute;
            left: 0;
            top: 0;
            margin: 0;
            padding: 0;
        }

        .invoice {
            width: max-content;
        }

        header,
        .footer,
        footer {
            display: none;
        }
    }
</style>
<?php if ($this->session->userdata('role_id') == 1) { ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div id="flash-login" data-flash="<?= $this->session->flashdata('flashLogin'); ?>"></div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?= $totalTransactions; ?></h3>
                                <p>Daily Transactions</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#dailyTransactions" data-toggle="modal" data-target="#dailyTransactions" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $totalUser; ?></h3>
                                <p>Total User</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-stalker"></i>
                            </div>
                            <a href="<?= base_url('manageuser/manageuser') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= $totalDrinks; ?></h3>
                                <p>Drinks</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-coffee"></i>
                            </div>
                            <a href="<?= base_url('drinks'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?= $totalFood; ?></h3>
                                <p>Food</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pizza"></i>
                            </div>
                            <a href="<?= base_url('food'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Favorite Drink</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <?php foreach ($FavoriteDrink as $FD) : ?>
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="<?= base_url('assets/img/product/drink/') . $FD['image']; ?>" alt="Product Image" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="#detaildrink<?= $FD['code_product']; ?>" data-toggle="modal" data-target="#detaildrink<?= $FD['code_product']; ?>" class="product-title"><?= $FD['name']; ?>
                                                    <span class="badge badge-warning float-right">Rp <?= number_format($FD['price'], '0', ',', '.'); ?></span></a>
                                                <span class="product-description">
                                                    Total Ordered : <?= $FD['total_qty']; ?>
                                                </span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?= base_url('drinks'); ?>" class="uppercase">View All Drinks</a>
                            </div>
                        </div>
                        <div class="card collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Favorite Food</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <?php foreach ($FavoriteFood as $FF) : ?>
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="<?= base_url('assets/img/product/food/') . $FF['image']; ?>" alt="Product Image" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="#detailfood<?= $FF['code_product']; ?>" data-toggle="modal" data-target="#detailfood<?= $FF['code_product']; ?>" class="product-title"><?= $FF['name']; ?>
                                                    <span class="badge badge-warning float-right">Rp <?= number_format($FF['price'], '0', ',', '.'); ?></span></a>
                                                <span class="product-description">
                                                    Total Ordered : <?= $FF['total_qty']; ?>
                                                </span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?= base_url('food'); ?>" class="uppercase">View All Food</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Latest Orders</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Order Code</th>
                                                <th>Type</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($LatestInvoice as $LI) : ?>
                                                <tr>
                                                    <td>
                                                        <a href="#orderdetails<?= $LI['transaction_code']; ?>" data-toggle="modal" data-target="#orderdetails<?= $LI['transaction_code']; ?>" class="product-title"><?= $LI['transaction_code']; ?></a>
                                                    </td>
                                                    <td><?= $LI['order_type']; ?></td>
                                                    <td><?= $LI['customer_name']; ?></td>
                                                    <td>
                                                        <?php if ($LI['payment_status'] == 'Complete') { ?>
                                                            <span class="badge badge-success w-100">Complete</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-danger w-100">Pending</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        Rp <?= number_format($LI['total_transaction'], '0', ',', '.'); ?>
                                                    </td>
                                                    <td><?= $LI['transaction_date']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <a href="<?= base_url('transactions/sales') ?>" class="btn btn-sm btn-info float-left">Place New Order</a>
                                <a href="<?= base_url('transactions/listtransactions') ?>" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php } elseif ($this->session->userdata('role_id') == 3) { ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div id="flash-login" data-flash="<?= $this->session->flashdata('flashLogin'); ?>"></div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?= $totalTransactions; ?></h3>
                                <p>Daily Transactions</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#dailyTransactions" data-toggle="modal" data-target="#dailyTransactions" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= $totalDrinks; ?></h3>
                                <p>Drinks</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-coffee"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?= $totalFood; ?></h3>
                                <p>Total Food</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $totalTable; ?></h3>
                                <p>Total Table</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-cubes"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Favorite Drink</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <?php foreach ($FavoriteDrink as $FD) : ?>
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="<?= base_url('assets/img/product/drink/') . $FD['image']; ?>" alt="Product Image" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="#detaildrinkt<?= $FD['code_product']; ?>" data-toggle="modal" data-target="#detaildrink<?= $FD['code_product']; ?>" class="product-title"><?= $FD['name']; ?>
                                                    <span class="badge badge-warning float-right">Rp <?= number_format($FD['price'], '0', ',', '.'); ?></span></a>
                                                <span class="product-description">
                                                    Total Ordered : <?= $FD['total_qty']; ?>
                                                </span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="card collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Favorite Food</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <?php foreach ($FavoriteFood as $FF) : ?>
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="<?= base_url('assets/img/product/food/') . $FF['image']; ?>" alt="Product Image" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="#detailfood<?= $FF['code_product']; ?>" data-toggle="modal" data-target="#detailfood<?= $FF['code_product']; ?>" class="product-title"><?= $FF['name']; ?>
                                                    <span class="badge badge-warning float-right">Rp <?= number_format($FF['price'], '0', ',', '.'); ?></span></a>
                                                <span class="product-description">
                                                    Total Ordered : <?= $FF['total_qty']; ?>
                                                </span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Latest Orders</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Order Code</th>
                                                <th>Type</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($LatestInvoice as $LI) : ?>
                                                <tr>
                                                    <td>
                                                        <a href="#orderdetails<?= $LI['transaction_code']; ?>" data-toggle="modal" data-target="#orderdetails<?= $LI['transaction_code']; ?>" class="product-title"><?= $LI['transaction_code']; ?></a>
                                                    </td>
                                                    <td><?= $LI['order_type']; ?></td>
                                                    <td><?= $LI['customer_name']; ?></td>
                                                    <td>
                                                        <?php if ($LI['payment_status'] == 'Complete') { ?>
                                                            <span class="badge badge-success w-100">Complete</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-danger w-100">Pending</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        Rp <?= number_format($LI['total_transaction'], '0', ',', '.'); ?>
                                                    </td>
                                                    <td><?= $LI['transaction_date']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php } elseif ($this->session->userdata('role_id') == 4) { ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div id="flash-login" data-flash="<?= $this->session->flashdata('flashLogin'); ?>"></div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?= $totalTransactions; ?></h3>
                                <p>Daily Transactions</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#dailyTransactions" data-toggle="modal" data-target="#dailyTransactions" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= $totalDrinks; ?></h3>
                                <p>Drinks</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-coffee"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?= $totalFood; ?></h3>
                                <p>Total Food</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $totalTable; ?></h3>
                                <p>Total Table</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-cubes"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Favorite Drink</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <?php foreach ($FavoriteDrink as $FD) : ?>
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="<?= base_url('assets/img/product/drink/') . $FD['image']; ?>" alt="Product Image" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="#detaildrink<?= $FD['code_product']; ?>" data-toggle="modal" data-target="#detaildrink<?= $FD['code_product']; ?>" class="product-title"><?= $FD['name']; ?>
                                                    <span class="badge badge-warning float-right">Rp <?= number_format($FD['price'], '0', ',', '.'); ?></span></a>
                                                <span class="product-description">
                                                    Total Ordered : <?= $FD['total_qty']; ?>
                                                </span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="card collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Favorite Food</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    <?php foreach ($FavoriteFood as $FF) : ?>
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="<?= base_url('assets/img/product/food/') . $FF['image']; ?>" alt="Product Image" class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="#detailfood<?= $FF['code_product']; ?>" data-toggle="modal" data-target="#detailfood<?= $FF['code_product']; ?>" class="product-title"><?= $FF['name']; ?>
                                                    <span class="badge badge-warning float-right">Rp <?= number_format($FF['price'], '0', ',', '.'); ?></span></a>
                                                <span class="product-description">
                                                    Total Ordered : <?= $FF['total_qty']; ?>
                                                </span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Latest Orders</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Order Code</th>
                                                <th>Type</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($LatestInvoice as $LI) : ?>
                                                <tr>
                                                    <td>
                                                        <a href="#orderdetails<?= $LI['transaction_code']; ?>" data-toggle="modal" data-target="#orderdetails<?= $LI['transaction_code']; ?>" class="product-title"><?= $LI['transaction_code']; ?></a>
                                                    </td>
                                                    <td><?= $LI['order_type']; ?></td>
                                                    <td><?= $LI['customer_name']; ?></td>
                                                    <td>
                                                        <?php if ($LI['payment_status'] == 'Complete') { ?>
                                                            <span class="badge badge-success w-100">Complete</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-danger w-100">Pending</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        Rp <?= number_format($LI['total_transaction'], '0', ',', '.'); ?>
                                                    </td>
                                                    <td><?= $LI['transaction_date']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php } ?>

<?php
$no = 0;
foreach ($drinks as $d) : $no++; ?>
    <div class="modal fade" id="detaildrink<?= $d->drink_code; ?>" tabindex="-1" role="dialog" aria-labelledby="detailDrinkTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailDrinkLongTitle">Drink Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="col-12">
                                <img src="<?= base_url('assets/img/product/drink/') . $d->drink_image; ?>" alt="<?= $d->drink_name; ?>" class="product-image">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3><strong><?= $d->drink_name; ?></strong></h3>
                            <div class="row">
                                <div class="col-12">
                                    <p class="mb-2"><?= $d->description; ?></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0">Drink Code</p>
                                    <p class="mb-0">Category</p>
                                    <p class="mb-0">Price</p>
                                    <p class="mb-0">Stock</p>
                                    <p class="mb-0">Discount</p>
                                    <p class="mb-0">Status</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0"> : <?= $d->drink_code; ?></p>
                                    <p class="mb-0"> : <?= $d->category_name; ?></p>
                                    <p class="mb-0"> : Rp <?= number_format($d->price, '0', ',', '.'); ?></p>
                                    <p class="mb-0"> : <?= $d->stock; ?></p>
                                    <p class="mb-0"> : <?= $d->discount; ?>%</p>
                                    <p class="mb-0"> : <?= $d->status; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center>
                        <p class="mb-0 mt-2">
                            <small class="text-muted">
                                Last updated
                                <?php
                                $date = date_create($d->updated);
                                echo date_format($date, 'd F Y')
                                ?>
                            </small>
                        </p>
                    </center>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php
$no = 0;
foreach ($food as $f) : $no++; ?>
    <div class="modal fade" id="detailfood<?= $f->food_code; ?>" tabindex="-1" role="dialog" aria-labelledby="detailFoodTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailFoodLongTitle">Food Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="col-12">
                                <img src="<?= base_url('assets/img/product/food/') . $f->food_image; ?>" alt="<?= $f->food_name; ?>" class="product-image">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3><strong><?= $f->food_name; ?></strong></h3>
                            <div class="row">
                                <div class="col-12">
                                    <p class="mb-2"><?= $f->description; ?></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0">Food Code</p>
                                    <p class="mb-0">Category</p>
                                    <p class="mb-0">Price</p>
                                    <p class="mb-0">Stock</p>
                                    <p class="mb-0">Discount</p>
                                    <p class="mb-0">Status</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0"> : <?= $f->food_code; ?></p>
                                    <p class="mb-0"> : <?= $f->category_name; ?></p>
                                    <p class="mb-0"> : Rp <?= number_format($f->price, '0', ',', '.'); ?></p>
                                    <p class="mb-0"> : <?= $f->stock; ?></p>
                                    <p class="mb-0"> : <?= $f->discount; ?>%</p>
                                    <p class="mb-0"> : <?= $f->status; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center>
                        <p class="mb-0 mt-2">
                            <small class="text-muted">
                                Last updated
                                <?php
                                $date = date_create($f->updated);
                                echo date_format($date, 'd F Y')
                                ?>
                            </small>
                        </p>
                    </center>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php
$ni = 0;
foreach ($LatestInvoice as $LI) : $ni++; ?>
    <div class="modal fade bd-example-modal-lg" id="orderdetails<?= $LI['transaction_code'] ?>" tabindex="-1" role="dialog" aria-labelledby=orderDetailsTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12" id="printSection">
                            <div class="invoice p-3 mb-3 mt-2">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-globe"></i> English Ivy Coffee
                                            <small class="float-right"><b>Invoice #<?= $LI['transaction_code']; ?></b></small>
                                        </h4>
                                    </div>
                                </div>
                                <div class="row invoice-info pb-2 pt-2">
                                    <div class="col-sm-4 invoice-col">
                                        <table class="table table-sm table-borderless table-detail-transaction">
                                            <tbody>
                                                <tr>
                                                    <td><b>Operator</b></td>
                                                    <td>: Admin</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Cashier</b></td>
                                                    <td>: <?= $LI['cashier']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Order Type</b></td>
                                                    <td>: <?= $LI['order_type']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Table</b></td>
                                                    <td>: <?= $LI['table_name']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <table class="table table-sm table-borderless table-detail-transaction">
                                            <tbody>
                                                <tr>
                                                    <td><b>Customer</b></td>
                                                    <td>: <?= $LI['customer_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Payment Status</b></td>
                                                    <td>: <?= $LI['payment_status']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Payment Due</b></td>
                                                    <td>: <?= $LI['transaction_date']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Qty</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $code = $LI['transaction_code'];
                                                $transactions = $this->transaction->getCart($code);
                                                foreach ($transactions as $trans) : ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td>
                                                            <?php if ($trans->drink_name == null) {
                                                                echo $trans->food_name;
                                                            } else {
                                                                echo $trans->drink_name;
                                                            } ?>
                                                        </td>
                                                        <td>RP <?= number_format($trans->price, '0', ',', '.') ?></td>
                                                        <td><?= $trans->quantity; ?></td>
                                                        <td>RP <?= number_format($trans->total_price, '0', ',', '.') ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                    </div>
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td>RP <?= number_format($LI['total_transaction'], '0', ',', '.') ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tax</th>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping:</th>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>RP <?= number_format($LI['total_transaction'], '0', ',', '.') ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row no-print float-right">
                                <div class="col-12">
                                    <button rel="noopener" class="btn btn-default" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="modal fade bd-example-modal-lg" id="dailyTransactions" tabindex="-1" role="dialog" aria-labelledby=dailyTransactionsTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" id="printSection">
                        <div class="invoice p-3 mb-3 mt-2">
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-fw fa-file-invoice"></i> <?= $subtitle; ?>
                                        <small class="float-right">Date: <?= date('d'); ?>/<?= date('m'); ?>/<?= date('Y'); ?></small>
                                    </h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Transaction Code</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $grand_total = 0;
                                            foreach ($DailyTransaction as $DT) :
                                                $grand_total = $grand_total + $DT->total_price;
                                            ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $DT->transaction_code; ?></td>
                                                    <td>
                                                        <?php if ($DT->drink_name == null) {
                                                            echo $DT->food_name;
                                                        } else {
                                                            echo $DT->drink_name;
                                                        } ?>
                                                    </td>
                                                    <td>Rp. <?= number_format($DT->price, 0); ?></td>
                                                    <td><?= $DT->quantity; ?></td>
                                                    <td>Rp. <?= number_format($DT->total_price, 0); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th class="text-right">Grand Total : </th>
                                                <th>Rp. <?= number_format($grand_total, 0); ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row no-print float-right">
                            <div class="col-12">
                                <button class="btn btn-default" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>