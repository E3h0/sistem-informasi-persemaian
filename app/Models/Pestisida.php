<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pestisida extends Model
{
    protected $table = 'pestisida';
    protected $guarded = [];

    public function satuan(): BelongsTo {
        return $this->belongsTo(SatuanPestisida::class, 'satuan_pestisida_id');
    }

    public function bentuk(): BelongsTo {
        return $this->belongsTo(BentukPestisida::class, 'bentuk_pestisida_id');
    }

    public function kategori(): BelongsTo {
        return $this->belongsTo(KategoriPestisida::class, 'kategori_pestisida_id');
    }

    public function penggunaan(): HasMany {
        return $this->hasMany(PenggunaanPestisida::class, 'pestisida_id', 'id');
    }
}
