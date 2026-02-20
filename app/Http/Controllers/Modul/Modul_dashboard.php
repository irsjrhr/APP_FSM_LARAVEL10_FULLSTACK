<?php

namespace App\Http\Controllers\Modul;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Base_model;


//+++++++ Method dibawah akan ditampilkan dengan asynchronous SPA pada javascripts melalui index +++++++++++
class Modul_dashboard extends Controller{

    //https://url_app/dashboard/dashboard 
    public function dashboard(){  
        $data = [];
        return view( 'Modul_dashboard/dashboard', $data );
    }

}







