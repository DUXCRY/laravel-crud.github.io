$(document).ready(function() {
    /**
    * for showing edit item popup
    */
    //EDIT DATA
    $(document).on('click', "#edit-item-order", function() {
        $(this).addClass('edit-item-trigger-clicked');
        var url = $(this).attr('data-url-edit');

        $('#edit-modal-order').modal()


        $("#edit-form-order").attr("action", url);
    })

    // on modal show
    $('#edit-modal-order').on('show.bs.modal', function() {
        var el = $(".edit-item-trigger-clicked");
        var row = el.closest(".data-row");

        // get the data
        var id = el.data('item-id');
        var kd_project = row.children(".kd_project").text();
        var url = row.attr('data-url-edit');

        $("#modal-input-id").val(id);
        $("#modal-kd-project").val(kd_project).trigger('change');
        $("#edit-modal-order").attr("action", url);
    })

    // on modal hide
    $('#edit-modal-order').on('hide.bs.modal', function() {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form-order").trigger("reset");
    })

    //DELETE DATA
    $(document).on('click', "#delete-item-order", function() {
        var id = $(this).attr('data-item-id');
        var nama = $(this).attr('data-nama');
        var url = $(this).attr('data-url-delete');

        $('#delete-modal-order').modal()
        $("#order-name").text(nama);
        $("#delete-form-order", 'input').val(id);
        $("#delete-form-order").attr("action", url);
    })

})
