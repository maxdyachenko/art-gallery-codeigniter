<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery_model extends MY_Model
{
    public function get_gallery_content($id, $user_id)
    {
        $this->db->select('id, gallery_id, gallery_fetch_name, user_img');
        $this->db->from('users_imgs');
        $this->db->where('gallery_id', $id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $res = $query->result_array();
        if ($res)
            return $res;
        return array();
    }

    public function get_gallery_fetch_name($gallery_id, $user_id)
    {
        $this->db->select('fetch_name');
        $this->db->from('gallerys_list');
        $this->db->where('id', $gallery_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $res = $query->row();
        if ($res)
            return $res->fetch_name;
        return false;
    }

    public function insert_image($id, $fetch_name, $user_id, $user_img)
    {
        $data = array(
            'gallery_id' => $id,
            'gallery_fetch_name' => $fetch_name,
            'user_id' => $user_id,
            'user_img' => $user_img
        );

        $this->db->insert('users_imgs', $data);
    }

    public function check_gallery_exist($gallery_id, $user_id)
    {
        $this->db->select('user_id');
        $this->db->from('gallerys_list');
        $this->db->where('id', $gallery_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $res = $query->row();
        if ($res)
            return $res->user_id;
        return false;
    }

    public function delete_image($image_name, $gallery_id, $user_id)
    {
        $this->db->delete('users_imgs', array('user_id' => $user_id, 'user_img' => $image_name, 'gallery_id' => $gallery_id));
    }
}