<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
