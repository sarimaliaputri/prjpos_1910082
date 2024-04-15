<?= $this->extend('template/menu') ?>
<?= $this->section('judul') ?>
<H1> DATA BARANG <h1>
        <?= $this->endSection() ?>
        <?= $this->section('isi') ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <button type="button" class="btn btn-sm btn-primary tombolTambah">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form method="POST" action="/barang/index">

                        <?= csrf_field(); ?>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari Nama Barang" name="caribarang" autofocus value="<?= $cari; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="tombolbarang">Cari</button>
                            </div>
                        </div>
                    </form>

                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Satuan Barang</th>
                                <th>Harga Barang</th>
                                <th>Stok Barang</th>
                                <th>#</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $nomor = 1 + (($nohalaman - 1) * 5);
                            foreach ($databarang as $row) :
                            ?>
                                <tr>
                                    <td><?= $nomor++; ?></td>
                                    <td><?= $row['kdbrg_1910082']; ?></td>
                                    <td><?= $row['namabrg_1910082']; ?></td>
                                    <td><?= $row['satuanbrg_1910082']; ?></td>
                                    <td><?= $row['hargabrg_1910082']; ?></td>
                                    <td><?= $row['stokbrg_1910082']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" title="Hapus Barang" onclick="hapus('<?= $row['kdbrg_1910082'] ?>','<?= $row['namabrg_1910082'] ?>')">
                                            <i class="fa fa-trash-alt"></i>

                                        </button>
                                        <button type="button" class="btn btn-info btn-sm" title="Edit Barang" onclick="edit('<?= $row['kdbrg_1910082'] ?>')">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="float-center">
                        <?= $pager->links('barang', 'paging_data'); ?>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <!-- /.card-footer-->
        </div>

        <div class="viewmodal" style="display: none;"></div>
        <script>
            $(document).ready(function() {
                $('.tombolTambah').click(function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: "<?= site_url('barang/formTambah') ?>",
                        dataType: "json",
                        type: 'post',
                        data: {
                            aksi: 0
                        },
                        success: function(response) {
                            if (response.data) {
                                $('.viewmodal').html(response.data).show();
                                $('#modaltambahbarang').on('shown.bs.modal', function(event) {
                                    $('#kdbrg').focus();
                                });
                                $('#modaltambahbarang').modal('show');
                            }
                        },
                        error: function(xhr, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                });
            });

            function hapus(kdbrg_1910082, namabrg_1910082, satuanbrg_1910082, hargabrg_1910082, stokbrg_1910082) {
                Swal.fire({
                    title: 'Hapus Barang',
                    html: `Yakin hapus nama Barang <strong>${namabrg_1910082}</strong> ini ?`,
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
                            url: "<?= site_url('barang/hapus') ?>",
                            data: {
                                kdbrg_1910082: kdbrg_1910082
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.sukses) {
                                    window.location.reload();
                                }
                            },
                            error: function(xhr, thrownError) {
                                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                            }
                        });
                    }
                })
            }

            function edit(kdbrg_1910082) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('barang/formedit') ?>",
                    data: {
                        kdbrg_1910082: kdbrg_1910082
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.data) {
                            $('.viewmodal').html(response.data).show();
                            $('#modalformedit').on('shown.bs.modal', function(event) {
                                $('#namabrg').focus();
                            });
                            $('#modalformedit').modal('show');
                        }
                    },
                    error: function(xhr, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        </script>
        <?= $this->endSection() ?>