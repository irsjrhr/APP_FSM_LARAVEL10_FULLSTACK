<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Base_model;


// INDEX APLIKASI ENTRY Admin
class Index extends Controller{

    //Method View Untuk Masuk Modul Aplikasi 
    //https://url_app/admin/ 
    public function index(){
        $data_sidebar = Menu::SET_SIDEBAR_MENU();
        $data_modal_menu = Menu::SET_MODAL_MENU();


        // dd($data_sidebar);

        $data = [];
        $data['data_modal_menu'] = $data_modal_menu;
        $data['data_sidebar'] = $data_sidebar;


        return view('Admin/Index/index', $data);
    }
}
class Menu{

    public static $data_sidebar = [];  // Array index multidimensi yang isinya array associatif multidimensi  
    public static $data_modal_menu = []; //Array index multidimensi yang isinya array associatif
    // ++++++++++++++++++++++ METHOD TERKAIT DATA SIDEBAR MENU DI ADMIN +++++

    /*
    $data_sidebar = [   
    //Kalo Row Jenis Row Modulnya adalah MODUL
    [
    "nama_modul" => "Modul 1",
    "data_modul_menu" => [ [ "menu" => "", "icon" => "", "url" => "" ], [ "menu" => "", "icon" => "", "url" => ""] ]
    ], 
    //Kalo Row Jenis Row Modulnya adalah MENU
    [ "menu" => "", "icon" => "", "url" => "" ], [ "menu" => "", "icon" => "", "url" => ""]
    ],
    */


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

    public static function SET_MODAL_MENU(){
        self::$data_modal_menu =  [
            [ "menu" => "Admin", "icon" => "fas fa-users", "url" => asset("admin/") ],
            [ "menu" => "Teknisi", "icon" => "fas fa-users", "url" => asset("teknisi/") ],
            [ "menu" => "User", "icon" => "fas fa-users", "url" => asset("user/") ],
            [ "menu" => "Logout", "icon" => "fas fa-sign-out-alt", "url" => asset("auth/logout") ],
        ];
        return self::$data_modal_menu;
    }
    public static function SET_SIDEBAR_MENU(){
        self::ADD_ROW_MENU_SIDEBAR(
            [ 
                "menu" => "Dashboard", 
                "icon" => "fas fa-th-large", 
                "url" => asset("admin/dashboard") 
            ],
        );
        //++++ Menambahkan modul menu account 
        self::ADD_ROW_MODULMENU_SIDEBAR( 'Modul Account', [
            [ "menu" => "Atur Level", "icon" => "fas fa-key", "url" => asset("admin/level") ],
            [ "menu" => "Atur Account", "icon" => "fas fa-users", "url" => asset("admin/account") ],
            [ "menu" => "Atur Teknisi", "icon" => "fas fa-hard-hat", "url" => asset("admin/teknisi") ]
        ]);
        //++++ Menambahkan modul menu fsm 
        self::ADD_ROW_MODULMENU_SIDEBAR( 'Modul FSM', [
            [ "menu" => "Atur Produk", "icon" => "fas fa-box", "url" => asset("admin/produk") ],
            [ "menu" => "Atur Project", "icon" => "fas fa-tasks", "url" => asset("admin/project") ],
            [ "menu" => "Atur Laporan", "icon" => "fas fa-file-alt", "url" => asset("admin/laporan") ],
            [ "menu" => "Monitoring", "icon" => "fas fa-tv", "url" => asset("admin/monitoring") ],
        ]);
        //++++ Menambahkan modul menu keuangan 
        self::ADD_ROW_MODULMENU_SIDEBAR( 'Modul Transaksi', [
            [ "menu" => "Atur Transaksi Kategori", "icon" => "fas fa-filter", "url" => asset("admin/transaksi_kategori") ],
            [ "menu" => "Atur Pemasukan", "icon" => "fas fa-cash-register", "url" => asset("admin/transaksi_pemasukan") ],
            [ "menu" => "Atur Pengeluaran", "icon" => "fas fa-money-bill", "url" => asset("admin/transaksi_pengeluaran") ],
            [ "menu" => "Atur Pembayaran", "icon" => "fas fa-cash-register", "url" => asset("admin/transaksi_pembayaran") ],
        ]);

        return self::$data_sidebar;
    }

}



