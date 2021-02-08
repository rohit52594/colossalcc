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
                    <a class="nav-link" href="<?php echo site_url('admin/dashboard'); ?>">
                        <span class="feather-icon"><i data-feather="activity"></i></span>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-column">

                <?php
                $totalContact = $this->Crud->Count('contact', " `viewed` = '0'");
                $totalSellers = $this->Crud->Count('seller_request', " `viewed` = '0'");
                $totalReports = $this->Crud->Count('report', " `viewed` = '0'");
                $totalRequirements = $this->Crud->Count('requirements', " `viewed` = '0'");

                $totalQueryMessage = $totalContact + $totalSellers + $totalReports + $totalRequirements;

                ?>

                <li class="nav-item <?php echo ($this->uri->segment(2) == 'queries') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#queries">
                        <span class="feather-icon"><i data-feather="message-square"></i></span>
                        <span class="nav-link-text">Queries&ensp;<?php echo ($totalQueryMessage > 0) ? '<span class="badge badge-sm badge-info badge-pill">' . $totalQueryMessage . ' new</span>' : ''; ?></span>
                    </a>
                    <ul id="queries" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">

                                    <a class="nav-link" href="<?php echo site_url('admin/queries/contacts'); ?>">Contacts&ensp;<?php echo ($totalContact > 0) ? '<span class="badge badge-sm badge-info badge-pill">' . $totalContact . ' new</span>' : ''; ?></a>

                                </li>
                                <li class="nav-item">

                                    <a class="nav-link" href="<?php echo site_url('admin/queries/sellers'); ?>">Seller requests&ensp;<?php echo ($totalSellers > 0) ? '<span class="badge badge-sm badge-info badge-pill">' . $totalSellers . ' new</span>' : ''; ?></a>

                                </li>
                                <li class="nav-item">

                                    <a class="nav-link" href="<?php echo site_url('admin/queries/reports'); ?>">Reports&ensp;<?php echo ($totalReports > 0) ? '<span class="badge badge-sm badge-info badge-pill">' . $totalReports . ' new</span>' : ''; ?></a>

                                </li>
                                <li class="nav-item">

                                    <a class="nav-link" href="<?php echo site_url('admin/queries/requirements'); ?>">Requirements&ensp;<?php echo ($totalRequirements > 0) ? '<span class="badge badge-sm badge-info badge-pill">' . $totalRequirements . ' new</span>' : ''; ?></a>

                                </li>
                                <li class="nav-item">

                                    <a class="nav-link" href="<?php echo site_url('admin/queries/seller_feedbacks'); ?>">Seller feedbacks</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/queries/franchise_feedbacks'); ?>">Franchise feedbacks</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>


            <ul class="navbar-nav flex-column">

                <li class="nav-item <?php echo ($this->uri->segment(2) == 'blog') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#blog">
                        <span class="feather-icon"><i data-feather="book-open"></i></span>
                        <span class="nav-link-text">Blog</span>
                    </a>
                    <ul id="blog" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">

                                    <a class="nav-link" href="<?php echo site_url('admin/blog/new'); ?>">New post</a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" href="<?php echo site_url('admin/blog/published'); ?>">Published</a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" href="<?php echo site_url('admin/blog/unpublished'); ?>">Unpublished</a>

                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav flex-column">

                        <li class="nav-item <?php echo ($this->uri->segment(2) == 'reports') ? 'active' : ''; ?>">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#reports">
                                <span class="feather-icon"><i data-feather="bar-chart-2"></i></span>
                                <span class="nav-link-text">Reports</span>
                            </a>
                            <ul id="reports" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo site_url('admin/reports/delivery'); ?>">Delivery report</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo site_url('admin/reports/deliverers'); ?>">Deliverers report</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav flex-column">
                <li class="nav-item <?php echo ($this->uri->segment(2) == 'coupons') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#coupons">
                        <span class="feather-icon"><i data-feather="gift"></i></span>
                        <span class="nav-link-text">Coupons</span>
                    </a>
                    <ul id="coupons" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/coupons/generate'); ?>">Generate Coupon</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/coupons/active'); ?>">Active Coupons</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/coupons/inactive'); ?>">Inactive/Expired Coupons</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/coupons/statistics'); ?>">Coupon Statistics</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav flex-column">
                <li class="nav-item <?php echo ($this->uri->segment(2) == 'notifications') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#notifications">
                        <span class="feather-icon"><i data-feather="bell"></i></span>
                        <span class="nav-link-text">Notifications</span>
                    </a>
                    <ul id="notifications" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/notifications/newNotification'); ?>">New Notification</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/notifications/active'); ?>">Active Notifications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/notifications/inactive'); ?>">Past Notifications</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <hr class="nav-separator">
            <div class="nav-header">
                <span>Product</span>
                <span>Product</span>
            </div>
            <ul class="navbar-nav flex-column">

                <li class="nav-item <?php echo ($this->uri->segment(2) == 'categorization') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#tables_drp">
                        <span class="feather-icon"><i data-feather="list"></i></span>
                        <span class="nav-link-text">Categorization</span>
                    </a>
                    <ul id="tables_drp" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/categorization/types'); ?>">Types</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/categorization/category'); ?>">Category</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/categorization/subcategory'); ?>">Sub-category</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/categorization/quantities'); ?>">Quantities</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

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
                                    <a class="nav-link" href="<?php echo site_url('admin/product/new'); ?>">New product</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/product/view'); ?>">View products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/product/inactive'); ?>">Inactive products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/product/unapproved'); ?>">Vendor Unapproved Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/product/vendorActive'); ?>">Vendor Active Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/product/vendorInactive'); ?>">Vendor Inactive Products</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav flex-column">

                <li class="nav-item <?php echo ($this->uri->segment(2) == 'orders') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#orders">
                        <span class="feather-icon"><i data-feather="box"></i></span>
                        <span class="nav-link-text">Orders</span>
                    </a>
                    <ul id="orders" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/orders/unapproved'); ?>">Unapproved orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/orders/ongoing'); ?>">Ongoing orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/orders/delivered'); ?>">Delivered orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/orders/cancelled'); ?>">Cancelled orders</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <hr class="nav-separator">
            <div class="nav-header">
                <span>Members</span>
                <span>Members</span>
            </div>
            <ul class="navbar-nav flex-column">

                <li class="nav-item <?php echo ($this->uri->segment(2) == 'seller') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#sellerUI">
                        <span class="feather-icon"><i data-feather="truck"></i></span>
                        <span class="nav-link-text">Seller</span>
                    </a>
                    <ul id="sellerUI" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/seller/new'); ?>">Add new Seller</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/seller/view'); ?>">View Sellers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/seller/payment'); ?>">Seller Payments</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav flex-column">
                <li class="nav-item <?php echo ($this->uri->segment(2) == 'deliverer') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#delivererUl">
                        <span class="feather-icon"><i data-feather="map-pin"></i></span>
                        <span class="nav-link-text">Deliverer</span>
                    </a>
                    <ul id="delivererUl" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/deliverer/new'); ?>">Add new deliverer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/deliverer/view'); ?>">View deliverers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/deliverer/payrole'); ?>">Calculate Deliverer Payment</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav flex-column">
                <li class="nav-item <?php echo ($this->uri->segment(2) == 'customers') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#customer">
                        <span class="feather-icon"><i data-feather="user-check"></i></span>
                        <span class="nav-link-text">Customers</span>
                    </a>
                    <ul id="customer" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/customers/active'); ?>">Active customers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/customers/blocked'); ?>">Blocked customers</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav flex-column">

                <li class="nav-item <?php echo ($this->uri->segment(2) == 'franchise') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#franchiseUI">
                        <span class="feather-icon"><i data-feather="truck"></i></span>
                        <span class="nav-link-text">Franchise</span>
                    </a>
                    <ul id="franchiseUI" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/franchise/new'); ?>">Add new franchise</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/franchise/view'); ?>">Manage franchises</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav flex-column">

                <li class="nav-item <?php echo ($this->uri->segment(2) == 'employee') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#employeeUI">
                        <span class="feather-icon"><i data-feather="user"></i></span>
                        <span class="nav-link-text">Employee</span>
                    </a>
                    <ul id="employeeUI" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/employee/newEmployee'); ?>">Add new employee</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/employee/view'); ?>">Manage employees</a>
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
                                    <a class="nav-link" href="<?php echo site_url('admin/settings/password'); ?>">Password</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/settings/history'); ?>">Login history</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav flex-column">
                <li class="nav-item <?php echo ($this->uri->segment(2) == 'gallery') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#auth_drp">
                        <span class="feather-icon"><i data-feather="zap"></i></span>
                        <span class="nav-link-text">Site settings</span>
                    </a>
                    <ul id="auth_drp" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#locations">
                                        Locations
                                    </a>
                                    <ul id="locations" class="nav flex-column collapse collapse-level-2">
                                        <li class="nav-item">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?php echo site_url('admin/locations/districts'); ?>">Manage Districts</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?php echo site_url('admin/locations/pincodes'); ?>">Manage Pincodes</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#signup_drp">
                                        Main slider
                                    </a>
                                    <ul id="signup_drp" class="nav flex-column collapse collapse-level-2">
                                        <li class="nav-item">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?php echo site_url('admin/images/newslider'); ?>">Add new</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?php echo site_url('admin/images/slider'); ?>">Manage</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#signin_drp">
                                        Wide banners
                                    </a>
                                    <ul id="signin_drp" class="nav flex-column collapse collapse-level-2">
                                        <li class="nav-item">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?php echo site_url('admin/images/addwidebanner'); ?>">Add new</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="<?php echo site_url('admin/images/widebanner'); ?>">Manage</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/site/social'); ?>">Social media</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/site/smsNumbers'); ?>">SMS Numbers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/site/faq'); ?>">Manage FAQ(s)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/site/deliveryCharges'); ?>">Delivery Charges</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?php #echo site_url('admin/site/getBackup'); ?>">
                        <span class="feather-icon"><i data-feather="server"></i></span>
                        <span class="nav-link-text">Backup data</span>
                    </a>
                </li>
            </ul> -->
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('admin/dashboard/logout'); ?>">
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
            <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Home</a></li>
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