<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPupuk extends Model
{
    protected $table = 'kategori_pupuk';
    protected $fillable = ['nama_kategori'];

    public function pupuk(): HasMany {
        return $this->hasMany(Pupuk::class, 'kategori_pupuk_id', 'id');
    }
}
