<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KategoriBibit extends Model
{
    protected $table = "kategori_bibit";
    protected $guarded = [];

    public function pencatat(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function persediaanBibit(): HasMany {
        return $this->hasMany(PersediaanBibit::class, "kategori_bibit_id", "id");
    }
}
