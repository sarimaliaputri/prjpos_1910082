<?php

namespace App\Models;

use CodeIgniter\Model;

class Mpemasok extends Model
{
    protected $table      = 'pemasok_1910082';
    protected $primaryKey = 'kdpem_1910082';

    protected $allowedFields = ['kdpem_1910082', 'namapem_1910082', 'alamatpem_1910082', 'notlp_1910082'];

    public function cariData($cari)
    {
        return $this->table('pemasok_1910082')->like('namapem_1910082', $cari);
    }
}
