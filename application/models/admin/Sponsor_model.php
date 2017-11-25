<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sponsor_model extends CI_Model {

    function get_sponsors() {
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('sponsor');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_by_id($sponsor_id) {
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('sponsor_id', $sponsor_id);
        $this->db->from('sponsor');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function insert_sponsor($sponsor_data) {
        $this->db->insert('sponsor', $sponsor_data);
        return $this->db->insert_id();
    }

    function update_sponsor($sponsor_id, $sponsor_data) {
        $this->db->where('sponsor_id', $sponsor_id);
        $this->db->update('sponsor', $sponsor_data);
    }

}

/*
 * EOF: ./application/models/Sponsor_model.php
 */