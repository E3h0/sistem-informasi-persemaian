<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KategoriAlatKerja extends Model
{
    protected $table = 'kategori_alat_kerja';
    protected $guarded = [];

    public function pencatat(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function persediaan(): HasMany {
        return $this->hasMany(PersediaanAlatKerja::class, 'kategori_id', 'id');
    }
}
