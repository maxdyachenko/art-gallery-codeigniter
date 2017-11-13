<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class List_page extends MY_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        if (!parent::is_user_logged())
            redirect(base_url());
        $this->load->model('list_model');
        $this->load->helper('form');

        $this->data['common_app_data'] = parent::get_common_app_data();
        $this->data['current_item'] = "Home";
        $this->data['user_id'] = $this->session->userdata('id');
    }

    public function index()
    {
        $this->data['list_data'] = $this->list_model->get_data($this->session->userdata('id'));
        $this->load->view('templates/header');
        $this->load->view('templates/menu', $this->data);
        $this->load->view('pages/list', $this->data);
        $this->load->view('templates/footer');
    }

    public function delete_gallery()
    {
        $gallery_id = intval(trim($this->input->post('name')));
        $this->list_model->delete_gallery($gallery_id);

        redirect('/main');
    }

}