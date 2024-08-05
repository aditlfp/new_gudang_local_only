<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{

    use HasFactory;
    protected $table = [
        'name',
        'type',
        'harga',
        'type_berat',
        'desc'
    ];

}
