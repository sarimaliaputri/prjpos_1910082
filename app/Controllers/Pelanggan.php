<?php

namespace App\Controllers;

use App\Models\Mpelanggan;

class Pelanggan extends BaseController
{
    public function __construct()
    {
        $this->varpelanggan = new Mpelanggan();
    }
    public function index()
    {
        $tombolCari = $this->request->getPost('tombolpelanggan');

        if (isset($tombolCari)) {
            $cari = $this->request->getPost('caripelanggan');
            session()->set('caripelanggan', $cari);
            redirect()->to('/pelanggan/index');
        } else {
            $cari = session()->get('caripelanggan');
        }

        $datapelanggan = $cari ? $this->varpelanggan->cariData($cari) : $this->varpelanggan;

        $noHalaman = $this->request->getVar('page_pelanggan') ? $this->request->getVar('page_pelanggan') : 1;
        $data = [
            'datapelanggan' => $datapelanggan->paginate(5, 'pelanggan'),
            'pager' => $this->varpelanggan->pager,
            'nohalaman' => $noHalaman,
            'cari' => $cari
        ];
        return view('pelanggan/vpelanggan', $data);
    }

    function formTambah()
    {
        if ($this->request->isAJAX()) {
            $aksi = $this->request->getPost('aksi');
            $msg = [
                'data' => view('pelanggan/modalformtambah', ['aksi' => $aksi])
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak ada halaman yang bisa ditampilkan');
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $kdplg_1910082 = $this->request->getVar('kdplg_1910082');
            $namaplg_1910082 = $this->request->getVar('namaplg_1910082');
            $alamatplg_1910082 = $this->request->getVar('alamatplg_1910082');
            $notlp_1910082 = $this->request->getVar('notlp_1910082');
            $this->varpelanggan->insert([
                'kdplg_1910082' => $kdplg_1910082,
                'namaplg_1910082' => $namaplg_1910082,
                'alamatplg_1910082' => $alamatplg_1910082,
                'notlp_1910082' => $notlp_1910082

            ]);

            $msg = [
                'sukses' => 'Pelanggan berhasil ditambahkan'
            ];
            echo json_encode($msg);
        }
    }

    function hapus()
    {
        if ($this->request->isAJAX()) {
            $kdplg_1910082 = $this->request->getVar('kdplg_1910082');

            $this->varpelanggan->delete($kdplg_1910082);

            $msg = [
                'sukses' => 'Pelanggan berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    function formEdit()
    {
        if ($this->request->isAJAX()) {
            $kdplg_1910082 =  $this->request->getVar('kdplg_1910082');

            $ambildatapelanggan = $this->varpelanggan->find($kdplg_1910082);
            $data = [
                'kdplg_1910082' => $kdplg_1910082,
                'namaplg_1910082' => $ambildatapelanggan['namaplg_1910082'],
                'alamatplg_1910082' => $ambildatapelanggan['alamatplg_1910082'],
                'notlp_1910082' => $ambildatapelanggan['notlp_1910082'],

            ];

            $msg = [
                'data' => view('pelanggan/modalformedit', $data)
            ];
            echo json_encode($msg);
        }
    }

    function updatedata()
    {
        if ($this->request->isAJAX()) {
            $kdplg_1910082 = $this->request->getVar('kdplg_1910082');
            $namaplg_1910082 = $this->request->getVar('namaplg_1910082');
            $alamatplg_1910082 = $this->request->getVar('alamatplg_1910082');
            $notlp_1910082 = $this->request->getVar('notlp_1910082');

            $this->varpelanggan->update($kdplg_1910082, [
                'namaplg_1910082' => $namaplg_1910082,
                'alamatplg_1910082' => $alamatplg_1910082,
                'notlp_1910082' => $notlp_1910082

            ]);

            $msg = [
                'sukses' =>  'Data Pelanggan berhasil diupdate'
            ];
            echo json_encode($msg);
        }
    }
}
