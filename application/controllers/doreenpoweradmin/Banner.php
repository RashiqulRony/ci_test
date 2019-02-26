<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

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
            'original' => array('width' => 1600, 'height' => 590, 'crop' => FALSE),
            'thumbs' => array('width' => 951, 'height' => 634, 'crop' => FALSE),
        );

        // load the specific model
        $this->load->model('admin/banner_model', 'banner');

        // set global variable
        $this->_module = 'banner';
        $this->_moduleName = 'Banner';
        $this->_moduleImagePath = 'assets/media/banners/';
        $this->_viewPath = 'admin/banners/';

        // load file processing library
        $this->load->library('file_processing');
    }

    public function index($id = false) {
        // set the page name
        $data['pageGroup'] = $this->_moduleName;
        $data['pageTitle'] = "Manage " . $this->_moduleName;

        $data['banner_id'] = $id;
        $data['tabActive'] = $data['subTabActive'] = "banner";

        if ($id && ($banner = $this->banner->getSingleInfo($id))) {
            $data['banner'] = $banner;
        }

        //add banner image
        if ($this->input->post('submit')) {
            if ($id) {
                $data = $this->edit($id);
            } else {
                $data = $this->add();
            }
        }

        // get the all information

        $data['allData'] = $this->banner->getAll();
        // load the views
        $data['required_contents'] = $this->load->view($this->_viewPath . 'manage', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    // create new information
    public function add() {

        $data = array();
        if ($this->input->post('submit')) {
            // write the validation rule
            $this->form_validation
                    ->set_rules('title', 'Title', 'trim|required')
                    ->set_rules('sub_title', 'Sub Title', 'trim|required')
                    ->set_rules('description', 'Description', 'trim')
                    ->set_rules('banner_image', 'Banner Image', 'callback_file_validate[yes.banner_image.jpg,gif,png]')
                    ->set_rules('status', 'Status', 'trim');

            $this->form_validation->set_error_delimiters('<br>', '');
            // check the validation
            if ($this->form_validation->run()) {
                $addData['title'] = $this->input->post('title');
                $addData['sub_title'] = $this->input->post('sub_title');
                $addData['description'] = $this->input->post('description');
                $addData['status'] = $this->input->post('status') ? $this->input->post('status') : 1;
                // upload photo
                $imageName = time();
                $photo = $this->file_processing->image_upload('banner_image', './' . $this->_moduleImagePath . 'original/', 'size[1600,9999]', 'jpg|jpeg|png|gif', $imageName);
                $initPath = './' . $this->_moduleImagePath . 'original/' . $photo; // original
                $mainPath = './' . $this->_moduleImagePath . $photo; // main image path
                $thumbsPath = './' . $this->_moduleImagePath . 'thumbs/' . $photo; // thumbs path
                // resizing the image
                img_resize($initPath, $mainPath, $this->_getImageSize['original']); // main path image
                img_resize($initPath, $thumbsPath, $this->_getImageSize['thumbs']); // resize with thumbs

                $addData['image_name'] = $photo ? $photo : '';
                $addData['created'] = date('Y-m-d H:i:s');

                if ($this->banner->create($addData)) {
                    $this->session->set_flashdata('success_msg', 'New Banner Image Added Successfully !!');
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

    public function edit($id) {

        $data = array();
        $data['banner'] = $banner = $this->banner->getSingleInfo($id);

        if ($this->input->post('submit')) {
            // write the validation rule
            $this->form_validation
                    ->set_rules('title', 'Title', 'trim')
                    ->set_rules('sub_title', 'Sub Title', 'trim')
                    ->set_rules('description', 'Description', 'trim')
            ;

            if (isset($_FILES["banner_image"]["name"]) && !empty($_FILES["banner_image"]["name"])) {
                $this->form_validation->set_rules('banner_image', 'Image', 'callback_file_validate[yes.banner_image.jpg,gif,png]');
            }

            $this->form_validation->set_rules('status', 'Status', 'trim');
            $this->form_validation->set_error_delimiters('<br>', '');

            // check the validation
            if ($this->form_validation->run()) {

                $addData['title'] = $this->input->post('title') ? $this->input->post('title') : $banner->title;
                $addData['sub_title'] = $this->input->post('sub_title') ? $this->input->post('sub_title') : $banner->sub_title;
                $addData['description'] = $this->input->post('description') ? $this->input->post('description') : $banner->description;
                $addData['status'] = $this->input->post('status') ? $this->input->post('status') : $banner->status;

                if (isset($_FILES["banner_image"]["name"]) && $_FILES["banner_image"]["name"]) {
                    // delete all image 
                    if (!empty($banner->image_name)) {
                        if (file_exists($this->_moduleImagePath . $banner->image_name)) {
                            
                            if (file_exists($this->_moduleImagePath . $banner->image_name)) {
                                unlink($this->_moduleImagePath . $banner->image_name);
                            }

                            if (file_exists($this->_moduleImagePath . 'original/' . $banner->image_name)) {
                                unlink($this->_moduleImagePath . 'original/' . $banner->image_name);
                            }

                            if (file_exists($this->_moduleImagePath . 'thumbs/' . $banner->image_name)) {
                                unlink($this->_moduleImagePath . 'thumbs/' . $banner->image_name);
                            }
                        }
                    }
                    // upload photo
                    $imageName = time();
                    $addData['image_name'] = $photo = $this->file_processing->image_upload('banner_image', './' . $this->_moduleImagePath . 'original/', 'size[1600, 9999]', 'jpg|jpeg|png|gif', $imageName);

                    $initPath = './' . $this->_moduleImagePath . 'original/' . $photo; // original
                    $mainPath = './' . $this->_moduleImagePath . $photo; // main image path
                    $thumbsPath = './' . $this->_moduleImagePath . 'thumbs/' . $photo; // thumbs path
                    // resizing the image
                    img_resize($initPath, $mainPath, $this->_getImageSize['original']); // main path image
                    img_resize($initPath, $thumbsPath, $this->_getImageSize['thumbs']); // resize with thumbs
                }
                if ($this->banner->update($addData, $id)) {
                    $this->session->set_flashdata('success_msg', 'Banner Updated Successfully!!');
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
        // delete the record from database
        if ($info = $this->banner->getSingleInfo($id)) {
            if ($this->banner->delete($id)) {
                if ($info->image_name) {
                    if (file_exists($this->_moduleImagePath . $info->image_name)) {
                        unlink($this->_moduleImagePath . $info->image_name);
                        unlink($this->_moduleImagePath . 'original/' . $info->image_name);
                        unlink($this->_moduleImagePath . 'thumbs/' . $info->image_name);
                    }
                }
                $this->session->set_flashdata('success_msg', 'Item Deleted Successfully !!');
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

/* End of file Banner.php */
/* Location: ./application/controllers/doreenadmin/Banner.php */