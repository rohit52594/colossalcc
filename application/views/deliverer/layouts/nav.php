
	<!-- Preloader -->
	<div class="preloader-it">
		<div class="loader-pendulums"></div>
	</div>
	<!-- /Preloader -->

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">
            <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand font-weight-700" href="<?php echo site_url('deliverer/dashboard'); ?>">
                <?php echo PROJECT_NAME; ?>
            </a>
            <ul class="navbar-nav hk-navbar-content">
                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar mr-10">
                                    <span class="avatar-text avatar-text-inv-primary rounded-circle"><span class="initial-wrap"><span><?php echo mb_substr($this->session->userdata('name'), 0, 1); ?></span></span>
                                    </span>
                                </div>
                                <!-- <span class="badge badge-success badge-indicator"></span> -->
                            </div>
                            <div class="media-body">
                                <span><?php echo $this->session->userdata('name'); ?><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <a class="dropdown-item" href="<?php echo base_url('deliverer/settings/profile/'); ?>"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a>
                        <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-settings"></i><span>Settings</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo site_url('deliverer/dashboard/logout'); ?>"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                    </div>
                </li>
            </ul>
        </nav>
        <form role="search" class="navbar-search">
            <div class="position-relative">
                <a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i data-feather="search"></i></span></a>
                <input type="text" name="example-input1-group2" class="form-control" placeholder="Type here to Search">
                <a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i data-feather="x"></i></span></a>
            </div>
        </form>
        <!-- /Top Navbar -->


            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('deliverer/dashboard'); ?>">Home</a></li>
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
                            <span class="alert-icon-wrap"><i class="zmdi zmdi-check-circle"></i></span> ' . $this->session->flashdata('success') .'
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