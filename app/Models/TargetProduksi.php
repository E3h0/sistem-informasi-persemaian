<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TargetProduksi extends Model
{
    protected $table = "target_produksi";
    protected $fillable = ["bibit_id", "target_produksi", "sudah_diproduksi", "sudah_distribusi", "stok_akhir"];

    protected function bibit(): BelongsTo {
        return $this->belongsTo(PersediaanBibit::class, "bibit_id");
    }
}
