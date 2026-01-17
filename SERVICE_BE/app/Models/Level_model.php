<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Level_model extends Model
{
	use HasFactory;

	private $db;
	public function __construct(){
		$this->db = DB::table('data_level');
	}
	public function get_data( $where = [], $callback = false ){

        //Karena berelasi maka kita ambil dari pk nya di tabel data level
        // $this->db->select("*");
        // $where itu adalah array associatif [ "nama_kolom" => "value" ]
        // Mengembalikan 2 dimensi dengan banyak data dengan method ->result_array()
        //Where disini bertindak sebagai filter dengan logika AND yang optional atau jika misalnya tidak ada where data tetap diambil tanpa filter
        // foreach ($where as $key_kolom => $value) {
        //     $this->db->where($key_kolom, $value);
        // }

        //Mengurutkan berdasrkan status yang ACTIVE dan waktunya yang terbaru/terbesar
        // $this->db->order_by("CASE WHEN status = 'ACTIVE' THEN 1 ELSE 2 END", 'ASC'); //Mengurutkan berdasrkan status yang ACTIVE
        // $this->db->order_by('data_level.waktu', 'DESC');  // Mengurutkan berdasarkan kolom waktu

		$db = $this->db->select('*')
		->where( $where )
		->orderBy('data_level.waktu', 'DESC');
		;
		if (is_callable($callback)) {
			$db = callback( $db );
		}
		$result = $db
		->get() //Mendapatkan data collection
		->map(fn ($row) => (array) $row) //Mengubah setiap row menjadi object row agar jadi arr associatif 
		->toArray(); //Mengubahnya menjadi array index multi dimensi yang isinya array associatif 

        //Kalo datanya kosong, maka kembalikan menjadi null
		if ( is_array($result) && empty($result) ) {
			$result = null;
		}
		return $result; //Mengembalikan array index multi dimensi yang isinya array associatif,
	}
	public function get_row( $where = []   ){
        // $where itu adalah array associatif [ "nama_kolom" => "value" ]
        // Jadi untuk mengambil single ini harus ada kondisi, gak boleh tidak ada 

		$result = [];
        //Mengembalikan 1 dimensi dengan methode ->row_array()
		if ( count( $where ) > 0 ) {
			$result = $this->get_data($where);
			if ( !empty( $result ) ) {
				$result = $result[0]; 
			}
		}

        //Kalo datanya kosong, maka kembalikan menjadi null
		if ( is_array($result) && empty($result) ) {
			$result = null;
		}

		return $result; //Mengembalikan array associatif
	}


    // ++++++++++++++++++++ TAMBAH DATA ++++++++++++++++
	public function tambah( $row_input ){
		$response = [];
		$nama_level = $row_input['nama_level'];

		//Lakukan validasi nama level sesuai dengan yang ditentukan. Jadi kalo nama_level itu ada di data_level_wajib, maka dia bisa menambahkan levelnya	
		$data_level_wajib = ['admin', 'teknisi', 'user'];
		$param_level_wajib = false;
		foreach ($data_level_wajib as $key => $level_wajib) {
			if ( $level_wajib == $nama_level ) {
				//Level Wajib Ada
				$param_level_wajib = true;
			}
		}
		//Kalo data level yang di tambahkan gak ada di level wajib, tidak bisa menambahkan
		if ($param_level_wajib == false) {
			$response['status'] = false;
			$response['msg'] = "Nama level tidak sesuai dengan ENUM. Hubungi Developer";
			return $response; //Menghentikan laju fungsi 
		}

		//Cek dulu, apakah nama level sudah digunakan atau belum 
		$cek_nama = $this->get_row( ['nama_level' => $nama_level ] );
		if ( empty($cek_nama) ) {
			//  Jika nama level belum digunakan
			//Cek apakah level menggunakan gambar atau tidak
			$response = $this->tambah_level( $row_input );
		}else{
			// Jika nama level sudah digunakan
			$response['status'] = false;
			$response['msg'] = "Nama level sudah digunakan";
		}

		// var_dump($response);
		return $response;
	}

	public function tambah_level( $row_input = [] ){

		$nama_level = $row_input['nama_level'];
		$user_admin = $row_input['user_pembuat'];
		$waktu = $row_input['waktu'];
		$status = $row_input['status'];

		$data = array(
			'id_level' => null,
			'nama_level' =>  $nama_level,
			'user_admin' =>  $user_admin,
			'waktu' =>  $waktu,
			'status' =>  $status,
		);

		try {
			$tambah_data = $this->db->insert($data);
            //Response ketika tambah SQL Berjalan 
			$response['status'] = true ;
			$response['msg'] = "level berhasil ditambahkan";
		} catch (Exception $e) {
            //Response ketika tambah Tidak SQL Berjalan
			$response['status'] = false;
			$response['msg'] = "level gagal ditambahkan, masalah query!!" . $e->message;
		}
		$tambah_data = $this->db->insert($data);
		if ( $tambah_data == true ) {
			$response['status'] = true ;
			$response['msg'] = "level berhasil ditambahkan";
		}else{
			$response['status'] = false;
			$response['msg'] = "level gagal ditambahkan, masalah query!!";
		}

		return $response;
	}

}





