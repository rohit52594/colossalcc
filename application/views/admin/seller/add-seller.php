<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">ADD NEW BRANCH</h5>
    <!-- <p class="mb-25">Place an icon inside add-on on either side of an input. You may also place one on right side of an input.</p> -->
    <div class="row">
        <div class="col-sm">
            <form autocomplete="off" action="<?php echo site_url('admin/branch/addBranch'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label mb-10" for="exampleInputuname_1">Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="name" id="exampleInputuname_1" placeholder="Full name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label mb-10" for="exampleInputEmail_1">Email address</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-envelope-open"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail_1" placeholder="Enter email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label mb-10" for="phone">Contact</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-envelope-open"></i></span>
                        </div>
                        <input type="text" class="form-control" name="phone" maxlength="10" pattern="[6789][0-9]{9}" id="phone" placeholder="Enter contact number">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label mb-10" for="password">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label mb-10" for="confirmPassword">Confirm Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" onchange="checkPassword(this.value, this);" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label mb-10" for="address">Address</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-location-pin"></i></span>
                        </div>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter branch location" required>
                    </div>
                </div>



                <div class="form-group">
                    <label class="control-label mb-10" for="state">State</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-location-pin"></i></span>
                        </div>
                        <input type="text" class="form-control" name="state" id="state" placeholder="Enter Branch State" required>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label mb-10" for="city">City</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-location-pin"></i></span>
                        </div>
                        <input type="text" class="form-control" name="city" id="city" placeholder="Enter Branch City" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label mb-10" for="pin">Pincode</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-location-pin"></i></span>
                        </div>
                        <input type="text" class="form-control" name="pin" id="pin" placeholder="Enter Branch Pincode" pattern="[0-9]{6}" maxlength="6" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label mb-10" for="po">P.O. /P.S.</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-location-pin"></i></span>
                        </div>
                        <input type="text" class="form-control" name="po" id="po" placeholder="Enter P.O. / P.S." required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label mb-10" for="district">District</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-location-pin"></i></span>
                        </div>
                        <input type="text" class="form-control" name="district" id="district" placeholder="Enter District" required>
                    </div>
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary mr-10">Save &amp; Proceed</button>
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