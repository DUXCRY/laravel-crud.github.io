$(document).ready(function() {
    /**
    * for showing edit item popup
    */
    //EDIT DATA
    $(document).on('click', "#edit-item-item", function() {
        $(this).addClass('edit-item-trigger-clicked');
        var url = $(this).attr('data-url-edit');

        $('#edit-modal-item').modal()


        $("#edit-form-item").attr("action", url);
    })

    // on modal show
    $('#edit-modal-item').on('show.bs.modal', function() {
        var el = $(".edit-item-trigger-clicked");
        var row = el.closest(".data-row");

        // get the data
        var id = el.data('item-id');
        var order_id = row.children(".order_id").text();
        var pd_id = row.children(".pd_id").text();
        var qty = row.children(".qty").text();
        var unit = row.children(".unit").text();
        var harga_unit = row.children(".harga_unit").text();
        var total_harga = row.children(".total_harga").text();
        var keterangan = row.children(".keterangan").text();
        var url = row.attr('data-url-edit');
       // checked.split('.').join("")
      //  $('#modal-input-harga').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});

        $("#modal-input-id").val(id);
        $("#modal-input-order_id").val(order_id);
        $("#modal-input-pd_id").val(pd_id).trigger('change');
        $("#modal-input-qty").val(qty);
        $("#modal-input-unit").val(unit).trigger('change');
        $("#modal-input-harga_unit").val(harga_unit.replace(/[.,\s]/g, ''));
        $("#modal-input-total_harga").val(total_harga);
        $("#modal-input-keterangan").val(keterangan);
        $("#edit-modal-item").attr("action", url);
    })

    // on modal hide
    $('#edit-modal-item').on('hide.bs.modal', function() {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked');
        $("#edit-form-item").trigger("reset");
    })

    //DELETE DATA
    $(document).on('click', "#delete-item-item", function() {
        var id = $(this).attr('data-item-id');
        var nama = $(this).attr('data-nama');
        var url = $(this).attr('data-url-delete');

        $('#delete-modal-item').modal()
        $("#item-name").text(nama);
        $("#delete-form-item", 'input').val(id);
        $("#delete-form-item").attr("action", url);
    })

})
