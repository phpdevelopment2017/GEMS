<?php

class Sponsor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/sponsor_model');
    }

    function get_all_sponsor() {
        $sponsors = $this->sponsor_model->get_sponsors();
        echo json_encode(array('data' => $sponsors));
    }

    function get_sponsor_by_id() {
        $sponsor_id = get_from_post('sponsor_id');
        //check group id exists
        $post_id_validation_message = $this->auth_lib->check_post_id_validation('sponsor_id', $sponsor_id, 'sponsor');
        if ($post_id_validation_message != '') {
            echo json_encode(array('success' => FALSE, 'message' => $post_id_validation_message));
            return;
        }
        $sponsor_data = $this->sponsor_model->get_by_id($sponsor_id);
        echo json_encode(array('success' => TRUE, 'sponsor_data' => $sponsor_data));
    }

    function save_sponsor() {
        $sponsor_data = $this->_get_data_from_post();
        $validation_message = $this->_validate_sponsor($sponsor_data);
        if ($validation_message != '') {
            echo json_encode(array('success' => FALSE, 'message' => $validation_message));
            return;
        }
        $this->db->trans_start();
        $sponsor_data['created_time'] = date('Y-m-d H:i:s');
        $this->sponsor_model->insert_sponsor($sponsor_data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(array('success' => FALSE, 'message' => 'Some unexpected database error encountered due to which your transaction could not be completed'));
            return;
        }
        $data['success'] = TRUE;
        $data['message'] = 'Sponsor Saved Successflly!';
        echo json_encode($data);
    }

    function update_sponsor() {
        $sponsor_id = get_from_post('sponsor_id');
        //check group id exists
        $post_id_validation_message = $this->auth_lib->check_post_id_validation('sponsor_id', $sponsor_id, 'sponsor');
        if ($post_id_validation_message != '') {
            echo json_encode(array('success' => FALSE, 'message' => $post_id_validation_message));
            return;
        }

        $sponsor_data = $this->_get_data_from_post();
        $validation_message = $this->_validate_sponsor($sponsor_data);
        if ($validation_message != '') {
            echo json_encode(array('success' => FALSE, 'message' => $validation_message));
            return;
        }
        $this->db->trans_start();
        $sponsor_data['updated_time'] = date('Y-m-d H:i:s');
        $this->sponsor_model->update_sponsor($sponsor_id, $sponsor_data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(array('success' => FALSE, 'message' => 'Some unexpected database error encountered due to which your transaction could not be completed'));
            return;
        }
        $data['success'] = TRUE;
        $data['message'] = 'Sponsor updated Successflly!';
        echo json_encode($data);
    }

    function _get_data_from_post() {
        $sponsor_array = array();
        $sponsor_array['sponsorship_type'] = get_from_post('sponsorship_type');
        $sponsor_array['sponsor_name'] = get_from_post('sponsor_name');
        $sponsor_array['address'] = get_from_post('address');
        $sponsor_array['phone_number'] = get_from_post('phone_number');
        $sponsor_array['email'] = get_from_post('email');
        $sponsor_array['cost_per_year'] = get_from_post('cost_per_year');
        return $sponsor_array;
    }

    function _validate_sponsor($sponsor_data) {
        if (!$sponsor_data['sponsorship_type']) {
            return 'Please Select Sponsorship Type.';
        }
        if (!$sponsor_data['sponsor_name']) {
            return 'Please Enter Sponsor Name.';
        }
        if (!$sponsor_data['phone_number']) {
            return 'Please Enter Phone Number.';
        }
        if (!$sponsor_data['email']) {
            return 'Please Enter Email.';
        }
        if (!filter_var($sponsor_data['email'], FILTER_VALIDATE_EMAIL)) {
            return 'Please Enter Valid Email.';
        }
        if (!$sponsor_data['cost_per_year'] || !is_numeric($sponsor_data['cost_per_year'])) {
            return 'Please Enter Cost Per Year.';
        }
        return '';
    }

    function delete_sponsor_by_id() {
        $sponsor_id = get_from_post('sponsor_id');

        //check sponsor id exists
        $post_id_validation_message = $this->auth_lib->check_post_id_validation('sponsor_id', $sponsor_id, 'sponsor');
        if ($post_id_validation_message != '') {
            echo json_encode(array('success' => FALSE, 'message' => $post_id_validation_message));
            return;
        }

        $this->db->trans_start();
        $this->sponsor_model->update_sponsor($sponsor_id, array('is_delete' => IS_DELETE));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(array('success' => FALSE, 'message' => 'Some unexpected database error encountered due to which your transaction could not be completed'));
            return;
        }
        $data['success'] = TRUE;
        $data['message'] = 'Sponsor Deleted Successflly!';
        echo json_encode($data);
    }

}

/*
 * EOF: ./application/controllers/Sponsor.php
 */
