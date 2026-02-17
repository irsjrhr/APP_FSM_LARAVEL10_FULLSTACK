<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Base_model;


//+++++++ Method dibawah akan ditampilkan dengan asynchronous SPA pada javascripts melalui index +++++++++++
class Modul extends Controller{
    //https://url_app/admin/dashboard 
    public function dashboard(){  
        $data = [];
        return view( 'Admin/Modul/dashboard', $data );
    }
}







