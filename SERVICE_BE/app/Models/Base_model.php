<?php

namespace App\Models;
use Carbon\Carbon;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_model extends Model
{
    use HasFactory;

    public static function waktu($inputTanggal = null)
    {
    // Tidak ada input → pakai waktu sekarang
        if (empty($inputTanggal)) {
            return now();
        }

    // Ada input tanggal → gabungkan dengan jam sekarang
        return Carbon::parse($inputTanggal)
        ->setTimeFromTimeString(now()->toTimeString());
    }

    public static function status(){
        return "ACTIVE";
    }
    public static function status_teknisi(){
        return "READY";
    }
    public static function status_project(){
        return "PENDING";
    }


}
