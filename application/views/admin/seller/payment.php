<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">CHOOSE SELLER</h5>
    <div class="row">
        <div class="col-sm">
            <form method="post" autocomplete="off" enctype="multipart/form-data" action="<?php echo site_url('admin/seller/payment'); ?>">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="sellers">Choose seller</label>
                        <select name="sellers" id="sellers" class="form-control" required>
                            <option value="" disabled selected>--choose seller--</option>
                            <?php
                            foreach ($SELLERS as $seller) { ?>
                                <option value="<?php echo $seller->id; ?>"><?php echo $seller->name; ?> (<?php echo $seller->phone; ?>)</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="startDate">Start date</label>
                        <input type="date" name="startDate" id="startDate" class="form-control" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="endDate">End date</label>
                        <input type="date" name="endDate" id="endDate" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-sm-4">
                        <button type="submit" name="filter" class="btn btn-info">FILTER</button>
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
                <h5 class="hk-sec-title">SELLER: <?php echo strtoupper($sellerDetails); ?> REPORT FROM <b><?php echo $start; ?></b> TO <b><?php echo $end; ?></b></h5>
                <center>
                    <h3>TOTAL SALES: <?php echo "Rs." . $TOTAL_SALES; ?></h3>
                </center>
            </div>
        </div>
        <div class="table-wrap">
            <table id="datable_1" class="table table-hover w-200">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product name</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($SALES_LIST as $list) {
                        $productName = $this->Crud->Read('products', " `id` = '$id'")[0]->name;
                    ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $productName; ?></td>
                            <td><?php echo $list->quantity; ?></td>
                            <td>&#8377;<?php echo $list->rate; ?></td>
                            <td>&#8377;<?php echo $list->total; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
<?php } ?>