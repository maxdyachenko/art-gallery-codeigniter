<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Edit_profile_model extends MY_Model
{
    public function edit_user_name($user_id, $name = '', $last_name = '')
    {
        if ($name && $last_name)
        {
            $this->db->set('name', $name);
            $this->db->set('lastname', $last_name);
            $this->db->where('id', $user_id);
            $this->db->update('users');
        }
        else if ($name)
        {
            $this->db->set('name', $name);
            $this->db->where('id', $user_id);
            $this->db->update('users');
        }
        else
        {
            $this->db->set('lastname', $last_name);
            $this->db->where('id', $user_id);
            $this->db->update('users');
        }
    }

    public function check_old_pswd($pswd, $user_id)
    {
        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        $res = $query->row();
        if ($res)
            return password_verify($pswd , $res->password);

        return false;
    }

    public function update_pswd($id, $pswd)
    {
        $hash = password_hash($pswd, PASSWORD_DEFAULT);
        $this->db->set('password', $hash);
        $this->db->where('id', $id);
        $this->db->update('users');
    }

    public function upload_avatar($file, $id)
    {
        $this->db->set('avatar', $file);
        $this->db->where('id', $id);
        $this->db->update('users');
    }
}