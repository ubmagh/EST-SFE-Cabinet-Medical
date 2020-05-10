(function ($) {
    "use strict";
    $(function () {
        $("#order-listing").DataTable({
            aLengthMenu: [
                [5, 10, 15, -1],
                [10, 15, 25, "All"],
            ],
            iDisplayLength: 10,
            columnDefs: dataTable_can_sort_columns__,
            language: {
                search: dataTable_Search_label,
                lengthMenu: dataTable_nbr_lines_language,
                info: " Affiche du page _PAGE_ sur _PAGES_ pages",
                zeroRecords: " Aucun donnée à afficher ",
                paginate: {
                    next: "suivant",
                    previous: "précédent",
                },
            },
            order: [[0, dataTable_Order_string]],
        });
        $("#order-listing").each(function () {
            var datatable = $(this);
            // SEARCH - Add the placeholder for Search and Turn this into in-line form control
            var search_input = datatable
                .closest(".dataTables_wrapper")
                .find("div[id$=_filter] input");
            search_input.attr("placeholder", dataTable_Place_Holder);
            search_input.removeClass("form-control-sm");
            // LENGTH - Inline-Form control
            var length_sel = datatable
                .closest(".dataTables_wrapper")
                .find("div[id$=_length] select");
            length_sel.removeClass("form-control-sm");
        });
    });
})(jQuery);
