<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projects_model extends CI_Model {

    public $_module;
    public $_primaryKey;

    function __construct() {
        parent::__construct();
        $this->_module = 'projects';
        $this->_primaryKey = 'project_id';
    }

    public function getAllProjects($limit = 0, $offset = 0, $categoryId = false) {

        $this->db->select('projects.*,project_locations.location_id,project_locations.location_name,project_types.project_type_id,project_types.type_name,project_category.category_name,project_category.project_category_id');
        $this->db->from('projects');
        $this->db->join('project_category', 'project_category.project_category_id = projects.project_category_id');
        $this->db->join('project_locations', 'project_locations.location_id = projects.project_location_id');
        $this->db->join('project_types', 'project_types.project_type_id = projects.project_type_id');
        $this->db->where('projects.project_status', 1);

        if (!empty($categoryId)) {
            $this->db->where('project_category.project_category_id', $categoryId);
        }

        $this->db->order_by('projects.created_at', 'DESC');

        $tempdb = clone $this->db;
        $finalResult['totalRow'] = $tempdb->count_all_results();

        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        // echo $this->db->last_query();
        // exit;

        if ($query->num_rows() > 0) {
            $finalResult['result'] = $query->result();
            return $finalResult;
        }

        return FALSE;
    }

    public function getProjectsBySearch($limit = 0, $params = NULL) {

        $this->db->select('projects.*,project_locations.location_id,project_locations.location_name,project_types.project_type_id,project_types.type_name,project_category.category_name,project_category.project_category_id');
        $this->db->from('projects');
        $this->db->join('project_category', 'project_category.project_category_id = projects.project_category_id');
        $this->db->join('project_locations', 'project_locations.location_id = projects.project_location_id');
        $this->db->join('project_types', 'project_types.project_type_id = projects.project_type_id');
        $this->db->where('projects.project_status', 1);

        if (!empty($params)) {
            if (isset($params['project_title']) && !empty($params['project_title'])) {
                $projectTitle = $params['project_title'];
                $this->db->where("(projects.project_title LIKE '%$projectTitle%')");
            }

            if (isset($params['project_type_id']) && !empty($params['project_type_id'])) {
                $this->db->where('projects.project_type_id', $params['project_type_id']);
            }

            if (isset($params['project_location_id']) && !empty($params['project_location_id'])) {
                $this->db->where('projects.project_location_id', $params['project_location_id']);
            }
        }

        $this->db->order_by('projects.created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return FALSE;
    }

    public function getSingleProjectData($id) {

        $this->db
                ->select('projects.*,project_locations.location_id,project_locations.location_name,project_types.project_type_id,project_types.type_name,project_category.category_name,project_category.project_category_id')
                ->from('projects')
                ->join('project_category', 'project_category.project_category_id = projects.project_category_id')
                ->join('project_locations', 'project_locations.location_id = projects.project_location_id')
                ->join('project_types', 'project_types.project_type_id = projects.project_type_id')
                ->where('projects.' . $this->_primaryKey, $id)
                ->where('projects.project_status', 1)
        ;
        $query = $this->db->get();

        if ($query->num_rows() != 0) {
            return $query->row();
        }

        return false;
    }

    public function getCategoryNameById($id) {

        $this->db->select('category_name');
        $this->db->where('project_category_id', $id);
        $this->db->from('project_category');
        $query = $this->db->get();

        if ($query->num_rows() != 0) {
            return $query->row()->category_name;
        }

        return false;
    }

    public function getProductInfo($productId) {

        $this->db->select('product.*,product_category.*');
        $this->db->from('product');
        $this->db->join('product_category', 'product_category.id = product.category_id', 'left');

        $this->db->where('product_id', $productId);
        $query = $this->db->get();
        if ($query->num_rows() != 0):
            return $query->row();
        endif;

        return FALSE;
    }

    public function getProjectVideoById($projectId) {

        $this->db->select('project_id,youtube_url,description');
        $this->db->from('project_video');

        $this->db->where('project_id', $projectId);
        $query = $this->db->get();

        if ($query->num_rows() != 0):
            return $query->row();
        endif;

        return FALSE;
    }

}
