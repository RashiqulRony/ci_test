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

    // insert new record 
    public function create($data) {
        $this->db->insert($this->_module, $data);
        return $this->db->affected_rows();
    }

    // get the specific information
    public function getSingleInfo($id) {

        $select = $this->db->select('*');
        $select->from($this->_module);
        $select->where($this->_primaryKey, $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getAllProjectData() {
        $this->db->select('*');
        $this->db->from('projects');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function getSingleProjectData($id) {
        $this->db->select('*')
                ->from('projects')
                ->where($this->_primaryKey, $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    // delete single information
    public function delete($id = 0) {
        $this->db->delete($this->_module, array($this->_primaryKey => $id));
        return $this->db->affected_rows();
    }

    // update the information
    public function update($data, $id) {
        if ($this->db->update($this->_module, $data, $this->_primaryKey . "= " . $id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

/* End of file Projects_model.php */
/* Location: ./application/model/doreenadmin/Projects_model.php */