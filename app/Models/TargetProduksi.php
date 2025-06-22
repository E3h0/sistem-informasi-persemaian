<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class TargetProduksi extends Model
{
    protected $table = "target_produksi";
    protected $guarded = [];

    public function pencatat(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bibit(): BelongsTo {
        return $this->belongsTo(PersediaanBibit::class, "bibit_id");
    }

    public function kategori(): HasOneThrough {
        return $this->hasOneThrough(KategoriBibit::class, PersediaanBibit::class, 'id', 'id', 'bibit_id', 'kategori_bibit_id');
    }
}
