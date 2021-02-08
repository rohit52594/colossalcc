<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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

		// $this->load->library('upload');

		if (!$this->session->userdata('id') || $this->session->userdata('role') != 'SELLER') {

			redirect('seller/authentication/login');
		}
		$this->myId = ($this->session->userdata('role') == 'ADMIN') ? 0 : $this->session->userdata('id');
	}

	public function index()
	{
		$id = $this->session->userdata('id');


		$thisMonth = date('Y-m-d');
		// users
		$sellerDetails = $this->Crud->Read('seller', " `id` = '$id'");
		$myDistrict = $sellerDetails[0]->district;
		$data['USERS_COUNT'] = $this->Crud->Count('customers', " `id` != '0' AND `district` = '$myDistrict'");
		$data['ACTIVE_USERS_COUNT'] = $this->Crud->Count('customers', " `is_active` = '1' AND `district` = '$myDistrict'");
		$data['ACTIVE_USERS_COUNT_TODAY'] = $this->Crud->Count('customers', " `joined_date` = '$thisMonth' AND `district` = '$myDistrict'");
		// products
		$data['PRODUCTS_COUNT'] = $this->Crud->Count('products', " `id` != '0' AND `the_creator` = '$this->myId'");
		$data['ACTIVE_PRODUCTS_COUNT_TODAY'] = $this->Crud->Count('products', " `added_date` = '$thisMonth' AND `the_creator` = '$this->myId'");
		$data['FEATURED_PRODUCTS'] = $this->Crud->Count('products', " `is_featured` = '1' AND `the_creator` = '$this->myId'");
		// deliveries
		$today = date('Y-m-d');
		$data['SUCCESSFUL_DELIVERIES_TODAY'] = 0;
		$data['SUCCESSFUL_DELIVERIES'] = 0;
		$data['AWAITING_DELIVERIES'] = 0;
		$data['EARNED_TODAY'] = 0;
		$data['EARNED'] = 0;
		$data['EXTRA_CHARGES'] = 0;
		foreach ($this->Crud->Read('cart', " `the_creator` = '$id' AND `is_ordered` = '1'") as $key) {
			$orderDetails = $this->Crud->Read('orders', " `ukey` = '$key->order_id'");
			if ($orderDetails[0]->current_status == 3 && $orderDetails[0]->delivered_date == $today) {
				++$data['SUCCESSFUL_DELIVERIES_TODAY'];
				$data['EARNED_TODAY'] += $orderDetails[0]->sub_total;
			}
			if ($orderDetails[0]->current_status == 3) {
				++$data['SUCCESSFUL_DELIVERIES'];
				$data['EARNED'] += $orderDetails[0]->sub_total;
				$data['EXTRA_CHARGES'] += ($orderDetails[0]->delivery_charge + $orderDetails[0]->weight_charge);
			}
			if (($orderDetails[0]->current_status == 0 || $orderDetails[0]->current_status == 1 || $orderDetails[0]->current_status == 2) && $orderDetails[0]->status == 1) {
				++$data['AWAITING_DELIVERIES'];
			}
		}

		// availability
		$data['IS_AVAILABLE'] = $this->Crud->Read('seller', " `id` = '$this->myId'")[0]->is_available;

		// chart
		$Year = date('Y');
		$StartYear = date($Year . '-01-01');
		$EndYear = date($Year . '-12-31');
		$sales = [];
		$cancelled = [];
		for ($i = 1; $i <= 12; $i++) {
			$MonthlySales = 0;
			$MonthlyCancelled = 0;
			$MonthStart = date($Year . '-' . $i . '-01');
			$End = date($Year . '-' . $i . '-01');
			$MonthEnd = date('Y-m-t', strtotime($End));
			$SalesData = $this->Crud->Read('cart', " `the_creator` = '$id' AND `is_ordered` != '0' AND `added_date` BETWEEN '$MonthStart' AND '$MonthEnd'");
			foreach ($SalesData as $SalesKey) {
				$orderDetails = $this->Crud->Read('orders', " `ukey` = '$SalesKey->order_id'");
				if (($orderDetails[0]->ordered_date < $MonthStart && $orderDetails[0]->ordered_date < $MonthEnd) && $orderDetails[0]->current_status == 3) {
					$MonthlySales += $orderDetails[0]->grand_total;
					$MonthlySales = number_format((float)$MonthlySales, 2, '.', '');
				}
				if (($orderDetails[0]->ordered_date < $MonthStart && $orderDetails[0]->ordered_date < $MonthEnd) && $orderDetails[0]->current_status == 4) {
					$MonthlyCancelled += $orderDetails[0]->grand_total;
					$MonthlyCancelled = number_format((float)$MonthlyCancelled, 2, '.', '');
				}
			}
			$sales[] = $MonthlySales;
			$cancelled[] = $MonthlyCancelled;
			$MonthlySales = 0;
			$MonthlyCancelled = 0;
		}
		$data['sales'] = $sales;
		$data['cancelled'] = $cancelled;

		$this->load->view('seller/layouts/header');
		$this->load->view('seller/layouts/nav');
		$this->load->view('seller/layouts/bar');
		$this->load->view('seller/dashboard', $data);
		$this->load->view('seller/layouts/footer');
	}

	public function earning()
	{
		$data['TOTAL_SALES'] = 0;
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
		$this->load->view('seller/layouts/header');
		$this->load->view('seller/layouts/nav');
		$this->load->view('seller/layouts/bar');
		$this->load->view('seller/earning', $data);
		$this->load->view('seller/layouts/footer');
	}

	public function onlineOffline()
	{
		$tableName = $this->uri->segment(4);
		$status = $this->uri->segment(5);
		$conditionId = $this->session->userdata('id');
		$condition = " `id` = '$conditionId'";
		$dataSeller = [
			'is_available' => $status
		];
		$data = [
			'is_active' => $status,
		];
		if ($this->Crud->Update($tableName, $dataSeller, $condition)) {
			$this->Crud->Update('products', $data, " `the_creator` = '$conditionId' AND `is_active_backup` = '1'");
			$this->session->set_flashdata('success', "Success! Changes saved");
		} else {
			$this->session->set_flashdata('danger', "Something went wrong");
		}
		redirect('seller/dashboard');
	}

	public function feedback() {
		if (isset($_POST['submit'])) {
			extract($_POST);
			$this->Crud->Create('feedbacks', array(
				'title' => $title,
				'name' => $this->session->userdata('name'),
				'email' => $this->session->userdata('email'),
				'sellerId' => $this->session->userdata('id'),
				'description' => $description,
				'added_on' => date('Y-m-d H:i:s'),
				'added_by' => 'SELLER'
			));
			$this->session->set_flashdata('success', "Your feedback has been sent to admin");
			redirect('seller/dashboard/feedback');
		}
		$this->load->view('seller/layouts/header');
		$this->load->view('seller/layouts/nav');
		$this->load->view('seller/layouts/bar');
		$this->load->view('seller/feedback');
		$this->load->view('seller/layouts/footer');
	}

	public function logout()
	{

		$data = $this->session->all_userdata();

		foreach ($data as $key => $value) {

			$this->session->unset_userdata($key);
		}

		// redirect('seller/authentication/login');
		echo "<script>localStorage.removeItem('seller-access-token'); window.location.assign('".base_url('/seller/authentication/login')."')</script>";
	}
}
