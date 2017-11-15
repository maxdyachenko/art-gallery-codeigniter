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
        if (!$this->check_gallery_exist($gallery_id, $this->session->userdata('id')))
            redirect('404_override');

        $this->data['gallery_id'] = $gallery_id;
        $this->data['content'] = $this->gallery_model->get_gallery_content($gallery_id, $this->session->userdata('id'));
        $this->load->view('templates/header');
        $this->load->view('templates/menu', $this->data);
        $this->load->view('pages/gallery_page', $this->data);
        $this->load->view('templates/footer');
    }

    public function upload_image($gallery_id)
    {
        if (!$this->check_gallery_exist($gallery_id, $this->session->userdata('id')))
            redirect('404_override');
        $this->data['gallery_id'] = $gallery_id;
        $this->load->helper('date');
        $gallery_id = filter_var($gallery_id, FILTER_SANITIZE_NUMBER_INT);
        $gallery_fetch_name = $this->gallery_model->get_gallery_fetch_name($gallery_id, $this->session->userdata('id'));
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
            $this->data['content'] = $this->gallery_model->get_gallery_content($gallery_id, $this->session->userdata('id'));

            $this->load->view('templates/header');
            $this->load->view('templates/menu', $this->data);
            $this->load->view('pages/gallery_page', $this->data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->gallery_model->insert_image($gallery_id, $gallery_fetch_name, $this->session->userdata('id'), $this->upload->data('file_name'));
            redirect(base_url() . 'gallery/' . $gallery_id);
        }
    }

    public function delete_image()
    {
        $this->form_validation->set_rules('name', 'Image name', 'trim|required');
        $this->form_validation->set_rules('gallery', 'Gallery name', 'trim|required|callback_is_integer');


        if ($this->form_validation->run() == FALSE)
        {
            redirect('/main');
        }
        else
        {
            $image_name = filter_var($this->input->post('name'), FILTER_SANITIZE_STRING);
            $gallery_id = $this->input->post('gallery');
            $gallery_fetch = $this->gallery_model->get_gallery_fetch_name($gallery_id, $this->session->userdata('id'));

            $this->gallery_model->delete_image($image_name, $gallery_id, $this->session->userdata('id'));
            unlink(FCPATH ."/uploads/img/user_id_{$this->session->userdata('id')}/gallery_{$gallery_fetch}/{$image_name}");
            redirect(base_url() . 'gallery/' . $gallery_id);
        }
    }

    public function delete_all_images($gallery_id)
    {
        $gallery_id = intval($gallery_id);
        $gallery_fetch = $this->gallery_model->get_gallery_fetch_name($gallery_id, $this->session->userdata('id'));

        if (!$this->gallery_model->delete_all_images($gallery_id, $this->session->userdata('id')))
        {
            redirect(base_url());
            return;
        }

        $dir_path = FCPATH ."/uploads/img/user_id_{$this->session->userdata('id')}/gallery_{$gallery_fetch}";
        $files = glob($dir_path . "/*");
        foreach($files as $file){
            $str = explode('/', $file);
            if(is_file($file) && strpos(end($str), 'avatar') === false){
                unlink($file);
            }
        }
        redirect(base_url() . 'gallery/' . $gallery_id);
    }

    public function delete_selected_images()
    {
        $this->form_validation->set_rules('name', 'Image name', 'trim|required');
        $this->form_validation->set_rules('gallery', 'Gallery name', 'trim|required|callback_is_integer');


        if ($this->form_validation->run() == FALSE)
        {
            redirect('/main');
        }
        else
        {
            $image_name = filter_var($this->input->post('name'), FILTER_SANITIZE_STRING);
            $gallery_id = $this->input->post('gallery');
            $gallery_fetch = $this->gallery_model->get_gallery_fetch_name($gallery_id, $this->session->userdata('id'));

            if (!$this->gallery_model->delete_selected_images($image_name, $gallery_id, $this->session->userdata('id')))
                redirect('/main');
            $files = explode(',', $image_name);

            foreach ($files as $file){
                unlink(FCPATH ."/uploads/img/user_id_{$this->session->userdata('id')}/gallery_{$gallery_fetch}/{$file}");
            }
            redirect(base_url() . 'gallery/' . $gallery_id);
        }
    }

    public function check_gallery_exist($gallery_id)
    {
        return $this->gallery_model->check_gallery_exist($gallery_id, $this->session->userdata('id'));
    }

    public function is_integer($value)
    {
        return is_numeric($value);
    }
}