<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriBibit extends Model
{
    protected $table = "kategori_bibit";
    protected $fillable = ["nama_kategori"];

    public function persediaanBibit(): HasMany {
        return $this->hasMany(PersediaanBibit::class, "kategori_bibit_id", "id");
    }
}
