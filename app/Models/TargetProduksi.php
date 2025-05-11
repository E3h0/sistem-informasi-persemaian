<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetProduksi extends Model
{
    protected $table = "target_produksi";
    protected $fillable = ["bibit_id", "target_produksi", "sudah_diproduksi", "sudah_distribusi", "stok_akhir"];
}
