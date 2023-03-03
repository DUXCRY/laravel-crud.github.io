<div class="modal fade" id="delete-modal-progress" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="delete-form-progress" method="post">
                    @csrf
                    @method('delete')
                    <h4 style="text-align: center">
                        <span style="font-weight: normal">Anda yakin ingin menghapus progress periode
                            <span id="progress-name" style="font-weight: bold"></span>?
                        </span>
                    </h4>
                    <div class="divider"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger" id="submit">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
