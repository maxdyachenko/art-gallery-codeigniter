<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery_page extends MY_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        if (!parent::is_user_logged())
            redirect(base_url());
        $this->load->model('gallery_model');

        $this->data['common_app_data'] = parent::get_common_app_data();
        $this->data['user_id'] = $this->session->userdata('id');
        $this->load->library('form_validation');
    }

    public function index($gallery_id)
    {
        $this->data['gallery_id'] = $gallery_id;
        $this->data['content'] = $this->gallery_model->get_gallery_content($gallery_id);
        $this->load->view('templates/header');
        $this->load->view('templates/menu', $this->data);
        $this->load->view('pages/gallery_page', $this->data);
        $this->load->view('templates/footer');
    }

    public function upload_image($gallery_id)
    {
        $this->data['gallery_id'] = $gallery_id;
        $this->load->helper('date');
        $gallery_id = filter_var($gallery_id, FILTER_SANITIZE_NUMBER_INT);
        $gallery_fetch_name = $this->gallery_model->get_gallery_fetch_name($gallery_id);
        $dirName = FCPATH . "/uploads/img/user_id_" . $this->session->userdata('id') . "/gallery_" . $gallery_fetch_name;
        !file_exists($dirName) ? mkdir($dirName, 0777, true) : false;

        $config['upload_path'] = $dirName;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1000;
        $config['max_width'] = 1024;
        $config['file_name'] = now();
        $config['file_ext_tolower'] = TRUE;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file'))
        {
            $this->data['image_error'] = $this->upload->display_errors();
            $this->data['content'] = $this->gallery_model->get_gallery_content($gallery_id);

            $this->load->view('templates/header');
            $this->load->view('templates/menu', $this->data);
            $this->load->view('pages/gallery_page', $this->data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->gallery_model->insert_image($gallery_id, $gallery_fetch_name, $this->session->userdata('id'), $this->upload->data('file_name'));
            redirect(base_url() . '/gallery/' . $gallery_id);
        }
    }
}