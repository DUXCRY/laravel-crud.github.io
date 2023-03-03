$(document).ready(function() {
    /**
    * for showing edit item popup
    */
    //EDIT DATA
    $(document).on('click', "#edit-item-progress", function() {
        $(this).addClass('edit-item-trigger-clicked');
        var url = $(this).attr('data-url-edit');

        $('#edit-modal-progress').modal()


        $("#edit-form-progress").attr("action", url);
    })

    // on modal show
    $('#edit-modal-progress').on('show.bs.modal', function() {
        var el = $(".edit-item-trigger-clicked");
        var row = el.closest(".data-row");

        // get the data
        var id = el.data('item-id');
        var kdproject= row.children(".pg_kd_project").text();
        var periode= row.children(".pg_periode").text();
        var progres = row.children(".pg_progres").text();
        var actcost= row.children(".pg_act_cost").text();
        var ots = row.children(".pg_ots").text();

        var url = row.attr('data-url-edit');
        $('#modal-pg_act_cost').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});

        $("#modal-input-id").val(id);
        $("#modal-kd_project").val(kdproject);
        $("#modal-pg_periode").val(periode);
        $("#modal-pg_progres").val(progres);
        $("#modal-pg_act_cost").val(actcost);
        $("#modal-pg_outstanding_issues").val(ots);

        $("#edit-modal-progress").attr("action", url);
    })

    // on modal hide
    $('#edit-modal-progress').on('hide.bs.modal', function() {
       $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked');
       $("#edit-form-item").trigger("reset");
    })

    //DELETE DATA
    $(document).on('click', "#delete-item-progress", function() {
        var id = $(this).attr('data-item-id');
        var nama = $(this).attr('data-nama');
        var url = $(this).attr('data-url-delete');

        $('#delete-modal-progress').modal()
        $("#progress-name").text(nama);
        $("#delete-form-progress", 'input').val(id);
        $("#delete-form-progress").attr("action", url);
    })

})
