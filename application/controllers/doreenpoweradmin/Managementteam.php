<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Managementteam extends CI_Controller {

    public $_module;
    public $_moduleName;
    public $_moduleImagePath;
    public $_viewPath;
    public $_getImageSize;

    function __construct() {
        parent::__construct();

        if (!loginCheck()) {
            $this->session->set_userdata('return_url', current_url()); // set the last visit page
            $this->session->set_flashdata('success_msg', 'Please Login First !!');
            redirect(admin_url('auth/login'));
        }

        $this->_getImageSize = array(
            'original' => array('width' => 471, 'height' => 470, 'crop' => FALSE, 'rgb' => 0xdad7d7),
            'thumbs' => array('width' => 250, 'height' => 280, 'crop' => FALSE, 'rgb' => 0xdad7d7),
        );
        // load the specific model
        $this->load->model('admin/managementteam_model', 'managementteam');
        // set global variable
        $this->_module = 'managementteam';
        $this->_moduleName = 'Management Team';
        $this->_moduleImagePath = 'assets/media/managementteam/';
        $this->_viewPath = 'admin/managementteam/';
        // load file processing library
        $this->load->library('file_processing');
    }

    public function index() {
        // set the page name
        $data['pageGroup'] = $this->_moduleName;
        $data['pageTitle'] = "Manage " . $this->_moduleName . ' : Board of Directors';
        $data['tabActive'] = "managementteam";
        $data['subTabActive'] = $this->_module . "_director";

        $data['allData'] = $this->managementteam->getAll(array('type' => 'director'));
        // load the views
        $data['required_contents'] = $this->load->view($this->_viewPath . 'manage', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function member() {
        // set the page name
        $data['pageGroup'] = $this->_moduleName;
        $data['pageTitle'] = "Manage " . $this->_moduleName . ' : Top Management';
        $data['tabActive'] = $this->_module;
        $data['subTabActive'] = $this->_module . "_member";

        $data['allData'] = $this->managementteam->getAll(array('type' => 'member'));
        // load the views
        $data['required_contents'] = $this->load->view($this->_viewPath . 'manage', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function update($id = false) {
        // set the page name
        $data['pageGroup'] = $this->_moduleName;
        $data['pageTitle'] = "Manage " . $this->_moduleName;

        $data['team_id'] = $id;
        $data['tabActive'] = $this->_module;
        $data['subTabActive'] = $this->_module . "_add";

        if ($teamList = $this->managementteam->getSingleInfo($id)) {
            $data['team_list'] = $teamList;
        }
        //add
        if ($this->input->post('submit')) {
            if ($id) {
                $data = $this->edit($id);
            } else {
                $data = $this->add();
            }
        }
        // load the views
        $data['required_contents'] = $this->load->view($this->_viewPath . 'create', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    // create new information
    private function add() {
        $data = array();
        $data['team_id'] = '';
        
        if ($this->input->post('submit')) {
            // write the validation rule
            $this->form_validation
                    ->set_rules('name', 'Name', 'trim|required')
                    ->set_rules('type', 'Type', 'trim|required')
                    ->set_rules('designation', 'Designation', 'trim|required')
                    ->set_rules('education', 'Education', 'trim')
                    ->set_rules('description', 'Description', 'trim')
                    ->set_rules('team_image', 'Photo', 'callback_file_validate[yes.team_image.jpg,gif,png]')
                    ->set_rules('facebook', 'Facebook ID', 'trim')
                    ->set_rules('twitter', 'Twitter ID', 'trim')
                    ->set_rules('google', 'Google ID', 'trim')
                    ->set_rules('skype', 'Skype ID', 'trim')
                    ->set_rules('linkedin', 'Linkedin ID', 'trim')
                    ->set_rules('status', 'Status', 'trim')
            ;

            $this->form_validation->set_error_delimiters('<br>', '');
            // check the validation
            if ($this->form_validation->run()) {
                $addData['name'] = $this->input->post('name');
                $addData['type'] = $this->input->post('type');
                $addData['designation'] = $this->input->post('designation');
                $addData['education'] = $this->input->post('education');
                $addData['description'] = $this->input->post('description');
                $addData['facebook'] = $this->input->post('facebook') ? $this->input->post('facebook') : NULL;
                $addData['twitter'] = $this->input->post('twitter') ? $this->input->post('twitter') : NULL;
                $addData['google'] = $this->input->post('google') ? $this->input->post('google') : NULL;
                $addData['skype'] = $this->input->post('skype') ? $this->input->post('skype') : NULL;
                $addData['linkedin'] = $this->input->post('linkedin') ? $this->input->post('linkedin') : NULL;
                $addData['status'] = $this->input->post('status') ? $this->input->post('status') : 'active';
                // upload photo
                $imageName = time();
                $photo = $this->file_processing->image_upload('team_image', './' . $this->_moduleImagePath . 'original/', 'size[1600,9999]', 'jpg|jpeg|png|gif', $imageName);
                if (!is_array($photo)) {
                    $initPath = './' . $this->_moduleImagePath . 'original/' . $photo; // original
                    $mainPath = './' . $this->_moduleImagePath . $photo; // main image path
                    $thumbsPath = './' . $this->_moduleImagePath . 'thumbs/' . $photo; // thumbs path
                    // resizing the image
                    img_resize($initPath, $mainPath, $this->_getImageSize['original']); // main path image
                    img_resize($initPath, $thumbsPath, $this->_getImageSize['thumbs']); // resize with thumbs

                    $addData['image_name'] = $photo ? $photo : '';
                    $addData['created_datetime'] = date('Y-m-d H:i:s');

                    if ($this->managementteam->create($addData)) {
                        $this->session->set_flashdata('success_msg', 'New Informaton Added Successfully.');
                        redirect(admin_url($this->_module));
                    } else {
                        $data['error'] = mysql_error();
                    }
                } else {
                    $data['error'] = 'Select proper image';
                }
            } else {
                $data['error'] = validation_errors();
            }
        }

        return $data;
    }

    private function edit($id) {

        $data = array();
        $data['single_info'] = $this->managementteam->getSingleInfo($id);

        if ($this->input->post('submit')) {
            // write the validation rule
            $this->form_validation
                    ->set_rules('name', 'Name', 'trim|required')
                    ->set_rules('designation', 'Designation', 'trim|required')
                    ->set_rules('description', 'Description', 'trim')
                    ->set_rules('education', 'Education', 'trim')
                    ->set_rules('facebook', 'Facebook ID', 'trim')
                    ->set_rules('twitter', 'Twitter ID', 'trim')
                    ->set_rules('google', 'Google ID', 'trim')
                    ->set_rules('skype', 'Skype ID', 'trim')
                    ->set_rules('linkedin', 'Linkedin ID', 'trim')
                    ->set_rules('status', 'Status', 'trim|required');

            if (isset($_FILES["team_image"]["name"]) && !empty($_FILES["team_image"]["name"])) {
                $this->form_validation->set_rules('team_image', 'Image', 'callback_file_validate[yes.team_image.jpg,gif,png]');
            }
            $this->form_validation->set_rules('status', 'Status', 'trim');
            $this->form_validation->set_error_delimiters('<br>', '');
            // check the validation
            if ($this->form_validation->run()) {

                $addData['name'] = $this->input->post('name');
                $addData['type'] = $this->input->post('type');
                $addData['designation'] = $this->input->post('designation');
                $addData['education'] = $this->input->post('education');
                $addData['description'] = $this->input->post('description');
                $addData['facebook'] = $this->input->post('facebook');
                $addData['twitter'] = $this->input->post('twitter');
                $addData['google'] = $this->input->post('google');
                $addData['skype'] = $this->input->post('skype');
                $addData['linkedin'] = $this->input->post('linkedin');
                $addData['status'] = $this->input->post('status');
                $addData['modified_datetime'] = date('Y-m-d H:i:s');

                if (isset($_FILES["team_image"]["name"]) && $_FILES["team_image"]["name"]) {
                    // delete all image 
                    if (!empty($data['single_info']->image_name)) {
                        if (file_exists($this->_moduleImagePath . $data['single_info']->image_name)) {
                            
                            if (file_exists($this->_moduleImagePath . $data['single_info']->image_name)) {
                                unlink($this->_moduleImagePath . $data['single_info']->image_name);
                            }

                            if (file_exists($this->_moduleImagePath . 'original/' . $data['single_info']->image_name)) {
                                unlink($this->_moduleImagePath . 'original/' . $data['single_info']->image_name);
                            }

                            if (file_exists($this->_moduleImagePath . 'thumbs/' . $data['single_info']->image_name)) {
                                unlink($this->_moduleImagePath . 'thumbs/' . $data['single_info']->image_name);
                            }
                        }
                    }
                    // upload photo
                    $imageName = time();
                    $addData['image_name'] = $photo = $this->file_processing->image_upload('team_image', './' . $this->_moduleImagePath . 'original/', 'size[1600, 9999]', 'jpg|jpeg|png|gif', $imageName);

                    $initPath = './' . $this->_moduleImagePath . 'original/' . $photo; // original
                    $mainPath = './' . $this->_moduleImagePath . $photo; // main image path
                    $thumbsPath = './' . $this->_moduleImagePath . 'thumbs/' . $photo; // thumbs path
                    // resizing the image
                    img_resize($initPath, $mainPath, $this->_getImageSize['original']); // main path image
                    img_resize($initPath, $thumbsPath, $this->_getImageSize['thumbs']); // resize with thumbs
                }
                if ($this->managementteam->update($addData, $id)) {
                    $this->session->set_flashdata('success_msg', 'Information Updated Successfully.');
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

    public function view($id) {

        $data = array();
        $data['get_info'] = $this->managementteam->getSingleInfo($id);
        $data['pageTitle'] = "View of " . $data['get_info']->name;
        $data['tabActive'] = $this->_module;
        $data['subTabActive'] = $this->_module . "_view";

        //Check data
        if (empty($data['get_info'])) {
            $this->session->set_flashdata('error_msg', 'No data found!!');
            redirect($this->_module);
        }

        // load the views
        $data['required_contents'] = $this->load->view($this->_viewPath . 'view', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    // delete the specific record based on ID
    public function delete($id) {

        // delete the record from database
        if ($info = $this->managementteam->getSingleInfo($id)) {
            if ($this->managementteam->delete($id)) {
                if ($info->image_name) {
                    if (file_exists($this->_moduleImagePath . $info->image_name)) {
                        unlink($this->_moduleImagePath . $info->image_name);
                        unlink($this->_moduleImagePath . 'original/' . $info->image_name);
                        unlink($this->_moduleImagePath . 'thumbs/' . $info->image_name);

                        if (file_exists($this->_moduleImagePath . $info->image_name)) {
                            unlink($this->_moduleImagePath . $info->image_name);
                        }

                        if (file_exists($this->_moduleImagePath . 'original/' . $info->image_name)) {
                            unlink($this->_moduleImagePath . 'original/' . $info->image_name);
                        }

                        if (file_exists($this->_moduleImagePath . 'thumbs/' . $info->image_name)) {
                            unlink($this->_moduleImagePath . 'thumbs/' . $info->image_name);
                        }
                    }
                }
                $this->session->set_flashdata('success_msg', 'Information Deleted Successfully !!');
            }
        }
        redirect(admin_url($this->_module));
    }

    // file validation
    public function file_validate($fieldValue, $params) {
        // get the parameter as variable
        list($require, $fieldName, $type) = explode('.', $params);
        // get the file field name
        $filename = $_FILES[$fieldName]['name'];
        if ($filename == '' && $require == 'yes') {
            $this->form_validation->set_message('file_validate', 'The %s field is required');
            return FALSE;
        } else if ($type != '' && $filename != '') {
            // get the extention
            $ext = strtolower(substr(strrchr($filename, '.'), 1));
            // get the type as array
            $types = explode(',', $type);
            if (!in_array($ext, $types)) {
                $this->form_validation->set_message('file_validate', 'The %s field must be ' . implode(' OR ', $types) . ' !!');
                return FALSE;
            }
        } else {
            return TRUE;
        }
    }

}

/* End of file Managementteam.php */
/* Location: ./application/controllers/doreenpoweradmin/Managementteam.php */