<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/login_model');
    }

    function index($msg = '') {
        if (is_authenticated()) {
            header("Location:" . base_url() . "admin");
        }
        $data['message'] = $msg;
        $this->load->view('admin/login', $data);
    }

    function check() {
        is_post();
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Email', 'trim|required|valid_email');

        $username = trim($this->input->post('username'));
        $password = trim($this->input->post('password'));
        if ($this->form_validation->run() == false) {
            $this->index('Invalid Email.');
            return;
        }
        if ($username == '') {
            $this->index('Username cannot be empty.');
            return;
        }
        if ($password == '') {
            $this->index('Password cannot be empty.');
            return;
        }
        $user = $this->login_model->get_by_username($username);
        if (!$user) {
            $this->index('User Is Not Active Waiting for Admin Approval');
            return;
        }
        if (md5($password) != $user['password']) {
            $this->index('Invalid Password');
            return;
        }
        unset($user['password']);
        $this->session->set_userdata($user);
        header("Location:" . base_url() . "admin");
    }

    function change_password($msg = '') {
        check_authenticated();
        $data['message'] = $msg;
        $this->load->view('admin/change_password', $data);
    }

    function check_change_password() {
        check_authenticated();
        is_post();
        $current_password = trim($this->input->post('current_password'));
        $new_password = trim($this->input->post('new_password'));
        $confirm_new_password = trim($this->input->post('confirm_new_password'));

        if ($current_password == '') {
            $this->change_password('Current Password cannot be empty.');
            return;
        }
        if ($new_password == '') {
            $this->change_password('New Password cannot be empty.');
            return;
        }
        if ($confirm_new_password == '') {
            $this->change_password('Confirm New Password cannot be empty.');
            return;
        }
        if ($new_password != $confirm_new_password) {
            $this->change_password('New Password and Confirm New Password does not match.');
            return;
        }
        $user = $this->login_model->get_by_username(get_from_session('username'));
        if (md5($current_password) != $user['password']) {
            $this->change_password('Current Password is invalid.');
            return;
        }
        $user_id = get_from_session('user_id');
        $new_password_md5 = md5($new_password);
        $this->login_model->update_password($user_id, $new_password_md5, get_from_session('user_id'), date('Y-m-d H:i:s'));
        $this->session->set_userdata('password', $new_password_md5);
        $this->change_password("Password updated successfully");
        $this->session->sess_destroy();
        header("Location:" . base_url() . "admin/login");
    }

    function logout($msg = '') {
        $this->session->sess_destroy();
        $user_id = get_from_session('user_id');
        header("Location:" . base_url() . "admin/login");
    }

}

/*
 * EOF: ./application/controllers/admin/Login.php
 */
