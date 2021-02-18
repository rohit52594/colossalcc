<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title"><?= $TITLE; ?></h5>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <table id="datable_1" class="table table-hover w-200">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tracking Id</th>
                            <th>Parcel Amount</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($PARCELS as $key) {
                            $i = 0;
                        ?>
                            <tr>
                                <td><?php echo ++$i; ?></td>
                                <td><a href="#detailsModal" data-toggle="modal" class="openDetails" data-tracking="#<?php echo $key->tracking_id; ?>" data-sender='<?php echo "<i>Name:</i> " . $key->sender_name . "<br /><strong>Phone:</strong> " . $key->sender_phone . "<br /><strong>Alternate Phone:</strong> " . $key->sender_alt_phone . "<br /><strong>City:</strong> " . $key->sender_city . "<br /><strong>State:</strong> " . $key->sender_state . "<br /><strong>Pincode:</strong> " . $key->sender_pincode . "<br /><strong>Full Address:</strong> " . $key->sender_address; ?>' data-receiver='<?php echo "<i>Name:</i> " . $key->receiver_name . "<br /><strong>Phone:</strong> " . $key->receiver_phone . "<br /><strong>Alternate Phone:</strong> " . $key->receiver_alt_phone . "<br /><strong>City:</strong> " . $key->receiver_city . "<br /><strong>State:</strong> " . $key->receiver_state . "<br /><strong>Pincode:</strong> " . $key->receiver_pincode . "<br /><strong>Full Address:</strong> " . $key->receiver_address; ?>' data-parcel='<?php echo "<strong>Parcel Weight:</strong> " . $key->parcel_weight . "<br /><strong>Parcel Height:</strong> " . $key->parcel_height . "<br /><strong>Parcel Width:</strong> " . $key->parcel_width . "<br /><strong>Parcel Length:</strong> " . $key->parcel_length; ?>'>#<?php echo $key->tracking_id; ?></a></td>

                                <td>&#8377;<?php echo $key->parcel_price; ?> - <?php echo $key->parcel_is_paid == 0 ? "<span class='badge badge-danger'>Not Paid</span>" : "<span class='badge badge-success'>Paid</span>"; ?></td>

                                <td><?php echo date('Y-m-d H:i:s', $key->parcel_receive_time); ?></td>
                                <td><a class="btn btn-info btn-xs">Track</a>&ensp;<a data-toggle="modal" data-target="#dispatchModal" data-tracking="<?php echo $key->tracking_id; ?>" class="btn btn-success btn-xs dispatch">Dispatch</a>&ensp;
                                    <?php if ($key->current_branch == $key->destination_branch && $key->parcel_delivery_attempt < 4) { ?>
                                        <a data-toggle="modal" data-target="#deliverModal" data-tracking="<?php echo $key->tracking_id; ?>" class="btn btn-warning btn-xs deliver">Deliver
                                        <?php if ($key->parcel_delivery_attempt > 0) { ?>
                                            &ensp;<span class="badge badge-danger"><?php echo $key->parcel_delivery_attempt; ?> failed attempts</span>
                                        <?php } ?>
                                    </a>
                                    <?php } ?>
                                    <?php if ($key->parcel_delivery_attempt == 3) { ?>
                                        &ensp;<br /><br /><a class="btn btn-danger" data-toggle="modal" data-target="#dispatchModal" data-tracking="<?php echo $key->tracking_id; ?>" class="btn btn-success btn-xs dispatch"><?php echo $key->parcel_delivery_attempt; ?> failed attempts, please return this parcel</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Details for Tracking ID: <span id="showTrackingId">loading...</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <center>Sender Details</center>
                    </div>
                    <div class="col-sm-4">
                        <center>Receiver Details</center>
                    </div>
                    <div class="col-sm-4">
                        <center>Parcel Details</center>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4"><span id="showSender"></span></div>
                    <div class="col-sm-4"><span id="showReceiver"></span></div>
                    <div class="col-sm-4"><span id="showParcel"></span></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="dispatchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dispatch to other Branch of Tracking ID: <span id="showTrackingIdDispatch">loading...</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/parcel/assignParcelToBranch/'); ?>" method="post">
                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <label for="">Choose Branch</label>
                            <input type="hidden" id="dispatchTrackingId" name="trackingId">
                            <select name="branch" id="branch" class="form-control" required onchange="checkDispatch(this, this.form)">
                                <option value="">--select branch--</option>
                                <?php foreach ($BRANCHES as $key) { ?>
                                    <option value="<?php echo $key->id; ?>"><?php echo $key->name . " (" . $key->city . " - " . $key->district . ", " . $key->pin . ")"; ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-muted">Choose the next branch of this parcel</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deliverModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dispatch to other Branch of Tracking ID: <span id="showTrackingIdDispatch">loading...</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('admin/parcel/outForDelivery'); ?>" method="post">
                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <label for="">Choose Deliverer</label>
                            <input type="hidden" id="DeliverTrackingId" name="trackingId">
                            <select name="deliverer" id="deliverer" class="form-control" required onchange="checkDeliver(this, this.form)">
                                <option value="">--select deliverer--</option>
                                <?php foreach ($DELIVERER as $key) { ?>
                                    <option value="<?php echo $key->id; ?>"><?php echo $key->name . " (" . $key->address . ")"; ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-muted">Choose a deliverer who is going to deliver this parcel to receiver</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click touch', '.openDetails', function() {
        $('#showTrackingId').html($(this).data('tracking'))
        $('#showSender').html($(this).data('sender'))
        $('#showReceiver').html($(this).data('receiver'))
        $('#showParcel').html($(this).data('parcel'))
    });

    $(document).on('click touch', '.dispatch', function() {
        $('#dispatchTrackingId').val($(this).data('tracking'))
    })

    $(document).on('click touch', '.deliver', function() {
        $('#DeliverTrackingId').val($(this).data('tracking'))
    })

    function checkDeliver(elem, form) {
        if (confirm('Are you sure want to assign this deliverer to deliver this parcel to the receiver?')) {
            form.submit()
        } else {
            $(elem).val('').clear()
            return false
        }
    }

    function checkDispatch(elem, form) {
        if (confirm('Are you sure want to move this parcel to other branch?')) {
            form.submit()
        } else {
            $(elem).val('').clear()
            return false
        }
    }
</script>