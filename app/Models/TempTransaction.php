<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempTransaction extends Model
{
    use HasFactory;
    protected $table = "tbl_tmp_penjualan";
    protected $primarykey = "id_tmp_penjualan";
    public $incrementing = false;
    protected $fillable = [
        'id_buku', 'jumlah_beli', 'total_harga', 
    ];
}
