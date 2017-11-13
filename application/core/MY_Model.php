<?php
class MY_Model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function check_token($id, $token)
    {
        $this->db->select('name');
        $this->db->from('users');
        $this->db->where('id', $id);
        $this->db->where('remember_token', $token);
        $query = $this->db->get();
        $res = $query->row();
        if ($res)
            return $res->name;
        return false;
    }

}