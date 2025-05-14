<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersediaanBibit extends Model
{
    protected $table = "persediaan_bibit";
    protected $fillable = ["jenis_bibit", "kategori_bibit_id", "jumlah_persediaan", "keterangan"];

    public function kategori(): BelongsTo {
        return $this->belongsTo(KategoriBibit::class, "kategori_bibit_id");
    }
}
