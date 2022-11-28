<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\kategori;
use App\Models\tiket;

class tiket extends Model
{
    protected $fillable =[
        'nama_event','deskripsi','tanggal','lokasi'
    ];

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'id_kategori', 'id');
    }
}
