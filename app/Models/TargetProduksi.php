<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetProduksi extends Model
{
    protected $table = "target_produksi";
    protected $fillable = ["jenis_bibit", "kategori_bibit_id", "jumlah_persediaan", "keterangan"];
}
