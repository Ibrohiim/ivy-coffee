<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $subtitle; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/admin') ?>"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('ingredients') ?>"> <?= $title; ?></a></li>
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
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('ingredients') ?>"><?= $title; ?></a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('ingredients/addnew') ?>"><?= $subtitle; ?></a></li>
                    </ul>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <a href="<?= base_url('ingredients'); ?>" class="btn btn-outline-primary"><i class="fas fa-reply"></i> <strong>Back</strong>
                            </a>
                        </div>
                        <form class="form-horizontal" method="POST" action="<?= base_url('ingredients/addnew/'); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="code">Ingredient Code</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= $code; ?>" id="code" class="form-control" disabled />
                                                <input type="hidden" value="<?= $code; ?>" id="code" name="code" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="name">Ingredient Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= set_value('name'); ?>" name="name" placeholder="Input new ingredient name" id="name" class="form-control <?= form_error('name') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('name', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="description">Description</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control <?= form_error('description') ? 'is-invalid' : null; ?>" name="description" rows="3" placeholder="Description"></textarea>
                                                <?= form_error('description', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="created">Date Created</label>
                                            <div class="col-sm-8">
                                                <input type="text" value="<?= date('Y-m-d H:i:s'); ?>" id="created" class="form-control" disabled />
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="hidden" value="<?= date('Y-m-d H:i:s'); ?>" id="created" name="created" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="unit">Ingredient Unit</label>
                                            <div class="col-sm-8">
                                                <select name="unit" id="unit" class="form-control">
                                                    <option value="kg">Kg</option>
                                                    <option value="gram">Gram</option>
                                                    <option value="liter">Liter</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="stock">Ingredient Stock</label>
                                            <div class="col-sm-8">
                                                <input type="number" value="<?= set_value('stock'); ?>" name="stock" placeholder="Input new ingredient stock" id="stock" class="form-control <?= form_error('stock') ? 'is-invalid' : null; ?>" />
                                                <?= form_error('stock', '<small class="text-danger m-r-10">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="col-md-4 col-md-offset-4 float-right">
                                                <a class="btn btn-default" href="<?= base_url('ingredients'); ?>">Cancel</a>
                                                <button class="btn btn-info float-right" type="submit">Save</button>
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