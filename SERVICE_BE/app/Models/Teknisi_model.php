<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Account_model;

class Teknisi_model extends Model
{
    use HasFactory;

    private $db;
    public function __construct(){
        $this->db = DB::table('data_user_teknisi');
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
        // $this->db->order_by('data_user_teknisi.waktu', 'DESC');  // Mengurutkan berdasarkan kolom waktu

        $db = $this->db->select('*')
        ->where( $where )
        ->orderBy('data_user_teknisi.waktu', 'DESC');
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

    // Method ini mengambil data teknisi dengan jarak terdekat dari lokasi client menggunakan algoritma HAVERSINE dan teknisi status_teknisi nya harus READY
    public function get_teknisi_rekomHaversine($lok_lat, $lok_long){

         // Gunakan parameter binding untuk menghindari SQL injection
        $lok_lat = (float) $lok_lat;
        $lok_long = (float) $lok_long;

        // Query menggunakan Query Builder
        $query = DB::table('data_user_teknisi')
        ->join('data_user', 'data_user_teknisi.user', '=', 'data_user.user') // join di sini
        ->select([
            'data_user_teknisi.id_user_teknisi',
            'data_user_teknisi.user',
            'data_user_teknisi.lok_lat',
            'data_user_teknisi.lok_long',
            'data_user_teknisi.status_teknisi',
            'data_user_teknisi.last_update_lacak',
            'data_user_teknisi.user_pembuat',
            'data_user_teknisi.waktu',
            'data_user_teknisi.status',
            'data_user.nama',
            'data_user.source_file_profile',
            DB::raw("(
                6371 * ACOS(
                COS(RADIANS(?)) 
                * COS(RADIANS(CAST(data_user_teknisi.lok_lat AS DECIMAL(10,6)))) 
                * COS(RADIANS(CAST(data_user_teknisi.lok_long AS DECIMAL(10,6))) - RADIANS(?)) 
                + SIN(RADIANS(?)) 
                * SIN(RADIANS(CAST(data_user_teknisi.lok_lat AS DECIMAL(10,6))))
                )
            ) AS jarak_km")
        ])
        ->addBinding($lok_lat, 'select')   // Parameter pertama untuk RADIANS(?)
        ->addBinding($lok_long, 'select')  // Parameter kedua untuk RADIANS(?)
        ->addBinding($lok_lat, 'select')   // Parameter ketiga untuk RADIANS(?)
        ->where('data_user_teknisi.lok_lat', '!=', '0')
        ->where('data_user_teknisi.lok_long', '!=', '0')
        ->orderBy('jarak_km', 'asc')
        ->get();

        // Konversi ke array multidimensi dengan array asosiatif
        $result = $query
        ->map(fn ($row) => (array) $row) //Mengubah setiap row menjadi object row agar jadi arr associatif 
        ->toArray(); //Mengubahnya menjadi array index multi dimensi yang isinya array associatif 
        return $result;
    }


    // ++++++++++++++++++++ TAMBAH DATA ++++++++++++++++
    public function tambah( $row_input = []  ){

        /*  
        Starat :
        - User yag didaftarkan belum pernah terdaaftar sebagai teknisi
        - User yang bisa didaftarkan menjadi terknisi itu adalah user yang punya level teknisi atau level admin di tabel data_user 
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
            'last_update_lacak' => null,
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
