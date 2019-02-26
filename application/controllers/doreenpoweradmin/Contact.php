<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public $_module_name;
    public $_module;

    function __construct() {
        parent::__construct();

        if (!loginCheck()) {
            $this->session->set_userdata('return_url', current_url()); // set the last visit page
            $this->session->set_flashdata('success_msg', 'Please Login First !!');
            redirect(admin_url('auth/login'));
        }

        // load the specific model
        $this->load->model('admin/contact_model', 'contact');

        // set the global variable
        $this->_module_name = 'Contact';
        $this->_module = 'contact';
    }

    // manage all information
    public function index($id = false) {

        // set the page name
        $data['module'] = $this->_module;
        $data['pageGroup'] = $this->_module_name;
        $data['pageTitle'] = "Manage " . $this->_module_name;
        $data['tabActive'] = "contact";
        $data['subTabActive'] = "contact";

        $data['contact_id'] = $id;
        if ($id && ($contact = $this->contact->getSingleInfo($id))) {
            $data['contact'] = $contact;
        }
        //add banner image
        if ($this->input->post('submit')) {

            if ($id) {
                $data = $this->edit($id);
            } else {
                $data = $this->create();
            }
        }

        // get the all information
        $data['allData'] = $this->contact->getAll();

        // load the views
        $data['required_contents'] = $this->load->view('admin/contact/manage', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    // create new information
    public function create() {

        $data = array();
        if ($this->input->post('submit')) {
            // write the validation rule
            $this->form_validation
                    ->set_rules('contact_title', 'Contact Title', 'trim')
                    ->set_rules('office_type', 'Office Type', 'trim|required')
                    ->set_rules('contact_address', 'Contact Address', 'trim|required')
                    ->set_rules('phone', 'Phone', 'trim|required')
                    ->set_rules('email', 'Email', 'trim|required')
                    ->set_rules('lat', 'Latitude', 'trim|required')
                    ->set_rules('lon', 'Longitude', 'trim|required')
                    ->set_rules('status', 'Status', 'trim|required');

            // check the validation
            if ($this->form_validation->run()) {

                $addData['contact_title'] = $this->input->post('contact_title');
                $addData['contact_address'] = $this->input->post('contact_address');
                $addData['office_type'] = $this->input->post('office_type');
                $addData['phone'] = $this->input->post('phone');
                $addData['email'] = $this->input->post('email');
                $addData['lat'] = $this->input->post('lat');
                $addData['lon'] = $this->input->post('lon');
                $addData['status'] = $this->input->post('status');
                $addData['created'] = date('Y-m-d H:i:s');

                if ($this->contact->create($addData)) {
                    $this->session->set_flashdata('success_msg', 'New Contact Add Successfully!!');
                    redirect(admin_url($this->_module));
                } else {
                    $data['error'] = mysql_error();
                }
            } else {
                $data['error'] = validation_errors();
            }
        }

        return $data;
    }

    // admin panel add new course type
    public function edit($id) {

        $data = array();
        $contact = $this->contact->getSingleInfo($id);

        if ($this->input->post('submit')) {
            // write the validation rule
            $this->form_validation
                    ->set_rules('contact_title', 'Contact Title', 'trim|required')
                    ->set_rules('office_type', 'Office Type', 'trim|required')
                    ->set_rules('contact_address', 'Contact Address', 'trim|required')
                    ->set_rules('phone', 'Phone', 'trim|required')
                    ->set_rules('email', 'Email', 'trim|required')
                    ->set_rules('lat', 'Latitude', 'trim|required')
                    ->set_rules('lon', 'Longitude', 'trim|required')
                    ->set_rules('status', 'Status', 'trim|required');
            // check the validation
            if ($this->form_validation->run()) {

                $addData['contact_title'] = $this->input->post('contact_title');
                $addData['contact_address'] = $this->input->post('contact_address');
                $addData['office_type'] = $this->input->post('office_type');
                $addData['phone'] = $this->input->post('phone');
                $addData['email'] = $this->input->post('email');
                $addData['lat'] = $this->input->post('lat');
                $addData['lon'] = $this->input->post('lon');
                $addData['status'] = $this->input->post('status');
                $addData['modified'] = date('Y-m-d H:i:s');

                // call the crate model and inset into database
                if ($this->contact->update($addData, $id)) {
                    $this->session->set_flashdata('success_msg', 'Contact Update Successfully!!');
                    redirect(admin_url($this->_module));
                } else {
                    $data['error'] = mysql_error();
                }
            } else {
                $data['error'] = validation_errors();
            }
        }

        return $data;
    }

    // delete the specific record based on ID
    public function delete($id) {

        if ($this->contact->delete($id)) {
            $this->session->set_flashdata('success_msg', 'Item Deleted Successfully !!');
            redirect(admin_url($this->_module));
        }
    }

    public function getLatLongByAddress() {

        /**
         * Author: Raqibul Hasan Moon
         * Author Email: rhmoon21@gmail.com
         * Function Name: getLatLongByAddress()
         * $address => Full address.
         * Return => Latitude and longitude of the given address.
         * */
        $address = $this->input->post('address');
        if (!empty($address)) {

            $data = array();

            //Formatted address
            $formattedAddr = str_replace(' ', '+', $address);
            //Send request and receive json data by address
            $googleMapApiAddress = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $formattedAddr . "&sensor=false";
            // $geocodeFromAddr = file_get_contents($googleMapApiAddress); 
            $geocodeFromAddr = @file_get_contents($googleMapApiAddress);

            $output = json_decode($geocodeFromAddr);
            if ($output === null && json_last_error() !== JSON_ERROR_NONE) {

                $data['status'] = 0;
                $data['message'] = "Unable get Latitude or Longitude.";
                echo json_encode($data);
//                exit;
            }

            if (!empty($output->results[0])) {
                //Get latitude and longitute from json data
                $latitude = $output->results[0]->geometry->location->lat;
                $longitude = $output->results[0]->geometry->location->lng;
            }

            //Return latitude and longitude of the given address
            if (!empty($latitude) && !empty($longitude)) {

                $data['status'] = 1;
                $data['latitude'] = !empty($latitude) ? $latitude : "";
                $data['longitude'] = !empty($longitude) ? $longitude : "";
            } else {
                $data['status'] = 0;
                $data['message'] = "Unable get Lat or Long By Address.";
            }

            echo json_encode($data);
        } else {
            $data['status'] = 0;
            $data['error'] = "Please Provide valid address to get Lat & Long!";
        }
    }

}

/* End of file Contact.php */
/* Location: ./application/controllers/admin/Contact.php */