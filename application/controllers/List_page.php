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
        $gallery_fetch_name = intval(trim($this->input->post('name')));
        $this->list_model->delete_gallery($gallery_fetch_name, $this->session->userdata('id'));

        $dir_path = FCPATH . "uploads/img/user_id_" . $this->session->userdata('id') . "/gallery_" . $gallery_fetch_name;

        $files = glob($dir_path . "/*");
        foreach($files as $file){
            if(is_file($file)){
                unlink($file);
            }
        }
        rmdir($dir_path);

        redirect('/main');
    }



}