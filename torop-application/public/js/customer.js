$(document).ready(function() {

    //EDIT DATA
    $(document).on('click', "#edit-item-customer", function() {
        $(this).addClass('edit-item-trigger-clicked');
        var url = $(this).attr('data-url-edit');

        $('#edit-modal-customer').modal()


        $("#edit-form-customer").attr("action", url);
    })

    $('#edit-modal-customer').on('show.bs.modal', function() {
        var el = $(".edit-item-trigger-clicked");
        var row = el.closest(".data-row");

        var id = el.data('item-id');
        var nama = row.children(".cs_nama").text();
        var alamat = row.children(".cs_alamat").text();
        var notelp = row.children(".cs_notelp").text();
        var email = row.children(".cs_email").text();
        var url = row.attr('data-url-edit');


        $("#modal-input-id").val(id);
        $("#modal-input-nama").val(nama);
        $("#modal-input-alamat").val(alamat);
        $("#modal-input-notelp").val(notelp);
        $("#modal-input-email").val(email);
        $("#edit-modal-customer").attr("action", url);
    })

    $('#edit-modal-customer').on('hide.bs.modal', function() {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form-customer").trigger("reset");
    })

    //DELETE DATA
    $(document).on('click', "#delete-item-customer", function() {
        var id = $(this).attr('data-item-id');
        var nama = $(this).attr('data-nama');
        var url = $(this).attr('data-url-delete');

        $('#delete-modal-customer').modal()
        $("#customer-name").text(nama);
        $("#delete-form-customer", 'input').val(id);
        $("#delete-form-customer").attr("action", url);
    })

})
