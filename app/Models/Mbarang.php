<?php

namespace App\Models;

use CodeIgniter\Model;

class Mbarang extends Model
{
    protected $table      = 'barang_1910082';
    protected $primaryKey = 'kdbrg_1910082';

    protected $allowedFields = ['kdbrg_1910082', 'namabrg_1910082', 'satuanbrg_1910082', 'hargabrg_1910082', 'stokbrg_1910082'];

    public function cariData($cari)
    {
        // return $this->table('barang')->like('kdbrg','namabrg', $cari);
        return $this->table('barang_1910082')->like('kdbrg_1910082', $cari)->orLike('namabrg_1910082', $cari);
    }
}
