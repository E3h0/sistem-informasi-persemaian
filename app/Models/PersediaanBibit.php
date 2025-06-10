<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PersediaanBibit extends Model
{
    protected $table = "persediaan_bibit";
    protected $guarded = [];

    public function pencatat(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kategori(): BelongsTo {
        return $this->belongsTo(KategoriBibit::class, "kategori_bibit_id");
    }

    public function targetProduksi(): HasOne {
        return $this->hasOne(TargetProduksi::class, "bibit_id", "id");
    }

    public function mutasiBibit(): HasOne {
        return $this->hasOne(MutasiBibit::class, "bibit_id", "id");
    }
}
