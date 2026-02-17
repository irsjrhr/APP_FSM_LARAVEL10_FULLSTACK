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

        $db = $this->db
        ->join('data_user_teknisi', 'data_project.user_teknisi',  '=', 'data_user_teknisi.user')
        ->select([
            'data_project.id_project',
            'data_project.id_produk',
            'data_project.user_teknisi',
            'data_project.user_client',
            'data_project.nama_project',
            'data_project.deskripsi_project',
            'data_project.id_dokumen_project',
            'data_project.source_dokumen_project',
            'data_project.lok_long', //Ini yang digunakan oleh row_struktur 
            'data_project.lok_lat', //Ini yang digunakan oleh row_struktur 
            'data_project.lok_long AS project_long', //Solving named for Front which is same value with lok_long
            'data_project.lok_lat AS project_lat',//Surving named for Front which is same value with lok_lat
            'data_project.waktu_mulai_project',
            'data_project.waktu_selesai_project',
            'data_project.status_project',
            'data_project.user_pembuat',
            'data_project.waktu AS project_waktu',
            'data_project.status', //Ini yang digunakan oleh row struktur 
            'data_project.waktu', //Ini yang digunakan oleh row struktur
            'data_project.status AS project_status',
            'data_project.waktu AS project_waktu',
            'data_project.status AS project_status',


            'data_user_teknisi.id_user_teknisi',
            'data_user_teknisi.user',
            'data_user_teknisi.lok_long AS teknisi_long',
            'data_user_teknisi.lok_lat AS teknisi_lat',
            'data_user_teknisi.status_teknisi AS teknisi_status',
            'data_user_teknisi.last_update_lacak AS teknisi_last_update_lacak',
            'data_user_teknisi.user_pembuat AS teknisi_user_pembuat',
            'data_user_teknisi.waktu AS teknisi_waktu',
            'data_user_teknisi.status AS teknisi_status_data'
        ])
        ->where( $where )
        ->orderBy('data_project.waktu', 'DESC');
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
                //Ambil index row yang pertama
                $result = $result[0]; 
            }
        }

        //Kalo datanya kosong, maka kembalikan menjadi null
        if ( is_array($result) && empty($result) ) {
            $result = null;
        }

        return $result; //Mengembalikan array associatif
    }
    public function get_monitoring_project($by_id_project){
        $result = $this->get_row( ['id_project' => $by_id_project ] );
        return $result;
    }


    // ++++++++++++++++++++ TAMBAH DATA ++++++++++++++++
    public function tambah( $row_input = []  ){

        /*  
        Starat :
        - Validasi apakah nama project sudah pernah digunakan atau belum   x
        - Validasi user_client itu ada di data_user atau tidak X 
        - Validasi user_teknisi itu ada di data_user_teknisi atau tidak X
        - Validasi apakah status_teknisi dari user_teknisi itu READY atau tidak  X
        
        */

        $table_user = DB::table('data_user');
        $table_user_teknisi = DB::table('data_user_teknisi');

        $user_client = $row_input['user_client'];
        $user_teknisi = $row_input['user_teknisi'];

        $response = [];
        //Validasi apakah nama project sudah pernah digunakan atau belum 
        $row_project_valid = $this->get_row(['nama_project' => $row_input['nama_project']]);
        // $response['debug'] = $row_input;
        // return $response;
        if ( empty( $row_project_valid ) ) {
            //Jika user nama project belum digunakan 
            //Lakukan validasi apakah client terdafftar akunnya di data_user atau tidak
            $validasi_user_client = $table_user
            ->select('*')
            ->where('user', $user_client )
            ->get()->toArray(); 

            if ( !empty( $validasi_user_client ) ) {    

                //Validasi apakah user_teknisi terdaftar atau tidak
                $validasi_user_teknisi = $table_user_teknisi
                ->select('*')
                ->where('user', $user_teknisi)
                ->get()
                ->map(fn ($row) => (array) $row) //Mengubah setiap row menjadi object row agar jadi arr associatif 
                ->toArray();     
                if ( !empty($validasi_user_teknisi ) ) {
                    //Jika user teknisi terdaftar di database, maka lakukan validasi status teknisi
                    $row_teknisi = $validasi_user_teknisi[0];
                    $status_teknisi = $row_teknisi['status_teknisi'];
                    if ( $status_teknisi == "READY" ) {
                        //JIka semua validasi berhasil dan teknisi READY 
                        $response = $this->tambah_teknisi( $row_input );
                    }else{
                        $response['status'] = false;
                        $response['msg'] = "Gagal menambahkan project! Teknisi $user_teknisi tidak pada status READY!!";
                    }
                }else{
                    //Jika user teknisi belum terdaftar sebagai account 
                    $response['status'] = false;
                    $response['msg'] = "Gagal menambahkan project! Teknisi $user_teknisi tidak terdaftar!!";
                }
            }else{
                //Jika user client belum terdaftar sebagai account 
                $response['status'] = false;
                $response['msg'] = "Gagal menambahkan project! Client $user_client tidak terdaftar!!";   
            }
        }else{
            //Jika user nama project sudah digunakan 
            $response['status'] = false;
            $response['msg'] = "Gagal menambahkan project! nama project sudah digunakan";
        }

        return $response;
    }
    //Melakukan tambah project ke data_project dan update status teknisi ke data_user_teknisi
    public function tambah_teknisi($row_input){
        $data = [
            'id_produk' => $row_input['id_produk'],
            'user_teknisi' => $row_input['user_teknisi'],
            'user_client' => $row_input['user_client'],
            'nama_project' => $row_input['nama_project'],
            'deskripsi_project' => $row_input['deskripsi_project'],
            'id_dokumen_project' => $row_input['id_dokumen_project'],
            'source_dokumen_project' => $row_input['source_dokumen_project'],
            'lok_long' => $row_input['lok_long'],
            'lok_lat' => $row_input['lok_lat'],
            'waktu_mulai_project' => Base_model::waktu($row_input['waktu_mulai_project']),
            'waktu_selesai_project' => null,
            'status_project' => $row_input['status_project'],
            'user_pembuat' => $row_input['user_pembuat'],
            'waktu' => $row_input['waktu'],
            'status' => $row_input['status']
        ];

        $nama_project = $row_input['nama_project'];
        $user_teknisi = $row_input['user_teknisi'];

        try {
            DB::beginTransaction(); // Mulai transaction

            // Insert project
            $this->db->insert($data);

            // Update status teknisi ketika project sudah di bookiing atas nama dia 
            DB::table('data_user_teknisi')
            ->where('user', $user_teknisi)
            ->update([
                'status_teknisi' => 'BOOKING',
                'waktu' => Base_model::waktu()
            ]);

            DB::commit(); // Commit jika semua sukses

            $response['status'] = true;
            $response['msg'] = "Project $nama_project berhasil ditambahkan dan status teknisi diperbarui";

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika ada error

            $response['status'] = false;
            $response['msg'] = "Project $nama_project gagal ditambahkan. Error: " . $e->getMessage();
        }

        return $response;
    }



    // ++++++++++++++++++++ UPDATE DATA ++++++++++++++++


}
