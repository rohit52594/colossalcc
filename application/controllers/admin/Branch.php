<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Branch extends CI_Controller
{

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

	public function __construct()
	{

		parent::__construct();

		$this->load->library('form_validation');

		$this->load->library('upload');

		$this->load->library('encryption');

		$this->load->model('Crud');

		if (!$this->session->userdata('id') || $this->session->userdata('role') != 'ADMIN') {

			redirect('admin/authentication/login');
		}
	}

	public function new()
	{

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/seller/add-seller');
		$this->load->view('admin/layouts/footer');
	}

	public function addBranch()
	{

		$this->form_validation->set_rules('name', 'Name', 'required|trim');

		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');

		$this->form_validation->set_rules('phone', 'Phone', 'required');

		$this->form_validation->set_rules('confirmPassword', 'Confirmation password', 'required');

		$this->form_validation->set_rules('address', 'Address', 'required|trim');

		if ($this->form_validation->run()) {

			$phone = $this->input->post('phone');

			$isPhone = $this->Crud->Count('seller', " `phone` = '$phone'");

			if ($isPhone < 1) {

				$sellerData = [

					'name' => $this->input->post('name'),

					'email' => $this->input->post('email'),

					'phone' => $this->input->post('phone'),

					'password' => $this->encryption->encrypt($this->input->post('password')),

					'address' => $this->input->post('address'),

					'added_date' => date('Y-m-d'),

					'added_time' => date('H:i:s')

				];

				$add = $this->Crud->Create('seller', $sellerData);

				if ($add === false) {

					$this->session->set_flashdata('danger', 'Something went wrong, please try again');
				} else {

					$this->session->set_flashdata('success', 'Branch Registered');

					redirect('admin/branch/new');
				}
			} else {

				$this->session->set_flashdata('warning', 'Phone number already in use with another branch');
			}

			redirect('admin/branch/new');
		} else {

			$this->new();
		}
	}

	public function view()
	{

		$data['BRANCHES'] = $this->Crud->Read('seller', " `id` != '0'");

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/seller/manage-seller', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function changeStatus()
	{

		$tableName = $this->uri->segment(4);

		$status = $this->uri->segment(5);

		$conditionId = $this->uri->segment(6);

		$condition = " `id` = '$conditionId'";

		$data = [

			'is_active' => $status

		];

		if ($this->Crud->Update($tableName, $data, $condition)) {

			$this->Crud->Update('products', $data, " `the_creator` = '$conditionId' AND `is_active_backup` = '1'");

			$this->session->set_flashdata('success', "Success! Changes saved");
		} else {

			$this->session->set_flashdata('danger', "Something went wrong");
		}
		$referer = basename($_SERVER['HTTP_REFERER']);

		redirect('admin/branch/' . $referer);
	}

	public function edit()
	{

		$sellerId = $this->uri->segment(4);

		$isExists = $this->Crud->Count('seller', " `id` = '$sellerId'");

		if ($isExists < 1) {

			$this->session->set_flashdata('danger', "No branch found");

			redirect('admin/branch/view');
		} else {

			$data['BRANCH_DETAILS'] = $this->Crud->Read('seller', " `id` = '$sellerId'");
		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/seller/edit-seller', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function editBranch()
	{

		$sellerId = $this->uri->segment(4);

		$this->form_validation->set_rules('name', 'Name', 'required|trim');

		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');

		$this->form_validation->set_rules('phone', 'Phone', 'required');

		$this->form_validation->set_rules('address', 'Address', 'required|trim');

		if ($this->form_validation->run()) {

			$phone = $this->input->post('phone');

			$isPhone = $this->Crud->Count('seller', " `phone` = '$phone'");

			if ($isPhone < 2) {

				$sellerData = [

					'name' => $this->input->post('name'),

					'email' => $this->input->post('email'),

					'phone' => $this->input->post('phone'),

					'address' => $this->input->post('address'),

					'last_updated_date' => date('Y-m-d'),

					'last_updated_time' => date('H:i:s'),

					'last_updated_remote' => $_SERVER['REMOTE_ADDR']

				];

				$update = $this->Crud->Update('seller', $sellerData, " `id` = '$sellerId'");

				if ($update === false) {

					$this->session->set_flashdata('danger', 'Something went wrong, please try again');

					redirect('admin/branch/view');
				} else {

					$this->session->set_flashdata('success', 'Seller details updated successfully!');

					redirect('admin/branch/view');
				}
			} else {

				$this->session->set_flashdata('warning', 'Phone number already in use with another seller');
			}
		} else {

			$this->session->set_flashdata('warning', 'Invalid form data entered!' . $sellerId);

			redirect('admin/branch/view');
		}
	}

	public function logout()
	{

		$data = $this->session->all_userdata();

		foreach ($data as $key => $value) {

			$this->session->unset_userdata($key);
		}

		redirect('admin/authentication/login');
	}
}
