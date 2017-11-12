<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Front_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function primary_register() {
        $name = $this->input->post('regName');
        $last_name = $this->input->post('regLastName');
        $email = $this->input->post('regEmail');
        $hash = password_hash($this->input->post('regPswd'), PASSWORD_DEFAULT);

        $data = array(
            'name' => $name,
            'lastname' => $last_name,
            'email' => $email,
            'password' => $hash
        );

        $this->db->insert('users', $data);
    }

    public function save_code($email, $code){
        $this->db->set('code', $code);
        $this->db->where('email', $email);
        $this->db->update('users');
    }

    public function check_code($code, $email)
    {
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('code', $code);
        $this->db->where('email', $email);
        $query = $this->db->get();
        $res = $query->row();
        if ($res)
            return $res->id;
        return false;
    }

    public function set_verified($email)
    {
        $this->db->set('isverified', 1);
        $this->db->where('email', $email);
        $this->db->update('users');
    }
    public function is_verified($email)
    {
        $this->db->select('isverified');
        $this->db->from('users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $res = $query->row();
        if ($res)
            return $res->isverified;
        return false;
    }


    public function check_user_exist($email, $pswd)
    {
        $sql = "SELECT id, password FROM users WHERE email = '$email'";

        $query = $this->db->query($sql);
        $result = $query->row_array();
        return password_verify($pswd , $result['password']);
    }

    public function get_user_id($email)
    {
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $res = $query->row();
        if ($res)
            return $res->id;
        return false;
    }

    public function set_remember_token($token, $email)
    {
        $this->db->set('remember_token', $token);
        $this->db->where('email', $email);
        $this->db->update('users');
    }

    public function has_remember_token($token, $email)
    {
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('remember_token', $token);
        $this->db->where('email', $email);
        $query = $this->db->get();
        $res = $query->row();
        if ($res)
            return $res->id;
        return false;
    }
}
