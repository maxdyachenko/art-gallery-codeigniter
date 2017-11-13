<?php

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('my_model');
    }

    public function is_user_logged()
    {
        $this->load->library('session');
        $this->load->helper('cookie');
        $this->load->helper('security');
        if ($this->session->userdata('id')) {
            return $this->session->userdata('id');
        }
        else if (get_cookie('id') && get_cookie('token')){
            $id = filter_var(get_cookie('id'), FILTER_VALIDATE_INT);
            $id = xss_clean($id);
            $token = filter_var(get_cookie('token'), FILTER_SANITIZE_STRING);
            $token = xss_clean($token);
            $row = $this->my_model->check_token($id, $token);
            if ($row){
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('username', $row);
                return $id;
            }
        }
        return false;
    }

}