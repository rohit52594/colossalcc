<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parcel extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 public function __construct() {

        parent::__construct();
        $this->load->helper('sms');

		$this->load->library('form_validation');

		if (!$this->session->userdata('id') || $this->session->userdata('role') != 'SELLER') {

            redirect('branch/authentication/login');

        }

     }

	 public function getParcel() {

        if (isset($_POST['submit'])) {
            extract($_POST);
            $trackingId = trackingIdGenerate(8);
            if ($this->Crud->Create('parcels', array(
                'tracking_id' => $trackingId,
                'branch_id' => $this->session->userdata('id'),
                'parcel_receive_time' => time(),
                'sender_address' => $sender_address,
                'sender_state' => $sender_state,
                'sender_city' => $sender_city,
                'sender_pincode' => $sender_pincode,
                'sender_phone' => $sender_phone,
                'sender_alt_phone' => $sender_alt_phone,
                'sender_name' => $sender_name,
                'receiver_address' => $receiver_address,
                'receiver_state' => $receiver_state,
                'receiver_city' => $receiver_city,
                'receiver_pincode' => $receiver_pincode,
                'receiver_phone' => $receiver_phone,
                'receiver_alt_phone' => $receiver_alt_phone,
                'receiver_name' => $receiver_name,
                'parcel_weight' => $parcel_weight,
                'parcel_height' => $parcel_height,
                'parcel_width' => $parcel_width,
                'parcel_length' => $parcel_length,
                'parcel_price' => $parcel_price,
                'parcel_is_paid' => $parcel_is_paid,
                'destination_branch' => $destination_branch
            ))) {
                $this->Crud->Create('transaction_history', array(
                    'tracking_id' => $trackingId,
                    'from_branch' => $this->session->userdata('id'),
                    'to_branch' => $destination_branch,
                    'narration' => 'Parcel picked at origin branch',
                    'dispatched_time' => time()
                ));
                $this->session->set_flashdata('success', "Parcel added to list. Tracking Id: #". $trackingId);
                redirect('branch/parcel/getParcel/');
            } else {
                $this->session->set_flashdata('danger', "Something went wrong, please try again later");
            }
        }
        $myId = $this->session->userdata('id');
        $data['BRANCHES'] = $this->Crud->Read('seller', " `is_active` = '1' AND `id` != '$myId'");
		$this->load->view('branch/layouts/header');
		$this->load->view('branch/layouts/nav');
		$this->load->view('branch/layouts/bar');
		$this->load->view('branch/parcel/getParcel', $data);
		$this->load->view('branch/layouts/footer');

     }

     public function availableParcels() {
        $myId = $this->session->userdata('id');
        $data['BRANCHES'] = $this->Crud->Read('seller', " `is_active` = '1' AND `id` != '$myId'");
		$this->load->view('branch/layouts/header');
		$this->load->view('branch/layouts/nav');
		$this->load->view('branch/layouts/bar');
		$this->load->view('branch/parcel/availableParcels', $data);
		$this->load->view('branch/layouts/footer');
     }

}