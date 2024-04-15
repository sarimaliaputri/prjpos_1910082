<?php

namespace App\Controllers;

use App\Models\Mbarangkeluar;
use App\Models\Mpelanggan;
use App\Models\Mbarang;

class Barangkeluar extends BaseController
{
    private function buatFaktur()
    {
        $tanggalSekarang = date('Y-m-d');
        $modelBarangKeluar = new Mbarangkeluar();

        $hasil = $modelBarangKeluar->noFaktur($tanggalSekarang)->getRowArray();
        $data = $hasil['nofaktur'];

        $lastNoUrut = substr($data, -4);
        $nextNoUrut = intval($lastNoUrut) + 1;

        $noFaktur = date('dmy', strtotime($tanggalSekarang)) . sprintf('%04s', $nextNoUrut);
        return $noFaktur;
    }

    public function __construct()
    {
        $this->varpenjualan = new Mbarangkeluar();
        $this->varpelanggan = new Mpelanggan();
        $this->varbarang = new Mbarang();
    }

    public function index()
    {
        $tombolCaribarangkeluar = $this->request->getPost('tombolcaribarangkeluar');
        if (isset($tombolCaribarangkeluar)) {
            $cari = $this->request->getPost('caribarangkeluar');
            session()->set('caribarangkeluar', $cari);
            redirect()->to('/barangkeluar/index');
        } else {
            $cari = session()->get('caribarangkeluar');
        }
        $databarangkeluar = $cari ? $this->varpenjualan->cariData($cari) : $this->varpenjualan->join('detailkeluar_1910082', 'detailnofakkeluar_1910082=nofakkeluar_1910082')->join('pelanggan_1910082', 'keluarkdplg_1910082=kdplg_1910082')->join('barang_1910082', 'detailkeluarkdbrg_1910082=kdbrg_1910082');
        $noHalaman = $this->request->getVar('page_barangkeluar') ? $this->request->getVar('page_barangkeluar') : 1;
        $data = [
            'databarangkeluar' => $databarangkeluar->paginate(5, 'barangkeluar'), 'pager' => $this->varpenjualan->pager,
            'nohalaman' => $noHalaman,
            'cari' => $cari
        ];
        return view('barangkeluar/vdata', $data);
    }

    public function datapelanggan()
    {
        $data = [
            'datapelanggan' => $this->varpelanggan->findAll()
        ];
        $msg = [
            'data' => view('barangkeluar/modalpelanggan', $data)
        ];
        echo json_encode($msg);
    }

    public function databarang()
    {
        $data = [
            'databarang' => $this->varbarang->findAll()
        ];
        $msg = [
            'data' => view('barangkeluar/modalbarang', $data)
        ];
        echo json_encode($msg);
    }

    public function add()
    {
        $data = [
            'nofaktur' => $this->buatFaktur()
        ];
        return view('barangkeluar/formtambah', $data);
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
        $nofakkeluar_1910082 = $this->request->getPost('nofakkeluar_1910082');

        // lakukan insert ke temp penjualan
        $tblTempPenjualan = $this->db->table('bantu_1910082');
        $modelBarang = new Mbarang();

        $ambildatabarang = $modelBarang->find($kdbrg_1910082);
        $stokbarang = $ambildatabarang['stokbrg_1910082'];
        if ($jml_1910082 > intval($stokbarang)) {
            $msg = [
                'error' => 'stok tidak mencukupi...'
            ];
        } else {
            $insertData = [
                'idbrg_1910082' => $kdbrg_1910082,
                'qty_1910082' => $jml_1910082,
                'hrg_1910082' => $hrg_1910082,
                'faktur_1910082' => $nofakkeluar_1910082,
            ];

            $tblTempPenjualan->insert($insertData);
            $msg = ['sukses' => 'berhasil'];
        }
        echo json_encode($msg);
    }

