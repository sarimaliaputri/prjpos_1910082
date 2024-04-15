<?= $this->extend('template/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fa fa-table"></i> Tambah Barang Keluar</h3>
<?= $this->endSection() ?>

<?= $this->section('isi') ?>
<script src="<?= base_url('assets/plugins/autoNumeric.js') ?>"></script>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" class="btn btn-sm btn-warning" onclick="window.location='<?= site_url('barangkeluar/index') ?>'">
                <i class="fa fa-backward"></i> Kembali
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
        <?= session()->getFlashdata('error'); ?>
        <?= form_open('barangkeluar/selesaitransaksi', ['class' => 'formsimpanbarangkeluar', 'onsubmit' => ' return selesaitransaksi();']) ?>
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nofaktur">Faktur</label>
                    <input type="text" class="form-control form-control-sm" style="color:red;font-weight:bold" name="nofakkeluar_1910082" id="nofakkeluar_1910082" value="<?= $nofaktur ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control form-control-sm" name="tanggal_1910082" id="tanggal_1910082" readonly value="<?= date('Y-m-d'); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="namaplg">Pelanggan</label>
                    <div class="input-group mb-3">
                        <input type="text" value="" class="form-control form-control-sm" placeholder="Nama Pelanggan" name="namaplg_1910082" id="namaplg_1910082" readonly>
                        <input type="hidden" name="kdplg_1910082" id="kdplg_1910082" value="0">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary tombolTambahpelanggan">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="kdbrg">Kode Barang</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-sm" name="kdbrg_1910082" id="kdbrg_1910082">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary tombolTambahbarang">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Nama Barang</label>
                    <input type="text" style="font-weight:bold;font: size 16pt;" class="form-control form-control-sm" name="namabrg_1910082" id="namabrg_1910082" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Satuan Barang</label>
                    <input type="text" style="font-weight:bold;font: size 16pt;" class="form-control form-control-sm" name="satuanbrg_1910082" id="satuanbrg_1910082" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="jml">Harga Jual (Rp)</label>
                    <input type="text" class="form-control form-control-sm" name="hargabrg_1910082" id="hargabrg_1910082" value="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="jml">Qty</label>
                    <input type="text" class="form-control form-control-sm" name="jumlah_1910082" id="jumlah_1910082" value="">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="">#</label><br>
                    <button type="submit" class="btn btn-sm btn-success tombolSimpanTemp">
                        <i class="fa fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 dataTemp">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-4 col-form-label"></label>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-success">
                    Selesai Transaksi
                </button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>
<div class="viewmodal" style="display: none;"></div>
<div class="viewmodall" style="display: none;"></div>

<script>
    function selesaitransaksi() {
        pesan = confirm('Yakin Simpan Transaksi ?');
        if (pesan) {
            return true;
        } else {
            return false;
        }
    }

    $(document).ready(function() {
        dataTempBarangKeluar();

        $('.tombolSimpanTemp').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= site_url('barangkeluar/simpanTemp') ?>",
                data: {
                    nofakkeluar_1910082: $('#nofakkeluar_1910082').val(),
                    kdbrg_1910082: $('#kdbrg_1910082').val(),
                    harga_1910082: $('#hargabrg_1910082').val(),
                    jumlah_1910082: $('#jumlah_1910082').val(),
                },
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        Swal.fire('Error', response.error, 'error');
                    }
                    if (response.sukses == 'berhasil') {
                        dataTempBarangKeluar();
                        kosong();
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });

        });

        $('.tombolTambahpelanggan').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('barangkeluar/datapelanggan') ?>",
                dataType: "json",
                type: 'post',
                data: {
                    aksi: 0
                },
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahpelanggan').on('shown.bs.modal', function(event) {
                            $('#kdplg_1910082').focus();
                        });
                        $('#modaltambahpelanggan').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
        $('.tombolTambahbarang').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('barangkeluar/databarang') ?>",
                dataType: "json",
                type: 'post',
                data: {
                    aksi: 0
                },
                success: function(response) {
                    if (response.data) {
                        $('.viewmodall').html(response.data).show();
                        $('#modaltambahbarang').on('shown.bs.modal', function(event) {
                            $('#kdbrg_1910082').focus();
                        });
                        $('#modaltambahbarang').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
        $('.tombolSimpanbarangkeluar').click(function(e) {
            e.preventDefault();

            let form = $('.formsimpanbarangkeluar')[0];

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url: "<?= site_url('barangkeluar/simpandata') ?>",
                data: data,
                dataType: "json",
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $('.tombolSimpanbarang').html('<i class="fa fa-spin fa-spinner"></i>');
                    $('.tombolSimpanbarang').prop('disabled', true);
                },
                complete: function() {
                    $('.tombolSimpanbarangkeluar').html('Simpan');
                    $('.tombolSimpanbarangkeluar').prop('disabled', false);
                },
                success: function(response) {
                    if (response.error) {
                        let dataError = response.error;
                        if (dataError.errorKodeBarcode) {
                            $('.errornofakkeluar').html(dataError.errorKodeBarcode).show();
                            $('#nofakkeluar_1910082').addClass('is-invalid');
                        } else {
                            $('.errornofakkeluar').fadeOut();
                            $('#nofakkeluar_1910082').removeClass('is-invalid');
                            $('#nofakkeluar_1910082').addClass('is-valid');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: response.sukses,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    function kosong() {
        $('#kdbrg_1910082').val('');
        $('#namabrg_1910082').val('');
        $('#hargabrg_1910082').val('');
        $('#satuanbrg_1910082').val('');
        $('#jumlah_1910082').val('');
    }

    function dataTempBarangKeluar() {
        $.ajax({
            type: "post",
            url: "<?= site_url('barangkeluar/dataDetail') ?>",
            data: {
                nofakkeluar_1910082: $('#nofakkeluar_1910082').val()
            },
            dataType: "json",
            beforeSend: function() {
                $('.dataTemp').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            success: function(response) {
                if (response.data) {
                    $('.dataTemp').html(response.data);
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>

<?= $this->endSection() ?>