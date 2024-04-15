<?php

namespace App\Models;

use CodeIgniter\Model;

class Mpelanggan extends Model
{
    protected $table      = 'pelanggan_1910082';
    protected $primaryKey = 'kdplg_1910082';

    protected $allowedFields = ['kdplg_1910082', 'namaplg_1910082', 'alamatplg_1910082', 'notlp_1910082'];

    public function cariData($cari)
    {
        return $this->table('pelanggan_1910082')->like('namaplg_1910082', $cari);
    }
}
