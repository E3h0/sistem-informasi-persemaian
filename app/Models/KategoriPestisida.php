<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPestisida extends Model
{
    protected $table = 'kategori_pestisida';
    protected $fillable = ['nama_kategori'];

    public function pestisida(): HasMany {
        return $this->hasMany(Pestisida::class, 'kategori_pestisida_id', 'id');
    }
}
