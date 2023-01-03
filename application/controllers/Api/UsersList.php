<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class UsersList extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ApiModel/UsersListModel');
    }
    public function index_get()
    {
        $headers = apache_request_headers();
        $head = explode(" ", $headers['Authorization']);

        $token = $head[1];

        $this->response($token, 200);
        // if ($token == $this->session->userdata('access_token')) {
        //     $user = new UsersListModel;
        //     $user_info = $user->get_users_list();

        //     if($user_info){
        //         $resp = array('user_info' => $user_info,
        //                         'token'=> $this->session->userdata('access_token'));
        //         $this->response($user_info, 200);
        //     }else{
        //         $this->response(['status' => FALSE, 'message' => 'No User Found.'], REST_Controller::HTTP_NOT_FOUND);
        //     }
        // } else {
        //     $this->response('Unauthorized Access', 401);
        // }
    }
}
