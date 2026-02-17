<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Base_model;

class Index extends Controller{

    //Method View Untuk Masuk Modul Aplikasi 
    //https://url_app/admin/ 
    public function index(){
        $data_sidebar = Menu::SET_SIDEBAR_MENU();
        $data_modal_menu = Menu::SET_MODAL_MENU();

        $data = [];
        $data['data_modal_menu'] = $data_modal_menu;
        $data['data_sidebar'] = $data_sidebar;
        return view('Admin/Index/index', $data);
    }
}
class Menu{

    public static $data_sidebar;
    public static $data_modal_menu;
    // ++++++++++++++++++++++ METHOD TERKAIT DATA SIDEBAR MENU DI ADMIN +++++



    public static function ADD_MODUL_MENU( $nama_modul, $data_menuModulParam = [] ){
        $data_menuModul = [
            [ "menu" => $nama_modul, "icon" => "fas fa-arrow-right", "url" => "batas" ]
        ];
        $data_menuModul = array_merge( $data_menuModul, $data_menuModulParam );
        self::$data_sidebar = array_merge( self::$data_sidebar, $data_menuModul );
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
        self::$data_sidebar = [ 
            [ "menu" => "Dashboard", "icon" => "fas fa-th-large", "url" => asset("admin/dashboard") ],
        ];
        //++++ Menambahkan modul menu account 
        self::ADD_MODUL_MENU( 'Modul Account', [
            [ "menu" => "Atur Level", "icon" => "fas fa-key", "url" => asset("admin/level") ],
            [ "menu" => "Atur Account", "icon" => "fas fa-users", "url" => asset("admin/account") ],
            [ "menu" => "Atur Teknisi", "icon" => "fas fa-hard-hat", "url" => asset("admin/teknisi") ]
        ]);
        //++++ Menambahkan modul menu fsm 
        self::ADD_MODUL_MENU( 'Modul FSM', [
            [ "menu" => "Atur Produk", "icon" => "fas fa-box", "url" => asset("admin/produk") ],
            [ "menu" => "Atur Project", "icon" => "fas fa-tasks", "url" => asset("admin/project") ],
            [ "menu" => "Atur Laporan", "icon" => "fas fa-file-alt", "url" => asset("admin/laporan") ],
            [ "menu" => "Monitoring", "icon" => "fas fa-tv", "url" => asset("admin/monitoring") ],
        ]);
        //++++ Menambahkan modul menu keuangan 
        // self::ADD_MODUL_MENU( 'Modul Keuangan', [
        //     [ "menu" => "Atur Transaksi Kategori", "icon" => "fas fa-filter", "url" => asset("admin/transaksi_kategori") ],
        //     [ "menu" => "Atur Pemasukan", "icon" => "fas fa-cash-register", "url" => asset("admin/transaksi_pemasukan") ],
        //     [ "menu" => "Atur Pengeluaran", "icon" => "fas fa-money-bill", "url" => asset("admin/transaksi_pengeluaran") ],
        //     [ "menu" => "Atur Pembayaran", "icon" => "fas fa-cash-register", "url" => asset("admin/transaksi_pembayaran") ],
        // ]);

        return self::$data_sidebar;
    }

}



