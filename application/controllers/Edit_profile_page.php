<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Edit_profile_page extends MY_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        if (!parent::is_user_logged())
            redirect(base_url());
        $this->load->model('edit_profile_model');

        $this->data['common_app_data'] = parent::get_common_app_data();
        $this->data['current_item'] = 'Edit profile';

        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['active_tab'] = 1;
        $this->load->view('templates/header');
        $this->load->view('templates/menu', $this->data);
        $this->load->view('pages/edit_profile', $this->data);
        $this->load->view('templates/footer');
    }

    public function edit_name()
    {
        $this->data['active_tab'] = 1;
        $this->form_validation->set_rules('userName', 'Name', 'trim|min_length[2]|max_length[16]');
        $this->form_validation->set_rules('userLastName', 'Last Name', 'trim|min_length[2]|max_length[16]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu', $this->data);
            $this->load->view('pages/edit_profile', $this->data);
            $this->load->view('templates/footer');
        }
        else
        {
            $name = filter_var($this->input->post('userName'), FILTER_SANITIZE_STRING);
            $last_name = filter_var($this->input->post('userLastName'), FILTER_SANITIZE_STRING);

            if ($name) $this->session->userdata('username', $name);

            if ($name && $last_name)
            {
                $this->edit_profile_model->edit_user_name($this->session->userdata('id'), $name, $last_name);
                $this->data['name_changed'] = "Name and Last name succesfully changed!";
            }
            else if ($name && !$last_name)
            {
                $this->edit_profile_model->edit_user_name($this->session->userdata('id'),$name);
                $this->data['name_changed'] = "Name succesfully changed!";
            }
            else
            {
                $this->edit_profile_model->edit_user_name($this->session->userdata('id'),$name, $last_name);
                $this->data['name_changed'] = "Last Name succesfully changed!";
            }

            $this->load->view('templates/header');
            $this->load->view('templates/menu', $this->data);
            $this->load->view('pages/edit_profile', $this->data);
            $this->load->view('templates/footer');
        }
    }

    public function edit_pswd()
    {
        $this->data['active_tab'] = 2;
        $this->form_validation->set_rules('oldPswd', 'Old password', 'trim|required|min_length[6]|max_length[16]|callback_is_old_pswd_exist');
        $this->form_validation->set_rules('newPswd', 'New password', 'trim|required|min_length[6]|max_length[16]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu', $this->data);
            $this->load->view('pages/edit_profile', $this->data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->edit_profile_model->update_pswd($this->session->userdata('id'), $this->input->post('newPswd'));

            $this->data['pswd_changed'] = "Password successfully changed";
            $this->load->view('templates/header');
            $this->load->view('templates/menu', $this->data);
            $this->load->view('pages/edit_profile', $this->data);
            $this->load->view('templates/footer');
        }
    }

    public function is_old_pswd_exist($pswd)
    {
        $pswd = filter_var($pswd, FILTER_SANITIZE_STRING);
        if (!$this->edit_profile_model->check_old_pswd($pswd, $this->session->userdata('id')))
        {
            $this->form_validation->set_message('is_old_pswd_exist', 'Incorrect old password');
            return false;
        }
        return true;

    }

}