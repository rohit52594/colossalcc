<?php

foreach ($BRANCH_DETAILS as $branch) {

    $thisId = $branch->id;
    $name = $branch->name;
    $email = $branch->email;
    $phone = $branch->phone;
    $address = $branch->address;
}

?>
<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">EDIT BRANCH: <?php echo strtoupper($name); ?></h5>
    <!-- <p class="mb-25">Place an icon inside add-on on either side of an input. You may also place one on right side of an input.</p> -->
    <div class="row">
        <div class="col-sm">
            <form autocomplete="off" action="<?php echo site_url('admin/branch/editBranch/' . $this->uri->segment(4)); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="thisId" value="<?php echo $thisId; ?>">
                <div class="form-group">
                    <label class="control-label mb-10" for="exampleInputuname_1">Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="name" id="exampleInputuname_1" value="<?php echo $name; ?>" placeholder="Full name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label mb-10" for="exampleInputEmail_1">Email address</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-envelope-open"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail_1" value="<?php echo $email; ?>" placeholder="Enter email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label mb-10" for="phone">Contact</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-envelope-open"></i></span>
                        </div>
                        <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" maxlength="10" pattern="[6789][0-9]{9}" id="phone" placeholder="Enter contact number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label mb-10" for="address">Address</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-location-pin"></i></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $address; ?>" name="address" id="address" placeholder="Enter branch address" required>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary mr-10">Save Changes</button>
                <button type="reset" class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</section>
<script>
    function checkPassword(val, elem) {
        if (val == $('#password').val()) {
            return true;
        } else {
            $(elem).val('');
            alert('Passwords not matching');
            $(elem).focus();
        }
    }
</script>