<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class LoginController extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ApiModel/LoginModel');
    }
    public function index_post()
    {
        $jwt = new JWT();
        $JwtSecretKey = "Mysecretwordshere";
        $userName = $this->post('username');
        $password = $this->post('password');
        $loginModel = new LoginModel;
        $user_info = $loginModel->get_detail($userName, $password);

        try {
            if($user_info!= "User Not Found!"){
                $data = array(
                    'user_id' => $user_info[0]['id'],
                    'site' => $user_info[0]['site'],
                    'full_name' => $user_info[0]['fname'] . ' ' . $user_info[0]['lname'],
                    'username' => $user_info[0]['username'],
                    'contact' => $user_info[0]['contact'],
                    'role' => $user_info[0]['employee_role'],
                    'status' => $user_info[0]['status'],
                );

                $token = $jwt->encode($data, $JwtSecretKey, 'HS256');
                $site = $loginModel->get_site_detail($user_info[0]['site']);

                $resp = array(
                    'token' => $token,
                    'site_id' => $site[0]['id'],
                    'site_name' => $site[0]['name'],
                );

                $user_data = array(
                    'user_id' => $user_info[0]['id'],
                    'fname' => $user_info[0]['fname'],
                    'lname' => $user_info[0]['lname'],
                    'full_name' => $user_info[0]['fname'] . ' ' . $user_info[0]['lname'],
                    'role' => $user_info[0]['employee_role'],
                    'site' => $user_info[0]['site'],
                    'access_token' => $token
                );

                $this->response($user_data, 200);
            }
        }
        catch(Exception $e){
            $error = array("status"=>401,
            "message"=>"Invalid Credentials",
            "success"=>"false"
        );
            $this->response($error);
        }
    }
}