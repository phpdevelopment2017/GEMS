<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_lib {

    var $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('admin/auth_model');
    }

    function check_post_id_validation($key_post_id, $post_id, $table_name) {
        if ($post_id == '' || $post_id == 0) {
            return "Please select any $table_name";
        }
        $is_valid = $this->check_post_data_of_entity($key_post_id, $post_id, $table_name);
        if (!$is_valid) {
            return "This $table_name does not exist.";
        }
        return '';
    }

    function check_post_data_of_entity($key_post_id, $post_id, $table_name) {
        $post_data = $this->CI->auth_model->is_valid_post_data($key_post_id, $post_id, $table_name);
        if (!empty($post_data)) {
            return TRUE;
        }
        return FALSE;
    }

}
