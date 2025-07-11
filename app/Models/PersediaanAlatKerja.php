<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersediaanAlatKerja extends Model
{
    protected $table = 'persediaan_alat_kerja';
    protected $guarded = [];

    public function pencatat(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kategori(): BelongsTo {
        return $this->belongsTo(KategoriAlatKerja::class, 'kategori_id');
    }

    public function satuan(): BelongsTo {
        return $this->belongsTo(SatuanAlatKerja::class, 'satuan_id');
    }

}
