<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends CI_Model {

    function is_valid_post_data($key_post_id, $post_id, $table_name) {
        $this->db->where($key_post_id, $post_id);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        $resc = $this->db->get();
        return $resc->result_array();
    }


    }
