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
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div id="flash" data-flash="<?= $this->session->flashdata('message'); ?>"></div>
            <div class="row">
                <div class="col-md-4">
                    <?php foreach ($editmenu as $em) { ?>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Menu</h3>
                            </div>
                            <form role="form" action="<?= base_url('configuration/updatemenu'); ?>" method="POST">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $em->id ?>">
                                <div class="card-body" style="padding-bottom: 5px;">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="menu">Menu</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control <?= form_error('menu') ? 'is-invalid' : null; ?>" name="menu" id="menu" value="<?= $em->menu ?>">
                                            <?= form_error('menu', '<small class="text-danger m-r-10">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="url">Url</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="url" id="url" value="<?= $em->url_menu ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="icon">Icon</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control <?= form_error('icon') ? 'is-invalid' : null; ?>" name="icon" id="icon" value="<?= $em->icon ?>">
                                            <?= form_error('icon', '<small class="text-danger m-r-10">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="sorting">Sorting</label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control <?= form_error('sorting') ? 'is-invalid' : null; ?>" name="sorting" id="sorting" min="1" value="<?= $em->sorting ?>">
                                            <?= form_error('sorting', '<small class="text-danger m-r-10">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="submenu">Sub</label>
                                        <div class="col-md-6">
                                            <select name="submenu" id="submenu" class="form-control">
                                                <option value="YES">YES</option>
                                                <option value="NO" <?php if ($em->submenu == "NO") {
                                                                        echo "selected";
                                                                    } ?>>NO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-8">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" href=""><?= $title ?></a></li>
                        <li class="nav-item"><a class="nav-link active" href="<?= base_url('configuration/sidebar') ?>">Add new menu</a></li>
                    </ul>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data table for Menu Sidebar</h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Icon</th>
                                        <th>Sorting</th>
                                        <th>Submenu</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" <?= $i = 1; ?>>
                                    <?php foreach ($menu as $m) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $m['menu']; ?></td>
                                            <td><i class="<?= $m['icon']; ?>"></i></td>
                                            <td><?= $m['sorting']; ?></td>
                                            <td><?= $m['submenu']; ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a class="btn btn-warning btn-sm" href="<?= base_url('configuration/editmenu/') . $m['id']; ?>"><i class="fa fa-edit"></i></a>
                                                    <a class="btn btn-danger btn-sm button-delete" href="<?= base_url('configuration/deletemenu/') . $m['id']; ?>"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Icon</th>
                                        <th>Sorting</th>
                                        <th>Submenu</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>