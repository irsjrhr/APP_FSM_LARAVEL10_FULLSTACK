<?php

namespace App\Http\Controllers\Teknisi;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Base_model;

class Modul extends Controller{

    //https://url_app/teknisi/dashboard 
    public function dashboard(){  
        $data = [];
        return view( 'Teknisi/Modul/dashboard', $data );
    }
     //https://url_app/teknisi/submission_project
    public function submission_project(){  
        $data = [];
        return view( 'Teknisi/Modul/submission_project', $data );
    }
    //https://url_app/teknisi/project
    public function project(){
        $data = [];
        return view( 'Teknisi/Modul/project', $data);
    }
    //https://url_app/teknisi/monitoring 
    public function monitoring(){
        $data = [];
        return view( 'Teknisi/Modul/monitoring', $data);
    }


}

