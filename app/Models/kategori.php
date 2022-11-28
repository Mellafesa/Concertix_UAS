<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tiket;
use App\Models\kategori;

class kategori extends Model
{
    protected $fillable =[
        'id_tiket', 'nama_kategori','harga'
    ];

    public function tiket()
    {
        return $this->belongsTo(tiket::class, 'id_tiket', 'id');
    }
}
