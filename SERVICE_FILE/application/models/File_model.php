<?php 

class File_model extends CI_Model{
	private $path_assetStorage = "asset_storage/";

	public function get_many( $where = [], $callback = null){


		if ( $callback === null ) {
			$callback = function(){
				return 1;
			};
		}
		$callback();

		// $where itu adalah array associatif [ "nama_kolom" => "value" ]
		// Mengembalikan 2 dimensi dengan banyak data dengan method ->result_array()
		//Where disini bertindak sebagai filter dengan logika AND yang optional atau jika misalnya tidak ada where data tetap diambil tanpa filter
		foreach ($where as $key_kolom => $value) {
			$this->db->where($key_kolom, $value);
		}
		

		//Mengurutkan berdasrkan status yang ACTIVE dan waktunya yang terbaru/terbesar
		$this->db->order_by('data_file.id_file', 'DESC');  // Mengurutkan berdasarkan kolom waktu


		$result = $this->db->get('data_file')->result_array();
		//Lakukan agar menjadi suatu penyetaraan yang dapat dihitung, jadi yang keluar itu pasti array
		if ( $result == null ) {
			
			$result = [];
		}
		return $result; //Mengembalikan pasti array multi dimensi,
	}
	public function get_single( $where = []   ){
		// $where itu adalah array associatif [ "nama_kolom" => "value" ]
		// Jadi untuk mengambil single ini harus ada kondisi, gak boleh tidak ada 
		//Mengembalikan 1 dimensi dengan methode ->row_array()
		if ( count($where) > 0 ) {
					//Jika ada kondisinya 
			foreach ($where as $key => $value) {
				$this->db->where( $key, $value );
			}
			$result = $this->db->get('data_file')->row_array(); 
		}else{
			$result = [];
		}
			//Lakukan agar menjadi suatu penyetaraan yang dapat dihitung, jadi yang keluar itu pasti array
		if ( $result == null ) {
			$result = [];
		}
		return $result; //Mengembalikan pasti array 1 dimensi,

	}

	// ++++++ Method Terkait menambahkan dan mengupload data file ke server dan database  
	// public function tambah(){

	// 	$tipe_penyimpanan = $this->input->post('tipe_penyimpanan');
	// 	$method_tambah = "TIDAK ADA TIPE PENYIMPANAN";
	// 	switch ($tipe_penyimpanan) {
	// 		case 'lokal':
	// 		$method_tambah = $this->tambah_file_lokal();
	// 		break;
	// 		case "url":
	// 		$method_tambah = $this->tambah_file_url();
	// 		break;
	// 	}

	// 	return $method_tambah;

	// }


	//Tambah data file baru dengan menyimpan di server lokal aplikasi
	private function path_assetStorage_user( $user ){
		//Membuat alamat untuk akses asset yang disimpan oleh user dalam server lokal
		$path_assetStorageUser =  $this->path_assetStorage . $user . "/";
		//Error Handling, Cek apakah path penyimpanan sudah dibuat atau belum, jika belum maka buat saja  

		//Cek path utama
		if ( is_dir( $this->path_assetStorage ) == false ) {
			//Jika belum buat, maka buat 
			mkdir($this->path_assetStorage);
		}
		//Cek path utama untuk setiap user
		if ( is_dir($path_assetStorageUser) == false ) {
			//Jika belum buat, maka buat 
			mkdir($path_assetStorageUser);
		}

		return $path_assetStorageUser;
	}
	public function tambah_file_lokal(){

		//+++= Upload  dulu
		$input_nama_file = $this->input->post('nama_file');
		//Membuat path asset storage berdasarkan usernya. usernya tersebut di ambil dari input dengan name user_admin dikirimkan oleh user pada FE 
		$user_admin = $this->Base_service->user_login;
		$path_assetStorage_user = $this->path_assetStorage_user($user_admin);
		$space = $user_admin . $this->Base_model->waktu();
		$upload_file = $this->upload_file( $path_assetStorage_user, $space );
		if ( $upload_file['status'] ) {
			//+++  Jika nama file belum digunakan, maka bisa digunakan dan tambah ke db  
			// +++ Tambah Ke DB Berdasarkan yang di upload 
			$file_upload_name = $upload_file['nama_file'];
			//Buat source file 
			$source_file = base_url() . $path_assetStorage_user. $file_upload_name;
			// Tambah ke database
			$response = $this->tambah_file( $source_file );
		}else{
			// Jika nama  sudah digunakan
			$response['status'] = false;
			$response['msg'] = " gagal upload dengan alasan : " . $upload_file['msg'];
		}
		return $response;
	}

