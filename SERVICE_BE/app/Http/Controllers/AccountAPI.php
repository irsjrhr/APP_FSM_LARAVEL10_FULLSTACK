<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Base_model;
use App\Models\Account_model;

class AccountAPI extends Controller{

    private $Account_model;
    public function __construct(){
        $this->Account_model = new Account_model;
    }
    // endpoint : url_service/api/account/get_data
    // Mengambil banyak data
    public function get_data(){
        /* 
        Mengembalikan array kosong kalo gak ada 
        Mengembalikan array index multidimensi isi arr assocatif kalo ada 
        */
        $result = $this->Account_model->get_data([]);
        if ( empty($result) ) {
            $result = null;
        }

        return response()->json( $result, 200 );
    }

    // endpoint : url_service/api/account/get_row
    // Mengambil 1 data
    public function get_row( Request $req ){
        /* 
        Mengembalikan null kalo gak ada 
        Mengembalikan array associatif kalo ada 
        */
        //  account/get_row?by_user
        if (isset($_GET['by_user']) &&  !empty($_GET['by_user'])) {
            $by_user = $req->input('by_user');
            $result = $this->Account_model->get_row(['user' => $by_user]);
        }else{
            $result = $this->Account_model->get_row([]);
        }

        return response()->json( $result, 200 );
    }
    // endpoint : url_service/api/account/post_tambah_data
    // Menambah data baru
    public function post_tambah_data( Request $req ) {

        $user_pembuat = $req->header('X-User-Login');
        $row_input = [
            "user" => $req->input('user'),
            "nama" => $req->input('nama'),
            "level" => $req->input('level'),
            "email" => $req->input('email'),
            "user_pembuat" => $user_pembuat,
            "password" => $req->input('password'),
            "password_confirm" => $req->input('password_confirm'),
            "alamat" => "NULL",
            "waktu" => Base_model::waktu(),
            "status" => Base_model::status(),
        ];
        $result = $this->Account_model->tambah( $row_input );
        return response()->json($result, 200);
    }

    // endpoint : url_service/api/account/post_update_data 
    // Mengupdate data berdasarkan user 
    public function post_update_data( Request $req ) {

        //  account/post_update_data?by_user
        if ( isset($_GET['by_user']) && !empty($_GET['by_user']) ) {
            // Param GET ?by_user
            $by_user = $req->input('by_user');
            //POST Data
            $row_input = [
                "nama" => $req->input('nama'),
                "email" => $req->input('email'),
                "id_file_profile" => $req->input('id_file_profile'),
                "source_file_profile" => $req->input('source_file_profile'),
                "alamat" => $req->input('alamat'),
            ];

            $result = $this->Account_model->update_data_byUser( $by_user, $row_input );
        }


        return response()->json($result, 200);
    }

}
