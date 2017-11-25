<?php

class Subscription extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/subscription_model');
    }

    function get_all_subscription() {
        $subscriptions = $this->subscription_model->get_subscriptions();
        echo json_encode(array('data' => $subscriptions));
    }

    function delete_subscription_by_id() {
        $subscription_id = $this->input->post('subscription_id');

        //check group id exists
        $post_id_validation_message = $this->auth_lib->check_post_id_validation('subscription_id', $subscription_id, 'subscription');
        if ($post_id_validation_message != '') {
            echo json_encode(array('success' => FALSE, 'message' => $post_id_validation_message));
            return;
        }

        $this->db->trans_start();
        $this->subscription_model->update_subscription($subscription_id, array('is_delete' => IS_DELETE));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(array('success' => FALSE, 'message' => 'Some unexpected database error encountered due to which your transaction could not be completed'));
            return;
        }
        $data['success'] = TRUE;
        $data['message'] = 'Subscription Deleted Successflly!';
        echo json_encode($data);
    }

}

/*
 * EOF: ./application/controllers/Subscription.php
 */
