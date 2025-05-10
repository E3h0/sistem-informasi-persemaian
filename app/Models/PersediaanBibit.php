<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersediaanBibit extends Model
{
    protected $table = "persediaan_bibit";
    protected $fillable = ["jenis_bibit", "kategori_bibit_id", "jumlah_persediaan", "keterangan"];
}
