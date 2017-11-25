<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function is_post() {
    if (!(filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST')) {
        exit('Invalid Access');
    }
}

function check_authenticated() {
    if (!is_authenticated()) {
        header("Location:" . base_url() . "admin/login");
    }
}

function is_authenticated() {
    $CI = & get_instance();
    $user_id = $CI->session->userdata('user_id');
    if (is_null($user_id) || $user_id == '') {
        return false;
    }
    return true;
}

/**
 * Fetch the value from SESSION
 * @param type $key
 * @return type
 */
function get_from_session($key) {
    $CI = & get_instance();
    $value = $CI->session->userdata($key);
    return $value;
}

/**
 * Fetch the value from POST. Will be trim() by default.
 * @param type $key - key to fetch from POST
 * @param type $trim - Optional. Default is TRUE
 * @return type
 */
function get_from_post($key, $trim = TRUE) {
    $CI = & get_instance();
    return $trim ? trim($CI->input->post($key)) : $CI->input->post($key);
}

/**
 * EOF: ./application/helpers/request_helper.php
 */