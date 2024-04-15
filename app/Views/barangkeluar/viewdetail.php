<table class="table table-striped table-sm table-bordered">
    <thead>
        <tr>
            <th colspan="6"></th>
            <th colspan="2" style="text-align: right;">
                <?php
                $totalharga = 0;
                foreach ($datadetail->getResultArray() as $r) :
                    $totalharga += $r['subtotal_1910082']
                ?>
                <?php endforeach ?>
                <h1> <?= number_format($totalharga, 0, ",", ".") ?></h1>
            </th>

        </tr>
    </thead>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Harga Jual</th>
            <th>Qty</th>
            <th>Sub.Total</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 1;
        foreach ($datadetail->getResultArray() as $r) :
        ?>
            <tr>
                <td><?= $nomor++; ?></td>
                <td><?= $r['id_1910082']; ?></td>
                <td><?= $r['namabrg_1910082']; ?></td>
                <td><?= $r['satuanbrg_1910082']; ?></td>
                <td><?= $r['hargajual_1910082']; ?></td>
                <td><?= $r['jml_1910082']; ?></td>
                <td><?= $r['subtotal_1910082']; ?></td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusitem('<?= $r['idbantu_1910082'] ?>','<?= $r['namabrg_1910082'] ?>')">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach;
        ?>
    </tbody>
</table>

<script>
    function hapusitem(id_1910082, nama_1910082) {
        Swal.fire({
            title: 'Hapus Item ?',
            html: `Yakin menghapus data barang <strong>${nama_1910082}</strong> ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus !',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('barangmasuk/hapusItem') ?>",
                    data: {
                        id_1910082: id_1910082
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses == 'berhasil') {
                            Swal.fire('berhasil', response.sukses, 'success')
                            dataTempBarangKeluar();
                            kosong();
                        }
                    }
                });
            }
        })
    }
</script>