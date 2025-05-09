<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutasiBibit extends Model
{
    protected $table = "mutasi_bibit";
    protected $fillable = ["bibit_id", "area_id", "blok_id", "jumlah_bibit", "keterangan"];
}
