<?php

namespace App\Models;

use CodeIgniter\Model;

class Mbarangkeluar extends Model
{
    protected $table    = 'barangkeluar_1910082';
    protected $primaryKey = 'nofakkeluar_1910082';

    protected $allowedFields = [
        'nofakkeluar_1910082',
        'tglkeluar_1910082',
        'keluarkdplg_1910082',
        'jumlahuang_1910082',
        'sisauang_1910082'
    ];

    public function noFaktur($tanggalSekarang)
    {
        return $this->table('barangkeluar_1910082')->select('max(nofakkeluar_1910082) as nofaktur')->where('tglkeluar_1910082', $tanggalSekarang)->get();
    }

    public function cariData($cari)
    {
        return $this->table('barangkeluar_1910082')->join('detailkeluar_1910082', 'detailnofakkeluar_1910082=nofakkeluar_1910082')->join('barang_1910082', 'detailkeluarkdbrg_1910082=kdbrg_1910082')->join('pelanggan_1910082', 'keluarkdplg_1910082=kdplg_1910082')->orlike('nofakkeluar_1910082', $cari)->orlike('namabrg_1910082', $cari);
    }
}
