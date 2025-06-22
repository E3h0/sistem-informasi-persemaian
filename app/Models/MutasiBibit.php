<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

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

    public function totalGha(): int {
        return  $this->gha1 + $this->gha2 + $this->gha3 + $this->gha4;
    }

    public function totalAha(): int {
        return  $this->aha1 + $this->aha2 + $this->aha3 + $this->aha4;
    }

    public function totalOga(): int {
        return  $this->oga1 + $this->oga2 + $this->oga3 + $this->oga4;
    }

    public function kategori(): HasOneThrough {
        return $this->hasOneThrough(KategoriBibit::class, PersediaanBibit::class, 'id', 'id', 'bibit_id', 'kategori_bibit_id');
    }
}
