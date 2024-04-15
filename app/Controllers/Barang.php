<?php

namespace App\Controllers;

use App\Models\Mbarang;

class Barang extends BaseController
{
    public function __construct()
    {
        $this->varbarang = new Mbarang();
    }
    public function index()
    {
        $tombolCari = $this->request->getPost('tombolbarang');

        if (isset($tombolCari)) {
            $cari = $this->request->getPost('caribarang');
            session()->set('caribarang', $cari);
            redirect()->to('/barang/index');
        } else {
            $cari = session()->get('caribarang');
        }

        $databarang = $cari ? $this->varbarang->cariData($cari) : $this->varbarang;

        $noHalaman = $this->request->getVar('page_barang') ? $this->request->getVar('page_barang') : 1;
        $data = [
            'databarang' => $databarang->paginate(5, 'barang'),
            'pager' => $this->varbarang->pager,
            'nohalaman' => $noHalaman,
            'cari' => $cari
        ];
        return view('barang/vbarang', $data);
    }

    function formTambah()
    {
        if ($this->request->isAJAX()) {
            $aksi = $this->request->getPost('aksi');
            $msg = [
                'data' => view('barang/modalformtambah', ['aksi' => $aksi])
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak ada halaman yang bisa ditampilkan');
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $kdbrg_1910082 = $this->request->getVar('kdbrg_1910082');
            $namabrg_1910082 = $this->request->getVar('namabrg_1910082');
            $satuanbrg_1910082 = $this->request->getVar('satuanbrg_1910082');
            $hargabrg_1910082 = $this->request->getVar('hargabrg_1910082');
            $stokbrg_1910082 = $this->request->getVar('stokbrg_1910082');

            $this->varbarang->insert([
                'kdbrg_1910082' => $kdbrg_1910082,
                'namabrg_1910082' => $namabrg_1910082,
                'satuanbrg_1910082' => $satuanbrg_1910082,
                'hargabrg_1910082' => $hargabrg_1910082,
                'stokbrg_1910082' => $stokbrg_1910082
            ]);

            $msg = [
                'sukses' => 'Barang berhasil ditambahkan'
            ];
            echo json_encode($msg);
        }
    }

    function hapus()
    {
        if ($this->request->isAJAX()) {
            $kdbrg_1910082 = $this->request->getVar('kdbrg_1910082');

            $this->varbarang->delete($kdbrg_1910082);

            $msg = [
                'sukses' => 'Barang berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    function formEdit()
    {
        if ($this->request->isAJAX()) {
            $kdbrg_1910082 =  $this->request->getVar('kdbrg_1910082');

            $ambildatabarang = $this->varbarang->find($kdbrg_1910082);
            $data = [
                'kdbrg_1910082' => $kdbrg_1910082,
                'namabrg_1910082' => $ambildatabarang['namabrg_1910082'],
                'satuanbrg_1910082' => $ambildatabarang['satuanbrg_1910082'],
                'hargabrg_1910082' => $ambildatabarang['hargabrg_1910082'],
                'stokbrg_1910082' => $ambildatabarang['stokbrg_1910082'],
            ];

            $msg = [
                'data' => view('barang/modalformedit', $data)
            ];
            echo json_encode($msg);
        }
    }

    function updatedata()
    {
        if ($this->request->isAJAX()) {
            $kdbrg_1910082 = $this->request->getVar('kdbrg_1910082');
            $namabrg_1910082 = $this->request->getVar('namabrg_1910082');
            $satuanbrg_1910082 = $this->request->getVar('satuanbrg_1910082');
            $hargabrg_1910082 = $this->request->getVar('hargabrg_1910082');
            $stokbrg_1910082 = $this->request->getVar('stokbrg_1910082');

            $this->varbarang->update($kdbrg_1910082, [
                'namabrg_1910082' => $namabrg_1910082,
                'satuanbrg_1910082' => $satuanbrg_1910082,
                'hargabrg_1910082' => $hargabrg_1910082,
                'stokbrg_1910082' => $stokbrg_1910082
            ]);

            $msg = [
                'sukses' =>  'Data Barang berhasil diupdate'
            ];
            echo json_encode($msg);
        }
    }
}
