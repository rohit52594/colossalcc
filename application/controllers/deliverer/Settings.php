<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

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

        $this->load->model('deliverer/Settings_model');
        
        $this->load->library('encryption');

		if (!$this->session->userdata('id') || $this->session->userdata('role') != 'DELIVERER') {

            redirect('deliverer/authentication/login');

        }

     }

	 public function password() {

		$this->load->view('deliverer/layouts/header');
		$this->load->view('deliverer/layouts/nav');
		$this->load->view('deliverer/layouts/bar');
		$this->load->view('deliverer/settings/password');
		$this->load->view('deliverer/layouts/footer');

     }

     public function changePassword() {

        $this->form_validation->set_rules('password', 'Current password', 'required');

        $this->form_validation->set_rules('new_password', 'New password', 'required');

        if ($this->form_validation->run()) {

            $output = $this->Settings_model->changePassword($this->input->post('password'), $this->input->post('new_password'));

            if ($output == 'Password changed') {

                $message = 'success';

            } else {

                $message = 'danger';

            }

            $this->session->set_flashdata($message, $output);

            redirect('deliverer/settings/password');

        } else {

            $this->password();

        }

    }

    public function history() {

        $data['LOGIN_HISTORY'] = $this->Settings_model->getLoginHistory();

        $this->load->view('deliverer/layouts/header');
		$this->load->view('deliverer/layouts/nav');
		$this->load->view('deliverer/layouts/bar');
		$this->load->view('deliverer/settings/history', $data);
        $this->load->view('deliverer/layouts/footer');

    }

    public function profile() {

        $sessionId = $this->session->userdata('id');

        $data['PROFILE_DETAILS'] = $this->Crud->Read('deliverers', " `id` = '$sessionId'");

        $this->load->view('deliverer/layouts/header');
		$this->load->view('deliverer/layouts/nav');
		$this->load->view('deliverer/layouts/bar');
		$this->load->view('deliverer/settings/profile', $data);
        $this->load->view('deliverer/layouts/footer');

    }

     public function logout() {

        $data = $this->session->all_userdata();

        foreach ($data as $key => $value) {

            $this->session->unset_userdata($key);

        }

        redirect('deliverer/authentication/login');

	 }

}