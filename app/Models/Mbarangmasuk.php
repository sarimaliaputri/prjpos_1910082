<?php

namespace App\Models;

use CodeIgniter\Model;

class Mbarangmasuk extends Model
{
    protected $table    = 'barangmasuk_1910082';
    protected $primaryKey = 'nofakmasuk_1910082';

    protected $allowedFields = [
        'nofakmasuk_1910082',
        'tglmasuk_1910082',
        'masukkdpem_1910082'
    ];

    public function cariData($cari)
    {
        return $this->table('barangmasuk_1910082')->join('detailmasuk_1910082', 'detailnofak_1910082=nofakmasuk_1910082')->join('barang_1910082', 'detailkdbrg_1910082=kdbrg_1910082')->join('pemasok_1910082', 'masukkdpem_1910082=kdpem_1910082')->orlike('nofakmasuk_1910082', $cari)->orlike('namabrg_1910082', $cari);
    }
}
