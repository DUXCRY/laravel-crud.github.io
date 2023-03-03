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
    $(document).on('click', "#edit-item-product", function() {
        $(this).addClass('edit-item-trigger-clicked');
        var url = $(this).attr('data-url-edit');

        $('#edit-modal-product').modal();


        $("#edit-form-product").attr("action", url);
    })

    // on modal show
    $('#edit-modal-product').on('show.bs.modal', function() {
        var el = $(".edit-item-trigger-clicked");
        var row = el.closest(".data-row");

        // get the data
        var id = el.data('item-id');
        var nama= row.children(".pd_nama").text();
        var kategori = row.children(".pd_kategori").text();
        var brand= row.children(".pd_brand").text();
        var tipe = row.children(".pd_tipe").text();
        var design= row.children(".pd_design").text();
        var material = row.children(".pd_material").text();
        var harga= row.children(".pd_harga").text();

        var url = row.attr('data-url-edit');
        $('#modal-input-harga').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});

        $("#modal-input-id").val(id);
        $("#modal-input-nama").val(nama).focus();
        $("#modal-input-kategori").val(kategori).trigger('change');
        $("#modal-input-brand").val(brand).trigger('change');
        $("#modal-input-tipe").val(tipe).trigger('change');
        $("#modal-input-design").val(design).trigger('change');
        $("#modal-input-material").val(material).trigger('change');
        $("#modal-input-harga").val(harga);

        $("#edit-modal-product").attr("action", url);

    })

    // on modal hide
    $('#edit-modal-product').on('hide.bs.modal', function() {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
       // $('.edit-item-trigger-clicked').find("input,textarea,select").val('').end();
    })

    //DELETE DATA
    $(document).on('click', "#delete-item-product", function() {
        var id = $(this).attr('data-item-id');
        var nama = $(this).attr('data-nama');
        var url = $(this).attr('data-url-delete');

        $('#delete-modal-product').modal();
        $("#product-name").text(nama);
        $("#delete-form-product", 'input').val(id);
        $("#delete-form-product").attr("action", url);
    })

})
