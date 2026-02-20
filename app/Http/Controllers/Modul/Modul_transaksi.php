<?php

namespace App\Http\Controllers\Modul;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Base_model;


//+++++++ Method dibawah akan ditampilkan dengan asynchronous SPA pada javascripts melalui index +++++++++++
class Modul_transaksi extends Controller{

    //https://url_app/admin/kategori 
    public function kategori(){  
        $data = [];
        return view( 'Modul_transaksi/kategori', $data );
    }
    //https://url_app/admin/pemasukan 
    public function pemasukan(){  
        $data = [];
        return view( 'Modul_transaksi/pemasukan', $data );
    }
    //https://url_app/admin/pengeluaran 
    public function pengeluaran(){  
        $data = [];
        return view( 'Modul_transaksi/pengeluaran', $data );
    }
    //https://url_app/admin/pembayaran 
    public function pembayaran(){  
        $data = [];
        return view( 'Modul_transaksi/pembayaran', $data );
    }

}







