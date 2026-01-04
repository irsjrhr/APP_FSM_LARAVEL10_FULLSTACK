<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Account_model;

class Project_model extends Model
{
    use HasFactory;

    private $db;
    public function __construct(){
        $this->db = DB::table('data_project');
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
        // $this->db->order_by('data_project.waktu', 'DESC');  // Mengurutkan berdasarkan kolom waktu

        $db = $this->db->select('*')
        ->where( $where )
        ->orderBy('data_project.waktu');
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
    public function tambah( $row_input = []  ){

        /*  
        Starat :
        - User yag didaftarkan belum pernah terdaaftar sebagai teknisi
        - User yang didaftarkan punya level teknisi atau level admin di data_user 
        - Validasi apakah user sudah pernah didaftarkan menjadi teknisi
        - Validasi apakah user yang di tambahkan jadi teknisi itu punya level teknisi atau level admin di data_user        */
        $response = [];
        $user = $row_input['user'];
        //Validasi apakah user sudah pernah didaftarkan menjadi teknisi
        $row_userTeknisi_valid = $this->get_row(['user' => $user]);
        if ( empty( $row_userTeknisi_valid ) ) {

            //Jika user belum pernah di daftarkan menjadi teknisi 
            //Validasi apakah user yang di tambahkan jadi teknisi itu punya level teknisi atau level admin tidak di data_user 
            //SELECT * from data_user WHERE ( user = 'shandy' AND level = "admin"  ) OR ( user = 'shandy' => level = 'teknisi'  )
            $row_user_db_builder = DB::table('data_user')
            ->where('user', $user)
            ->whereIn('level', ['admin', 'teknisi']); //Object Builder
            $row_user_db = $row_user_db_builder->first(); //Collection
            if ( !empty( $row_user_db ) ) {
                //Jika user levelnya teknisi di data_user
                $response = $this->tambah_teknisi( $row_input );
            }else{
                //Jika user levelnya bukan teknisi di data_user
                $response['status'] = false;
                $response['msg'] = "Gagal menambahkan teknisi, user $user akunnya bukan level teknisi atau admin";
                $response['debug_sql'] = $row_user_db_builder->toSql();
            }
        }else{
            //Jika user sudah pernah di daftarkan menjadi teknisi 
            $response['status'] = false;
            $response['msg'] = "Gagal menambahkan teknisi, user <b>$user</b> akunnya sudah pernah terdaftar menjadi teknisi!!";
        }

        return $response;
    }
    public function tambah_teknisi( $row_input ){

        $data = [
            "id_user_teknisi" => NULL,
            'user' => $row_input['user'],
            'lok_long' => $row_input['lok_long'],
            'lok_lat' => $row_input['lok_lat'],
            'status_teknisi' => $row_input['status_teknisi'],
            'last_update_lacak' => $row_input['last_update_lacak'],
            'user_pembuat' => $row_input['user_pembuat'],
            'waktu' => $row_input['waktu'],
            'status' => $row_input['status'],
        ];

        $user = $row_input['user'];
        try{
            $tambah_data = $this->db->insert($data);

            //Response ketika tambah SQL Berjalan
            $response['status'] = true ;
            $response['msg'] = "Teknisi $user berhasil di ditambahkan";            
        }catch (Exception $e){
            //Response ketika tambah SQLTidak Berjalan 
            $response['status'] = false;
            $response['msg'] = "Teknisi $user gagal ditambahkan, masalah query!!" . $e->message;
        }

        return $response;
    }



    // ++++++++++++++++++++ UPDATE DATA ++++++++++++++++


}
