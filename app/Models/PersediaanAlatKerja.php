<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersediaanAlatKerja extends Model
{
    protected $table = 'persediaan_alat_kerja';
    protected $guarded = [];

    public function kategori(): BelongsTo {
        return $this->belongsTo(KategoriAlatKerja::class, 'kategori_id');
    }
}
