<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Exit_page extends MY_Controller
{
    public function index()
    {
        $this->load->helper('cookie');
        delete_cookie('id');
        delete_cookie('token');
        $this->session->sess_destroy();
        redirect(base_url());
    }
}