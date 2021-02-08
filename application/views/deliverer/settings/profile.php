<?php

    foreach ($PROFILE_DETAILS as $deliverer) {

        $thisId = $deliverer->id;
        $name = $deliverer->name;
        $email = $deliverer->email;
        $phone = $deliverer->phone;
        $address = $deliverer->address;
        $joinedDate = $deliverer->added_date;

    }

    $documentsPassport = $this->Crud->Read('assets_deliverer', " `deliverer_id` = '$thisId' AND `asset_type` = 'PASSPORT IMAGE'");

    foreach ($documentsPassport as $docPassport) {
        $passportImage = base_url().'uploads/deliverer/'.$docPassport->file_name;
    }

    $documentsLicense = $this->Crud->Read('assets_deliverer', " `deliverer_id` = '$thisId' AND `asset_type` = 'LICENSE PROOF'");

    foreach ($documentsLicense as $docLicense) {
        $licenseImage = base_url().'uploads/deliverer/'.$docLicense->file_name;
    }

    ?>

<div class="container-fluid">
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12 pa-0">
                        <div class="profile-cover-wrap overlay-wrap">
                            <div class="profile-cover-img" style="background-image:url('<?php echo base_url().'assets/'; ?>dist/img/profile/cover.jpg')"></div>
							<div class="bg-overlay bg-trans-dark-60"></div>
							<div class="container profile-cover-content py-50">
								<div class="hk-row"> 
									<div class="col-lg-6">
										<div class="media align-items-center">
											<div class="media-img-wrap  d-flex">
                                                <div class="avatar">
                                                    <span class="avatar-text avatar-text-inv-primary rounded-circle"><span class="initial-wrap"><span><?php echo mb_substr($this->session->userdata('name'), 0, 1); ?></span></span>
                                                    </span>
                                                </div>
											</div>
											<div class="media-body">
												<div class="text-white text-capitalize display-6 mb-5 font-weight-400"><?php echo strtoupper($this->session->userdata('name')); ?></div>
												<!-- <div class="font-14 text-white"><span class="mr-5"><span class="font-weight-500 pr-5">124</span><span class="mr-5">Followers</span></span><span><span class="font-weight-500 pr-5">45</span><span>Following</span></span></div> -->
											</div>
										</div>
									</div>
									<!-- <div class="col-lg-6">
										<div class="button-list">
											<a href="#" class="btn btn-dark btn-wth-icon icon-wthot-bg btn-rounded"><span class="btn-text">Message</span><span class="icon-label"><i class="icon ion-md-mail"></i> </span></a>
											<a href="#" class="btn btn-icon btn-icon-circle btn-indigo btn-icon-style-2"><span class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
											<a href="#" class="btn btn-icon btn-icon-circle btn-sky btn-icon-style-2"><span class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
											<a href="#" class="btn btn-icon btn-icon-circle btn-purple btn-icon-style-2"><span class="btn-icon-wrap"><i class="fa fa-instagram"></i></span></a>
										</div>
									</div> -->
								</div>
							</div>
						</div>
                        <div class="bg-white shadow-bottom">
							<div class="container">
								<ul class="nav nav-light nav-tabs" role="tablist">
									<li class="nav-item">
										<a style = "cursor: pointer;" class="d-flex h-60p align-items-center nav-link active">Profile</a>
									</li>
								</ul>
							</div>	
						</div>	
						<div class="tab-content mt-sm-60 mt-30">
							<div class="tab-pane fade show active" role="tabpanel">
								<div class="container">
									<div class="hk-row">
										<div class="col-lg-4">
											<div class="card card-profile-feed">
                                                <div class="card-header card-header-action">
													<div class="media align-items-center">
														<div class="media-img-wrap d-flex mr-10">
															<div class="avatar avatar-sm">
                                                                <span class="avatar-text avatar-text-inv-primary rounded-circle"><span class="initial-wrap"><span><?php echo mb_substr($this->session->userdata('name'), 0, 1); ?></span></span>
															</div>
														</div>
														<div class="media-body">
															<div class="text-capitalize font-weight-500 text-dark"><?php echo $this->session->userdata('name'); ?></div>
															<div class="font-13">Deliverer</div>
														</div>
													</div>
												</div>
												<!-- <div class="row text-center">
													<div class="col-4 border-right pr-0">
														<div class="pa-15">
															<span class="d-block display-6 text-dark mb-5">154</span>
															<span class="d-block text-capitalize font-14">photos</span>
														</div>
													</div>
													<div class="col-4 border-right px-0">
														<div class="pa-15">
															<span class="d-block display-6 text-dark mb-5">65</span>
															<span class="d-block text-capitalize font-14">followers</span>
														</div>
													</div>
													<div class="col-4 pl-0">
														<div class="pa-15">
															<span class="d-block display-6 text-dark mb-5">433</span>
															<span class="d-block text-capitalize font-14">views</span>
														</div>
													</div>
												</div> -->
												<ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><span><i class="ion ion-md-mail font-18 text-light-20 mr-10"></i><span>Email:</span></span><span class="ml-5 text-dark"><?php echo $email; ?></span></li>
                                                    <li class="list-group-item"><span><i class="ion ion-md-call font-18 text-light-20 mr-10"></i><span>Phone:</span></span><span class="ml-5 text-dark"><?php echo $phone; ?></span></li>
                                                    <li class="list-group-item"><span><i class="ion ion-md-home font-18 text-light-20 mr-10"></i><span>Address:</span></span><span class="ml-5 text-dark"><?php echo $address; ?></span></li>
                                                    <li class="list-group-item"><span><i class="ion ion-md-add font-18 text-light-20 mr-10"></i><span>Joined date:</span></span><span class="ml-5 text-dark"><?php echo $joinedDate; ?></span></li>
                                                </ul>
											 </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="card card-profile-feed">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <div style = "padding: 1em;" class="text-capitalize font-weight-500 text-dark">Passport image</div>
                                                    </div>
                                                </div>
                                                <img src="<?php echo $passportImage; ?>" alt="Passport image">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="card card-profile-feed">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <div style = "padding: 1em;" class="text-capitalize font-weight-500 text-dark">License proof</div>
                                                    </div>
                                                </div>
                                                <img src="<?php echo $licenseImage; ?>" alt="Passport image">
                                            </div>
                                        </div>
									</div>
								</div>
							</div>
						</div>	
					</div>
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->