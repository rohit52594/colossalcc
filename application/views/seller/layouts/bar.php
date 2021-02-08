<!-- Vertical Nav -->
<nav class="hk-nav hk-nav-dark">
    <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
    <div class="nicescroll-bar">
        <div class="navbar-nav-wrap">
            <div class="nav-header">
                <span>Navigation</span>
                <span>Navigation</span>
            </div>
            <ul class="navbar-nav flex-column">
                <li class="nav-item <?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo site_url('seller/dashboard'); ?>">
                        <span class="feather-icon"><i data-feather="activity"></i></span>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-column">
                <li class="nav-item <?php echo ($this->uri->segment(2) == 'earning') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo site_url('seller/dashboard/earning'); ?>">
                        <span class="feather-icon"><i data-feather="activity"></i></span>
                        <span class="nav-link-text">Earning</span>
                    </a>
                </li>
            </ul>

            <hr class="nav-separator">
            <div class="nav-header">
                <span>Products</span>
                <span>Products</span>
            </div>



            <ul class="navbar-nav flex-column">

                <li class="nav-item <?php echo ($this->uri->segment(2) == 'product') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#product">
                        <span class="feather-icon"><i data-feather="shopping-cart"></i></span>
                        <span class="nav-link-text">Product</span>
                    </a>
                    <ul id="product" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('seller/product/new'); ?>">New product</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('seller/product/unapproved'); ?>">Under Verification</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('seller/product/view'); ?>">View products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('seller/product/inactive'); ?>">Inactive products</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav flex-column">

                <li class="nav-item <?php echo ($this->uri->segment(2) == 'orders') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#orders">
                        <span class="feather-icon"><i data-feather="shopping-cart"></i></span>
                        <span class="nav-link-text">Orders</span>
                    </a>
                    <ul id="orders" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('seller/orders/pending'); ?>">Pending Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('seller/orders/processing'); ?>">Processing Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('seller/orders/completed'); ?>">Completed Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('seller/orders/cancelled'); ?>">Cancelled Orders</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <hr class="nav-separator">
            <div class="nav-header">
                <span>Settings</span>
                <span>Settings</span>
            </div>
            <ul class="navbar-nav flex-column">

                <li class="nav-item <?php echo ($this->uri->segment(2) == 'settings') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#settingsUl">
                        <span class="feather-icon"><i data-feather="settings"></i></span>
                        <span class="nav-link-text">Settings</span>
                    </a>
                    <ul id="settingsUl" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('seller/settings/profile'); ?>">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('seller/settings/password'); ?>">Password</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('seller/settings/history'); ?>">Login history</a>
                                </li>
                                <!-- <li class="nav-item">
                                            <a class="nav-link" href="editable-table.html">Editable Table</a>
                                        </li> -->
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('seller/dashboard/logout'); ?>">
                        <span class="feather-icon"><i data-feather="log-out"></i></span>
                        <span class="nav-link-text">Logout</span>
                    </a>
                </li>
            </ul>
            <hr class="nav-separator">
            <div class="nav-header">
                <span>Getting Started</span>
                <span>GS</span>
            </div>
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('seller/dashboard/feedback/'); ?>">
                        <span class="feather-icon"><i data-feather="book"></i></span>
                        <span class="nav-link-text">Feedback</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('faq'); ?>" target="_BLANK">
                        <span class="feather-icon"><i data-feather="book"></i></span>
                        <span class="nav-link-text">FAQ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tel:+918402081401">
                        <span class="feather-icon"><i data-feather="headphones"></i></span>
                        <span class="nav-link-text">Support</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="hk-pg-wrapper">
    <!-- Breadcrumb -->
    <nav class="hk-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light bg-transparent">
            <li class="breadcrumb-item"><a href="<?php echo site_url('seller/dashboard'); ?>">Home</a></li>
            <?php if ($this->uri->segment(2)) { ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($this->uri->segment(2)); ?></li>
            <?php } ?>
            <?php if ($this->uri->segment(3)) { ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($this->uri->segment(3)); ?></li>
            <?php } ?>
        </ol>
    </nav>
    <!-- /Breadcrumb -->

    <!-- Container -->
    <div class="container">
        <!-- Title -->
        <!-- <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="archive"></i></span></span><?php echo $this->uri->segment(3) ? ucwords($this->uri->segment(3)) : ucwords($this->uri->segment(2)); ?></h4>
                </div> -->
        <!-- /Title -->

        <?php
        if ($this->session->flashdata('success')) {
            echo '<div class="alert alert-inv alert-inv-success alert-wth-icon alert-dismissible fade show" role="alert">
                            <span class="alert-icon-wrap"><i class="zmdi zmdi-check-circle"></i></span> ' . $this->session->flashdata('success') . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>';
        }
        ?>
        <?php
        if ($this->session->flashdata('danger')) {
            echo '<div class="alert alert-inv alert-inv-danger alert-wth-icon alert-dismissible fade show" role="alert">
                                <span class="alert-icon-wrap"><i class="zmdi zmdi-bug"></i></span> ' . $this->session->flashdata('danger') . '
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
        }
        ?>

        <?php
        if ($this->session->flashdata('warning')) {
            echo '<div class="alert alert-inv alert-inv-warning alert-wth-icon alert-dismissible fade show" role="alert">
                                <span class="alert-icon-wrap"><i class="zmdi zmdi-help"></i></span> ' . $this->session->flashdata('warning') . '
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
        }
        ?>