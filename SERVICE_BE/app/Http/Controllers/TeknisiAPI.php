<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Base_model;
use App\Models\Teknisi_model;

class TeknisiAPI extends Controller{

    private $Teknisi_model;
    public function __construct(){
        $this->Teknisi_model = new Teknisi_model;
    }
    // endpoint : url_service/api/teknisi/get_data
    // Mengambil banyak data
    public function get_data(){
        /* 
        Mengembalikan array kosong kalo gak ada 
        Mengembalikan array index multidimensi isi arr assocatif kalo ada 
        */
        $result = $this->Teknisi_model->get_data([]);
        if ( empty($result) ) {
            $result = null;
        }

        return response()->json( $result, 200 );
    }

    // endpoint : url_service/api/teknisi/get_row
    // Mengambil 1 data
    public function get_row( Request $req ){
        /* 
        Mengembalikan null kalo gak ada 
        Mengembalikan array associatif kalo ada 
        */
        //  account/get_row?by_id_produk
        if (isset($_GET['by_id_produk']) && !empty($_GET['by_id_produk'])) {
            $by_id_produk = $req->input('by_id_produk');
            $result = $this->Teknisi_model->get_row(['id_produk' => $by_id_produk]);
        }else{
            $result = $this->Teknisi_model->get_row([]);
        }

        return response()->json( $result, 200 );
    }
    // endpoint : url_service/api/teknisi/post_tambah_data
    // Menambah data baru
    public function post_tambah_data( Request $req ) {

        $user_pembuat = $req->header('X-User-Login');
        $row_input = [
            "id_produk" => NULL,
            'user' => $req->input('user'),
            'long' => "0",
            'lat' => "0",
            'status_teknisi' => Base_model::status_teknisi('ready'),
            'last_update_lacak' => Base_model::waktu(),
            'user_pembuat' => $user_pembuat,
            'waktu' => Base_model::waktu(),
            'status' => Base_model::status(),
        ];
        $result = $this->Teknisi_model->tambah( $row_input );
        return response()->json($result, 200);
    }

    // endpoint : url_service/api/teknisi/post_update_data 
    // Mengupdate data berdasarkan id teknisi
    public function post_update_data( Request $req ) {

        //  account/post_update_data?by_id_teknisi
        if ( isset($_GET['by_id_teknisi']) && !empty($_GET['by_id_teknisi']) ) {
            // Param GET ?by_user
            $by_id_teknisi = $req->input('by_id_teknisi');
            //POST Data
            $row_input = [
            ];

            // $result = $this->Teknisi_model->update_data_byId( $by_id_teknisi, $row_input );
        }


        return response()->json($result, 200);
    }

}
