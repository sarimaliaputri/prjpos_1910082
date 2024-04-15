<div class="modal fade" id="modaltambahpelanggan" tabindex="-1" aria-labelledby="modaltambahpelangganLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltambahpelangganLabel">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat pelanggan</th>
                        <th>No Telpon</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1;
                    foreach ($datapelanggan as $row) :
                    ?>
                        <tr>
                            <td><?= $nomor++; ?></td>
                            <td><?= $row['kdplg_1910082']; ?></td>
                            <td><?= $row['namaplg_1910082']; ?></td>
                            <td><?= $row['alamatplg_1910082']; ?></td>
                            <td><?= $row['notlp_1910082']; ?></td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" title="Pilih Data" onclick="pilih('<?= $row['kdplg_1910082'] ?>','<?= $row['namaplg_1910082'] ?>')"> Pilih
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="viewmodal" style="display: none;"></div>
</div>
</div>
</div>
<script>
    function pilih(kode_1910082, nama_1910082) {
        $('#kdplg_1910082').val(kode_1910082);
        $('#namaplg_1910082').val(nama_1910082);

        $('#modaltambahpelanggan').modal('hide');
    }
</script>