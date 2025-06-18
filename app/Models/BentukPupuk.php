<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BentukPupuk extends Model
{
    protected $table = 'bentuk_pupuk';
    protected $guarded = [];

    public function pencatat(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pupuk(): HasMany {
        return $this->hasMany(Pupuk::class, 'bentuk_pupuk_id', 'id');
    }
}
