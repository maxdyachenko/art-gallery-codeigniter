<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_page extends My_Controller {
    private $logged = null;
    public function __construct()
    {
        parent::__construct();
        if (parent::is_user_logged())
            redirect('/main');
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
        $this->form_validation->set_rules('authEmail', 'Email', 'trim|required|valid_email|callback_is_verified');
        $this->form_validation->set_rules('authPswd', 'Password', 'trim|required|min_length[6]|max_length[16]|callback_user_exist['.$this->input->post('authEmail').']');
        $this->form_validation->set_rules('rememberMe', 'Remember Me', 'callback_remember_me');

        if ($this->form_validation->run() == FALSE)
        {
            $data['auth_attr'] = "class='sign-in '";
            $data['reg_attr'] = "class='sign-up '";
            $this->load->view('templates/header');
            $this->load->view('pages/front_page', $data);
        }
        else
        {
            redirect('/main');
        }
    }

    public function remember_me($str)
    {
        if (!$this->logged) return;
        if ($str === 'on')
        {
            $bytes = random_bytes(20);
            $token = bin2hex($bytes);
            if (!$this->front_model->has_remember_token($token, $this->input->post('authEmail')))
            {
                $this->front_model->set_remember_token($token,$this->input->post('authEmail'));
            }

            $this->load->helper('cookie');

            $id = $this->session->userdata('id');
            set_cookie('id', $id, time()+60*60*24*30);
            set_cookie('token', $token, time()+60*60*24*30);

        }
        return true;
    }

    public function is_verified($email)
    {
        if ($this->front_model->mail_exists($email) && !$this->front_model->is_verified($email))
        {
            $this->form_validation->set_message('is_verified', 'Email is not verified');
            $this->logged = false;
            return false;
        }
        return true;
    }

    public function user_exist($pswd, $email)
    {
        if (!$this->front_model->check_user_exist($email, $pswd))
        {
            $this->form_validation->set_message('user_exist', 'Incorrect email or password');
            return false;
        }
        if (is_null($this->logged)) {
            $this->logged = true;
        }
        $data = $this->front_model->get_user($email);
        $this->session->set_userdata('id', $data->id);
        $this->session->set_userdata('username', $data->name);

        return true;
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
        $message = "Please, click this link to verify your email: " . base_url() . "verify-email/code/" . $data['code'];
        $this->email->message($message);

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
