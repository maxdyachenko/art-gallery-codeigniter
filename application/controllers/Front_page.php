<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_page extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('front_model');
    }

	public function index()
    {
        $data['auth_attr'] = "class='sign-in'";
        $data['reg_attr'] = "class='sign-up'";
        $this->load->view('templates/header');
		$this->load->view('pages/front_page', $data);
	}

	public function auth()
    {
        $this->load->library('form_validation');
    }

    public function register()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('regEmail', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('regPswd', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('regPswd2', 'Password Confirmation', 'trim|required|matches[regPswd]');
        $this->form_validation->set_rules('regName', 'Name', 'trim|required|min_length[2]|max_length[16]');
        $this->form_validation->set_rules('regLastName', 'Last Name', 'trim|required|min_length[2]|max_length[16]');


        if ($this->form_validation->run() == FALSE)
        {
            $data['auth_attr'] = "class='sign-in disable'";
            $data['reg_attr'] = "class='sign-up active'";
            $this->load->view('templates/header');
            $this->load->view('pages/front_page', $data);
        }
        else
        {
            redirect('activate-email');
        }
    }
}
