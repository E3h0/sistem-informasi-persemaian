<?php

namespace App\Models;

use App\Observers\PenggunaanPestisidaObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
