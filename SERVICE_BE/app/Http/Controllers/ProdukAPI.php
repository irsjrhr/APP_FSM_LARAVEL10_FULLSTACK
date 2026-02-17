<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Base_model;
use App\Models\Produk_model;

class ProdukAPI extends Controller{

    private $Produk_model;
    public function __construct(){
        $this->Produk_model = new Produk_model;
    }
    // endpoint : url_service/api/produk/get_data
    // Mengambil banyak data
    public function get_data(){
        /* 
        Mengembalikan array kosong kalo gak ada 
        Mengembalikan array index multidimensi isi arr assocatif kalo ada 
        */
        $result = $this->Produk_model->get_data([]);
        if ( empty($result) ) {
            $result = null;
        }

        return response()->json( $result, 200 );
    }

    // endpoint : url_service/api/produk/get_row
    // Mengambil 1 data
    public function get_row( Request $req ){
        /* 
        Mengembalikan null kalo gak ada 
        Mengembalikan array associatif kalo ada 
        */
        //  account/get_row?by_id_produk
        if (isset($_GET['by_id_produk']) && !empty($_GET['by_id_produk'])) {
            $by_id_produk = $req->input('by_id_produk');
            $result = $this->Produk_model->get_row(['id_produk' => $by_id_produk]);
        }else{
            $result = $this->Produk_model->get_row([]);
        }

        return response()->json( $result, 200 );
    }
    // endpoint : url_service/api/produk/post_tambah_data
    // Menambah data baru
    public function post_tambah_data( Request $req ) {

        $user_pembuat = $req->header('X-User-Login');
        $row_input = [
            "nama_produk" => $req->input('nama_produk'),
            "deskripsi_produk" => $req->input('deskripsi_produk'),
            "harga_produk" => $req->input('harga_produk'),
            "id_file_thumb" => $req->input('id_file_thumb'),
            "source_file_thumb" => $req->input('source_file_thumb'),
            "user_pembuat" => $user_pembuat,
            "waktu" => Base_model::waktu(),
            "status" => Base_model::status(),
        ];
        $result = $this->Produk_model->tambah( $row_input );
        return response()->json($result, 200);
    }

    // endpoint : url_service/api/produk/post_update_data 
    // Mengupdate data berdasarkan id produk 
    public function post_update_data( Request $req ) {

        //  account/post_update_data?by_id_produk
        if ( isset($_GET['by_id_produk']) && !empty($_GET['by_id_produk']) ) {
            // Param GET ?by_user
            $by_id_produk = $req->input('by_id_produk');
            //POST Data
            $row_input = [
            ];

            // $result = $this->Produk_model->update_data_byId( $by_id_produk, $row_input );
        }


        return response()->json($result, 200);
    }

}
