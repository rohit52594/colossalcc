<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">CHOOSE DELIVERER</h5>
    <div class="row">
        <div class="col-sm">
            <form method = "post" autocomplete = "off" enctype = "multipart/form-data" action = "<?php echo site_url('admin/deliverer/payrole'); ?>">
                <div class="row">
                    <div class = "col-sm-4">
                        <label for="deliverers">Choose deliverer</label>
                        <select name="deliverers" id="deliverers" class = "form-control" required>
                            <option value="" disabled selected>--choose deliverer--</option>
                            <?php
                                foreach ($DELIVERERS as $deliverer) { ?>
                                    <option value="<?php echo $deliverer->id; ?>"><?php echo $deliverer->name; ?> (<?php echo $deliverer->phone; ?>)</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class = "col-sm-4">
                        <label for="startDate">Start date</label>
                        <input type="date" name="startDate" id="startDate" class = "form-control" required>
                    </div>
                    <div class = "col-sm-4">
                        <label for="endDate">End date</label>
                        <input type="date" name="endDate" id="endDate" value = "<?php echo date('Y-m-d'); ?>" class = "form-control" required>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class = "col-sm-4">
                        <button type="submit" name = "filter" class = "btn btn-info">FILTER</button>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php if (isset($_POST['filter'])) { ?>
<section class="hk-sec-wrapper">
    <div class="row">
        <div class="col-sm">
            <h5 class="hk-sec-title">DELIVERER: <?php echo strtoupper($deliverer_details); ?> REPORT FROM <b><?php echo $start; ?></b> TO <b><?php echo $end; ?></b></h5>
            <center><h3>TOTAL INCOME CALCULATED: <?php echo "Rs.".$TOTAL_INCOME; ?></h3></center>
        </div>
    </div>
</section>
<?php } ?>