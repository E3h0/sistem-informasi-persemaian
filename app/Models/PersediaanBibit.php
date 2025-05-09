<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersediaanBibit extends Model
{
    protected $table = "persediaan_bibit";
    protected $fillable = ["kategori_id", "jenis_bibit", "jumlah_persediaan", "keterangan"];
}
