<?php

namespace App\Observers;

use App\Models\PenggunaanPupuk;
use App\Models\PersediaanBibit;
use App\Models\Pupuk;

class PenggunaanPupukObserver
{
    /**
     * Handle the PenggunaanPupuk "created" event.
     */
    public function created(PenggunaanPupuk $penggunaanPupuk): void
    {
        $pupuk = Pupuk::find($penggunaanPupuk->pupuk_id);
        $pupuk->decrement('jumlah_persediaan', $penggunaanPupuk->jumlah_penggunaan);
    }

    /**
     * Handle the PenggunaanPupuk "updated" event.
     */
    public function updated(PenggunaanPupuk $penggunaanPupuk): void
    {
        //
    }

    /**
     * Handle the PenggunaanPupuk "deleted" event.
     */
    public function deleted(PenggunaanPupuk $penggunaanPupuk): void
    {
        //
    }

    /**
     * Handle the PenggunaanPupuk "restored" event.
     */
    public function restored(PenggunaanPupuk $penggunaanPupuk): void
    {
        //
    }

    /**
     * Handle the PenggunaanPupuk "force deleted" event.
     */
    public function forceDeleted(PenggunaanPupuk $penggunaanPupuk): void
    {
        //
    }
}
