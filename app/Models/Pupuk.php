<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pupuk extends Model
{
    protected $table = 'pupuk';
    protected $guarded = [];

    public function satuan(): BelongsTo {
        return $this->belongsTo(SatuanPupuk::class, 'satuan_pupuk_id');
    }

    public function bentuk(): BelongsTo {
        return $this->belongsTo(BentukPupuk::class, 'bentuk_pupuk_id');
    }

    public function kategori(): BelongsTo {
        return $this->belongsTo(KategoriPupuk::class, 'kategori_pupuk_id');
    }

    public function penggunaan(): HasMany{
        return $this->hasMany(PenggunaanPupuk::class, 'pupuk_id', 'id');
    }
}
