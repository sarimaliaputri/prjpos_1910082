<?php

namespace App\Controllers;

use App\Models\Mbarangmasuk;
use App\Models\Mpemasok;
use App\Models\Mbarang;

class Barangmasuk extends BaseController
{
    public function __construct()
    {
        $this->varpenjualan = new Mbarangmasuk();
        $this->varpemasok = new Mpemasok();
        $this->varbarang = new Mbarang();
    }

    public function index()
    {
        $tombolCaribarangmasuk = $this->request->getPost('tombolcaribarangmasuk');
        if (isset($tombolCaribarangmasuk)) {
            $cari = $this->request->getPost('caribarangmasuk');
            session()->set('caribarangmasuk', $cari);
            redirect()->to('/barangmasuk/index');
        } else {
            $cari = session()->get('caribarangmasuk');
        }
        $databarangmasuk = $cari ? $this->varpenjualan->cariData($cari) : $this->varpenjualan->join('detailmasuk_1910082', 'detailnofak_1910082=nofakmasuk_1910082')->join('pemasok_1910082', 'masukkdpem_1910082=kdpem_1910082')->join('barang_1910082', 'detailkdbrg_1910082=kdbrg_1910082');
        $noHalaman = $this->request->getVar('page_barangmasuk') ? $this->request->getVar('page_barangmasuk') : 1;
        $data = [
            'databarangmasuk' => $databarangmasuk->paginate(5, 'barangmasuk'), 'pager' => $this->varpenjualan->pager,
            'nohalaman' => $noHalaman,
            'cari' => $cari
        ];
        return view('barangmasuk/vdata', $data);
    }

    public function datapemasok()
    {
        $data = [
            'datapemasok' => $this->varpemasok->findAll()
        ];
        $msg = [
            'data' => view('barangmasuk/modalpemasok', $data)
        ];
        echo json_encode($msg);
    }

    public function databarang()
    {
        $data = [
            'databarang' => $this->varbarang->findAll()
        ];
        $msg = [
            'data' => view('barangmasuk/modalbarang', $data)
        ];
        echo json_encode($msg);
    }

    public function add()
    {
        return view('barangmasuk/formtambah');
    }

    public function hapusItem()
    {
        if ($this->request->isAJAX()) {
            $id_1910082 = $this->request->getPost('id_1910082');
            $tblTempPenjualan = $this->db->table('bantu_1910082');
            $queryHapus = $tblTempPenjualan->delete(['id_1910082' => $id_1910082]);

            if ($queryHapus) {
                $msg = [
                    'sukses' => 'berhasil'
                ];
                echo json_encode($msg);
            }
        }
    }

    public function simpanTemp()
    {
        // if ($this->request->isAJAX()) {
        $kdbrg_1910082 = $this->request->getPost('kdbrg_1910082');
        $jml_1910082 = $this->request->getPost('jumlah_1910082');
        $hrg_1910082 = $this->request->getPost('harga_1910082');
        $nofakmasuk_1910082 = $this->request->getPost('nofakmasuk_1910082');

        // lakukan insert ke temp penjualan
        $tblTempPenjualan = $this->db->table('bantu_1910082');

        $insertData = [
            'idbrg_1910082' => $kdbrg_1910082,
            'qty_1910082' => $jml_1910082,
            'hrg_1910082' => $hrg_1910082,
            'faktur_1910082' => $nofakmasuk_1910082
        ];

        $tblTempPenjualan->insert($insertData);
        $msg = ['sukses' => 'berhasil'];
        echo json_encode($msg);
    }

    public function dataDetail()
    {
        $nofakmasuk_1910082 = $this->request->getVar('nofakmasuk_1910082');

        $tempPenjualan = $this->db->table('bantu_1910082');
        $queryTampil = $tempPenjualan->select('id_1910082 as idbantu_1910082,idbrg_1910082 as id_1910082, namabrg_1910082,satuanbrg_1910082,hrg_1910082 as hargajual_1910082, qty_1910082 as jml_1910082, (hrg_1910082 * qty_1910082) as subtotal_1910082')->join('barang_1910082', 'idbrg_1910082=kdbrg_1910082')->where('faktur_1910082', $nofakmasuk_1910082);

        $data = [
            'datadetail' => $queryTampil->get(),
        ];

        $msg = [
            'data' => view('barangmasuk/viewdetail', $data)
        ];
        echo json_encode($msg);
    }

