<?php

foreach ($SELLER_DETAILS as $seller) {

    $thisId = $seller->id;
    $name = $seller->name;
    $email = $seller->email;
    $phone = $seller->phone;
    $address = $seller->address;
}

?>
<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">EDIT SELLER: <?php echo strtoupper($name); ?></h5>
    <!-- <p class="mb-25">Place an icon inside add-on on either side of an input. You may also place one on right side of an input.</p> -->
    <div class="row">
        <div class="col-sm">
            <form autocomplete="off" action="<?php echo site_url('admin/seller/editSeller/' . $this->uri->segment(4)); ?>" method="post" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" value="<?php echo $address; ?>" name="address" id="address" placeholder="Enter seller address" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label mb-10" for="district">District</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-location-pin"></i></span>
                        </div>
                        <select name="district" id="district" class="form-control" required onchange="getPincodes(this, this.value)">
                            <option value="" selected disabled>--select district--</option>
                            <?php foreach ($DISTRICTS as $key) { ?>
                                <option <?php echo $key->district == $SELLER_DETAILS[0]->district ? 'selected' : ''; ?> value="<?php echo $key->district; ?>"><?php echo $key->district; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label mb-10" for="pincode">Pincode</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-location-pin"></i></span>
                        </div>
                        <div id="pincodesDiv">
                            <select class="form-control" name="pincode" id="pincode" required>
                                <?php foreach ($PINCODES as $key) { ?>
                                    <option <?php echo $key->pincode == $SELLER_DETAILS[0]->pincode ? 'selected' : ''; ?> value="<?php echo $key->pincode; ?>"><?php echo $key->pincode; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label mb-10" for="types">Types</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-location-pin"></i></span>
                        </div>
                        <select name="types" id="types" class="form-control" required>
                            <option value="" selected disabled>--select types--</option>
                            <?php foreach ($TYPES as $key) { ?>
                                <option <?php echo $key->types == $SELLER_DETAILS[0]->types ? 'selected' : ''; ?> value="<?php echo $key->types; ?>"><?php echo $key->types; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label mb-10" for="coverImage">Cover Image</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-arrow-up-circle"></i></span>
                        </div>
                        <input type="file" name="coverImage" accept="images/*" class="form-control" id="coverImage">
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

    function getPincodes(elem, val) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url("getPincodes"); ?>',
            dataType: 'text',
            data: {
                'district_id': val
            },
            success: function(data) {
                $('#pincodesDiv').html(data)
            }
        });
    }
</script>