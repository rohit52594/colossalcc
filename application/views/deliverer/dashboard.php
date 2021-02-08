<div class="row">
    <div class="col-xl-12">
        <div class="hk-row">
            <div class="col-lg-12">
                <div class="hk-row">
                    <div class="col-sm-6">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-5">
                                    <div>
                                        <span class="d-block font-15 text-dark font-weight-500">New orders</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="d-block display-5 text-dark mb-5"><?php echo $NEW_ORDERS; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-5">
                                    <div>
                                        <span class="d-block font-15 text-dark font-weight-500">Pending deliveries</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="d-block display-5 text-dark mb-5"><?php echo $PENDING_DELIVERIES; ?></span>
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
                                </div>
                                <div>
                                    <span class="d-block display-5 text-dark mb-5"><?php echo $SUCCESSFUL_DELIVERIES; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-5">
                                    <div>
                                        <span class="d-block font-15 text-dark font-weight-500">Rejected deliveries</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="d-block display-5 text-dark mb-5"><?php echo $REJECTED_DELIVERIES; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-header-action">
                        <h6>ONGOING DELIVERIES</h6>
                        <div class="d-flex align-items-center card-action-wrap">
                            <a href="#" class="inline-block full-screen">
                                <i class="ion ion-md-expand"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body pa-0">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Tracking id</th>
                                            <th>Alternate number</th>
                                            <th>Total Items</th>
                                            <th>Grand total</th>
                                            <th>Ordered date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($ONGOING_ORDERS as $order) {

                                        ?>
                                                    <tr>
                                                        <td>#<?php echo $order->tracking_id; ?></td>
                                                        <td><?php echo ($order->alternate_number != '') ? $order->alternate_number : ' - '; ?></td>
                                                        <td><?php echo $order->total_items; ?> items</td>
                                                        <td>&#8377;<?php echo $order->grand_total; ?></td>
                                                        <td><?php echo $order->ordered_date.' - '.$order->ordered_time; ?></td>
                                                        <td>&#8377;<?php echo $order->grand_total; ?></td>
                                                        <td><a href="<?php echo site_url('deliverer/orders/ongoing'); ?>" class = "btn btn-xs btn-success">More >></a></td>
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>