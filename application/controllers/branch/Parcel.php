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
        $this->load->helper('sms');

        $this->load->library('form_validation');

        if (!$this->session->userdata('id') || $this->session->userdata('role') != 'SELLER') {

            redirect('branch/authentication/login');
        }
    }

    public function getParcel()
    {

        if (isset($_POST['submit'])) {
            extract($_POST);
            $trackingId = trackingIdGenerate(8);
            if ($this->Crud->Create('parcels', array(
                'tracking_id' => $trackingId,
                'branch_id' => $this->session->userdata('id'),
                'current_branch' => $this->session->userdata('id'),
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
                $this->session->set_flashdata('success', "Parcel added to list. Tracking Id: #" . $trackingId);
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

    public function availableParcels()
    {
        $myId = $this->session->userdata('id');
        $data['PARCELS'] = $this->Crud->Read('parcels', " `current_branch` = '$myId' AND `deliverer_assigned` IS NULL AND (`parcel_status` != '4' OR `parcel_status` != '3')");
        $data['BRANCHES'] = $this->Crud->Read('seller', " `is_active` = '1' AND `id` != '$myId'");
        $data['DELIVERER'] = $this->Crud->Read('deliverers', " `is_active` = '1' AND `branch_code` = '$myId'");
        $this->load->view('branch/layouts/header');
        $this->load->view('branch/layouts/nav');
        $this->load->view('branch/layouts/bar');
        $this->load->view('branch/parcel/availableParcels', $data);
        $this->load->view('branch/layouts/footer');
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
        redirect('branch/' . __CLASS__ . '/' . $referrer);
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
        redirect('branch/' . __CLASS__ . '/' . $referrer);
    }

    public function outForDeliveryParcels()
    {
        $myId = $this->session->userdata('id');
        $data['PARCELS'] = $this->Crud->Read('parcels', " `current_branch` = '$myId' AND `deliverer_assigned` IS NOT NULL AND `parcel_status` = '3'");
        $data['BRANCHES'] = $this->Crud->Read('seller', " `is_active` = '1' AND `id` != '$myId'");
        $data['DELIVERER'] = $this->Crud->Read('deliverers', " `is_active` = '1' AND `branch_code` = '$myId'");
        $this->load->view('branch/layouts/header');
        $this->load->view('branch/layouts/nav');
        $this->load->view('branch/layouts/bar');
        $this->load->view('branch/parcel/outForDeliveryParcels', $data);
        $this->load->view('branch/layouts/footer');
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
        redirect('branch/' . __CLASS__ . '/' . $referrer);
    }


}
