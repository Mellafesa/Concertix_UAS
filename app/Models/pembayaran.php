<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    protected $fillable =[
        'ewallet_tujuan','jumlah','ewallet_pengirim','nama_pengirim','tanggal_transfer','waktu_transfer'
    ];
}
