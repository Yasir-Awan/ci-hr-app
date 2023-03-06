<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class AttendanceList extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ApiModel/AttendanceListModel');

    }
    public function index_post()
    {
        $page = $this->post('page');

        $pageSize = $this->post('pageSize');
        if($page==0){
            $start = $page;
        }else{
            $start = ($pageSize * $page)-$pageSize;
        }
        $limit = $pageSize;
        $table = 'view_attendance_detail';
		$columns = array(
			0 => 'id',
			1 => 'user_name',
			2 => 'attendance_date',
			3 => 'shift_name',
            4 => 'checkin',
            5 => 'checkout',
            6 => 'time',
            7 => 'early_sitting',
            8 => 'late_sitting',
            9 => 'extra_time',
            10 => 'acceptable_time'
		);

        $headers = apache_request_headers();
        $head = explode(" ", $headers['Authorization']);

        $token = $head[1];

        

        try {
            $this->load->helper('verifyAuthToken');
            $verifiedToken = verifyToken($token);
            if($verifiedToken){
                $attendance = new AttendanceListModel;
                // $attendance_info = $attendance->get_attendance_list();
                $total_rows = $attendance->count_assets($table);
                $attendance_rows = $attendance->asset_allposts($limit, $start, $table);
                $resp = array('pagesize'=>$pageSize,'page'=>$page,'attendance_rows'=>$attendance_rows,'total_rows'=>$total_rows);
                $this->response($resp, 200);
            }
        }
        catch(Exception $e){
            $error = array("status"=>401,
            "message"=>"Invalid Token Provided",
            "success"=>"false"
        );
            $this->response($error);
        }
    }
}
