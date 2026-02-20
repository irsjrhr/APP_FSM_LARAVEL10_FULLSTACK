<?php

namespace App\Http\Controllers\Modul;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Base_model;

class Modul_teknisi extends Controller{

    //https://url_app/teknisi/dashboard 
    public function dashboard(){  
        $data = [];
        return view( 'Modul_teknisi/dashboard', $data );
    }
     //https://url_app/teknisi/submission_project
    public function submission_project(){  
        $data = [];
        return view( 'Modul_teknisi/submission_project', $data );
    }
    //https://url_app/teknisi/project
    public function project(){
        $data = [];
        return view( 'Modul_teknisi/project', $data);
    }
    //https://url_app/teknisi/monitoring 
    public function monitoring(){
        $data = [];
        return view( 'Modul_teknisi/monitoring', $data);
    }


}

