<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class List_model extends MY_Model
{
    public function get_data($id)
    {
        $this->db->select('id, name, fetch_name, avatar');
        $this->db->from('gallerys_list');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        $res = $query->result_array();
        if ($res)
            return $res;
        return array();
    }

    public function delete_gallery($name, $user_id)
    {
        $this->db->delete('gallerys_list', array('user_id' => $user_id, 'fetch_name' => $name));
    }

}