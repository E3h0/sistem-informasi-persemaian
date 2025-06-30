<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SatuanAlatKerja extends Model
{
    protected $table = 'satuan_alat_kerja';
    protected $guarded = [];

    public function pencatat(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alatKerja(): HasMany {
        return $this->hasMany(PersediaanAlatKerja::class, 'satuan_id', 'id');
    }
}
