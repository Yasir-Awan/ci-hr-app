<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UsersListModel extends CI_Model
{
    public function get_users_list()
    {
        $query = $this->db->get('user_detail');
        return $query->result_array();
    }
}
