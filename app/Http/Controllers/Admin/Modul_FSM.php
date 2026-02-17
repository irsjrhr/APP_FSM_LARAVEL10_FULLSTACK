<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Base_model;


//+++++++ Method dibawah akan ditampilkan dengan asynchronous SPA pada javascripts melalui index +++++++++++
class Modul_FSM extends Controller{

    //https://url_app/admin/produk 
    public function produk(){
        $data = [];
        return view( 'Admin/Modul_FSM/produk', $data);
    }
    //https://url_app/admin/project 
    public function project(){
        $data = [];
        return view( 'Admin/Modul_FSM/project', $data);
    }
    //https://url_app/admin/laporan
    public function laporan(){
        $data = [];
        return view( 'Admin/Modul_FSM/laporan', $data);
    }
    //https://url_app/admin/monitoring 
    public function monitoring(){
        $data = [];
        return view( 'Admin/Modul_FSM/monitoring', $data);
    }
    //https://url_app/admin/teknisi 
    public function teknisi(){
        $data = [];
        return view( 'Admin/Modul_FSM/teknisi', $data);
    }

}






