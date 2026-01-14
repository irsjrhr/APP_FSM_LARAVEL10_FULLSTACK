<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Account_model extends Model
{
    use HasFactory;

    private $db;
    public function __construct(){
        $this->db = DB::table('data_user');
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
        // $this->db->order_by('data_user.waktu', 'DESC');  // Mengurutkan berdasarkan kolom waktu

        $db = $this->db->select('*')
        ->where( $where )
        ->orderBy('data_user.waktu');
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
    private function account_double_validTambah( $row_input ){
        // Cek apakah user untuk nomor desa sudah digunakan atau belum
        $user = $row_input['user'];
        $email = $row_input['email'];
        $user_double = $this->get_row( ['user' => $user ] );
        $email_double = $this->get_row( ['email' => $email ] );

        $account_validasi = true;
        $msg_false = "Gagal Daftar! ";
        $msg_kolom_false = [];

        // Logik OR dengan skema berbeda proses algoritma dengan nilai output false
        if ( !empty( $user_double ) ) {
            //Jika user sudah pernah digunakan untuk registrasi
            $account_validasi = false;
            $msg_kolom_false[] = "User";
        }

        if ( !empty( $email_double ) ) {
            //Jika user sudah pernah digunakan untuk registrasi
            $account_validasi = false;
            $msg_kolom_false[] = "Email";
        }

        $response = [];
        if ( $account_validasi == true ) {
            $response['status'] = true;
        }else{
            $msg_kolom_false = implode(' dan ', $msg_kolom_false);
            $msg_false .= $msg_kolom_false . " Sudah digunakan oleh akun lain";
            $response['status'] = false;
            $response['msg'] = $msg_false;
        }

        return $response;
    }
    public function tambah( $row_input = []  ){

        /*
        - Validasi konfirmasi password
        - Validasi user dan email double dengan aturan user dan email belum pernah digunakan di akun manapun
        */
        $response = [];
        $user = $row_input['user'];
        $email = $row_input['email'];
        $password = $row_input['password'];
        $password_confirm = $row_input['password_confirm'];

        if ( $password_confirm != $password ) {
            $response['status'] = false;
            $response['msg'] = "Password konfirmasi tidak sama!";
            return $response;
        }
        //Cek  akun double atau tidak, dengan validasi apakah user( nomor desa ) atau  email sudah digunakan atau belum untuk suatu akun saat registrasi
        $account_validasi = $this->account_double_validTambah( $row_input );
        if ( $account_validasi['status'] == true ) {
            $response = $this->tambah_user( $row_input );
        }else{
            $response = $account_validasi;
        }

        return $response;
    }
    public function tambah_user( $row_input ){

        $user = $row_input['user'];
        $password = $row_input['password'];
        $nama = $row_input['nama'];
        $email = $row_input['email'];
        $level = $row_input['level'];
        $user_pembuat = $row_input['user_pembuat'];
        $alamat = $row_input['alamat'];
        $waktu = $row_input['waktu'];
        $status = $row_input['status'];

        //Karena dia adalah user baru maka arahkan ke gambar pfofile default di FE 
        $source_file_profile = "http://localhost/My_Script/SCRIPT_PROJECT/client_product/Konsep_OOP/APP_BASE_CI_3/APP_LMS_CERTARA/asset/gam/user_default.png";
        $id_file_profile = "";


        $data = array(
            'id_user' => null,
            'user' =>  $user,
            'user_pembuat' =>  $user_pembuat,
            'password' =>  $password,
            'id_file_profile' =>  $id_file_profile,
            'source_file_profile' =>  $source_file_profile,
            'nama' =>  $nama,
            'alamat' =>  $alamat,
            'email' =>  $email,
            'level' =>  $level,
            'waktu' => $waktu,
            'status' => $status,
        );

        try{
            $tambah_data = $this->db->insert($data);

            //Response ketika tambah SQL Berjalan
            $response['status'] = true ;
            $response['msg'] = "Akun berhasil didaftarkan";            
        }catch (Exception $e){
            //Response ketika tambah SQLTidak Berjalan 
            $response['status'] = false;
            $response['msg'] = "Akun gagal didaftarkan, masalah query!!" . $e->message;
        }

        return $response;
    }



    // ++++++++++++++++++++ UPDATE DATA ++++++++++++++++
    private function updateAccount_validation_email( $user, $email ){
        //Jika email yang di inputkan itu TIDAK SAMA DENGAN email dia sebelumnya, maka lakukan pengecekan apakah email yang di inputkan pernah digunakan atau belum. TAPI kalo yang diinnputkan emailnya itu SAMA dengan email dia sebelumnya, maka tidak usah di lakukan pengecekan.
        $param_validasi_update = [];
        $row_user_db = $this->get_row(['user' => $user]);

        $email_db = $row_user_db['email'];
        if ( $email_db != $email ) {
            //Jika email yang diinputkan tidak sama dengan email dia sebelumnya, maka dilakukan pengecekan email double
            $cek_email_double = $this->get_row(['email' => $email]);
            if ( !empty($cek_email_double) ) {
                //jika email baru sudah pernah digunnakan oleh akun lain
                $param_validasi_update['status'] = false;
                $param_validasi_update['msg'] = "Gagal melakukan update, email sudah pernah digunakan!";
            }else{
                //Jika email baru belum pernah digunakan oleh akun lain 
                $param_validasi_update['status'] = true;
            }
        }else{
            //Jika email yang diinputkan sama dengan email dia sebelumnya, maka tidak dilakukan pengecekan email double
            $param_validasi_update['status'] = true;
            $param_validasi_update['msg'] = "Gagal melakukan update, email ini sudah digunakan di akun kamu!";
        }

        return $param_validasi_update;
    }
    public function update_data_byUser( $by_user, $row_input ){

        $nama = $row_input['nama'];
        $email = $row_input['email'];
        $id_file_profile = $row_input['id_file_profile'];
        $source_file_profile = $row_input['source_file_profile'];
        $alamat = $row_input['alamat'];

        //Lakukan pengecekan apakah user yang ingin diupdate itu terdaftar atau tidak 
        $row_user_validation = $this->get_row(['user' => $by_user]);
        if ( !empty($row_user_validation) ) {
            //Kalo user yang ingin di update itu ada 

            //Lakukan validasi email double untuk case validation email
            //Jika email yang di inputkan itu TIDAK SAMA DENGAN email dia sebelumnya, maka lakukan pengecekan apakah email yang di inputkan pernah digunakan atau belum. TAPI kalo yang diinnputkan emailnya itu SAMA dengan email dia sebelumnya, maka tidak usah di lakukan pengecekan.
            $updateAccount_validation_email = $this->updateAccount_validation_email( $by_user, $email );
            if ( $updateAccount_validation_email['status'] == true ) {
                //Kalo validasi berhasil 
                $data = array(
                    'nama' =>  $nama,
                    'email' => $email,
                    'id_file_profile' =>  $id_file_profile,
                    'source_file_profile' =>  $source_file_profile,
                    'alamat' =>  $alamat,
                );
                try{
                    $update = $this->db
                    ->where( 'user', $by_user )
                    ->update($data);          

                    //Response ketika update SQL Berjalan dan tidak ada error
                    $response['status'] = true ;
                    $response['msg'] = "User berhasil diupdate";          
                }catch (\Throwable $e){
                    //Response ketika update SQL Tidak Berjalan dan tidak ada error
                    $response['status'] = false;
                    $response['msg'] = "User gagal diupdate, masalah query!!" . $e->message;
                }
            }else{
            //Kalo validasi gagal
                $response = $updateAccount_validation_email;
            } 
        }else{
            $response['status'] = false;
            $response['msg'] = "User gagal diupdate, user tidak terdaftar!!";
        }

        return $response;
    }

}
