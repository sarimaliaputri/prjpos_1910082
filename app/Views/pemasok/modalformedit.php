<div class="modal fade" id="modalformedit" tabindex="-1" aria-labelledby="modalformeditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalformeditLabel">Edit Pemasok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('pemasok/updatedata', ['class' => 'formsimpan']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Kode Pemasok</label>
                    <input type="text" name="kdpem_1910082" id="kdpem_1910082" class="form-control form-control-sm" value="<?= $kdpem_1910082; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Nama Pemasok</label>
                    <input type="text" name="namapem_1910082" id="namapem_1910082" class="form-control form-control-sm" required value="<?= $namapem_1910082; ?>">
                </div>
                <div class="form-group">
                    <label for="">Alamat Pemasok</label>
                    <input type="text" name="alamatpem_1910082" id="alamatpem_1910082" class="form-control form-control-sm" required value="<?= $alamatpem_1910082; ?>">
                </div>
                <div class="form-group">
                    <label for="">No Telpon</label>
                    <input type="text" name="notlp_1910082" id="notlp_1910082" class="form-control form-control-sm" required value="<?= $notlp_1910082; ?>">
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary tombolUpdate">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.formsimpan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function(e) {
                    $('.tombolUpdate').prop('disabled', true);
                    $('.tombolUpdate').html('<i class="fa fa-spin fa-spinner"></i>')
                },
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire(
                            'Berhasil',
                            response.sukses,
                            'success'
                        ).then((result) => {
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
            return false;
        });
    });
</script>