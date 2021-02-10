<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">ADD NEW PARCEL</h5>
    <form autocomplete="off" class="needs-validation" novalidate action="" method="post" enctype="multipart/form-data">
        <div class="mt-3">
            <h6 class="text-muted">Sender details</h6>
        </div>
        <div class="row mt-3">
            <div class="col-sm-3">
                <label class="control-label mb-10" for="sender_name">Sender Name</label>
                <input type="text" class="form-control" name="sender_name" id="sender_name" placeholder="Sender Name" required>
                <div class="invalid-feedback">
                    This field is required.
                </div>
            </div>
            <div class="col-sm-3">
                <label class="control-label mb-10" for="sender_address">Sender Address</label>
                <input type="text" class="form-control" name="sender_address" id="sender_address" placeholder="Sender Address" required>
                <div class="invalid-feedback">
                    This field is required.
                </div>
            </div>

            <div class="col-sm-3">
                <label class="control-label mb-10" for="sender_state">Sender State</label>
                <input type="text" class="form-control" name="sender_state" id="sender_state" placeholder="Sender State" required>
                <div class="invalid-feedback">
                    This field is required.
                </div>
            </div>

            <div class="col-sm-3">
                <label class="control-label mb-10" for="sender_city">Sender City</label>
                <input type="text" class="form-control" name="sender_city" id="sender_city" placeholder="Sender City" required>
                <div class="invalid-feedback">
                    This field is required.
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-3">
                <label class="control-label mb-10" for="sender_phone">Sender Phone</label>
                <input type="text" class="form-control" name="sender_phone" id="sender_phone" placeholder="Sender Phone" required pattern="[6789]{1}[0-9]{9}">
                <div class="invalid-feedback">
                    Please enter a valid phone number.
                </div>
            </div>

            <div class="col-sm-3">
                <label class="control-label mb-10" for="sender_alt_phone">Sender alternate phone</label>
                <input type="text" class="form-control" name="sender_alt_phone" id="sender_alt_phone" placeholder="Sender alternate phone" pattern="[6789]{1}[0-9]{9}">
                <div class="invalid-feedback">
                    Please enter a valid phone number.
                </div>
            </div>

            <div class="col-sm-3">
                <label class="control-label mb-10" for="sender_pincode">Sender Pincode</label>
                <input type="text" class="form-control" name="sender_pincode" pattern="[0-9]{6}" maxlength="6" id="sender_pincode" placeholder="Sender Pincode" required>
                <div class="invalid-feedback">
                    Please enter a valid phone pincode.
                </div>
            </div>
        </div>


        <div class="mt-3">
            <h6 class="text-muted">Receiver details</h6>
        </div>
        <div class="row mt-3">
            <div class="col-sm-3">
                <label class="control-label mb-10" for="receiver_name">Receiver Name</label>
                <input type="text" class="form-control" name="receiver_name" id="receiver_name" placeholder="Receiver Name" required>
                <div class="invalid-feedback">
                    This field is required.
                </div>
            </div>
            <div class="col-sm-3">
                <label class="control-label mb-10" for="receiver_address">Receiver Address</label>
                <input type="text" class="form-control" name="receiver_address" id="receiver_address" placeholder="Receiver Address" required>
                <div class="invalid-feedback">
                    This field is required.
                </div>
            </div>

            <div class="col-sm-3">
                <label class="control-label mb-10" for="receiver_state">Receiver State</label>
                <input type="text" class="form-control" name="receiver_state" id="receiver_state" placeholder="Receiver State" required>
                <div class="invalid-feedback">
                    This field is required.
                </div>
            </div>

            <div class="col-sm-3">
                <label class="control-label mb-10" for="receiver_city">Receiver City</label>
                <input type="text" class="form-control" name="receiver_city" id="receiver_city" placeholder="Receiver City" required>
                <div class="invalid-feedback">
                    This field is required.
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-3">
                <label class="control-label mb-10" for="receiver_phone">Receiver Phone</label>
                <input type="text" class="form-control" name="receiver_phone" id="receiver_phone" placeholder="Receiver Phone" required pattern="[6789]{1}[0-9]{9}">
                <div class="invalid-feedback">
                    Please enter a valid phone number.
                </div>
            </div>

            <div class="col-sm-3">
                <label class="control-label mb-10" for="receiver_alt_phone">Receiver alternate phone</label>
                <input type="text" class="form-control" name="receiver_alt_phone" id="receiver_alt_phone" placeholder="Receiver alternate phone" pattern="[6789]{1}[0-9]{9}">
                <div class="invalid-feedback">
                    Please enter a valid phone number.
                </div>
            </div>

            <div class="col-sm-3">
                <label class="control-label mb-10" for="receiver_pincode">Receiver Pincode</label>
                <input type="text" class="form-control" name="receiver_pincode" pattern="[0-9]{6}" maxlength="6" id="receiver_pincode" placeholder="Receiver Pincode" required>
                <div class="invalid-feedback">
                    Please enter a valid phone pincode.
                </div>
            </div>
        </div>

        <div class="mt-3">
            <h6 class="text-muted">Parcel details</h6>
        </div>
        <div class="row mt-3">
            <div class="col-sm-3">
                <label class="control-label mb-10" for="parcel_weight">Parcel Weight (in grams)</label>
                <input type="number" class="form-control" name="parcel_weight" id="parcel_weight" placeholder="Parcel Weight" required>
                <div class="invalid-feedback">
                    Please enter a valid weight.
                </div>
            </div>
            <div class="col-sm-3">
                <label class="control-label mb-10" for="parcel_height">Parcel Height</label>
                <input type="number" class="form-control" name="parcel_height" id="parcel_height" placeholder="Parcel Height" required>
                <div class="invalid-feedback">
                    Please enter a valid height.
                </div>
            </div>

            <div class="col-sm-3">
                <label class="control-label mb-10" for="parcel_width">Parcel Width</label>
                <input type="number" class="form-control" name="parcel_width" id="parcel_width" placeholder="Parcel Width" required>
                <div class="invalid-feedback">
                    Please enter a valid width.
                </div>
            </div>

            <div class="col-sm-3">
                <label class="control-label mb-10" for="parcel_price">Parcel Price</label>
                <input type="number" class="form-control" name="parcel_price" id="parcel_price" placeholder="Parcel Price" required>
                <div class="invalid-feedback">
                    Please enter a valid price.
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-3">
                <label class="control-label mb-10" for="parcel_length">Parcel Length</label>
                <input type="number" class="form-control" name="parcel_length" id="parcel_length" placeholder="Parcel Length" required>
                <div class="invalid-feedback">
                    Please enter a valid length.
                </div>
            </div>
            <div class="col-sm-3">
                <label class="control-label mb-10" for="parcel_is_paid">Payment Status</label>
                <select name="parcel_is_paid" id="parcel_is_paid" class="form-control" required>
                    <option value="" selected disabled>--select payment status--</option>
                    <option value="0">Unpaid</option>
                    <option value="1">Paid</option>
                </select>
                <div class="invalid-feedback">
                    This field is required.
                </div>
            </div>

            <div class="col-sm-3">
                <label class="control-label mb-10" for="destination_branch">Destination Branch</label>
                <select name="destination_branch" id="destination_branch" class="form-control" required>
                    <option value="" selected disabled>--select destination branch--</option>
                    <?php
                    foreach ($BRANCHES as $key) { ?>
                        <option value="<?php echo $key->id; ?>"><?php echo $key->name . " (" . $key->city . " - " . $key->district . ", " . $key->pin . ")"; ?></option>
                    <?php } ?>
                </select>
                <div class="invalid-feedback">
                    This field is required.
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-3">
                <button type="submit" name="submit" class="btn btn-primary mr-10">Save &amp; Proceed</button>
                <button type="reset" class="btn btn-light">Cancel</button>
            </div>
        </div>
    </form>
</section>
<script>
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>