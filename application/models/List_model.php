<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class List_model extends MY_Model
{
    public function get_data($id)
    {
        $this->db->select('id, name, avatar');
        $this->db->from('gallerys_list');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        $res = $query->result_array();
        if ($res)
            return $res;
        return array();
    }

    public function delete_gallery($id)
    {
        $this->db->delete('gallerys_list', array('id' => $id));
    }

}