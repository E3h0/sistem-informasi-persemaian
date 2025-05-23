<?php

namespace App\Models;

use App\Observers\PenggunaanPupukObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

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
}
