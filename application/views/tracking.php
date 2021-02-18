<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Order | <?= PROJECT_NAME; ?></title>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/track/style.scss">
    <link href="<?php echo base_url() . 'assets/'; ?>dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <center>
        <h3>TRACK ORDER | <?= PROJECT_NAME; ?></h3>
    </center>
    <center>
        <form action="" method="get">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <input type="text" name="q" id="" class="form-control mb-2" placeholder="Enter tracking id" required>
                    <input type="text" name="mobile" id="" class="form-control mb-2" placeholder="Your mobile number" required>
                    <button type="submit" class="btn btn-success">Look for my Parcel</button>
                </div>
            </div>
        </form>
        <div>
            <?php if (isset($_GET['q'])) { ?>
                <h3 style="color: red;"><?= $ERROR_MESSAGE; ?></h3>
            <?php } ?>
            <?php if (isset($parcelDetails[0]->id)) { ?>
                <div class="row mt-2">
                    <div class="col-sm-4" style="border: 1px solid black;">
                        Sender Details: <?php echo "<i>Name:</i> " . $parcelDetails[0]->sender_name . "<br /><strong>Phone:</strong> " . $parcelDetails[0]->sender_phone . "<br /><strong>Alternate Phone:</strong> " . $parcelDetails[0]->sender_alt_phone . "<br /><strong>City:</strong> " . $parcelDetails[0]->sender_city . "<br /><strong>State:</strong> " . $parcelDetails[0]->sender_state . "<br /><strong>Pincode:</strong> " . $parcelDetails[0]->sender_pincode . "<br /><strong>Full Address:</strong> " . $parcelDetails[0]->sender_address; ?>
                    </div>
                    <div class="col-sm-4" style="border: 1px solid black;">
                        Receiver Details: <?php echo "<i>Name:</i> " . $parcelDetails[0]->receiver_name . "<br /><strong>Phone:</strong> " . $parcelDetails[0]->receiver_phone . "<br /><strong>Alternate Phone:</strong> " . $parcelDetails[0]->receiver_alt_phone . "<br /><strong>City:</strong> " . $parcelDetails[0]->receiver_city . "<br /><strong>State:</strong> " . $parcelDetails[0]->receiver_state . "<br /><strong>Pincode:</strong> " . $parcelDetails[0]->receiver_pincode . "<br /><strong>Full Address:</strong> " . $parcelDetails[0]->receiver_address; ?>
                    </div>
                    <div class="col-sm-4" style="border: 1px solid black;">
                        Parcel Details: <?php echo "<strong>Parcel Weight:</strong> " . $parcelDetails[0]->parcel_weight . "<br /><strong>Parcel Height:</strong> " . $parcelDetails[0]->parcel_height . "<br /><strong>Parcel Width:</strong> " . $parcelDetails[0]->parcel_width . "<br /><strong>Parcel Length:</strong> " . $parcelDetails[0]->parcel_length; ?>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mt-70 mb-70">
                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">User Timeline</h5>
                                <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                    <?php foreach ($trackingDetails as $key) { ?>
                                        <div class="vertical-timeline-item vertical-timeline-element">
                                            <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="badge badge-dot badge-dot-xl badge-success"></i> </span>
                                                <div class="vertical-timeline-element-content bounce-in">
                                                    <h4 class="timeline-title">Meeting with client</h4>
                                                    <p>Meeting with USA Client, today at <a href="javascript:void(0);" data-abc="true">12:00 PM</a></p> <span class="vertical-timeline-element-date">9:30 AM</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </center>
</body>

</html>