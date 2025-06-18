<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BentukPupuk extends Model
{
    protected $table = 'bentuk_pupuk';
    protected $guarded = [];

    public function pupuk(): HasMany {
        return $this->hasMany(Pupuk::class, 'bentuk_pupuk_id', 'id');
    }
}
