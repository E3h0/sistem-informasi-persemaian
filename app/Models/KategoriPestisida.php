<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class KategoriPestisida extends Model
{
    protected $table = 'kategori_pestisida';
    protected $guarded = [];

    public function pencatat(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pestisida(): HasMany {
        return $this->hasMany(Pestisida::class, 'kategori_pestisida_id', 'id');
    }

    public function penggunaanPestisida(): HasManyThrough {
        return $this->hasManyThrough(PenggunaanPestisida::class, Pupuk::class, 'kategori_pestisida_id', 'pestisida_id');
    }
}
