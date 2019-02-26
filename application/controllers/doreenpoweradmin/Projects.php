<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

    public $_module;
    public $_viewPath;
    public $_moduleName;
    public $_getImageSize;
    public $_moduleImagePath;
    public $_setImageLimit;
    public $_fileName;

    function __construct() {
        parent::__construct();

        if (!loginCheck()) {
            $this->session->set_userdata('return_url', current_url()); // set the last visit page
            $this->session->set_flashdata('success_msg', 'Please Login First !!');
            redirect(admin_url('auth/login'));
        }

        $this->_getImageSize = array(
            'image_original' => array('width' => 1920, 'height' => 1200, 'crop' => FALSE, 'rgb' => 0xdad7d7),
            'image_bg' => array('width' => 2250, 'height' => 1500, 'crop' => FALSE, 'rgb' => 0xdad7d7),
            'image_thumbs' => array('width' => 350, 'height' => 364, 'crop' => TRUE, 'rgb' => 0xdad7d7),
            'image_featured' => array('width' => 801, 'height' => 422, 'crop' => FALSE, 'rgb' => 0xdad7d7),
            'image_small' => array('width' => 450, 'height' => 600, 'crop' => TRUE, 'rgb' => 0xdad7d7),
            'logo' => array('width' => 370, 'height' => 300, 'crop' => FALSE, 'rgb' => 0xdad7d7),
        );

        $this->_module = 'projects';
        $this->_moduleName = 'Project';
        $this->_viewPath = 'admin/projects/';
        $this->_moduleImagePath = 'assets/media/projects/';
        $this->_setImageLimit = 10240;
        $this->_fileName = time();

        $this->load->library('file_processing');
        $models = array(
            'admin/Projects_model' => 'projects_model',
        );
        $this->load->model($models);
    }

    public function index($id = false) {

        // set the page name
        $data = array();
        $data['pageTitle'] = "Manage " . $this->_moduleName;
        $data['moduleImagePath'] = $this->_moduleImagePath;
        $data['tabActive'] = $this->_module;
        $data['subTabActive'] = $this->_module . "_manage";

        // get the all information
        $data['allData'] = $this->projects_model->getAllProjectData();

        // load the views
        $data['required_contents'] = $this->load->view($this->_viewPath . 'manage', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function add() {

        $data = array();
        $data['tabActive'] = $this->_module;
        $data['subTabActive'] = $this->_module . "_add";

        if ($this->input->post('submit')) {

            $this->form_validation
                    ->set_rules('project_title', 'project title', 'trim|required')
                    ->set_rules('project_description', 'project description', 'trim|required')
                    ->set_rules('project_logo', 'Project Logo', 'callback_file_validate[yes.project_logo.jpg,jpeg,gif,png]')
                    ->set_rules('project_images', 'Project Images', 'callback_file_validate[yes.project_images.jpg,jpeg,gif,png]')
            ;

            if ($this->form_validation->run()) {
                $addData = array();
                $addData['project_title'] = $this->input->post('project_title');
                $addData['project_description'] = $this->input->post('project_description');

                $imageLogoName = time();
                $photo = $this->file_processing->image_upload('project_logo', './' . $this->_moduleImagePath . 'original/', 'size[300,300]', 'jpg|jpeg|png|gif', $imageLogoName);

                $initPath = './' . $this->_moduleImagePath . 'original/' . $photo; // original
                $logoPath = './' . $this->_moduleImagePath . 'logo/' . $photo; // logo path
                // resizing the image
                img_resize($initPath, $logoPath, $this->_getImageSize['logo']); // resize with logo

                $addData['project_logo'] = $photo;
                $addData['created_at'] = date('Y-m-d H:i:s');

                if ($this->projects_model->create($addData)) {
                    $typeId = $this->db->insert_id();

                    if ($this->multiplePhotoUpload('project_images', $typeId)) {
                        $this->session->set_flashdata('success_msg', 'New ' . $this->_moduleName . ' added successfully !');
                        redirect(admin_url($this->_module));
                    }
                } else {
                    $data['error'] = mysql_error();
                }
            } else {
                $data['error'] = validation_errors();
            }
        }
        $data['required_contents'] = $this->load->view($this->_viewPath . 'create', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function update($id = false) {

        $data = array();
        $data['tabActive'] = $this->_module;
        $data['subTabActive'] = $this->_module . "_manage";

        $data['allData'] = $allData = $this->projects_model->getSingleInfo($id);
        $data['photos'] = $photos = $this->global_model->get('media', array('type_id' => $id, 'type' => $this->_module));

        if ($this->input->post('submit')) {

            $this->form_validation
                    ->set_rules('project_title', 'Project Title', 'trim')
                    ->set_rules('project_description', 'Project Description', 'trim')
                    ->set_rules('project_logo', 'Project Logo', 'callback_file_validate[no.project_logo.jpg,jpeg,gif,png]')
                    ->set_rules('project_images', 'Project Images', 'callback_file_validate[no.project_images.jpg,jpeg,gif,png]')
                    ->set_rules('project_status', 'Project Status', 'trim')
            ;
            // check the validation
            if ($this->form_validation->run()) {
                $addData = array();
                $addData['project_title'] = $this->input->post('project_title') ? $this->input->post('project_title') : $allData->project_title;
                $addData['project_description'] = $this->input->post('project_description') ? $this->input->post('project_description') : $allData->project_description;
                $addData['project_status'] = $this->input->post('project_status') ? $this->input->post('project_status') : $allData->project_status;

                if (isset($_FILES["project_logo"]["name"]) && $_FILES["project_logo"]["name"]) {
                    // delete all image 
                    if (!empty($allData->project_logo)) {
                        if (file_exists($this->_moduleImagePath . 'original/' . $allData->project_logo)) {

                            if (file_exists($this->_moduleImagePath . 'original/' . $allData->project_logo)) {
                                unlink($this->_moduleImagePath . 'original/' . $allData->project_logo);
                            }

                            if (file_exists($this->_moduleImagePath . 'logo/' . $allData->project_logo)) {
                                unlink($this->_moduleImagePath . 'logo/' . $allData->project_logo);
                            }
                        }
                    }
                    // upload photo
                    $imageLogoName = time();
                    $addData['project_logo'] = $photo = $this->file_processing->image_upload('project_logo', './' . $this->_moduleImagePath . 'original/', 'size[1600, 9999]', 'jpg|jpeg|png|gif', $imageLogoName);
                    $initPath = './' . $this->_moduleImagePath . 'original/' . $photo; // original
                    $logoPath = './' . $this->_moduleImagePath . 'logo/' . $photo; // main image path
                    // resizing the image
                    img_resize($initPath, $logoPath, $this->_getImageSize['logo']); // resize with logo
                }
                $addData['modified_at'] = date('Y-m-d H:i:s');
                $cover = $this->input->post('is_home');
                if (!empty($cover)) {
                    // update is_home value to zero and where type id is current product
                    $this->global_model->update('media', array('is_home' => 0), array('type_id' => $id, 'type' => $this->_module));
                    // then again update is_home with new id
                    $coverData = array(
                        'is_home' => 1,
                    );
                    $this->global_model->update('media', $coverData, array('id' => $cover, 'type_id' => $id, 'type' => $this->_module));
                }

                if ($this->projects_model->update($addData, $id)) {
                    if (array_filter($_FILES['project_images']['name'])) { // for new image upload from update
                        $this->multiplePhotoUploadForUpdate('project_images', $id);
                    }
                    $this->session->set_flashdata('success_msg', 'Updated Successfully !');
                    redirect(admin_url($this->_module));
                }
            } else {
                $data['error'] = validation_errors();
            }
        }
        $data['required_contents'] = $this->load->view($this->_viewPath . 'update', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function view($id) {

        $data = array();
        $data['get_info'] = $this->projects_model->getSingleProjectData($id);
        $data['pageTitle'] = "View of " . $data['get_info']->project_title;
        $data['tabActive'] = $this->_module;
        $data['subTabActive'] = $this->_module . "_manage";

        //Check data
        if (empty($data['get_info'])) {
            $this->session->set_flashdata('error_msg', 'No data found!!');
            redirect($this->_module);
        }

        // load the views
        $data['required_contents'] = $this->load->view($this->_viewPath . 'view', $data, TRUE);
        $this->load->view('admin/admin_master', $data);
    }

    public function delete($id) {
        // get the specfic record item
        $allPhotos = $this->global_model->get('media', array('type_id' => $id, 'type' => $this->_module));
        if (!empty($allPhotos)) {
            foreach ($allPhotos as $photo) {
                // delete the record from database
                if ($photo->images) {
                    if ($this->global_model->delete('media', array('id' => $photo->id, 'type' => $this->_module))) {
                        if (file_exists($this->_moduleImagePath . $photo->images)) {
                            unlink($this->_moduleImagePath . $photo->images);
                        }

                        if (file_exists($this->_moduleImagePath . 'original/' . $photo->images)) {
                            unlink($this->_moduleImagePath . 'original/' . $photo->images);
                        }

                        if (file_exists($this->_moduleImagePath . 'thumbs/' . $photo->images)) {
                            unlink($this->_moduleImagePath . 'thumbs/' . $photo->images);
                        }

                        if (file_exists($this->_moduleImagePath . 'small/' . $photo->images)) {
                            unlink($this->_moduleImagePath . 'small/' . $photo->images);
                        }

                        if (file_exists($this->_moduleImagePath . 'featured/' . $photo->images)) {
                            unlink($this->_moduleImagePath . 'featured/' . $photo->images);
                        }
                    }
                }
            }
        }
        $projectData = $this->projects_model->getSingleInfo($id);
        if (!empty($projectData)) {
            // have any logo image
            if (file_exists($this->_moduleImagePath . 'original/' . $projectData->project_logo)) {
                unlink($this->_moduleImagePath . 'original/' . $projectData->project_logo);
            }
            if (file_exists($this->_moduleImagePath . 'logo/' . $projectData->project_logo)) {
                unlink($this->_moduleImagePath . 'logo/' . $projectData->project_logo);
            }
        }
        // delete the project
        if ($this->global_model->delete($this->_module, array('project_id' => $id))) {
            $this->session->set_flashdata('success_msg', 'Item Deleted Successfully !!');
            redirect(admin_url($this->_module));
        }
    }

    public function deletePhotoDashboard($photoId, $typeId) {

        // delete the record from database
        if ($this->global_model->delete('media', array('id' => $photoId))) {

            // get the specfic media item
            $item = $this->global_model->get_data('media', array('id' => $photoId, 'type_id' => $typeId));

            if (file_exists($this->_moduleImagePath . $item['images'])) {
                
                if (file_exists($this->_moduleImagePath . $item['images'])) {
                    unlink($this->_moduleImagePath . $item['images']);
                }

                if (file_exists($this->_moduleImagePath . 'original/' . $item['images'])) {
                    unlink($this->_moduleImagePath . 'original/' . $item['images']);
                }

                if (file_exists($this->_moduleImagePath . 'thumbs/' . $item['images'])) {
                    unlink($this->_moduleImagePath . 'thumbs/' . $item['images']);
                }
                
                if (file_exists($this->_moduleImagePath . 'small/' . $item['images'])) {
                    unlink($this->_moduleImagePath . 'small/' . $item['images']);
                }
                
                if (file_exists($this->_moduleImagePath . 'featured/' . $item['images'])) {
                    unlink($this->_moduleImagePath . 'featured/' . $item['images']);
                }
                
                if (file_exists($this->_moduleImagePath . 'bg/' . $item['images'])) {
                    unlink($this->_moduleImagePath . 'bg/' . $item['images']);
                }
                
            }
            $this->session->set_flashdata('success_msg', 'Item deleted successfully !!');
            redirect(admin_url());
        }
    }

    // delete single photo of a album
    public function delete_photo($photoId, $typeId) {
        // get the specfic recoed item
        $item = $this->global_model->get_data('media', array('id' => $photoId, 'type_id' => $typeId));

        // delete the record from database
        if ($this->global_model->delete('media', array('id' => $photoId))) {
            if (file_exists($this->_moduleImagePath . $item['images'])) {
                unlink($this->_moduleImagePath . $item['images']);
                unlink($this->_moduleImagePath . 'original/' . $item['images']);
                unlink($this->_moduleImagePath . 'thumbs/' . $item['images']);
                unlink($this->_moduleImagePath . 'small/' . $item['images']);
                unlink($this->_moduleImagePath . 'featured/' . $item['images']);
                unlink($this->_moduleImagePath . 'bg/' . $item['images']);
                
                if (file_exists($this->_moduleImagePath . $item['images'])) {
                    unlink($this->_moduleImagePath . $item['images']);
                }

                if (file_exists($this->_moduleImagePath . 'original/' . $item['images'])) {
                    unlink($this->_moduleImagePath . 'original/' . $item['images']);
                }

                if (file_exists($this->_moduleImagePath . 'thumbs/' . $item['images'])) {
                    unlink($this->_moduleImagePath . 'thumbs/' . $item['images']);
                }
                
                if (file_exists($this->_moduleImagePath . 'small/' . $item['images'])) {
                    unlink($this->_moduleImagePath . 'small/' . $item['images']);
                }
                
                if (file_exists($this->_moduleImagePath . 'featured/' . $item['images'])) {
                    unlink($this->_moduleImagePath . 'featured/' . $item['images']);
                }
                
                if (file_exists($this->_moduleImagePath . 'bg/' . $item['images'])) {
                    unlink($this->_moduleImagePath . 'bg/' . $item['images']);
                }
                
            }
            $this->session->set_flashdata('success_msg', 'Item Deleted Successfully !!');
            redirect(admin_url($this->_module . '/update/' . $typeId));
        }
    }

    // file validation
    public function file_validate($fieldValue, $params) {
        // get the parameter as variable
        list($require, $fieldName, $type) = explode('.', $params);

        // get the type as array
        $types = explode(',', $type);

        // get the file field name
        $filename = $_FILES[$fieldName]['name'];

        if (is_array($filename)) {
            // filter the array
            $filename = array_filter($filename);

            if (count($filename) == 0 && $require == 'yes') {
                $this->form_validation->set_message('file_validate', 'The %s field is required');
                return FALSE;
            } elseif ($type != '' && count($filename) != 0) {
                foreach ($filename as $aFile) {
                    // get the extention
                    $ext = strtolower(substr(strrchr($aFile, '.'), 1));

                    if (!in_array($ext, $types)) {
                        $this->form_validation->set_message('file_validate', 'The %s field must be ' . implode(' OR ', $types) . ' !!');
                        return FALSE;
                    }
                }
                return true;
            } else {
                return TRUE;
            }
        } else {
            if ($filename == '' && $require == 'yes') {
                $this->form_validation->set_message('file_validate', 'The %s field is required');
                return FALSE;
            } elseif ($type != '' && $filename != '') {
                // get the extention
                $ext = strtolower(substr(strrchr($filename, '.'), 1));

                if (!in_array($ext, $types)) {
                    $this->form_validation->set_message('file_validate', 'The %s field must be ' . implode(' OR ', $types) . ' !!');
                    return FALSE;
                }
            } else
                return TRUE;
        }
    }

    private function multiplePhotoUpload($imageField, $typeId = 0) {

        $photoCount = array();

        // filter the array
        $allFiles = array_filter($_FILES[$imageField]['name']);
        // save the photo of album
        foreach ($allFiles as $key => $aPhoto) {
            // populate the single File field 
            $_FILES['photo']['name'] = $_FILES[$imageField]['name'][$key];
            $_FILES['photo']['type'] = $_FILES[$imageField]['type'][$key];
            $_FILES['photo']['tmp_name'] = $_FILES[$imageField]['tmp_name'][$key];
            $_FILES['photo']['size'] = $_FILES[$imageField]['size'][$key];
            $_FILES['photo']['error'] = $_FILES[$imageField]['error'][$key];

            $imageName = $this->_fileName . "_" . $key;

            // upload photo
            $photo = $this->file_processing->image_upload('photo', './' . $this->_moduleImagePath . 'original/', 'size[1920,1200]', 'jpg|jpeg|png|gif', $imageName);

            if (!is_array($photo)) {
                $iniPath = './' . $this->_moduleImagePath . 'original/' . $photo; // original image path
                $mainPath = './' . $this->_moduleImagePath . $photo;
                $naturalPath = './' . $this->_moduleImagePath . 'thumbs/' . $photo; // thumbs path
                $smallPath = './' . $this->_moduleImagePath . 'small/' . $photo; // small image path
                $featuredPath = './' . $this->_moduleImagePath . 'featured/' . $photo; // featured image path
                $bgPath = './' . $this->_moduleImagePath . 'bg/' . $photo; // bg image path

                img_resize($iniPath, $mainPath, $this->_getImageSize['image_original']);
                img_resize($iniPath, $naturalPath, $this->_getImageSize['image_thumbs']); // thumbs path
                img_resize($iniPath, $smallPath, $this->_getImageSize['image_small']); // small image
                img_resize($iniPath, $featuredPath, $this->_getImageSize['image_featured']); // featured image
                img_resize($iniPath, $bgPath, $this->_getImageSize['image_bg']); // bg image

                $cover = $this->input->post('is_home');

                // $caption = $this->input->post('caption');
                // $imageDetails = $this->input->post('image_details');
                // generate photo data
                $photoData = array(
                    'type_id' => $typeId,
                    'images' => $photo,
                    'is_home' => (($cover == $key) ? 1 : 0),
                    'type' => $this->_module,
                    'created' => date('Y-m-d H:i:s'),
                );

                $this->global_model->saveNewMedia($photoData);
                $photoCount[] = array('type_id' => $typeId);
            }
        }

        if (count($photoCount)) {
            return true;
        } else {
            return true;
        }
    }

    private function multiplePhotoUploadForUpdate($imageField, $typeId = 0) {

        $photoCount = array();

        // filter the array
        $allFiles = array_filter($_FILES[$imageField]['name']);

        // save the photo of album
        foreach ($allFiles as $key => $aPhoto) {
            // populate the single File field 
            $_FILES['photo']['name'] = $_FILES[$imageField]['name'][$key];
            $_FILES['photo']['type'] = $_FILES[$imageField]['type'][$key];
            $_FILES['photo']['tmp_name'] = $_FILES[$imageField]['tmp_name'][$key];
            $_FILES['photo']['size'] = $_FILES[$imageField]['size'][$key];
            $_FILES['photo']['error'] = $_FILES[$imageField]['error'][$key];

            $imageName = $this->_fileName . "_" . $key;

            // upload photo
            $photo = $this->file_processing->image_upload('photo', './' . $this->_moduleImagePath . 'original/', 'size[1100,9999]', 'jpg|jpeg|png|gif', $imageName);

            $iniPath = './' . $this->_moduleImagePath . 'original/' . $photo; // original image path
            $mainPath = './' . $this->_moduleImagePath . $photo;
            $naturalPath = './' . $this->_moduleImagePath . 'thumbs/' . $photo; // thumbs path
            $smallPath = './' . $this->_moduleImagePath . 'small/' . $photo; // small image path
            $featuredPath = './' . $this->_moduleImagePath . 'featured/' . $photo; // featured image path
            $bgPath = './' . $this->_moduleImagePath . 'bg/' . $photo; // featured image path

            img_resize($iniPath, $mainPath, $this->_getImageSize['image_original']);
            img_resize($iniPath, $naturalPath, $this->_getImageSize['image_thumbs']); // thumbs path
            img_resize($iniPath, $smallPath, $this->_getImageSize['image_small']); // small image
            img_resize($iniPath, $featuredPath, $this->_getImageSize['image_featured']); // featured image
            img_resize($iniPath, $bgPath, $this->_getImageSize['bg_featured']); // bg image
            // generate photo data
            $photoData = array(
                'type_id' => $typeId,
                'images' => $photo,
                'type' => $this->_module,
                'created' => date('Y-m-d H:i:s'),
            );

            $this->global_model->saveNewMedia($photoData);
            $photoCount[] = array('type_id' => $typeId);
        }

        if (count($photoCount)) {
            return true;
        } else {
            return true;
        }
    }

}

/* End of file Projects.php */
/* Location: ./application/controllers/doreenadmin/Projects.php */

