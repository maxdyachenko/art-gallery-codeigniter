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
        $sql = "SELECT id FROM users WHERE code = ? AND email = ?";

        return $this->db->query($sql, array($code, $email));
    }

    public function set_verified($email)
    {
        $this->db->set('isverified', 1);
        $this->db->where('email', $email);
        $this->db->update('users');
    }
}
