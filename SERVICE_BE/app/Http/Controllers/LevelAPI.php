<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Base_model;
use App\Models\Level_model;

class LevelAPI extends Controller{

    private $Level_model;
    public function __construct(){
        $this->Level_model = new Level_model;
    }
    // endpoint : url_service/api/level/get_data
    // Mengambil banyak data
    public function get_data(){
        /* 
        Mengembalikan array kosong kalo gak ada 
        Mengembalikan array index multidimensi isi arr assocatif kalo ada 
        */
        $result = $this->Level_model->get_data([]);
        if ( empty($result) ) {
            $result = null;
        }

        return response()->json( $result, 200 );
    }

    // endpoint : url_service/api/level/get_row
    // Mengambil 1 data
    public function get_row( Request $req ){
        /* 
        Mengembalikan null kalo gak ada 
        Mengembalikan array associatif kalo ada 
        */
        //  account/get_row?by_user
        if (isset($_GET['by_user']) &&  !empty($_GET['by_user'])) {
            $by_user = $req->input('by_user');
            $result = $this->Level_model->get_row(['user' => $by_user]);
        }else{
            $result = $this->Level_model->get_row([]);
        }

        return response()->json( $result, 200 );
    }
    // endpoint : url_service/api/level/post_tambah_data
    // Menambah data baru
    public function post_tambah_data( Request $req ) {

        $user_admin = $req->header('X-User-Login');
        $row_input = array(
            'id_level' => null,
            'nama_level' =>  $req->input('nama_level'),
            'user_admin' =>  $user_admin,
            "waktu" => Base_model::waktu(),
            "status" => Base_model::status(),
        );
        $result = $this->Level_model->tambah( $row_input );
        return response()->json($result, 200);
    }


}
