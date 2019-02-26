<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model {

    public $_module;
    public $_primaryKey;

    function __construct() {
        parent::__construct();
        $this->_module = 'contacts';
        $this->_primaryKey = 'id';
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

    // get the information based on filtaring
    public function getAll($count = false, $params = array(), $num = null, $offset = null) {
        $select = $this->db->select('*')->from($this->_module);
        if ($params) {
            $select->where($params);
        }
        $select->order_by($this->_primaryKey, 'DESC');

        if ($num) {
            $select->limit($num, $offset);
        }
        if ($count) {
            return $select->count_all_results();
        } else {
            $query = $this->db->get();
            return $query->result();
        }
    }

    // delete single information
    public function delete($id = 0) {
        $this->db->delete($this->_module, array($this->_primaryKey => $id));
        return $this->db->affected_rows();
    }

    // update the information
    public function update($data, $id) {
        if ($this->db->update($this->_module, $data, $this->_primaryKey . " = " . $id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
