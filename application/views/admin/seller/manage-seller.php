<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">MANAGE BRANCHES</h5>
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
                            <th>Address</th>
                            <th>Joined date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($BRANCHES as $branch) {
                        ?>
                            <tr>
                                <td><?php echo $branch->id; ?></td>
                                <td><?php echo $branch->name; ?></td>
                                <td><?php echo $branch->email; ?></td>
                                <td><?php echo $branch->phone; ?></td>
                                <td><?php echo $branch->address; ?></td>
                                
                                <td><?php echo $branch->added_date . ' - ' . $branch->added_time; ?></td>
                                <td><?php echo ($branch->is_active == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>'; ?></td>
                                <td>
                                    <a href="<?php echo site_url('admin/branch/edit/' . $branch->id); ?>" class="btn btn-info btn-xs">Edit</a>

                                    <?php if ($branch->is_active == 1) { ?>
                                        <a href="<?php echo site_url('admin/branch/changeStatus/seller/0/' . $branch->id); ?>" class="btn btn-danger btn-xs">Inactive</a>
                                    <?php } else { ?>
                                        <a href="<?php echo site_url('admin/branch/changeStatus/seller/1/' . $branch->id); ?>" class="btn btn-success btn-xs">Active</a>
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