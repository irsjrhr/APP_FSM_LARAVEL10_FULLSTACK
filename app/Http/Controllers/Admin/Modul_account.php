<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Base_model;


//+++++++ Method dibawah akan ditampilkan dengan asynchronous SPA pada javascripts melalui index +++++++++++
class Modul_account extends Controller{

    //https://url_app/admin/account 
    public function account(){  
        $data = [];
        return view( 'Admin/Modul_account/account', $data );
    }
    //https://url_app/admin/level 
    public function level(){
        $data = [];
        return view( 'Admin/Modul_account/level', $data);
    }  


}







