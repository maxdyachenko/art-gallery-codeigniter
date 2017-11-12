<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_page extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('front_model');
        $this->load->library('session');
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

        $this->form_validation->set_message('is_unique', '{field} already registered');
        $this->form_validation->set_rules('regEmail', 'Email', 'trim|required|valid_email|is_unique[users.email]');
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
            $this->front_model->primary_register();
            $this->session->set_userdata('user_email', $this->input->post('regEmail'));
            $this->session->set_userdata('user_not_verified', $this->input->post('regEmail'));
            $this->session->set_userdata('user_resend', 3);
            redirect('activate-email');
        }
    }

    public function email_activate()
    {
        if (!$this->session->user_not_verified) redirect(base_url());

        if ($this->session->user_resend > 0)
            $this->session->set_userdata('user_resend', $this->session->user_resend = $this->session->user_resend - 1);


        $data['resends_remain'] = $this->session->user_resend;

        if ($data['resends_remain'])
            $this->send_email($this->session->user_email);


        $this->load->view('templates/header');
        $this->load->view('pages/activate_email', $data);

    }

    public function send_email($email)
    {
        $bytes = random_bytes(15);
        $data['code'] = bin2hex($bytes);
        $this->load->library('email');
        $this->email->from('no-reply@art-gallery.com', 'Art Gallery');
        $this->email->to($email);

        $this->email->subject('Verify your email on Art Gallery');
        $this->email->message($this->load->view('templates/email_template', $data, true));

        $this->email->set_header("Content-type:", "text/html; charset=utf-8 \r\n");
        $this->email->set_header("From", "Art Gallery <no-reply@art-gallery.com>\r\n");

        $this->email->send();

        $this->front_model->save_code($email, $data['code']);
    }

    public function email_verify($code)
    {
        $this->load->helper('security');
        $code = filter_var($code, FILTER_SANITIZE_STRING);
        $code = xss_clean($code);
        if (!$this->session->user_not_verified || !$this->front_model->check_code($code, $this->session->user_email))
        {
            redirect(base_url());
        }
        else
        {
            $this->front_model->set_verified($this->session->user_email);
            $this->session->unset_userdata('user_not_verified');
            $this->load->view('templates/header');
            $this->load->view('pages/email_confirmed');
        }
    }

}
