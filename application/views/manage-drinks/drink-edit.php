<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/admin') ?>"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('drinks') ?>"> <?= $title; ?></a></li>
                        <li class="breadcrumb-item active"><?= $subtitle; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div id="flash" data-flash="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('drinks') ?>"><?= $title; ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('drinks/addnewdrink') ?>">Add new Drink</a></li>
                        <li class="nav-item"><a class="nav-link active" href=""><?= $subtitle; ?></a></li>
                    </ul>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <a href="<?= base_url('drinks'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                            </a>
                        </div>
                        <form class="form-horizontal" method="POST" action="<?= base_url('drinks/editdrink/' . $editdrink->id); ?>" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $editdrink->id ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="drink_code">Drink Code</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $editdrink->drink_code ?>" id="drink_code" class="form-control <?= form_error('drink_code') ? 'is-invalid' : null; ?>" disabled />
                                                <input type="hidden" value="<?= $editdrink->drink_code ?>" id="drink_code" name="drink_code" class="form-control <?= form_error('drink_code') ? 'is-invalid' : null; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="drink_name">Drink Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $editdrink->drink_name ?>" name="drink_name" placeholder="Input new drink name" id="drink_name" class="form-control <?= form_error('drink_name') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('drink_name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="category">Category ID</label>
                                            <div class="col-sm-8">
                                                <select name="category" id="category" class="form-control <?= form_error('category') ? 'is-invalid' : null; ?>">
                                                    <?php foreach ($category as $ca) : ?>
                                                        <option value="<?= $ca->id; ?>" <?php
                                                                                        if ($editdrink->category == $ca->id) {
                                                                                            echo "selected";
                                                                                        } ?>>
                                                            <?= $ca->category_name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('category', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="price">Drink Price</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $editdrink->price ?>" name="price" placeholder="Input new drink price" id="price" class="form-control <?= form_error('price') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('price', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="stock">Stock Drink</label>
                                            <div class="col-sm-8">
                                                <select name="stock" id="stock" class="form-control ">
                                                    <option value="Ready-Stock">Ready Stock</option>
                                                    <option value="Sold-Out" <?php if ($editdrink->stock == "Sold-Out") {
                                                                                    echo "selected";
                                                                                } ?>>
                                                        Sold Out
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="discount">Current Discount</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $editdrink->discount ?>" name="discount" id="discount" placeholder="New current discount" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="created">Date Created</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= date('Y-m-d H:i:s'); ?>" id="created" class="form-control" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="status">Select Status</label>
                                            <div class="col-sm-8">
                                                <select name="status" id="status" class="form-control ">
                                                    <option value="displayed">Displayed</option>
                                                    <option value="not displayed" <?php if ($editdrink->status == "not displayed") {
                                                                                        echo "selected";
                                                                                    } ?>>
                                                        Not Displayed
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="drink_image">Drink Image</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="previewimage" name="drink_image">
                                                        <label class="custom-file-label" for="drink_image">Choose file</label>
                                                    </div>
                                                </div>
                                                <div style="padding-top: 10px;">
                                                    <img id="image_load" style="width: 50%" src="<?= base_url('assets/img/product/drink/') . $editdrink->drink_image; ?>" class="img" alt="<?= $editdrink->drink_name ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="description">Description</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."><?= $editdrink->description ?></textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="col-md-6 float-right">
                                                <a class="btn btn-default" href="<?= base_url('drinks'); ?>">Cancel</a>
                                                <button class="btn btn-success" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>