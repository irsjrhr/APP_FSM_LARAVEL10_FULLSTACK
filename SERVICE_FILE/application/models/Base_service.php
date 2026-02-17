<?php 


//Class Model Ini untuk menangkap header user login yang dikirimkan oleh user melalui ajax jquery request 
class Base_service extends CI_Model{

	public $user_login;// Diisi dari nilai request user 
	public function __construct(){
		$KEY_HEADER_REQUEST_WAJIB = "X-User-Login";

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, token, $KEY_HEADER_REQUEST_WAJIB");

		$header = getallheaders(); // Hanya tersedia jika menggunakan Apache/Nginx
		if ( isset( $header[ $KEY_HEADER_REQUEST_WAJIB ] ) ) {
			$this->user_login = $header[ $KEY_HEADER_REQUEST_WAJIB ];
		}else{
			$this->user_login = "TIDAK_ADA_HEADER_REQUEST_USERLOGIN";
		}
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

}


?>