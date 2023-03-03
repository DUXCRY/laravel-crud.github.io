$(function () {
    var table = $("#example").DataTable({
            responsive: !0,
           // "order": [[ 1, "asc" ]]
        }),
        export_customer = new $.fn.dataTable.Buttons(table, {
            buttons: [{
                extend: "collection",
                className: "btn dropdown-toggle btn-flat",
                text: '<i class="fa fa-download"></i> Export <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>',
                buttons: [{
                    extend: "excel",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: "Excel"
                }, {
                    extend: "pdf",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: "PDF"
                }, {
                    text: '<li class="divider"></li>'
                }, {
                    extend: "print",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    text: '<i class="fa fa-print"></i> Print',
                    titleAttr: "print"
                }]
            }]
        }).container().appendTo($("#export_customer")),
        export_product = new $.fn.dataTable.Buttons(table, {
            buttons: [{
                extend: "collection",
                className: "btn dropdown-toggle btn-flat",
                text: '<i class="fa fa-download"></i> Export <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>',
                buttons: [{
                    extend: "excel",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: "Excel"
                }, {
                    extend: "pdf",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: "PDF"
                }, {
                    text: '<li class="divider"></li>'
                }, {
                    extend: "print",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                    text: '<i class="fa fa-print"></i> Print',
                    titleAttr: "print"
                }]
            }]
        }).container().appendTo($("#export_product")),
        export_project = new $.fn.dataTable.Buttons(table, {
            buttons: [{
                extend: "collection",
                className: "btn dropdown-toggle btn-flat",
                text: '<i class="fa fa-download"></i> Export <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>',
                buttons: [{
                    extend: "excel",
                    exportOptions: {
                        columns: [0, 1, 3, 4, 5, 6, 7, 10]
                    },
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: "Excel"
                }, {
                    extend: "pdf",
                    exportOptions: {
                        columns: [0, 1, 3, 4, 5, 6, 7, 10]
                    },
                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: "PDF"
                }, {
                    text: '<li class="divider"></li>'
                }, {
                    extend: "print",
                    exportOptions: {
                        columns: [0, 1, 3, 4, 5, 6, 7, 10]
                    },
                    text: '<i class="fa fa-print"></i> Print',
                    titleAttr: "print"
                }]
            }]
        }).container().appendTo($("#export_project")),
        export_progress = new $.fn.dataTable.Buttons(table, {
            buttons: [{
                extend: "collection",
                className: "btn dropdown-toggle btn-flat",
                text: '<i class="fa fa-download"></i> Export <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>',
                buttons: [{
                    extend: "excel",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: "Excel"
                }, {
                    extend: "pdf",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: "PDF"
                }, {
                    text: '<li class="divider"></li>'
                }, {
                    extend: "print",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    text: '<i class="fa fa-print"></i> Print',
                    titleAttr: "print"
                }]
            }]
        }).container().appendTo($("#export_progress")),
        export_order = new $.fn.dataTable.Buttons(table, {
            buttons: [{
                extend: "collection",
                className: "btn dropdown-toggle btn-flat",
                text: '<i class="fa fa-download"></i> Export <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>',
                buttons: [{
                    extend: "excel",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: "Excel"
                }, {
                    extend: "pdf",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: "PDF"
                }, {
                    text: '<li class="divider"></li>'
                }, {
                    extend: "print",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    text: '<i class="fa fa-print"></i> Print',
                    titleAttr: "print"
                }]
            }]
        }).container().appendTo($("#export_order"));



    $("#example1").DataTable(), $("#example2").DataTable({
        paging: !0,
        lengthChange: !0,
        searching: !0,
        ordering: !0,
        info: !0,
        autoWidth: !1
    }), $("#example4").DataTable({
        dom: "Bfrtip",
        buttons: [{
            extend: "collection",
            className: "btn dropdown-toggle btn-flat",
            text: '<i class="fa fa-download"></i> Export',
            buttons: [{
                extend: "excelHtml5",
                text: '<i class="fa fa-file-excel"></i> Excel',
                titleAttr: "Excel"
            }, {
                extend: "csvHtml5",
                text: '<i class="fa fa-file-csv"></i> CSV',
                titleAttr: "CSV"
            }, {
                extend: "pdfHtml5",
                text: '<i class="fa fa-file-pdf"></i> PDF',
                titleAttr: "PDF"
            }, {
                text: '<li class="divider"></li>'
            }, {
                extend: "print",
                text: '<i class="fa fa-print"></i> Print',
                titleAttr: "print"
            }]
        }]
    })
});
