<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SatuanPestisida extends Model
{
    protected $table = 'satuan_pestisida';
    protected $fillable = ['nama_satuan'];

    public function pestisida(): HasMany {
        return $this->hasMany(Pestisida::class, 'satuan_pestisida_id', 'id');
    }
}
