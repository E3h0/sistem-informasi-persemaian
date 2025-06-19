<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SatuanPupuk extends Model
{
    protected $table = 'satuan_pupuk';
    protected $guarded = [];

    public function pupuk(): HasMany {
        return $this->hasMany(Pupuk::class, 'satuan_pupuk_id', 'id');
    }
}
