<?php  


class Base_model extends CI_Model{

	public 
	$data_tipe_upload,
	$path_assetStorage = "asset_storage/";
	

	public function __construct(){

		//Untuk menjadi pilihan section
		$this->data_tipe_upload = ["video", "file"];
	}	

	//=========== Berkaitan dengan nilai dan data statis aplikasi =========================
	public function set_url( $controller ){
		//Method untuk membuat url pada data basis menu
		return base_url() . $controller;
	}
	public function waktu(){
		return date('Y-m-d');
	}
	public function status(){
		return 'ACTIVE';
	}
	public function send_response( $data_result = [], $status = 200) {
		http_response_code($status);

		// $result = [
		// 	"status" => bool,
		// 	"msg" => "",
		// 	"data" => [],
		// ];

		echo json_encode($data_result);
		exit;
	}
	public function byteToKb($bytes, $precision = 2) {
		return round($bytes / 1024, $precision);
	}
}


































