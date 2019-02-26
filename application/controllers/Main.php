<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public $_viewPath;
    public $_bannerImagePath;
    public $_projectImagePath;
    public $_galleryImagePath;
    public $_testEmailAddress;

    function __construct() {
        parent::__construct();

        $this->_viewPath = 'frontend/';
        $this->_bannerImagePath = 'assets/media/banners/';
        $this->_projectImagePath = 'assets/media/projects/';
        $this->_galleryImagePath = 'assets/media/gallery/';
        $this->_testEmailAddress = "sadia@technobd.com";
    }

    public function index() {
        $data = array();
        $data['pageTitle'] = "Welcome to " . $this->config->item('PROJECT_TITLE');
        $data['tabActive'] = "home";
        $data['isHome'] = TRUE;

        $data['banners'] = $this->global_model->getBannerImage();
        $data['getProjectHome'] = $this->global_model->getProjectDataHome();
        $data['boardOfDirectors'] = $this->global_model->getDirectors();

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'index', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function management() {
        $data = array();
        $data['pageTitle'] = "Welcome to " . $this->config->item('PROJECT_TITLE');
        $data['tabActive'] = "management";
        $data['isHome'] = TRUE;

        $data['boardOfDirectors'] = $this->global_model->getDirectors();
        $data['topManagement'] = $this->global_model->getTopManagement();

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'management', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function profile($id) {
        $data = array();
        $data['pageTitle'] = "Welcome to " . $this->config->item('PROJECT_TITLE');
        $data['tabActive'] = "management";
        $data['isHome'] = TRUE;

        $data['boardOfDirectors'] = $this->global_model->getMemberDetails($id);

        if (!$data['boardOfDirectors']) {
            show_404();
        }

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'team_details', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function about() {
        $data = array();
        $data['pageTitle'] = "Welcome to " . $this->config->item('PROJECT_TITLE');
        $data['tabActive'] = "about";
        $data['isHome'] = TRUE;

        $data['boardOfDirectors'] = $this->global_model->getDirectors();

        if (!$data['boardOfDirectors']) {
            show_404();
        }

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'about', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function project() {
        $data = array();
        $data['pageTitle'] = "Welcome to " . $this->config->item('PROJECT_TITLE');
        $data['tabActive'] = "project";
        $data['isHome'] = TRUE;

        $data['allProject'] = $this->global_model->getProjects();

        if (!$data['allProject']) {
            show_404();
        }

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'project', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function projectDetails($id) {
        $data = array();
        $data['pageTitle'] = "Welcome to " . $this->config->item('PROJECT_TITLE');
        $data['tabActive'] = "project";
        $data['isHome'] = TRUE;

        $data['projectDetails'] = $this->global_model->getProjectDetailsById($id);

        if (!$data['projectDetails']) {
            show_404();
        }

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'single_project', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function contactus() {
        $data = array();
        $data['pageTitle'] = "Contact us";
        $data['tabActive'] = "contactus";
        
        $address = array();
        $phone = array();
        $email = array();

        $data['getContact']=$getContact = $this->global_model->getContactUs();

        if (count($getContact)) {
            foreach ($getContact as $contact) {
                if ($contact->contact_address) {
                    $address[] = $contact->contact_address;
                }
                if ($contact->phone) {
                    $phone[] = $contact->phone;
                }
                if ($contact->email) {
                    $email[] = $contact->email;
                }
            }
        }
        $data['address'] = $address;
        $data['phone'] = $phone;
        $data['email'] = $email;

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'contact', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function gallery() {
        $data = array();
        $data['pageTitle'] = "Contact us";
        $data['tabActive'] = "gallery";

        $data['galleryList'] = $this->global_model->getGalleryList();

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'gallery', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function galleryDetails($id) {
        $data = array();
        $data['pageTitle'] = "Welcome to " . $this->config->item('PROJECT_TITLE');
        $data['tabActive'] = "gallery";
        $data['isHome'] = TRUE;

        $data['galleryDetails'] = $this->global_model->getAlbumInfo($id);

        if (!$data['galleryDetails']) {
            show_404();
        }

        $this->load->view($this->_viewPath . 'header', $data);
        $this->load->view($this->_viewPath . 'single_gallery', $data);
        $this->load->view($this->_viewPath . 'footer', $data);
    }

    public function sendContactRequest() {
        $resp = array();
        if ($this->input->post()) {
            $this->form_validation
                    ->set_rules('name', 'Name', 'trim|required')
                    ->set_rules('last_name', 'Last Name', 'trim|required')
                    ->set_rules('phone', 'Phone', 'trim|required')
//                    ->set_rules('email', 'Email', 'trim|required|valid_email')
                    ->set_rules('email', 'Email', 'trim|required')
                    ->set_rules('message', 'Message', 'trim|required')
            ;

            $this->form_validation->set_error_delimiters('', '</br>');
            if ($this->form_validation->run() == TRUE) {
                $fName = $this->input->post('name');
                $lName = $this->input->post('last_name');
                $data['email'] = $email = $this->input->post('email');
                $data['phone'] = $mobile = $this->input->post('phone');
                $data['message'] = $message = $this->input->post('message');
                $data['name'] = $name = $fName . ' ' . $lName;
                // email section
                $data['site_url'] = site_url();
                $data['logo_url'] = base_url('assets/frontend/img/logo.png');
                $data['project_title'] = $this->config->item('PROJECT_TITLE');

                // $data['to_email'] = $this->config->item('EMAIL_ADDRESS');
                $emSubject = "Contact E-Mail From " . $name . ' ( ' . $email . ' )';
//                $toEmail = $this->_testEmailAddress;
                $toEmail = array($this->_testEmailAddress);
                // $toEmail = $this->config->item('EMAIL_ADDRESS') . ',' . $this->_testEmailAddress;
                $htmlContent = $this->load->view('frontend/contact_mail_templates', $data, TRUE);
//                if (sendContactMail($toEmail, $emSubject, $htmlContent, $email, $name)) {
                if (mailSend($toEmail, $emSubject, $htmlContent,FALSE, $email, $name)) {
                    
                    $resp['status'] = 1;
                    $successMsg = "Thank you for your email, soon we will contact with you.";
                    $resp['message'] = $successMsg;
                    $resp['redirectUrl'] = site_url();
                } else {
                    $resp['status'] = 0;
                    $resp['message'] = 'Mail sending failed. Please try again later';
                }
            } else {
                $resp['status'] = 0;
                $resp['message'] = validation_errors();
            }
        }
        echo json_encode($resp);
    }

}
