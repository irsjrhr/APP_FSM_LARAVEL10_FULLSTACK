<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Base_model;

class Admin extends Controller{

    public function __construct(){
        $this->Base_model = new Base_model();
    }

    //Method View Untuk Masuk Modul Aplikasi 
    //https://url_app/admin/ 
    public function index(){
        $Menu = new Menu();
        $data_sidebar = $Menu->SET_SIDEBAR_MENU();
        $data_modal_menu = $Menu->SET_MODAL_MENU();

        $data = [];
        $data['data_modal_menu'] = $data_modal_menu;
        $data['data_sidebar'] = $data_sidebar;
        return view('Admin/index', $data);
    }

    //+++++++ Method dibawah akan ditampilkan dengan asynchronous SPA pada javascripts melalui index +++++++++++
    //https://url_app/admin/dashboard 
    public function dashboard(){  
        $data = [];
        return view( 'Admin/dashboard', $data );
    }
    //https://url_app/admin/account 
    public function account(){  
        $data = [];
        return view( 'Admin/account', $data );
    }
    //https://url_app/admin/level 
    public function level(){
        $data = [];
        return view( 'Admin/level', $data);
    }   
    //https://url_app/admin/teknisi 
    public function teknisi(){
        $data = [];
        return view( 'Admin/teknisi', $data);
    }
    //https://url_app/admin/produk 
    public function produk(){
        $data = [];
        return view( 'Admin/produk', $data);
    }
    //https://url_app/admin/project 
    public function project(){
        $data = [];
        return view( 'Admin/project', $data);
    }
    //https://url_app/admin/laporan
    public function laporan(){
        $data = [];
        return view( 'Admin/laporan', $data);
    }
    //https://url_app/admin/monitoring 
    public function monitoring(){
        $data = [];
        return view( 'Admin/monitoring', $data);
    }


    // +++++++++ Modul Aplikasi Keuangan +++++++

    // //https://url_app/admin/transaksi_kategori 
    // public function transaksi_kategori(){   
    //     $data = [];
    //     return view( 'Admin/transaksi_kategori', $data );
    // }
    // //https://url_app/admin/transaksi_pemasukan 
    // public function transaksi_pemasukan(){  
    //     $data = [];
    //     return view( 'Admin/transaksi_pemasukan', $data );
    // }
    // //https://url_app/admin/transaksi_pengeluaran 
    // public function transaksi_pengeluaran(){    
    //     $data = [];
    //     return view( 'Admin/transaksi_pengeluaran', $data );
    // }
    // //https://url_app/admin/transaksi_pembayaran 
    // public function transaksi_pembayaran(){ 
    //     $data = [];
    //     return view( 'Admin/transaksi_pembayaran', $data );
    // }
}


class Menu{

    public $data_sidebar;
    public $data_modal_menu;
    // ++++++++++++++++++++++ METHOD TERKAIT DATA SIDEBAR MENU DI ADMIN +++++



    public function ADD_MODUL_MENU( $nama_modul, $data_menuModulParam = [] ){
        $data_menuModul = [
            [ "menu" => $nama_modul, "icon" => "fas fa-arrow-right", "url" => "batas" ]
        ];
        $data_menuModul = array_merge( $data_menuModul, $data_menuModulParam );
        $this->data_sidebar = array_merge( $this->data_sidebar, $data_menuModul );
    }
    public function SET_MODAL_MENU(){
        $this->data_modal_menu =  [
            [ "menu" => "Admin", "icon" => "fas fa-users", "url" => asset("admin/") ],
            [ "menu" => "Teknisi", "icon" => "fas fa-users", "url" => asset("teknisi/") ],
            [ "menu" => "User", "icon" => "fas fa-users", "url" => asset("user/") ],
            [ "menu" => "Logout", "icon" => "fas fa-sign-out-alt", "url" => asset("auth/logout") ],
        ];
        return $this->data_modal_menu;
    }
    public function SET_SIDEBAR_MENU(){
        $this->data_sidebar = [ 
            [ "menu" => "Dashboard", "icon" => "fas fa-th-large", "url" => asset("admin/dashboard") ],
        ];
        //++++ Menambahkan modul menu account 
        $this->ADD_MODUL_MENU( 'Modul Account', [
            [ "menu" => "Atur Level", "icon" => "fas fa-key", "url" => asset("admin/level") ],
            [ "menu" => "Atur Account", "icon" => "fas fa-users", "url" => asset("admin/account") ],
            [ "menu" => "Atur Teknisi", "icon" => "fas fa-hard-hat", "url" => asset("admin/teknisi") ]
        ]);
        //++++ Menambahkan modul menu fsm 
        $this->ADD_MODUL_MENU( 'Modul FSM', [
            [ "menu" => "Atur Produk", "icon" => "fas fa-box", "url" => asset("admin/produk") ],
            [ "menu" => "Atur Project", "icon" => "fas fa-tasks", "url" => asset("admin/project") ],
            [ "menu" => "Atur Laporan", "icon" => "fas fa-file-alt", "url" => asset("admin/laporan") ],
            [ "menu" => "Monitoring", "icon" => "fas fa-tv", "url" => asset("admin/monitoring") ],
        ]);
        //++++ Menambahkan modul menu keuangan 
        // $this->ADD_MODUL_MENU( 'Modul Keuangan', [
        //     [ "menu" => "Atur Transaksi Kategori", "icon" => "fas fa-filter", "url" => asset("admin/transaksi_kategori") ],
        //     [ "menu" => "Atur Pemasukan", "icon" => "fas fa-cash-register", "url" => asset("admin/transaksi_pemasukan") ],
        //     [ "menu" => "Atur Pengeluaran", "icon" => "fas fa-money-bill", "url" => asset("admin/transaksi_pengeluaran") ],
        //     [ "menu" => "Atur Pembayaran", "icon" => "fas fa-cash-register", "url" => asset("admin/transaksi_pembayaran") ],
        // ]);

        return $this->data_sidebar;
    }

}



