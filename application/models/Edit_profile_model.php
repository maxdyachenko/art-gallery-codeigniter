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
}