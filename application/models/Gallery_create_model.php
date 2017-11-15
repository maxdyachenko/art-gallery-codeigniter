<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery_create_model extends MY_Model
{
    const GALLERYS_ALLOWED = 5;

    public function set_gallery($name, $img, $user_id, $fetch_name)
    {
        $data = array(
            'name' => $name,
            'fetch_name' => $fetch_name,
            'avatar'  => $img,
            'user_id'  => $user_id
        );

        $this->db->insert('gallerys_list',$data);
    }

    public function has_limit($id)
    {
        $sql = "SELECT * FROM gallerys_list WHERE user_id = ?";
        $query = $this->db->query($sql, array($id));
        if ($query->num_rows() < self::GALLERYS_ALLOWED)
            return true;
        return false;
    }

    public function name_exist($name, $id)
    {
        $this->db->select('id');
        $this->db->from('gallerys_list');
        $this->db->where('name', $name);
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        $res = $query->row();
        if ($res)
            return $res->id;
        return false;
    }


}