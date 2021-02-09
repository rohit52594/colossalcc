<?php

foreach ($DELIVERER_DETAILS as $deliverer) {

    $thisId = $deliverer->id;
    $name = $deliverer->name;
    $email = $deliverer->email;
    $phone = $deliverer->phone;
    $address = $deliverer->address;
}

$documentsPassport = $this->Crud->Read('assets_deliverer', " `deliverer_id` = '$thisId' AND `asset_type` = 'PASSPORT IMAGE'");
$passportImage = '';
$licenseImage = '';
foreach ($documentsPassport as $docPassport) {
    $passportImage = base_url() . 'uploads/deliverer/' . $docPassport->file_name;
}

$documentsLicense = $this->Crud->Read('assets_deliverer', " `deliverer_id` = '$thisId' AND `asset_type` = 'LICENSE PROOF'");

foreach ($documentsLicense as $docLicense) {
    $licenseImage = base_url() . 'uploads/deliverer/' . $docLicense->file_name;
}

?>
<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">EDIT DELIVERER: <?php echo strtoupper($name); ?></h5>
    <!-- <p class="mb-25">Place an icon inside add-on on either side of an input. You may also place one on right side of an input.</p> -->
    <div class="row">
        <div class="col-sm">
            <form autocomplete="off" action="<?php echo site_url('branch/deliverer/editDeliverer/' . $this->uri->segment(4)); ?>" method="post" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" value="<?php echo $address; ?>" name="address" id="address" placeholder="Enter deliverer address" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label mb-10" for="confirmPassword">Passport image</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-arrow-up-circle"></i></span>
                        </div>
                        <input type="file" name="passportImage" accept="images/*" class="form-control" id="passportImage">
                    </div>
                    <br /><img src="<?php echo $passportImage; ?>" id="showImagePassport" alt="" height="100" width="150">
                </div>


                <div class="form-group">
                    <label class="control-label mb-10" for="confirmPassword">License proof</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-arrow-up-circle"></i></span>
                        </div>
                        <input type="file" name="licenseImage" accept="images/*" class="form-control" id="licenseImage">
                    </div>
                    <br /><img src="<?php echo $licenseImage; ?>" id="showImageLicense" alt="" height="100" width="150">
                </div>

                <h5>Account Details: </h5>
                <div class="form-group">
                    <label class="control-label mb-10" for="exampleInputuname_1">Bank Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-user"></i></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $DELIVERER_DETAILS[0]->bank_name; ?>" name="bank_name" id="exampleInputuname_1" placeholder="Bank name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label mb-10" for="exampleInputuname_1">Account Number</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-user"></i></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $DELIVERER_DETAILS[0]->account_number; ?>" name="account_number" id="exampleInputuname_1" placeholder="Account Number" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label mb-10" for="exampleInputuname_1">IFSC</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-user"></i></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $DELIVERER_DETAILS[0]->ifsc; ?>" name="ifsc" id="exampleInputuname_1" placeholder="ifsc" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label mb-10" for="exampleInputuname_1">Bank Branch Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-user"></i></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $DELIVERER_DETAILS[0]->branch; ?>" name="branch" id="exampleInputuname_1" placeholder="Branch Name" required>
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

    var imgObj = document.getElementById('passportImage');

    imgObj.onchange = showImage;

    function showImage() {

        var tmppath = URL.createObjectURL(event.target.files[0]);

        $("#showImagePassport").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));

    }

    var imgObj = document.getElementById('licenseImage');

    imgObj.onchange = showImageLicense;

    function showImageLicense() {

        var tmppath = URL.createObjectURL(event.target.files[0]);

        $("#showImageLicense").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));

    }
</script>