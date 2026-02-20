<?php

namespace App\Http\Controllers\Modul;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Base_model;


//+++++++ Method dibawah akan ditampilkan dengan asynchronous SPA pada javascripts melalui index +++++++++++
class Modul_FSM extends Controller{

    //https://url_app/admin/produk 
    public function produk(){
        $data = [];
        return view( 'Modul_FSM/produk', $data);
    }
    //https://url_app/project 
    public function project(){
        $data = [];
        return view( 'Modul_FSM/project', $data);
    }
    //https://url_app/laporan
    public function laporan(){
        $data = [];
        return view( 'Modul_FSM/laporan', $data);
    }
    //https://url_app/monitoring 
    public function monitoring(){
        $data = [];
        return view( 'Modul_FSM/monitoring', $data);
    }
    //https://url_app/teknisi 
    public function teknisi(){
        $data = [];
        return view( 'Modul_FSM/teknisi', $data);
    }

}