	//Tambah data file baru dengan menyimpan di url luar
	public function tambah_file_url(){
		$source_file = $this->input->post('url_file');
		$response = $this->tambah_file( $source_file );

		return $response;
	}

	//Menambahkan data file yang di upload ke server 
	public function tambah_file( $source_file ){
		$user_admin = $this->Base_service->user_login;
		$tipe_penyimpanan = $this->input->post('tipe_penyimpanan', TRUE); //Yang diinginkan user
		$nama_file = $this->input->post('nama_file', TRUE); //Yang diinginkan user
		$status = $this->Base_model->status();
		$waktu = $this->Base_model->waktu();

		//Buatkan size file dalam kb 
		if ( isset($_FILES['upload_file']) ) {
			$file = $_FILES['upload_file'];
			$size_file_ori = $file['size']; //dalam byte
			$size_file_kb = $this->Base_model->byteToKb( $size_file_ori );
		}else{
			//Ini bisa kita anggap sebagai url
			$size_file_kb = 0;
		}

		$data = array(
			'id_file' => null,
			'user_admin' => $user_admin,
			'tipe_penyimpanan' => $tipe_penyimpanan,
			'nama_file' => $nama_file,
			'source_file' => $source_file,
			'size_file_kb' => $size_file_kb,
			'status' =>  $status,
			'waktu' =>  $waktu
		);

		$tambah_data = $this->db->insert('data_file', $data);
		if ( $tambah_data == true ) {
			$response['status'] = true ;
			$response['msg'] = "File berhasil ditambahkan";
		}else{
			$response['status'] = false;
			$response['msg'] = "File gagal ditambahkan, masalah query!!";
		}

		return $response;
	}

	public function to_mb( $value_mb ){
		// Ingat 1 mb = 1000kb
		return $value_mb * 1000; 
	}

	//Melakukan upload file lokal
	public function upload_file( $path_assetStorage, $space ) {
		$config['upload_path'] = $path_assetStorage;
		$config['allowed_types'] = '*';
		$config['max_size'] = $this->to_mb(40); //MB

		$file_name = $_FILES["upload_file"]["name"]; //Nama file lengkap dengan eksistensi

		$extension = pathinfo($file_name, PATHINFO_EXTENSION);
		$nama_file_baru = uniqid() . "_file_"  . $space . "_" . uniqid() . "." . $extension;

		$config['file_name'] = $nama_file_baru;

		//Library ci upload
		$this->load->library('upload', $config);

		$response =  []; 
		$upload_file_ci = $this->upload->do_upload('upload_file');
		if ( $upload_file_ci == true ) {
			$data_upload = $this->upload->data();
			$response['status'] = true;
			$response['msg'] = "Berhasil mengupload file!!";
			$response['nama_file'] = $nama_file_baru;
			$response['size_file'] = $data_upload['file_size'];
		} else {	
			// echo($_FILES["upload_file"]["error"]);
			// echo "===========ERROR LOG php.ini =========";
			// echo "Error pada konfigurasi php di server, coba cek php.ini <br>";
			// echo "Max upload file size : " . ini_get('upload_max_filesize <br>');
			// echo "Max upload data post size : " .  ini_get('post_max_size <br>');
			// die;
			// $response['status'] = false;
			// $response['msg'] = "Gagal mengupload file .";
			
			$response['status'] = false;
			$response['msg'] = $this->upload->display_errors();
		}

		return $response;
	}

	//Upload file procedural



}