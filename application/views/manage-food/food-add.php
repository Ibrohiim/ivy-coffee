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
                        <li class="breadcrumb-item"><a href="<?= base_url('food') ?>"> <?= $title; ?></a></li>
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
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('food') ?>"><?= $title; ?></a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('food/addnewfood') ?>"><?= $subtitle; ?></a></li>
                    </ul>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <a href="<?= base_url('food'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                            </a>
                        </div>
                        <form class="form-horizontal" method="POST" action="<?= base_url('food/addnewfood'); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="food_code">Food Code</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $food_code; ?>" id="food_code" class="form-control <?= form_error('food_name') ? 'is-invalid' : null; ?>" disabled />
                                                <input type="hidden" value="<?= $food_code; ?>" id="food_code" name="food_code" class="form-control <?= form_error('food_name') ? 'is-invalid' : null; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="food_name">Food Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= set_value('food_name'); ?>" name="food_name" placeholder="Input new food name" id="food_name" class="form-control <?= form_error('food_name') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('food_name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="category">Category ID</label>
                                            <div class="col-sm-8">
                                                <select name="category" id="category" class="form-control <?= form_error('category') ? 'is-invalid' : null; ?>">
                                                    <option value="">Select Category</option>
                                                    <?php foreach ($category as $ca) : ?>
                                                        <option value="<?= $ca['id']; ?>"><?= $ca['category_name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('category', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="price">Food Price</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= set_value('price'); ?>" name="price" placeholder="Input new food price" id="price" class="form-control <?= form_error('price') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('price', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="stock">Food Stock</label>
                                            <div class="col-sm-8">
                                                <select name="stock" id="stock" class="form-control">
                                                    <option value="Ready-Stock">Ready Stock</option>
                                                    <option value="Sold-Out">Sold Out</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="discount">Current Discount</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= set_value('discount'); ?>" name="discount" id="discount" placeholder="New current discount" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="status">Select Status</label>
                                            <div class="col-sm-8">
                                                <select name="status" id="status" class="form-control ">
                                                    <option value="displayed">Displayed</option>
                                                    <option value="not displayed">Not Displayed</option>
                                                </select>
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
                                            <label class="col-sm-3 col-form-label" for="food_image">Food Image</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="previewimage" name="food_image">
                                                        <label class="custom-file-label" for="food_image">Choose file</label>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: 5px;">
                                                    <div class="col-md-5">
                                                        <img src="<?= base_url('assets/img/product/example.jpg'); ?>" class="img-thumbnail" id="image_load">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="description">Description</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="description" rows="3" placeholder="Enter ..."></textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="col-md-6 float-right">
                                                <a class="btn btn-default" href="<?= base_url('food'); ?>">Cancel</a>
                                                <button class="btn btn-danger" type="reset">Reset</button>
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