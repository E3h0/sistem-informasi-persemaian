<?php

namespace App\Models;

use App\Observers\PenggunaanPestisidaObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

#[ObservedBy(PenggunaanPestisidaObserver::class)]

class PenggunaanPestisida extends Model
{
    protected $table = 'penggunaan_pestisida';
    protected $guarded = [];

    public function pestisida(): BelongsTo {
        return $this->belongsTo(Pestisida::class, 'pestisida_id');
    }

    public function pencatat(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kategoriPestisida(): HasOneThrough {
        return $this->hasOneThrough(KategoriPestisida::class, Pestisida::class, 'id', 'id', 'pestisida_id', 'kategori_pestisida_id');
    }

    public function satuanPestisida(): HasOneThrough {
        return $this->hasOneThrough(SatuanPestisida::class, Pestisida::class, 'id', 'id', 'pestisida_id', 'satuan_pestisida_id');
    }

    public function bentukPestisida(): HasOneThrough {
        return $this->hasOneThrough(BentukPestisida::class, Pestisida::class, 'id', 'id', 'pestisida_id', 'bentuk_pestisida_id');
    }
}
