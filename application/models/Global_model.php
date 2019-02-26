<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * @param $table
     * @param $data
     *
     * @return mixed
     */
    public function insert($table, $data) {
        $this->db->insert($table, $data);

        return $this->db->affected_rows();
    }

    /**
     * @param $data
     *
     * @return affected_rows
     */
    public function saveNewMedia($data = array()) {
        $this->db->insert('media', $data);
        return $this->db->affected_rows();
    }

    /**
     * @param $table
     * @param $where
     *
     * @return bool
     */
    public function get_data($table, $where) {

        $query = $this->db->get_where($table, $where);

        if ($query->result()) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function getData($table, $where) {
        $query = $this->db->get_where($table, $where);
        if ($query->result()) {
            return $query->row();
        }
        return false;
    }

    /**
     * @param $table
     * @param $data
     * @param $where
     *
     * @return mixed
     */
    public function update($table, $data, $where) {
        $this->db->where($where);

        return $this->db->update($table, $data);
    }

    /**
     * @param $table
     * @param $where
     * @return mixed
     */
    public function delete($table, $where) {
        return $this->db->delete($table, $where);
    }

    /**
     * @param $table
     *
     * @return bool
     */
    public function get($table, $where = false, $limit = false, $order_by = false, $pagination = FALSE) {
        $this->db->select('*')->from($table);

        if (!empty($where)) {
            $this->db->where($where);
        }

        if ($pagination && $limit) {
            $this->db->limit($limit['item'], $limit['start']);
        } else {
            if (!empty($limit)) {
                $this->db->limit($limit);
            }
        }

        if (!empty($order_by)) {
            $this->db->order_by($order_by['filed'], $order_by['order']);
        }

        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /**
     * getAllData
     *
     * @return bool
     */
    public function getAllData($table, $limit = FALSE) {

        $this->db
                ->select('*')
                ->from($table);
        if ($limit):
            $this->db->limit($limit);
        endif;

        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result();
        }
        return false;
    }

    public function getSingleProductInfo($id) {

        $select = $this->db->select('*');
        $select->from('product');
        $select->where('product_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * @param      $table
     * @param      $like
     * @param bool $where
     *
     * @return bool
     */
    public function get_like($table, $like, $where = false) {

        $this->db->select('*');
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        $this->db->like($like);
        $query = $this->db->get();

        if ($query->num_rows()) {
            return $query->result();
        } else {
            return false;
        }
    }

    /**
     * User Login
     */
    public function user_login($data) {
        $query = $this->db->query("SELECT * FROM `users` WHERE email = '" . $data['email'] . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $data['password'] . "'))))) AND status=1)");

        if ($query->num_rows() > 0) {
            $user_info = $query->row_array();
            $this->session->set_userdata('login-email', md5($user_info['email']));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * all_users
     *
     * @return bool
     */
    public function all_users() {
        $this->db->select('*')->from('login');
        $this->db->where(array('type !=' => 1));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        if ($query->result()) {
            return $query->result();
        } else {
            return false;
        }
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function add_user($data) {
        $this->db->insert('login', $data);
        return $this->db->affected_rows();
    }

    /**
     * @param $id
     * @param $data
     *
     * @return mixed
     */
    public function update_user($id, $data) {
        $this->db->where('uid', $id);
        return $this->db->update('users', $data);
    }

    /**
     * @param $user
     * @param $email
     * @param $type
     *
     * @return bool
     */
    public function get_user_row($email, $type) {
        $query = $this->db->get_where('login', array('email' => $email, 'type' => $type));
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function get_user($id) {
        $query = $this->db->get_where('login', array('id' => $id));
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @param $data
     *
     * @return mixed
     */
    public function user_status($id, $data) {
        $this->db->where(array('UID' => $id));
        return $this->db->update('login', $data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete_user($id) {
        return $this->db->delete('login', array('id' => $id));
    }

    /**
     * @param $table
     * @param $where
     *
     * @return bool
     */
    public function get_row($table, $where) {
        $query = $this->db->get_where($table, $where);

        if ($result = $query->result()) {
            return true;
        } else {
            return false;
        }
    }

    public function count_row($table, $where = false) {
        if ($where) {
            $this->db->where($where);
        }
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function countRow($table, $where = false) {
        if ($where) {
            $this->db->where($where);
        }
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function getDataAsDropdown($table, $fieldName) {

        $this->db->select('*')->from($table);
        $query = $this->db->get();
        $response = array('' => '-- Choose --');

        foreach ($query->result() as $row) {
            $response[$row->id] = ucfirst($row->$fieldName);
        }
        return $response;
    }

    public function getDashboardGallery($table, $limit = 0) {

        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('status', 1); // has active record
        $this->db->order_by('created', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function getPhotoGalleryDashboard($limit = 0) {

        $this->db->select('*');
        $this->db->from('photo_gallery');
        $this->db->where('status', 1); // has active record
        $this->db->order_by('created', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function getProjectDashboard($limit = 0) {

        $select = $this->db->select('*')->from('media');
        $select->order_by('created', 'DESC');
        $select->where(array('type' => 'projects'));
        $this->db->limit($limit);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    public function getGalleryDashboard($limit = 0) {

        $select = $this->db->select('*')->from('media');
        $select->order_by('created', 'DESC');
        $select->where(array('type' => 'gallery'));
        $this->db->limit($limit);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    public function getMediaByTypeAndId($where) {

        $query = $this->db->get_where('media', $where);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getSingleData($table) {

        $this->db
                ->select('*')
                ->from($table);
        $query = $this->db->get();

        if ($query->num_rows() != 0) {
            return $query->row();
        }
        return false;
    }

    public function getMediaDataRandomlyByType($type, $typeId) {
        $this->db->select('*')
                ->where('type', $type)
                ->where('type_id', $typeId)
                ->order_by('created', 'DESC')
                ->limit(1);

        $queryBuilder = $this->db->get('media');
        if ($queryBuilder->num_rows() != 0) {
            return $queryBuilder->row();
        }
        return false;
    }

    public function getSingleInfo($table, $where = array()) {

        $select = $this->db->select('*');
        $select->from($table);
        $select->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function getAllByPagination($table, $limit = 0, $offset = 0) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by("created", "DESC");

        $tempdb = clone $this->db;
        $finalResult['totalRow'] = $tempdb->count_all_results();

        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $finalResult['result'] = $query->result();
            return $finalResult;
        } else {
            return FALSE;
        }
    }

    public function getProjectSlider() {

        $this->db->select('*')
                ->from('banners')
                ->where('status', 1);
        $query = $this->db->get();

        if ($query->num_rows() != 0) {
            return $query->result();
        }

        return false;
    }

    public function getOnlyRow($table, $where) {
        $query = $this->db->get_where($table, $where);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getProjectDataHome($limit = 0) {

        // $this->db->select('projects.*,project_locations.location_id,project_locations.location_name,project_types.project_type_id,project_types.type_name,project_category.category_name,project_category.project_category_id');
        $this->db->select('*')->from('projects')
                ->where('projects.project_status', 'active')
                ->order_by('projects.created_at', 'DESC')
                ->limit($limit)
        ;
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result();
        }
        return false;
    }

    public function getBannerImage() {
        $this->db
                ->select('*')
                ->from('banners')
                ->where('status', 'active')
        ;
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function getDirectors() {
        $this->db->select('*')->from('management_team')
                ->where('type', 'director')
                ->where('status', 'active')
        ;
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function getTopManagement() {
        $this->db->select('*')->from('management_team')
                ->where('type', 'member')
                ->where('status', 'active')
        ;
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function getMemberDetails($id) {
        $this->db->select('*')->from('management_team')
                ->where('id', $id)
                ->where('status', 'active')
        ;
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }
    
    public function getProjects() {
        $this->db->select('*')->from('projects')
                ->where('project_status', 'active')
        ;
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }
    
    public function getProjectDetailsById($id) {
        $this->db->select('*')->from('projects')
                ->where('project_id', $id)
                ->where('project_status', 'active')
        ;
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return array();
    }
    
    
    public function getGalleryList() {
        $this->db->select('*')->from('gallery')
                ->where('status', 1)
        ;
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }
    
    public function countAlbumPhoto($albumId) {
        return $this->db->where('type_id', $albumId)
                        ->where('type', 'gallery')
                        ->count_all_results('media');
    }
    
     public function getAlbumInfo($albumId) {
        $this->db->select('*');
        $this->db->from('gallery');
        $this->db->where('gallery_id', $albumId);
        $query = $this->db->get();
        if ($query->num_rows() != 0):
            return $query->row();
        endif;

        return FALSE;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    public function getContactUs() {
        $select = $this->db->select('*')->from('contacts');
        $select->where(array('status' => 'active')); // has active record
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

}

/* End of file Global_model.php */
/* Location: ./application/models/Global_model.php */