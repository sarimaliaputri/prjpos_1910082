<?php

namespace App\Controllers;

use App\Models\Mpemasok;

class Pemasok extends BaseController
{
    public function __construct()
    {
        $this->varpemasok = new Mpemasok();
    }
    public function index()
    {
        $tombolCari = $this->request->getPost('tombolpemasok');

        if (isset($tombolCari)) {
            $cari = $this->request->getPost('caripemasok');
            session()->set('caripemasok', $cari);
            redirect()->to('/pemasok/index');
        } else {
            $cari = session()->get('caripemasok');
        }

        $datapemasok = $cari ? $this->varpemasok->cariData($cari) : $this->varpemasok;

        $noHalaman = $this->request->getVar('page_pemasok') ? $this->request->getVar('page_pemasok') : 1;
        $data = [
            'datapemasok' => $datapemasok->paginate(5, 'pemasok'),
            'pager' => $this->varpemasok->pager,
            'nohalaman' => $noHalaman,
            'cari' => $cari
        ];
        return view('pemasok/vpemasok', $data);
    }

    function formTambah()
    {
        if ($this->request->isAJAX()) {
            $aksi = $this->request->getPost('aksi');
            $msg = [
                'data' => view('pemasok/modalformtambah', ['aksi' => $aksi])
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak ada halaman yang bisa ditampilkan');
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $kdpem_1910082 = $this->request->getVar('kdpem_1910082');
            $namapem_1910082 = $this->request->getVar('namapem_1910082');
            $alamatpem_1910082 = $this->request->getVar('alamatpem_1910082');
            $notlp_1910082 = $this->request->getVar('notlp_1910082');
            $this->varpemasok->insert([
                'kdpem_1910082' => $kdpem_1910082,
                'namapem_1910082' => $namapem_1910082,
                'alamatpem_1910082' => $alamatpem_1910082,
                'notlp_1910082' => $notlp_1910082

            ]);

            $msg = [
                'sukses' => 'Pemasok berhasil ditambahkan'
            ];
            echo json_encode($msg);
        }
    }

    function hapus()
    {
        if ($this->request->isAJAX()) {
            $kdpem_1910082 = $this->request->getVar('kdpem_1910082');

            $this->varpemasok->delete($kdpem_1910082);

            $msg = [
                'sukses' => 'Pemasok berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    function formEdit()
    {
        if ($this->request->isAJAX()) {
            $kdpem_1910082 =  $this->request->getVar('kdpem_1910082');

            $ambildatapemasok = $this->varpemasok->find($kdpem_1910082);
            $data = [
                'kdpem_1910082' => $kdpem_1910082,
                'namapem_1910082' => $ambildatapemasok['namapem_1910082'],
                'alamatpem_1910082' => $ambildatapemasok['alamatpem_1910082'],
                'notlp_1910082' => $ambildatapemasok['notlp_1910082'],

            ];

            $msg = [
                'data' => view('pemasok/modalformedit', $data)
            ];
            echo json_encode($msg);
        }
    }

    function updatedata()
    {
        if ($this->request->isAJAX()) {
            $kdpem_1910082 = $this->request->getVar('kdpem_1910082');
            $namapem_1910082 = $this->request->getVar('namapem_1910082');
            $alamatpem_1910082 = $this->request->getVar('alamatpem_1910082');
            $notlp_1910082 = $this->request->getVar('notlp_1910082');

            $this->varpemasok->update($kdpem_1910082, [
                'namapem_1910082' => $namapem_1910082,
                'alamatpem_1910082' => $alamatpem_1910082,
                'notlp_1910082' => $notlp_1910082

            ]);

            $msg = [
                'sukses' =>  'Data Pemasok berhasil diupdate'
            ];
            echo json_encode($msg);
        }
    }
}
