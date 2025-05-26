<?php

namespace App\Models;

use App\Observers\PenggunaanPupukObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

#[ObservedBy(PenggunaanPupukObserver::class)]

class PenggunaanPupuk extends Model
{
    protected $table = 'penggunaan_pupuk';
    protected $guarded = [];

    public function pupuk(): BelongsTo {
        return $this->belongsTo(Pupuk::class, 'pupuk_id');
    }

    public function pencatat(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kategoriPupuk(): HasOneThrough {
        return $this->hasOneThrough(KategoriPupuk::class, Pupuk::class, 'id', 'id', 'pupuk_id', 'kategori_pupuk_id');
    }

    public function satuanPupuk(): HasOneThrough {
        return $this->hasOneThrough(SatuanPupuk::class, Pupuk::class, 'id', 'id', 'pupuk_id', 'satuan_pupuk_id');
    }

    public function bentukPupuk(): HasOneThrough {
        return $this->hasOneThrough(BentukPupuk::class, Pupuk::class, 'id', 'id', 'pupuk_id', 'bentuk_pupuk_id');
    }
}
