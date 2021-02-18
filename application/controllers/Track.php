<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Track extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $data['ERROR_MESSAGE'] = '';
        if (!isset($_GET['q'])) {
            $data['ERROR_MESSAGE'] = 'NO TRACKING ID SPECIFIED';
        } else {
            $trackingId = $_GET['q'];
            $mobile = $_GET['mobile'];
            if ($this->Crud->Count('parcels', " `tracking_id` = '$trackingId' AND (`sender_phone` = '$mobile' OR `sender_alt_phone` = '$mobile')") < 1) {
                $data['ERROR_MESSAGE'] = 'TRACKING ID NOT FOUND WITH THIS MOBILE NUMBER';
            } else {
                $data['parcelDetails'] = $this->Crud->Read('parcels', " `tracking_id` = '$trackingId'");
                $data['trackingDetails'] = $this->Crud->Read('transaction_history', " `tracking_id` = '$trackingId'");
            }
        }
        $this->load->view('tracking', $data);
    }
}
