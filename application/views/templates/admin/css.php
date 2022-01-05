<?php
$site = $this->configuration_model->getConfig();
?>

<link rel="icon" type="image/png" href="<?= base_url('assets/'); ?>img/configuration/<?= $site['icon'] ?>">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<!-- SweetAlert2 & Toastr -->
<link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.css">
<link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url('assets/'); ?>css/admin/adminlte.css">
<base url="<?php echo site_url(); ?>" class-attr="<?php echo $this->router->fetch_class(); ?>" />