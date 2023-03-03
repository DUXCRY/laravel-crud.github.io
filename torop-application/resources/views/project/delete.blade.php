<div class="modal fade" id="delete-modal-project" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="delete-form-project" method="post">
                    @csrf
                    @method('delete')
                    <h4 style="text-align: center">
                        <span style="font-weight: normal">Anda yakin ingin menghapus proyek
                            <span id="project-name" style="font-weight: bold"></span>?
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

<div class="modal fade" id="cant-delete-project" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form>
                    <h4 style="text-align: center">
                        <i class="fa fa-exclamation-triangle" style="color: #F44336;"></i>
                        Data tidak dapat dihapus karena masih dalam Progress!
                    </h4>
                    <div class="divider"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
