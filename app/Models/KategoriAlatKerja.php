<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriAlatKerja extends Model
{
    protected $table = 'kategori_alat_kerja';
    protected $fillable = ['nama_kategori'];

    public function persediaan(): HasMany {
        return $this->hasMany(PersediaanAlatKerja::class, 'kategori_id', 'id');
    }
}
