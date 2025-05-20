<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BentukPestisida extends Model
{
    protected $table = 'bentuk_pestisida';
    protected $fillable = ['nama_bentuk'];

    public function pestisida(): HasMany {
        return $this->hasMany(Pestisida::class, 'bentuk_pestisida_id', 'id');
    }
}
