<?php
defined('BASEPATH') or exit('No direct script access allowed');
class LoginModel extends CI_Model
{
    public function get_detail($userName, $password)
    {
        $query = $this->db->get_where('user_detail', array('username' => $userName, 'password' => $password));

        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return "User Not Found!";
        }
        // return $query->result_array();
    }
}
