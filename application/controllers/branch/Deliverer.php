<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deliverer extends CI_Controller
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

		if (!$this->session->userdata('id') || $this->session->userdata('role') != 'SELLER') {

			redirect('branch/authentication/login');
		}
	}

	public function new()
	{
		$data['BRANCHES'] = $this->Crud->Read('seller', " `is_active` = '1'");

		$this->load->view('branch/layouts/header');
		$this->load->view('branch/layouts/nav');
		$this->load->view('branch/layouts/bar');
		$this->load->view('branch/deliverer/add-deliverer', $data);
		$this->load->view('branch/layouts/footer');
	}

	public function addDeliverer()
	{

		$this->form_validation->set_rules('name', 'Name', 'required|trim');

		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');

		$this->form_validation->set_rules('phone', 'Phone', 'required');

		$this->form_validation->set_rules('confirmPassword', 'Confirmation password', 'required');

		if ($this->form_validation->run()) {

			$phone = $this->input->post('phone');

			$isPhone = $this->Crud->Count('deliverers', " `phone` = '$phone'");

			if ($isPhone < 1) {

				$delivererData = [

					'name' => $this->input->post('name'),

					'email' => $this->input->post('email'),

					'phone' => $this->input->post('phone'),

					'password' => $this->encryption->encrypt($this->input->post('password')),

					'address' => $this->input->post('address'),

					'bank_name' => $this->input->post('bank_name'),

					'account_number' => $this->input->post('account_number'),

					'ifsc' => $this->input->post('ifsc'),

					'branch' => $this->input->post('branch'),
					'branch_code' => $this->session->userdata('id'),

					'added_date' => date('Y-m-d'),

					'added_time' => date('H:i:s')

				];

				$add = $this->Crud->Create('deliverers', $delivererData);

				if ($add === false) {

					$this->session->set_flashdata('danger', 'Something went wrong, please try again');
				} else {

					$config['upload_path'] = FCPATH . 'uploads/deliverer/';

					$config['allowed_types'] = 'gif|jpg|png|jpeg';

					$config['max_size'] = 2000;

					$config['max_width'] = 1500;

					$config['encrypt_name'] = TRUE;

					$config['max_height'] = 1500;

					$this->upload->initialize($config);

					if (!$this->upload->do_upload('passportImage')) {

						$error = array('error' => $this->upload->display_errors());

						$this->session->set_flashdata('warning', $this->upload->display_errors());
					} else {

						$image_metadata = $this->upload->data();

						$passportData = [

							'deliverer_id' => $add,

							'asset_type' => 'PASSPORT IMAGE',

							'file_name' => $image_metadata['file_name'],

							'file_type' => $image_metadata['file_type'],

							'file_path' => $image_metadata['file_path'],

							'full_path' => $image_metadata['full_path'],

							'raw_name' => $image_metadata['raw_name'],

							'orig_name' => $image_metadata['orig_name'],

							'client_name' => $image_metadata['client_name'],

							'file_ext' => $image_metadata['file_ext'],

							'file_size' => $image_metadata['file_size'],

							'is_image' => $image_metadata['is_image'],

							'image_width' => $image_metadata['image_width'],

							'image_height' => $image_metadata['image_height'],

							'image_type' => $image_metadata['image_type'],

							'added_date' => date('Y-m-d'),

							'added_time' => date('H:i:s')

						];

						$this->Crud->Create('assets_deliverer', $passportData);
					}

					if (!$this->upload->do_upload('licenseImage')) {

						$error = array('error' => $this->upload->display_errors());

						$this->session->set_flashdata('warning', $this->upload->display_errors());
					} else {

						$license_metadata = $this->upload->data();

						$licenseData = [

							'deliverer_id' => $add,

							'asset_type' => 'LICENSE PROOF',

							'file_name' => $license_metadata['file_name'],

							'file_type' => $license_metadata['file_type'],

							'file_path' => $license_metadata['file_path'],

							'full_path' => $license_metadata['full_path'],

							'raw_name' => $license_metadata['raw_name'],

							'orig_name' => $license_metadata['orig_name'],

							'client_name' => $license_metadata['client_name'],

							'file_ext' => $license_metadata['file_ext'],

							'file_size' => $license_metadata['file_size'],

							'is_image' => $license_metadata['is_image'],

							'image_width' => $license_metadata['image_width'],

							'image_height' => $license_metadata['image_height'],

							'image_type' => $license_metadata['image_type'],

							'added_date' => date('Y-m-d'),

							'added_time' => date('H:i:s')

						];

						$this->Crud->Create('assets_deliverer', $licenseData);
					}

					$this->session->set_flashdata('success', 'Deliverer Registered');

					redirect('branch/deliverer/new');
				}
			} else {

				$this->session->set_flashdata('warning', 'Phone number already in use with another deliverer');
			}

			redirect('branch/deliverer/new');
		} else {

			$this->new();
		}
	}

	public function view()
	{
		$myId = $this->session->userdata('id');
		$data['DELIVERERS'] = $this->Crud->Read('deliverers', " `id` = '$myId'");

		$this->load->view('branch/layouts/header');
		$this->load->view('branch/layouts/nav');
		$this->load->view('branch/layouts/bar');
		$this->load->view('branch/deliverer/manage-deliverer', $data);
		$this->load->view('branch/layouts/footer');
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

		if ($this->Crud->Update($tableName, $data, $condition))

			$this->session->set_flashdata('success', "Success! Changes saved");

		else

			$this->session->set_flashdata('danger', "Something went wrong");

		$referer = basename($_SERVER['HTTP_REFERER']);

		redirect('branch/deliverer/' . $referer);
	}

	public function edit()
	{
		$delivererId = $this->uri->segment(4);
		$isExists = $this->Crud->Count('deliverers', " `id` = '$delivererId'");
		if ($isExists < 1) {
			$this->session->set_flashdata('danger', "No deliverers found");
			redirect('branch/deliverer/view');
		} else {
			$data['DELIVERER_DETAILS'] = $this->Crud->Read('deliverers', " `id` = '$delivererId'");
			$data['BRANCHES'] = $this->Crud->Read('seller', " `is_active` = '1'");
		}

		$this->load->view('branch/layouts/header');
		$this->load->view('branch/layouts/nav');
		$this->load->view('branch/layouts/bar');
		$this->load->view('branch/deliverer/edit-deliverer', $data);
		$this->load->view('branch/layouts/footer');
	}

	public function editDeliverer()
	{

		$delivererId = $this->uri->segment(4);

		$this->form_validation->set_rules('name', 'Name', 'required|trim');

		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');

		$this->form_validation->set_rules('phone', 'Phone', 'required');

		$this->form_validation->set_rules('address', 'Address', 'required|trim');

		if ($this->form_validation->run()) {

			$phone = $this->input->post('phone');

			$isPhone = $this->Crud->Count('deliverers', " `phone` = '$phone'");

			if ($isPhone < 2) {

				$delivererData = [

					'name' => $this->input->post('name'),

					'email' => $this->input->post('email'),

					'phone' => $this->input->post('phone'),

					'address' => $this->input->post('address'),

					'bank_name' => $this->input->post('bank_name'),

					'account_number' => $this->input->post('account_number'),

					'ifsc' => $this->input->post('ifsc'),

					'branch' => $this->input->post('branch'),
					'branch_code' => $this->session->userdata('id'),

					'last_updated_date' => date('Y-m-d'),

					'last_updated_time' => date('H:i:s'),

					'last_updated_remote' => $_SERVER['REMOTE_ADDR']

				];

				$update = $this->Crud->Update('deliverers', $delivererData, " `id` = '$delivererId'");

				if ($update === false) {

					$this->session->set_flashdata('danger', 'Something went wrong, please try again');
				} else {

					$config['upload_path'] = FCPATH . 'uploads/deliverer/';

					$config['allowed_types'] = 'gif|jpg|png|jpeg';

					$config['max_size'] = 2000;

					$config['max_width'] = 1500;

					$config['encrypt_name'] = TRUE;

					$config['max_height'] = 1500;

					$this->upload->initialize($config);

					if (isset($_FILES['passportImage']) && is_uploaded_file($_FILES['passportImage']['tmp_name'])) {

						if (!$this->upload->do_upload('passportImage')) {

							$error = array('error' => $this->upload->display_errors());

							$this->session->set_flashdata('warning', $this->upload->display_errors());
						} else {

							$image_metadata = $this->upload->data();

							$passportData = [

								'file_name' => $image_metadata['file_name'],

								'file_type' => $image_metadata['file_type'],

								'file_path' => $image_metadata['file_path'],

								'full_path' => $image_metadata['full_path'],

								'raw_name' => $image_metadata['raw_name'],

								'orig_name' => $image_metadata['orig_name'],

								'client_name' => $image_metadata['client_name'],

								'file_ext' => $image_metadata['file_ext'],

								'file_size' => $image_metadata['file_size'],

								'is_image' => $image_metadata['is_image'],

								'image_width' => $image_metadata['image_width'],

								'image_height' => $image_metadata['image_height'],

								'image_type' => $image_metadata['image_type'],

								'added_date' => date('Y-m-d'),

								'added_time' => date('H:i:s')

							];

							$this->Crud->Update('assets_deliverer', $passportData, " `deliverer_id` = '$delivererId' AND `asset_type` = 'PASSPORT IMAGE'");
						}
					}

					if (isset($_FILES['licenseImage']) && is_uploaded_file($_FILES['licenseImage']['tmp_name'])) {

						if (!$this->upload->do_upload('licenseImage')) {

							$error = array('error' => $this->upload->display_errors());

							$this->session->set_flashdata('warning', $this->upload->display_errors());
						} else {

							$license_metadata = $this->upload->data();

							$licenseData = [

								'file_name' => $license_metadata['file_name'],

								'file_type' => $license_metadata['file_type'],

								'file_path' => $license_metadata['file_path'],

								'full_path' => $license_metadata['full_path'],

								'raw_name' => $license_metadata['raw_name'],

								'orig_name' => $license_metadata['orig_name'],

								'client_name' => $license_metadata['client_name'],

								'file_ext' => $license_metadata['file_ext'],

								'file_size' => $license_metadata['file_size'],

								'is_image' => $license_metadata['is_image'],

								'image_width' => $license_metadata['image_width'],

								'image_height' => $license_metadata['image_height'],

								'image_type' => $license_metadata['image_type'],

								'added_date' => date('Y-m-d'),

								'added_time' => date('H:i:s')

							];

							$this->Crud->Update('assets_deliverer', $licenseData, " `deliverer_id` = '$delivererId' AND `asset_type` = 'LICENSE PROOF'");
						}
					}

					$this->session->set_flashdata('success', 'Deliverer details updated successfully!');

					redirect('branch/deliverer/view');
				}
			} else {

				$this->session->set_flashdata('warning', 'Phone number already in use with another deliverer');
			}
		} else {

			$this->session->set_flashdata('warning', 'Invalid form data entered!' . $delivererId);

			redirect('branch/deliverer/view');
		}
	}

	public function logout()
	{

		$data = $this->session->all_userdata();

		foreach ($data as $key => $value) {

			$this->session->unset_userdata($key);
		}

		redirect('branch/authentication/login');
	}

	public function payrole()
	{
		$data['DELIVERERS'] = $this->Crud->Read('deliverers', " `id` != '0'");
		if (isset($_POST['filter'])) {
			extract($_POST);
			if ($startDate == '') {
				$startDate = date('Y-m-01');
			}
			if ($endDate == '') {
				$endDate = date('Y-m-t');
			}
			$data['start'] = $startDate;
			$data['end'] = $endDate;
			$ifDeliverer = $this->Crud->Count('deliverers', " `id` = '$deliverers'");
			if ($ifDeliverer > 0) {
				$delivererDetailsRead = $this->Crud->Read('deliverers', " `id` = '$deliverers'");
				$data['deliverer_details'] = $delivererDetailsRead[0]->name . ' (' . $delivererDetailsRead[0]->phone . ')';
				$data['DELIVERY_REPORT'] = $this->Crud->Read('orders', " `ordered_date` BETWEEN '$startDate' AND '$endDate' AND `deliverer_id` = '$deliverers'");
				$data['TOTAL_INCOME'] = 0;
				foreach ($data['DELIVERY_REPORT'] as $key) {
					if ($key->current_status == 3) {
						if ($key->grand_total >= 60 && $key->grand_total <= 300) {
							$data['TOTAL_INCOME'] += 10;
						} else if ($key->grand_total >= 301 && $key->grand_total <= 700) {
							$data['TOTAL_INCOME'] += 20;
						} else if ($key->grand_total >= 701 && $key->grand_total <= 1500) {
							$data['TOTAL_INCOME'] += 30;
						} else if ($key->grand_total >= 1501) {
							$data['TOTAL_INCOME'] += 40;
						}
					}
				}
			} else {
				$this->deliverers;
			}
		}
		$this->load->view('branch/layouts/header');
		$this->load->view('branch/layouts/nav');
		$this->load->view('branch/layouts/bar');
		$this->load->view('branch/deliverer/payrole', $data);
		$this->load->view('branch/layouts/footer');
	}
}
