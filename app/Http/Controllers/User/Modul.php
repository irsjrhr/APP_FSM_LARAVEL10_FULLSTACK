<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Base_model;

class Modul extends Controller{

    //+++++++ Method dibawah akan ditampilkan dengan asynchronous SPA pada javascript melalui index +++++++++++
    //https://url_app/user/dashboard 
    public function dashboard(){  
        $data = [];
        return view( 'User/Modul/dashboard', $data );
    }
    //https://url_app/user/profile 
    public function profile(){
        $data = [];
        return view( 'User/Modul/profile', $data);
    }
    //https://url_app/user/project 
    public function project(){
        $data = [];
        return view( 'User/Modul/project', $data);
    }
    //https://url_app/user/tambah_project 
    public function tambah_project(){
        $data = [];
        return view( 'User/Modul/tambah_project', $data);
    }
    //https://url_app/user/FSM/monitoring 
    public function monitoring(){  
        $data = [];
        return view( 'User/Modul/monitoring', $data );
    }
}