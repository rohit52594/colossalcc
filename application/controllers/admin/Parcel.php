<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parcel extends CI_Controller
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

        $this->load->library('encryption');

        if (!$this->session->userdata('id') || $this->session->userdata('role') != 'ADMIN') {

            redirect('admin/authentication/login');
        }
    }

    public function newParcels()
    {
        $data['TITLE'] = 'NEW PARCELS';
        $data['PARCELS'] = $this->Crud->Read('parcels', " `parcel_status` = '0' AND `branch_id` = `current_branch`");
        $data['BRANCHES'] = $this->Crud->Read('seller', " `is_active` = '1'");
        $data['DELIVERER'] = $this->Crud->Read('deliverers', " `is_active` = '1'");
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/layouts/nav');
        $this->load->view('admin/layouts/bar');
        $this->load->view('admin/parcels', $data);
        $this->load->view('admin/layouts/footer');
    }

    public function inTransit()
    {
        $data['TITLE'] = 'PARCELS IN TRNASIT';
        $data['PARCELS'] = $this->Crud->Read('parcels', " (`parcel_status` = '1' OR `parcel_status` = '2')");
        $data['BRANCHES'] = $this->Crud->Read('seller', " `is_active` = '1'");
        $data['DELIVERER'] = $this->Crud->Read('deliverers', " `is_active` = '1'");
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/layouts/nav');
        $this->load->view('admin/layouts/bar');
        $this->load->view('admin/parcels', $data);
        $this->load->view('admin/layouts/footer');
    }

    public function outForDeliveryParcel()
    {
        $data['TITLE'] = 'PARCELS OUT FOR DELIVERY';
        $data['PARCELS'] = $this->Crud->Read('parcels', " `parcel_status` = '3'");
        $data['BRANCHES'] = $this->Crud->Read('seller', " `is_active` = '1'");
        $data['DELIVERER'] = $this->Crud->Read('deliverers', " `is_active` = '1'");
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/layouts/nav');
        $this->load->view('admin/layouts/bar');
        $this->load->view('admin/parcels', $data);
        $this->load->view('admin/layouts/footer');
    }

    public function delivered()
    {
        $data['TITLE'] = 'DELIVERED PARCELS';
        $data['PARCELS'] = $this->Crud->Read('parcels', " `parcel_status` = '4");
        $data['BRANCHES'] = $this->Crud->Read('seller', " `is_active` = '1'");
        $data['DELIVERER'] = $this->Crud->Read('deliverers', " `is_active` = '1'");
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/layouts/nav');
        $this->load->view('admin/layouts/bar');
        $this->load->view('admin/parcels', $data);
        $this->load->view('admin/layouts/footer');
    }

    public function undelivered()
    {
        $data['TITLE'] = 'UNDELIVERED PARCELS';
        $data['PARCELS'] = $this->Crud->Read('parcels', " `parcel_status` = '5");
        $data['BRANCHES'] = $this->Crud->Read('seller', " `is_active` = '1'");
        $data['DELIVERER'] = $this->Crud->Read('deliverers', " `is_active` = '1'");
        $this->load->view('admin/layouts/header');
        $this->load->view('admin/layouts/nav');
        $this->load->view('admin/layouts/bar');
        $this->load->view('admin/parcels', $data);
        $this->load->view('admin/layouts/footer');
    }

    public function failedDelivery() {
        $referrer = basename($_SERVER['HTTP_REFERER']);
        $myId = $this->session->userdata('id');
        if (!$this->uri->segment(4)) {
            $this->session->set_flashdata('danger', "Tracking ID not found");
        } else {
            $trackingId = $this->uri->segment(4);
            $readData = $this->Crud->Read('parcels', " `tracking_id` = '$trackingId'");
            if ($readData[0]->current_branch == $myId) {
                $this->Crud->Update('parcels', array(
                    'deliverer_assigned' => null,
                    'parcel_status' => 5,
                    'parcel_delivery_attempt' => ++$readData[0]->parcel_delivery_attempt
                ), " `tracking_id` = '$trackingId'");
                $notification = "Delivery attempt failed your parcel.";
                $this->Crud->Create('transaction_history', array(
                    'tracking_id' => $trackingId,
                    'from_branch' => $myId,
                    'to_branch' => $myId,
                    'is_returning' => $readData[0]->parcel_status == 5 ? 1 : 0,
                    'dispatched_time' => time(),
                    'narration' => $notification
                ));
            } else {
                $this->session->set_flashdata('danger', "Tracking ID not found");
            }
        }
        redirect('admin/' . __CLASS__ . '/' . $referrer);
    }

    public function assignParcelToBranch()
    {
        $referrer = basename($_SERVER['HTTP_REFERER']);
        if (isset($_POST['branch'])) {
            $myId = $this->session->userdata('id');
            extract($_POST);
            $readData = $this->Crud->Read('parcels', " `tracking_id` = '$trackingId'");
            $branchData = $this->Crud->Read('seller', " `id` = '$myId'");
            $this->Crud->Update('parcels', array(
                'current_branch' => $branch,
                'parcel_status' => $this->Crud->Count('transaction_history', " `tracking_id` = '$trackingId'") < 1 ? 2 : 3
            ), " `tracking_id` = '$trackingId'");
            echo $branchData[0]->district;
            if ($readData[0]->destination_branch == $branch) {
                $notification = "Item reached to destination branch - " . $branchData[0]->district;
            } else {
                $notification = "Item reached to " . $branchData[0]->district . " branch";
            }
            $this->Crud->Create('transaction_history', array(
                'tracking_id' => $trackingId,
                'from_branch' => $myId,
                'to_branch' => $branch,
                'is_returning' => $readData[0]->parcel_status == 5 ? 1 : 0,
                'dispatched_time' => time(),
                'narration' => $notification
            ));
        }
        $this->session->set_flashdata('success', "Success");
        redirect('admin/' . __CLASS__ . '/' . $referrer);
    }

    public function outForDelivery()
    {
        $referrer = basename($_SERVER['HTTP_REFERER']);
        if (isset($_POST['deliverer'])) {
            $myId = $this->session->userdata('id');
            extract($_POST);
            echo $trackingId;
            $readData = $this->Crud->Read('parcels', " `tracking_id` = '$trackingId'");
            $branchData = $this->Crud->Read('seller', " `id` = '$myId'");
            $deliveryBoyData = $this->Crud->Read('deliverers', " `id` = '$deliverer'");
            $this->Crud->Update('parcels', array(
                'deliverer_assigned' => $deliverer,
                'parcel_status' => 3
            ), " `tracking_id` = '$trackingId'");
            $notification = "Item out for delivery from destination branch - " . $branchData[0]->district . ". Deliverer Details: " . $deliveryBoyData[0]->name . " - " . $deliveryBoyData[0]->phone;
            $this->Crud->Create('transaction_history', array(
                'tracking_id' => $trackingId,
                'from_branch' => $myId,
                'to_branch' => $myId,
                'is_returning' => $readData[0]->parcel_status == 5 ? 1 : 0,
                'dispatched_time' => time(),
                'narration' => $notification
            ));
        }
        $this->session->set_flashdata('success', "Success");
        redirect('admin/' . __CLASS__ . '/' . $referrer);
    }
}
