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
		$this->load->view('deliverer/layouts/header');
		$this->load->view('deliverer/layouts/nav');
		$this->load->view('deliverer/layouts/bar');
		$this->load->view('deliverer/dashboard');
		$this->load->view('deliverer/layouts/footer');

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