<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SatuanPestisida extends Model
{
    protected $table = 'satuan_pestisida';
    protected $guarded = [];

    public function pencatat(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pestisida(): HasMany {
        return $this->hasMany(Pestisida::class, 'satuan_pestisida_id', 'id');
    }
}
