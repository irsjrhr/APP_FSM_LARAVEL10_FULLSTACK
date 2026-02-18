<?php

namespace App\Http\Controllers\Teknisi;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Base_model;


// INDEX APLIKASI ENTRY Teknisi
class Index extends Controller{

    public function __construct(){
        $this->Base_model = new Base_model();
    }

    //Method View Untuk Masuk Modul Aplikasi 
    //https://url_app/teknisi/ 
    public function index(){
        $data_sidebar = Menu::SET_SIDEBAR_MENU();
        $data_modal_menu = Menu::SET_MODAL_MENU();

        $data = [];
        $data['data_modal_menu'] = $data_modal_menu;
        $data['data_sidebar'] = $data_sidebar;
        return view('Teknisi/Index/index', $data);
    }

    //+++++++ Method dibawah akan ditampilkan dengan asynchronous SPA pada javascript melalui index +++++++++++

}


class Menu{

    public static $data_sidebar;
    public static $data_modal_menu;
    // ++++++++++++++++++++++ METHOD TERKAIT DATA SIDEBAR MENU DI ADMIN +++++


    public static function ADD_ROW_MODULMENU_SIDEBAR( $nama_modul, $data_menuModulParam = [ ["menu"=>"MenuContoh","icon"=>"fas fa-coffee","url"=>""] ], $icon = "fas fa-folder"){
        $row_sidebar = [
            "jenis_modul" => "MODUL",
            "nama_modul" => $nama_modul,
            "icon" => $icon,
            "data_modul_menu" => $data_menuModulParam //[ [], [] ]
        ];
        self::$data_sidebar[] = $row_sidebar;         
    }
    public static function ADD_ROW_MENU_SIDEBAR( $row_menu = ["menu"=>"MenuContoh","icon"=>"fas fa-coffee","url"=>""]  ){
        $row_sidebar = [
            "jenis_modul" => "MENU",
            "menu" => "",
            "icon" => "",
            "url" => "",
        ];
        // Mengisi menu, icon, dan url
        $row_sidebar = array_merge(  $row_sidebar, $row_menu );
        self::$data_sidebar[] = $row_sidebar;         
    }

    public static function SET_SIDEBAR_MENU(){
        self::ADD_ROW_MENU_SIDEBAR(
            [ 
                "menu" => "Dashboard", 
                "icon" => "fas fa-th-large", 
                "url" => asset("teknisi/dashboard") 
            ],
        );
        //++++ Menambahkan modul menu course 
        self::ADD_ROW_MODULMENU_SIDEBAR( 'Modul FSM', [
            [ "menu" => "List Project", "icon" => "fas fa-tasks", "url" => asset("teknisi/project") ],
            [ "menu" => "Monitoring", "icon" => "fas fa-tv", "url" => asset("teknisi/monitoring") ],
        ]);

        return self::$data_sidebar;
    }


    public static function SET_MODAL_MENU(){
        self::$data_modal_menu =  [
            [ "menu" => "Admin", "icon" => "fas fa-users", "url" => asset("admin/") ],
            [ "menu" => "Teknisi ", "icon" => "fas fa-users", "url" => asset("teknisi/") ],
            [ "menu" => "User", "icon" => "fas fa-users", "url" => asset("user/") ],
            [ "menu" => "Logout", "icon" => "fas fa-sign-out-alt", "url" => asset("auth/logout") ],
        ];
        return self::$data_modal_menu;
    }


}



