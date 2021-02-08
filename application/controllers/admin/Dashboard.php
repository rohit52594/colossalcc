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
	public $myId;
	public function __construct()
	{

		parent::__construct();

		$this->load->library('form_validation');

		// $this->load->library('upload');

		if (!$this->session->userdata('id') || $this->session->userdata('role') != 'ADMIN') {

			redirect('admin/authentication/login');
		}
		$this->myId = ($this->session->userdata('role') == 'ADMIN') ? 0 : $this->session->userdata('id');
	}

	public function index()
	{
		$thisMonth = date('Y-m-d');
		// users
		$data['USERS_COUNT'] = $this->Crud->Count('customers', " `id` != '0'");
		$data['ACTIVE_USERS_COUNT'] = $this->Crud->Count('customers', " `is_active` = '1'");
		$data['ACTIVE_USERS_COUNT_TODAY'] = $this->Crud->Count('customers', " `joined_date` = '$thisMonth'");
		// products
		$data['PRODUCTS_COUNT'] = $this->Crud->Count('products', " `id` != '0'");
		$data['ACTIVE_PRODUCTS_COUNT_TODAY'] = $this->Crud->Count('products', " `added_date` = '$thisMonth'");
		$data['FEATURED_PRODUCTS'] = $this->Crud->Count('products', " `is_featured` = '1'");
		// recent customers
		$data['RECENT_CUSTOMERS'] = $this->Crud->Read('customers', " `is_active` = '1' ORDER BY `id` DESC LIMIT 7");
		// deliveries
		$today = date('Y-m-d');
		$data['SUCCESSFUL_DELIVERIES_TODAY'] = $this->Crud->Count('orders', " `current_status` = '3' AND `delivered_date` = '$today'");
		$data['SUCCESSFUL_DELIVERIES'] = $this->Crud->Count('orders', " `current_status` = '3'");
		$data['AWAITING_DELIVERIES'] = $this->Crud->Count('orders', " (`current_status` = '0' OR `current_status` = '1'' OR `current_status` = '2') AND `status` = '1'");
		// earned
		$earnerToday = $this->Crud->Read('orders', " `current_status` = '3' AND `delivered_date` = '$today'");
		$data['EARNED_TODAY'] = 0;
		foreach ($earnerToday as $key) {
			$data['EARNED_TODAY'] += $key->grand_total;
		}
		$earner = $this->Crud->Read('orders', " `current_status` = '3'");
		$data['EARNED'] = 0;
		$data['EXTRA_CHARGES'] = 0;
		foreach ($earner as $key) {
			$data['EARNED'] += $key->grand_total;
			$data['EXTRA_CHARGES'] += ($key->delivery_charge + $key->weight_charge);
		}

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
			$SalesData = $this->Crud->Read("orders", " `ordered_date` BETWEEN '$MonthStart' AND '$MonthEnd' AND `current_status` = '3'");
			foreach ($SalesData as $SalesKey) {
				$MonthlySales += $SalesKey->grand_total;
				$MonthlySales = number_format((float)$MonthlySales, 2, '.', '');
			}
			$sales[] = $MonthlySales;

			$CancelledData = $this->Crud->Read("orders", " `ordered_date` BETWEEN '$MonthStart' AND '$MonthEnd' AND `current_status` = '4' AND `rejected_by` = '0'");
			foreach ($CancelledData as $CancelledKey) {
				$MonthlyCancelled += $CancelledKey->grand_total;
				$MonthlyCancelled = number_format((float)$MonthlyCancelled, 2, '.', '');
			}
			$cancelled[] = $MonthlyCancelled;
		}
		$data['sales'] = $sales;
		$data['cancelled'] = $cancelled;
		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/nav');
		$this->load->view('admin/layouts/bar');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/layouts/footer');
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
