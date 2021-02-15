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

            <hr class="nav-separator">
            <ul class="navbar-nav flex-column">

                <li class="nav-item <?php echo ($this->uri->segment(2) == 'branch') ? 'active' : ''; ?>">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#branchUI">
                        <span class="feather-icon"><i data-feather="truck"></i></span>
                        <span class="nav-link-text">Branch</span>
                    </a>
                    <ul id="branchUI" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/branch/new'); ?>">Add new Branch</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('admin/branch/view'); ?>">View Branches</a>
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
                    <a class="nav-link" href="tel:+919999999999">
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