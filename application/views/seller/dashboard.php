<!-- Row -->
<div class="row">
	<div class="col-xl-12">
		<div class="hk-row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card card-sm">
					<div class="card-body">
						<div class="card">
							<div class="header m-2">
								<h6>MY AVAILABILITY</h6>
							</div>
							<div class="body my-3">
								<?php if ($IS_AVAILABLE == 1) { ?>
									<center>
										<a onclick="return confirm('Are you sure want to go offline?')" href="<?php echo site_url('seller/dashboard/onlineOffline/seller/0/'); ?>" class="btn btn-danger text-white fw-200">GO OFFLINE</a>
										<br />
										<br />
										<span>If you go offline, all your products will be hidden from website until you turn your account online</span>
									</center>
								<?php } else { ?>
									<center>
										<a onclick="return confirm('Good to see you online back... Confirm?')" href="<?php echo site_url('seller/dashboard/onlineOffline/seller/1/'); ?>" class="btn btn-success text-white fw-200">GO ONLINE</a>
										<br />
										<br />
										<span>You're offline! Click online to make your products visible on website.</span>
									</center>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card card-sm">
					<div class="card-body">
						<div class="card">
							<div class="header m-2">
								<h6>SALES GRAPH FOR THIS YEAR</h6>
							</div>
							<div class="body mt-3">
								<canvas id="bar_chart" height="100" style="display: none;"></canvas>
								<canvas id="line_chart" height="100"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12">

				<div class="hk-row">
					<div class="col-sm-6">
						<div class="card card-sm">
							<div class="card-body">
								<div class="d-flex justify-content-between mb-5">
									<div>
										<span class="d-block font-15 text-dark font-weight-500">Users</span>
									</div>
									<div>
										<span class="badge badge-success  badge-sm">+<?php echo $ACTIVE_USERS_COUNT_TODAY; ?> today</span>
									</div>
								</div>
								<div>
									<span class="d-block display-5 text-dark mb-5"><?php echo $USERS_COUNT; ?></span>
									<small class="d-block"><?php echo $ACTIVE_USERS_COUNT; ?> Active</small>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card card-sm">
							<div class="card-body">
								<div class="d-flex justify-content-between mb-5">
									<div>
										<span class="d-block font-15 text-dark font-weight-500">Products</span>
									</div>
									<div>
										<span class="badge badge-success badge-sm">+<?php echo $ACTIVE_PRODUCTS_COUNT_TODAY; ?> today</span>
									</div>
								</div>
								<div>
									<span class="d-block display-5 text-dark mb-5"><?php echo $PRODUCTS_COUNT; ?></span>
									<small class="d-block"><?php echo $FEATURED_PRODUCTS; ?> featured</small>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card card-sm">
							<div class="card-body">
								<div class="d-flex justify-content-between mb-5">
									<div>
										<span class="d-block font-15 text-dark font-weight-500">Successful deliveries</span>
									</div>
									<div>
										<span class="badge badge-primary  badge-sm">+<?php echo $SUCCESSFUL_DELIVERIES_TODAY; ?></span>
									</div>
								</div>
								<div>
									<span class="d-block display-5 text-dark mb-5"><?php echo $SUCCESSFUL_DELIVERIES; ?></span>
									<small class="d-block"><?php echo $AWAITING_DELIVERIES; ?> awaiting</small>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card card-sm">
							<div class="card-body">
								<div class="d-flex justify-content-between mb-5">
									<div>
										<span class="d-block font-15 text-dark font-weight-500">Earnings</span>
									</div>
									<div>
										<span class="badge badge-warning  badge-sm">+&#8377;<?php echo $EARNED_TODAY; ?></span>
									</div>
								</div>
								<div>
									<span class="d-block display-5 text-dark mb-5">&#8377;<?php echo $EARNED; ?></span>
									<small class="d-block">&#8377;<?php echo $EXTRA_CHARGES; ?> extra charges included</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url() . "assets/chart/Chart.bundle.js"; ?>"></script>
<script>
	$(window).on('load', function() {
		//  if ($.cookie('pop') == null) {
		$('#myModal').modal('show');
		new Chart(document.getElementById("line_chart").getContext("2d"), getLineChart());
		//  $.cookie('pop', '1');
		//  }
	});

	function getLineChart() {
		const sales = <?= json_encode($sales, JSON_NUMERIC_CHECK) ?>;
		const cancelled = <?= json_encode($cancelled, JSON_NUMERIC_CHECK) ?>;
		config = {
			type: 'line',
			data: {
				labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				datasets: [{
					label: "Sales",
					data: sales,
					borderColor: 'rgba(0, 188, 212, 0.75)',
					backgroundColor: 'rgba(0, 188, 212, 0.3)',
					pointBorderColor: 'rgba(0, 188, 212, 0)',
					pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
					pointBorderWidth: 1
				}, {
					label: "Cancelled",
					data: cancelled,
					borderColor: 'rgba(233, 30, 99, 0.75)',
					backgroundColor: 'rgba(233, 30, 99, 0.3)',
					pointBorderColor: 'rgba(233, 30, 99, 0)',
					pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',
					pointBorderWidth: 1
				}]
			},
			options: {
				responsive: true,
				legend: false
			}
		}

		return config;

	}
</script>