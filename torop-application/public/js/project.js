$(document).ready(function() {
    /**
    * for showing edit item popup
    */
    // on modal hide
    $('#modal-progress').on('hide.bs.modal', function() {
        $('.show-item-trigger-clicked').removeClass('show-item-trigger-clicked')
    // $('.edit-item-trigger-clicked').find("input,textarea,select").val('').end();
    })

    //EDIT DATA
    $(document).on('click', "#edit-item-project", function() {
        $(this).addClass('edit-item-trigger-clicked');
        var url = $(this).attr('data-url-edit');

        $('#edit-modal-project').modal();


        $("#edit-form-project").attr("action", url);
    })

    // on modal show
    $('#edit-modal-project').on('show.bs.modal', function() {
        var el = $(".edit-item-trigger-clicked");
        var row = el.closest(".data-row");

        // get the data
        var id = el.data('item-id');
        var customer= row.children(".pj_cs").text();
        var nama= row.children(".pj_nama").text();
        var pic = row.children(".pj_pic").text();
        var nama= row.children(".pj_nama").text();
        var nilai_kontrak = row.children(".pj_nilai_kontrak").text()
        var tgl_mulai= row.children(".pj_tgl_mulai").text();
        var tgl_selesai = row.children(".pj_tgl_selesai").text();
        var rencana= row.children(".pj_rencana").text();
        var status= row.children(".pj_status").text();

        var url = row.attr('data-url-edit');
        $('#modal-input-nilai_kontrak').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});

        // fill the data in the input fields
        $("#modal-input-id").val(id);
        $("#modal-input-cs").val(customer).trigger('change');
        $("#modal-input-nama").val(nama);
        $("#modal-input-pic").val(pic);
        $("#modal-input-nilai_kontrak").val(nilai_kontrak);
        $("#modal-input-tgl_mulai").val(tgl_mulai)
        $("#modal-input-tgl_selesai").val(tgl_selesai);
        $("#modal-input-rencana").val(rencana);
        $("#modal-input-status").val(status);

        $("#edit-modal-project").attr("action", url);

    })

    // on modal hide
    $('#edit-modal-project').on('hide.bs.modal', function() {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
       // $('.edit-item-trigger-clicked').find("input,textarea,select").val('').end();
    })

    //DELETE DATA
    $(document).on('click', "#delete-item-project", function() {
        var id = $(this).attr('data-item-id');
        var nama = $(this).attr('data-nama');
        var url = $(this).attr('data-url-delete');

        $('#delete-modal-project').modal();
        $("#project-name").text(nama);
        $("#delete-form-project", 'input').val(id);
        $("#delete-form-project").attr("action", url);
    })

})
