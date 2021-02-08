<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seller extends CI_Controller
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

		$data['DISTRICTS'] = $this->Crud->Read('districts', " `status` = '1'");
		$data['TYPES'] = $this->Crud->Read('types', " `id` != '0'");

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/seller/add-seller', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function addSeller()
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

				$config['upload_path'] = FCPATH . 'uploads/sellers/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_width'] = 1500;
				$config['max_height'] = 1500;
				$config['encrypt_name'] = TRUE;
				$this->load->library('image_lib');
				$this->load->library('upload', $config);

				$this->upload->initialize($config);
				$mainImage = '';
				if (!$this->upload->do_upload('coverImage')) {
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('warning', $this->upload->display_errors());
				} else {
					$image_metadata = $this->upload->data();
					$configer =  array(
						'image_library'   => 'gd2',
						'source_image'    =>  $image_metadata['full_path'],
						'maintain_ratio'  =>  TRUE,
						'width'           =>  400,
						'height'          =>  400,
					);
					$this->image_lib->clear();
					$this->image_lib->initialize($configer);
					$mainImage = $image_metadata['file_name'];

					$sellerData = [

						'name' => $this->input->post('name'),

						'email' => $this->input->post('email'),

						'phone' => $this->input->post('phone'),

						'password' => $this->encryption->encrypt($this->input->post('password')),
						'cover_image' => $mainImage,

						'address' => $this->input->post('address'),

						'district' => $this->input->post('district'),

						'pincode' => $this->input->post('pincode'),
						'types' => $this->input->post('types'),

						'added_date' => date('Y-m-d'),

						'added_time' => date('H:i:s')

					];

					$add = $this->Crud->Create('seller', $sellerData);

					if ($add === false) {

						$this->session->set_flashdata('danger', 'Something went wrong, please try again');
					} else {

						$this->session->set_flashdata('success', 'Seller Registered');

						redirect('admin/seller/new');
					}
				}
			} else {

				$this->session->set_flashdata('warning', 'Phone number already in use with another seller');
			}

			redirect('admin/seller/new');
		} else {

			$this->new();
		}
	}

	public function view()
	{

		$data['SELLERS'] = $this->Crud->Read('seller', " `id` != '0'");

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

		redirect('admin/seller/' . $referer);
	}

	public function edit()
	{

		$sellerId = $this->uri->segment(4);

		$isExists = $this->Crud->Count('seller', " `id` = '$sellerId'");

		if ($isExists < 1) {

			$this->session->set_flashdata('danger', "No sellers found");

			redirect('admin/seller/view');
		} else {

			$data['SELLER_DETAILS'] = $this->Crud->Read('seller', " `id` = '$sellerId'");
			$district = $data['SELLER_DETAILS'][0]->district;
			$data['DISTRICTS'] = $this->Crud->Read('districts', " `status` = '1'");
			$data['PINCODES'] = $this->Crud->Read('pincodes', " `district` = '$district'");
			$data['TYPES'] = $this->Crud->Read('types', " `id` != '0'");
		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/seller/edit-seller', $data);
		$this->load->view('admin/layouts/footer');
	}

	public function editSeller()
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
				if (isset($_FILES['coverImage']['name'])) {
					$config['upload_path'] = FCPATH . 'uploads/sellers/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_width'] = 1500;
					$config['max_height'] = 1500;
					$config['encrypt_name'] = TRUE;
					$this->load->library('image_lib');
					$this->load->library('upload', $config);

					$this->upload->initialize($config);
					$mainImage = $this->Crud->Read('seller', " `id` = '$sellerId'")[0]->cover_image;
					if (!$this->upload->do_upload('coverImage')) {
						$error = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata('warning', $this->upload->display_errors());
					} else {
						$image_metadata = $this->upload->data();
						$configer =  array(
							'image_library'   => 'gd2',
							'source_image'    =>  $image_metadata['full_path'],
							'maintain_ratio'  =>  TRUE,
							'width'           =>  400,
							'height'          =>  400,
						);
						$this->image_lib->clear();
						$this->image_lib->initialize($configer);
						$mainImage = $image_metadata['file_name'];
					}
				}

				$sellerData = [

					'name' => $this->input->post('name'),

					'email' => $this->input->post('email'),

					'phone' => $this->input->post('phone'),

					'address' => $this->input->post('address'),

					'district' => $this->input->post('district'),
					'cover_image' => $mainImage,

					'pincode' => $this->input->post('pincode'),
					'types' => $this->input->post('types'),

					'last_updated_date' => date('Y-m-d'),

					'last_updated_time' => date('H:i:s'),

					'last_updated_remote' => $_SERVER['REMOTE_ADDR']

				];

				$update = $this->Crud->Update('seller', $sellerData, " `id` = '$sellerId'");

				if ($update === false) {

					$this->session->set_flashdata('danger', 'Something went wrong, please try again');

					redirect('admin/seller/view');
				} else {

					$this->session->set_flashdata('success', 'Seller details updated successfully!');

					redirect('admin/seller/view');
				}
			} else {

				$this->session->set_flashdata('warning', 'Phone number already in use with another seller');
			}
		} else {

			$this->session->set_flashdata('warning', 'Invalid form data entered!' . $sellerId);

			redirect('admin/seller/view');
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

	public function changeSellerBadge()
	{
		if (!empty($_POST)) {
			extract($_POST);
			$data = [
				'badge' => $val
			];
			if ($this->Crud->Update('seller', $data, " `id` = '$id'")) {
				echo "Saved successfully";
			} else {
				echo "Something went wrong, please refresh this page and try again";
			}
		}
	}

	public function payment()
	{
		$data['SELLERS'] = $this->Crud->Read('seller', " `id` != '0'");
		if (isset($_POST['filter'])) {
			extract($_POST);
			$sellerData = $this->Crud->Read('seller', " `id` = '$sellers'");
			$data['sellerDetails'] = $sellerData[0]->name . " (" . $sellerData[0]->phone . ")";
			$data['start'] = $startDate;
			$data['end'] = $endDate;
			$data['TOTAL_SALES'] = 0;
			$data['SALES_LIST'] = $this->Crud->Read('cart', " `the_creator` = '$sellers' AND `is_ordered` = '1' AND `added_date` BETWEEN '$startDate' AND '$endDate'");
			foreach ($this->Crud->Read('cart', " `the_creator` = '$sellers' AND `is_ordered` = '1' AND `added_date` BETWEEN '$startDate' AND '$endDate'") as $key) {
				if ($this->Crud->Count('orders', " `ukey` = '$key->order_id' AND `current_status` = '3'") > 0) {
					$data['TOTAL_SALES'] += $key->total;
				}
			}
		}

		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/seller/payment', $data);
		$this->load->view('admin/layouts/footer');
	}
}
