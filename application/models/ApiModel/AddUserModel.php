<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AddUserModel extends CI_Model
{
    public function add_user($user)
    {
        // echo "<pre>"; print_r($user); exit;
        $userData = array(
            'fname' => $user['fname'],
            'lname' => $user['lname'],
            'contact' => $user['contact'],
            'employee_role' => $user['empRole'],
            'employee_field' => $user['empField'],
            'employee_type' => $user['empType']
        );
        $query = $this->db->insert('user_detail',$userData);
        // return $query->result_array();
    }
}
