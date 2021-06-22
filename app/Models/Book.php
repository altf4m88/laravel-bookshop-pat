<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = "tbl_buku";
    protected $primaryKey = "id_buku";
    public $incrementing = false;
    
    public const TAX = 10;
    public const DEFAULT_STOCK = 0;

    
    protected $fillable = [
        'id_buku', 'judul', 'noisbn', 'penulis', 'penerbit', 'tahun', 'stok', 'harga_pokok', 'harga_jual', 'ppn', 'diskon', 'created_at', 'updated_at'
    ];
}
