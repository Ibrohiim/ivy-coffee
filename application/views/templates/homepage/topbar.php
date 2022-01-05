<?php
$site = $this->configuration_model->getConfig();

?>
<!-- Header -->
<header class="header1">
    <!-- Header desktop -->
    <div class="container-menu-header">
        <div class="topbar"></div>
        <div class="wrap_header">
            <a href="" class="logo">
                <img src="<?= base_url('assets/img/') ?>configuration/<?= $site['logo'] ?>" alt="<?= $site['website_name'] ?> | <?= $site['tagline'] ?>">
            </a>
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li>
                            <a <?= $this->uri->segment(1) == 'homepage' && $this->uri->segment(2) == null ? ' style="text-decoration:underline;" ' : null ?> href="<?= base_url('homepage'); ?>">Home</a>
                        </li>
                        <li>
                            <a <?= $this->uri->segment(2) == 'drinks' || $this->uri->segment(2) == 'food' ? ' style="text-decoration:underline;" ' : null ?> href="#">Shop</a>
                            <ul class="sub_menu">
                                <li style="padding: 0 10px 5px 10px;">
                                    <a href="<?= base_url('homepage/drinks'); ?>" class="s-text13 <?= $this->uri->segment(2) == 'drinks' ? 'p-l-10 nav-category-active' : null ?>">Drinks</a>
                                </li>
                                <li style="padding: 0 10px 5px 10px;">
                                    <a href="<?= base_url('homepage/food'); ?>" class="s-text13 <?= $this->uri->segment(2) == 'food' ? 'p-l-10 nav-category-active' : null ?>">Food</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a <?= $this->uri->segment(2) == 'offers' ? ' style="text-decoration:underline;" ' : null ?> href="<?= base_url('homepage/offers'); ?>">Special Offers</a>
                        </li>
                        <li>
                            <a <?= $this->uri->segment(2) == 'about' ? ' style="text-decoration:underline;" ' : null ?> href="<?= base_url('homepage/about'); ?>">About</a>
                        </li>
                        <li>
                            <a <?= $this->uri->segment(2) == 'contact' ? ' style="text-decoration:underline;" ' : null ?> href="<?= base_url('homepage/contact'); ?>">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header-icons">
                <a href="<?= base_url('auth') ?>" class="header-wrapicon1 dis-block">
                    <img src="<?= base_url('assets/'); ?>img/icons/user.png" class="header-icon1" alt="ICON">
                </a>
                <span class="linedivide1"></span>
                <div class="header-wrapicon2 cartcontent">

                </div>
            </div>
        </div>
        <?php if ($this->uri->segment(2) == 'drinks' || $this->uri->segment(2) == 'food') { ?>
            <div class="wrap-menu-category">
                <nav class="menu">
                    <ul class="main-menu-category">
                        <?php foreach ($categoryhome as $ch) { ?>
                            <li>
                                <a href="
                                <?php if ($this->uri->segment(2) == 'drinks') {
                                    echo base_url('homepage/drinks/' . $ch->category_slug);
                                } else {
                                    echo base_url('homepage/food/' . $ch->category_slug);
                                } ?>" class="s-text13 <?= $this->uri->segment(3) == $ch->category_slug ? 'p-l-5 p-r-5 nav-category-active' : null ?>"><?= $ch->category_name; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        <?php } ?>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile fixed-top" <?= $this->uri->segment(2) == 'drinks' || $this->uri->segment(2) == 'food' ? ' style="padding-bottom: 0"' : null ?>>
        <a href="#" class="logo-mobile">
            <img src="<?= base_url('assets/img/') ?>configuration/<?= $site['logo'] ?>" alt="<?= $site['website_name'] ?> | <?= $site['tagline'] ?>">
        </a>
        <div class="btn-show-menu p-r-10">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">
                <span class="linedivide2"></span>
                <div class="header-wrapicon2 m-r-10 cartcontent">

                </div>
            </div>
        </div>
        <?php if ($this->uri->segment(2) == 'drinks' || $this->uri->segment(2) == 'food') { ?>
            <div class="menu_header_mobile">
                <nav class="menu">
                    <ul class="main_menu">
                        <?php foreach ($categoryhome as $ch) { ?>
                            <li style="padding: 5px 10px 5px 10px;">
                                <a href="
                                    <?php if ($this->uri->segment(2) == 'drinks') {
                                        echo base_url('homepage/drinks/' . $ch->category_slug);
                                    } else {
                                        echo base_url('homepage/food/' . $ch->category_slug);
                                    } ?>" class="s-text13 <?= $this->uri->segment(3) == $ch->category_slug ? 'p-l-5 p-r-5 nav-category-active' : null ?>"><?= $ch->category_name; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
    </div>
<?php } ?>
<!-- Bottom Navbar Mobile -->
<div class="bottom_navbar_mobile fixed-bottom">
    <nav class="menu_mobile">
        <ul class="main_menu_mobile">
            <li>
                <button class="footer-wrapicon dis-block show-sidebar">
                    <img src="<?= base_url('assets/'); ?>img/icons/menu.png" class="header-icon1" alt="ICON">
                </button>
            </li>
            <li>
                <a href="<?= base_url('homepage/offers') ?>" class="footer-wrapicon dis-block">
                    <img src="<?= base_url('assets/'); ?>img/icons/offerswhite.png" class="header-icon1" alt="ICON">
                </a>
            </li>
            <li>
                <a href="<?= base_url('homepage/food') ?>" class="footer-wrapicon dis-block">
                    <img src="<?= base_url('assets/'); ?>img/icons/foodwhite.png" class="header-icon1" alt="ICON">
                </a>
            </li>
            <li>
                <a href="<?= base_url('homepage/drinks') ?>" class="footer-wrapicon dis-block">
                    <img src="<?= base_url('assets/'); ?>img/icons/coffeewhite.png" class="header-icon1" alt="ICON">
                </a>
            </li>
            <li>
                <a href="<?= base_url('auth') ?>" class="footer-wrapicon dis-block">
                    <img src="<?= base_url('assets/'); ?>img/icons/user.png" class="header-icon1" alt="ICON">
                </a>
            </li>
        </ul>
    </nav>
</div>
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="row">
            <div class="col-12">
                <a class="h5 mb-0 d-flex align-items-center">
                    <img class="logo-sidebar2" src="<?= base_url('assets/img/') ?>configuration/<?= $site['icon'] ?>" alt="<?= $site['website_name'] ?> | <?= $site['tagline'] ?>">
                </a>
            </div>
        </div>
        <button type="button" class="sidebar-closebtn">
            <span aria-hidden="true" style="font-size: 33px;font-weight: 100;">×</span>
        </button>
    </div>
    <div class="sidebar-body">
        <aside class="sidebar">
            <nav class="sidebar-nav">
                <ul class="main-menu">
                    <li class="item-menu-mobile">
                        <a href="<?= base_url('homepage'); ?>" class="<?= $this->uri->segment(1) == 'homepage' && $this->uri->segment(2) == null ? ' nav-mobile-active' : null ?>"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="item-menu-mobile">
                        <a href="#" class="show-shop <?= $this->uri->segment(2) == 'drinks' || $this->uri->segment(2) == 'food' ? ' nav-mobile-active' : null ?>"><i class="fas fa-utensils"></i> Shop</a>
                        <ul class="sub-menu">
                            <li><a href="<?= base_url('homepage/drinks'); ?>" class="<?= $this->uri->segment(2) == 'drinks' ? 'active' : null ?>">Drinks</a></li>
                            <li><a href="<?= base_url('homepage/food'); ?>" class="<?= $this->uri->segment(2) == 'food' ? 'active' : null ?>">Food</a></li>
                        </ul>
                        <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
                    </li>
                    <li class="item-menu-mobile">
                        <a href="<?= base_url('homepage/offers'); ?>" class="<?= $this->uri->segment(2) == 'offers' ? ' nav-mobile-active' : null ?>"><i class="fas fa-utensils"></i> Special Offers</a>
                    </li>
                    <li class="item-menu-mobile">
                        <a href="<?= base_url('homepage/about'); ?>" class="<?= $this->uri->segment(2) == 'about' ? ' nav-mobile-active' : null ?>"><i class="fas fa-utensils"></i> About</a>
                    </li>
                    <li class="item-menu-mobile">
                        <a href="<?= base_url('homepage/contact'); ?>" class="<?= $this->uri->segment(2) == 'contact' ? ' nav-mobile-active' : null ?>"><i class="fas fa-utensils"></i> Contact</a>
                    </li>
                    <li class="item-menu-mobile">
                        <a href="<?= base_url('homepage/shopping'); ?>" class="<?= $this->uri->segment(2) == 'shopping' ? ' nav-mobile-active' : null ?>"><i class="fas fa-shopping-cart"></i> View Cart</a>
                    </li>
                </ul>
            </nav>
        </aside>
    </div>
    <div class="footer-sidebar">
        <div class="t-center s-text8">
            © <?= date('Y'); ?> <a href="<?= $site['instagram']; ?>/" target="_blank"><?= $site['website_name']; ?></a>
        </div>
    </div>
</div>
</header>