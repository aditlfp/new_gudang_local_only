<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockGudang extends Model
{
    use HasFactory;
    protected $table = [
        'barang_id',
        'jml',
        'satuan_jumlah'
    ];


    public function Barang()
    {
        $this->belongsTo(Barang::class);
    }
}
