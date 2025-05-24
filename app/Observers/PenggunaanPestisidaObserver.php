<?php

namespace App\Observers;

use App\Models\PenggunaanPestisida;
use App\Models\Pestisida;

class PenggunaanPestisidaObserver
{
    /**
     * Handle the PenggunaanPestisida "created" event.
     */
    public function created(PenggunaanPestisida $penggunaanPestisida): void
    {
        $pestisida = Pestisida::find($penggunaanPestisida->pestisida_id);
        $pestisida->decrement('jumlah_persediaan', $penggunaanPestisida->jumlah_penggunaan);
    }

    /**
     * Handle the PenggunaanPestisida "updated" event.
     */
    public function updated(PenggunaanPestisida $penggunaanPestisida): void
    {
        //
    }

    /**
     * Handle the PenggunaanPestisida "deleted" event.
     */
    public function deleted(PenggunaanPestisida $penggunaanPestisida): void
    {
        //
    }

    /**
     * Handle the PenggunaanPestisida "restored" event.
     */
    public function restored(PenggunaanPestisida $penggunaanPestisida): void
    {
        //
    }

    /**
     * Handle the PenggunaanPestisida "force deleted" event.
     */
    public function forceDeleted(PenggunaanPestisida $penggunaanPestisida): void
    {
        //
    }
}
