<?php
defined('BASEPATH') or exit('No direct script access allowed');
class LoginModel extends CI_Model
{
    public function get_detail($userName, $password)
    {
        $query = $this->db->get_where('user_detail', array('email' => $userName, 'password' => $password));

        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return "User Not Found!";
        }
        // return $query->result_array();
    }

    public function get_site_detail($site_id)
    {
        $query = $this->db->get_where('sites', array('id' => $site_id));

        if($query->num_rows()>0){
            return $query->result_array();
        }
        // return $query->result_array();
    }
}
