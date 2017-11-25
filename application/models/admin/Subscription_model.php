<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subscription_model extends CI_Model {

    function get_subscriptions() {
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('subscription');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function update_subscription($subscription_id, $subscription_data) {
        $this->db->where('subscription_id', $subscription_id);
        $this->db->update('subscription', $subscription_data);
    }

}

/*
 * EOF: ./application/models/Subscription_model.php
 */