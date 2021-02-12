<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

		$this->load->library('form_validation');

		// $this->load->library('upload');

		if (!$this->session->userdata('id') || $this->session->userdata('role') != 'DELIVERER') {

            redirect('deliverer/authentication/login');

        }

    }

	 public function index() {
		$id = $this->session->userdata('id');
		$data['PARCELS'] = $this->Crud->Read('parcels', " `deliverer_assigned` = '$id' AND `parcel_status` = '3'");
		$this->load->view('deliverer/layouts/header');
		$this->load->view('deliverer/layouts/nav');
		// $this->load->view('deliverer/layouts/bar');
		$this->load->view('deliverer/dashboard', $data);
		$this->load->view('deliverer/layouts/footer');

	 }

	 public function markDelivered() {
        $referrer = basename($_SERVER['HTTP_REFERER']);
        $myId = $this->session->userdata('id');
        if (!$this->uri->segment(4)) {
            $this->session->set_flashdata('danger', "Tracking ID not found");
        } else {
            $trackingId = $this->uri->segment(4);
            $readData = $this->Crud->Read('parcels', " `tracking_id` = '$trackingId'");
            if ($readData[0]->deliverer_assigned == $myId) {
                $this->Crud->Update('parcels', array(
                    'parcel_status' => 4,
                ), " `tracking_id` = '$trackingId'");
                $notification = "Item delivered successfully.";
                $this->Crud->Create('transaction_history', array(
                    'tracking_id' => $trackingId,
                    'from_branch' => $readData[0]->current_branch,
                    'to_branch' => $readData[0]->current_branch,
                    'dispatched_time' => time(),
                    'narration' => $notification
                ));
            } else {
                $this->session->set_flashdata('danger', "Tracking ID not found");
            }
        }
        redirect('deliverer/' . __CLASS__ . '/');
    }

     public function logout() {

        $data = $this->session->all_userdata();

        foreach ($data as $key => $value) {

            $this->session->unset_userdata($key);

        }

		// redirect('deliverer/authentication/login');
		echo "<script>localStorage.removeItem('deliverer-access-token'); window.location.assign('".base_url('/deliverer/authentication/login')."')</script>";

	 }

}