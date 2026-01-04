<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_model extends Model
{
    use HasFactory;

    public static function waktu(){
        return date('d-m-y');
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