    function simpandata()
    {
        if ($this->request->isAJAX()) {
            $nofakmasuk_1910082 = $this->request->getVar('nofakmasuk_1910082');
            $masukkdpem_1910082 = $this->request->getVar('masukkdpem_1910082');

            $validation = \Config\Services::validation();

            $doValid = $this->validate([
                'nofakmasuk_1910082' => [
                    'label' => 'No Faktur',
                    'rules' => 'required|is_unique[produk.nofakmasuk_1910082]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah ada,coba yang lain'
                    ]
                ],
                'masukkdpem_1910082' => [
                    'label' => 'Kode Pemasok',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);

            if (!$doValid) {
                $msg = [
                    'error' => [
                        'errornofakmasuk' => $validation->getError('nofakmasuk_1910082'),
                        'errormasukkdpem' => $validation->getError('masukkdpem_1910082')
                    ]
                ];
            } else {

                $this->produk->insert([
                    'nofakmasuk_1910082' => $nofakmasuk_1910082,
                    'masukkdpem_1910082' => $masukkdpem_1910082
                ]);

                $msg = ['sukses' => 'Barang baru berhasil ditambahkan'];
            }

            echo json_encode($msg);
        }
    }

    public function selesaitransaksi()
    {
        $nofakmasuk_1910082 = $this->request->getPost('nofakmasuk_1910082');
        $tanggal_1910082 = $this->request->getPost('tanggal_1910082');
        $kdpem_1910082 = $this->request->getPost('kdpem_1910082');

        $cekDataTemp = $this->db->table('bantu_1910082')->where('faktur_1910082', $nofakmasuk_1910082)->get();
        if (strlen($nofakmasuk_1910082) > 0) {
            if ($cekDataTemp->getNumRows() > 0) {
                $tblBarangMasuk = $this->db->table('barangmasuk_1910082');
                $tblDetailMasuk = $this->db->table('detailmasuk_1910082');
                $tblBantu = $this->db->table('bantu_1910082');

                //Simpan ke table barangmasuk
                $tblBarangMasuk->insert([
                    'nofakmasuk_1910082' => $nofakmasuk_1910082,
                    'tglmasuk_1910082' => $tanggal_1910082,
                    'masukkdpem_1910082' => $kdpem_1910082
                ]);

                // ambil data bantu
                $ambilDataTemp = $tblBantu->getWhere(['faktur_1910082' => $nofakmasuk_1910082]);

                $fieldDetailBarangMasuk = [];
                foreach ($ambilDataTemp->getResultArray() as $row) {
                    $fieldDetailBarangMasuk[] = [
                        'detailnofak_1910082' => $row['faktur_1910082'],
                        'detailkdbrg_1910082' => $row['idbrg_1910082'],
                        'detailqty_1910082' => $row['qty_1910082'],
                        'detailhrgbrg_1910082' => $row['hrg_1910082'],
                    ];
                }
                $tblDetailMasuk->insertBatch($fieldDetailBarangMasuk);

                // Hapus data pada table bantu
                $tblBantu->emptyTable();

                session()->setFlashdata('error', '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Berhasil!</h5> Transaksi berhasil disimpan...
        </div>');

                return redirect()->to('/barangmasuk/add');
            } else {
                session()->setFlashdata('error', '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Error!</h5>
        Maaf Item belum ditambahkan, silahkan ditambahkan terlebih dahulu...
        </div>');

                return redirect()->to('/barangmasuk/add');
            }
        } else {
            session()->setFlashdata('error', '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Error!</h5> Maaf Nofaktur belum diinputkan...
        </div>');

            return redirect()->to('/barangmasuk/add');
        }
    }
}
