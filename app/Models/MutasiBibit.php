<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MutasiBibit extends Model
{
    protected $table = "mutasi_bibit";
    protected $guarded = [];

    public function pencatat(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bibit(): BelongsTo {
        return $this->belongsTo(PersediaanBibit::class, "bibit_id");
    }

    public function totalGha(){
        return  $this->gha1 + $this->gha2 + $this->gha3 + $this->gha4;
    }
}
