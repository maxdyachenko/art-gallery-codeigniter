<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery_create_page extends MY_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        if (!parent::is_user_logged())
            redirect(base_url());
        $this->load->model('gallery_create_model');

        $this->data['common_app_data'] = parent::get_common_app_data();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/menu', $this->data);
        $this->load->view('pages/create_gallery');
        $this->load->view('templates/footer');
    }

    public function create_gallery()
    {
        if (!$this->gallery_create_model->has_limit($this->session->userdata('id')))
        {
            $this->data['limit_error'] = "You allowed to create < 6 galleries";
            $this->load->view('templates/header');
            $this->load->view('templates/menu', $this->data);
            $this->load->view('pages/create_gallery', $this->data);
            $this->load->view('templates/footer');
            return;
        }

        $this->form_validation->set_rules('galleryName', 'Gallery name', 'trim|required|min_length[1]|max_length[20]|callback_name_exist');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/menu', $this->data);
            $this->load->view('pages/create_gallery');
            $this->load->view('templates/footer');
        }
        else
        {
            $name = filter_var($this->input->post('galleryName'), FILTER_SANITIZE_STRING);
            $dirName = FCPATH . "/uploads/img/user_id_" . $this->session->userdata('id') . "/gallery_" . $name;
            !file_exists($dirName) ? mkdir($dirName, 0777, true) : false;

            $config['upload_path'] = $dirName;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1000;
            $config['max_width'] = 1024;
            $config['file_name'] = 'avatar';
            $config['file_ext_tolower'] = TRUE;
            $config['max_height'] = 768;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file'))
            {
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('templates/header');
                $this->load->view('templates/menu', $this->data);
                $this->load->view('pages/create_gallery', $error);
                $this->load->view('templates/footer');
            }
            else
            {
                $this->gallery_create_model->set_gallery($name, $this->upload->data('file_name') , $this->session->userdata('id'));
                redirect('/main');
            }
        }
    }

    public function name_exist($name)
    {
        if ($this->gallery_create_model->name_exist($name, $this->session->userdata('id')))
        {
            $this->form_validation->set_message('name_exist', 'Gallery with such name already exist');
            return false;
        }
        return true;
    }
}