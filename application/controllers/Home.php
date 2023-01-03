<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$db = 'E:\att2000.mdb';
		//phpinfo(); exit;
		if(!file_exists($db)){
		echo "yasir"; exit;
		}
		// $conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
		$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$db; Uid=; Pwd=;");

		$checkinout = $this->db->select('*')->order_by('ref_id', 'desc')->limit(1)->get('checkinout')->result_array();

		if(empty($checkinout)){
			$sql = "SELECT * FROM CHECKINOUT where CHECKTIME > #4/30/2022 11:59:36 PM# ORDER BY id ASC";
		}
		if(!empty($checkinout)){
			$ref_id = $checkinout[0]['ref_id'];
			$sql = "SELECT * FROM CHECKINOUT where id > $ref_id ORDER BY id ASC";
		}
		$result = $db->query($sql)->fetchAll();

		foreach ($result as $row) {
			$import_data = array(
				'userid' => $row['USERID'],
				'ref_id' => $row['id'],
				'checktime' => $row['CHECKTIME'],
				'check_type' => $row['CHECKTYPE'],
				'sensorid' => $row['SENSORID'],
				'sn' => $row['sn'],
			);
			$this->db->insert('checkinout', $import_data);
			// your code here.
		}
	}
}