    public function dataDetail()
    {
        $nofakkeluar_1910082 = $this->request->getVar('nofakkeluar_1910082');

        $tempPenjualan = $this->db->table('bantu_1910082');
        $queryTampil = $tempPenjualan->select('id_1910082 as idbantu_1910082,idbrg_1910082 as id_1910082, namabrg_1910082,satuanbrg_1910082,hrg_1910082 as hargajual_1910082, qty_1910082 as jml_1910082, (hrg_1910082 * qty_1910082) as subtotal_1910082')->join('barang_1910082', 'idbrg_1910082=kdbrg_1910082')->where('faktur_1910082', $nofakkeluar_1910082);

        $data = [
            'datadetail' => $queryTampil->get(),
        ];

        $msg = [
            'data' => view('barangkeluar/viewdetail', $data)
        ];
        echo json_encode($msg);
    }

    function simpandata()
    {
        if ($this->request->isAJAX()) {
            $nofakkeluar_1910082 = $this->request->getVar('nofakkeluar_1910082');
            $keluarkdplg_1910082 = $this->request->getVar('keluarkdplg_1910082');

            $validation = \Config\Services::validation();

            $doValid = $this->validate([
                'nofakkeluar_1910082' => [
                    'label' => 'No Faktur',
                    'rules' => 'required|is_unique[produk.nofakkeluar_1910082]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah ada,coba yang lain'
                    ]
                ],
                'keluarkdplg_1910082' => [
                    'label' => 'Kode Pelanggan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);

            if (!$doValid) {
                $msg = [
                    'error' => [
                        'errornofakkeluar' => $validation->getError('nofakkeluar_1910082'),
                        'errorkeluarkdplg' => $validation->getError('keluarkdplg_1910082')
                    ]
                ];
            } else {

                $this->produk->insert([
                    'nofakkeluar_1910082' => $nofakkeluar_1910082,
                    'keluarkdplg_1910082' => $keluarkdplg_1910082
                ]);

                $msg = ['sukses' => 'Barang berhasil ditambahkan'];
            }

            echo json_encode($msg);
        }
    }

    public function selesaitransaksi()
    {
        $nofakkeluar_1910082 = $this->request->getPost('nofakkeluar_1910082');
        $tanggal_1910082 = $this->request->getPost('tanggal_1910082');
        $kdplg_1910082 = $this->request->getPost('kdplg_1910082');

        $cekDataTemp = $this->db->table('bantu_1910082')->where('faktur_1910082', $nofakkeluar_1910082)->get();
        if (strlen($nofakkeluar_1910082) > 0) {
            if ($cekDataTemp->getNumRows() > 0) {
                $tblBarangKeluar = $this->db->table('barangkeluar_1910082');
                $tblDetailKeluar = $this->db->table('detailkeluar_1910082');
                $tblBantu = $this->db->table('bantu_1910082');

                //Simpan ke table barangkeluar
                $tblBarangKeluar->insert([
                    'nofakkeluar_1910082' => $nofakkeluar_1910082,
                    'tglkeluar_1910082' => $tanggal_1910082,
                    'keluarkdplg_1910082' => $kdplg_1910082
                ]);

                // ambil data bantu
                $ambilDataTemp = $tblBantu->getWhere(['faktur_1910082' => $nofakkeluar_1910082]);

                $fieldDetailBarangKeluar = [];
                foreach ($ambilDataTemp->getResultArray() as $row) {
                    $fieldDetailBarangKeluar[] = [
                        'detailnofakkeluar_1910082' => $row['faktur_1910082'],
                        'detailkeluarkdbrg_1910082' => $row['idbrg_1910082'],
                        'detailkeluarqty_1910082' => $row['qty_1910082'],
                        'detailkeluarhrg_1910082' => $row['hrg_1910082'],
                    ];
                }
                $tblDetailKeluar->insertBatch($fieldDetailBarangKeluar);

                // Hapus data pada table bantu
                $tblBantu->emptyTable();

                session()->setFlashdata('error', '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Berhasil!</h5> Transaksi berhasil disimpan...
        </div>');

                return redirect()->to('/barangkeluar/add');
            } else {
                session()->setFlashdata('error', '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Error!</h5>
        Maaf Item belum ditambahkan, silahkan ditambahkan terlebih dahulu...
        </div>');

                return redirect()->to('/barangkeluar/add');
            }
        } else {
            session()->setFlashdata('error', '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Error!</h5> Maaf Nofaktur belum diinputkan...
        </div>');

            return redirect()->to('/barangkeluar/add');
        }
    }
}
