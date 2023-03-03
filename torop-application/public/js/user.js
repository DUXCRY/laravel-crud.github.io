$(document).ready(function() {
    /**
    * for showing edit item popup
    */
    //EDIT DATA
    $(document).on('click', "#edit-item-user", function() {
        $(this).addClass('edit-item-trigger-clicked');
        var url = $(this).attr('data-url-edit');

        $('#edit-modal-user').modal()


        $("#edit-form-user").attr("action", url);
    })

    // on modal show
    $('#edit-modal-user').on('show.bs.modal', function() {
        var el = $(".edit-item-trigger-clicked");
        var row = el.closest(".data-row");

        // get the data
        var id = el.data('item-id');
        var nama= row.children(".nama").text();
        var email= row.children(".email").text();
        var jabatan = row.children(".jabatan").text();
        var roles= row.children(".roles").text();

        var url = row.attr('data-url-edit');


        $("#modal-input-id").val(id);
        $("#modal-nama").val(nama);
        $("#modal-email").val(email);
        $("#modal-jabatan").val(jabatan);
        $("#modal-roles").val(roles);

        $("#edit-modal-user").attr("action", url);
    })

    // on modal hide
    $('#edit-modal-user').on('hide.bs.modal', function() {
       $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    })

    //DELETE DATA
    $(document).on('click', "#delete-item-user", function() {
        var id = $(this).attr('data-item-id');
        var nama = $(this).attr('data-nama');
        var url = $(this).attr('data-url-delete');

        $('#delete-modal-user').modal()
        $("#user-name").text(nama);
        $("#delete-form-user", 'input').val(id);
        $("#delete-form-user").attr("action", url);
    })

})
