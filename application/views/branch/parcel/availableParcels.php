<section class="hk-sec-wrapper">
<h5 class="hk-sec-title">MANAGE AVAILABLE PARCELS</h5>
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <table id="datable_1" class="table table-hover w-200">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Passport image</th>
                        <th>License proof</th>
                        <th>Address</th>
                        <th>Joined date</th>
                        <th>Branch</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($DELIVERERS as $deliverer) {

                            $passportData = $this->Crud->Read('assets_deliverer', " `deliverer_id` = '$deliverer->id' AND `asset_type` = 'PASSPORT IMAGE'");

                            $passportImage = '';
                            foreach ($passportData as $passport) {
                                $passportImage = base_url().'uploads/deliverer/'.$passport->file_name;
                            }

                            $licenseData = $this->Crud->Read('assets_deliverer', " `deliverer_id` = '$deliverer->id' AND `asset_type` = 'LICENSE PROOF'");

                            $licenseImage = '';
                            foreach ($licenseData as $license) {
                                $licenseImage = base_url().'uploads/deliverer/'.$license->file_name;
                            }
                            $branchDetails = $this->Crud->Read('seller', " `id` = '$deliverer->branch_code'");
                            ?>
                                <tr>
                                    <td><?php echo $deliverer->id; ?></td>
                                    <td><?php echo $deliverer->name; ?></td>
                                    <td><?php echo $deliverer->email; ?></td>
                                    <td><?php echo $deliverer->phone; ?></td>

                                    <td><a data-toggle = "modal" class = "passportButton" style = "cursor: pointer;" data-target = "#viewPassport" data-link = "<?php echo $passportImage; ?>"><img src="<?php echo $passportImage; ?>" alt="" height = "50" width = "50"></a></td>

                                    <td><a data-toggle = "modal" class = "licenseButton" style = "cursor: pointer;" data-target = "#viewLicense" data-link = "<?php echo $licenseImage; ?>"><img src="<?php echo $licenseImage; ?>" alt="" height = "50" width = "50"></a></td>

                                    <td><?php echo $deliverer->address; ?></td>

                                    <td><?php echo $deliverer->added_date . ' - ' . $deliverer->added_time; ?></td>
                                    <td><?php echo $branchDetails[0]->name . ' - ' . $branchDetails[0]->phone; ?></td>
                                    <td><?php echo ($deliverer->is_active == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>'; ?></td>
                                    <td>
                                        <a href = "<?php echo site_url('branch/deliverer/edit/'.$deliverer->id); ?>" class = "btn btn-info btn-xs">Edit</a>

                                        <?php if ($deliverer->is_active == 1) { ?>
                                            <a href = "<?php echo site_url('branch/deliverer/changeStatus/deliverers/0/'.$deliverer->id); ?>" class = "btn btn-danger btn-xs">Inactive</a>
                                        <?php } else { ?>
                                            <a href = "<?php echo site_url('branch/deliverer/changeStatus/deliverers/1/'.$deliverer->id); ?>" class = "btn btn-success btn-xs">Active</a>
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

<div class="modal fade" id="viewPassport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PASSPORT IMAGE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="" id = "passportModalAnchor" target = "_BLANK"><img id = "passportModalImg" src="" alt="" style = "height: 100%; width: 100%;"></a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewLicense" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">LICENSE PROOF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="" id = "licenseModalAnchor" target = "_BLANK"><img id = "licenseModalImg" src="" alt="" style = "height: 100%; width: 100%;"></a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click touch', '.passportButton', function() {

        var link = $(this).data('link');

        $('#passportModalAnchor').attr('href', link);

        $('#passportModalImg').attr('src', link);

    });

    $(document).on('click touch', '.licenseButton', function() {

        var link = $(this).data('link');

        $('#licenseModalAnchor').attr('href', link);

        $('#licenseModalImg').attr('src', link);

    });
</script>