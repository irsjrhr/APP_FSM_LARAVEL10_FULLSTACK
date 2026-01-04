<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Base_model;
use App\Models\Project_model;

class ProjectAPI extends Controller{

    private $Project_model;
    public function __construct(){
        $this->Project_model = new Project_model;
    }
    // endpoint : url_service/api/project/get_data
    // Mengambil banyak data
    public function get_data(){
        /* 
        Mengembalikan array kosong kalo gak ada 
        Mengembalikan array index multidimensi isi arr assocatif kalo ada 
        */
        $result = $this->Project_model->get_data([]);
        if ( empty($result) ) {
            $result = null;
        }

        return response()->json( $result, 200 );
    }

    // endpoint : url_service/api/project/get_row
    // Mengambil 1 data
    public function get_row( Request $req ){
        /* 
        Mengembalikan null kalo gak ada 
        Mengembalikan array associatif kalo ada 
        */
        //  account/get_row?by_id_project
        if (isset($_GET['by_id_project']) && !empty($_GET['by_id_project'])) {
            $by_id_project = $req->input('by_id_project');
            $result = $this->Project_model->get_row(['id_project' => $by_id_project]);
        }else{
            $result = $this->Project_model->get_row([]);
        }

        return response()->json( $result, 200 );
    }
    // endpoint : url_service/api/project/post_tambah_data
    // Menambah data baru
    public function post_tambah_data( Request $req ) {

        $user_pembuat = $req->header('X-User-Login');


        $row_input = [
            'id_produk' => $req->input('id_produk'),
            'user_teknisi' => $req->input('user_teknisi'),
            'user_client' => $req->input('user_client'),
            'nama_project' => $req->input('nama_project'),
            'deskripsi_project' => $req->input('deskripsi_project'),
            'id_dokumen_project' => $req->input('id_dokumen_project'),
            'source_dokumen_project' => $req->input('source_dokumen_project'),
            'lok_long' => $req->input('lok_long'),
            'lok_lat' => $req->input('lok_lat'),
            'waktu_mulai_project' => $req->input('waktu_mulai_project'),
            'waktu_selesai_project' => null,
            'status_project' => Base_model::status_project(),
            'user_pembuat' => $user_pembuat,
            'waktu' => Base_model::waktu(),
            'status' => Base_model::status(),
        ];

        $result = $this->Project_model->tambah( $row_input );
        return response()->json($result, 200);
    }

    // endpoint : url_service/api/project/post_update_data 
    // Mengupdate data berdasarkan id teknisi
    public function post_update_data( Request $req ) {

        //  account/post_update_data?by_id_teknisi
        if ( isset($_GET['by_id_teknisi']) && !empty($_GET['by_id_teknisi']) ) {
            // Param GET ?by_user
            $by_id_teknisi = $req->input('by_id_teknisi');
            //POST Data
            $row_input = [
            ];

            // $result = $this->Project_model->update_data_byId( $by_id_teknisi, $row_input );
        }


        return response()->json($result, 200);
    }

}
