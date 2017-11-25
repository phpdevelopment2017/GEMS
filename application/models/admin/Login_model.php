<?php

class Login_model extends CI_Model {

    /**
     * get userdata by username
     * @param type $username
     * @return type
     */
    function get_by_username($username) {
        $this->db->where('username', $username);
        $recs = $this->db->get('user');
        return $recs->row_array();
    }

    /**
     * update password
     * @param type $user_id
     * @param type $new_password
     */
    function update_password($user_id, $new_password, $update_by, $update_time) {
        $this->db->where('user_id', $user_id);
        $this->db->set('password', $new_password);
        $this->db->set('updated_by', $update_by);
        $this->db->set('updated_time', $update_time);
        $this->db->update('user');
    }

    /**
     * get user data by user id
     * @param type $user_id
     * @return type
     */
    function get_by_user_id($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->from('user');
        $resc = $this->db->get();
        return $resc->row_array();
    }

}

/*
 * EOF: ./application/models/Login_model.php
 */