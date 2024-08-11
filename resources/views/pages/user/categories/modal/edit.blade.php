<div class="modal fade" id="modal_edit_category" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header flex-stack align-items-center">
                <div class="fs-2 fw-bold">Edit Kategori</div>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <form class="modal-body pt-10 pb-15 px-lg-17" id="form_edit_categories">
                <input type="text" name="id" hidden>

                <div class="px-3" style="max-height: 400px; overflow-y: auto;">
                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span class="required">Nama Kategori</span>
                        </label>
                        <input type="text" class="form-control form-control-lg form-control-solid" name="name" required
                            placeholder="" value="">
                    </div>
                </div>

                <div class="text-center mt-9">
                    <button type="reset" class="btn btn-sm btn-light me-3 w-lg-200px"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-info w-lg-200px">
                        <span class="indicator-label">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#form_edit_categories').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            $('#form_edit_categories [type="submit"]').attr('disabled', true);
            $('#form_edit_categories [type="submit"]').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
            );
            $.ajax({
                url: "{{ route('categories.update', '') }}" + '/' + $('input[name="id"]').val(),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    toastr.success(data.message, 'Selamat 🚀 !');
                    $('#form_edit_categories [type="submit"]').attr('disabled', false);
                    $('#form_edit_categories [type="submit"]').html('Simpan')
                    $('#modal_edit_category').modal('hide');

                    $('#form_edit_categories').trigger('reset');
                    table?.draw();
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                    $('#form_edit_categories [type="submit"]').attr('disabled', false);
                    $('#form_edit_categories [type="submit"]').html('Simpan')
                }
            });
        });
    });
</script>
